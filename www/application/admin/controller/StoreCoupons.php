<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/14
 * Time: 16:11
 *
 * 线下门店优惠券控制器
 */

namespace app\admin\controller;


class StoreCoupons extends  Base
{
    /**
     * 优惠券管理列表
     */
    public function coupons_list(){

        return $this->fetch();
    }

}