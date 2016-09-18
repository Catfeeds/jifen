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
		<div class="weui_cells weui_cells_form">
			<div class="weui_cell weui_cell_select">
			  <div class="weui_cell_bd weui_cell_primary">
			    <select class="weui_select" name="select1" id="select_agent">
			      <option selected="" value="0">选择代理点</option>
			      <?php if(is_array($agents)): $i = 0; $__LIST__ = $agents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["id"]); ?>"><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			    </select>
			  </div>
			</div>
			<div class="weui_cell weui_cell_select">
			  <div class="weui_cell_bd weui_cell_primary">
			    <select class="weui_select" name="select1" id="select_account">
			      <option selected="" value="0">请先选择代理点</option>
			    </select>
			  </div>
			</div>
			<div id="select_account_info" style="text-align: center;">
		</div>
			
		</div>
		<script>
			(function($){
				//选择代理点
				$('#select_agent').on('change',function(){
					var gid = $(this).val();
					var info_wrap = $('#select_account');
					if(gid != 0){
						$.ajax({
							url:"<?php echo U('Store/selectAccountListFromGid');?>",
							data:{gid:gid},
							dataType:'json',
							success:function(data){
								console.log(data);
								info_wrap.html(data.info);
							}
						});
					}
				})
				//选择账号
				$('#select_account').on('change',function(){
					var aid = $(this).val();
					var info_wrap = $('#select_account_info')
					$.ajax({
						url:"<?php echo U('Store/selectGetAccountInfo');?>",
						data:{aid:aid,pay:"<?php echo ($totalFee+$mailprice); ?>"},
						dataType:'json',
						success:function(data){
							console.log(data);
							info_wrap.html(data.info);
							$('#account_wrap').prepend(data.data);
						}
					});
				})
			})($)
		</script>
		<div class="pay">
			<div class="weui_cells" style="margin-top: 0;" id="account_wrap">
				<div class="weui_cell">
					<div class="weui_cell_hd">
						<label class="weui_label" style="width:50px;">账号</label>
					</div>
					<div class="weui_cell_bd weui_cell_primary">
						<input class="weui_input account_name" type="text"placeholder="请输入账号">
					</div>
					<div class="weui_cell_ft">
						<div class="account_info">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="text-align: center;font-size: 15px;line-height: 34px; background-color: #fff;" id="add_new_account">
			点击添加新账号
		</div>
		<script>
			(function($){
				//添加新账号
				$('#add_new_account').click(function(){
					var account_wrap = $('#account_wrap');
					var account_item = $('#account_wrap div:eq(0) ');
					// var account_html = account_item.prop("outerHTML");
					var account_html = '<div class="weui_cell"><div class="weui_cell_hd"><labe class="weui_label" style="width:50px;">账号</label></div><div class="weui_cell_bd weui_cell_primary"><input class="weui_input account_name" type="text"placeholder="请输入账号"></div><div class="weui_cell_ft"><div class="account_info"></div></div></div>';
					account_wrap.append(account_html);
				})
				//输入账号实时刷新
				$(document).on('keyup','.account_name',function(){
					var username = $(this).val();
					var info_wrap = $(this).parents('.weui_cell_bd').next().find('.account_info');
					var info = '<a href="javascript:;">绿:<label class="green">0</label></a><a href="javascript:;">黑:<label class="black">0</label></a>';
					$.ajax({
						url:"<?php echo U('Store/getAccountInfo');?>",
						data:{username:username,pay:"<?php echo ($totalFee+$mailprice); ?>"},
						dataType:'json',
						success:function(data){
							console.log(data);
							if(data.status == 0){
								info_wrap.html(data.info);
							}else{
								info_wrap.html(data.data);
							}
						}
					});
				})
			})($)
		</script>
		<div class="weui_cells" style="margin-top: 0;" >
			<div class="weui_cell">
				<div class="weui_cell_hd">
					<label class="weui_label" style="width:50px;">运费</label>
				</div>
				<div class="weui_cell_bd weui_cell_primary">
					<input class="weui_input" type="text" value="0" id="freight" placeholder="请输入运费金额">
				</div>
			</div>
		</div>
		<script>
			(function($){
				$('#freight').keyup(function(event) {
					var freight= parseInt($('#freight').val());
					var total = parseInt("<?php echo ($totalFee+$mailprice); ?>");
					console.log(total);
					if(!isNaN(freight)){
						console.log('aa');
						var newprice = total + freight;
						$('#totalPrice').text(newprice);
					}else{
						console.log('bb');

						$('#totalPrice').text(total);
					}
				});
			})(jQuery)
		</script>
		<div class="remark_wrap" style="margin-top: 12px;">
			<textarea style="border: none; width: 100%;height: 100px;border-bottom: 1px solid #e6e4e4;padding: 2%;" name="remark" id="remark" placeholder="备注信息"></textarea>
		</div>

		<div class="go_pay">
			<div class="pay_left">
				<div class="pay_heji">
					合计:
					￥<span id="totalPrice"><?php echo ($totalFee+$mailprice); ?></span>
				</div>
				<?php if(($account["admin"]) == "1"): ?><div class="pay_fangshi">绿色积分支付</div>
					<?php else: ?>
			 		<div class="pay_fangshi">微信支付</div><?php endif; ?>
			</div>
			<div class="pay_right" id="sub_order">确认</div>
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
	$(document).on('click',"#sub_order",function(){
		if($('#noaccount').val() == 1){
			location.href = "<?php echo U('Distribution/login');?>";
			return;
		}
		if(checkAdd !=1){
			return floatNotify.simple('请选择地址');
			return false;
		}
		if($('.account_id').length == 0){
			return floatNotify.simple('请选择账号');
			return false;
		}
		// var username = $('.account_name').val();
		var reamrk = $('#remark').val();
		var freight = $('#freight').val();
		if(isNaN(freight) || freight<0){
			floatNotify.simple('运费有误');
		}
		var loading = $("<div id='public_loading_page'> <div class='public_loading_page_img_item'> <img src='./tpl/Wap/default/common/images/loading.gif'> <p>发送...</p> </div> </div>")
		$("body").prepend(loading);
		loading.show();
		$('.account_id').each(function(index, el) {
			var aid = $(this).val();
			var finished = 0 ;
			if((index + 1) == $('.account_id').length ){
				var finished = 1;
			}
			$.ajax({
				url:"<?php echo U('Store/ordersaveAjax',array('aid'=>'"+aid+"','normid'=>$normid,'remark'=>'"+reamrk+"'));?>",
				data:{finished:finished,freight:freight},
				dataType:'json',
				success:function(data){
					console.log(data);
					floatNotify.simple(data.info);
					if(data.status == 1 && finished == 1){
			           location.href="<?php echo U('Store/index');?>";
					}else{
						floatNotify.simple(data.info);
					}
				}
			});
		});
		return ;
		//判断账号是否存在余额是否足够
		// $.ajax({
		// 	url:"<?php echo U('Store/judgeMember');?>",
		// 	data:{username:username,pay:"<?php echo ($totalFee+$mailprice); ?>"},
		// 	dataType:'json',
		// 	success:function(data){
		// 		console.log(data);
		// 		if(data.status == 1){
		// 			confirm = floatNotify.confirm('确认发送给'+username+'?',"",
		// 				function(t,n){
		// 					if(n==true){
		// 			            var reamrk = $('#remark').val();
		// 						location.href = "<?php echo U('Store/ordersave',array('aid'=>'"+data.data+"','normid'=>$normid,'remark'=>'"+reamrk+"'));?>";
		// 					}
		// 				this.hide();
		// 			}),
		// 			confirm.show();
		// 		}else{
		// 			floatNotify.simple(data.info);
		// 		}
		// 	}
		// });
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