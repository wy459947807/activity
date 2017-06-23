<?php
namespace Common\Model;
use Common\Model\CommonModel;
class ActAnswererModel extends CommonModel{
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        //array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
    );

    protected function _before_write(&$data) {
        parent::_before_write($data);
    }
    
    public function dataList($params){
        $this->sqlFrom = " cmf_act_answerer as a "
                        ." left join cmf_act_question as b on a.question_id=b.id "
                        ." left join cmf_act_result as c on a.result_id=c.id "
                        ." left join cmf_act_users as d on a.user_id=d.id ";              //数据库查询表
        $this->sqlField = " a.id,a.real_name,a.mobile,a.total_score,a.create_time,a.status,a.type_describe, "
                         ." b.title,"
                         ." c.comment,"
                         ." d.nickname,d.sex,d.city,d.province,d.country,d.headimgurl";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();
        if (!empty($params['page'])) $this->page = $params['page'];
        if (!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];

        if (!empty($params['start_time'])) {
            $this->sqlWhere .= " and  a.create_time > '%s' ";
            $this->bindValues[] = $params['start_time'];
        }

        if (!empty($params['end_time'])) {
            $this->sqlWhere .= " and  a.create_time < '%s' ";
            $this->bindValues[] = $params['end_time'];
        }


        if (!empty($params['keyword'])) {
            $this->sqlWhere .= " and  (a.real_name like '%s' or a.mobile like '%s') ";
            $this->bindValues[] = "%" . $params['keyword'] . "%";
            $this->bindValues[] = "%" . $params['keyword'] . "%"; 
        }
        $listInfo = $this->getPageList();
        return $listInfo;
    }
    
    public function dataDetail($params) {
        $this->sqlFrom = " cmf_act_answerer as a "
                        ." left join cmf_act_question as b on a.question_id=b.id "
                        ." left join cmf_act_result as c on a.result_id=c.id "
                        ." left join cmf_act_users as d on a.user_id=d.id ";              //数据库查询表
        $this->sqlField = " a.id,a.real_name,a.mobile,a.total_score,a.create_time,a.status,a.type_describe, "
                         ." b.title,"
                         ." c.comment,"
                         ." d.nickname,d.sex,d.city,d.province,d.country,d.headimgurl";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();
        

        if (!empty($params['id'])) {
            $this->sqlWhere .= " and  a.id = %d ";
            $this->bindValues[] = $params['id'];
        }
        
        if(!empty($params['user_id'])){
            $this->sqlWhere .= " and  a.user_id = %d ";
            $this->bindValues[] = $params['user_id'];
        }

        $dataInfo = $this->getOne();
        return $dataInfo;
    }
    
 
    public function submitAnswer($params){
        $model = M();
        $model->startTrans(); //事务处理
        $this->result['msg'] = "问卷提交成功！";
        try {
            if(!empty($params['options'])){
                
                //计算评测类型
                $questionRule=C("question_rule");
                $params['pageLimit'] = 100;
                $params['type_describe']="";//分类
                $params['total_score']=0;//总分
                $typeArray=array();
                $optionsArray=array();
                $typeRule = $questionRule['type_rule'];
                $subjectList=D("Common/ActSubject")->dataList($params);
                if(!empty($subjectList['data']['list'])){
                    foreach($subjectList['data']['list'] as $key=>$val){
                        $itemInfo=$params['options'][$key];
                        $optionsArray[$val['id']]=$itemInfo;
                        if(isset($typeRule[$val['id']][$itemInfo])){
                            //$params['type_describe'].=$typeRule[$val['id']][$itemInfo];//计算分类 
                            $typeArray[$val['id']]=$typeRule[$val['id']][$itemInfo];
                        }       
                        $params['total_score']+=$val['options'][$itemInfo]['score'];//计算总分
                    }
                }
                
                foreach ($typeRule as $key=>$val){
                    $params['type_describe'].=$typeArray[$key];//分类
                }
                

                $params['options']= serialize($optionsArray);//选项处理

                //查找评测结果
                $params['result_id']=0;
                $sqlWhere=array(
                    array("start_score"=>array("lt",$params['total_score'])),
                    array("end_score"=>array("egt",$params['total_score'])),   
                );
                $resultInfo=D("Common/ActResult")->where($sqlWhere)->find();
                if(!empty($resultInfo)){
                    $params['result_id']=$resultInfo['id'];
                }       
                unset($params['pageLimit']);
            }
            
           
            $answererInfo=array();
            if(!empty($params['user_id'])){
                $answererInfo=$model->table(C('DB_PREFIX') . 'act_answerer')->where(array("user_id" =>$params['user_id']))->find();
            }
 
            if(!empty($answererInfo)){
                $model->table(C('DB_PREFIX') . 'act_answerer')->where(array("id" =>$answererInfo['id']))->save($params);
            }else{ 
                $params['create_time']=date("Y-m-d H:i:s");
                $model->table(C('DB_PREFIX') . 'act_answerer')->add($params);
            }

            $model->commit(); //提交事物
        } catch (Exception $e) {
            $model->rollback(); //事物回滚

            $this->result['status'] = 500;
            $this->result['msg'] = "问卷提交失败！";
            return $this->result;
        }
        return $this->result;
    }


}