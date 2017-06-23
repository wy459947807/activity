<?php
namespace Common\Model;
use Common\Model\CommonModel;
class ActSubjectModel extends CommonModel{
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        //array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
    );

    protected function _before_write(&$data) {
            parent::_before_write($data);
    }
    
    public function dataList($params){
        $this->sqlFrom = " cmf_act_subject ";               //数据库查询表
        $this->sqlField = " * ";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();
        if (!empty($params['page'])) $this->page = $params['page'];
        if (!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];

        $this->sqlOrder=" order by sort asc ";

        if (!empty($params['question_id'])) {
            $this->sqlWhere .= " and  question_id = %d ";
            $this->bindValues[] = $params['question_id'];
        }
        
        if (!empty($params['start_time'])) {
            $this->sqlWhere .= " and  create_time > '%s' ";
            $this->bindValues[] = $params['start_time'];
        }

        if (!empty($params['end_time'])) {
            $this->sqlWhere .= " and  create_time < '%s' ";
            $this->bindValues[] = $params['end_time'];
        }


        if (!empty($params['keyword'])) {
            $this->sqlWhere .= " and  (name like '%s' or describe like '%s') ";
            $this->bindValues[] = "%" . $params['keyword'] . "%";
            $this->bindValues[] = "%" . $params['keyword'] . "%"; 
        }
        
        
        $listInfo = $this->getPageList();
        
        if(!empty($listInfo['data']['list'])){
            foreach ($listInfo['data']['list'] as $key=>$val){
                $listInfo['data']['list'][$key]['options']= unserialize($val['options']);
            }
        }
        return $listInfo;
    }


    public function dataUpdate($params) {
        $model = M();
        $model->startTrans(); //事务处理
        $this->result['msg'] = "修改成功！";
        try {
            if(!empty($params['id'])){
                $model->table(C('DB_PREFIX') . 'act_subject')->where(array("id" =>$params['id']))->save($params);
            }else{ 
                $params['create_time']=date("Y-m-d H:i:s");
                $model->table(C('DB_PREFIX') . 'act_subject')->add($params);
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