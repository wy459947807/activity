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
    <?php $statusArray=array(1=>"正常",2=>"停用"); ?>
    <div class="wrap">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo U('Actresult/index');?>">结果列表</a></li>
            <li  class="active"><a href="<?php echo U('Actresult/update');?>">发布结果</a></li>
        </ul>
        <form action="<?php echo U('Actresult/update');?>" method="post" class="form" id="actresultUpdate" enctype="multipart/form-data">
            <?php if($id != 0): ?><input type="hidden"  name="id" value="<?php echo ($id); ?>"/><?php endif; ?>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-bordered">
                        
                        <tr>
                            <th  width="100">选择问题</th>
                            <td>
                            <select id="navcid_select" name="question_id">
                                <?php if(is_array($questionList)): foreach($questionList as $key=>$vo): $selected=$vo['id']==$question_id?"selected":""; ?>
                                    <option value="<?php echo ($vo["id"]); ?>"<?php echo ($selected); ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; ?>
                            </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>起始分数</th>
                            <td><input type="text" name="start_score"  value="<?php echo ($start_score); ?>" ></td>
                        </tr>
                        
                        <tr>
                            <th>起始分数</th>
                            <td><input type="text" name="end_score"  value="<?php echo ($end_score); ?>" ></td>
                        </tr>
   
                        <tr>
                            <th>总体评价</th>
                            <td>
                                <textarea name="comment" style="width: 50%; height: 100px;" placeholder="请填写总体评价"><?php echo ($comment); ?></textarea>
                            </td>
                        </tr>

                    </table>
                </div>

            </div>
            <div class="form-actions">
                <button class="btn btn-primary " type="button" onclick="$('#actresultUpdate').submit()">点击提交</button>
                <a class="btn" href="<?php echo U('Actresult/index');?>">返回</a>
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