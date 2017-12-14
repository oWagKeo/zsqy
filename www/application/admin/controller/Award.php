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
        $this->assign('type',array('1'=>'虚拟','2'=>'实物'));
        return $this->fetch();
    }

    /**
     * 编辑奖品
     */
    public function award_edit(){
        $awModel = new AwardModel();
        if( request()->isAjax() ){
            $where['id']  = ['neq',input('param.id')];
            $sum = $awModel->getChanceSum($where);
            if( $sum + intval( input('param.chance') )>10000){
                return json(msg(-1, '', '概率和应小于10000'));
            }
            $data = [
                'name' => input('param.name'),
                'desc' => input('param.desc'),
                'thumd' => input('param.thumd'),
                'type' => input('param.type'),
                'num' => input('param.num'),
                'chance' => input('param.chance'),
                'api_id' => input('param.api_id'),
                'update_time' => time(),
                'user_id' => session('id')
            ];
            $re = $awModel->editAwardById(input('param.id'),$data);
            return json($re);
        }else{
            $id = input('param.id');
            $info = $awModel->getAwardById( $id );
            $this->assign('type',array('1'=>'虚拟','2'=>'实物'));
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 添加奖品
     */
    public function award_add(){
        if(request()->isAjax()){
            $awModel = new AwardModel();
            $sum = $awModel->getChanceSum();
            if( $sum + intval( input('param.chance') )>10000){
                return json(msg(-1, '', '概率和应小于10000'));
            }
            $data = [
                'name' => input('param.name'),
                'desc' => input('param.desc'),
                'thumd' => input('param.thumd'),
                'type' => input('param.type'),
                'num' => input('param.num'),
                'chance' => input('param.chance'),
                'api_id' => input('param.api_id'),
                'add_time' => time(),
                'update_time' => time(),
                'user_id' => session('id')
            ];
            $re = $awModel->insertAward($data);
            return json($re);
        }else{
            $this->assign('type',array('1'=>'虚拟','2'=>'实物'));
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
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload' . DS . '/award');
            if($info){
                $src =  '/upload/award' . '/' . date('Ymd') . '/' . $info->getFilename();
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