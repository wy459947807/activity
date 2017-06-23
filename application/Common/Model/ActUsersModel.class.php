<?php
namespace Common\Model;
use Common\Model\CommonModel;
class ActUsersModel extends CommonModel{
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        //array('ad_name', 'require', '广告名称不能为空！', 1, 'regex', 3),
    );

    protected function _before_write(&$data) {
            parent::_before_write($data);
    }
    
    public function userList($params){
        $this->sqlFrom = " cmf_act_users ";                 //数据库查询表
        $this->sqlField = " * ";                            //数据库查询字段
        $this->sqlWhere = " (1=1) ";                        //数据库查询条件
        $this->bindValues = array();
        if (!empty($params['page'])) $this->page = $params['page'];
        if (!empty($params['pageLimit'])) $this->pageLimit = $params['pageLimit'];

        if (!empty($params['start_time'])) {
            $this->sqlWhere .= " and  create_time > '%s' ";
            $this->bindValues[] = $params['start_time'];
        }

        if (!empty($params['end_time'])) {
            $this->sqlWhere .= " and  create_time < '%s' ";
            $this->bindValues[] = $params['end_time'];
        }


        if (!empty($params['keyword'])) {
            $this->sqlWhere .= " and  (nickname like '%s' or openid like '%s') ";
            $this->bindValues[] = "%" . $params['keyword'] . "%";
            $this->bindValues[] = "%" . $params['keyword'] . "%"; 
        }
        $listInfo = $this->getPageList();
        return $listInfo;
    }


    public function userUpdate($params) {
        $model = M();
        $model->startTrans(); //事务处理
        $this->result['msg'] = "修改成功！";
        try {
            
            $updateArray=array(
                "openid"=>$params['openid'],
                "nickname"=>$params['nickname'],
                "sex"=>$params['sex'],
                "language"=>$params['language'],
                "city"=>$params['city'],
                "province"=>$params['province'],
                "country"=>$params['country'],
                "headimgurl"=>$params['headimgurl'],
                "subscribe"=>$params['subscribe'],
                "subscribe_time"=>$params['subscribe_time'],
                "remark"=>$params['remark'],
                "groupid"=>$params['groupid'],
                "referer"=>$params['referer'],
                "create_time"=>date("Y-m-d H:i:s"),
            );
            $userInfo=$model->table(C('DB_PREFIX') . 'act_users')->where(array("openid" => $params['openid']))->find();
            $uid=0;
            if(!empty($userInfo)){
                $uid=$userInfo['id']; 
                $model->table(C('DB_PREFIX') . 'act_users')->where(array("condition"=>array(array("id" =>$params['id']),array("openid"=>$params['openid']),"or")))->save($updateArray);
            }else{ 
                $uid=$model->table(C('DB_PREFIX') . 'act_users')->add($updateArray);
            }
            $this->result['data'] = $uid;
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