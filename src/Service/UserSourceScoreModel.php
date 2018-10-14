<?php

namespace Miaoxing\Score\Service;

use Miaoxing\Plugin\BaseModelV2;
use Miaoxing\Plugin\Model\HasAppIdTrait;
use Miaoxing\Score\Metadata\UserSourceScoreTrait;

/**
 * UserSourceScoreModel
 */
class UserSourceScoreModel extends BaseModelV2
{
    use UserSourceScoreTrait;
    use HasAppIdTrait;
}
