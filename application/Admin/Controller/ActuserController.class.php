<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class ActuserController extends AdminbaseController{
    
	protected $user_model;

	public function _initialize() {
            parent::_initialize();
            $this->user_model = D("Common/ActUsers");   
	}
	
	// 后台广告列表
	public function index(){
            $params = I('post.');
            $params['page'] = I('get.p', 1, 'intval'); //获取页码
            $params['pageLimit'] = 20;
            $dataList = $this->user_model->userList($params);
            $page = $this->page($dataList['data']['pageInfo']['num'], $params['pageLimit']);
            $this->assign("formget", $params);
            $this->assign("page", $page->show('Admin'));
            $this->assign("dataList", $dataList['data']['list']);
            $this->display();
	}
        
        //用户详情
        public function detail() {
            $id = I('get.id', 0, 'intval');
            $dataInfo = $this->user_model->where(array("id" => $id))->find();
            $this->assign($dataInfo);
            $this->display();
        }
        
        public function  deleteInfo(){
            if(IS_POST){
                $ids = I('post.ids/a');
                if(!empty($ids)){
                    if ($this->user_model->where(array('id' => array('in', $ids)))->delete() !== false) {
                        $this->ajaxReturn(array( "status" => 200, "msg" => "操作成功！","data" => ""));
                    } else {
                        $this->ajaxReturn(array( "status" => 500, "msg" => "操作失败！","data" => ""));
                    }
                }   
            }
        }
        

}