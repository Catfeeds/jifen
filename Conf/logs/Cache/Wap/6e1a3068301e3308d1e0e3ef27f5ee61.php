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
			<div class="info_edit_wrap_title_item info_edit_wrap_title_right"><?php echo ($count); ?>人</div>
		</div>
		<div class="weui_cells weui_cells_access">
				<a class="weui_cell weui_cell_extend coad_lnfo_bage cursor_ios" href="<?php echo U('Distribution/myTeam',array('level'=>1));?>">
				    <div class="weui_cell_bd weui_cell_primary">
				        <p>一级账号</p>
				    </div>
				    <div class="weui_cell_ft weui_cell_ft_extend"></div>
				</a>
				<a class="weui_cell weui_cell_extend coad_lnfo_bage cursor_ios" href="<?php echo U('Distribution/myTeam',array('level'=>2));?>">
				    <div class="weui_cell_bd weui_cell_primary">
				        <p>二级账号</p>
				    </div>
				    <div class="weui_cell_ft weui_cell_ft_extend"></div>
				</a>
		</div>
	</div>
</body>
</html>