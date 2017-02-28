<?php

namespace Miaoxing\Score\Controller;

class Score extends \miaoxing\plugin\BaseController
{
    public function indexAction()
    {
        $headerTitle = $this->setting('score.title', '积分') . '列表';
        $scoreList = wei()->score->getScoreLog($this->curUser['id']);
        $userInfo = wei()->user()->where('id=?', $this->curUser['id'])->fetch();
        return get_defined_vars();
    }

    public function getUserScoreAction($req)
    {
        $score = wei()->score->getScore();
        return $this->json('成功', 1, array('data' => $score));
    }
}
