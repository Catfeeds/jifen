<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo RES;?>/original/others2/main.css">
  <link rel="stylesheet" href="<?php echo RES;?>/original/others2/iconfont.css">
  <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
  <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css"></head>
<body>
  <div class='container'>
    <style>
      .info_edit_wrap_title .info_edit_wrap_title_left:before{
        border-color: #fff;
      }
    </style>
    <div class="info_edit_wrap_title" style='background-color: #f1bf64; color: #fff;'>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_left close_edit_wrap"></div>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_center"><?php if(($_REQUEST['type']) == "1"): ?>充值记录<?php else: ?>升级记录<?php endif; ?></div>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_right"></div>
      </div>

    <div class="weui_panel weui_panel_access">
      <div class="weui_panel_bd ">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
            <div class="weui_media_hd">
              <img class="weui_media_appmsg_thumb" src="<?php echo ($list["account"]["headimgurl"]); ?>" alt=""></div>
            <div class="weui_media_bd">
              <h4 class="weui_media_title" style="font-size: 14px;">充值人:
                <?php if(($list["back"]) == "1"): ?>后台充值
                  <?php else: ?>
                  <?php echo ($list["member"]["nickname"]); endif; ?>
              </h4>
              <?php if(($_REQUEST['type']) == "1"): ?><p class="weui_media_desc">充值金币:<?php echo ($list["gold"]); ?>元</p>
              <p class="weui_media_desc">充值时间:<?php echo (date('Y-m-d',$list["addtime"])); ?></p>
              <?php else: ?>
              <p class="weui_media_desc">升级等级：<?php echo ($list["level"]["name"]); ?></p>
              <p class="weui_media_desc">升级时间：<?php echo (date('Y-m-d',$list["addtime"])); ?></p><?php endif; ?>
            </div>
            <?php if(($list["aid"]) == $account['id']): switch($list["return"]): case "0": if(($list["back"]) == "0"): ?><div class="weui_cell_ft editinfo_con" data-id=<?php echo ($list["id"]); ?> id="topup_apply_refund">申请退款</div><?php endif; break;?>
                <?php case "1": ?><div class="weui_cell_ft editinfo_con" data-id=<?php echo ($list["id"]); ?>>退款申请中</div><?php break;?>
                <?php case "2": ?><div class="weui_cell_ft editinfo_con" data-id=<?php echo ($list["id"]); ?>>退款完成</div><?php break; endswitch; endif; ?>
            <?php if(($list["bindaid"]) == $account["id"]): switch($list["return"]): case "1": ?><div class="weui_cell_ft editinfo_con" data-id=<?php echo ($list["id"]); ?> id="topup_agree_refund">同意退款</div><?php break;?>
                <?php case "2": ?><div class="weui_cell_ft editinfo_con" data-id=<?php echo ($list["id"]); ?>>退款完成</div><?php break; endswitch; endif; ?>
          </a><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
  </div>
</body>
</html>