<?php

namespace Miaoxing\Score\Controller\Cli;

use miaoxing\plugin\BaseController;

class Scores extends BaseController
{
    public function statAction($req)
    {
        // 1. 获取统计的时间范围
        $today = wei()->statV2->getFirstDayOfMonth();
        list($startDate, $endDate) = explode('~', (string) $req['date']);
        if (!$startDate) {
            $startDate = $today;
        }
        if (!$endDate) {
            $endDate = $startDate;
        }

        $stat = wei()->statV2;

        // 2. 读取各天统计数据
        $logs = $stat->createQuery('scoreLogRecord', $startDate, $endDate, 'created_month');
        $logs = $logs->fetchAll();

        // 3. 按日期,编号格式化
        $data = $stat->format('scoreLogRecord', $logs, 'created_month');

        // 4. 记录到统计表中
        $stat->save('scoreLogRecord', $data, 'scoreMonthlyStatRecord', 'created_month');

        return $this->suc();
    }
}
