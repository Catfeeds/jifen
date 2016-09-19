<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <title><?php echo ($title); ?></title>
  <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
  <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css"></head>
<body>
  <div class="container">
    <style>
      .weui_cells_myBill{margin-top: 0;background-color: #f66060;}
      .weui_cell_myBill{color: #fff;padding: 15px 5px;}
      .weui-row-myBill{background-color: #BDBDBD;}
      .weui-row-myBill div{text-align: center;line-height: 35px;}
      .weui-row-myBill_list div{text-align: center;line-height: 35px; font-size: 0.7rem;}
    </style>
    <div class="weui_cells weui_cells_myBill">
      <div class="weui_cell weui_cell_myBill">
        <div class="weui_cell_bd weui_cell_primary">
          <p><?php echo ($name); ?></p>
        </div>
        <div class="weui_cell_ft" style="color: #fff"><?php echo sprintf('%.2f',$info);?></div>
      </div>
    </div>
    <div class="weui-row weui-no-gutter weui-row-myBill">
      <div class="weui-col-33"><?php echo ($name); ?></div>
      <div class="weui-col-33">来源</div>
      <div class="weui-col-33">时间</div>
    </div>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="weui-row weui-no-gutter weui-row-myBill_list" style="-ms-flex-align: center;-webkit-align-items: center; -webkit-box-align: center;align-items: center;">
        <div class="weui-col-33"><?php echo (($list["earn"])?($list["earn"]):0); ?></div>
        <div class="weui-col-33">
          <?php switch($list["status"]): case "1": ?>下级充值<?php break;?>
            <?php case "2": ?>下下级充值<?php break;?>
            <?php case "3": ?>代理收益<?php break;?>
            <?php case "5": ?>公司补贴<?php break;?>
            <?php case "6": ?>充值绿色咪豆<?php break;?>
            <?php case "7": ?>购物<?php break;?>
            <?php case "8": ?>转账<?php break;?>
            <?php case "9": ?>提现<?php break;?>
            <?php case "10": ?>系统配送<?php break;?>
            <?php case "11": ?>购物退款<?php break;?>
            <?php case "14": ?>后台充值<?php break;?>
            <?php case "15": ?>代理点转入<?php break; endswitch;?>
        </div>
        <div class="weui-col-33"><?php echo (date('Y-m-d H:i:s',$list["addtime"])); ?></div>
      </div>
      <?php if(!empty($list["remark"])): ?><div style="font-size: 16px;">备注:<?php echo ($list["remark"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  </div>
</body>
</html>