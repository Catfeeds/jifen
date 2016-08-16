<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<title>管理收货地址</title>
	<script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
	<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">

</head>
<body id="scnhtm5">
	<div class="container">
		<div id="address_list">
			<div class="info_edit_wrap_title">
				<div class="info_edit_wrap_title_item info_edit_wrap_title_left close_edit_wrap"></div>
				<div class="info_edit_wrap_title_item info_edit_wrap_title_center">管理收货地址</div>
				<a href="<?php echo U('Distribution/editAddress');?>" id="add_new_address">
					<div class="info_edit_wrap_title_item info_edit_wrap_title_right plus_sign"></div>
				</a>
			</div>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="address"  data-id="<?php echo ($list["id"]); ?>">
					<div class="weui_cells weui_cells_checkbox">
						<div class="weui_cell">
							<div class="weui_cell_bd weui_cell_primary">
								<p><?php echo ($list["name"]); ?></p>
							</div>
							<div class="weui_cell_ft"><?php echo ($list["tele"]); ?></div>
						</div>
						<div class="weui_cell">
							<div class="weui_cell_bd weui_cell_primary">
								<p>
									<?php echo ($list["province"]); echo ($list["city"]); echo ($list["county"]); echo ($list["address"]); ?>
								</p>
							</div>
						</div>
						<div class="weui_cell weui_check_label">
							<div class="weui_cell_hd set_default cursor_ios">
								<input type="checkbox" class="weui_check" name="checkbox1" id="s11" <?php if(($list["choose"]) == "1"): ?>checked="checked"<?php endif; ?>> <i class="weui_icon_checked"></i>
							</div>
							<div class="weui_cell_bd weui_cell_primary set_default cursor_ios">
								<p style="color:#09BB07;">设为默认</p>
							</div>
							<div class="weui_cell_ft weui_cell_ft_address">
								<a href="<?php echo U('Distribution/editAddress',array('id'=>$list['id']));?>" class="add_edit_btn"> <i class="iconfont">&#xe60b;</i>
									<span>编辑</span>
								</a>
								<a href="javascript:;" class="delete_address">
									<i class="iconfont">&#xe612;</i>
								<span>删除</span>
								</a>
							</div>
						</div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<!-- <div class="add_foot">
				<?php if(!empty($shopping)): ?><a class="weui_btn weui_btn_primary" href="<?php echo ($shopping); ?>">继续支付</a><?php endif; ?>
				<a href="javscript:;" class="weui_btn weui_btn_primary" id="add_new_address">新增新地址</a>
			</div> -->
		</div>
<!-- 		<div id="add_edit_wrap" class='show_wrap2'></div> -->
	</div>
</body>
</html>
<script src="<?php echo RES;?>/original/js/jquery-weui.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/original/js/city-picker.js" type="text/javascript"></script>
<script>
	(function($){
		var del_id;
		//列表删除按钮
		$(document).on('click','.delete_address',function(){
			var obj = $(this);
			del_id = obj.parents('.address').data('id');
			confirm =floatNotify.confirm("确定删除该地址？", "",
			    function(t, n) {
			        if(n==true){
			        	var result = delete_address(del_id);
			        	if(result == 1){
			        		obj.parents('.address').remove();
			        	}
			        }
				this.hide();
			  }),
			confirm.show();
		})
		//从详情页删除地址
		$(document).on('click','#info_address_delete_btn',function(){
			del_id = $(this).data('id');
			var result = delete_address(del_id);
			if(result == 1){
				obj.parents('.address').remove();
			}
		})
		//删除地址
		function delete_address(del_id){
			var result;
			$.ajax({
				url:"<?php echo U('Distribution/delAddress');?>",
				data:{id:del_id},
				dataType:'json',
				async:false,
				success:function(data){
					floatNotify.simple(data.info);
					result = data.status;
				}
			});
			return result;
		}
		//设置默认地址
		$(document).on('click',".set_default",function(){
			var obj = $(this);
			var add_wrap = obj.parents(".address");
			var id  = add_wrap.data('id');
			var check = obj.parents(".address").find('.weui_check');
			if(!check.is(':checked')){
				$.ajax({
					url:"<?php echo U('Distribution/chooseAdd');?>",
					data:{id:id},
					dataType:"json",
					async:false,
					success:function(data){
						floatNotify.simple(data.info);
						if(data.status == 1){
							check.prop("checked", true);
							add_wrap.siblings().find('.weui_check').prop("checked", false);
						}
					}
				});
			}else{
				return;
			}
		})
		//显示编辑框
		$(document).on('click',".add_edit_btn",function(){
			var id = $(this).parents(".address").data('id');
			var address_edit_wrap_html = $('#add_edit_wrap').html();
			if(address_edit_wrap_html == ''){
				$('#add_edit_wrap').load("<?php echo U('Distribution/editAddress',array('id'=>"+id+"));?>");
				$('#add_edit_wrap').show().animate({'left':0},300);
			}else{
				$('#add_edit_wrap').show().animate({'left':0},300);
			}
		})	
		//关闭编辑框
		$(document).on('click','.close_address_edit_wrap',function(){
			$('#add_edit_wrap').animate({'left':'100%'},300,function(){
				$('#add_edit_wrap').hide();
			});
		})
		//保持编辑
		$(document).on('click','#address_save_btn',function(){
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
			province.val(address[0]);
			city.val(address[1]);
			county.val(address[2]);
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
						$('#add_edit_wrap').show().animate({'left':'100%'},300);
					}
				});
			}
		})
		//清空编辑框
		function clearInput(){
			$('.validation').each(function(){
				$(this).val('');
			})
			if($('#choose').is(':checked')){
				$('#choose').click();
			}
		}
		//选择地址
		$("#start").cityPicker({
		  title: "选择出发地"
		});	
	})($);
</script>