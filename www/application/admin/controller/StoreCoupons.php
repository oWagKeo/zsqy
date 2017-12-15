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

use app\admin\model\CouponsModel;

class Storecoupons extends  Base
{
    /**
     * 优惠券管理列表
     */
    public function coupons_list(){

        $where = array();
        if( !empty($_GET['name']) ){
            $where['name'] = ['like','%'.trim($_GET['name']).'%'];
        }
        $model = new CouponsModel();
        $list = $model->getCouponsList($where);

        $this->assign('list',$list);
        $this->assign('get',$_GET);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function coupons_edit(){
        $cModel = new CouponsModel();

        if( request()->isAjax() ){
            $data = [
                'name' => input('param.name'),
                'desc' => input('param.desc'),
                'thumd' => input('param.thumd'),
                'start_time' => strtotime(input('param.start_time')),
                'end_time' => strtotime(input('param.end_time')),
                'status' => input('param.status'),
                'user_id' => session('id')
            ];
            $re = $cModel->editCouponsById(input('param.id'),$data);
            return json($re);
        }else{
            $id = input('param.id');
            $info = $cModel->getCouponsById( $id );
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    /**
     * 增加优惠券
     */
    public function coupons_add(){

        if(request()->isAjax()){
            $cModel = new CouponsModel();
            $data = [
                'name' => input('param.name'),
                'desc' => input('param.desc'),
                'thumd' => input('param.thumd'),
                'start_time' => strtotime(input('param.start_time')),
                'end_time' => strtotime(input('param.end_time')),
                'add_time' => time(),
                'status' => input('param.status'),
                'user_id' => session('id')
            ];
            $re = $cModel->insertCoupons($data);
            return json($re);
        }else{
            return $this->fetch();
        }
        return $this->fetch();
    }

    /**
     * 优惠券删除
     */
    public function coupons_del(){
        $id = input('param.id');
        $awardModel = new CouponsModel();
        $re = $awardModel->delCouponsById($id);
        return json($re);
    }


    /**
     * 上传缩略图片
     */
    public function uploadImg(){
        if(request()->isAjax()){
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload' . DS . '/coupons');
            if($info){
                $src =  '/upload/coupons' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

}