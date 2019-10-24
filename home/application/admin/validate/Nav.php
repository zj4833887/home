<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/10
 * Time: 16:15
 */

namespace app\admin\validate;


use think\Validate;

class Nav  extends Validate
{

    protected $rule=[
        'name'=>'require',
        'ename'=>'require',
        'nsort'=>'number',
        'ntpl'=>'require',
        'id'=>'number',
        'field'=>'require' ,
        'value'=>'require'
    ];
    protected $message  =   [
        'name'=>'require',
        'ename'=>'require',
        'nsort'=>'number',
        'ntpl'=>'require',
        'id'=>'number',
    ];
    protected $scene  =[
        'insert'=>['name','ename','nsort','ntpl'],
        'del'=>'id',
        'update'=>['id','value','field']
    ];

}