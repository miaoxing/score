<?php

namespace Miaoxing\Score\Service;

use miaoxing\plugin\BaseService;

class ScoreLog extends BaseService
{
    public function __invoke()
    {
        return wei()->scoreLogRecord();
    }
}
