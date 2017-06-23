;
(function ($) {
    $.cash = {
        init: function () {
            $.cash.begin_test();
            $.cash.answer_subject();
            $.cash.prev_subject();
            $.cash.repeat_test();
            $.cash.goto_share();
        },
        // 开始测试
        begin_test: function () {
            $(document).on('click', '#begin_test', function () {
                $.cash.next_screen();
            });
            
            $(document).on('click', '.make-result', function () {
                submit_answer();//提交答案
                $.cash.next_screen();
            }); 
        },
        // 答题
        answer_subject: function () {
            $('.test-subject dd').on('click', function () {
                answer_subject(this);
                var self = $(this),
                par = self.parent('dl');
                self.addClass('selected').siblings('dd').removeClass('selected');
                if (!par.is('.last-one')) {
                    par.addClass('answered');
                }
                if (par.hasClass('last-one')) {
                    return !1;
                }
                setTimeout(function () {
                    $.cash.next_screen();
                }, 0.6E3);
            })
        },
        // 上一题
        prev_subject: function () {
            $(document).on('click', 'button.last-one', function () {
                $('.evaluat-item').find('dl').removeClass('answered');
                $.cash.prev_screen();
            })
        },
        // 重新答题
        repeat_test: function () {
            $(document).on('click', 'button.pre-test', function () {
                $.cash.next_screen(1);
                $('.evaluat-item').find('dl').removeClass('answered');
                $('.evaluat-item dl').find('dd').removeClass('selected');
                reset_answers();//重置答案
            })
        },
        //分享
        goto_share: function () {
            $(document).on('click', '#go_share', function () {
                var self = $(this),
                        tip = self.parent('.share-box').siblings('.point-box');
                tip.show();
                tip.on('click', function () {
                    $(this).hide();
                })
            })
        },
        // 向下滚动一屏
        next_screen: function (option) {
            var wh = $(window).height(),
                    scroll_obj = $('.evaluat-slider'),
                    height = (-wh),
                    now_top = parseInt(scroll_obj.css('top')), next_top;
            if (option) {
                next_top = height * (parseInt(option));
            } else {
                next_top = now_top + height;
            }
            scroll_obj.animate({top: next_top}, 300);
        },
        //向上滚动一屏
        prev_screen: function () {
            var wh = $(window).height(),
                    scroll_obj = $('.evaluat-slider'),
                    height = wh,
                    now_top = parseInt(scroll_obj.css('top')),
                    next_top = now_top + height;
            scroll_obj.animate({top: next_top}, 300);
        }
    };
    $.cash.init();
})(jQuery);



