<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/",
	    WEB_ROOT: "/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
    <?php $statusArray=array(1=>"正常",2=>"停用"); $typeArray=array(1=>"线上优惠券",2=>"线下优惠券"); ?>
    <div class="wrap">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo U('MiguTicket/index');?>">优惠券列表</a></li>
            <li  class="active"><a href="<?php echo U('MiguTicket/update');?>">添加优惠券</a></li>
        </ul>
        <form action="<?php echo U('MiguTicket/update');?>" method="post" class="form" id="dataUpdate" enctype="multipart/form-data">
            <?php if($id != 0): ?><input type="hidden"  name="id" value="<?php echo ($id); ?>"/><?php endif; ?>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-bordered">
                        <tr>
                            <th  width="150">类型</th>
                            <td>
                                <select id="type" name="type">
                                    <?php if(is_array($typeArray)): foreach($typeArray as $key=>$vo): $selected=$type==$key?"selected":""; ?>
                                        <option value="<?php echo ($key); ?>"<?php echo ($selected); ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th  width="150">图片</th>
                            <td>
                                <input type="hidden" name="img" id="img" value="<?php echo ($img); ?>">
<a href="javascript:upload_one_image('图片上传','#img');">
    <?php if(empty($img)): ?><img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="img-preview" width="135" style="cursor: hand"/>
        <?php else: ?>
        <img src="<?php echo sp_get_image_preview_url($img);?>" id="img-preview" width="135" style="cursor: hand"/><?php endif; ?>
</a>
<input type="button" class="btn btn-small" onclick="$('#img-preview').attr('src', '/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#img').val('');return false;" value="取消图片">  
                            </td>
                        </tr>
      
                        <tr>
                            <th>券名</th>
                            <td><input type="text" name="name"  value="<?php echo ($name); ?>" ></td>
                        </tr>
                        
                        
                        <tr>
                            <th>抵用金额</th>
                            <td><input type="text" name="price"  value="<?php echo ($price); ?>" ></td>
                        </tr>
                        
                        <tr>
                            <th>券码</th>
                            <td><input type="text" name="code"  value="<?php echo ($code); ?>" ></td>
                        </tr>
                        
                        <tr>
                            <th  width="150">是否有时间限制</th>
                            <td>
                                <?php $radioSelect=!empty($is_time_limit)?$is_time_limit:1 ?>
                                <input style="vertical-align:middle" name="is_time_limit" type="radio" value="1"  <?php if($radioSelect == 1): ?>checked="checked"<?php endif; ?> />无
                                <input style="vertical-align:middle" name="is_time_limit" type="radio" value="2"  <?php if($radioSelect == 2): ?>checked="checked"<?php endif; ?> />有
                            </td>
                        </tr>
                        
                        <tr>
                            <th>有效期</th>
                            <td>
                                <input type="text" name="start_time" class="js-datetime" value="<?php echo date('Y-m-d H:i:s',$start_time);?>" style="width: 120px;" autocomplete="off">-
                                <input type="text" name="end_time"  class="js-datetime" value="<?php echo date('Y-m-d H:i:s',$end_time);?>" style="width: 120px;" autocomplete="off"> &nbsp; &nbsp;
                            </td>
                        </tr>
   
                    </table>
                </div>

            </div>
            <div class="form-actions">
                <button class="btn btn-primary " type="button" onclick="$('#dataUpdate').submit()">点击提交</button>
                <a class="btn" href="<?php echo U('MiguTicket/index');?>">返回</a>
            </div>
        </form>
    </div>
    <div id="killers" style="display: none"></div>
    <script src="/public/js/common.js"></script>  
    <script type="text/javascript">
        //编辑器路径定义
        var editorURL = GV.WEB_ROOT;
    </script>
    <script type="text/javascript" src="/public/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/public/js/ueditor/ueditor.all.min.js"></script>

    <script src="/public/js/layer/layer.js"></script>
    <script src="/public/js/expand/Validform/5.3.2/Validform.min.js"></script>
    <script src="/public/js/expand/strongWind.js"></script>

    <script>
        editorcontent = new baidu.editor.ui.Editor();
        editorcontent.render('content');
    </script>
</body>
</html>