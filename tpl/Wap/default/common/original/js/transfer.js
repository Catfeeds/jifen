$(document).on('click','#transfer .save_info',function(){
	var wrap = $('#transfer');
	var code_wrap = wrap.find('.code');
	var code = code_wrap.val();
	var remark = wrap.find('.transfer_remark').val();
	var red_wrap = wrap.find('.red');
	var red = red_wrap.val();
	var wrong = 0;
	if(code == ''){
		floatNotify.simple('推荐码不能为空');
		return false;
	}
	if(red <= 0 || !(/^(\+|-)?\d+$/.test( red ))){
		floatNotify.simple('充值金额有误');
		return false;
	}
	//判断推荐码是够存在
	$.ajax({
		url:getAction('Distribution','judgeMemberCode'),
		data:{code:code},
		dataType:"json",
		async:false,
		success:function(data){
			if(data.status != 1){
				wrong = 1;
				floatNotify.simple(data.info);
				return;
			}
		}
	});
	if(wrong == 1){
		return;
	}
	//判断转账余额
	$.ajax({
		url:getAction('Distribution','judgeIntegralAjax'),
		data:{num:red,type:'red'},
		dataType:"json",
		async:false,
		success:function(data){
			if(data.status != 1){
				wrong = 1;
				floatNotify.simple(data.info);
				return;
			}
		}
	});
	if(wrong == 1){
		return;
	}
	if(wrong == 0){
		$.ajax({
		url:getAction('Distribution','transfer'),
		data:{red:red,code:code,remark:remark},
		type:'post',
		dataType:"json",
		async:false,
		success:function(data){
			console.log(data);
			$('#info_edit_item').val(0);
			floatNotify.simple(data.info);
			// code_wrap.val('');
			// red_wrap.val('');
		}
	});
	}
})