<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/12
 * Time: 14:21
 */

namespace app\admin\model;


use think\Model;

class MemberModel extends Model
{
    // 确定链接表名
    protected $table = 'zs_member';

    /**
     * @param null $where
     * @param string $feild
     * @param string $order
     * @param string $page
     * @return \think\Paginator
     * 获取会员列表
     */
    public function getMemberList($where = null , $feild = '*',$order = 'id desc',$page = '15'){
       return  $this->where( $where )->field($feild)->order($order)->paginate($page);
    }

}