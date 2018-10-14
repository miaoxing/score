<?php

namespace Miaoxing\Score\Metadata;

/**
 * UserScoreTrait
 *
 * @property int $id
 * @property int $userId
 * @property int $score
 * @property int $usedScore
 * @property int $totalScore
 * @property string $createdAt
 * @property string $updatedAt
 */
trait UserScoreTrait
{
    /**
     * @var array
     * @see CastTrait::$casts
     */
    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
        'score' => 'int',
        'used_score' => 'int',
        'total_score' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
