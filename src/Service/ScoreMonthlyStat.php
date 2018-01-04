<?php

namespace Miaoxing\Score\Service;

use Miaoxing\Plugin\BaseService;

class ScoreMonthlyStat extends BaseService
{
    public function __invoke()
    {
        return wei()->scoreMonthlyStatRecord();
    }
}
