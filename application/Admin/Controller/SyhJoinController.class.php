<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SyhJoinController extends AdminbaseController{

        protected $join_model;
        
	public function _initialize() {
            parent::_initialize();
            $this->join_model = D("Common/SyhJoin");
	}
	
	// 后台测评列表
	public function index(){
            $params = I('post.');
            $params['page'] = I('get.p', 1, 'intval'); //获取页码
            $params['pageLimit'] = 20;
            $dataList = $this->join_model->dataList($params);
            $page = $this->page($dataList['data']['pageInfo']['num'], $params['pageLimit']);
            $this->assign("formget", $params);
            $this->assign("page", $page->show('Admin'));
            $this->assign("dataList", $dataList['data']['list']);
            $this->display();
	}
        
        //用户详情
        public function detail() {
            $id = I('get.id', 0, 'intval');
            $dataInfo = $this->join_model->dataDetail(array("id"=>$id));
            $this->assign($dataInfo['data']);
            $this->display();
        }
        
        
        //修改状态
        public function updateStatus() {
            if(IS_POST){
                $ids = I('post.ids/a');
                $status= I('post.status/d', 2); //获取状态
                if(!empty($ids)){
                    if ($this->join_model->where(array('id' => array('in', $ids)))->save(array('status' => $status)) !== false) {
                        $this->ajaxReturn(array( "status" => 200, "msg" => "操作成功！","data" => ""));
                    } else {
                        $this->ajaxReturn(array( "status" => 500, "msg" => "操作失败！","data" => ""));
                    }
                }   
            }
        }

}