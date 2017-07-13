<?php

namespace Home\Controller;
include(COMMON_PATH . 'Common/simple_html_dom/simple_html_dom.php');
use Common\Controller\HomebaseController;


/**
 * 首页
 */
class WindiaryController extends HomebaseController {

   
    
    public function _initialize() {
        parent::_initialize();
       
    }
    
    //首页
    public function index() {
    	//echo "ddd";
        $url = 'http://www.10jrw.com/other/winner_diary.html';
        $cacheKey=md5($url);
        /*
        if(!empty(S($cacheKey))){
            $this->ajaxReturn(200,"成功！",S($cacheKey));
        }*/
        
        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);


        $retList=array();
        foreach ($html->find('.teacher h4') as $key => $val) {
            $retList[$key]["name"]=$val->plaintext;  
        }
        
        foreach ($html->find('.teacher .pic img') as $key => $val) {
            $retList[$key]["icon"]="http://www.10jrw.com".$val->src;  
        }
        
        foreach ($html->find('.teacher p') as $key => $val) {
            $retList[$key]["content"]=$val->plaintext;
        }
        
        foreach ($html->find('.a-video .winner_diary') as $key => $val) {
            $retList[$key]["video"]= $val->attr['data-id'];
        }
        
        foreach ($html->find('.a-video .winner_diary img') as $key => $val) {
            $retList[$key]["bg_img"]= "http://www.10jrw.com".$val->src;
        }
        
        foreach ($html->find('.a-video .tit p') as $key => $val) {
            $retList[$key]["video_title"]= $val->plaintext;
        }
        
        $videoTag=array(
            0=>"深圳国诚投资研究员、特邀讲师",
            1=>"赢家股票期货特训营主讲师",
            2=>"专业股票期货操盘手实战导师",
            3=>"职业交易者 清华大学工学硕士",
            4=>"交大赢家股票期货操盘特训营实战课程教练",
        );
        
        foreach($videoTag as $key=>$val){
            $retList[$key]["video_tag"]= $val;
        }

        $html->clear();

        S($cacheKey,$listArray,array('type'=>'file','expire'=>(3600*24)*1)); //设置缓存1天
        $this->ajaxReturn(200,"成功！",$retList);
        
        
    }
    
    
}
