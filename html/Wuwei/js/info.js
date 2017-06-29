/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//全局对象管理器
var dataInfo={
    header:{},
    footer:{},
    articleInfo:{},
    loacalUrl:new LG.URL(window.location.href),//获取当前url
    rec_lock:false,
}

initData();//初始化数据

bindTemplate(dataInfo, "header", "header_tpl");//模版绑定 
bindTemplate(dataInfo, "footer", "footer_tpl");//模版绑定 

bindTemplate(dataInfo, "articleInfo", "articleInfo_tpl");//模版绑定 

//初始化数据
function initData(){
    dataInfo.header = getRemoteData({}, "/index.php/Home/html/header");
    dataInfo.footer = getRemoteData({}, "/index.php/Home/html/footer");
    
    //无为评论
    var id=dataInfo.loacalUrl.get("id");
    dataInfo.articleInfo = getRemoteData({id:id}, "/index.php/Wuwei/Index/articleDetail");
    
}



//绑定事件
$(document).ready(function(){
    //报名提交
    $("#recommend").click(function(){
        if(dataInfo.rec_lock){
            layer.msg("请不要重复点赞！");
        }else{
            var id=dataInfo.loacalUrl.get("id"); 
            var retInfo = getRemoteData({id:id}, "/index.php/Wuwei/Index/recommend",1);
            dataInfo.rec_lock=true;
            layer.msg(retInfo.msg);    
        }
        
    });
});
