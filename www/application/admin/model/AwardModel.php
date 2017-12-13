<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/13
 * Time: 14:57
 *
 * 奖品model类
 */
namespace app\admin\model;

use think\Model;

class AwardModel extends Model
{
    // 确定链接表名
    protected $table = 'zs_award';

    /**
     * 获取奖品列表
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getAwardList(){
        return $this->field($this->table . '.*,user_name')
            ->join('zs_user', $this->table . '.user_id = ' . 'zs_user.id','LEFT')
            ->order('id desc')->select();
    }

    /**
     * 删除奖品
     *
     * @param $id
     * @return array
     */
    public function delAwardById( $id ){
        try{
            $this->where('id',$id)->delete();
            return msg(1, '', '删除成功！');
        }catch( PDOException $e ){
            return msg(-1, '', $e->getMessage());
        }
    }


}