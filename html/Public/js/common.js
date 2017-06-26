/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//获取远程数据
function getRemoteData(dataInfo, ajaxUrl,isInfo) {
    var method="post";//默认post提交方式
    if(dataInfo['method']){
        method=dataInfo['method'];
        delete  dataInfo['method'];
    }
    
    var retData = {}
    $.ajax({
        url: ajaxUrl,
        type: method,
        data: dataInfo,
        dataType: "json", //dataType: "html",
        async: false,
        success: function (res) {
            if(isInfo){
                retData = res;  
            }else{
                retData = res.data;
            }
        },
        error: function () {
            return;
        }
    });

    return retData;
}



function bindTemplate(data, boxId, tempId, append) {
    if (boxId) {
        var list_tpl = template(tempId, data);
        if (!append) {
            $('#' + boxId).html(list_tpl);
        } else {
            $('#' + boxId).append(list_tpl);
        }
    }
}
