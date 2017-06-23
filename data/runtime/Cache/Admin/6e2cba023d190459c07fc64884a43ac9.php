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
    <?php $statusArray=array(1=>"未查阅",2=>"已查阅"); ?>
    <div class="wrap">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo U('SyhJoin/index');?>">用户列表</a></li>
            <li  class="active"><a >用户详情</a></li>
        </ul>
        <form action="<?php echo U('SyhJoin/update');?>" method="post" class="form" id="advertUpdate" enctype="multipart/form-data">
            <?php if($id != 0): ?><input type="hidden"  name="id" value="<?php echo ($id); ?>"/><?php endif; ?>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-bordered">

                        <tr>
                            <th>姓名</th>
                            <td><?php echo ($name); ?></td>
                        </tr>
                        <tr>
                            <th>手机</th>
                            <td><?php echo ($mobile); ?></td>
                        </tr>
 
                        <tr>
                            <th>状态</th>
                            <td><?php echo ($statusArray[$status]); ?></td>
                        </tr>

                        <tr>
                            <th>报名日期</th>
                            <td><?php echo ($create_time); ?></td>
                        </tr>

                    </table>
                </div>

            </div>
            <div class="form-actions">
                <!--<button class="btn btn-primary " type="button" onclick="$('#advertUpdate').submit()">返回</button>-->
                <a class="btn btn-primary" href="<?php echo U('SyhJoin/index');?>">返回</a>
            </div>
        </form>
    </div>
    <div id="killers" style="display: none"></div>
    <script src="/public/js/common.js"></script>

    <script src="/public/js/layer/layer.js"></script>
    <script src="/public/js/expand/Validform/5.3.2/Validform.min.js"></script>
    <script src="/public/js/expand/strongWind.js"></script>

</body>
</html>