<?php
namespace Common\Model;
use Common\Model\CommonModel;
class TianyiMonthlyModel extends CommonModel{
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        //array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
    );

    protected function _before_write(&$data) {
        parent::_before_write($data);
    }

    public function dataList($params){
        $this->sqlFrom = " cmf_tianyi_monthly ";              //数据库查询表
        $this->sqlField = " * ";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();
        
        $this->sqlOrder = " order by create_time desc "; 
        if (!empty($params['page'])) $this->page = $params['page'];
        if (!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];

        if (!empty($params['start_time'])) {
            $this->sqlWhere .= " and  create_time > '%d' ";
            $this->bindValues[] = strtotime($params['start_time']);
        }

        if (!empty($params['end_time'])) {
            $this->sqlWhere .= " and  create_time < '%d' ";
            $this->bindValues[] = strtotime($params['end_time']);
        }
        

        if (!empty($params['keyword'])) {
            $this->sqlWhere .= " and  (order_sn like '%s' or name like '%s' or  mobile like '%s') ";
            $this->bindValues[] = "%" . $params['keyword'] . "%";
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
                $params['update_time']= time();
                $model->table(C('DB_PREFIX') . 'tianyi_monthly')->where(array("id" =>$params['id']))->save($params);
            }else{ 
                
                $orderInfo=$model->table(C('DB_PREFIX') . 'tianyi_monthly')->where(array("user_id" =>$params['user_id']))->find();
                
                if(!empty($orderInfo)&&$orderInfo['end_time']>time()&&$orderInfo['status']==2){
                    $this->result['status'] = 500;
                    $this->result['msg'] = "请不要重复提交订单！";
                    return $this->result;
                }
 
                $params['create_time']= time();
                $params['end_time']= strtotime("+1 month");
                if(empty($params['order_sn'])){
                    $params['order_sn'] ="S".date("Ymd").time();//订单号
                }
                $params['total_money'] = $params['money']-$params['minus_money'];//订单金额
                $params['status']=1;//设为未支付
                if(!empty($orderInfo)){
                    $model->table(C('DB_PREFIX') . 'tianyi_monthly')->where(array("id" =>$orderInfo['id']))->save($params);
                }else{
                    $model->table(C('DB_PREFIX') . 'tianyi_monthly')->add($params);
                }

                $this->result['data']=array(
                    "order_sn"=>$params['order_sn'],
                );
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
    
    
   
}