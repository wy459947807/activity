<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>我为老师代言</title>
    <meta name="referrer" content="origin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/themes/simplebootx/Public/Daiyan/css/represent.css">
    <script type='text/javascript' src='/themes/simplebootx/Public/Daiyan/js/zepto.min.js'></script>
    <style type="text/css">
        .btn-reset-next {
            display: inline-block;
            width: 100%;
            background: #fc534c;
            color: #fff;
            font-size: 0.8em;
            border: 0;
            outline: none;
        }

        .input-style {
            border: none;
            border-radius: 3px;
            border: 1px solid #000000;
            color: #666;
            margin: 0 0.4em;
            text-align: center;
        }

        .btn-last {
            width: 8em;
            height: 3em;
            line-height: 3em;
            background: #fc534c;
            color: #fff;
            display: block;;
        }
    </style>
</head>
<body style="height: 100%">

<div style="text-align: center">
    <!-- 填写表单数据 -->
    <div id="page1" style="background: #f1f1f1;">
        <div><img src="/themes/simplebootx/Public/Daiyan/images/img_head.jpg" style="display: block;width: 100%;height: auto; padding: 0"></div>
        <div style="padding:10px 15px 15px 15px;font-size:16px;width: 100%;">
            <div style="width: 100%">
                <div style="margin-bottom: 1em">您已经成为第 <span id="count_represent" style="color: #f44336;">2222</span> 位代言人</div>
                <div style="background:#fff;text-align: left;padding:1px 20px;">
                    <p>填写个人信息：</p>
                    <p>我是来自<input type="text" id="province" class="input-style" size="8" placeholder="省"><input type="text" id="city" class="input-style" size="8" placeholder="城市">的<input type="text" id="name" class="input-style" size="8" placeholder="姓名">
                    </p>
                    <p>我是<span style="color: #f44336;">知行合一投资赢家</span>第<input type="text" id="term" class="input-style" size="6">期学员</p>
                    <p>我是一个<input type="text" id="desc" class="input-style" size="12" placeholder="乐观、包容...">的人<span style="color: #b5b5b5">（自评，需语言简洁）</span></p>
                </div>
                <div style="margin-top: 1em;text-align: center;">
                    <a href="#" id="next1-btn" class="button button-big btn-reset-next">下一步</a>
                </div>
            </div>
            <div style="color: #333;font-size: 14px;text-align: left">
                <div style="text-align: center;margin: 2em 0 1em 0;">
                    <img src="/themes/simplebootx/Public/Daiyan/images/img_description.png" style="width: 100%">
                </div>
                <p>1、感谢你如实填写个人信息，为行业发声，为十年赢家、为老师代言；</p>
                <p>2、如果您愿意，您可以生产并保存图片后，转发至朋友圈，成为老师的代言人;</p>
            </div>
        </div>
    </div>

    <!--制作页面-->
    <div id="work_place" style="width: 100%;height: 100%;position: absolute;display:none">

        <!--上传图按钮-->
        <img src="/themes/simplebootx/Public/Daiyan/images/photo.png" id="photo-btn" style="width: 30%;margin: 4em auto 0;display: block;">
        <div style="align-items: center">
            <img src="/themes/simplebootx/Public/Daiyan/images/move2.png" id="photo-move"
                 style="position:absolute;left:0;width:100%;z-index: 1002;display: none;">
        </div>

        <!--移动调整层-->
        <div id="cover"
             style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;background-size:100% 100%;z-index: 996">
        </div>

        <!--蒙板层-->
        <div style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;z-index: 995">
            <canvas id="mask"></canvas>
        </div>

        <!--点击上传-->
        <canvas id="canvashide" style="display:none"></canvas>
        <!--制作中使用-->
        <canvas id="canvas1"></canvas>

        <input id="my_file" type="file" accept="image/*" style="position: absolute;top:0;left:0;opacity: 0; width: 100%;height: 100%;z-index: 997;"/>

        <!--点击生成按钮-->
        <div class="content-block" id="btn"
             style="position: absolute;bottom: 1.5em;z-index: 998;padding:1.5em;width:100%;display: none">
            <a href="javascript:;" class="button btn-last" style="float: left"
               onclick="resubmit_pic();">重新选择照片</a>
            <a href="javascript:;" id="makeOk" onclick="makeOk();" style="float:right" class="button btn-last">生成代言卡</a>
        </div>
    </div> </div>
    <!--最后生成的图片-->
    <img id="makeOkImg" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;z-index: 1001;display: none;">
    <div style="position: absolute;height:2.5em;bottom: 0em;left: 0;width: 100%; color: #fff;z-index: 1002;display:none;font-size: 14px;"
         id="save-pic-tips">
        <div style="text-align: center;">长按图片保存转发朋友圈</div>
        <br>
    </div>
</div>
</body>
<script src="/themes/simplebootx/Public/Daiyan/js/easeljs-0.8.2.min.js"></script>
<script src="/themes/simplebootx/Public/Daiyan/js/exif.js"></script>
<script src="/themes/simplebootx/Public/Daiyan/js/megapix-image.js"></script>
<script src="/themes/simplebootx/Public/Daiyan/js/touch.min.js"></script>
<script src="/themes/simplebootx/Public/Daiyan/js/response.js"></script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "js/hm.js";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</html>