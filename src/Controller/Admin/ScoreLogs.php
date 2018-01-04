<?php

namespace Miaoxing\Score\Controller\Admin;

use Miaoxing\Plugin\BaseController;

class ScoreLogs extends BaseController
{
    protected $controllerName = '积分日志';

    protected $actionPermissions = [
        'index' => '列表',
    ];

    protected $displayPageHeader = true;

    public function indexAction($req)
    {
        switch ($req['_format']) {
            case 'json':
                $scoreLogs = wei()->scoreLog()
                    ->curApp();

                $scoreLogs
                    ->limit($req['rows'])
                    ->page($req['page'])
                    ->desc('id');

                if ($req['user_id']) {
                    $scoreLogs->andWhere(['user_id' => $req['user_id']]);
                }

                if ($req['type']) {
                    $scoreLogs->andWhere(['action' => $req['type']]);
                }

                if ($req['card_code']) {
                    $scoreLogs->andWhere(['card_code' => $req['card_code']]);
                }

                if ($req['start_date']) {
                    $scoreLogs->andWhere('created_at >= ?', $req['start_date']);
                }

                if ($req['end_date']) {
                    $scoreLogs->andWhere('created_at <= ?', $req['end_date'] . '23:59:59');
                }

                if ($req['description']) {
                    $scoreLogs->andWhere('description LIKE ?', '%' . $req['description'] . '%');
                }

                // 数据
                $scoreLogs->findAll()->load(['user']);
                $data = [];
                foreach ($scoreLogs as $scoreLog) {
                    $data[] = $scoreLog->toArray() + [
                            'user' => $scoreLog->user,
                        ];
                }

                return $this->suc([
                    'data' => $data,
                    'page' => (int) $req['page'],
                    'rows' => (int) $req['rows'],
                    'records' => $scoreLogs->count(),
                ]);

            default:
                return get_defined_vars();
        }
    }
}
