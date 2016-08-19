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
    <link rel="stylesheet" href="<?php echo RES;?>/original/others2/main.css">
<body style="position: relative;" id="scnhtm5">
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
			<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><div class="weui_cells" style="margin-top: 0; margin-bottom: 10px;">
					<?php if(is_array($o['productInfo'])): $i = 0; $__LIST__ = $o['productInfo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><div class="weui_cell" style="padding: 5px;">
							<div class="weui_cell_hd">
								<img style="width: 70px; display: block;" src="<?php echo ($row["logourl"]); ?>" alt="" style="width:20px;margin-right:5px;display:block"></div>
							<div class="weui_cell_bd weui_cell_primary">
								<p style="font-size: 16px; line-height: 25px; text-indent: 5px;"><?php echo ($row["name"]); ?></p>
								<?php if(!empty($row['detail'])): ?><p style="font-size: 16px; line-height: 25px; text-indent: 5px;">
										<?php echo ($row["formatTitle"]); ?>：<?php echo ($row['detail'][0]['formatName']); ?>
									</p>
									<p style="font-size: 16px; line-height: 25px; text-indent: 5px;"><?php echo ($row["colorTitle"]); ?>：<?php echo ($row['detail'][0]['colorName']); ?></p>
									<?php else: ?>								
									<p style="font-size: 16px; line-height: 25px; text-indent: 5px;">默认属性</p><?php endif; ?>
							</div>
							<div class="weui_cell_ft">
								<p>
									<?php if(!empty($row['detail'])): echo sprintf("%.2f",$row['detail'][0]['showprice']);?>
		                            <?php else: ?>
		                            <?php echo sprintf("%.2f",$row['showprice']); endif; ?>
								</p>
								<p>×
									<?php if(!empty($row['detail'])): echo ($row['detail'][0]['count']); ?>
		                            <?php else: ?>
		                            <?php echo ($row['count']); endif; ?>
								</p>
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="weui_cell" style="padding: 10px;">
						<div class="weui_cell_bd weui_cell_primary">
							<p style="font-size: 14px;">
								共
								<label><?php echo ($o['total']); ?></label>
								件商品
							</p>
						</div>
						<div class="weui_cell_ft" style="font-size: 14px;">
							合计：￥
							<lable><?php if(($o["price"]) == "0"): echo ($o['gold']); else: echo ($o['price']); endif; ?></lable>
						</div>
					</div>
					<div class="weui_cell">
						<div class="weui_cell_bd weui_cell_primary"></div>
						<div class="weui_cell_ft">
							<?php if(($o["paid"] == 0) AND ($o["returnMoney"] == 0)): ?><a href="<?php echo U('Store/payNow',array('id'=>$o['id']));?>" data-id="<?php echo ($o["id"]); ?>" class="weui_btn weui_btn_mini weui_btn_primary place_order" style="font-size: 16px;">立即支付</a><?php endif; ?>
							<?php if(($o["sent"] == 1) AND ($o["receive"] == 0)): ?><a href="javascript:;" data-id="<?php echo ($o["id"]); ?>" class="weui_btn weui_btn_mini weui_btn_primary get_product" style="font-size: 16px;">确认收货</a><?php endif; ?>
							<a href="<?php echo U('Store/orderDetails',array('id'=>$o['orderid']));?>" class="weui_btn weui_btn_mini weui_btn_primary coad_bnfo_lage" style="font-size: 16px;">订单详情</a>
						</div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<!--foot开始-->
<div style="height: 60px;"></div>
<div class="public_foot">
    <div class="weui-row weui-no-gutter">
      <div class="weui-col-25">
        <a href="<?php echo U('Store/index');?>">
          <p class="iconfont">&#xe60d;</p>
          <p>首页</p>
        </a>
      </div>
      <div class="weui-col-25">
        <a href="<?php echo U('Store/cats');?>">
          <p class="iconfont">&#xe60c;</p>
          <p>分类</p>
        </a>
      </div>
      <div class="weui-col-25">
        <a href="<?php echo U('Store/cart');?>">
          <p class="iconfont">&#xe60e;</p>
          <p>购物车</p>
        </a>
      </div>
      <div class="weui-col-25">
        <a href="<?php echo U('Distribution/index');?>">
          <p class="iconfont">&#xe6ca;</p>
          <p>我的</p>
        </a>
      </div>
    </div>
</div>

<script>
    (function($){
      var module = "<?php echo MODULE_NAME;?>";
      var action = "<?php echo ACTION_NAME;?>";
      var rule_wrap = $(".rule");
      if(module == "Store" && action == "daily"){
        $('.daily').addClass('choose');
      }
      if(module == "Store" && action == "cats"){
        $('.cats').addClass('choose');
      }
      if(module == "Store" && action == "index"){
        $('.Sindex').addClass('choose');
      }
      if(module == "Distribution" && action == "index"){
        $('.Dindex').addClass('choose');
      }
    })(jQuery)
  </script>
<!--foot结束-->

<script>
function onBridgeReady(){
 WeixinJSBridge.call('hideOptionMenu');
}

if (typeof WeixinJSBridge == "undefined"){
    if( document.addEventListener ){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }
}else{
    onBridgeReady();
}
</script>
  <div class="clear"></div>
    <?php if((ACTION_NAME) != "herolist"): ?><section class="foot"></section><?php endif; ?>
</body>
</html>
<script type="text/javascript" src="<?php echo RES;?>/original/js/require.js" data-main="<?php echo RES;?>/original/js/main"></script>
<script>
    function getAction(module,action){
        return "http://<?php echo ($url_par); ?>?g=Wap&m="+module+"&a="+action;
    }
</script>