/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//全局对象管理器
var dataInfo={
    articleList:{},
    header:{},
    footer:{},
    loacalUrl:new LG.URL(window.location.href),//获取当前url
}


initData();//初始化数据
bindTemplate(dataInfo, "list", "list_tpl");//模版绑定 

bindTemplate(dataInfo, "header", "header_tpl");//模版绑定 
bindTemplate(dataInfo, "footer", "footer_tpl");//模版绑定 

//初始化数据
function initData(){  
    var url=dataInfo.loacalUrl.get("url");
    //获取视频列表信息 
    dataInfo.articleList = getRemoteData({method:"get",url:url}, "/index.php/Yuehua/index/dataList");
    
    dataInfo.header = getRemoteData({}, "/index.php/Home/html/header");
    dataInfo.footer = getRemoteData({}, "/index.php/Home/html/footer");
}

