<?php
namespace app\index\controller;

use \ConohaDns;

class Index extends Base
{
    private $conohaDns;

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->conohaDns = new ConohaDns($this->config['conoha']['username'], $this->config['conoha']['password'], $this->config['conoha']['tenant_id']);
    }

    public function index()
    {
        $domain      = $this->request->get('domain') ?? null;
        $domain_list = $this->conohaDns->domainList($domain);
        if (empty($domain_list)) {
            $this->error('Conohaは何のデータに戻りませんでした');
        }
        $this->assign('d_list', $domain_list);
        return $this->fetch();
    }

    public function add()
    {
        $domain = $this->request->post('domain');
        $ttl    = intval($this->request->post('ttl')) ?? 300;
        $email  = $this->request->post('email');

        if (empty($domain) || empty($email)) {
            $this->error('ドメインまたはポストエラー');
        }
        $return = $this->conohaDns->domainCreate($domain, $ttl, $email);
        if (!$return) {
            $this->error("追加失敗した({$this->conohaDns->getError()})");
        }
        $this->success('追加成功した');
    }
}
