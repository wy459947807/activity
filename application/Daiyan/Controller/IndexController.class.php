<?php

namespace Daiyan\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class IndexController extends HomebaseController {

    protected $user_model;
   
    
    public function _initialize() {
        parent::_initialize();
        $this->user_model = D("Common/DykUsers"); 
    }
    
    //首页
    public function index() {
    	//echo "ddd";
        $this->display();
    }
    
    public function getRank(){
        $count= $this->user_model->count();
        $this->ajaxReturn(200, "成功！", array("rank"=>$count+1));
    }
    
    public function createCard(){
        
        $rules=array(
            array('name','require','name不得为空！',1,'regex',3),
            array('province','require','province不得为空！',1,'regex',3),
            array('city','require','city不得为空！',1,'regex',3),
        );
        
        $imgName=md5(time());
        $dataByte = explode(',',$this->params['card']);
        $this->params['card']="data/upload/Daiyan/".$imgName.'.jpg';
        file_put_contents($this->params['card'], base64_decode($dataByte[1]));

        $this->checkField($rules, $this->params); 
        $dataInfo = $this->user_model->dataUpdate($this->params);
        $this->ajaxReturn($dataInfo['status'], $dataInfo['msg'], $dataInfo['data']);
        
    }
    
    public function test(){
        echo phpinfo();
    }

}
