var dataInfo={
    rank:0,
    userInfo:{}
}

var Weixin={
    config:{},
    host:"",
}

var configInfo = getRemoteData({url: window.location.href}, "/index.php/api/wechat/sign");//获取微信JS配置信息
Weixin.config=configInfo;

var loacalUrl = new LG.URL(window.location.href);
Weixin.host = loacalUrl.host;
//alert(Weixin.config.appId);

//入口
$(document).ready(function(){
    initData();
    $("#count_represent").html(dataInfo.rank+525);
});


//初始化数据
function initData(){
    $.ajax({  
        type : "post",  
        url : "/index.php/Daiyan/index/getRank",  
        data : {},  
        async : false,  
        success : function(res){  
            if(!res.status){
                alert("数据加载失败");
            }
            dataInfo.rank=res.data.rank;
        }  
    }); 
}


function submitData(){
  
    var userInfo={
        name: $("#name").val(),
        country: "中国",
        province: $("#province").val(),
        city: $("#city").val(),
        stage: $("#term").val(),
        nature: $("#desc").val(),
        card:$("#makeOkImg").attr("src"),
    };

    $.ajax({  
        type : "post",  
        url : "/index.php/Daiyan/index/createCard",  
        data : userInfo,  
        async : false,  
        success : function(res){  
            if(!res.status){
                alert("数据加载失败");
            }
            dataInfo.rank=res.data.rank;
        }  
    }); 
}