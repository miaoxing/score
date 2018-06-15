<?php

namespace Miaoxing\Score\Controller;

use Miaoxing\Plugin\BaseController;

class ScoreLogs extends BaseController
{
    public function indexAction($req)
    {
        $rows = 10;
        $page = $req['page'] > 0 ? (int) $req['page'] : 1;

        $scores = wei()->scoreLog()->curApp()->mine();

        $scores->limit($rows)->page($page);

        $scores->desc('created_at');

        $data = [];
        foreach ($scores->findAll() as $score) {
            $data[] = $score->toArray();
        }

        $ret = [
            'data' => $data,
            'page' => $page,
            'rows' => $rows,
            'records' => $scores->count(),
        ];

        switch ($req['_format']) {
            case 'json':
                return $this->ret($ret);

            default:
                $headerTitle = '积分记录';

                return get_defined_vars();
        }
    }
}
