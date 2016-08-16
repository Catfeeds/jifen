<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css"></head>
<body>
	<div class="container">
		<div class="info_edit_wrap_title">
			<div class="info_edit_wrap_title_item info_edit_wrap_title_left close_edit_wrap"></div>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_center">我的团队</div>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_right"><?php echo count($list);?></div>
		</div>
		<div class="weui_cells weui_cells_access">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><!-- <a class="weui_cell coad_bnfo_lage" href="<?php echo U('Distribution/memberList',array(ids=>$list['ids']));?>"> -->
				<a class="weui_cell" href="javascript:;">
					<div class="weui_cell_bd weui_cell_primary">
						<p><?php echo ($list["nickname"]); ?></p>
					</div>
					<div><?php echo (($list["level"]["name"])?($list["level"]["name"]):"游客"); ?></div>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</body>
</html>