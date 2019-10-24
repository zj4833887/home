<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/11
 * Time: 11:07
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Goods extends Base
{
    public function  _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }
    public function open()
    {
        $cate=Db::table('cateselect')->select();
        $this->assign('cates',$cate);
        return $this->fetch();
    }
    public function index(){
        $cate=Db::table('cateselect')->select();
        $this->assign('cates',$cate);
        return $this->fetch();
    }

    public function insert()
    {
        $fieldta=input('post.');
        $fieldta['create_time']=date('Y-m-d h:m:s');
        $result=Db::table('goods')->insert($fieldta);

        if ($result>0){
            return json(['code'=>200,'msg'=>'插入成功']);
        }
        else{
            return json(['code'=>404,'msg'=>'插入失败']);
        }
    }
//    public function  sc(){
//        $result=Db::table('goods')->select();
//        $count=Db::table('goods')->count();
//        return json([
////            'code'=> 0,
////            'msg'=>success
////            'data'=> {[("src": "http://cdn.layui.com/123.jpg")]},
//    ]);
//}
    public function query(){

        $qs=$this->request->get();
//        搜索条件：点击搜索按钮
//        cid 传 ||有值
        $where="";
        if (count($qs)>2){
            $field=$qs['field'];
//
            if ($field['cid']){
                $where='cid='.$field['cid'];
            }
            if ($field['price_max']&&$field['price_min']){
               if($where){
                   $where.=" and sele between ".$field['price_max']." and ".$field['price_min'];
               }else{
                   $where.="sele between ".$field['price_max']." and ".$field['price_min'];
               }
            }
            if ($field['gname']){
                if($where){
                    $where.=' and gname like "%'.$field['gname'].'%"';
                }else{
                    $where.='gname like "%'.$field['gname'].'%"';
                }
            }
        }
        $page=$qs['page'];
        $limit=$qs['limit'];
//        $offset=($page->1)*$limit;
        $result=Db::table('goods')->order('id','desc')->select();
        $count=Db::table('goods')->where($where)->count();
        $fieldta=Db::table('goods')->where($where)->page($page,$limit)->select();
//        var_dump($result);
//        $length=$result.length;
//        var_dump($result);
        return json([
            'code'=>0,
            'msg'=>'success',
            'data'=>$fieldta,
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
        $fieldta=input('post.');
        $validate = validate('Nav');
        if (!$validate->scene('del')->check($fieldta))
        {
            return json(['code'=>404,'msg'=>$validate->getError()]);
        };
        $result= Db::name('goods')	->where('id',	$fieldta['id'])->delete();
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
        $fieldta=input('post.');
        $validate = validate('Nav');
        if (!$validate->scene('update')->check($fieldta))
        {
            return json(['code'=>404,'msg'=>$validate->getError()]);
        };
//        $del=Db::table('navlnsert')->delete();
        $id=input('post.id');
        $value=input('post.value');
        $field=input('post.field');
        $result= Db::name('goods')->where('id',$id)	->update([$field=>$value]);
        if ($result>0){
            return json(['code'=>200,'msg'=>'修改成功']);
        }
        else{
            return json(['code'=>404,'msg'=>'修改失败']);
        }
    }

}