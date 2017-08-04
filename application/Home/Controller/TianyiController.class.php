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

    public function getCourseList() {
        $rules=array(
            array('user_id','require','user_id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);

        $dataInfo=array(
            'p'=>!empty($this->params['page'])?$this->params['page']:1,
            'pagesize'=>!empty($this->params['pageLimit'])?$this->params['pageLimit']:10,
        );
        $dataList=$this->remoteCourseList($dataInfo);
        
        foreach($dataList['data']['list'] as $key=>$val){
            $dataList['data']['list'][$key]["order_sn"]="";
            $orderInfo=$this->TianyiOrder->where(array("user_id" =>$this->params['user_id'],"course_id"=>$val['id']))->find();
            if(!empty($orderInfo)){
                $dataList['data']['list'][$key]["order_sn"]=$orderInfo['order_sn'];
            }
        }

        $this->ajaxReturn(200,"成功！",$dataList['data']);
    }
    
    
    public function getCourseOne() {
        $rules=array(
            array('user_id','require','user_id不得为空！',1,'regex',3),
            array('course_id','require','course_id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        
        $dataInfo=$this->remoteCourseOne(array("id"=>$this->params['course_id']));

        $orderInfo=$this->TianyiOrder->where(array("user_id" =>$this->params['user_id'],"course_id"=>$this->params['course_id']))->find();
        $dataInfo['data']['info']['order_sn']="";
        if(!empty($orderInfo)){
            $dataInfo['data']['info']['order_sn']=$orderInfo['order_sn'];
        }
        $this->ajaxReturn(200,"成功！",$dataInfo['data']);
    }

    //public function 
    public function submitOrder(){
        $rules=array(
            array('course_id','require','course_id不得为空！',1,'regex',3),
            array('user_id','require','user_id不得为空！',1,'regex',3),
            array('order_sn','require','order_sn不得为空！',1,'regex',3),
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
    
    //获取远程课程列表
    public function remoteCourseList($data){
        $url="http://www.10jrw.com/api/third_activity/get_winglist";
        $data["token"]=authcode("10jrw*third_activity", 'ENCODE', "c#M8y^8C-UJ%p&75@!", 10);
        $retInfo=httpPost(json_encode($data),$url);
        return json_decode($retInfo,true);
    }
    
    //获取远程课程详情
    public function remoteCourseOne($data){
        $url="http://www.10jrw.com/api/third_activity/get_winginfo";
        $data["token"]=authcode("10jrw*third_activity", 'ENCODE', "c#M8y^8C-UJ%p&75@!", 10);
        $retInfo=httpPost(json_encode($data),$url);
        return json_decode($retInfo,true);
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
        
        //$retInfo= json_decode($this->params['req_data'],true);
        
        $retInfo= $this->params;
        $orderInfo=$this->TianyiOrder->where(array("order_sn"=>$retInfo['order_no']))->find();
        if(empty($orderInfo)){
            $retData=array(
                "response"=>array(
                    "code"=>1,
                    "msg"=>"订单不存在！",
                )
            );
            file_put_contents('2.txt', json_encode($retData));//打印日志
            exit(json_encode($retData));
        }
        
        if($retInfo['price']!=$orderInfo['total_money']*100){
            $retData=array(
                "response"=>array(
                    "code"=>2,
                    "msg"=>"订单金额校验失败！",
                )
            );
            file_put_contents('3.txt', json_encode($retData));//打印日志
            exit(json_encode($retData));
        }
        
        $orderUpdate=array(
            "status"=>2,
            "pay_type"=>"天翼支付"
        );
        $this->TianyiOrder->where(array("order_sn"=>$retInfo['order_no']))->save($orderUpdate);//更新订单
        file_put_contents('4.txt', json_encode($retData));//打印日志
        exit(json_encode($retData));
 
        //file_put_contents('1.txt', json_encode($this->params));
    }
    
    /*
    public function test(){
        $url="http://pay.tyread.com/smspay/query_order.json";
        $data=array(
            "client_app_key"=>"b78963260f584feca40bc5d915037911",
            "order_no"=>"C3469pqJfrTGDtA",
            "timestamp"=> time(),
        );
        $data['token']=$this->token($data);

        $retInfo=http_Post($data,$url);
        var_dump($retInfo);
    }
    
    public function token($data){
        $rt="";
        $num=0;
        foreach ($data as $key=>$val){
            if($num>0)  $rt.="&";
            $rt.=$key."=".$val;
            $num++;
        }
        $rt.="f0326e9a9e36420eb15e9e0c4544dc80";
        return md5($rt);
    }*/

    
}
