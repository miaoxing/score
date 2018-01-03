<?php

namespace Miaoxing\Score\Controller;

class UserScore extends \miaoxing\plugin\BaseController
{
    public function indexAction($req)
    {
        $score = wei()->score->getScore();

        return $this->suc([
            'data' => $score,
        ]);
    }
}
