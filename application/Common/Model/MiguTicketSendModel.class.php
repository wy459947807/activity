<?php
namespace Common\Model;
use Common\Model\CommonModel;
class MiguTicketSendModel extends CommonModel{
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        //array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
    );

    protected function _before_write(&$data) {
        parent::_before_write($data);
    }

    public function dataList($params){
        $this->sqlFrom = " cmf_migu_ticket_send as a"
                        ." left join cmf_migu_ticket as b on a.ticket_id=b.id ";
        $this->sqlField = " a.*,b.name as ticket_name,b.img,b.type,b.price,b.code,b.start_time,b.end_time,b.is_time_limit ";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();
        
        $this->sqlOrder = " order by create_time desc "; 
        if (!empty($params['page'])) $this->page = $params['page'];
        if (!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];

        if (!empty($params['start_time'])) {
            $this->sqlWhere .= " and  a.create_time > '%d' ";
            $this->bindValues[] = strtotime($params['start_time']);
        }

        if (!empty($params['end_time'])) {
            $this->sqlWhere .= " and  a.create_time < '%d' ";
            $this->bindValues[] = strtotime($params['end_time']);
        }
        
        if (!empty($params['status'])) {
            $this->sqlWhere .= " and  a.status = '%d' ";
            $this->bindValues[] = $params['status'];
        }
        
        if (!empty($params['type'])) {
            $this->sqlWhere .= " and  b.type = '%d' ";
            $this->bindValues[] = $params['type'];
        }
        
        if (!empty($params['user_id'])) {
            $this->sqlWhere .= " and  a.user_id = '%d' ";
            $this->bindValues[] = $params['user_id'];
        }
        
        if (!empty($params['mobile'])) {
            $this->sqlWhere .= " and  a.mobile = '%s' ";
            $this->bindValues[] = $params['mobile'];
        }
        
        if (!empty($params['keyword'])) {
            $this->sqlWhere .= " and  (a.user_name like '%s' or a.mobile like '%s') ";
            $this->bindValues[] = "%" . $params['keyword'] . "%";
            $this->bindValues[] = "%" . $params['keyword'] . "%"; 
        }
        $listInfo = $this->getPageList();
        return $listInfo;
    }


    public function dataUpdate($params) {
        $model = M();
        $model->startTrans(); //事务处理
        $this->result['msg'] = "操作成功！";
        try {
            if(!empty($params['id'])){
                $model->table(C('DB_PREFIX') . 'migu_ticket_send')->where(array("id" =>$params['id']))->save($params);
            }else{ 
                $params['create_time']= time();
                $model->table(C('DB_PREFIX') . 'migu_ticket_send')->add($params);
            }

            $model->commit(); //提交事物
        } catch (Exception $e) {
            $model->rollback(); //事物回滚

            $this->result['status'] = 500;
            $this->result['msg'] = "修改失败！";
            return $this->result;
        }
        return $this->result;
    }
    
    //发券操作
    public function ticketSend($params){
        $subscribeInfo=D("Common/MiguSubscribe")->where(array("mobile"=>$params['mobile']))->find();//获取订阅详情
        if(empty($subscribeInfo)) return false;
        
        //已经退订
        if($subscribeInfo['status']==2) return true;
        
        $totalMonth=diffMonth(time(),$subscribeInfo['sub_time']);
        
        
        $stcktMonth=$totalMonth;
        if(!empty($subscribeInfo['stckt_time'])){
            $stcktMonth-=diffMonth($subscribeInfo['stckt_time'],$subscribeInfo['sub_time']);
        }
        
        //更新普通优惠券
        for($i=0;$i<$stcktMonth;$i++){
            $TicketSendUpdate=array("mobile"=>$subscribeInfo['mobile'],"ticket_id"=>1);
            D("Common/MiguTicketSend")->dataUpdate($TicketSendUpdate);
        }

        if(!empty($stcktMonth)) {
            //更新发券日期
            $subscribeUpdate=array("id"=>$subscribeInfo['id'],"stckt_time"=> time(),);
            D("Common/MiguSubscribe")->dataUpdate($subscribeUpdate);
        }
        
        
        //更新订阅满半年后的优惠券
        $hyearMonth=intval($totalMonth/6);

        if(!empty($subscribeInfo['hyear_time'])){
            $hyearMonth-=intval(diffMonth($subscribeInfo['hyear_time'],$subscribeInfo['sub_time'])/6);
        }

        //更新普通优惠券
        for($i=0;$i<$hyearMonth;$i++){
            $TicketSendUpdate=array("mobile"=>$subscribeInfo['mobile'],"ticket_id"=>2);
            D("Common/MiguTicketSend")->dataUpdate($TicketSendUpdate);
        }

        if(!empty($hyearMonth)) {
            //更新发券日期
            $subscribeUpdate=array( "id"=>$subscribeInfo['id'],"hyear_time"=> time(),);
            D("Common/MiguSubscribe")->dataUpdate($subscribeUpdate);
        }
        

    }

   
}