<?php

namespace Miaoxing\Score\Service;

use miaoxing\plugin\BaseModel;
use Miaoxing\Plugin\Service\User;
use Miaoxing\Score\Job\PostScoreChange;

class Score extends BaseModel
{
    protected $changedTemplateId;

    /**
     * 积分变更通知
     * @param User $user
     * @param $changeScore
     * @return array|void
     */
    public function sendChangedScoreTplMsg(User $user, $changeScore)
    {
        $data = $this->getSendChangedScoreTplData($user, $changeScore);
        $url = wei()->url->full('score');

        $account = wei()->wechatAccount->getCurrentAccount();
        $ret = $account->sendTemplate($user, $this->changedTemplateId, $data, $url);

        return $ret;
    }

    /**
     * {{first.DATA}}
     * 类型：{{keyword1.DATA}}
     * 积分数：{{keyword2.DATA}}
     * 当前积分总数：{{keyword3.DATA}}
     * {{remark.DATA}}
     * @param User $user
     * @param $changeScore
     * @return array
     */
    public function getSendChangedScoreTplData(User $user, $changeScore)
    {
        $scoreTitle = wei()->setting('score.title', '积分');

        return [
            'first' => [
                'value' => '您的' . $scoreTitle . '变更了',
            ],
            'keyword1' => [
                'value' => $changeScore > 0 ? '增加' : '减少',
            ],
            'keyword2' => [
                'value' => $changeScore,
            ],
            'keyword3' => [
                'value' => $user['score'],
            ],
            'remark' => [
                'value' => '请点击进入查看详情',
            ],
        ];
    }

    public function getScore(User $user = null)
    {
        $user || $user = wei()->curUser;

        // 触发获取积分事件,允许通过外部获取积分
        $score = wei()->event->until('scoreGet', [$user]);
        if ($score !== null) {
            return $score;
        }

        return $user['score'];
    }

    /**
     * 为用户增加或减少积分
     *
     * @param int $score 积分,可正可负
     * @param array|string $data 备注或日志数据
     * @param User $user 用户对象
     * @return array
     */
    public function changeScore($score, $data, User $user = null)
    {
        $user || $user = wei()->curUser;

        // 兼容旧数据
        if (is_string($data)) {
            $data = ['description' => $data];
        }

        $ret = wei()->event->until('scoreChange', [$user, $score, $data]);
        if ($ret) {
            return $ret;
        }

        // 1. 如果是减少积分,检查剩下的积分是否足够
        if ($score < 0 && $score + $user['score'] < 0) {
            $scoreTitle = wei()->setting('score.title', '积分');
            $ret = ['code' => -2, 'message' => '很抱歉,您的' . $scoreTitle . '不足'];
            wei()->logger->warning('Change user score fail', $ret + [
                    'amount' => $score,
                    'balance' => $user['score'],
                ]);

            return $ret;
        }

        // 2. 记录一笔积分记录
        $balance = $user['score'] + $score;
        $log = [
            'user_id' => $user['id'],
            'score' => $score,
        ];
        wei()->scoreLog()->setAppId()->save($log + $data);

        // 3. 扣款并保存,之后还原积分为数字
        $user->incr('score', $score);
        $user->save();
        $user['score'] = $balance;

        // 4. 触发积分更改后事件
        wei()->event->trigger('postScoreChange', [$user, $score, $data]);
        wei()->queue->push(PostScoreChange::className(), [
            'user_id' => $user['id'],
            'score' => $score,
            'data' => $data
        ], wei()->app->getNamespace());

        // 发送模板消息
        $this->sendChangedScoreTplMsg($user, $score);

        return ['code' => 1, 'message' => '更改成功'];
    }

    /**
     * 获取用户积分记录
     *
     * @param string $userId
     * @return array|false
     */
    public function getScoreLog($userId)
    {
        return wei()->db('scoreHistory')->where('userId=?', $userId)->andWhere('score!=?', 0)->desc('id')->fetchAll();
    }
}
