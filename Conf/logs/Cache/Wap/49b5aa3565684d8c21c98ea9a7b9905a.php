<?php if (!defined('THINK_PATH')) exit();?><!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>编辑地址</title>
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css"></head>
<body id="scnhtm5"> -->
	<div class="container">
		
		<div class="info_edit_wrap_title">
			<div class="info_edit_wrap_title_item info_edit_wrap_title_left close_address_edit_wrap"></div>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_center">编辑地址</div>
			<div class="info_edit_wrap_title_item info_edit_wrap_title_right" id="address_save_btn">保存</div>
		</div>
		<form id="address_edit">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
			<input type="hidden" name="mid" value="<?php echo ($my["id"]); ?>">
			<div class="weui_cells weui_cells_form">
				<div class="weui_cell">
					<div class="weui_cell_hd">
						<label class="weui_label">收货人</label>
					</div>
					<div class="weui_cell_bd weui_cell_primary">
						<input id="name" name="name" class="weui_input validation" type="text" placeholder="收货人姓名" data-warn="请输入收货人姓名" value="<?php echo ($info["name"]); ?>"></div>
				</div>
				<div class="weui_cell">
					<div class="weui_cell_hd">
						<label class="weui_label">联系电话</label>
					</div>
					<div class="weui_cell_bd weui_cell_primary">
						<input id="tele" name="tele" class="weui_input validation" type="text" placeholder="手机或固定电话" data-warn="请输入联系方式" value="<?php echo ($info["tele"]); ?>"></div>
				</div>
				<div class="weui_cell">
					<div class="weui_cell_hd">
						<label for="name" class="weui_label">所在地区</label>
					</div>
					<div class="weui_cell_bd weui_cell_primary">
						<input class="weui_input validation" id="start" type="text" <?php if(!empty($info)): ?>value="<?php echo ($info["province"]); ?> <?php echo ($info["city"]); ?> <?php echo ($info["county"]); ?>" data-warn="请选择所在地区"<?php else: ?>value="北京 北京 东城区" data-warn="请选择所在地区"<?php endif; ?>></div>
				</div>
				<div class="weui_cell">
					<div class="weui_cell_bd weui_cell_primary">
						<textarea class="weui_textarea validation" placeholder="详细地址" rows="3" id="address" name="address" data-warn="请输入详细地址"><?php echo ($info["address"]); ?></textarea>
					</div>
				</div>
				<input type="hidden" id="province" name="province">
				<input type="hidden" id="city" name="city">
				<input type="hidden" id="county" name="county"></div>
			<?php if(($info["choose"]) != "1"): ?><div class="weui_cells">
					<div class="weui_cell weui_cell_switch">
						<div class="weui_cell_hd weui_cell_primary">设为默认</div>
						<div class="weui_cell_ft">
							<input class="weui_switch" type="checkbox" id="choose" name="choose"></div>
					</div>
				</div><?php endif; ?>
		</form>
		<?php if(!empty($info["id"])): ?><div class="weui_cells">
				<div class="weui_cell weui_cell_switch">
					<div class="weui_cell_hd weui_cell_primary" style="color: red;" id="info_address_delete_btn" data-id="<?php echo ($info["id"]); ?>">删除地址</div>
				</div>
			</div><?php endif; ?>
		<script>
			  $("#start").cityPicker({
					  title: "选择出发地"
					});	
		</script>
	</div>
<!-- </body>
</html> -->
<!-- <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/original/js/jquery-weui.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/original/js/city-picker.js" type="text/javascript"></script>
<script>
  (function($){
  	$(document).on('click','#save_info',function(){
  		var name,tele,address,choose,warn,can_submit = 1;
  		var province = $('#province');
  		var city = $('#city');
  		var county = $('#county');
  		$('.validation').each(function(){
  			if($.trim($(this).val()) == ''){
  				warn = $(this).data('warn');
  				floatNotify.simple(warn);
  				can_submit = 0;
  				return false;
  			}
  			can_submit = 1;
  		})
  		//拆分地区
  		address = $('#start').val().split(" ");;
  		province.val(address[0]+'省');
  		city.val(address[0]+'市');
  		county.val(address[0]);
  		if(can_submit == 1){
  			var form_info = $('#address_edit').serialize();
  			$.ajax({
  				url:"<?php echo U('Distribution/editAddress');?>",
  				data: form_info,
  				type:'post',
  				dataType:'json',
  				success:function(data){
  					$("input[name='__hash__']").val(data.info);
  					floatNotify.simple(data.data);
  					clearInput();
  				}
  			});
  		}
  	})
  })($)
  function clearInput(){
  	$('.validation').each(function(){
  		$(this).val('');
  	})
  	if($('#choose').is(':checked')){
  		$('#choose').click();
  	}
  }
  $("#start").cityPicker({
		  title: "选择出发地"
		});	
</script>