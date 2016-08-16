<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
<title>用户中心-我的收藏</title>
<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
</head>

<body>
	<div class="container">
        <link href="<?php echo RES;?>/distri/css/fdlb.css" rel="stylesheet" type="text/css" />
        <div class="info_edit_wrap_title">
            <div class="info_edit_wrap_title_item info_edit_wrap_title_left close_edit_wrap"></div>
            <div class="info_edit_wrap_title_item info_edit_wrap_title_center">我的收藏</div>
            <div class="info_edit_wrap_title_item info_edit_wrap_title_right"></div>
        </div>
    	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["product"]) != ""): ?><a href="<?php echo U('Store/product',array('token'=>$token,'id'=>$vo['productid']));?>">
            <div class="fd">
            	<div class="tx"><img src="<?php echo ($vo["product"]["logourl"]); ?>" width="115px;"></div><!--tx-->
                <div class="left">
                	<ul class="left_ul">
                    	<li>商品名称：<?php echo (msubstr($vo["product"]["name"],0,6,'utf-8',true)); ?></li>
                        <li>商品价格：<?php echo ($vo["product"]["price"]); ?>&nbsp;元</li>
                        <li>收藏时间：<?php echo (date('Y-m-d',$vo["addtime"])); ?></li>
                    </ul>
                </div><!--left-->
                <div class="right"><img src="<?php echo RES;?>/distri/images/jt.png"></div><!--right-->
                <div class="clear"></div>
            </div>
            </a>
        	<?php else: ?>
            <div class="fd" style="height:80px;">
                <div class="left">
                	<ul class="left_ul">
                    	<li>该收藏商品已下架</li>
                    </ul>
                </div><!--left-->
            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><!--container-->
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
</html>