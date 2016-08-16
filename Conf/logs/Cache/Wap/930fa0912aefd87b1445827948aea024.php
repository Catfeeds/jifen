<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/bgmove.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">

    <link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">

    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <title><?php echo ($title); ?></title>
</head>
<body id="scnhtm5">
    <!-- 轮播背景 -->
    <div class="slideshow">
        <div class="movebg slideshow-image" style="background-image: url('<?php echo RES;?>/original/images/1.jpg');"></div>
        <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/2.jpg')"></div>
        <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/3.jpg')"></div>
        <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/4.jpg')"></div>
    </div>
    <!-- 轮播背景 -->
    <div class="content_wrap index_wrap">
        <div class="dis_head info_edit">
            <img id="index_headimgurl" src="<?php echo ($my["headimgurl"]); ?>">
            <p id="index_nickname"><?php echo ($my["nickname"]); ?></p>
        </div>
        <div class="weui_cells weui_cells_extend weui_cells_access">
            <a class="weui_cell weui_cell_extend coad_lnfo_bage cursor_ios" href="<?php echo U('Store/my');?>">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe603;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>我的订单</p>
                </div>
                <div class="weui_cell_ft weui_cell_ft_extend">查看全部订单</div>
            </a>
            <div class="weui-row weui-row-extend weui-no-gutter">
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 0));?>" class="coad_lnfo_bage">
                        <span><?php echo ($cart_data["unpaid"]); ?></span>
                        <p class="iconfont">&#xe606;</p>
                        <p>待付款</p>
                    </a>
                </div>
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 1));?>" class="coad_lnfo_bage">
                        <span><?php echo ($cart_data["unsent"]); ?></span>
                        <p class="iconfont">&#xe605;</p>
                        <p>待发货</p>
                    </a>
                </div>
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 2));?>" class="coad_lnfo_bage">
                        <span><?php echo ($cart_data["unreceive"]); ?></span>
                        <p class="iconfont">&#xe604;</p>
                        <p>待收货</p>
                    </a>
                </div>
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 3));?>" class="coad_lnfo_bage">
                        <span><?php echo ($cart_data["finished"]); ?></span>
                        <p class="iconfont">&#xe608;</p>
                        <p>已完成</p>
                    </a>
                </div>
            </div>
            <a class="weui_cell weui_cell_extend" href="<?php echo U('Distribution/myShop');?>">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe600;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>我的分店</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
            <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Distribution/collection');?>" id="my_collection">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe602;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>我的收藏</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
            <a class="weui_cell weui_cell_extend info_edit" href="<?php echo U('Distribution/myInfo');?>">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe601;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>我的资料</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
            <!--  <a class="weui_cell weui_cell_extend" href="javascript:;">
            <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe607;</div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>推广二维码</p>
            </div>
            <div class="weui_cell_ft"></div>
        </a>
        -->
        <a class="weui_cell weui_cell_extend" href="<?php echo U('Distribution/myAddress');?>" id="address_list_btn">
            <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe609;</div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>地址列表</p>
            </div>
            <div class="weui_cell_ft"></div>
        </a>
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
</div>
<!-- <div class="show_wrap"></div> -->
</body>
</html>
<!-- 加载信息框 -->
<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RES;?>/original/js/require.js" data-main="<?php echo RES;?>/original/js/main"></script>
<script type="text/javascript">
        //rem设置
        // (function(doc, win) {
        //     var docEl = doc.documentElement,
        //         resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        //         recalc = function() {
        //             var clientWidth = docEl.clientWidth>=400?400:docEl.clientWidth;
        //             if (!clientWidth) return;
        //             docEl.style.fontSize = 12 * (clientWidth / 320) + 'px';
        //             //宽与高度
        //             document.body.style.height = clientWidth * (900 / 1440) + "px"
        //         };
        //     win.addEventListener(resizeEvt, recalc, false);
        //     doc.addEventListener('DOMContentLoaded', recalc, false);
        // })(document, window);
</script>
<script>
    function getAction(module,action){
        return "http://<?php echo ($url_par); ?>?g=Wap&m="+module+"&a="+action;
    }
</script>