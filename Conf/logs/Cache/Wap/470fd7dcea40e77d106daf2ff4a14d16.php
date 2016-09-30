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
          <p>转账记录</p>
        </div>
      </div>
    </div>
    <div class="weui-row weui-no-gutter weui-row-myBill">
      <div class="weui-col-20">红色咪豆</div>
      <div class="weui-col-20">账号</div>
      <div class="weui-col-20">代理点</div>
      <div class="weui-col-20">类型</div>
      <div class="weui-col-20">时间</div>
    </div>
    <style>
      .account_headimgurl{
        width: 70%;
        margin: 5px auto 0;
        display: block;
      }
      .account_username{
        line-height: 20px;
      }
      .product_logourl{
        width: 70%;
        margin: 5px auto 0;
        display: block;
      }
      .product_name{
        line-height: 20px;
      }
    </style>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="weui-row weui-no-gutter weui-row-myBill_list" style="-ms-flex-align: center;-webkit-align-items: center; -webkit-box-align: center;align-items: center;border-bottom: 1px solid #ccc;">
        <div class="weui-col-20"><?php if(($list["fromgid"]) == $agent['id']): ?>-<?php endif; echo (($list["red"])?($list["red"]):0); ?></div>
        <div class="weui-col-20">
          <?php if(!empty($list["getaccount"]["username"])): ?><img class="account_headimgurl" src="<?php echo ($list["getaccount"]["headimgurl"]); ?>">
            <p class="account_username"><?php echo ($list["getaccount"]["username"]); ?></p><?php endif; ?>
        </div>
        <div class="weui-col-20">
          <?php if(($list["fromgid"]) == $agent['id']): ?><img class="account_headimgurl" src="<?php echo ($list["outagent"]["headimgurl"]); ?>">
            <p><?php echo ($list["outagent"]["name"]); ?></p>
            <?php else: ?>
            <img class="account_headimgurl" src="<?php echo ($list["fromagent"]["headimgurl"]); ?>">
            <p><?php echo ($list["fromagent"]["name"]); ?></p><?php endif; ?>
        </div>
        <div class="weui-col-20">
          <?php if(($list["fromgid"]) != $agent['id']): ?>转入
            <?php else: ?>
            转出<?php endif; ?>
        </div>
        <div class="weui-col-20"><?php echo (date('Y-m-d H:i:s',$list["addtime"])); ?></div>
      </div>
      <?php if(!empty($list["remark"])): ?><div class="all_records_stype">备注:<?php echo ($list["remark"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  </div>
</body>
</html>