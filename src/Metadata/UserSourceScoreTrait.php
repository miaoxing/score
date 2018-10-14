<?php

namespace Miaoxing\Score\Metadata;

/**
 * UserSourceScoreTrait
 *
 * @property int $id
 * @property int $userId
 * @property string $source
 * @property int $score
 * @property string $createdAt
 * @property string $updatedAt
 */
trait UserSourceScoreTrait
{
    /**
     * @var array
     * @see CastTrait::$casts
     */
    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
        'source' => 'string',
        'score' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
