<?php

namespace Miaoxing\Score\Service;

use Miaoxing\Plugin\BaseService;

class ScoreLog extends BaseService
{
    public function __invoke()
    {
        return wei()->scoreLogRecord();
    }
}
