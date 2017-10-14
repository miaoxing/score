<?php

namespace Miaoxing\Score\Service;

use miaoxing\plugin\BaseModel;

class ScoreMonthlyStatRecord extends BaseModel
{
    protected $table = 'score_monthly_stats';

    protected $providers = [
        'db' => 'app.db',
    ];

    protected $appIdColumn = 'app_id';

    protected $createdAtColumn = 'created_at';

    protected $updatedAtColumn = 'updated_at';

    protected $data = [
        'add_user' => 0,
        'add_count' => 0,
        'add_score' => 0,
        'sub_user' => 0,
        'sub_count' => 0,
        'sub_score' => 0,
        'total_add_user' => 0,
        'total_add_count' => 0,
        'total_add_score' => 0,
        'total_sub_user' => 0,
        'total_sub_count' => 0,
        'total_sub_score' => 0,
    ];
}
