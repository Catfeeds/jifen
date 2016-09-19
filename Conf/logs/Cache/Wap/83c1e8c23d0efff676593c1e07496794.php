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
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/agent.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/others/main2.css">
    <link href="<?php echo RES;?>/distri/css/fdlb.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8" defer></script>
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
            <img id="index_headimgurl" src="<?php echo ($agent["headimgurl"]); ?>">
            <p id="index_nickname"><?php echo (($agent["username"])?($agent["username"]):"未填写"); ?>的分店</p>
        </div>
        <div class="weui_cells weui_cells_extend weui_cells_access">
            <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Agent/getMoneyList');?>">
              <div class="weui_cell_bd weui_cell_primary" style="padding-left: 24%;">
                <p>我的红色咪豆<?php if(!empty($hasrefund)): ?><label style="color: red;">(有退款信息)</label><?php endif; ?></p>
                <p class="money_color1"><?php echo (($agent['red'])?($agent['red']):0); ?></p>
              </div>
              <div class="weui_cell_ft weui_cell_ft_extend">查看详情</div>
            </a>
        </div>
        <div class="weui-row weui-row-extend weui-no-gutter">
          <div class="weui-col-50">
              <a href="<?php echo U('Store/myOrders',array('status'=>-1));?>" class="coad_lnfo_bage">
                  <p class="money_color1"><?php echo (($info["ordernums"])?($info["ordernums"]):0); ?></p>
                  <p>下级订单数</p>
              </a>
          </div>
          <div class="weui-col-50">
              <a href="<?php echo U('Distribution/getMoneyList');?>" class="coad_lnfo_bage">
                  <p class="money_color1"><?php echo sprintf('%.2f',$info['totalearn']);?></p>
                  <p>总收入</p>
              </a>
          </div>
        </div>

        <div class="weui-row weui-row-extend2 weui-no-gutter">
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/generateQrcode');?>">
                  <p class="iconfont">&#xe6ca;</p>
                  <p>我的资料</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Store/myOrders');?>" class='coad_lnfo_bage'>
                  <p class="iconfont">&#xe611;</p>
                  <p>下级订单</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/myTeam');?>" class='coad_lnfo_bage'>
                  <p class="iconfont">&#xe610;</p>
                  <p>团队管理</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/charts');?>">
                  <p class="iconfont">&#xe60f;</p>
                  <p>分店统计</p>
              </a>
          </div>
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/register',array('from'=>myshop));?>">
                  <p class="iconfont">&#xe60a;</p>
                  <p>开通下级账号</p>
              </a>
          </div> -->
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/followList');?>" class='coad_lnfo_bage'>
                  <p class="iconfont" style="font-size: 9vw;">&#xe614;</p>
                  <p>推广人员</p>
              </a>
          </div>
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/index');?>">
                  <p class="iconfont" style="background-color: #a0ff00;">&#xe6ca;</p>
                  <p>会员中心</p>
              </a>
          </div> -->
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Agent/loginoutAjax');?>">
                  <p class="iconfont" style="line-height: 13vw;">&#xe61b;</p>
                  <p>退出登陆</p>
              </a>
          </div>
        </div>  
    </div>
</body>
</html>
<script>
  (function($){
    var window_width = $(window).width();
    if(window_width > 640){
      $('.weui-row-extend2 .weui-col-extend p:nth-of-type(1)').css({'width':'120px','height':'120px','line-height':'120px','font-size':'80px'});
      $('.weui-row-extend2 .weui-col-extend:eq(7) p:nth-of-type(1)').css({'width':'120px','height':'120px','line-height':'120px','font-size':'50px'});
      $('.weui-row-extend2 .weui-col-extend:eq(5) p:nth-of-type(1)').css({'width':'120px','height':'120px','line-height':'120px','font-size':'63px'});
    }
  })($)
</script>