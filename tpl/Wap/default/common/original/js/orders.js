define(['jquery','common'],function($,common){
		var common2 = new common.Common();
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
			confirm =floatNotify.confirm("确定申请退款吗？", "",
			    function(t, n) {
			        if(n==true){
			        	$.ajax({
			        		url:"index.php?g=Wap&m=Store&a=returnCart",
			        		data:{cartid:cart_id},
			        		dataType:'json',
			        		success:function(data){
			        			console.log(data);
			        			floatNotify.simple(data.info);
			        			if(data.status == 1){
			        				common2.editHide();
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
		//取消订单
		$(document).on('click','.cancel_order',function(e){
			e.preventDefault();
			var obj = $(this);
			var cartid = $(this).data('id');
			confirm = floatNotify.confirm('确认取消该订单？',"",function(t,n){
				if(n == true){
					$.ajax({
						url:getAction('Store','cancelCart'),
						data:{cartid:cartid},
						dataType:"json",
						success:function(data){
							console.log(data);
							floatNotify.simple(data.info);
							if(data.status == 1){
								obj.perents('.weui_cells').hide();
							}
						}
					});
				}
				this.hide();
			});
			confirm.show();
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