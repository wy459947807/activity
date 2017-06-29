/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//全局对象管理器
var dataInfo={
    videoList:{},
    submitData:{},
    teacherList:{},
    courseList:{},
    header:{},
    footer:{}
}


initData();//初始化数据
bindTemplate(dataInfo, "index", "index_tpl");//模版绑定 

bindTemplate(dataInfo, "header", "header_tpl");//模版绑定 
bindTemplate(dataInfo, "footer", "footer_tpl");//模版绑定 

//初始化数据
function initData(){
    //获取问题信息 
    dataInfo.videoList = getRemoteData({}, "/index.php/Yuehua/index/index");

    dataInfo.header = getRemoteData({}, "/index.php/Home/html/header");
    dataInfo.footer = getRemoteData({}, "/index.php/Home/html/footer");
    
    dataInfo.teacherList = getRemoteData({pageLimit:2}, "/index.php/Yuehua/index/getTeacher");
    dataInfo.courseList = getRemoteData({pageLimit:3}, "/index.php/Yuehua/index/getCourse");

    //获取题目列表
    //dataInfo.subject=getRemoteData({question_id:4},"/index.php/Home/index/getSubject");
}

function selectVideo(index){   
    $('#slider_main').find('li').eq(index).addClass('playing').siblings('li').removeClass('playing');
    $("#videoBox").html(dataInfo['videoList'][index]['video']);
}

function submitJoin(){
    dataInfo.submitData={
        name:$("#name").val(),
        mobile:$("#mobile").val(),
    }
    var retInfo = getRemoteData(dataInfo.submitData, "/index.php/Yuehua/index/submitJoin",1);
    layer.msg(retInfo.msg);
   
}
