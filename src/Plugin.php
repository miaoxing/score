<?php

namespace Miaoxing\Score;

class Plugin extends \miaoxing\plugin\BasePlugin
{
    protected $name = '积分';

    protected $description = '';

    public function onAdminNavGetNavs(&$navs, &$categories, &$subCategories)
    {
        $navs[] = [
            'parentId' => 'marketing-stat',
            'url' => 'admin/score/data',
            'name' => '积分统计',
        ];
    }
}
