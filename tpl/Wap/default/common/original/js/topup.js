//充值
$(document).on('click','#member_topup',function(){
	var gold = $('#gold_num').val();
	var distribution = $('#account_topup_select_distribution').val();
	if(gold.length == 0){
		floatNotify.simple('请输入充值数额');
		return false;
	}
	if(isNaN(gold)){
		floatNotify.simple('请输入数字');
		return false;
	}
	if(gold <= 0 || !(/^(\+|-)?\d+$/.test( gold ))){
		floatNotify.simple('充值金额有误');
		return false;
	}
	// if(distribution == 0){
	// 	floatNotify.simple('请选择配送次数');
	// 	return false;
	// }
	$.ajax({
		url:"index.php?g=Wap&m=Distribution&a=topupCondtionAjax",
		data:{gold:gold},
		type:'post',
		dataType:'json',
		success:function(data){
			if(data.status ==1){
				$('#topup_form').submit();
			}else{
				floatNotify.simple(data.info);
			}
		}
	})
})
//申请充值退款
$(document).on('click','#topup_apply_refund',function(){
	load._show();
	var topup_id = $(this).data('id');
	$.ajax({
		url:"index.php?g=Wap&m=Distribution&a=topupRefund",
		data:{id:topup_id},
		type:'post',
		dataType:'json',
		success:function(data){
			load._hide();
			floatNotify.simple(data.info);
			if(data.status == 1){
				editHide();
			}
		}
	})
})
//同意充值退款
$(document).on('click','#topup_agree_refund',function(){
	load._show();
	var topup_id = $(this).data('id');
	$.ajax({
		url:"index.php?g=Wap&m=Distribution&a=agreeTpRefund",
		data:{id:topup_id},
		type:'post',
		dataType:'json',
		success:function(data){
			load._hide();
			floatNotify.simple(data.info);
			if(data.status == 1){
				editHide();
			}
		}
	})
})