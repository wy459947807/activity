<?php
namespace Common\Model;
use Common\Model\CommonModel;
class MiguSubscribeModel extends CommonModel{
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        //array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
    );

    protected function _before_write(&$data) {
        parent::_before_write($data);
    }

    public function dataList($params){
        $this->sqlFrom = " cmf_migu_subscribe ";            //数据库查询表
        $this->sqlField = " * ";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();

        if (!empty($params['page'])) $this->page = $params['page'];
        if (!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];

        if (!empty($params['start_time'])) {
            $this->sqlWhere .= " and  sub_time > '%d' ";
            $this->bindValues[] = strtotime($params['start_time']);
        }

        if (!empty($params['end_time'])) {
            $this->sqlWhere .= " and  sub_time < '%d' ";
            $this->bindValues[] = strtotime($params['end_time']);
        }

        if (!empty($params['keyword'])) {
            $this->sqlWhere .= " and  (mobile like '%s') ";
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
                $model->table(C('DB_PREFIX') . 'migu_subscribe')->where(array("id" =>$params['id']))->save($params);
            }else{ 
                $params['sub_time']= time();
                $model->table(C('DB_PREFIX') . 'migu_subscribe')->add($params);
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