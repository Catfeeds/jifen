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
		  <a class="weui_cell weui_cell_getmoneylist coad_lnfo_bage"  href="<?php echo U('Agent/earnDetails',array('type'=>'red'));?>">
		    <div class="weui_cell_bd weui_cell_primary">
		      <p>可用红色咪豆</p>
		      <p><?php echo sprintf("%.2f",$agent['red']);?></p>
		    </div>
		    <div class="weui_cell_ft" id="test">查看详情</div>
		  </a>
		</div>
		<?php if(($account["bartender"]) != "1"): ?><a href="<?php echo U('Agent/transfer');?>" class="weui_btn weui_btn_primary weui_btn_getmoneylist coad_lnfo_bage">我要转账</a><?php endif; ?>
	</div>
</body>
</html>