define(['jquery','ajaxfileupload'],function($,aimg){
	var name,data,info_item,title;
	function PInfoEdit(){
		this._inite();
	}
	PInfoEdit.prototype._inite=function(){
		this._EditClick();//点击编辑
		this._EditClose();//关闭编辑框
		this._SaveBtn();//保存按钮
		this._IputController();//输入框操作
		this._ImgChange();//修改图片
	}
	PInfoEdit.prototype._EditClick=function(){
		//弹出编辑框
		$(".editinfo_btn").on("click", function() {
			info_item = $(this).find('.editinfo_con');
			name = info_item.data('name');
			if(name == 'password'){
				$("#info_edit_item").attr('type','password');
			}else{
				$("#info_edit_item").attr('type','text');
			}
			data = info_item.text();
			title = $(this).find('.editinfo_title').text();
			// $('.show_wrap2').html($('#info_edit_wrap').html());
			$('#eidt_info_title').text(title);
			$("#info_edit_item").val(data);
			$('#info_edit_wrap').show().animate({'left':0},300);
		})
	}
	PInfoEdit.prototype._EditClose=function(){
		$('#close_info_edit').bind('click',function(){
		   $('#info_edit_wrap').animate({'left':'100%'},300);
		})
	}
	PInfoEdit.prototype._SaveBtn=function(){
		//保存信息按钮
		$("#save_info").on("click",function(){
			var new_info = $("#info_edit_item").val();
			if (new_info) {
				//如果是判断密码输入
				if(name == 'password'){
					var reg = /^[A-Za-z0-9]{6,16}$/;
					if(reg.test(new_info) == false){
					    return floatNotify.simple('密码必须由6-16位字母、数字组成');
					}
				}

				$.ajax({
					url: getAction('Distribution','myInfo'),
					data: {
						name: name,
						info: new_info
					},
					type: 'post',
					dataType: 'json',
					async:false,
					success: function(data) {
						console.log(data);
						if(data.status == 1){
							floatNotify.simple(data.info);
							if(name !='password'){
								info_item.text(new_info);
							}
							$('#close_info_edit').click();
							if(name == 'nickname'){//个人中心首页顶部昵称 赋值
								$('#index_nickname').text(new_info);
							}
						}else{
							floatNotify.simple(data.info);
						}
					}
				})
			} else {
				floatNotify.simple('内容不能为空');
				return false;
			}
		})
	}
	PInfoEdit.prototype._IputController=function(){
		var edit_input = $('.weui_input_infoedit');
		var delete_btn = $('.weui_infoedit_delete');
		var input_info = edit_input.val();
		//起始判断
		if(input_info){
		  delete_btn.css('opacity',1);
		}
		//输入
		edit_input.on('keyup',function(){
		  input_info = edit_input.val();
		  if(input_info){
		    delete_btn.css('opacity',1);
		  }else{
		    delete_btn.css('opacity',0);
		  }
		})
		//删除
		delete_btn.on('click',function(){
		  edit_input.val('');
		  delete_btn.css('opacity',0);
		})
	}
	PInfoEdit.prototype._ImgChange=function(){
		$(document).on('change',"#shoplogo",function(){

			var filepath=$("#shoplogo").val();
		    var extStart=filepath.lastIndexOf(".");
		    var ext=filepath.substring(extStart,filepath.length).toUpperCase();
		    if(ext!=".PNG"&&ext!=".JPG"&&ext!=".JPEG"){
		    	floatNotify.simple("图片限于png,jpeg,jpg格式");
		    	return false;
		    }
			var loading = $("#img_upload_loading");
			loading.show();
			$.ajaxFileUpload({
				url: getAction('Distribution','headpic'),
				type: 'post',
				secureuri: false,
				fileElementId: 'shoplogo',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					loading.hide();
					if (data.status == 1) {
						$("#headimg").attr("src", data.data);
						$("#index_headimgurl").attr("src", data.data);
					} else if (data.status == 2) {
						floatNotify.simple("上传失败，只支持JPG图片");
						return;
					} else if (data.status == 3) {
						floatNotify.simple("只能三天更新一次!");
						return;
					}
				}
			})
			return false;					
		})
	}
	return{
		PInfoEdit:PInfoEdit
	};
})