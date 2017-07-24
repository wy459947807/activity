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
    <?php $statusArray=array(1=>"未支付",2=>"已支付",3=>"已取消"); ?>
    <div class="wrap">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo U('TianyiOrder/index');?>">订单列表</a></li>
            <li class="active"><a href="">订单详情</a></li>
        </ul>
        <form action="<?php echo U('TianyiOrder/update');?>" method="post" class="form-horizontal js-ajax-forms" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo ($id); ?>" name="ids[]"/>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="4" style='text-align: center' >订单信息</th>
                        </tr>
                        <tr>
                            <th width="25%">订单编号</th>
                            <td width="25%"><?php echo ($order_sn); ?></td>
                            <th>订单名称</th>
                            <td><?php echo ($order_name); ?></td>
                           
                        </tr>
                      
                        <tr>
                            <th>订单总金额</th>
                            <td><?php echo ($money); ?></td>
                            <th>优惠金额</th>
                            <td><?php echo ($minus_money); ?></td>
                        </tr>
                       
                        <tr>
                            <th width="25%">支付方式</th>
                            <td width="25%"><?php echo ($pay_type); ?></td>
                            <th>实付金额</th>
                            <td><?php echo ($total_money); ?></td>
                        </tr>
                        
                        
                        <tr>
                            <th>购买总数量</th>
                            <td><?php echo ($num); ?></td>
                            <th>下单时间</th>
                            <td><?php echo date('Y-m-d H:i:s',$create_time);?></td>
                        </tr>
                        
        
                        <tr>
                            <th>订单状态</th>
                            <td><?php echo ($statusArray[$status]); ?></td>
                            <th>更新时间</th>
                            <td><?php echo date('Y-m-d H:i:s',$update_time);?></td>
                        </tr>
                        
                        <tr>
                            <th width="25%">会员昵称</th>
                            <td width="25%"><?php echo ($user_name); ?></td>
                            <th width="25%">手机号码</th>
                            <td width="25%"><?php echo ($mobile); ?></td>
                        </tr>
                        <?php if($has_invoice == 1): ?><tr>
                            <th width="25%">发票抬头</th>
                            <td width="25%"><?php echo ($invoice_title); ?></td>
                            <th width="25%">地址</th>
                            <td width="25%"><?php echo ($province); echo ($city); echo ($area); ?>&nbsp;&nbsp;<?php echo ($address); ?></td>
                        </tr><?php endif; ?>
                    </table>
                   
                    
                    
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="7" style='text-align: center' >课程信息</th>
                        </tr>
                        <tr>
                            <th>课程名称</th>
                            <th>购买课时</th>
                            <th>总课时</th>
                            <th>课程价格</th>
                            <th>总金额</th>
                            <th>任课老师</td>
                            <th>所属机构</th>
                        </tr>
                      
                        <?php if(!empty($itemList)): if(is_array($itemList)): foreach($itemList as $key=>$vo): ?><tr>
                                <td><?php echo ($vo["course_name"]); ?></td>
                                <td><?php echo ($vo["num"]); ?></td>
                                <td><?php echo ($vo["hour"]); ?></td>
                                <td><?php echo ($vo["price"]); ?></td>
                                <td><?php echo ($vo["item_money"]); ?></td>
                                <td><?php echo ($vo["teacher_name"]); ?></td>
                                <td><?php echo ($vo["organization"]); ?></td>
                            </tr><?php endforeach; endif; endif; ?>
                    </table>
                    
                </div>
                
            </div>
            <div class="form-actions">
                <?php if($status == 1): ?><button class="btn btn-primary " type="button"  onclick="updateOrder(<?php echo ($id); ?>,2)">设为已付款</button>
                <?php else: ?>
                    <button class="btn btn-primary " type="button"  onclick="updateOrder(<?php echo ($id); ?>,1)">设为未付款</button><?php endif; ?>
                <button class="btn btn-primary " type="button"  onclick="updateOrder(<?php echo ($id); ?>,3)">取消订单</button>
                <a class="btn" href="<?php echo U('TianyiOrder/index');?>">返回</a>
            </div>
        </form>
    </div>
    <script src="/public/js/common.js"></script>

    <script src="/public/js/layer/layer.js"></script>
    <script src="/public/js/expand/Validform/5.3.2/Validform.min.js"></script>
    <script src="/public/js/expand/strongWind.js"></script>

    <script>
        function updateOrder(id,status){
            layer.confirm('你确定修改定单吗？', function(){
                getRemoteData({ids:[id],status:status},"<?php echo U('TianyiOrder/updateStatus');?>",1);
            });
        }
    </script>
</body>
</html>