<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20170923115452AddActionAndCreatedMonthToScoreLogsTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('score_logs')
            ->tinyInt('action')->after('score')
            ->date('created_month')->after('description')
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->table('score_logs')
            ->dropColumn('action')
            ->dropColumn('created_month')
            ->exec();
    }
}
