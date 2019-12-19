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
            foreach ($out as $v){
                if (strstr($v,'error')){
                    $shell_pro = "git stash && git pull && git stash pop";
                    exec($shell_pro,$our_pro);
                    echo '<pre>';
                    print_r($out);
                }
            }
        }else{
            $out = Array(
                [0] => "/www/wwwroot/NewLunXun ",
                [1] => "From https://github.com/ninging123/NewLunxun ",
                [2] => "03bed86..90fbcbc master -> origin/master ",
                [3] => "error: Your local changes to the following files would be overwritten by merge: ",
                [4] => "Application/Common/Conf/config.php ",
                [5] => "Application/Ladmin/Common/function.php ",
                [6] => "Application/Ladmin/Controller/BaseController.class.php ",
                [7] => "Application/Ladmin/Controller/LoginController.class.php ",
                [8] => "Application/Ladmin/Model/LongModel.class.php ",
                [9] => "Application/Ladmin/View/Login/index.html ",
                [10] => "Please, commit your changes or stash them before you can merge. ",
                [11] => "Aborting ",
                [12] => "Updating 03bed86..90fbcbc"
            );
            foreach ($out as $v){
                if (strstr($v,'error')){
                    $shell_pro = "git stash && git pull && git stash pop";
                    exec($shell_pro,$our_pro);
                    echo '<pre>';
                    print_r($out);
                }
            }
        }
    }
}