/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//全局对象管理器
var dataInfo={
    submitData:{},
}


//绑定事件

$(document).ready(function(){
    //报名提交
    $("#sign_up").click(function(){
        dataInfo.submitData={
            mobile:$("#number").val(),
        }
        var retInfo = getRemoteData(dataInfo.submitData, "/index.php/Home/Fservice/submitJoin",1);
        layer.msg(retInfo.msg);
    });
});

