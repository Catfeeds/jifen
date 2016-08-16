<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>分店详情</title>
    <link href="<?php echo RES;?>/distri/css/wdfd.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css"></head>
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css"></head>
    <style>
            .weui_cell_hd img{
                width:20px;margin-right:5px;display:block
            }
        </style>
<body>
    <div class="container">

        <div class="title title1">
            <div class="title_left">
                <img <?php if(($my["headimgurl"]) == ""): ?>src="<?php echo RES;?>/distri/images/portrait.jpg"
                <?php else: ?>
                src="<?php echo ($member["headimgurl"]); ?>"<?php endif; ?>
            class="img">
        </div>
        <div class="title_right">
            <ul class="title_ul">
                <li>
                    昵称:
                    <?php if(($my["headimgurl"]) == ""): ?>未获取
                        <?php else: ?>
                        <?php echo ($member["nickname"]); endif; ?>
                </li>
                <li>关注时间:<?php echo (date('Y-m-d',$member["createtime"])); ?></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div class="weui-row weui-no-gutter">
      <div class="weui-col-50 weui-col-50-extend">累计销售：
        <span style="color:#ff6501;"><?php echo sprintf("%.2f",$member['totalMoney']/100);?>元</span></div>
      <div class="weui-col-50 weui-col-50-extend">贡献佣金：
        <span style="color:#ff6501;"><?php echo sprintf("%.2f",$offerMoney/100);?>元</span></div>
    </div>

    <div class="weui_cells_title">
        他的A分店：<?php echo ($member["firstNums"]); ?>家
    </div>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="<?php echo U('Distribution/agentList',array('token'=> $token,'mid'=>$member['id'],'type'=>'first'));?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>分店数</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($member["firstNums"]); ?>家</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>消费金额</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$member['first_member_totalMoney']/100);?>元</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>贡献佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$member['first_member_offerMoney']/100);?>元</div>
        </a>
    </div>

    <div class="weui_cells_title">
        他的B分店：<?php echo ($member["secondNums"]); ?>家
    </div>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="<?php echo U('Distribution/agentList',array('token'=> $token,'mid'=>$member['id'],'type'=>'second'));?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>分店数</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($member["secondNums"]); ?>家</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>消费金额</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$member['second_member_totalMoney']/100);?>元</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>贡献佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$member['second_member_offerMoney']/100);?>元</div>
        </a>
    </div>

    <div class="weui_cells_title">
        他的C分店：<?php echo ($member["thirdNums"]); ?>家
    </div>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="<?php echo U('Distribution/agentList',array('token'=> $token,'mid'=>$member['id'],'type'=>'second'));?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>分店数</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($member["thirdNums"]); ?>家</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>消费金额</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$member['third_member_totalMoney']/100);?>元</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>贡献佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$member['third_member_offerMoney']/100);?>元</div>
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
    <!-- <?php if((MODULE_NAME == 'Distribution') AND (ACTION_NAME == 'index')): ?><div class="copy" style="text-align:center; margin-top: 20px; font-size: 12px;">技术支持：微广互动</div><?php endif; ?> -->
    <?php if((ACTION_NAME) != "herolist"): ?><section class="foot"></section><?php endif; ?>

</div>
<!--container-->
</body>
</html>