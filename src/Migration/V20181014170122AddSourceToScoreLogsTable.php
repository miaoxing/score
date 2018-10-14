<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20181014170122AddSourceToScoreLogsTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('score_logs')
            ->string('source', 16)->after('action')
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->table('score_logs')
            ->dropColumn('source')
            ->exec();
    }
}
