<?php

namespace Miaoxing\Score\Controller\Admin;

class Score extends \Miaoxing\Plugin\BaseController
{
    protected $controllerName = '积分管理';

    protected $actionPermissions = [
        'index,send' => '赠送',
    ];

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

        $userList = [];
        if ($req['all'] != 'all') {
            if ($req['userlist']) {
                $userList = explode(',', $req['userlist']);
            }
        } else {
            $userCount = wei()->db->count('user', ['1' => 1]);
            $page = ceil($userCount / 1000);

            for ($i = 1; $i <= $page; ++$i) {
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
}
