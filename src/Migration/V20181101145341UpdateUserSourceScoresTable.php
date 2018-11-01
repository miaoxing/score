<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20181101145341UpdateUserSourceScoresTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('user_source_scores')
            ->int('score')->unsigned(false)->change()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->table('user_source_scores')
            ->int('score')->unsigned()->change()
            ->exec();
    }
}
