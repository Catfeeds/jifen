<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
<title>我的分店-普通A分店</title>
<link href="<?php echo RES;?>/distri/css/fdlb.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
</head>

<body>
	<div class="container">
	<?php if(is_array($follow)): $i = 0; $__LIST__ = $follow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Distribution/memberIndex',array('token'=>$token,'id'=>$vo[id]));?>">
    <div <?php if(($vo["distritime"]) != "0"): ?>class="fd fd1"<?php else: ?>class="fd"<?php endif; ?>>
    	<div class="tx"><img <?php if(($vo["headimgurl"]) == ""): ?>src="<?php echo RES;?>/distri/images/portrait.jpg"<?php else: ?>src="<?php echo ($vo["headimgurl"]); ?>"<?php endif; ?> width="115px;"></div><!--tx-->
        <div class="left">
        	<ul class="left_ul">
            	<li>分店ID：<?php echo $vo['id']+$set['startNums'];?></li>
                <li>昵称：<?php if(($vo["headimgurl"]) == ""): ?>未获取<?php else: echo ($vo["nickname"]); endif; ?></li>
                <li>关注时间：<?php echo (date('Y-m-d',$vo["createtime"])); ?></li>
            </ul>
        </div><!--left-->
        <div class="right"><img src="<?php echo RES;?>/distri/images/jt.png"></div><!--right-->
        <div class="clear"></div>
    </div>
    </a><?php endforeach; endif; else: echo "" ;endif; ?>
    	
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
    <!-- <?php if((MODULE_NAME == 'Distribution') AND (ACTION_NAME == 'index')): ?><div class="copy" style="text-align:center; margin-top: 20px; font-size: 12px;">技术支持：微广互动</div><?php endif; ?> -->
    <?php if((ACTION_NAME) != "herolist"): ?><section class="foot"></section><?php endif; ?>
    
    </div><!--container-->
</body>
</html>