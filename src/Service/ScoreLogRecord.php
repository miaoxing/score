<?php

namespace Miaoxing\Score\Service;

use miaoxing\plugin\BaseModel;
use Miaoxing\Plugin\Constant;
use Miaoxing\Plugin\Service\User;

/**
 * @property User $user
 * @property User $creator
 */
class ScoreLogRecord extends BaseModel
{
    use Constant;

    const ACTION_ADD = 1;

    const ACTION_SUB = 2;

    protected $actionTable = [
        self::ACTION_ADD => [
            'text' => '增加',
        ],
        self::ACTION_SUB => [
            'text' => '减少',
        ],
    ];

    protected $table = 'score_logs';

    protected $providers = [
        'db' => 'app.db',
    ];

    protected $appIdColumn = 'app_id';

    protected $userIdColumn = 'user_id';

    protected $createdAtColumn = 'created_at';

    protected $createdByColumn = 'created_by';

    /**
     * @var array
     */
    protected $statFields = ['app_id'];

    /**
     * @var array
     */
    protected $statActions = [
        self::ACTION_ADD => 'add',
        self::ACTION_SUB => 'sub',
    ];

    /**
     * @var bool
     */
    protected $statTotal = true;

    /**
     * @var array
     */
    protected $statSums = ['score'];

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function creator()
    {
        return $this->belongsTo('user', 'id', 'created_by');
    }
}
