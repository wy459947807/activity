/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//全局对象管理器
var dataInfo={
    header:{},
    footer:{},
    article:{},
    teacher:{},
    course:{},
    submitData:{}
}

initData();//初始化数据

bindTemplate(dataInfo, "header", "header_tpl");//模版绑定 
bindTemplate(dataInfo, "footer", "footer_tpl");//模版绑定 

bindTemplate(dataInfo, "article", "article_tpl");//模版绑定 
bindTemplate(dataInfo, "teacher", "teacher_tpl");//模版绑定 
bindTemplate(dataInfo, "course", "course_tpl");//模版绑定 

//初始化数据
function initData(){
    dataInfo.header = getRemoteData({}, "/index.php/Home/html/header");
    dataInfo.footer = getRemoteData({}, "/index.php/Home/html/footer");
    
    //无为评论
    dataInfo.article = getRemoteData({}, "/index.php/Wuwei/Index/articleList");
    
    //老师列表
    dataInfo.teacher = getRemoteData({pageLimit:3}, "/index.php/Wuwei/Index/teacherList");
    
    //课程列表
    dataInfo.course = getRemoteData({}, "/index.php/Wuwei/Index/courseList");
    
}


//绑定事件
$(document).ready(function(){
    //报名提交
    $("#sign_up").click(function(){
        dataInfo.submitData={
            name:$("#name").val(),
            mobile:$("#mobile").val(),
        }
        var retInfo = getRemoteData(dataInfo.submitData, "/index.php/Wuwei/Index/submitJoin",1);
        layer.msg(retInfo.msg);
    });
});

