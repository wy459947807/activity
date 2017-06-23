<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class ActresultController extends AdminbaseController{
    
	
        protected $result_model;
        protected $question_model;
	
	public function _initialize() {
            parent::_initialize();
            $this->result_model = D("Common/ActResult");  
            $this->question_model = D("Common/ActQuestion");
	}
	
	// 后台问题列表
	public function index(){
            $params = I('post.');
            $params['page'] = I('get.p', 1, 'intval'); //获取页码
            $params['pageLimit'] = 20;
            $dataList = $this->result_model->dataList($params);
            $page = $this->page($dataList['data']['pageInfo']['num'], $params['pageLimit']);
            $questionList=$this->question_model->where(array("status"=>1))->select();
            $this->assign("questionList", $questionList);
            $this->assign("formget", $params);
            $this->assign("page", $page->show('Admin'));
            $this->assign("dataList", $dataList['data']['list']);
            $this->display();
	}
        
        //添加/更新问题
        public function update() {
            if (IS_POST) {
                $params = I('post.');  
                $retInfo = $this->result_model->dataUpdate($params);
                $this->ajaxReturn($retInfo);
            } else {
                $id = I('get.id', 0, 'intval');
                $dataInfo = $this->result_model->where(array("id" => $id))->find();
                $questionList=$this->question_model->where(array("status"=>1))->select();
                $this->assign("questionList", $questionList);
                $this->assign($dataInfo);
                $this->display();
            }
        }
        
        public function  deleteInfo(){
            if(IS_POST){
                $ids = I('post.ids/a');
                if(!empty($ids)){
                    if ($this->result_model->where(array('id' => array('in', $ids)))->delete() !== false) {
                        $this->ajaxReturn(array( "status" => 200, "msg" => "操作成功！","data" => ""));
                    } else {
                        $this->ajaxReturn(array( "status" => 500, "msg" => "操作失败！","data" => ""));
                    }
                }   
            }
        }

	
	
	
	
}