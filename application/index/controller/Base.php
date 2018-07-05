<?php
namespace app\index\controller;

use think\Config;
use think\Controller;
use think\Cookie;

class Base extends Controller
{
    protected $config;
    public function __construct()
    {
        parent::__construct();
        $this->config = Config::get('setting');
        $this->assign('config', $this->config);
    }

    protected function checkLogin()
    {
        if (!Cookie::has('token')) {
            $this->error('ログインしていない', '/index/sign/in');
        } elseif (Cookie::get('token') !== md5($this->config['admin']['user'] . $this->config['admin']['password'])) {
            $this->error('認証に失敗した', '/index/sign/in');
        }
    }
}
