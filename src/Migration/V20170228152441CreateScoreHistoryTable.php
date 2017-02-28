<?php

namespace Miaoxing\Score\Migration;

use Miaoxing\Plugin\BaseMigration;

class V20170228152441CreateScoreHistoryTable extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->schema->table('scoreHistory')
            ->id()
            ->int('userId')
            ->int('score')
            ->tinyInt('type')
            ->timestamp('createTime')
            ->string('remark')
            ->index('userId')
            ->exec();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->schema->dropIfExists('scoreHistory');
    }
}
