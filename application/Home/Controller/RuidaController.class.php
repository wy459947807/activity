<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class RuidaController extends HomebaseController {

  
    protected $RuidaAppoint;
    
    public function _initialize() {
        parent::_initialize();
        $this->RuidaAppoint = D("Common/RuidaAppoint");
    }
    
    //首页
    public function index() {
        
    }
    
    //提交报名
    public function submitSign(){
        $rules=array(
            array('name','require','姓名不得为空！',1,'regex',3),
            array('mobile','require','手机不得为空！',1,'regex',3),
            array('mobile','/^1[34578]\d{9}$/','手机格式不正确！',1,'regex',3),
            array('province','require','省份不得为空！',1,'regex',3),
            array('city','require','城市不得为空！',1,'regex',3),
            array('address','require','详细地址不得为空！',1,'regex',3),
            
        );
        $this->checkField($rules, $this->params); 
        
        if(!sp_check_verify_code()){
            $this->ajaxReturn(500,"验证码错误！",array());
        }
        unset($this->params['verify']);
        $dataInfo=$this->RuidaAppoint->dataUpdate($this->params);
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
        
    }
    
    //区域筛选
    public function areaList(){
        $url="http://www.rdqh.com/content/ajax_linkage";
        $rules=array(
            array('hidetop','require','hidetop不得为空！',1,'regex',3),
            array('id','require','id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params); 
        $dataInfo = http_Post($this->params, $url);
        exit($dataInfo);
    }

}
