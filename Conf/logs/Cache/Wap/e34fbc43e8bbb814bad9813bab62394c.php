<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	<title><?php echo ($product["name"]); ?></title>
	<link href="<?php echo RES;?>/css/store/product/css/main.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo RES;?>/css/store/product/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo RES;?>/css/store/js/notification.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo RES;?>/css/store/product/js/payfor.js"></script>
	<style>
.slider{display:none}/*用于获取更加体验*/
.focus span{width:10px;height:10px;margin-right:10px;border-radius:50%;background:#666;font-size:0}
.focus span.current{background:#fff}
</style>
	<script type="text/javascript">
$(function(){
	
	$(".showbox").click(function(){
		$("#TB_overlayBG").css({
			display:"block",height:$(document).height()
		});
		$(".box").css({
			left:0+"px",
			bottom:0+"px",
			display:"block"
		});
	});
	$("#quickBuy").click(function(){
		$("#TB_overlayBG").css({
			display:"block",height:$(document).height()
		});
		$(".box").css({
			left:0+"px",
			bottom:0+"px",
			display:"block"
		});
	});
	$(".close").click(function(){
		$("#TB_overlayBG").css("display","none");
		$(".box").css("display","none");
	});
	
})
</script>

</head>

<body id="scnhtm5">
	<div class="slider">
		<ul>
			<?php if(empty($imageList) != true): if(is_array($imageList)): $i = 0; $__LIST__ = $imageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li>
						<a href="javascript:;">
							<img src="<?php echo ($img["image"]); ?>"></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				<li class="li">
					<img src="<?php echo ($product["logourl"]); ?>"></li><?php endif; ?>
		</ul>
	</div>
	<script type="text/javascript" src="<?php echo RES;?>/css/store/product/js/yxMobileSlider.js"></script>
	<script>
    $(".slider").yxMobileSlider({width:640,height:320,during:3000})
  </script>
	<!--flash end-->

	<div id="details_title">
		<div class="details_content">
			<div class="details_name"><?php echo ($product["name"]); ?></div>
			<div class="details_dashed"></div>
			<div class="details_price">
				现价：￥<?php echo ($product["price"]); ?> &nbsp;&nbsp;&nbsp;&nbsp;
				<span>原价：￥<?php echo ($product["oprice"]); ?></span>
			</div>
			<div class="details_dashed"></div>
			<div class="details_sale">销量：<?php echo ($product["fakemembercount"]); ?>件</div>
		</div>
	</div>

	<!--规格弹出框-->
	<div id="guige_all">
		<div  class="guige">
			<a href="javascript:void(0);" class="showbox">
				<p style="width:90%; float:left; font-size:14px;">请选择商品规格</p>
				<span>></span>
			</a>
		</div>
	</div>

	<div id="TB_overlayBG"></div>
	<div class="box" style="display:none">
		<h2>
			<a href="javascript:;" class="close">
				<IMG src="<?php echo RES;?>/css/store/product/images/details8.png" />
			</a>
		</h2>
		<div class="mainlist">
			<div class="details_pic">
				<img src="<?php echo ($product["logourl"]); ?>" width="100%" style="max-height:150px"/>
			</div>
			<div class="danjia_all">
				<div class="details_name"><?php echo ($product["name"]); ?></div>
				<div class="details_danjia" >
					商品单价: <strong id="price_item_1">￥<?php echo ($product["price"]); ?></strong>
					&nbsp;
					<span style="font-size:12px">
						库存: <i id="stock" style="font-size:12px"><?php echo ($product["num"]); ?></i>
					</span>
				</div>

			</div>
			<div class="clear"></div>
			<?php if(empty($colorData) != true): ?><div class="line1"></div>
				<div class="kuanhao">
					<div class="kuanhao_name"><?php echo ($catData["color"]); ?></div>
					<div class="kuanhao_neirong">
						<?php if(is_array($colorData)): $colorId = 0; $__LIST__ = $colorData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($colorId % 2 );++$colorId;?><div class="color" id="color_<?php echo ($detail['color']); ?>"><?php echo ($detail['colorName']); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div  class="clear"></div>
					</div>
				</div><?php endif; ?>
			<?php if(empty($formatData) != true): ?><div class="line1"></div>
				<div class="kuanhao">
					<div class="kuanhao_name"><?php echo ($catData["norms"]); ?></div>
					<div class="kuanhao_neirong">
						<?php if(is_array($formatData)): $formatId = 0; $__LIST__ = $formatData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($formatId % 2 );++$formatId;?><div class="norms" id="norms_<?php echo ($detail['format']); ?>"><?php echo ($detail['formatName']); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div  class="clear"></div>
					</div>
				</div><?php endif; ?>
			<?php if(empty($catData['norms']) != true OR empty($catData['color']) != true): if(is_array($productDetail)): $i = 0; $__LIST__ = $productDetail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><input type="hidden" id="color_<?php echo ($pro["color"]); ?>_norms_<?php echo ($pro["format"]); ?>" value="<?php echo ($pro["num"]); ?>" did="<?php echo ($pro["id"]); ?>" price="<?php echo ($pro["price"]); ?>" vprice="<?php echo ($pro["vprice"]); ?>" class="hidden"/><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			<div class="line"></div>
			<div class="p_number">
				<div class="f_l add_chose">
					<a class="reduce" onClick="setAmount.reduce('#buy_num')" href="javascript:void(0)">-</a>
					<input type="text" name="qty_item_1" value="1" id="buy_num" onKeyUp="setAmount.modify('#buy_num')" class="text" />
					<a class="add" onClick="setAmount.add('#buy_num')" href="javascript:void(0)">+</a>
				</div>

				<div class="f_l buy">
					总价：
					<span class="total-font" id="total_item_1">￥<?php echo ($product["price"]); ?></span>
					<input type="hidden" name="total_price" id="total_price" value="" />
				</div>

			</div>
			<div class="clear"></div>
			<div class="line"></div>
			<div class="details_button" onclick="QuickBuy()">确认</div>
		</div>
	</div>

	<!--规格弹出框-->

	<div id="details_shop">
		<div class="details_shop_content">
			<div class="details_products">
				<div class="details_products_img">
					<img src="<?php echo RES;?>/css/store/product/images/details.png"></div>
				<div class="details_products_all">
					<a href="<?php echo U('Store/products',array('token' =>$token));?>">查看所有商品</a>
				</div>

			</div>
			<div class="details_products1">
				<div class="details_products_img">
					<img src="<?php echo RES;?>/css/store/product/images/details1.png"></div>
				<div class="details_products_all">
					<a href="<?php echo U('Store/index',array('token' =>$token));?>">进店逛逛</a>
				</div>

			</div>
		</div>
	</div>

	<div id="details_details">
		<div class="tuwen">
			<div class="details_tuwen details_click">图文详情</div>
			<!-- 	         <div class="details_tuwen">用户评价</div>
		-->
		<div class="details_tuwen">同类推荐</div>
		<div class="clear"></div>
	</div>
	<div class="details_xiangqing" id="main">
		<div class="details_xiangqing_item"><?php echo ($product["intro"]); ?></div>
		<!-- <div class="details_xiangqing_item">2</div>
	-->
	<div class="details_xiangqing_item">
		<?php if(is_array($products)): $j = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$po): $mod = ($j % 2 );++$j;?><div class="pro_box" <?php if($j%2 == 0): ?>style="padding-left:2.5px"
				<?php else: ?>
				style="padding-right:2.5px"<?php endif; ?>
			>
			<div class="pro_img">
				<a href="<?php echo U('Store/product',array('token' => $token, 'id' => $po['id'],'cid'=>$po['cid']));?>">
					<img src="<?php echo ($po["logourl"]); ?>" />
				</a>
				<div class="sale" style="background-color:<?php echo ($background); ?>">已售:<?php echo ($po["fakemembercount"]); ?></div>
			</div>
			<div class="pro_name">
				<a href="<?php echo U('Store/product',array('token' => $token, 'id' => $po['id'],'cid'=>$po['cid']));?>"><?php echo (msubstr($po["name"],0,22)); ?>
				</a>
			</div>
			<div class="price">
				￥<?php echo ($po["price"]); ?>&nbsp;
				<span><?php echo ($po["oprice"]); ?></span>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
<script>
		(function($){
			$(".details_tuwen").bind("click",function(){
				var index=$(this).index();
				$(this).addClass("details_click").siblings().removeClass("details_click");
				$(".details_xiangqing .details_xiangqing_item").eq(index).show().siblings().hide();
			})
		})(jQuery)
	</script>

</div>
<div id="details_foot">
<a href="javascript:;" id="collection" <?php if(($collection) != "1"): ?>onclick="Collection()"
<?php else: ?>
onclick="delCollection()"<?php endif; ?>
>
<div class="shoucang">
<div>
	<img class="img" <?php if(($collection) != "1"): ?>src="<?php echo RES;?>/css/store/product/images/details2.png"
	<?php else: ?>
	src="<?php echo RES;?>/css/store/product/images/details4.png"<?php endif; ?>
id="shoucangImg"/>
</div>
<span id="coltext">
<?php if(($collection) != "1"): ?>收藏
	<?php else: ?>
	已收藏<?php endif; ?>
</span>
</div>
</a>
<a href="<?php echo U('Store/cart',array('token'=> $token));?>">
<div class="shoucang1">
<div class="cart_pic">
<img src="<?php echo RES;?>/css/store/product/images/details3.png" /> <i class="cart_com"><?php if($totalProductCount != 0): echo ($totalProductCount); endif; ?></i> 
</div>
<span>购物车</span>
</div>
</a>
<a href="javascript:;" onclick="show_cart()">
<div class="cart">加入购物车</div>
</a>
<a href="javascript:;" id="quickBuy">
<div class="buy">立即购买</div>
</a>
</div>

<script type="text/javascript"> 
var SysSecond; 
var InterValObj; 
var buyDetailId = '';
$(document).ready(function() {
	$(".com_pg-num").click(function(){
		var page = parseInt($(this).attr('id'));
		$.get("<?php echo U('Store/getcomment',array('token'=>$token,'pid'=>$product['id']));?>" + '&page='+page, function(response){
			if (response.error_code == false) {
				var html = '';
				$.each(response.data, function(i, data){
					html += '<li><p>' + data.wecha_id + '：' + data.score + '分　' + data.productinfo + '</p>';
					html += '<p>' + data.content + '<i>&nbsp;&nbsp;' + data.dateline + '</i></p></li>';
				});
				if (html != '') {
					$(".com-list").append(html);
				}
				if (response.page > 0) {
					$(".com_pg-num").attr('id', response.page);
				} else {
					$(".m-page").hide();
				}
			}
		}, 'json');
	});
	
	
	SysSecond = parseInt($("#remainSeconds").html()); //这里获取倒计时的起始时间 
	InterValObj = window.setInterval(SetRemainTime, 1000); //间隔函数，1秒执行 
	$(".color").click(function(){
		if ($(this).attr('class') != 'color on') {
			$(this).addClass('on').siblings().removeClass('on');
			var id = $(this).attr('id');
			var nextid = 'norms_0';
			$('.norms').each(function(){
				if ($(this).attr('class') == 'norms on') {
					nextid = $(this).attr('id');
				}
			});
			if ($("#" + id + "_" + nextid).val() != null && $("#" + id + "_" + nextid).val() != '' && $("#" + nextid + "_" + id).val() != 'undefined') {
				buyDetailId = id + "_" + nextid;
				$("#stock").text($("#" + id + "_" + nextid).val());
				
				$("#total_item_1").text('￥' +Number($("#" + id + "_" + nextid).attr("price")*$("#buy_num").val()).toFixed(2));
				$("#price_item_1").text('￥' +$("#" + id + "_" + nextid).attr("price"));

				$("#xsprice").text('￥' + $("#" + id + "_" + nextid).attr('price'));
			} else {
				$("#stock").text('未选择');
			}
		} else {
			$(this).removeClass('on');
		}
	});
	$(".norms").click(function(){
		if ($(this).attr('class') != 'norms on') {
			$(this).addClass('on').siblings().removeClass('on');
			var id = $(this).attr('id');
			var nextid = 'color_0';
			$('.color').each(function(){
				if ($(this).attr('class') == 'color on') {
					nextid = $(this).attr('id');
				}
			});
			if ($("#" + nextid + "_" + id).val() != '' && $("#" + nextid + "_" + id).val() != null && $("#" + nextid + "_" + id).val() != 'undefined') {
				buyDetailId = nextid + "_" + id;
				$("#stock").text($("#" + nextid + "_" + id).val());

				$("#total_item_1").text('￥' +Number($("#" + nextid + "_" + id).attr("price")*$("#buy_num").val()).toFixed(2));
				$("#price_item_1").text('￥' +$("#" + nextid + "_" + id).attr("price"));
				
				$("#xsprice").text('￥' + $("#" + nextid + "_" + id).attr('price'));
			} else {
				$("#stock").text('未选择');
			}
		} else {
			$(this).removeClass('on');
		}
	});
}); 

//将时间减去1秒，计算天、时、分、秒 
function SetRemainTime() {
	if (SysSecond > 0) { 
		SysSecond = SysSecond - 1; 
		var second = Math.floor(SysSecond % 60);             // 计算秒     
		var minite = Math.floor((SysSecond / 60) % 60);      //计算分 
		var hour = Math.floor((SysSecond / 3600) % 24);      //计算小时 
		var day = Math.floor((SysSecond / 3600) / 24);        //计算天 
		$("#remainTime").html('&nbsp;&nbsp;还剩'+day + "天" + hour + "小时" + minite + "分" + second + "秒"); 
	} else {//剩余时间小于或等于0的时候，就停止间隔函数 
		window.clearInterval(InterValObj); 
		//这里可以添加倒计时时间为0后需要执行的事件 
	} 
}
//加减
function plus_minus(rowid, number,price) {
    var num = parseInt($('#buy_num').val());
    num = num + parseInt(number);
    if (num > parseInt($('#stock').text())) {
    	num = parseInt($('#stock').text());
    }
    if (num < 0) {
        return false;
    }
     $('#buy_num').attr('value',num);
}
function show_cart() {
	$("#btn_add_cart").attr("disable", false);
	var count = parseInt($('#buy_num').val());
	var did = parseInt($("#" + buyDetailId).attr('did'));
	if ($('.hidden').eq(0).val() != null && $('.hidden').eq(0).val() != '' && $('.hidden').eq(0).val() != 'undefined') {
		if (isNaN(did)) {
	        	$("#TB_overlayBG").css({
					display:"block",height:$(document).height()
				});
				$(".box").css({
					left:0+"px",
					bottom:0+"px",
					display:"block"
				});
				$(".details_button").attr("onclick","add_cart()");
				return false;
		}
	} else {
		did = 0;
	}
	add_cart();
}
function add_cart() {
	$("#btn_add_cart").attr("disable", false);
	var count = parseInt($('#buy_num').val());
	var isopen = <?php echo ($product["isopen"]); ?>;
	var did = parseInt($("#" + buyDetailId).attr('did'));
	if (isopen==0) {
		return floatNotify.simple('抱歉，该商品已下架');
	}
	if ($('.hidden').eq(0).val() != null && $('.hidden').eq(0).val() != '' && $('.hidden').eq(0).val() != 'undefined') {
		if (isNaN(did)) {
	        return floatNotify.simple('请选择的产品的类型');
		}
	} else {
		did = 0;
	}
	if (count > parseInt($("#stock").text())) {
		return floatNotify.simple('抱歉，您的购买量超过了库存了');
	}
	$.ajax({
		url: "<?php echo U('Store/addProductToCart',array('token'=>$token,'id'=>$product['id']));?>" + '&count='+count + '&did=' + did,
		success: function(data) {
			if(data){
				console.log(data);
				var datas=data.split('|');
				if(datas[0] == 'limit'){
					return floatNotify.simple('超出商品限购数量'+datas[1]+'件');
				}else{
	                $('.cart_com').text(datas[0]); 
	                $("#btn_add_cart").attr("disable", true);
					$("#TB_overlayBG").css("display","none");
					$(".box").css("display","none");
	                return floatNotify.simple('加入购物车成功');
				}
			} else {
				return floatNotify.simple('抱歉，您的请求不正确');
			}
		}
	});
}
function QuickBuy() {
	var count = parseInt($('#buy_num').val());
	var isopen = <?php echo ($product["isopen"]); ?>;
	var did = parseInt($("#" + buyDetailId).attr('did'));
	if (isopen==0) {
		return floatNotify.simple('抱歉，该商品已下架');
	}
	if ($('.hidden').eq(0).val() != null && $('.hidden').eq(0).val() != '' && $('.hidden').eq(0).val() != 'undefined') {
		if (isNaN(did)) {
			return floatNotify.simple('请选择的产品的类型');
			return false;
		}
	} else {
		did = 0;
	}
	if (count > parseInt($("#stock").text())) {
		return floatNotify.simple('抱歉，您的购买量超过了库存了');
	}
	// alert("<?php echo U('Store/addProductToCart',array('token'=>$token,'id'=>$product['id']));?>" + '&count='+count + '&did=' + did);
	$.ajax({
		url: "<?php echo U('Store/addProductToCart',array('token'=>$token,'id'=>$product['id']));?>" + '&count='+count + '&did=' + did,
		success: function(data) {
			var datas=data.split('|');
			if(datas[0] == 'limit'){
				return floatNotify.simple('超出商品限购数量'+datas[1]+'件');
			}else{
				if(datas){
					location.href = "<?php echo U('Store/cart',array('token' => $token,'wecha_id'=>$_GET['wecha_id']));?>";
				} else {
					return floatNotify.simple('抱歉，您的请求不正确');
				}
			}
		}
	});
}
function Collection() {
	$.ajax({
		url: "<?php echo U('Store/addCollection',array('token'=>$token,'mid'=>$my['id'],'id'=>$product['id']));?>",
		success: function(data) {
			if(data){
				if(data==1){
					return floatNotify.simple('已经在收藏中');
				}else{
				    $('#shoucangImg').attr('src','<?php echo RES;?>/css/store/product/images/details4.png');
					$('#coltext').text('已收藏');
					$('#collection').attr('onclick','delCollection()');
					return floatNotify.simple('加入收藏成功');
				}
			} else {
				return floatNotify.simple('抱歉，加入收藏失败');
			}
		}
	});
}
function delCollection() {
    var submitData = {
		id : "<?php echo ($product['id']); ?>"
	}
	$.ajax({
		type: "POST",
		data: submitData,
		url: "<?php echo U('Store/delCollection',array('token'=>$token,'mid'=>$my['id'],'id'=>$product['id']));?>",
		success: function(data) {
			if(data){
				if(data==1){
				    $('#shoucangImg').attr('src','<?php echo RES;?>/css/store/product/images/details2.png');
					$('#coltext').text('收藏');
					$('#collection').attr('onclick','Collection()');
					return floatNotify.simple('取消收藏成功');
				}else{
					return floatNotify.simple('已经取消收藏了');
				}
			} else {
				return floatNotify.simple('抱歉，取消收藏失败');
			}
		}
	});
}
</script>
</body>
<script>
function onBridgeReady(){
 WeixinJSBridge.call('showOptionMenu');
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
            "moduleID":"<?php echo ($product['id']); ?>",
            "imgUrl": "<?php echo ($product['logourl']); ?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/product',array('token' => $token,'id'=>$product['id'],'mid'=>$my['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/product',array('token' => $token,'id'=>$product['id'],'mid'=>$my['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/product',array('token' => $token,'id'=>$product['id'],'mid'=>$my['id']));?>",
            "tTitle": "<?php echo ($metaTitle); ?>",
            "tContent": "<?php echo ($metaTitle); ?>"
        };
</script>
<?php echo ($shareScript); ?>
</html>