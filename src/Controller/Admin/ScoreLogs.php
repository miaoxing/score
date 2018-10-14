<?php

namespace Miaoxing\Score\Controller\Admin;

use Miaoxing\Admin\Action\IndexTrait;
use Miaoxing\Plugin\BaseController;
use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Service\Request;
use Miaoxing\Score\Service\ScoreLogModel;

class ScoreLogs extends BaseController
{
    use IndexTrait;

    protected $controllerName = '积分日志';

    protected $actionPermissions = [
        'index,metadata' => '列表',
    ];

    public function metadataAction()
    {
        return $this->suc([
            'enableShop' => wei()->score->enableShop,
            'actions' => wei()->scoreLogRecord->getConsts('action'),
            'sources' => wei()->score->getSources(),
        ]);
    }

    protected function beforeIndexFind(Request $req, BaseModelV2 $models)
    {
        $models->reqQuery(['except' => 'action']);
    }

    protected function buildIndexData(ScoreLogModel $model)
    {
        return [
            'user' => $model->user,
        ];
    }
}
