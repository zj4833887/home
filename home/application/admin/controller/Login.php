<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/9
 * Time: 9:41
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Session;

class Login
{
    public function index()
{
    return view();

}
    public function check()
    {
        if (!request()->isPost()){
            return json([
                'code'=>404,
                'msg'=>'请求方式不正确',
            ]);
        }
            $data=input('post.');
        if(!captcha_check($data['code'])){
            //验证失败
            return json(['code'=>404,'msg'=>'验证码输入错误']);
        };
//            var_dump($data);
            $username = $data['username'];
            $password=crypt($data['password'],md5($data['password']));
            $result= Db::name('login')	->where(['username'=>$username,'password'=>$password])->find();
            if ($result>0){
                Session::set('username',$result);
                return json(['code'=>200,'msg'=>'登录成功']);
            }
            else{
                return json(['code'=>404,'msg'=>'登录失败']);
            }

    }
}
//session_start();
//$_session['name']='zhangsan';
//$_session=[];