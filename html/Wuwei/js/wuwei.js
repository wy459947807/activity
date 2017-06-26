;(function($){
	$.ww = {
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
			$.ww.course_tab();
			$.ww.submit_info();
			$.ww.main_voice();
		},
		//课程切换
		course_tab:function(){
			var s = $.ww.settings;
			var index = 0;
			$(document).on('click',s.c_next,function(){
				if (index < 5) {
					index ++;
					$.ww.show_course(index);
				}else{
					layer.msg('只能看最近10期内容');
					return !1;
				}
			});
			$(document).on('click',s.c_proe,function(){
				if (index > 0 ) {
					index --;
					$.ww.show_course(index);
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
			var s = $.ww.settings;
			$(document).on('click',s.signup,function(){
				var uname = $.trim($(s.uname).val());
				var unum = $.trim($(s.unumber).val());
				if ($.ww.isEmpty(uname)){
					$(s.uname).focus();
					$(s.input_tip).text('*请先输入姓名').show();
					return !1;
				}
				if ($.ww.isEmpty(unum)) {
					$(s.unumber).focus();
					$(s.input_tip).text('*请先输入手机号码').show();
					return !1;
				}
				if (!$.ww.isMobile(unum)) {
					$(s.unumber).focus();
					$(s.input_tip).text('*你输入的手机号码有误，请重新输入').show();
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
        //主页播放语音
       	main_voice:function(){
       		$(document).on('click','p.play_voice',function(){
       			var self = $(this);
       			var	other = self.parents('li').siblings('li');
       			other.find('audio').each(function(){
					this.pause();
					this.currentTime=0;
				});
				other.find('i').removeClass('playing').text('原创语音收评，点击收听');
				$.ww.play_voice(self);
       		})
       	},
       	//详情页播放语音
       	info_voice:function(){
       		$(document).on('click','#play_voice',function(){
       			var self = $(this);
       			$.ww.play_voice(self);
       		})
       	},
       	//播放语音
       	play_voice:function(self){
       		var timer = null;
   			var player = self.parent().find('audio')[0];
   			var v_time = Math.ceil(player.duration);
			if(player!==null){
				if(player.paused){
				    player.play();
				    var n_time = Math.floor(player.currentTime);
				    self.find('i').addClass('playing').text('收听中...');
				    is_end(v_time,n_time);
				}else{
				    player.pause();
				    self.find('i').removeClass('playing').text('播放暂停，点击继续收听');
				    clearTimeout(timer);
				}
		    };
		    function is_end(time1,time2){
		    	timer = setTimeout(function(){
    				self.find('i').removeClass('playing').text('原创语音收评，点击收听');
    				clearTimeout(timer);
    			},(time1-time2)*1000);
		    };
       	}
	};
})(jQuery)




