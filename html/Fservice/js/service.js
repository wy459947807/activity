;(function($){
	$.service = {
		init:function(){
			$.service.account_tab();
			$.service.subit_number();
			$.service.know_ewm();
			//$.service.see_ewm();
		},
		account_tab:function(){
			$('.kh-nav li').click(function(){
                var n=$('.kh-nav li').index($(this));
                var $par=$(this).parents('.kh-main');
                $(this).addClass('on').siblings('li').removeClass('on');
                $par.find('.item').eq(n).show().siblings('.item').hide();
            });
		},
		subit_number:function(){
			$(document).on('click','.submit',function(e){
				e.preventDefault();
				var _phoneNumber = /^0?1[3|4|5|8][0-9]\d{8}$/;
				var number=$.trim($('#number').val());
				if (number=='' || number.length<0) {layer.open({content:'请输入手机号！', time: 3 });return !1;}
				if (!_phoneNumber.test(number)) {layer.open({content:'请输入正确手机号！', time: 3 });return !1;}
				$.post('url',{number:number},function(result){
					if (result.status==1) {
						layer.open({content:'提交成功！', time: 3 });
					}else{
						layer.open({content:result.msg, time: 3 });
					}
				},'json');
			});
		},
		//识别二维码
		know_ewm:function(){
			var timeout;
			$(".erweima-box").bind('touchstart', function (event) {
				var self = $(this);
				event.preventDefault();
			    timeout = setTimeout(function() {
			        var _url = self.attr("data-url");
			        //alert(_url);
			        layer.open({
					    content: '识别图中的二维码'
					    ,btn: ['确认', '取消']
					    ,skin: 'footer'
					    ,yes: function(index){
					        window.location.href=_url;
					    }
					});
					clearTimeout(timeout);
			    }, 1000);
			});
			$(".erweima-box").bind('touchend', function (event) {
			    clearTimeout(timeout);
			});
		}
		// see_ewm:function(){
		// 	var timeout;
		// 	$(".wx-ewm").bind('touchstart', function (event) {
		// 	    event.preventDefault();
		// 	    timeout = setTimeout(function() {
		// 		    window.location.href="images/ewm-3.png";
		// 			clearTimeout(timeout);
		// 	    }, 1000);
		// 	});
		// 	$(".wx-ewm").bind('touchend', function (event) {
		// 	    clearTimeout(timeout);
		// 	});
		// }
	};
	$.service.init();
})(jQuery);