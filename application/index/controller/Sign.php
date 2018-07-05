<?php
namespace app\index\controller;

use think\Cookie;

class Sign extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function in()
    {
        if ($this->request->isPost()) {
            $token = md5($this->request->post('username') . $this->request->post('password'));
            $user  = md5($this->config['admin']['user'] . $this->config['admin']['password']);
            if ($token !== $user) {
                $this->error('ユーザ名またはパスワードのエラー');
            }
            Cookie::set('token', $token);
            $this->success('ログイン成功した', '/index/index/index');
        }
        return $this->fetch();
    }

    public function outAction()
    {

    }

    // public function logAction()
    // {

    // }
}
