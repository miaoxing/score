<?php

namespace Miaoxing\Score\Controller;

class Score extends \miaoxing\plugin\BaseController
{
    public function getUserScoreAction($req)
    {
        $score = wei()->score->getScore();

        return $this->json('成功', 1, ['data' => $score]);
    }
}
