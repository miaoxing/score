<?php

namespace MiaoxingDoc\Score {

    /**
     * @property    \Miaoxing\Score\Service\Score $score
     * @method      \Miaoxing\Score\Service\Score|\Miaoxing\Score\Service\Score[] score()
     *
     * @property    \Miaoxing\Score\Service\ScoreLog $scoreLog
     * @method      mixed scoreLog()
     *
     * @property    \Miaoxing\Score\Service\ScoreLogModel $scoreLogModel ScoreLogModel
     * @method      \Miaoxing\Score\Service\ScoreLogModel|\Miaoxing\Score\Service\ScoreLogModel[] scoreLogModel()
     *
     * @property    \Miaoxing\Score\Service\ScoreLogRecord $scoreLogRecord
     * @method      \Miaoxing\Score\Service\ScoreLogRecord|\Miaoxing\Score\Service\ScoreLogRecord[] scoreLogRecord()
     *
     * @property    \Miaoxing\Score\Service\ScoreMonthlyStat $scoreMonthlyStat
     * @method      mixed scoreMonthlyStat()
     *
     * @property    \Miaoxing\Score\Service\ScoreMonthlyStatRecord $scoreMonthlyStatRecord
     * @method      \Miaoxing\Score\Service\ScoreMonthlyStatRecord|\Miaoxing\Score\Service\ScoreMonthlyStatRecord[] scoreMonthlyStatRecord()
     *
     * @property    \Miaoxing\Score\Service\UserScoreModel $userScoreModel UserScoreModel
     * @method      \Miaoxing\Score\Service\UserScoreModel|\Miaoxing\Score\Service\UserScoreModel[] userScoreModel()
     *
     * @property    \Miaoxing\Score\Service\UserSourceScoreModel $userSourceScoreModel UserSourceScoreModel
     * @method      \Miaoxing\Score\Service\UserSourceScoreModel|\Miaoxing\Score\Service\UserSourceScoreModel[] userSourceScoreModel()
     */
    class AutoComplete
    {
    }
}

namespace {

    /**
     * @return MiaoxingDoc\Score\AutoComplete
     */
    function wei()
    {
    }

    /** @var Miaoxing\Score\Service\Score $score */
    $score = wei()->score;

    /** @var Miaoxing\Score\Service\ScoreLog $scoreLog */
    $scoreLog = wei()->scoreLog;

    /** @var Miaoxing\Score\Service\ScoreLogModel $scoreLogModel */
    $scoreLog = wei()->scoreLogModel();

    /** @var Miaoxing\Score\Service\ScoreLogModel|Miaoxing\Score\Service\ScoreLogModel[] $scoreLogModels */
    $scoreLogs = wei()->scoreLogModel();

    /** @var Miaoxing\Score\Service\ScoreLogRecord $scoreLogRecord */
    $scoreLogRecord = wei()->scoreLogRecord;

    /** @var Miaoxing\Score\Service\ScoreMonthlyStat $scoreMonthlyStat */
    $scoreMonthlyStat = wei()->scoreMonthlyStat;

    /** @var Miaoxing\Score\Service\ScoreMonthlyStatRecord $scoreMonthlyStatRecord */
    $scoreMonthlyStatRecord = wei()->scoreMonthlyStatRecord;

    /** @var Miaoxing\Score\Service\UserScoreModel $userScoreModel */
    $userScore = wei()->userScoreModel();

    /** @var Miaoxing\Score\Service\UserScoreModel|Miaoxing\Score\Service\UserScoreModel[] $userScoreModels */
    $userScores = wei()->userScoreModel();

    /** @var Miaoxing\Score\Service\UserSourceScoreModel $userSourceScoreModel */
    $userSourceScore = wei()->userSourceScoreModel();

    /** @var Miaoxing\Score\Service\UserSourceScoreModel|Miaoxing\Score\Service\UserSourceScoreModel[] $userSourceScoreModels */
    $userSourceScores = wei()->userSourceScoreModel();
}
