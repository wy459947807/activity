;(function($){
	$.yh = {
		settings:{
			//课程切换按钮
			c_proe:'span#proe',
			c_next:'span#next',
			//提交信息
			uname:'input[data-id=uname]',
			unumber:'input[data-id=unumber]',
			input_tip:'p#input_tip',
			signup:'button#sign_up',
		},
		init:function(){
			$.yh.course_tab();
			$.yh.submit_info();
		},
		//课程切换
		course_tab:function(){
			var s = $.yh.settings;
			var index = 0;
			$(document).on('click',s.c_next,function(){
				if (index < 5) {
					index ++;
					$.yh.show_course(index);
				}else{
					layer.msg('只能看最近10期内容');
					return !1;
				}
			});
			$(document).on('click',s.c_proe,function(){
				if (index > 0 ) {
					index --;
					$.yh.show_course(index);
				}else{
					layer.msg('只能看最近10期内容');
					return !1;
				}
			})
		},
		show_course:function(index){
			var self = $(this);
			var lw = $('#slider_main>li').outerWidth(true);
			var to_left = -lw*index+'px';
			$('#slider_main').animate({ left: to_left}, 500)
		},
		//验证提交信息
		submit_info:function(){
			var s = $.yh.settings;
			$(document).on('click',s.signup,function(){
				var uname = $.trim($(s.uname).val());
				var unum = $.trim($(s.unumber).val());
				if ($.yh.isEmpty(uname)){
					$(s.uname).focus();
					$(s.input_tip).text('*请先输入姓名').show();
					return !1;
				}
				if ($.yh.isEmpty(unum)) {
					$(s.unumber).focus();
					$(s.input_tip).text('*请先输入手机号码').show();
					return !1;
				}
				$(s.input_tip).hide();
			})
		},
		isMobile: function(str){//手机号码
			return /^0?1[3|4|5|8][0-9]\d{8}$/.test(str);
		},
        isEmpty: function(str) {
            return void 0 === str || null === str || "" === str
        },
	};
	$.yh.init();
})(jQuery)