
/*
 * 注意：
 * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
 * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
 * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
 *
 * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
 * 邮箱地址：weixin-open@qq.com
 * 邮件主题：【微信JS-SDK反馈】具体问题
 * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
 */

var configInfo = getRemoteData({url: window.location.href}, "/index.php/api/wechat/sign");//获取微信JS配置信息
var loacalUrl = new LG.URL(window.location.href);
var uid = loacalUrl.get("uid")?loacalUrl.get("uid"):0;

wx.config({
    debug: false,
    appId: configInfo.appId,
    timestamp: configInfo.timestamp,
    nonceStr: configInfo.nonceStr,
    signature: configInfo.signature,
    jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
    ]
});

wx.ready(function () {
    //分享到朋友圈
    wx.onMenuShareTimeline({
        title: '千万股民都后悔，为什么没早做这个测试！',
        link: loacalUrl.host+"html/Home/test_result.html?uid="+uid,
        imgUrl: loacalUrl.host+'html/Home/images/logo.jpg',
        trigger: function (res) {
            // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
            //alert('用户点击分享到朋友圈');
        },
        success: function (res) {
            //alert('已分享');
            window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0730504f2b4b6c79&redirect_uri=http%3A%2F%2Fm.10jrw.com%2Findex.php%2Fhome%2Fsendbook%2Findex.html&response_type=code&scope=snsapi_base&state=123#wechat_redirect";

        },
        cancel: function (res) {
            //alert('已取消');
        },
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    });
    
    //分享给朋友
    wx.onMenuShareAppMessage({
      title: '千万股民都后悔，为什么没早做这个测试！',
      desc: '超准的炒股能力测试，终于找到了！',
      link:  loacalUrl.host+"html/Home/test_result.html?uid="+uid,
      imgUrl: loacalUrl.host+'html/Home/images/logo.jpg',
      trigger: function (res) {
        // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        //alert('用户点击发送给朋友');
      },
      success: function (res) {
        //alert('已分享');
        window.location.href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0730504f2b4b6c79&redirect_uri=http%3A%2F%2Fm.10jrw.com%2Findex.php%2Fhome%2Fsendbook%2Findex.html&response_type=code&scope=snsapi_base&state=123#wechat_redirect";


      },
      cancel: function (res) {
        //alert('已取消');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });
    
    
    
    
});


wx.error(function (res) {
    alert(res.errMsg);
});



