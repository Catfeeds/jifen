<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /><meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta name="format-detection" content="telephone=no"/>
<title><?php echo ($metaTitle); ?></title>
<script src="<?php echo RES;?>/css/store/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/jquery.lazyload.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/notification.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/swiper.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/main.js" type="text/javascript"></script>
<script>
	function hideFrom(){
		$('#show_from').hide();
	}
</script>
<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
<link type="text/css" rel="stylesheet" href="<?php echo RES;?>/css/store/css/style_touch11.css">
</head>
<body>
<div id="top"></div>
<div id="scnhtm5" class="m-body">
<div class="m-detail-mainout">
<div style="width:100%;height:50px;line-height:50px;background:#fff;text-align:center"><span style="float:right;padding-right:10px;"><a href="<?php echo U('Store/index',array('token' => $_GET['token'], 'catid' => $hostlist['id'],'mid'=>$my['id']));?>"><img src="<?php echo RES;?>/css/store/css/img/home1.jpg"></a></span><span style="padding-left:10px;float:left"><a href="javascript:history.go(-1)"><img src="<?php echo RES;?>/css/store/css/img/return1.jpg" ></a></span><span style="font-size:16px"><?php echo (msubstr($metaTitle,0,10)); ?></span></div>
<ul class="sub-menu-list">
<li><a href="<?php echo U('Store/cats',array('token' => $_GET['token'], 'catid' => $hostlist['id'],'mid'=>$my['id']));?>">首页</a></li>
<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $hostlist['id'],'mid'=>$my['id']));?>"><?php echo ($hostlist["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

<link href="<?php echo RES;?>/distri/css/head.css" rel="stylesheet" type="text/css" />
<form id="search_form" name="search_form" action="" method="post">
	<div class="m-l-search">
		<input id="search_name" class="inp-search" name="search_name" type="search" value="<?php echo ($_REQUEST['keyword']); ?>" placeholder="输入关键字搜索">
		<input class="btn-search" name="search-btn" type="submit" value="">
	</div>
</form>

<!--div class="m-select c666 order_control">
<span><a href="javascript:" order="time" class="arrow-down">时间<i><em></em></i></a></span>
<span><a href="javascript:" order="salecount">销量<i><em></em></i></a></span>
<span><a href="javascript:" order="price">价格<i><em></em></i></a></span>
<span><a href="javascript:" order="discount">折扣<i><em></em></i></a></span>
<input type="hidden" id="view_list" value="">
<!-- <span class="filter"><a href="javascript:;" class="ary li">排列</a><a href="javascript:;" class="flt">筛选</a></span> -->
</div-->
<ul id="m_list" class="m-list ">
<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><li>
		<div style="width:95%;margin:0 auto;background:#fff;">
		<span class="pic">
			<a href="<?php echo U('Store/product',array('token' => $token, 'id' => $hostlist['id'],'mid'=>$my['id']));?>">
			<img src="<?php echo ($hostlist["logourl"]); ?>" data-original="<?php echo ($hostlist["logourl"]); ?>" style="width:100%;">
			</a>
			<a class="t" href="<?php echo U('Store/product',array('token' => $token, 'id' => $hostlist['id'],'mid'=>$my['id']));?>"><?php echo (htmlspecialchars_decode($hostlist["name"])); ?></a>
			<b>￥<?php echo ($hostlist["showprice"]); ?></b><br/>
			<span style="font-size:12px;color:#585656">已售：<?php echo ($hostlist["fakemembercount"]); ?></span>
		</span>
		</div>
	</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<!-- <div style="background:#4B514F;position:fixed;left:10px;bottom:10px;border-radius:5px;padding:5px 10px;background-color:rgba(0,0,0,0.7);font-size:16px;z-index:9999">
	<a href="<?php echo U('Store/cart',array('token'=>$token,'mid'=>$my['id']));?>" style="color:#fff">
	购物车(<i class="cart_com" style="font-size:16px;"><?php echo ($totalProductCount); ?></i>)
	</a>
	<a href="<?php echo U('Store/my',array('token'=>$token,'mid'=>$my['id']));?>"style="color:#fff">
	<span style="border-left:1px solid #fff;padding-left:5px;">我的订单</span>
	</a>
</div> -->
<div class="more" style="width:100%;text-align:center;line-height:20px;overflow:hidden;display:none;" id="show_more" page="2" href="javascript:void(0);">加载中...请稍候</div>
<input type="hidden" value="1" id="pageid" />
<input type="hidden" id="canScroll" value="1" />
<script type="text/javascript">
$(function() {
	$('#search_form').submit(function() {
		var search_name = $('#search_name').val();
		if (search_name == '') {
			return false;
		}
	});

	//点击排序
	var base_url = '<?php echo U('Store/products',array('token'=>$token,'catid'=>$thisCat['id']));?>';
	var b_url = '<?php if($isSearch != 1): echo U('Store/ajaxProducts',array('token'=>$token,'catid'=>$thisCat['id'],'ms'=>$_GET['ms'],'tj'=>$_GET['tj'])); else: echo U('Store/ajaxProducts',array('token'=>$token,'keyword'=>$_GET['keyword'],'ms'=>$_GET['ms'],'tj'=>$_GET['tj'])); endif; ?>'
		method = 'DESC',
		_get_method = '<?php echo ($method); ?>',
		order = '<?php echo ($order); ?>',
		_get_order  = '';
	if (_get_order != '') {
		order = _get_order;
	}
	$('.order_control a').removeClass('arrow-down');
	if (_get_method == 'DESC')  {
		method = 'ASC';
		$('.order_control a[order="' + order + '"]').addClass('arrow-up');
	} else {
		$('.order_control a[order="' + order + '"]').addClass('arrow-down');
	}
	$('.order_control a').click(function() {
		var order = $(this).attr('order');
		var url = base_url + '&order=' + order+'&method='+method;
		location.href = url;
	});

	/*---------------------加载更多--------------------*/
	var total = <?php echo ($count); ?>,
		pagesize = 8,
		pages = Math.ceil(total / pagesize);
	var mid = <?php echo (($my["id"])?($my["id"]):0); ?>;
	var com_link = '<?php echo U('Store/product',array('token'=>$token));?>';
	var label_arr = ["\u8bf7\u9009\u62e9\u6807\u7b7e","\u70ed\u5356","\u7206\u6b3e"];
	if (pages > 1) {
		var _page = $('#show_more').attr('page');
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				$('#show_more').show().html('加载中...请稍候');
				if (_page > pages) {
					$('#show_more').show().html('没有更多了');
					return;
				}
				if($('#canScroll').val()==0){//不要重复加载
					return;
				}
				$('#canScroll').attr('value',0);
				$.ajax({
					type : "GET",
					data : {'page' : _page, 'inajax' : 1},
					url :  b_url + '&order=' + order + '&method=' + _get_method + '&pagesize='+pagesize,
					dataType : "json",
					success : function(RES) {
						$('#canScroll').attr('value',1);
						$('#show_more').hide().html('加载更多');
						data = RES.products;
						if(data.length){
							$('#show_more').attr('page',parseInt(_page)+1);
						}
						_page = $('#show_more').attr('page');
						var _tmp_html = '';
						$.each(data, function(x, y) {
							_tmp_html +=    '<li><div style="width:95%;margin:0 auto;background:#fff;"><span class="pic">' +
							'<a href="' + com_link + '&id=' + y.id + '&mid=' + mid + '">' +
							'<img src="' +y.logourl + '" style="width:100%;"/>' +
							'</a><a class="t" href="' + com_link + '&id=' + y.id + '">' + y.name + '</a>';
							_tmp_html += '<b>￥'+ y.showprice +'&nbsp;元</b>';
							_tmp_html += '<br/><br/><span style="font-size:12px;color:#585656">已售：'+ y.fakemembercount +'</span></span></div></li>';
						});
						$('#m_list').append(_tmp_html);
					}
				});
			}
		});
	}
});
</script>
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
          <p class="iconfont">&#xe60a;</p>
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
            "moduleID":"<?php echo ($products[0]['id']); ?>",
            "imgUrl": "<?php echo ($products[0]['logourl']); ?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/products',array('token' => $token,'catid'=>$_GET['catid'],'mid'=>$my['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/products',array('token' => $token,'catid'=>$_GET['catid'],'mid'=>$my['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/products',array('token' => $token,'catid'=>$_GET['catid'],'mid'=>$my['id']));?>",
            "tTitle": "<?php echo ($metaTitle); ?>",
            "tContent": "<?php echo ($metaTitle); ?>"
        };
</script>
<?php echo ($shareScript); ?>
</html>