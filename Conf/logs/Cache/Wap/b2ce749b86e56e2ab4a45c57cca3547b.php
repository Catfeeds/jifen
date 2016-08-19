<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的推广-分店订单列表</title>
    <link href="<?php echo RES;?>/distri/css/fdlb.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
</head>

<body>
    <div class="container">
        <?php if(is_array($orderlist)): $i = 0; $__LIST__ = $orderlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="fd">
                <div class="left" style="width:100%">
                    <ul class="left_ul">
                        <li>分店类别：<?php echo ($vo["typename"]); ?></li>
                        <li>
                            下单人：
                            <?php if(($vo["from_member"]["nickname"]) == ""): ?>未获取
                                <?php else: ?>
                                <?php echo ($vo["from_member"]["nickname"]); endif; ?>
                        </li>
                        <li>
                            下单人ID： <font style="color:red"><?php echo $set['startNums']+$vo[from_member][id];?></font>
                        </li>
                        <li>订单编号：<?php echo ($vo['orderid']); ?></li>
                        <li>
                            订单金额： <font style="color:red"><?php echo sprintf("%.2f",$vo['orderMoney']/100);?></font>
                            元
                        </li>
                        <li>下单时间：<?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></li>
                    </ul>
                </div>
                <div class="clear"></div>
                <!--left--> </div><?php endforeach; endif; else: echo "" ;endif; ?>

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

    </div>
    <!--container-->
</body>
</html>