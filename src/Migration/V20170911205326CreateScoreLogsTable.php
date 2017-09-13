<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20170911205326CreateScoreLogsTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('score_logs')
            ->id()
            ->int('app_id')
            ->int('user_id')
            ->string('card_code', 16)
            ->int('shop_id')
            ->int('score')->unsigned(false)
            ->string('description')
            ->timestamp('created_at')
            ->int('created_by')
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('score_logs');
    }
}
