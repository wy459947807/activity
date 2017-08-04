<?php

namespace Home\Controller;
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class MiguController extends HomebaseController {

    protected $MiguTicket;
    protected $MiguTicketSend;
    
    public function _initialize() {
        parent::_initialize();
        $this->MiguTicket = D("Common/MiguTicket");
        $this->MiguTicketSend = D("Common/MiguTicketSend");
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
            array('user_id','require','user_id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
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
    
   
    
}
