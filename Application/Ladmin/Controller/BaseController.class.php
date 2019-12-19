<?php
namespace Ladmin\Controller;
use Think\Controller;
class BaseController extends Controller {

    const LENGTH = 4; //验证码的长度
    const EXPIRE = 300; //过期时间

    public function __construct()
    {
        parent::__construct();
        //获取当前用户ID
        if(defined('UID')) return ;
        define("UID",is_login());
        if( !UID ){// 还没登录 跳转到登录页面
            $this->redirect('Login/index');
        }
        // 是否是超级管理员
        define('IS_ROOT',   is_rootAdministrator());
        if(!IS_ROOT && C('ADMIN_ALLOW_IP')){
            // 检查IP地址访问
            if(!in_array(get_client_ip(),explode(',',C('ADMIN_ALLOW_IP')))){
                $this->error('403:禁止访问');
            }
        }
        $siteconfig = M("Websiteconfig")->find();
        $user_info = session('admin_auth');
        if($siteconfig['admin_alone_login']) {//只允许同时一处登录
            $session_random = M('Admin')->where(['id' => $user_info['uid']])->getField('session_random');
            if($session_random && $session_random !=  $user_info['session_random']) {
                session('admin_auth', null);
                session('google_auth', null);
                session("admin_auth_sign", null);
                $this->error('您的账号在别处登录，如非本人操作，请立即修改登录密码！','/' . C("LOGINNAME"));
            }
        }
        //权限检查
        $name = CONTROLLER_NAME . '/' . ACTION_NAME;        //Index  /  index
        if(CONTROLLER_NAME != 'Login' && !IS_ROOT && $name =='index/main'  && $name!="System/editPassword" && $name!="Auth/google"){
            $auth = new Auth();
            $auth_result = $auth->check($name, $user_info['uid']);
            if($auth_result === false){
                if(IS_AJAX){
                    $this->error('没有权限3!');
                }else{
                    $this->error('没有权限4!');
                }
            }
        }

        $groupIds = M('MemberAgentCate')->select();
        $tempGroupId = [];
        foreach ($groupIds as $k => $v) {

            $tempGroupId[$v['id']] = $v['cate_name'];
        }

        $this->groupId = $tempGroupId;

        //获取用户的代理等级信息
        $this->assign('groupId',$this->groupId);
        //左侧菜单栏
        $admin_auth_group_access_model = D('AdminAuthGroupAccess');
        $navmenus = $admin_auth_group_access_model->getUserRules($user_info['uid']);
        $this->assign('navmenus', $navmenus);
        $this->_site = ((is_https()) ? 'https' : 'http') . '://' . C("DOMAIN") . '/';
        $this->assign('siteurl',$this->_site);
        $this->assign('sitename',C('WEB_TITLE'));
        $this->assign('member',$user_info);
        $this->assign('installpwd',md5('adminadmin'.C('DATA_AUTH_KEY')));
        $this->assign('model',C('HOUTAINAME')?C('HOUTAINAME'):MODULE_NAME);
    }
}