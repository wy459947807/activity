<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class MiguController extends HomebaseController {

    protected $MiguTicket;
    protected $MiguTicketSend;
    protected $MiguSubscribe;
    
    public function _initialize() {
        parent::_initialize();
        $this->MiguTicket = D("Common/MiguTicket");
        $this->MiguTicketSend = D("Common/MiguTicketSend");
        $this->MiguSubscribe = D("Common/MiguSubscribe");
    }
    
    //首页
    public function index() {
        
    }
    
    //获取优惠券列表
    public function getTickets(){
        $dataInfo=$this->MiguTicket->dataList($this->params);
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    //获取用户的优惠券列表
    public function getUserTickets(){
        $rules=array(
            array('mobile','require','mobile不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $this->MiguTicketSend->ticketSend($this->params); //更新优惠券
        $dataInfo=$this->MiguTicketSend->dataList($this->params);
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    

    
    //发放优惠券
    public function sendTicket(){
        $rules=array(
            array('user_id','require','user_id不得为空！',1,'regex',3),
            array('ticket_id','require','ticket_id不得为空！',1,'regex',3),
            array('user_name','require','user_name不得为空！',1,'regex',3),
            array('mobile','require','mobile不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        $dataInfo=$this->MiguTicketSend->dataUpdate($this->params);
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    
    public function miguNotify(){
        file_put_contents('migu.txt', json_encode($this->params));
        
        $rules=array(
            array('user_mobile','require','user_mobile不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        
        
        //$mobile="13333913340";
        $subArray=array(
            "mobile"=>$this->params["user_mobile"],
        );
        
        $subscribeInfo=$this->MiguSubscribe->where(array("mobile"=>$subArray['mobile']))->find();//获取订阅详情
        if(empty($subscribeInfo)){
            $this->MiguSubscribe->dataUpdate($subArray);
        }else{
            $subArray['id']=$subscribeInfo['id'];
            if($subscribeInfo['status']==1){
                $subArray['status']=2;  
                $subArray['unsub_time']= time();  
                $this->MiguSubscribe->dataUpdate($subArray);//退订操作
            }else{
                $subArray['status']=1; 
                $subArray['sub_time']= time();  
                $subArray['unsub_time']= 0;  
                $this->MiguSubscribe->dataUpdate($subArray);//退订后重新订阅操作
            }
        }
        $this->ajaxReturn(200,"成功！",array());
        
    }
    
    
    public function test(){
        $this->MiguTicketSend->ticketSend(array("mobile"=>"13333913340")); 
    }
    
   
    
}
