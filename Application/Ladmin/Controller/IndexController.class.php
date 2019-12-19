<?php
namespace Ladmin\Controller;
class IndexController extends BaseController {
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->display();
    }
    public function commit(){
        if ($_SERVER['SERVER_NAME'] != 'n.cn'){
            $shell = 'cd /www/wwwroot/NewLunXun/ && pwd && sudo git pull 2>&1';
            exec($shell,$out);
            print_r($out);
        }
    }
}