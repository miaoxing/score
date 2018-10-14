<?php

namespace Miaoxing\Score\Metadata;

/**
 * ScoreLogTrait
 *
 * @property int $id
 * @property int $appId
 * @property int $userId
 * @property string $cardCode
 * @property int $shopId
 * @property int $score
 * @property int $action
 * @property string $source
 * @property string $description
 * @property string $createdMonth
 * @property string $createdAt
 * @property int $createdBy
 */
trait ScoreLogTrait
{
    /**
     * @var array
     * @see CastTrait::$casts
     */
    protected $casts = [
        'id' => 'int',
        'app_id' => 'int',
        'user_id' => 'int',
        'card_code' => 'string',
        'shop_id' => 'int',
        'score' => 'int',
        'action' => 'int',
        'source' => 'string',
        'description' => 'string',
        'created_month' => 'date',
        'created_at' => 'datetime',
        'created_by' => 'int',
    ];
}
