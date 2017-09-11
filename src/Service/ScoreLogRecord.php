<?php

namespace Miaoxing\Score\Service;

use miaoxing\plugin\BaseModel;
use Miaoxing\Plugin\Service\User;

/**
 * @property User $user
 * @property User $creator
 */
class ScoreLogRecord extends BaseModel
{
    protected $table = 'score_logs';

    protected $providers = [
        'db' => 'app.db',
    ];

    protected $appIdColumn = 'app_id';

    protected $createAtColumn = 'created_at';

    protected $createdByColumn = 'created_by';

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function creator()
    {
        return $this->belongsTo('user', 'id', 'created_by');
    }
}
