<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/12/19
 * Time: 3:24
 */
namespace  Ladmin\Model;
use Think\Model;

class LongModel extends Model{
    Protected $autoCheckFields = false;
    //当用户勾选记住我
    public function saveRemember($uid,$identifier,$token,$timeout){
        $admin = M('admin');
        $data['identifier'] = $identifier;
        $data['token'] = $token;
        $data['timeout'] = $timeout;
        $where = 'id = ' . $uid;
        $res = $admin->data($data)-> where($where)->save();
        return $res;
    }
    //验证用户是否永久登(记住我)
    public function checkRemember(){
        $arr = array();
        $now = time();
        list($identifier,$token) = explode(":",$_COOKIE['admin_auth']);
        if (ctype_alnum($identifier) &&  ctype_alnum($token)){
            $arr['identifier'] = $identifier;
            $arr['token'] = $token;
        }else{
            return False;
        }
        //->field('token','identifier','timeout')
        $info = M('admin')->where(['identifier' => $arr['identifier']])->getField('id,username,identifier,token,timeout');
        foreach ($info as $v){$info = $v;}
        if($info != null){
            if($arr['token'] != $info['token']){
                return false;
            }else if($now > $info['timeout']){
                return false;
            }else{
                return $info;
            }
        }else{
            return false;
        }
    }
}