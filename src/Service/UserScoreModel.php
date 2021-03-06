<?php

namespace Miaoxing\Score\Service;

use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Model\HasAppIdTrait;
use Miaoxing\Score\Metadata\UserScoreTrait;

/**
 * UserScoreModel
 */
class UserScoreModel extends BaseModelV2
{
    use UserScoreTrait;
    use HasAppIdTrait;
}
