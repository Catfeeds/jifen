<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title><?php echo ($metaTitle); ?></title>
<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
<link href="<?php echo RES;?>/original/others/gwc.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?php echo RES;?>/css/store/css/style_touch11.css">
<link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
<script src="<?php echo RES;?>/css/store/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>
</head>

<body style="background:#fff;" id="scnhtm5">
<?php if(empty($products) != true ): ?><div class="title">
	<span id="chooseall" style="display: none;"><i class="icon iconfont">&#xe61c;</i>全选</span>
	<a href="#"><span id="product-edit-btn" class="tit">编辑</span></a></div>
<ul class="m-cart-list text">
<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i; if(empty($p['detail']) != true): if(is_array($p['detail'])): $i = 0; $__LIST__ = $p['detail'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li number="1">
				<div class="dui" style="display:none;"><input type="checkbox" id="checkbox-<?php echo ($p['id']); ?>" data-did="<?php echo ($row['id']); ?>" data-id="<?php echo ($p['id']); ?>"  class="regular-checkbox big-checkbox" /><label class="iconfont choose-one" for="checkbox-<?php echo ($p['id']); ?>"></label></div>
	        	<div class="list">
	        		<div class="pic"><a href="<?php echo U('Store/product',array('token'=>$_GET['token'],'id'=>$p['id'],'wecha_id'=>$wecha_id));?>"><img src="<?php echo ($p["logourl"]); ?>" class="img" style="width: 60px; height: 60px;"></a></div>
	                <div class="text1">
	                	<div class="h3"><?php echo ($p["name"]); ?></div>
	                	<p>
	                		<i class="d">
	                			<?php if(empty($p['formatTitle']) != true): echo ($p["formatTitle"]); ?>：<?php echo ($row["formatName"]); endif; ?><br> 
	                			<?php if(empty($p['colorTitle']) != true): echo ($p["colorTitle"]); ?>：<?php echo ($row["colorName"]); endif; ?>
	                		</i>
	                	</p>
	                </div>
	                <div class="text2">
	                	<span class="zi">￥<?php echo ($p["showprice"]); ?></span>
	                    <span class="zi1 num_<?php echo ($p["id"]); ?>_<?php echo ($row["id"]); ?>">x<?php echo ($row["count"]); ?></span>
	                </div>
	                <div class="text3">
	                	<div class="jian">
	                		<i style="cursor: pointer;" onclick="plus_minus(<?php echo ($p["id"]); ?>, -1, <?php echo ($row["id"]); ?>)" class="dec"></i>
	                	</div>
	                    <div class="zj">
	                        <input class="text4" type="text" readonly="true" value="<?php echo ($row["count"]); ?>" onchange="change_minus(<?php echo ($p["id"]); ?>, <?php echo ($row["id"]); ?>)" id="num_<?php echo ($p["id"]); ?>_<?php echo ($row["id"]); ?>">
	                    </div>
	                    <div class="jian"><i style="cursor: pointer;" onclick="plus_minus(<?php echo ($p["id"]); ?>, 1, <?php echo ($row["id"]); ?>)" class="add"></i></div>
	              	</div>
	            </div>
			</li>
			<div class="clear"></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php else: ?>
		<li number="<?php echo ($p["count"]); ?>">
			<div class="dui" style="display:none;"><input type="checkbox" id="checkbox-<?php echo ($p['id']); ?>" data-did="0" data-id="<?php echo ($p['id']); ?>"  class="regular-checkbox big-checkbox" /><label class="iconfont choose-one" for="checkbox-<?php echo ($p['id']); ?>"></label></div>
        	<div class="list">
        		<div class="pic"><a href="<?php echo U('Store/product',array('token'=>$_GET['token'],'id'=>$p['id'],'wecha_id'=>$wecha_id));?>"><img src="<?php echo ($p["logourl"]); ?>" class="img" style="width: 60px; height: 60px;"></a></div>
                <div class="text1">
                	<div class="h3"><?php echo ($p["name"]); ?></div>
                </div>
                <div class="text2">
                	<span class="zi">￥<?php echo ($p["showprice"]); ?></span>
                    <span class="zi1 num_<?php echo ($p["id"]); ?>_0">x<?php echo ($p["count"]); ?></span>
                </div>
                <div class="text3">
                	<div class="jian">
                		<i style="cursor: pointer;" onclick="plus_minus(<?php echo ($p["id"]); ?>, -1, 0)" class="dec"></i>
                	</div>
                    <div class="zj">
                        <input class="text4" readonly="true" type="text" value="<?php echo ($p["count"]); ?>" onchange="change_minus(<?php echo ($p["id"]); ?>, 0)" id="num_<?php echo ($p["id"]); ?>_0">
                    </div>
                    <div class="jian"><i style="cursor: pointer;" onclick="plus_minus(<?php echo ($p["id"]); ?>, 1, 0)" class="add"></i></div>
                    <div class="text3-1"><?php echo ($p["name"]); ?></div>
              	</div>
                
            </div>
		</li>
		<div class="clear"></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</ul>

<div class="m-cart-toal" style="margin: 0; position:fixed; bottom: 0; width: 100%;">
<p class="check" style="font-size:1.4rem">商品总数:<b id="total_count"><?php echo ($totalCount); ?></b>　商品总额:<b id="total_price">￥<?php echo ($totalFee); ?></b></p>
<p class="act">
	<a href="<?php echo U('Store/products',array('token'=>$_GET['token'],'wecha_id'=>$wecha_id));?>" class="back">继续购物<i></i></a>
	<a href="javascript:;" class="checkout" id="place_order">下单结算</a>
</p>
</div>
<div id="product-cart-delete" style="display: none;" class="foot">您当前选择了<span style="color:#f0ad4e;" id="choose_nums">0</span>件商品<span class="del"><a href="#">删除</a></span></div>

<?php else: ?>
	    	<div class="gw cart_empty">
	    		<div class="gwc"> <i class="icon1 iconfont">&#xe61e;</i> <i class="icon2 iconfont">&#xe61d;</i>
	    			<i class="icon1 iconfont">&#xe61e;</i>
	    		</div>
	    		<div class="clear"></div>
	    		<div class="tet">购物车快饿瘪了T.T</div>
	    		<div class="text5">主人快给挑点宝贝吧</div>
	    		<div class="gg">
	    			<a href="<?php echo U('Store/products',array('token'=> $_GET['token'],'wecha_id'=>$wecha_id));?>" class="btn-sm button-light empty-btn">去逛逛
	    			</a>
	    		</div>

	    	</div><?php endif; ?>
<script type="text/javascript">
(function($){
	var product_edit=$("#product-edit-btn");
	var delete_btn_wrap=$("#product-cart-delete");
	var delete_btn=$("#product-cart-delete .del");
	var buy_btn=$(".m-cart-toal");
	var chooseall=$("#chooseall");
	var choose_item=$(".dui");
	var list=$(".list");
	var choose_nums = $("#choose_nums");
	product_edit.on("click",function(){
		chooseall.toggle();
		choose_item.toggle();
		var w=$(window).width()+'px';
		if(list.css("width")==w){
			list.css("width",'88%');
		}else{
			list.css("width",'100%');
		}
		if($(this).hasClass('edit')){
			$(this).removeClass("edit").text("编辑");
			$(".text1").show();
			$(".text2").show();
			$(".text3").hide();
			delete_btn_wrap.hide();
			buy_btn.show();
		}else{
			$(this).addClass("edit").text("完成");
			$(".text1").hide();
			$(".text2").hide();
			$(".text3").show();
			delete_btn_wrap.show();
			buy_btn.hide();
		}
	})
	//单选
	var chooseone = $(".choose-one");
	chooseone.on('click',function(){
		if($(this).hasClass('choose_one_right')){
			$(this).removeClass('choose_one_right');
		}else{
			$(this).addClass('choose_one_right');
		}
		nums=0;
		$(".choose-one").each(function(index, el) {
			if($(this).hasClass('choose_one_right')){
				nums++;
			}
		});
		choose_nums.text(nums);
	})
	//全选
	chooseall.on("click",function(){
		if($(this).find(".icon").hasClass("choose")){
			$(this).find(".icon").removeClass("choose");
			$("input:checkbox").prop("checked",false);
		}else{
			$(this).find(".icon").addClass("choose");
			$("input:checkbox").prop("checked",true);
		}

		nums=0;
		$(".choose-one").each(function(index, el) {
			if($(this).hasClass('choose_one_right')){
				$(this).removeClass('choose_one_right');
			}else{
				nums++;
				$(this).addClass('choose_one_right')
			}
		});
		choose_nums.text(nums);
	})
	//删除
	delete_btn.on("click",function(){
		var check_choose=0;
		$("input:checkbox").each(function(index, el) {
			if($(this).is(":checked")){
				check_choose=1;
			}
		})
		if(check_choose==1){
			if(window.confirm("确认删除？")){
				$("input:checkbox").each(function(index, el) {
					if($(this).is(":checked")){
						// idstr+=String($(this).data("id"))+",";
							$.ajax({
								url:"<?php echo U('Store/deleteCart');?>",
								data:{id:$(this).data("id"),did:$(this).data("did")},
								dataType:"json",
								success:function(data){
									console.log(data);
									if(data.status==1){
										location.reload();
									}
								}
							});
					}		
				});
			}
		}else{
			alert("请选择商品");
		}
	})
	$('#place_order').click(function(){
		$.ajax({
			url:"<?php echo U('Store/checkLimitAjax');?>",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					location.href="<?php echo U('Store/orderCart');?>";
				}else{
					return floatNotify.simple(data.info);
				}
			}
		});
	})
})(jQuery)
function full_update(rowid,price) {
    var _this = $('#qty'+rowid);
    var this_val = parseInt($(_this).val());
    if (this_val < 1 || isNaN(this_val)) {
        alert('购买数量不能小于1！');
        $(_this).focus();
        return false;
    }
    update_cart(rowid, this_val,price);
}
//加减
function plus_minus(rowid, number, did) {
    var num = parseInt($('#num_'+rowid + '_' + did).val());
    num = num + number;
    if (num < 1) {
        return false;
    }
     $('#num_'+rowid + '_' + did).attr('value',num);
     $('.num_'+rowid + '_' + did).text(num);

    update_cart(rowid, num, did);     
}
function change_minus(rowid, did) {
	var num = parseInt($('#num_'+rowid + '_' + did).val());
    if (num < 1) {
        return false;
    }
     $('#num_'+rowid + '_' + did).attr('value',num);
     $('.num_'+rowid + '_' + did).text(num);

    update_cart(rowid, num, did);
}
//更新购物车
function update_cart(rowid, num, did) {
	if (num > parseInt($("#stock").text())) {
		num = parseInt($("#stock").text());
		$('#num_'+rowid + '_' + did).val(num);
		floatNotify.simple('抱歉，您的购买量超过了库存了');
	}
	$.ajax({
		url: '<?php echo U('Store/ajaxUpdateCart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>&id='+rowid+'&count='+num+'&did='+ did,
		success: function( data ) {
			if(data){
				var datas=data.split('|');
				//$('#p_buy #all_price').html('￥'+datas[1]);
				$('#total_count').html(datas[0]);
				$('#total_price').html('￥'+datas[1]);
			}
		}
	});
}
</script>
</body>
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
            "imgUrl": "", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/cart',array('token' => $_GET['token'],'mid'=>$my['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/cart',array('token' => $_GET['token'],'mid'=>$my['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/cart',array('token' => $_GET['token'],'mid'=>$my['id']));?>",
            "tTitle": "<?php echo ($metaTitle); ?>",
            "tContent": "<?php echo ($metaTitle); ?>"
        };
</script>
<?php echo ($shareScript); ?>
</html>