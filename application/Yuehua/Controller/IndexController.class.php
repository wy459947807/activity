<?php

namespace Yuehua\Controller;

include(COMMON_PATH . 'Common/simple_html_dom/simple_html_dom.php');

use Common\Controller\HomebaseController;

/**
 * 首页
 */
class IndexController extends HomebaseController {

    protected $course_model;
    protected $join_model;
    protected $teacher_model;

    public function _initialize() {
        parent::_initialize();
        $this->course_model = D("Common/SyhCourse");
        $this->join_model = D("Common/SyhJoin");
        $this->teacher_model = D("Common/SyhTeacher");  
    }

    //首页
    public function index() {

        $url = 'http://www.yuehua567.com/';
        $cacheKey=md5($url);
        
        /*
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }*/
        

        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        //$li = $html->find('.fenxi_list ul li');
        // Find all images
        $listArray = array();
        foreach ($html->find('.fenxi_list ul li a') as $key => $val) {
            $titleString = $val->plaintext;
            $item['href'] = $val->href;
            $item['date'] = "";
            if (preg_match('/\d{4}\.\d+\.\d+/', $titleString, $date)) {
                $item['date'] = $date[0]; //正则匹配日期
            };
            if (preg_match('/\d{4}\.\d+\.\d+(.*?)\(/', $titleString, $title)) {
                $item['title'] = $title[1]; //正则匹配日期
            };
            $listArray[] = $item;
        }
        $listArray=array_reverse($listArray);
        $html->clear();

        foreach ($listArray as $key => $val) {
            $detail_url = $url . $val['href'];
            $html->load_file($detail_url); //载入详情页面
            $videoString = $html->find('.article_c', 0)->innertext;
            $listArray[$key]['video'] = "";
            if (preg_match('#<script(.*?);  </script>#', $videoString, $video)) {
                $tmpData = str_replace("'width':'600'", "'width':'100%'", $video[0]);
                $listArray[$key]['video'] = str_replace("'height':'338'", "'height':'600px'", $tmpData);
            };
            $html->clear();
        } 
        
        $retList=array();
        foreach ($listArray as $key=>$val){
            if(!empty($val['title'])&&!empty($val['video'])){
                $retList[]=$val;
            }
        }
        
        S($cacheKey,$retList,array('type'=>'file','expire'=>(3600*24)*0.5)); //设置缓存3天
        $this->ajaxReturn(200,"成功！",$retList);
       
    }
    
    

    public function dataList() {
        $url = 'http://www.yuehua567.com/fenxi/hangqing/';
        if (!empty($_GET['url'])) {
            $url = $url . str_replace("/fenxi/hangqing/", "", $_GET['url']);
        }
        
        $cacheKey=md5($url);
        
        
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }

        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        foreach ($html->find('.art_c a') as $key => $val) {
            if (preg_match('#/fenxi/hangqing/(.*?).html#', $val->href, $test)) {
                $val->href = "yhmarket_info.html?url=" . $val->href;
            } else {
                $val->href = "?url=" . $val->href;
            }
        }
        foreach ($html->find('.art_c option') as $key => $val) {
            $val->value = "?url=" . $val->value;
        }
        
        $listHtml = $html->find('.art_c', 0)->innertext;
        $dataInfo['listHtml'] = mb_convert_encoding($listHtml, 'UTF-8','GB2312,UTF-8');//转码
        S($cacheKey,$dataInfo,array('type'=>'file','expire'=>(3600*24)*0.5)); //设置缓存3天

        $this->ajaxReturn(200,"成功！",$dataInfo);
        
    }

    public function dataDetial() {

        $url = 'http://www.yuehua567.com';
        if (!empty($_GET['url'])) {
            $url = $url . $_GET['url'];
        }
        
        $cacheKey=md5($url);
        
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }
        
        
        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        foreach ($html->find('.context a') as $key => $val) {
            $val->href = "?url=" . $val->href;
        }
        
        $dataInfo=array();
        
        foreach ($html->find('.article_c img') as $key => $val) {
             $val->src ='http://www.yuehua567.com' . $val->src;
        }
        
        
        
        $dataInfo['content']= mb_convert_encoding($html->find('.article_c', 0)->innertext, 'UTF-8','GB2312,UTF-8');
        
        
        $dataInfo['content'] = str_replace("'width':'600'", "'width':'100%'", $dataInfo['content']);
        $dataInfo['content'] = str_replace("'height':'338'", "'height':'600px'", $dataInfo['content']);
        
        $dataInfo['foot']= $html->find('.context', 0)->innertext;
        $dataInfo['title']= $html->find('.myh1', 0)->plaintext;

        S($cacheKey,$dataInfo,array('type'=>'file','expire'=>(3600*24)*0.5)); //设置缓存3天
        //echo $dataInfo['content'];
        $this->ajaxReturn(200,"成功！",$dataInfo);
      
        
    }
    
    
    public function getTeacher(){
        $dataInfo = $this->teacher_model->dataList($this->params); //提交评测结果
        $this->ajaxReturn($dataInfo['status'], $dataInfo['msg'], $dataInfo['data']);
    }
    
    public function getCourse(){
        $dataInfo = $this->course_model->dataList($this->params); //提交评测结果
        $this->ajaxReturn($dataInfo['status'], $dataInfo['msg'], $dataInfo['data']);
    }

    //提交测试结果
    public function submitJoin() {
        $rules = array(
            array('name', 'require', '姓名不得为空！', 1, 'regex', 3),
            array('mobile', 'require', '手机不得为空！', 1, 'regex', 3),
            array('mobile','/^1[34578]\d{9}$/','手机格式不正确！',1,'regex',3),
            
        );
        $this->checkField($rules, $this->params);
        $dataInfo = $this->join_model->dataUpdate($this->params); //提交评测结果
        $this->ajaxReturn($dataInfo['status'], $dataInfo['msg'], $dataInfo['data']);
    }

}
