<?php

namespace Wuwei\Controller;
include(COMMON_PATH . 'Common/simple_html_dom/simple_html_dom.php');
use Common\Controller\HomebaseController;

/**
 * 首页
 */
class IndexController extends HomebaseController {

    protected $teacher_model;
    protected $join_model;
    protected $article_model;

    public function _initialize() {
        parent::_initialize();
        $this->teacher_model = D("Common/WuweiTeacher");
        $this->join_model = D("Common/WuweiJoin");
        $this->article_model = D("Common/WuweiArticle");  
    }

    //评论列表
    public function articleList() { 
        $dataInfo= $this->article_model->dataList($this->params);//查询登录用户
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
    
    //老师列表
    public function teacherList(){
        $dataInfo= $this->teacher_model->dataList($this->params);//查询登录用户
        $this->ajaxReturn($dataInfo['status'],$dataInfo['msg'],$dataInfo['data']);
    }
    
     //获取评论详情
    public function articleDetail(){
        $rules=array(
            array('id','require','id不得为空！',1,'regex',3),
        );
        $this->checkField($rules, $this->params);
        
        $dataInfo= $this->article_model->where(array("id"=>$this->params['id']))->find();//查询登录用户
        $this->article_model->where(array("id"=>$this->params['id']))->setInc("view_num");//更新浏览量
        if(empty($dataInfo)){
           $this->ajaxReturn(500,"问题不存在！",""); 
        }
        $this->ajaxReturn(200,"成功！",$dataInfo);
    }
    
    //提交报名信息
    public function submitJoin() {
        $rules = array(
            array('name', 'require', '姓名不得为空！', 1, 'regex', 3),
            array('mobile', 'require', '手机不得为空！', 1, 'regex', 3),
            array('mobile','/^1[34578]\d{9}$/','手机格式不正确！',1,'regex',3),
            
        );
        $this->checkField($rules, $this->params);
        $dataInfo = $this->join_model->dataUpdate($this->params); //提交评测结果
        $this->ajaxReturn($dataInfo['status'],"报名成功！", $dataInfo['data']);
    }
    
    //点赞
    public function recommend() {
        $rules = array(
            array('id', 'require', 'id不得为空！', 1, 'regex', 3),            
        );
        $this->checkField($rules, $this->params);
        
        $dataInfo = $this->article_model->where(array("id"=>$this->params['id']))->setInc("rec_num");
        $this->ajaxReturn(200,"已点赞！", array());

    }
    
    public function courseList(){
        $url = 'http://www.wwjrxx.com/';
        $cacheKey=md5($url);
        
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }
        

        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        //$li = $html->find('.fenxi_list ul li');
        // Find all images

        $dataInfo['domain']= $html->find('.domain', 0)->innertext;
        $dataInfo['lead']= $html->find('.lead', 0)->innertext;
        $dataInfo['vision']= $html->find('.vision', 0)->innertext;
        
        $html->clear();

        S($cacheKey,$dataInfo,array('type'=>'file','expire'=>(3600*24)*3)); //设置缓存3天
        $this->ajaxReturn(200,"成功！",$dataInfo);

      
    }
    

}
