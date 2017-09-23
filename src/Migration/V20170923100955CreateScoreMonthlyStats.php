<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20170923100955CreateScoreMonthlyStats extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('score_monthly_stats')
            ->id()
            ->int('app_id')
            ->date('stat_date')
            ->int('add_count')
            ->int('add_user')
            ->int('add_score')
            ->int('sub_count')
            ->int('sub_user')
            ->int('sub_score')
            ->int('total_add_count')
            ->int('total_add_user')
            ->int('total_add_score')
            ->int('total_sub_count')
            ->int('total_sub_user')
            ->int('total_sub_score')
            ->timestamps()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('score_monthly_stats');
    }
}
