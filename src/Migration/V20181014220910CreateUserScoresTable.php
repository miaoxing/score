<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20181014220910CreateUserScoresTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('user_scores')
            ->int('id')
            ->int('user_id')
            ->int('score')
            ->int('used_score')
            ->int('total_score')
            ->timestamps()
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->drop('user_scores');
    }
}
