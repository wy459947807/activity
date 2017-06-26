/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//全局对象管理器
var dataInfo={
    header:{},
    footer:{}
}

initData();//初始化数据

bindTemplate(dataInfo, "header", "header_tpl");//模版绑定 
bindTemplate(dataInfo, "footer", "footer_tpl");//模版绑定 


//初始化数据
function initData(){
    dataInfo.header = getRemoteData({}, "/index.php/Home/html/header");
    dataInfo.footer = getRemoteData({}, "/index.php/Home/html/footer");
}
