<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/bgmove.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo RES;?>/original/js/require.js" data-main='<?php echo RES;?>/original/js/myshop' type="text/javascript" charset="utf-8" defer></script>
    <title><?php echo ($title); ?></title>
</head>
<body>
    <!-- 轮播背景 -->
    <div class="slideshow">
        <div class="movebg slideshow-image" style="background-image: url('<?php echo RES;?>/original/images/1.jpg');"></div>
        <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/2.jpg')"></div>
        <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/3.jpg')"></div>
        <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/4.jpg')"></div>
    </div>
    <!-- 轮播背景 -->
    <div class="content_wrap index_wrap">
        <div class="dis_head">
            <img id="index_headimgurl" src="<?php echo ($my["headimgurl"]); ?>">
            <p id="index_nickname"><?php echo ($my["nickname"]); ?></p>
        </div>
        <div class="weui_cells weui_cells_extend weui_cells_access">
            <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Distribution/getMoneyList');?>">
              <div class="weui_cell_bd weui_cell_primary">
                <p>累计收入(元)</p>
                <p class="money_color1">0.00</p>
              </div>
              <div class="weui_cell_ft weui_cell_ft_extend">查看更多</div>
            </a>
        </div>
        <div class="weui-row weui-row-extend weui-no-gutter">
          <div class="weui-col-50">
              <a href="<?php echo U('Distribution/getMoneyList');?>" class="coad_lnfo_bage">
                  <p class="money_color1">0</p>
                  <p>本月订单</p>
              </a>
          </div>
          <div class="weui-col-50">
              <a href="<?php echo U('Distribution/getMoneyList');?>" class="coad_lnfo_bage">
                  <p class="money_color1">0.00</p>
                  <p>本月收入</p>
              </a>
          </div>
        </div>

        <div class="weui-row weui-row-extend2 weui-no-gutter">
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Store/my');?>">
                  <p class="iconfont">&#xe607;</p>
                  <p>推荐二维码</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/getMoneyList');?>">
                  <p class="iconfont">&#xe611;</p>
                  <p>我的收益</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/myDistribution');?>">
                  <p class="iconfont">&#xe610;</p>
                  <p>团队管理</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Store/my');?>">
                  <p class="iconfont">&#xe60f;</p>
                  <p>店铺统计</p>
              </a>
          </div>
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