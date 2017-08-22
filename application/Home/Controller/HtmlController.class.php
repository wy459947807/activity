<?php

namespace Home\Controller;
include(COMMON_PATH . 'Common/simple_html_dom/simple_html_dom.php');
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class HtmlController extends HomebaseController {

    public function _initialize() {
        parent::_initialize();
    }

    public function header(){

        $url = 'http://www.10jrw.com/';
        $cacheKey=md5($url."header");
        
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }
        

        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        //$li = $html->find('.fenxi_list ul li');
        // Find all images
        foreach ($html->find('.s_header a') as $key => $val) {
            if (!preg_match('#http://#', $val->href, $test)) {
                $val->href = $url . $val->href;
            }
            
            if($val->plaintext=="登录"){
                $val->href = "http://www.10jrw.com/ulogin.html";
            }
            
            if($val->plaintext=="注册"){
                $val->href = "http://www.10jrw.com/uregister.html";
            }

        }
        
        foreach ($html->find('.s_header img') as $key => $val) { 
            if (!preg_match('#http://#', $val->src, $test)) {
                $val->src = $url . $val->src;
            }
        }
        
        foreach ($html->find('.l_home_nav a') as $key => $val) {
            if (!preg_match('#http://#', $val->href, $test)) {
                $val->href = $url . $val->href;
            }
          
        }
        
        foreach ($html->find('.l_home_nav img') as $key => $val) {
            if (!preg_match('#http://#', $val->src, $test)) {
                $val->src = $url . $val->src;
            }
        }

        $dataInfo['top']= $html->find('.s_header', 0)->innertext;
        $dataInfo['head']= $html->find('.l_home_nav', 0)->innertext;
        $html->clear();

        S($cacheKey,$dataInfo,array('type'=>'file','expire'=>(3600*24)*1)); //设置缓存3天
        $this->ajaxReturn(200,"成功！",$dataInfo);

        /*
        $this->assign('fansList',"66");    //列表信息
        $dataInfo['html'] = $this->fetch();
        $this->ajaxReturn(200,"成功！",$dataInfo);*/
        
        
    }
    
    public function footer(){
        $url = 'http://www.10jrw.com/';
        $cacheKey=md5($url."footer");
        
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }

        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        //$li = $html->find('.fenxi_list ul li');
        // Find all images
        foreach ($html->find('.l_foot_box a') as $key => $val) {
            if (!preg_match('#http://#', $val->href, $test)) {
                $val->href = $url . $val->href;
            }
        }
        
        foreach ($html->find('.l_foot_box img') as $key => $val) {
            if (!preg_match('#http://#', $val->src, $test)) {
                $val->src = $url . $val->src;
            }
        }
       
        
        $dataInfo['foot']= $html->find('.l_foot_box', 0)->innertext;
       
        $html->clear();

        S($cacheKey,$dataInfo,array('type'=>'file','expire'=>(3600*24)*1)); //设置缓存3天
        $this->ajaxReturn(200,"成功！",$dataInfo);

    }
    
}
