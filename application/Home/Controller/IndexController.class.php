<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class IndexController extends HomebaseController {

    protected $user_model;
    protected $answerer_model;
    protected $question_model;
    protected $subject_model;
    
    public function _initialize() {
        parent::_initialize();
        $this->user_model = D("Common/ActUsers"); 
        $this->answerer_model = D("Common/ActAnswerer");
        $this->question_model = D("Common/ActQuestion");
        $this->subject_model = D("Common/ActSubject");
    }
    
    //首页
    public function index() {
    	//echo "ddd";
        $this->display();
    }
    
    //获取单个问题
    public function getQuestion(){
        $rules=array(
            array('id','require','id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        
        $dataInfo= $this->question_model->where(array("id"=>$this->params['id']))->find();//查询登录用户
        if(empty($dataInfo)){
           $this->ajaxReturn(500,"问题不存在！",""); 
        }
        $this->ajaxReturn(200,"成功！",$dataInfo);
    }
    
    //获取题目列表
    public function getSubject(){
        $rules=array(
            array('question_id','require','question_id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $this->params['pageLimit']=100;
        $dataInfo= $this->subject_model->dataList($this->params);//查询登录用户
        if(empty($dataInfo)){
           $this->ajaxReturn(500,"问题不存在！",""); 
        }
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    //提交测试结果
    public function submitAnswer(){
        $rules=array(
            array('question_id','require','question_id不得为空！',1,'regex',3),
            array('user_id','require','user_id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $dataInfo= $this->answerer_model->submitAnswer($this->params);//提交评测结果
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    //提交测试结果
    public function retAnswer(){
        $rules=array(
            array('user_id','require','user_id不得为空！',1,'regex',3),
            array('real_name','require','real_name不得为空！',1,'regex',3),
            array('mobile','require','mobile不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $dataInfo= $this->answerer_model->submitAnswer($this->params);//提交评测结果
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    
    
    //获取用户测评结果
    public function getResult(){
        $rules=array(
            array('user_id','require','user_id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $dataInfo= $this->answerer_model->dataDetail($this->params);//提交评测结果
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
}
