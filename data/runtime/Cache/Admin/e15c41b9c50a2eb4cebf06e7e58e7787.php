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
    <div class="wrap js-check-wrap">
        <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo U('WuweiArticle/index');?>">评论列表</a></li>
            <li><a href="<?php echo U('WuweiArticle/update');?>">添加评论</a></li>
        </ul>
        <form class="well form-search" method="post" action="<?php echo U('WuweiArticle/index');?>"> 

            发布时间：
            <input type="text" name="start_time" class="js-datetime" value="<?php echo ((isset($formget["start_time"]) && ($formget["start_time"] !== ""))?($formget["start_time"]):''); ?>" style="width: 120px;" autocomplete="off">-
            <input type="text" class="js-datetime" name="end_time" value="<?php echo ((isset($formget["end_time"]) && ($formget["end_time"] !== ""))?($formget["end_time"]):''); ?>" style="width: 120px;" autocomplete="off"> &nbsp; &nbsp;
            关键字： 
            <input type="text" name="keyword" style="width: 200px;" value="<?php echo ((isset($formget["keyword"]) && ($formget["keyword"] !== ""))?($formget["keyword"]):''); ?>" placeholder="请输入关键字...">
            <input type="submit" class="btn btn-primary" value="搜索" />
            <a class="btn btn-danger" href="<?php echo U('WuweiArticle/index');?>">清空</a>
        </form>

        
        <form class="js-ajax-form" method="post">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th width="15"><label><input type="checkbox" class="js-check-all" data-direction="x" data-checklist="js-check-x"></label></th>
                    <th width="50">ID</th>
                    <th>缩略图</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>状态</th>
                    <th>推荐数量</th>
                    <th>预览数量</th>
                    <th>创建日期</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($dataList)): foreach($dataList as $key=>$vo): ?><tr>
                    <td><input type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x" name="ids[]" value="<?php echo ($vo["id"]); ?>"></td>
                    <td><?php echo ($vo["id"]); ?></td>  
                    <td>
                        <?php if($vo['img'] != null): ?><a href="javascript:parent.image_preview_dialog('<?php echo ($vo["img"]); ?>');" style=" margin-right: 10px"><img  width="30" height="30" src="<?php echo ($vo["img"]); ?>"/></a><?php endif; ?>
                    </td>
                    <td><?php echo ($vo["title"]); ?></td>
                    <td><?php echo ($vo["author"]); ?></td>
                    <td><?php echo ($statusArray[$vo['status']]); ?></td>
                    <td><?php echo ($vo["rec_num"]); ?></td>
                    <td><?php echo ($vo["view_num"]); ?></td>
                    <td><?php echo ($vo["create_time"]); ?></td>
                    <td>
                        <a href="<?php echo U('WuweiArticle/update',array('id'=>$vo['id']));?>">修改</a> | 
                        <?php if($vo["status"] == 1): ?><a href="javascript:void(0)" onclick="updateStatus(<?php echo ($vo["id"]); ?>,2)">禁用</a> |   
                        <?php else: ?>
                            <a href="javascript:void(0)" onclick="updateStatus(<?php echo ($vo["id"]); ?>,1)">启用</a> |<?php endif; ?>
                        <a href="javascript:void(0)" onclick="deleteInfo(<?php echo ($vo["id"]); ?>)">删除</a> 
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
            
        <div class="table-actions">
            <button class="btn btn-primary btn-small js-ajax-submit"  type="submit" data-action="<?php echo U('WuweiArticle/updateStatus');?>" data-subcheck="true"  data-msg="你确定停用吗？">批量禁用</button>
            <button class="btn btn-primary btn-small js-ajax-submit"  type="submit" data-action="<?php echo U('WuweiArticle/deleteInfo');?>" data-subcheck="true"  data-msg="你确定删除吗？">批量删除</button>
        </div>
  
        <div class="pagination"><?php echo ($page); ?></div>
        </form>
    </div>
    <script src="/public/js/common.js"></script>
    
    <script src="/public/js/layer/layer.js"></script>
    <script src="/public/js/expand/Validform/5.3.2/Validform.min.js"></script>
    <script src="/public/js/expand/strongWind.js"></script>

    <script>
        function updateStatus(id,status){
            layer.confirm('你确定更新状态吗？', function(){
                getRemoteData({ids:[id],status:status},"<?php echo U('WuweiArticle/updateStatus');?>",1);
            });
        }
        
        function deleteInfo(id){
            layer.confirm('你确定删除吗？', function(){
                getRemoteData({ids:[id]},"<?php echo U('WuweiArticle/deleteInfo');?>",1);
            });
        }
    </script>
</body>
</html>