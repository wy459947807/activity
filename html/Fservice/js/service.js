;(function($){
	$.service = {
		init:function(){
			$.service.account_tab();
			$.service.subit_number();
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
		}
	};
	$.service.init();
})(jQuery);