<?php

namespace plugins\score\docs {

    use Miaoxing\Score\Service\ScoreLog;
    use Miaoxing\Score\Service\ScoreLogRecord;
    use Miaoxing\Score\Service\ScoreMonthlyStat;
    use Miaoxing\Score\Service\ScoreMonthlyStatRecord;

    /**
     * @property    \Miaoxing\Score\Service\Score $score 积分
     * @method      \Miaoxing\Score\Service\Score|\Miaoxing\Score\Service\Score[] score()
     *
     * @property    ScoreLog $scoreLog 积分日志
     *
     * @property    ScoreLogRecord $scoreLogRecord 积分日志模型
     * @method      ScoreLogRecord|ScoreLogRecord[] scoreLogRecord()
     *
     * @property    ScoreMonthlyStat $scoreMonthlyStat 积分每月统计
     * @method      ScoreMonthlyStatRecord|ScoreMonthlyStatRecord[] scoreMonthlyStat()
     */
    class AutoComplete
    {
    }
}

namespace {

    /**
     * @return \plugins\score\docs\AutoComplete
     */
    function wei()
    {
    }
}
