<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" style="font-size: 20px;">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<title>下单结算</title>
	<link rel="stylesheet" href="<?php echo RES;?>/address/css/address.css">
	<link rel="stylesheet" href="<?php echo RES;?>/address/css/iconfont.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min2.css">

	<script type="text/javascript" src="<?php echo RES;?>/js/jquery-1.11.1.min.js"></script>

	<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>
	<link type="text/css" rel="stylesheet" href="<?php echo RES;?>/css/store/css/style_touch11.css">
	<script type="text/javascript">
var w,h,className;
function getSrceenWH(){
	w = $(window).width();
	h = $(window).height();
	$('#dialogBg').width(w).height(h);
}

window.onresize = function(){  
	getSrceenWH();
}  
$(window).resize();  

$(function(){
	getSrceenWH();
	
	//显示弹框
	$('.box a').click(function(){
		className = $(this).attr('class');
		$('#dialogBg').fadeIn(300);
		$('#dialog').removeAttr('class').addClass('animated '+className+'').fadeIn();
	});
	
	//关闭弹窗
	$('.claseDialogBtn').click(function(){
		$('#dialogBg').fadeOut(300,function(){
			$('#dialog').addClass('bounceOutUp').fadeOut();
		});
	});
});
</script>
</head>
<body id="scnhtm5" style="position: relative;">
	<div class="index_wrap">
		<div id="shouhuo_add">
			<a href="<?php echo U('Distribution/myAddress');?>" id="address_list_btn">
				<div class="shouhuo_add1" id="myaddress"></div>
			</a>
		</div>

		<div class="shouhuo_all">
			<div class="line"></div>

			<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i; if(empty($p['detail']) != true): ?><div class="shouhuo_all1">
						<div class="shouhuo_img">
							<img src="<?php echo ($p["logourl"]); ?>"/>
						</div>
						<div class="shouhuo_pro">
							<div class="shouhuo_pro_name"><?php echo ($p["name"]); ?></div>
							<?php if(is_array($p['detail'])): $i = 0; $__LIST__ = $p['detail'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i; if(empty($p['formatTitle']) != true): ?><div class="shouhuo_pro_name"><?php echo ($p["formatTitle"]); ?>：<?php echo ($row["formatName"]); ?></div><?php endif; ?>
								<?php if(empty($p['colorTitle']) != true): ?><div class="shouhuo_pro_name"><?php echo ($p["colorTitle"]); ?>：<?php echo ($row["colorName"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<div class="shouhuo_pro1">
							<?php if(($p["price"]) != "0"): ?><div class="shouhuo_pro_price">￥<?php echo ($p["detail"]["0"]["price"]); ?></div><?php endif; ?>
							<div class="shouhuo_pro_price">x<?php echo ($p["detail"]["0"]["count"]); ?></div>
						</div>
					</div>
					<?php else: ?>
					<div class="shouhuo_all1">
						<div class="shouhuo_img">
							<img src="<?php echo ($p["logourl"]); ?>"/>
						</div>
						<div class="shouhuo_pro">
							<div class="shouhuo_pro_name"><?php echo ($p["name"]); ?></div>
						</div>
						<div class="shouhuo_pro1">
							<div class="shouhuo_pro_price">￥<?php echo ($p["price"]); ?></div>
							<div class="shouhuo_pro_price">x<?php echo ($p["count"]); ?></div>
						</div>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

			<div class="line"></div>
			<div class="shouhuo_all1">
				<div class="shouhuo_yunfei">运费</div>
				<div class="shouhuo_yunfei1">
					<?php if(($mailprice) == "0"): ?>包邮
						<?php else: ?>
						<?php echo ($mailprice); endif; ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="line"></div>
			<div class="shouhuo_all1">
				<div class="shouhuo_yunfei">合计</div>
				<div class="shouhuo_yunfei1">￥<?php echo ($totalFee+$mailprice); ?></div>
				<div class="clear"></div>
			</div>
			<div class="line"></div>
		</div>
		<input type="hidden" id="paymode" name="paymode" <?php if(($account['lid'] < 4) AND ($account['lid'] != 0)): ?>value="2"<?php else: ?>value="1"<?php endif; ?>>
		<div class="pay">
			<div class="weui_cells_title" style="padding-left: 2%;">支付方式</div>
			<div class="weui_cells weui_cells_radio">
			  <?php if(($account["lid"] > 3) OR ($account["lid"] == 0)): ?><label class="weui_cell weui_check_label choose_paymode" data-pay="1" for="x11">
			    <div class="weui_cell_bd weui_cell_primary">
			      <p><label class="payway">微信支付</label></p>
			    </div>
			    <div class="weui_cell_ft">
			      <input type="radio" class="weui_check" name="radio1" id="x11"  checked="checked">
			      <span class="weui_icon_checked"></span>
			    </div>
			  </label><?php endif; ?>
			<?php if(empty($lid)): ?><label class="weui_cell weui_check_label choose_paymode" data-pay="2" for="x12">
				    <div class="weui_cell_bd weui_cell_primary">
				      <p><label class="payway">绿色咪豆
支付</label>
				      	<?php if(empty($account)): ?><label>尚未登陆</label>
				      		<?php else: ?>
				      		<label style="color:#f59b10;">(<?php echo (($green)?($green):0); ?>)</label><?php endif; ?>
				      </p>
				    </div>
				    <div class="weui_cell_ft">
				    <input type="radio" name="radio1" class="weui_check" id="x12" <?php if(($account['lid'] < 4) AND ($account['lid'] != 0)): ?>checked="checked"<?php endif; ?>>
				      <span class="weui_icon_checked"></span>
				    </div>
				  </label><?php endif; ?>
			</div>
		</div>
		<script>
			(function($){
				$('.choose_paymode').on('click',function(){
					var paymode = $(this).data('pay');
					var payname = $(this).find('.payway').text();
					$('.pay_fangshi').text(payname);
					$('#paymode').val(paymode);
				})
			})($)
		</script>

		<div class="remark_wrap" style="margin-top: 12px;">
			<textarea style="border: none; width: 100%;height: 100px;border-bottom: 1px solid #e6e4e4;padding: 2%;" name="remark" id="remark" placeholder="备注信息"></textarea>
		</div>

		<div class="go_pay">
			<div class="pay_left">
				<div class="pay_heji">
					合计:
					<span>￥<?php echo ($totalFee+$mailprice); ?></span>
				</div>
				<div class="pay_fangshi">微信支付</div>
			</div>
			<div class="pay_right" id="sub_order">去支付</div>
		</div>
	</div>
	<?php if(empty($account)): ?><input type="hidden" id="noaccount" value="1"><?php endif; ?>
</body>
	<script>
	//获取默认地址
	var add_wrap = $("#myaddress");
	var checkAdd = 0;
	$.ajax({
		url:"<?php echo U('Distribution/getMyAddress',array('token' => $token, 'wecha_id'=>$wecha_id));?>",
		dataType:'json',
		success:function(data){
			if(data.status==1){
				checkAdd=1;
			}
			add_wrap.html(data.data);
		}
	});
	$("#sub_order").click(function(){
		if($('#noaccount').val() == 1){
			location.href = "<?php echo U('Distribution/login');?>";
			return;
		}
		var paymode = $('#paymode').val();
		if(checkAdd !=1){
			return floatNotify.simple('请选择地址');
			return false;
		}
		if(paymode != 1){
			//判断咪豆余额
			$.ajax({
				url:"<?php echo U('Store/orderCartJudge');?>",
				data:{money:<?php echo ($totalFee+$mailprice); ?>},
				dataType:'json',
				success:function(data){
					if(data.status == 1){
						confirm = floatNotify.confirm('确认使用咪豆支付吗？',"",
							function(t,n){
								if(n==true){
						            var reamrk = $('#remark').val();
									location.href = "<?php echo U('Store/ordersave',array('token' => $token, 'wecha_id'=>$wecha_id, 'orderid'=>$orderid,'lid'=>$lid,'normid'=>$normid,'remark'=>'"+reamrk+"','paymode'=>'"+paymode+"'));?>";
								}
							this.hide();
						}),
						confirm.show();
					}else{
						floatNotify.simple(data.info);
					}
				}
			});
		}else{
			var reamrk = $('#remark').val();
			location.href = "<?php echo U('Store/ordersave',array('token' => $token, 'wecha_id'=>$wecha_id, 'orderid'=>$orderid,'lid'=>$lid,'normid'=>$normid,'remark'=>'"+reamrk+"','paymode'=>'"+paymode+"'));?>";
		}
		// if(checkAdd == 1 && paymode!=1){
		// 	//判断咪豆
余额
		// 	$.ajax({
		// 		url:"<?php echo U('Store/orderCartJudge');?>",
		// 		data:{money:<?php echo ($totalFee+$mailprice); ?>},
		// 		dataType:'json',
		// 		success:function(data){
		// 			if(data.status == 1){
		// 	            var reamrk = $('#remark').val();
		// 				location.href = "<?php echo U('Store/ordersave',array('token' => $token, 'wecha_id'=>$wecha_id, 'orderid'=>$orderid,'lid'=>$lid,'remark'=>'"+reamrk+"'));?>";
		// 			}else{
		// 				floatNotify.simple(data.info);
		// 			}
		// 		}
		// 	});
		// }else{
		// 	return floatNotify.simple('请选择地址');
		// 	return false;
		// }
	});
</script>

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
	<script type="text/javascript">
window.shareData = {  
            "moduleName":"Store",
            "moduleID":"0",
            "imgUrl": "<?php echo C('site_url') . U('Store/orderCart',array('token' => $_GET['token']));?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/orderCart',array('token' => $_GET['token']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/orderCart',array('token' => $_GET['token']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/orderCart',array('token' => $_GET['token']));?>",
            "tTitle": "<?php echo ($metaTitle); ?>",
            "tContent": "<?php echo ($metaTitle); ?>"
        };
</script>
	<?php echo ($shareScript); ?>
</html>
<!-- 加载信息框 -->
<script type="text/javascript" src="<?php echo RES;?>/original/js/require.js" data-main="<?php echo RES;?>/original/js/main"></script>
<script>
    function getAction(module,action){
    	var href= "http://<?php echo ($url_par); ?>?g=Wap&m="+module+"&a="+action;
        return href;
    }
</script>