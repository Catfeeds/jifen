define(['jquery','city-picker.min'],function($){
	var del_id;
	function Address(){
		this._inite();
	}
	Address.prototype._inite=function(){
		this._listDelete();
		this._setDefault();
		this._showEditWrap();
		this._closeEditWrap();
		this._saveAddressInfo();
		this._addNewAddress();
	}
	//列表删除按钮
	Address.prototype._listDelete=function(){
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
	}
	//设置默认地址
	Address.prototype._setDefault=function(){
		$(document).on('click',".set_default",function(){
			var obj = $(this);
			var add_wrap = obj.parents(".address");
			var id  = add_wrap.data('id');
			var check = obj.parents(".address").find('.weui_check');
			$.ajax({
				url:getAction('Distribution','chooseAdd'),
				data:{id:id},
				dataType:"json",
				async:false,
				success:function(data){
					console.log(data);
					//判断是够是购物选地址
					if(data.data){
						orderChooseAdd(eval("("+data.data+")"));
					}
					floatNotify.simple(data.info);
					if(data.status == 1){
						check.prop("checked", true);
						add_wrap.siblings().find('.weui_check').prop("checked", false);
					}
				}
			});
		})
	}
	//判断是够是购物选地址
	function orderChooseAdd(data){
		var str;
		if($.type($('#myaddress').html()) != 'undefined'){
			str = $("<div class='shouhuo_name'>"+data.name+" "+data.tele+"</div><div class='shouhuo_dizhi iconfont'>"+data.province+data.city+data.county+data.address+"</div><div class='more'>&gt;</div>");
			$('#myaddress').html(str);
			checkAdd = 1;
			editHide();

			//安卓卡屏BUG
			var u = navigator.userAgent;
			var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
			// var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
			if(isAndroid){
				$('#remark').focus();
			}
		}
	}
	//显示编辑框
	Address.prototype._showEditWrap = function(){
		$(document).on('click',".add_edit_btn",function(e){
			// var id = $(this).parents(".address").data('id');
			// $('.show_wrap2').load(getAction('Distribution','editAddress')+"&id="+id,function(){
			// 	editShow();
			// });
			loadPage(e,$(this),function(){
				editShow();
				$("#start").cityPicker({
					  title: "选择出发地"
					});
			})
		})	
	}
	//保存修改信息
	Address.prototype._saveAddressInfo = function(){
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
					url:getAction('Distribution','editAddress'),
					data: form_info,
					type:'post',
					dataType:'json',
					success:function(data){
						$("input[name='__hash__']").val(data.info);
						if(data.status == 1){
							injection('',getAction('Distribution','myAddress')+' .container',function(){
								floatNotify.simple('添加成功');
								editHide();
							})
						}else{
							floatNotify.simple(data.data);
						}
						clearInput();
					}
				});
			}
		})
	}
	//新增地址
	Address.prototype._addNewAddress = function(){
		$(document).on('click','#add_new_address',function(e){
			load._show();
			clearInput();
			loadPage(e,$(this),function(){
				editShow();
				$("#start").cityPicker({
					  title: "选择出发地"
					});
			})
			// e.preventDefault();
			// injection($('.show_wrap2'),getAction('Distribution','editAddress') + ' .container',function(){
			// 	editShow();
			// 	$("#start").cityPicker({
			// 		  title: "选择出发地"
			// 		});	
			// },e)
		})
	}
	//清除保存信息
	function clearInput(){
		$('.validation').each(function(){
			$(this).val('');
		})
		if($('#choose').is(':checked')){
			$('#choose').click();
		}
	}
	//关闭编辑框
	Address.prototype._closeEditWrap = function(){
		$(document).on('click','.close_address_edit_wrap',function(){
			editHide();
		})
	}
	//删除地址
	function delete_address(del_id){
		var result;
		$.ajax({
			url:getAction('Distribution','delAddress'),
			data:{id:del_id},
			dataType:'json',
			async:false,
			success:function(data){
				console.log(data);
				floatNotify.simple(data.info);
				result = data.status;
			}
		});
		return result;
	}
	return{
		Address:Address
	};
})