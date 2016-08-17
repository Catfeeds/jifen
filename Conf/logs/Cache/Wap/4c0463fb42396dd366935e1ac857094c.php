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
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css"></head>
<body>

	<div class='container'>
		<div class="per_top_all">
			<div class="per_top_img">
				<img src="<?php echo ($account["headimgurl"]); ?>"></div>
			<div class="per_top_explain">
				<div class="per_top_name">昵称：<?php echo ($account["username"]); ?></div>
				<a href="<?php echo U('Distribution/tpupRecord',array('type'=> 1));?>" class='coad_lnfo_bage'>
					<div class="per_top_see">充值记录</div>
				</a>
				<?php if(!empty($hasrefund)): ?><a href="<?php echo U('Distribution/topupRagree',array('type'=> 1));?>" class='coad_lnfo_bage'>
						<div class="per_top_see" style="">下级退款处理</div>
					</a><?php endif; ?>
				<?php if(!empty($upgradeefund)): ?><a href="<?php echo U('Distribution/topupRagree',array('type'=> 2));?>" class='coad_lnfo_bage'>
						<div class="per_top_see" style="">下级升级退款</div>
					</a><?php endif; ?>
			</div>
		</div>
		<form action="<?php echo U('Distribution/topupSubmit');?>" method="post" id="topup_form">
			<div class="weui_cells weui_cells_form">
				<div class="weui_cell">
					<div class="weui_cell_hd">
						<label class="weui_label">充值金额</label>
					</div>
					<div class="weui_cell_bd weui_cell_primary">
						<input class="weui_input" type="tel" id="gold_num" name="gold" placeholder="输入充值金额"></div>
				</div>
			</div>
			<div class='demos-content-padded'>
				<a href="javascript:;" class="weui_btn weui_btn_disabled weui_btn_warn weui_btn_submit" id="member_topup" style="background-color: #f1bf64; color:#fff;">确认</a>
			</div>
		</form>
	</div>

</body>
</html>
<script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RES;?>/original/js/require.js" data-main="<?php echo RES;?>/original/js/myshop" type="text/javascript" charset="utf-8"></script>