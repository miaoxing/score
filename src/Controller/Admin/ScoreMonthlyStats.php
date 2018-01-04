<?php

namespace Miaoxing\Score\Controller\Admin;

use DateTime;
use Miaoxing\Plugin\BaseController;

class ScoreMonthlyStats extends BaseController
{
    protected $controllerName = '积分每月统计';

    protected $actionPermissions = [
        'index' => '查看',
    ];

    protected $displayPageHeader = true;

    public function indexAction($req)
    {
        // 获取查询的日期范围
        $startDate = $req['start_date'] ?: date('Y-m-d', strtotime('-6 months'));
        $endDate = $req['end_date'] ?: date('Y-m-d');
        $startDate = wei()->statV2->getFirstDayOfMonth(strtotime($startDate));
        $endDate = wei()->statV2->getFirstDayOfMonth(strtotime($endDate));

        $startMonth = substr($startDate, 0, 7);
        $endMonth = substr($endDate, 0, 7);

        switch ($req['_format']) {
            case 'json':
                // 1. 读出统计数据
                $stats = wei()->scoreMonthlyStat()
                    ->curApp()
                    ->andWhere('stat_date BETWEEN ? AND ? ', [$startDate, $endDate])
                    ->fetchAll();

                // 2. 如果取出的数据和日期不一致,补上缺少的数据
                $date1 = new DateTime($startDate);
                $date2 = new DateTime($endDate);
                $dateCount = $date1->diff($date2)->days + 1;
                if (count($stats) != $dateCount) {
                    // 找到最后一个有数据的日期
                    $lastStat = wei()->scoreMonthlyStat()
                        ->curApp()
                        ->andWhere('stat_date < ?', $startDate)
                        ->desc('id')
                        ->toArray();

                    $defaults = wei()->scoreMonthlyStatRecord->getData();

                    $stats = wei()->statV2->normalize(
                        'scoreMonthlyStatRecord',
                        $stats,
                        $defaults,
                        $lastStat,
                        $startDate,
                        $endDate,
                        '+1 month'
                    );
                }

                // 3. 转换为数字
                $stats = wei()->chart->convertNumbers($stats);
                foreach ($stats as &$stat) {
                    $stat['stat_month'] = substr($stat['stat_date'], 0, 7);
                }

                return $this->suc([
                    'data' => $stats,
                ]);

            default:
                return get_defined_vars();
        }
    }
}
