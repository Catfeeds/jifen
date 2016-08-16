<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的分店</title>
    <link href="<?php echo RES;?>/distri/css/wdfd.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css"></head>
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
<body>
    <div class="container">
        <div class="title">
            <div class="title_left">
                <img <?php if(($my["headimgurl"]) == ""): ?>src="<?php echo RES;?>/distri/images/portrait.jpg"
                <?php else: ?>
                src="<?php echo ($my["headimgurl"]); ?>"<?php endif; ?>
            class="img">
        </div>
        <!--title_left-->
        <div class="title_right">
            <ul class="title_ul">
                <li>
                    昵称:
                    <?php if(($my["headimgurl"]) == ""): ?>未获取
                        <?php else: ?>
                        <?php echo ($my["nickname"]); endif; ?>
                </li>
                <li>关注时间:<?php echo (date('Y-m-d',$my["createtime"])); ?></li>
            </ul>
        </div>
        <!--title_right-->
        <div class="clear"></div>
    </div>
    <!--title-->

    <div class="weui_cells weui_cells_access" style="margin-top: 0;">
        <a class="weui_cell" href="<?php echo U('Distribution/followOrder');?>">
            <div class="weui_cell_bd weui_cell_primary">
                <p>累计销售</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$totalMoney/100);?>元</div>
        </a>
        <a class="weui_cell" href="#yongjin">
            <div class="weui_cell_bd weui_cell_primary">
                <p>累计佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$totalOfferMoney/100);?>元</div>
        </a>

    </div>
    <style>
            .weui_cell_hd img{
                width:20px;margin-right:5px;display:block
            }
        </style>
    <?php if(($_GET['notBe']) == "1"): ?><div style="color:red;text-align:center;line-height:40px;font-size:1.6em">您目前还未获得分店资格，无法提现</div><?php endif; ?>
    <div class="weui_cells_title">
        分销详情：<?php echo $my['firstNums']+$my['secondNums']+$my['thirdNums'];?>家
    </div>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="<?php echo U('Distribution/memberList',array('type'=> 'first'));?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>A分店</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($my["firstNums"]); ?>家</div>
        </a>
        <a class="weui_cell" href="<?php echo U('Distribution/memberList',array('type'=> 'second'));?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>B分店</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($my["secondNums"]); ?>家</div>
        </a>
        <a class="weui_cell" href="<?php echo U('Distribution/memberList',array('type'=> 'third'));?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>C分店</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($my["thirdNums"]); ?>家</div>
        </a>
    </div>

    <div class="weui_cells_title">所属分店总下单:<?php echo ($orderNums); ?>次</div>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>点击链接</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($my["clickNums"]); ?>次</div>
        </a>
        <a class="weui_cell" href="<?php echo U('Distribution/followList');?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>普通A分店</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($my["followNums"]); ?>家</div>
        </a>
        <a class="weui_cell" href="<?php echo U('Distribution/memberAllList');?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>正式A分店</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($distriCount); ?>家</div>
        </a>
        <a class="weui_cell" href="<?php echo U('Distribution/followOrder');?>">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>分店总共下单</p>
            </div>
            <div class="weui_cell_ft"><?php echo ($orderNums); ?>次</div>
        </a>
    </div>

    <div class="weui_cells_title" id="yongjin">我的佣金:<?php echo sprintf("%.2f",$totalOfferMoney/100);?>元</div>
    <div class="weui_cells">
        <div class="weui_cell">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>已付款订单佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$order['status_1']/100);?>元</div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>未收货订单佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$order['status_2']/100);?>元</div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>已收货点单佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$order['status_3']/100);?>元</div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>可提现佣金总额</p>
            </div>
            <div class="weui_cell_ft">
                <?php echo sprintf("%.2f",($order['status_4']-$my['alreadyGetMoney'])/100);?>元
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>已提现佣金总额</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$my['alreadyGetMoney']/100);?>元</div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd">
                <img src="<?php echo RES;?>/distri/images/jiant.png" alt=""></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>已退款订单佣金</p>
            </div>
            <div class="weui_cell_ft"><?php echo sprintf("%.2f",$order['status_-1']/100);?>元</div>
        </div>
    </div>

    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="<?php echo U('Distribution/getMoney');?>">
            <div class="weui_cell_bd weui_cell_primary">
                <p>申请提现</p>
            </div>
            <div class="weui_cell_ft">
                <?php echo sprintf("%.2f",($order['status_4']-$my['alreadyGetMoney'])/100);?>元
            </div>
        </a>
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
<!--container-->
</body>
</html>