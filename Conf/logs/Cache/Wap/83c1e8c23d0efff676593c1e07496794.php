<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
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
<style>
  .editinfo_btn{
    cursor: pointer;
  }
</style>
<body id="scnhtm5">
    <div class="content_wrap index_wrap">
        <div class="dis_head">
            <a href="<?php echo U('Agent/mypic');?>" class="coad_lnfo_bage">
              <img id="index_headimgurl" src="<?php echo ($agent["headimgurl"]); ?>">
            </a>
            <p id="index_nickname"><?php echo (($agent["name"])?($agent["name"]):"未填写"); ?></p>
        </div>
        <div class="weui_cells weui_cells_extend weui_cells_access">
            <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Agent/transfer');?>">
              <div class="weui_cell_bd weui_cell_primary" style="padding-left: 24%;">
                <p style="color:red;font-size: 22px; ">店铺收入</p>
                <p class="money_color1" id="agent_index_myred" style="color:red;font-size: 22px;"><?php echo (($agent['red'])?($agent['red']):0); ?></p>
              </div>
              <div class="weui_cell_ft weui_cell_ft_extend">我要转账</div>
            </a>
        </div>
        <style>
          .agent_login_out{
            max-width: 640px;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 40px;
            background-color: #ea2929;
            z-index: 1;
            margin: 0 auto;
            left: 0;
            right: 0;
            text-align: center;
            line-height: 40px;
            color: #fff;
            font-size: 22px;
          }
          .agent_mycode{
            background-color: #fff;
            margin-top: 10px;
            margin-bottom: 10px;
            border-top: 1px solid #ffd500;
            border-bottom: 1px solid #ffd500;
            text-align: center;
            line-height: 40px;
            font-size: 22px;
            background-color: #03A9F4;
            color: #fff;
          }
        </style>
        <div class="agent_mycode">
          分店号码:&nbsp;<label style="color: red;font-size:22px;"><?php echo ($agent["code"]); ?></label>
        </div>
        <div class="weui-row weui-row-extend weui-no-gutter">
          <div class="weui-col-33">
              <a href="<?php echo U('Agent/myTeam');?>" class="coad_lnfo_bage">
                  <p class="money_color1"><?php echo ($info["lowernums"]); ?></p>
                  <p>下级人数</p>
              </a>
          </div>
          <div class="weui-col-33">
              <a href="<?php echo U('Agent/lowerOrdersRecords');?>"  class="coad_lnfo_bage">
                  <p class="money_color1"><?php echo sprintf('%.2f',$info['totalpay']);?></p>
                  <p>下级消费总额</p>
              </a>
          </div>
          <div class="weui-col-33">
              <a href="<?php echo U('Agent/topUpRecords');?>" class="coad_lnfo_bage">
                  <p class="money_color1" style="color:green;"><?php echo sprintf('%.2f',$info['totaltopup']);?></p>
                  <p style="color:green;">下级充值总额</p>
              </a>
          </div>
        </div>

        <div class="weui-row weui-row-extend2 weui-no-gutter">
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Agent/myInfo');?>" class="coad_lnfo_bage info_edit">
                  <p class="iconfont">&#xe6ca;</p>
                  <p>我的资料</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Agent/transferRecord');?>" class='coad_lnfo_bage'>
                  <p class="iconfont">&#xe611;</p>
                  <p>转账记录</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Agent/redRecord');?>" class='coad_lnfo_bage'>
                  <p class="iconfont">&#xe611;</p>
                  <p>分红记录</p>
              </a>
          </div>
          <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Agent/myTeam');?>" class='coad_lnfo_bage'>
                  <p class="iconfont">&#xe610;</p>
                  <p>账号明细</p>
              </a>
          </div>
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/charts');?>">
                  <p class="iconfont">&#xe60f;</p>
                  <p>分店统计</p>
              </a>
          </div> -->
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/register',array('from'=>myshop));?>">
                  <p class="iconfont">&#xe60a;</p>
                  <p>开通下级账号</p>
              </a>
          </div> -->
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/followList');?>" class='coad_lnfo_bage'>
                  <p class="iconfont" style="font-size: 9vw;">&#xe614;</p>
                  <p>推广人员</p>
              </a>
          </div> -->
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Distribution/index');?>">
                  <p class="iconfont" style="background-color: #a0ff00;">&#xe6ca;</p>
                  <p>会员中心</p>
              </a>
          </div> -->
          <!-- <div class="weui-col-25 weui-col-extend">
              <a href="<?php echo U('Agent/loginoutAjax');?>">
                  <p class="iconfont" style="line-height: 13vw;">&#xe61b;</p>
                  <p>退出登陆</p>
              </a>
          </div> -->
        </div>  
    </div>
    <a href="<?php echo U('Agent/loginoutAjax');?>" class="agent_login_out">
      退出登陆
    </a>
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
<script>
    function getAction(module,action){
        return "http://<?php echo ($url_par); ?>?g=Wap&m="+module+"&a="+action;
    }
</script>