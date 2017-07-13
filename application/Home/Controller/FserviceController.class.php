<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class FserviceController extends HomebaseController {

   protected $contact_model;
    
    public function _initialize() {
        parent::_initialize();
        $this->contact_model = D("Common/FscContact"); 
    }
    
    //首页
    public function submitJoin() {

        $rules = array(
            array('mobile', 'require', '手机不得为空！', 1, 'regex', 3),
            array('mobile','/^1[34578]\d{9}$/','手机格式不正确！',1,'regex',3), 
        );
        $this->checkField($rules, $this->params);
        $dataInfo = $this->contact_model->dataUpdate($this->params); //提交评测结果
        $this->ajaxReturn($dataInfo['status'], "提交成功！", $dataInfo['data']);
        
    }
    
    
}
