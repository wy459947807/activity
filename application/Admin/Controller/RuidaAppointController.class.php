<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class RuidaAppointController extends AdminbaseController{
    
	
        protected $RuidaAppoint;
	
	public function _initialize() {
            parent::_initialize();
            $this->RuidaAppoint = D("Common/RuidaAppoint");
               
	}
	
	// 后台问题列表
	public function index(){
            $params = I('post.');
            $params['page'] = I('get.p', 1, 'intval'); //获取页码
            $params['pageLimit'] = 20;
            $dataList = $this->RuidaAppoint->dataList($params);
            $page = $this->page($dataList['data']['pageInfo']['num'], $params['pageLimit']);
            $this->assign("formget", $params);
            $this->assign("page", $page->show('Admin'));
            $this->assign("dataList", $dataList['data']['list']);
            $this->display();
	}
        
        //添加/更新问题
        public function update() {
            if (IS_POST) {
                $params = I('post.');  
                //$params['intro'] = htmlspecialchars_decode($params['intro']);
                //$params['detail'] = htmlspecialchars_decode($params['detail']);
                $retInfo = $this->RuidaAppoint->dataUpdate($params);
                $this->ajaxReturn($retInfo);
            } else {
                $id = I('get.id', 0, 'intval');
                $dataInfo = $this->RuidaAppoint->where(array("id" => $id))->find();
                $this->assign($dataInfo);
                $this->display();
            }
        }
        
        public function detail() {
            $id = I('get.id', 0, 'intval');
            $dataInfo = $this->RuidaAppoint->where(array("id" => $id))->find();
            $this->assign($dataInfo);
            $this->display();
        }
        
        
        //删除
        public function  deleteInfo(){
            if(IS_POST){
                $ids = I('post.ids/a');
                if(!empty($ids)){
                    if ($this->RuidaAppoint->where(array('id' => array('in', $ids)))->delete() !== false) {
                        $this->ajaxReturn(array( "status" => 200, "msg" => "操作成功！","data" => ""));
                    } else {
                        $this->ajaxReturn(array( "status" => 500, "msg" => "操作失败！","data" => ""));
                    }
                }   
            }
        }
	
        //更新状态
        public function updateStatus() {
            if(IS_POST){
                $ids = I('post.ids/a');
                $status= I('post.status/d', 2); //获取状态
                if(!empty($ids)){
                    if ($this->RuidaAppoint->where(array('id' => array('in', $ids)))->save(array('status' => $status)) !== false) {
                        $this->ajaxReturn(array( "status" => 200, "msg" => "操作成功！","data" => ""));
                    } else {
                        $this->ajaxReturn(array( "status" => 500, "msg" => "操作失败！","data" => ""));
                    }
                }   
            }
        }
	
	
	
}