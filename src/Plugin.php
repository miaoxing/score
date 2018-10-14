<?php

namespace Miaoxing\Score;

class Plugin extends \Miaoxing\Plugin\BasePlugin
{
    protected $name = '积分';

    protected $description = '';

    public function onAdminNavGetNavs(&$navs, &$categories, &$subCategories)
    {
        $subCategories['marketing-score'] = [
            'parentId' => 'marketing',
            'name' => '积分',
            'icon' => 'fa fa-star',
        ];

        $navs[] = [
            'parentId' => 'marketing-score',
            'url' => 'admin/score-logs',
            'name' => '积分日志',
        ];

        $navs[] = [
            'parentId' => 'marketing-score',
            'url' => 'admin/score-monthly-stats',
            'name' => '积分每月统计',
        ];
    }

    public function onAsyncPostScoreChange($data)
    {
        $userScore = wei()->userScoreModel()->findOrInit(['user_id' => $data['userId']]);

        $score = $data['score'];
        $userScore->incr('score', $score);
        if ($score > 0) {
            $userScore->incr('total_score', $score);
        } else {
            $userScore->incr('used_score', -$score);
        }
        $userScore->save();

        if (!$data['data']['source']) {
            return;
        }

        $userSourceScore = wei()->userSourceScoreModel()->findOrInit([
            'user_id' => $data['userId'],
            'source' => $data['data']['source'],
        ]);
        $userSourceScore->incr('score', $score)->save();
    }
}
