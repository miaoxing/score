<?php

namespace Miaoxing\Score\Job;

use Miaoxing\Queue\Job;
use Miaoxing\Queue\Service\BaseJob;

class PostScoreChange extends Job
{
    public function __invoke(BaseJob $job, $data)
    {
        wei()->event->trigger('asyncPostScoreChange', [$data]);

        $job->delete();
    }
}
