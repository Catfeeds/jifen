define(['jquery'],function($){
		//客户订单顶部筛选
		$(document).on('click','#orders_head div',function(){
			var obj = $(this);
			var status = parseInt(obj.index('#orders_head div'))-1;
			var href = "index.php?g=Wap&m=Store&a=my&status="+status+' #my_orders_content';
			$('#my_orders_content').load(href,function(){
				obj.addClass('store_my_col_choose').siblings().removeClass('store_my_col_choose');
			});
		})
		//申请退款
		$(document).on('click','#order_apply_refund',function(){
			var cart_id = $(this).data('id');
			var lid = $(this).data('lid');
			var warn = '';
			console.log('aas');
			if(lid == 0){
				warn = "确定申请退款吗？";
			}else{
				warn = "该订单是升级订单,确认退款？"
			}
			confirm =floatNotify.confirm(warn, "",
			    function(t, n) {
			        if(n==true){
			        	$.ajax({
			        		url:"index.php?g=Wap&m=Store&a=returnCart",
			        		data:{cartid:cart_id},
			        		dataType:'json',
			        		type:'post',
			        		success:function(data){
			        			console.log(data);
			        			floatNotify.simple(data.info);
			        			if(data.status == 1){
			        				editHide();
			        			}
			        		}
			        	});
			        }
				this.hide();
			  }),
			confirm.show();
		})
		//立即支付判断商品限制条件
		$(document).on('click','.place_order',function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			location.href=href;
			// $.ajax({
			// 	url:getAction('Store','checkLimitAjax'),
			// 	data:{order_id:$(this).data("id")},
			// 	dataType:"json",
			// 	success:function(data){
			// 		if(data.status == 1){
			// 			location.href=href;
			// 		}else{
			// 			return floatNotify.simple(data.info);
			// 		}
			// 	}
			// });
		})
		//确认收货
		$(document).on('click','.get_product',function(e){
			e.preventDefault();
			var obj = $(this);
			var productid = $(this).data('id');
			confirm = floatNotify.confirm('确认收货？',"",function(t,n){
				if(n == true){
					$.ajax({
						url:getAction('Store','getProduct'),
						data:{productid:productid},
						type:'post',
						dataType:"json",
						success:function(data){
							console.log(data);
							floatNotify.simple(data.info);
							if(data.status == 1){
								obj.hide();
							}
						}
					});
				}
				this.hide();
			});
			confirm.show();
		})
})