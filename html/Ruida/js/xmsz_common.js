//$(function(){	
//	$('#left-menu').click(function(){
//		$('.zengjia').toggle(0);
//	})
//})
//$(function(){	
//	$('#left-menu1').click(function(){
//		$('.zengjia').hide(0);
//	})
//})

//头部
$(function(){	
	$('.top_2 span').hover(function(){
		$(this).next("p").stop(true,true).slideToggle();
	})
})
$(function(){	
	$('.menu_1').click(function(){
		$(this).next(".menu").stop(true,true).slideToggle();
	})
})
// $(function(){
// 	var M_HIGHT=$(".zcgl").height()-$(".zcgl-1").height()-40;		
// 	if($(window).width()<768){

// 		$(".zcgl-2").css({"max-height":M_HIGHT})
// 	}	
// 	$('.zcgl-3 a.zcgl-c1').removeAttr("href");	
// 	$('.zcgl-3 a.zcgl-c1').click(function(){
// 		$(".zcgl-black").fadeOut();
// 		$(".backlayer").fadeOut();
// 		$(".zcgl").fadeOut();
		
// 	});
// })
// $(".special").addClass("table-responsive");
$(".menu li:last").addClass("menu_b menu_last");
$(".menu li:eq(-2)").addClass("menu_last")
function loadJS() {
	if((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|wOSBrowser|BrowserNG|WebOS)/i))) {
		$(".menu li").click(function(){
			$(this).find(".menu1_2").slideToggle(0).parent().siblings().find(".menu1_2").hide(0);
			$(this).toggleClass('on').siblings().removeClass('on');
		});
	}else{
		$(".menu li").mouseover(function(){
			//$(this).find(".menu1_2").stop(true,true).slideToggle(0);
			$(this).addClass("on");
		});
		$(".menu li").mouseout(function(){
    		$(".menu li").removeClass("on");
	  	});
	  	$(".guide").height($(window).height()*0.75)
	  	$(".guide img").height($(".guide").height())
	  	
	}
}
loadJS();
//bodyright
$(document).ready(function(){
	/*返回顶部*/
	$('.bodyright dt').hide();
	$(window).scroll(function () {
		if ($(window).scrollTop() > 10) {
			$('.bodyright dt').fadeIn(400);//当滑动栏向下滑动时，按钮渐现的时间
		} else {
			$('.bodyright dt').fadeOut(0);//当页面回到顶部第一屏时，按钮渐隐的时间
		}
	});
	$('.bodyright dt,.special_return').click(function () {
		$('html,body').animate({
			scrollTop : '0px'
		}, 300);//返回顶部所用的时间 返回顶部也可调用goto()函数
	});
});
$(function(){	
	$('.bodyright dd span').hover(function(){
		$(this).next("p").stop(true,true).slideToggle(0);
	})
})
//会员中心
// $(function(){
// 	$('.center_sign3 .center_sign4 .c_s').click(function(){
//         $.ajax({
// 			cache: false,
// 			type: "GET",
// 			url:"/users/signin",
// 			dataType:'json',
// 			async: false,		
// 			success: function(data) {
// 				if(data.success){
// 					$("#Shady").show();
//                     $(".center_note").show();
//                     $("#npoint").html(data.signpoint);
// 				}else{
//                     alert(data.msg);
// 					return false;
// 				}
// 			}
//         });
// 	})
// 	$('.center_note .note_close').click(function(){
// 		$("#Shady").hide();
// 		$(".center_note").hide();
// 	})
// })
// $(function(){
// 	$("input[name='addr']:checked").parent().parent().addClass("on").siblings().removeClass("on"); 
// 	$('.center_addr table tr td input').click(function(){
// 		$(this).parent().parent().addClass('on').siblings().removeClass('on');
// 	})
// 	$(".center_addr table tr:even").addClass("hover");
// })
// $(".center_addr3_1 table tr").find(" td input:last").addClass("nr")
// $(".center_addr3_1 table tr").find(" td select:last").addClass("nr")
//开户中心
$(".need:odd").addClass("need_nr");
$(".need").find("dd:last").addClass("need_nr1");

$(".account1 dl dd.ac_1").click(function(){
	$(".account_open").stop(true,true).animate({"top": "0"}, 300);
});
$(".account_return").click(function(){
	if($(window).width()<768){
		$(".account_open").stop(true,true).animate({"top": "100%"}, 300);	
	}else{
		$(".account_open").stop(true,true).animate({"top": "450px"}, 300);
	}
});

