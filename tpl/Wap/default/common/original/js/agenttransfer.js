$(document).on('click','#agent_transfer .save_info',function(){
	var wrap = $('#agent_transfer');
	var code_wrap = wrap.find('.code');
	var code = code_wrap.val();
	var remark = wrap.find('.transfer_remark').val();
	var red_wrap = wrap.find('.red');
	var red = parseInt(red_wrap.val());
	var type = wrap.find('#type').val();
	var agent_index_myred_wrap = $('#agent_index_myred');
	var myred = parseInt($('#agent_index_myred').text());
	if(code == ''){
		floatNotify.simple('推荐码不能为空');
		return false;
	}
	if(red <= 0 || !(/^(\+|-)?\d+$/.test( red ))){
		floatNotify.simple('转账金额有误');
		return false;
	}
	$.ajax({
		url:getAction('Agent','transfer'),
		data:{red:red,code:code,remark:remark,type:type},
		type:'post',
		dataType:"json",
		async:false,
		success:function(data){
			console.log(data);
			if(data.status == 1){
				$('#info_edit_item').val(0);
				agent_index_myred_wrap.text(myred-red)
			}
			floatNotify.simple(data.info);
		}
	})
})