<?php
namespace Ladmin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function __construct()
    {
        parent::__construct();
//        $this->assign();
    }

    public function index(){
        $this->checkLong();
        //已经登录则跳转后台
        if(isset($_SESSION['admin_auth'])){
            $this->redirect('Index/index');
        }else{
            //判断是否存在cookie
            if(isset($_COOKIE['username'])){
                $this->assign('username',$_COOKIE['username']);
            }
            $this->display();
        }
    }

    /**
     * 登陆处理
     */
    public function loginAction(){
        if (IS_POST){
            $username = I('post.username','','trim');
            $password = I('post.password','','trim');
            if (empty($username) || empty($password)) {
                $this->ajaxReturn(['status' => 0, 'msg' => '账号和密码不能为空！']);
            }
            if (is_sms_open()){
                $code  = I("post.code", '', 'trim');
                if (checkCode($code)){
                    $this->ajaxReturn(['status' => 0, 'msg' => '短信验证码错误']);
                }
            }
            $info = M('admin')->where(['username' => $username, 'password' => md5(C('DATA_AUTH_KEY').$password)])->find();
            if ($info){
                $ip = get_client_ip('',True);
                $juhe_city = file_get_contents('http://apis.juhe.cn/ip/ipNew?ip='.$ip.'&key=b0ddd02df308a92ddf1b8ef987f19244');
                $arrCity = json_decode($juhe_city,true);
                $city = $arrCity['resultcode'] == '200' ? $arrCity['result']['Country'].$arrCity['result']['Province'].$arrCity['result']['City'].$arrCity['result']['Isp'] : '查询失败';
                $loginIp = M('config')->getField('login_ip');
                /** 指定ip登陆*/
                if (trim($loginIp)){
                    $ipVo = explode('|',$loginIp);
                    if (!in_array($ip,$ipVo)){
                        $this->ajaxReturn(['status' => 0, 'msg' => '登录ip错误']);
                    }
                }
                $admin_log = array(
                    'uid' => $info['id'],
                    'ip' => $ip,
                    'city' => $city,
                    'login_time' => time(),
                    'type'  => 1,   //管理员登陆
                );
//                M('admin_log')->add($admin_log);
                //如果用户勾选了"记住我",则保持持久登陆
                if (I('post.remember','','trim')){
                    $salt = random_str(16);
                    //第二分身标识
                    $identifier = md5(C('DATA_AUTH_KEY') . md5($username . $salt));
                    //永久登录标识
                    $token = md5(uniqid(rand(), true));
                    //永久登录超时时间(1周)
                    $timeout = time()+3600*24*7;
                    //存入cookie
                    setcookie('admin_auth',"$identifier:$token",$timeout);
                    $Long = new \Ladmin\Model\LongModel();
                    $Long->saveRemember($info['id'],$identifier,$token,$timeout);
                    //把用户名存入cookie，退出登录后在表单保存用户名信息
                    setcookie('username',$username,time()+3600*24);
                }
                //用户信息存入session
                $admim = array(
                    'name' => $username,
                    'uid'  => $info['id'],
                    'session_random' => md5(C('DATA_AUTH_KEY') . md5($username)),
                );
                M('admin')->where(['username' => $username])->setField('session_random');
                session_regenerate_id(true);
                session('admin_auth', $admim);
                ksort($admim); //排序
                $sign = sha1(http_build_query($admim));  //url编码并生成query字符串  并加密
                session('admin_auth_sign', $sign);
                //常用地址
                $localCountry = [];
                //获取最近登录地址
                $latestLoginData = M("admin_log")->where(['uid' => $info['id'], 'type'=>1])->order('id desc')->limit(3)->select();
                $address         = @array_column((array) $latestLoginData, 'city', 'id');
                $address = @array_values($address);
                $country         = @array_map(function ($item) {
                    $adress = explode('-', $item);
                    $count = 0;
                    foreach ($adress as $v) {
                        if($v) {$count++;}
                    }
                    if($count>1) {
                        return $adress[1];
                    } else {
                        return $adress[0];
                    }
                }, $address);
                //获取数组中的重复数据
                $repeatItem = @array_unique($country);
                if ($repeatItem) {
                    //获取最近三次登录重复的地址
                    $localCountry = array_diff_assoc($country, $repeatItem);
                }
                //如果异地登录就发送邮件 通知信息
                if ($localCountry && !in_array($city, $localCountry) && $info['bindmail'] && is_mail_open()) {
                    $mailConfig = M('mail')->find();
                    $html = str_replace(['time','address'],[date('Y-m-d H:i:s'),$city],C('loginWarning'));
                    mailSend('异地登陆提醒', $info['bindmail'], $html, $mailConfig);
                }
//                $this->ajaxReturn(['status' => 200, 'msg' => '登录成功!', 'url' => U('Index/index')]);
                $this->redirect('Index/index');
            }else{
                $this->ajaxReturn(['status' => 0, 'msg' => '账号或密码错误']);
            }
        }
    }

    /**
     * 判断是否持久登录
     */
    public function checkLong(){
        $check = new \Ladmin\Model\LongModel();
        $is_long = $check->checkRemember();
        if($is_long === false){

        }else{
            $admim = array(
                'name' => $is_long['username'],
                'uid'  => $is_long['id'],
                'session_random' => md5(C('DATA_AUTH_KEY') . md5($is_long['username'])),
            );
            M('admin')->where(['username' => $username])->setField('session_random');
            session_regenerate_id(true);
            session('admin_auth', $admim);
            ksort($admim); //排序
            $sign = sha1(http_build_query($admim));  //url编码并生成query字符串  并加密
            session('admin_auth_sign', $sign);
        }
    }

    /**
     * 退出登陆
     */
    public function loginout(){
        session(null);
        setcookie('admin_auth', '', time()-1);
        $this->redirect("Login/index");
    }

    /**
     * 发送短信
     */
    public function smSend(){
        if (IS_POST){
            $mobile = M('admin')->where(['username' => $_REQUEST['username']])->getField('bindmobile');
            if (!preg_match("/^1[34578]{1}\d{9}$/", $mobile)) {
                $this->ajaxReturn(['status'=> False,'msg' => '手机号有误']);
            }
            $maxSmsNum = M('config')->where(['id' => 1])->getField('max_error_num');
            $smsNum = checkSend($mobile,$maxSmsNum);
            if ($smsNum != 999 && $smsNum < $maxSmsNum){
                $smsTemplate = M("sms_template")->field("template_code")->where(array("call_index" => 'loginSend'))->find();
                $rand = mt_rand(1000,9999);
                $session_code = array(
                    'smsCode' => $rand,
                    'sms_time' => time(),
                    'sms_sign' => substr(md5(C('DATA_AUTH_KEY').$rand),0,5)
                );
                session('sms',$session_code);
                $res = sendSMS($_POST['mobile'],$smsTemplate["template_code"],array('code' => $rand));
            }
            $this->ajaxReturn(['status'=> (int)($res) == '' ? 0 : $rand ,'msg' => (int)($res) == '' ? '发送失败,请明天重试' : '发送成功']);
        }
    }
}