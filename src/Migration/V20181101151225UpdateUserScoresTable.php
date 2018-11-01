<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20181101151225UpdateUserScoresTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('user_scores')
            ->int('score')->unsigned(false)->change()
            ->int('total_score')->unsigned(false)->change()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->table('user_scores')
            ->int('score')->unsigned()->change()
            ->int('total_score')->unsigned()->change()
            ->exec();
    }
}
