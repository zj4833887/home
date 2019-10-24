<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2019/10/19
 * Time: 13:25
 */

namespace app\index\controller;


class Goods extends Base
{
    public function goods(){
    return $this->fetch();
}

}