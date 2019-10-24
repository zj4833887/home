<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/11
 * Time: 21:36
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Clas extends Base
{
    public function  _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }
    public function index (){
        return $this->fetch();
    }
//    展示插入页面
//    展示插入页面
    public function open (){
        return view();
    }
   public function insert()
{
    $data=input('post.');
    $result=Db::table('cateselect')->insert($data);
    if ($result>0){
        return json(['code'=>200,'msg'=>'插入成功']);
    }
    else{
        return json(['code'=>404,'msg'=>'插入失败']);
    }
}
    public function query(){
        $result=Db::table('cateselect')->select();
        $count=Db::table('cateselect')->count();
//        var_dump($result);
//        $length=$result.length;
//        var_dump($result);
        return json([
            'code'=>0,
            'msg'=>'success',
            'data'=>$result,
            'count'=>$count,
        ]);
    }
//删除开始
    public function delete(){
//        $del=Db::table('navlnsert')->delete();
        if (!$this->request->isPost()){
            return json(['code'=>404,'msg'=>'请求失败']);
        }
//        验证规则
        $data=input('post.');
        $validate = validate('Nav');
        if (!$validate->scene('del')->check($data))
        {
            return json(['code'=>404,'msg'=>$validate->getError()]);
        };
        $result= Db::name('cateselect')	->where('id',	$data['id'])->delete();
        if ($result>0){
            return json(['code'=>200,'msg'=>'删除成功']);
        }
        else{
            return json(['code'=>404,'msg'=>'删除失败']);
        }
    }
//    修改开始
    public function add(){
        if (!$this->request->isPost()){
            return json(['code'=>404,'msg'=>'请求失败']);
        }
//        验证规则
        $data=input('post.');
        $validate = validate('Nav');
        if (!$validate->scene('update')->check($data))
        {
            return json(['code'=>404,'msg'=>$validate->getError()]);
        };
//        $del=Db::table('navlnsert')->delete();
        $id=input('post.id');
        $value=input('post.value');
        $field=input('post.field');
        $result= Db::name('cateselect')->where('id',$id)	->update([$field=>$value]);
        if ($result>0){
            return json(['code'=>200,'msg'=>'修改成功']);
        }
        else{
            return json(['code'=>404,'msg'=>'修改失败']);
        }
    }
}