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

        $html->clear();

        foreach ($listArray as $key => $val) {
            $detail_url = $url . $val['href'];
            $html->load_file($detail_url); //载入详情页面
            $videoString = $html->find('.article_c', 0)->innertext;
            $listArray[$key]['video'] = "";
            if (preg_match('#<script(.*?);  </script>#', $videoString, $video)) {
                $listArray[$key]['video'] = $video[0];
            };
            $html->clear();
        }

        var_dump($listArray);

        //echo "ddd";
        //$this->display();
    }

    public function dataList() {
        $url = 'http://www.yuehua567.com/fenxi/hangqing/';
        if (!empty($_GET['url'])) {
            $url = $url . str_replace("/fenxi/hangqing/", "", $_GET['url']);
        }


        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        foreach ($html->find('.art_c a') as $key => $val) {
            if (preg_match('#/fenxi/hangqing/(.*?).html#', $val->href, $test)) {
                $val->href = "detial.php?url=" . $val->href;
            } else {
                $val->href = "?url=" . $val->href;
            }
        }
        foreach ($html->find('.art_c option') as $key => $val) {
            $val->value = "?url=" . $val->value;
        }
        $test = $html->find('.art_c', 0)->innertext;

        echo $test;
    }

    public function dataDetial() {

        $url = 'http://www.yuehua567.com';
        if (!empty($_GET['url'])) {
            $url = $url . $_GET['url'];
        }
        $html = new \simple_html_dom();
        // 从url中加载
        $html->load_file($url);

        foreach ($html->find('.context a') as $key => $val) {
            $val->href = "?url=" . $val->href;
        }

        $test = $html->find('.article_c', 0)->innertext;
        $test1 = $html->find('.context', 0)->innertext;
        $test2 = $html->find('.myh1', 0)->plaintext;
        echo $test;
        echo $test1;
        echo $test2;
    }

    //提交测试结果
    public function submitJoin() {
        $rules = array(
            array('name', 'require', 'name不得为空！', 1, 'regex', 3),
            array('mobile', 'require', 'mobile不得为空！', 1, 'regex', 3),
        );
        $this->checkField($rules, $this->params);
        $dataInfo = $this->answerer_model->submitAnswer($this->params); //提交评测结果
        $this->ajaxReturn($dataInfo['status'], $dataInfo['msg'], $dataInfo['data']);
    }

}
