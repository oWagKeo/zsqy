<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/13
 * Time: 14:29
 *
 *
 * 抽奖管理类
 */
namespace app\admin\controller;

use app\admin\model\AwardModel;

class Award extends Base
{
    /**
     * 奖品列表
     */
    public function award_list(){
        $awarModel = new AwardModel();
        $list = $awarModel->getAwardList();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 添加奖品
     */
    public function award_add(){
        if(request()->isAjax()){
            print_r($_POST);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 上传缩略图片
     */
    public function uploadImg(){
        if(request()->isAjax()){
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            if($info){
                $src =  '/upload' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    /**
     * 删除奖品
     */
    public function award_del(){
        $id = input('param.id');
        $awardModel = new AwardModel();
        $re = $awardModel->delAwardById($id);
        return json($re);
    }


}