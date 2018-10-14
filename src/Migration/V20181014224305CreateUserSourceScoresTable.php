<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20181014224305CreateUserSourceScoresTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('user_source_scores')
            ->id()
            ->int('app_id')
            ->int('user_id')
            ->string('source', 16)
            ->int('score')
            ->timestamps()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->drop('user_source_scores');
    }
}
