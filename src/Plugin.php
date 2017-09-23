<?php

namespace Miaoxing\Score;

class Plugin extends \miaoxing\plugin\BasePlugin
{
    protected $name = '积分';

    protected $description = '';

    public function onAdminNavGetNavs(&$navs, &$categories, &$subCategories)
    {
        $subCategories['marketing-score'] = [
            'parentId' => 'marketing',
            'name' => '积分',
            'icon' => 'fa fa-star',
        ];

        $navs[] = [
            'parentId' => 'marketing-score',
            'url' => 'admin/score-logs',
            'name' => '积分日志',
        ];

        $navs[] = [
            'parentId' => 'marketing-score',
            'url' => 'admin/score-monthly-stats',
            'name' => '积分每月统计',
        ];
    }
}
