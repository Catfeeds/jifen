<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
	<title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
</head>
<body>
	<div class="container getmoneylist">
		<style>
			.getmoneylist .weui_cells_getmoneylist{margin-top: 0;}
			.getmoneylist .weui_cell_getmoneylist{background-color: #f66060;color: #fff !important;padding: 30px 10px;}
			.getmoneylist .weui_cell_getmoneylist .weui_cell_ft{color: #fff}
			.getmoneylist .weui_cell_getmoneylist .weui_cell_ft:after{content:'';border-color: #fff !important;}
			.getmoneylist .weui-row-getmoneylist p{text-align: center;}
			.getmoneylist [class*="weui-col-"] {
			    border: 1px solid #ececec;
			    line-height: 25px;
			    text-align: center;
			    font-size: 0.8rem;
			}
			.getmoneylist .weui_btn_getmoneylist{margin: 10px;background-color: #f66060;}
			.getmoneylist .color_getmoneylist{color: #f66060}
		</style>
		<div class="weui_cells weui_cells_access weui_cells_getmoneylist">
		  <a class="weui_cell weui_cell_getmoneylist coad_lnfo_bage" href="<?php echo U('Distribution/myBill');?>">
		    <div class="weui_cell_bd weui_cell_primary">
		      <p>可提现金额(元)</p>
		      <p><?php echo sprintf("%.2f",($totalOfferMoney2-$my['alreadyGetMoney'])/100);?></p>
		    </div>
		    <div class="weui_cell_ft" id="test">账单</div>
		  </a>
		  <div class="weui_cell">
		    <div class="weui_cell_bd weui_cell_primary">
		      <p>累计收入(元)<a class="color_getmoneylist" href="<?php echo U('Distribution/followOrder');?>" style="font-size: 0.7rem;padding-left: 5px;">查看详情</a></p>
		      <p class="color_getmoneylist"><?php echo sprintf("%.2f",$totalOfferMoney/100);?></p>
		    </div>
		  </div>
		  <div class="weui-row weui-no-gutter weui-row-getmoneylist">
		    <div class="weui-col-33"><p>待确认(元)</p><p><?php echo ($notget); ?></p></div>
		    <div class="weui-col-33"><p>提现中(元)</p><p><?php echo ($notget); ?></p></div>
		    <div class="weui-col-33"><p>已提现(元)</p><p><?php echo ($get); ?></p></div>
		  </div>
		</div>
		<a href="<?php echo U('Distribution/getMoney');?>" class="weui_btn weui_btn_primary weui_btn_getmoneylist">我要提现</a>
	</div>
</body>
</html>