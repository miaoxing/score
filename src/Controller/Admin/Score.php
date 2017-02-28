<?php

namespace Miaoxing\Score\Controller\Admin;

class Score extends \miaoxing\plugin\BaseController
{
    public function indexAction($req)
    {
        return get_defined_vars();
    }

    /**
     * 后台赠送积分
     * @param $req
     * @return $this
     */
    public function sendAction($req)
    {
        if (!$req['score']) {
            return $this->err('请输入积分');
        }

        $userList = array();
        if ($req['all'] != 'all') {
            if ($req['userlist']) {
                $userList = explode(',', $req['userlist']);
            }
        } else {
            $userCount = wei()->db->count('user', array('1' => 1));
            $page = ceil($userCount / 1000);

            for ($i = 1; $i <= $page; $i++) {
                $result = wei()->user()->select('id')->limit(1000)->page($i)->fetchAll();
                if ($result) {
                    foreach ($result as $key => $value) {
                        $userList[] = $value['id'];
                    }
                }
            }
        }
        if (empty($userList)) {
            return $this->err('未选中用户,请重新选择');
        }

        foreach ($userList as $userId) {
            $user = wei()->user()->findOrInitById($userId);
            wei()->score->changeScore($req['score'], $req['remark'], $user);
        }

        return $this->suc('赠送成功');
    }

    public function dataAction($req)
    {
        $addSql = wei()->db('scoreHistory')->select('sum(score) as addScore')->where('score>?', 0);
        $cutSql = wei()->db('scoreHistory')->select('sum(score) as cutTotal')->where('score<?', 0);
        $dayAddSql = 'select sum(score) as score, left(createTime, 10) as sDate from scoreHistory where score>0 ';
        $dayCutSql = 'select sum(score) as score, left(createTime, 10) as sDate from scoreHistory where score<0 ';
        if ($req['startTime']) {
            $addSql = $addSql->andWhere('createTime>=?', $req['startTime']);
            $cutSql = $cutSql->andWhere('createTime>=?', $req['startTime']);
            $dayAddSql .= "and createTime>='{$req['startTime']}' ";
            $dayCutSql .= "and createTime>='{$req['startTime']}' ";
        }
        if ($req['endTime']) {
            $addSql = $addSql->andWhere('createTime<=?', $req['endTime']);
            $cutSql = $cutSql->andWhere('createTime<=?', $req['endTime']);
            $dayAddSql .= "and createTime<='{$req['endTime']}' ";
            $dayCutSql .= "and createTime<='{$req['endTime']}' ";
        }
        $dayAddSql .= 'group by sDate';
        $dayCutSql .= 'group by sDate';

        //+的总积分
        $addTotal = $addSql->fetch();
        $addTotal = $addTotal['addScore'];

        //-的总积分
        $cutTotal = $cutSql->fetch();
        $cutTotal = abs($cutTotal['cutTotal']);

        //每天的积分增加情况
        $addDay = wei()->db->query($dayAddSql)->fetchAll();
        $cutDay = wei()->db->query($dayCutSql)->fetchAll();
        $date = array();
        foreach ($addDay as $key => $value) {
            $date[] = substr($value['sDate'], 5);
        }
        foreach ($cutDay as $key => $value) {
            $tDate = substr($value['sDate'], 5);
            if (!in_array($tDate, $date)) {
                $date[] = $tDate;
            }
        }
        sort($date);
        $addArray = array();
        $cutArray = array();
        foreach ($date as $key => $value) {
            $addArray[] = 0;
            $cutArray[] = 0;
        }

        foreach ($addDay as $key => $value) {
            $tDate = substr($value['sDate'], 5);
            $keys = array_keys($date, $tDate);
            $addArray[$keys[0]] = (int)$value['score'];
        }

        foreach ($cutDay as $key => $value) {
            $tDate = substr($value['sDate'], 5);
            $keys = array_keys($date, $tDate);
            $cutArray[$keys[0]] = abs($value['score']);
        }
        return get_defined_vars();
    }
}
