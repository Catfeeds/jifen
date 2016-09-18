<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo RES;?>/original/others/main.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css"></head>
<body style="background:#efefef">
	<div class="container">
		<style>
  .info_edit_wrap_title .info_edit_wrap_title_left:before{
    border-color: #fff;
  }
</style>
		<div class="info_edit_wrap_title" style='background-color: #f1bf64; color: #fff;'>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_left close_edit_wrap"></div>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_center">订单详情</div>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_right"></div>
		</div>
		<div class="fahuo_information">订单信息</div>
		<div class="fahuo_all">
			<div class="fahuo_box">
				<div class="fahuo_item">订单生成时间</div>
				<div class="fahuo_item1"><?php echo (date('Y-m-d H:m:i',$info["time"])); ?></div>
			</div>
			<?php if(($info["paid"]) == "1"): ?><div class="fahuo_box">
					<div class="fahuo_item">订单支付时间</div>
					<div class="fahuo_item1"><?php echo (date('Y-m-d H:m:i',$info["buytime"])); ?></div>
				</div><?php endif; ?>
			<div class="fahuo_box">
				<div class="fahuo_item">价格</div>
				<div class="fahuo_item1">
					<?php if(($info["integral"]) == "0"): echo ($info["price"]); ?>元
						<?php else: ?>
						<?php echo ($info["integral"]); ?>咪豆<?php endif; ?>
				</div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">交易方式</div>
				<div class="fahuo_item1">
					<?php if(empty($info["integral"])): ?>咪豆支付
						<?php else: ?>
						微信支付<?php endif; ?>
				</div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">交易单号</div>
				<div class="fahuo_item1"><?php echo ($info["orderid"]); ?></div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">交易状态</div>
				<div class="fahuo_item1">
					<?php if(($info["paid"]) == "1"): ?>付款成功
						<?php else: ?>
						未付款<?php endif; ?>
				</div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">对应账号</div>
				<div class="fahuo_item1">
					<?php echo ($info["account"]); ?>
				</div>
			</div>
			<?php if(($info["adminid"]) != "0"): ?><div class="fahuo_box">
					<div class="fahuo_item">订购信息</div>
					<div class="fahuo_item1">
						系统配送
					</div>
				</div><?php endif; ?>
			<?php if(($info["returnMoney"]) != "0"): ?><div class="fahuo_box">
					<div class="fahuo_item">退款状态</div>
					<div class="fahuo_item1">
						<?php switch($info["returnMoney"]): case "1": ?>退款中<?php break;?>
							<?php case "2": ?>退款成功<?php break; endswitch;?>
					</div>
				</div><?php endif; ?>
			<?php if(!empty($info["remark"])): ?><div class="fahuo_box">
					<div class="fahuo_item">留言</div>
					<div class="fahuo_item1"><?php echo ($info["remark"]); ?></div>
				</div><?php endif; ?>
		</div>
		<div class="fahuo_information">收件人信息</div>
		<div class="fahuo_all">
			<div class="fahuo_box">
				<div class="fahuo_item">发货状态</div>
				<div class="fahuo_item1">
					<?php if(($info["sent"]) == "1"): ?>已发货
						<?php else: ?>
						未发货<?php endif; ?>
				</div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">收件人</div>
				<div class="fahuo_item1"><?php echo ($info["truename"]); ?></div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">联系方式</div>
				<div class="fahuo_item1"><?php echo ($info["tel"]); ?></div>
			</div>
			<div class="fahuo_box">
				<div class="fahuo_item">收件地址</div>
				<div class="fahuo_item1">
					<?php echo ($info["province"]); echo ($info["city"]); echo ($info["county"]); echo ($info["address"]); ?>
				</div>
			</div>
		</div>
		<?php if(($info['logistics'] != null) AND ($info['logisticsid'] != null)): ?><div class="fahuo_information">物流信息</div>
			<div class="fahuo_all">
				<div class="fahuo_box">
					<div class="fahuo_item">快递公司</div>
					<div class="fahuo_item1"><?php echo ($info["logistics"]); ?></div>
				</div>
				<div class="fahuo_box">
					<div class="fahuo_item">快递单号</div>
					<div class="fahuo_item1"><?php echo ($info["logisticsid"]); ?></div>
				</div>
				<!-- <a style="display: block;text-indent: 85px;font-size: 15px;color: red;" href="http://m.kuaidi100.com/index_all.html?postid=<?php echo ($info['logisticsid']); ?>">查看物流</a> -->
			</div><?php endif; ?>
		<!-- <?php if(($info["sent"] != 1) AND ($info["returnMoney"] == 0) AND ($info["paid"] == 1) AND ($info["aid"] == $account['id'])): ?><a href="javascript:;" class="weui_btn weui_btn_disabled weui_btn_warn weui_btn_submit" style="background-color: #ebab37;margin-top: 10px;" data-id="<?php echo ($info["id"]); ?>" data-lid="<?php echo ($info["lid"]); ?>" id="order_apply_refund">申请退款</a><?php endif; ?> -->
		<?php if(($info["paid"] == 0) AND ($info["returnMoney"] == 0)): ?><a href="<?php echo U('Store/payNow',array('id'=> $info['id']));?>" class="weui_btn weui_btn_disabled weui_btn_warn weui_btn_submit place_order" data-id="<?php echo ($info["id"]); ?>" style="background-color: #ebab37;margin-top: 10px;">立即付款
			</a><?php endif; ?>
		<!-- <?php if(($info["returnMoney"] == 1) AND ($info["active"] == 1) AND ($info["bindaid"] == $account['id'])): ?><a href="javascript:;" class="weui_btn weui_btn_disabled weui_btn_warn weui_btn_submit" style="background-color: #ebab37;margin-top: 10px;" data-id="<?php echo ($info["id"]); ?>" id="order_agree_refund">同意退款
			</a><?php endif; ?> -->
	</div>
</body>
</html>