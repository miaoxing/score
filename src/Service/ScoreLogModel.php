<?php

namespace Miaoxing\Score\Service;

use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Model\HasAppIdTrait;
use Miaoxing\Score\Metadata\ScoreLogTrait;
use Miaoxing\User\Model\BelongsToUserModelTrait;

/**
 * ScoreLogModel
 */
class ScoreLogModel extends BaseModelV2
{
    use ScoreLogTrait;
    use HasAppIdTrait;
    use BelongsToUserModelTrait;
}
