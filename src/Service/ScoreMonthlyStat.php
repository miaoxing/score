<?php

namespace Miaoxing\Score\Service;

use miaoxing\plugin\BaseService;

class ScoreMonthlyStat extends BaseService
{
    public function __invoke()
    {
        return wei()->scoreMonthlyStatRecord();
    }
}
