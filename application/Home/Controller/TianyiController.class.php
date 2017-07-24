<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class TianyiController extends HomebaseController {

    protected $TianyiOrder;
    
    public function _initialize() {
        parent::_initialize();
        $this->TianyiOrder = D("Common/TianyiOrder");
    }
    
    //首页
    public function index() {
        
    }
    
    //public function 
    public function submitOrder(){
        $rules=array(
            array('course_id','require','course_id不得为空！',1,'regex',3),
            array('user_id','require','user_id不得为空！',1,'regex',3),
            array('order_name','require','order_name不得为空！',1,'regex',3),
            array('user_name','require','user_name不得为空！',1,'regex',3),
            array('mobile','require','mobile不得为空！',1,'regex',3),
            array('course_id','require','course_id不得为空！',1,'regex',3), 
            array('money','require','money不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $dataInfo=$this->TianyiOrder->dataUpdate($this->params);
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    
    public function tianyiNotify(){
        file_put_contents('1.txt', json_encode($this->params));//打印日志
        
        header('Content-Type:application/json; charset=utf-8');
        $retData=array(
            "response"=>array(
                "code"=>0,
                "msg"=>"操作成功！",
            )
        );
        
        $retInfo= json_decode($this->params['req_data'],true);
        $orderInfo=$this->TianyiOrder->where(array("order_sn"=>$retInfo['order_no']))->find();
        if(empty($orderInfo)){
            $retData=array(
                "response"=>array(
                    "code"=>1,
                    "msg"=>"订单不存在！",
                )
            );
            exit(json_encode($retData));
        }
        
        if($retInfo['price']!=$orderInfo['total_money']*100){
            $retData=array(
                "response"=>array(
                    "code"=>2,
                    "msg"=>"订单金额校验失败！",
                )
            );
            exit(json_encode($retData));
        }
        
        $orderUpdate=array(
            "order_sn"=>$retInfo['order_no'],
            "status"=>2,
            "pay_type"=>"天翼支付"
        );
        $this->TianyiOrder->dataUpdate($orderUpdate);
        exit(json_encode($retData));
 
        //file_put_contents('1.txt', json_encode($this->params));
    }
    
}
