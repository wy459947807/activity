<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class ActsubjectController extends AdminbaseController{
    
	
        protected $subject_model;
        protected $question_model;
	
	public function _initialize() {
            parent::_initialize();
            $this->subject_model = D("Common/ActSubject");
            $this->question_model = D("Common/ActQuestion");
	}
	
	// 后台问题列表
	public function index(){
            $params = I('post.');
            $params['page'] = I('get.p', 1, 'intval'); //获取页码
            $params['pageLimit'] = 20;
            $dataList = $this->subject_model->dataList($params);
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
                //$params['detail'] = htmlspecialchars_decode($params['detail']);
                
                //选择项处理
                if(!empty($params['options'])){
                    $optionArray=array();
                    foreach ($params['options']['type'] as $key=>$val){
                        $optionArray[$key]["type"]=$val;
                        $optionArray[$key]["name"]=$params['options']['name'][$key];
                        $optionArray[$key]["score"]=$params['options']['score'][$key];
                    }
                    $params['options']= serialize($optionArray);
                }

                $retInfo = $this->subject_model->dataUpdate($params);
                $this->ajaxReturn($retInfo);
            } else {
                $id = I('get.id', 0, 'intval');
                $dataInfo = $this->subject_model->where(array("id" => $id))->find();
                if(!empty($dataInfo['options'])){
                    $dataInfo['options']= unserialize($dataInfo['options']);
                }
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
                    if ($this->subject_model->where(array('id' => array('in', $ids)))->delete() !== false) {
                        $this->ajaxReturn(array( "status" => 200, "msg" => "操作成功！","data" => ""));
                    } else {
                        $this->ajaxReturn(array( "status" => 500, "msg" => "操作失败！","data" => ""));
                    }
                }   
            }
        }

	
	
	
	
}