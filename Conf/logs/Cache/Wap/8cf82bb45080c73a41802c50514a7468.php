<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>我的订单</title>
	<script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css"></head>
<body>
	<style>
		html,body{
			height: 100%;
			background-color: #eeeeee;
		}
	</style>
	<div class="container">
		<div class="weui-row weui-no-gutter" style="background-color: #fff;" id="orders_head">
			<div class="weui-col-20 store_my_col_20 store_my_col_20_extend <?php if(($_REQUEST['status']== -1) OR ($_REQUEST['status']== '')): ?>store_my_col_choose<?php endif; ?>">全部</div>
			<div class="weui-col-20 store_my_col_20 store_my_col_20_extend <?php if(($_REQUEST['status']) == "0"): ?>store_my_col_choose<?php endif; ?>">待付款</div>
			<div class="weui-col-20 store_my_col_20 store_my_col_20_extend <?php if(($_REQUEST['status']) == "1"): ?>store_my_col_choose<?php endif; ?>">待发货</div>
			<div class="weui-col-20 store_my_col_20 store_my_col_20_extend <?php if(($_REQUEST['status']) == "2"): ?>store_my_col_choose<?php endif; ?>">待收货</div>
			<div class="weui-col-20 store_my_col_20 store_my_col_20_extend <?php if(($_REQUEST['status']) == "3"): ?>store_my_col_choose<?php endif; ?>">已完成</div>
		</div>
		<div id="my_orders_content">
			<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="weui_cells" style="margin-top: 0; margin-bottom: 10px;">
					<div class="weui_cell" style="padding: 5px;">
						<div class="weui_cell_hd">
							<img style="width: 70px; display: block;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:20px;margin-right:5px;display:block"></div>
						<div class="weui_cell_bd weui_cell_primary">
							<p style="font-size: 16px; line-height: 25px; text-indent: 5px;">产品名</p>
							<p style="font-size: 16px; line-height: 25px; text-indent: 5px;">产品属性</p>
						</div>
						<div class="weui_cell_ft">
							<p>10.00</p>
							<p>×1</p>
						</div>
					</div>
					<div class="weui_cell" style="padding: 10px;">
						<div class="weui_cell_bd weui_cell_primary">
							<p style="font-size: 14px;">
								共
								<label>1</label>
								件商品
							</p>
						</div>
						<div class="weui_cell_ft" style="font-size: 14px;">
							合计：￥
							<lable>142.00</lable>
						</div>
					</div>
					<div class="weui_cell">
						<div class="weui_cell_bd weui_cell_primary"></div>
						<div class="weui_cell_ft">
							<a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_primary" style="font-size: 16px;">按钮</a>
							<a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_default" style='margin-top: 0; font-size: 16px;'>按钮</a>
						</div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</body>
</html>
<script>
	(function($){
		$(document).on('click','#orders_head div',function(){
			var obj = $(this);
			var status = parseInt(obj.index('#orders_head div'))-1;
			var href = "index.php?g=Wap&m=Store&a=my&status="+status+' #my_orders_content';
			$('#my_orders_content').load(href,function(){
				obj.addClass('store_my_col_choose').siblings().removeClass('store_my_col_choose');
			});
		})
	})($)
</script>