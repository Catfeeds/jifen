<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="target-densitydpi=device-dpi, width=640,user-scalable=0" name="viewport">
<title>用户中心-<?php if(($_GET['type']) == "2"): ?>余额提现<?php else: ?>佣金提现<?php endif; ?></title>
<link href="<?php echo RES;?>/distri/css/head.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/distri/css/tx.css" rel="stylesheet" type="text/css" />
<script src="<?php echo RES;?>/distri/js/jquery-1.8.3.min.js"></script>
<style>
.deploy_ctype_tip{z-index:1001;width:100%;text-align:center;position:fixed;top:50%;margin-top:-23px;left:0;}.deploy_ctype_tip p{display:inline-block;padding:23px 34px;border:solid #d6d482 1px;background:#f5f4c5;font-size:1.6em;color:#8f772f;line-height:30px;border-radius:3px;}
#pay-way-box{
	position: relative;
	height: 140px;
	width: 100%;
	overflow: hidden;
}
.ali-box,.bank-box{
	position: absolute;
	width: 100%;
	top: 0;
	left: 0;
}
.bank-box{
	left: 100%;
}
.pay-icon{
	display: inline-block;
    width: 40px;
    height: 40px;
    margin-top: -10px;
    vertical-align: middle;
    background-size: 100%;
}
.ali-icon{
	background: url("<?php echo RES;?>/distri/images/aliicon.jpg") no-repeat center top;
}
.bank-icon{
	background: url("<?php echo RES;?>/distri/images/bankicon.png") no-repeat center top;
	width: 60px;
	margin-top: -2px;
}
</style>
<script src="<?php echo RES;?>/distri/js/require.js" data-main="<?php echo RES;?>/distri/js/getmoney" type="text/javascript" charset="utf-8"></script>
</head>

<body>
	<div class="container">
      <div class="text">
        	<div class="cont">
        		<div class="cont_left">真实姓名:</div><!--cont_left-->
                <div class="cont_right">
                  <input  type="text" name="name" value="<?php echo ($my["name"]); ?>" id="name" class="bd" placeholder="请输入真实姓名"/>
                </div><!--cont_right-->
       	    </div><!--cont-->
            
            <div class="cont">
        		<div class="cont_left">联系电话:</div><!--cont_left-->
                <div class="cont_right">
                  <input type="text" name="tele" id="tele" value="<?php echo ($my["tele"]); ?>" class="bd" placeholder="请输入联系电话"/>
                </div><!--cont_right-->
       	    </div><!--cont-->
       	    <div class="cont3 choose-pay">
       	    	<div class="cont_left1"><span class="pay-icon ali-icon"></span><span class="dd" data-type="1">切换到银行卡</span></div><!--cont_left-->
       	        <div class="cont_right2"><a href="javascript:;">></a></div><!--cont_right-->
       	    </div>
       	    <div class="clear"></div>
       	    <div id="pay-way-box">
	       	    <div class="ali-box">
		       	    <div class="cont">
		       	   	    <div class="cont_left">支付宝账号:</div>
		                <div class="cont_right">
		                  <input type="text" name="aliNumber" id="aliNumber" value="" class="bd" placeholder="请输入支付宝账号"/>
		                </div>
		            </div>
		            <div class="cont">
		        		<div class="cont_left">支付宝姓名:</div>
		                <div class="cont_right">
		                  <input type="text" name="aliName" id="aliName" value="" class="bd" placeholder="请输入支付宝姓名"/>
		                </div>
		       	    </div>
		       	    <div class="clear"></div>
				</div>
				<div class="bank-box">
		       	    <div class="cont">
		        		<div class="cont_left">开户行:</div>
		                <div class="cont_right">
		                  <input type="text" name="bankName" id="bankName" value="" class="bd" placeholder="请输入开户行名称"/>
		                </div>
		       	    </div>
		       	    <div class="cont">
		        		<div class="cont_left">银行卡号:</div>
		                <div class="cont_right">
		                  <input type="text" name="bankNumber" id="bankNumber" value="" class="bd" placeholder="请输入银行卡号"/>
		                </div>
		       	    </div>
		       	    <div class="clear"></div>
		       	</div>
		    </div>
        </div>
        
        <div class="text">
       	  <div class="cont1">您当前可提现的金额是<?php echo $getmoney;?>元</div><!--cont-->
       	  <div class="cont1">(注:请核对好您的账号与姓名,出现错误概不负责)</div><!--cont-->
       	  <input type="hidden" id="nowMoney" value="<?php echo $getmoney;?>" />
       	  <div class="cont1" style="font-size: 1.1rem;line-height: 30px;height: 30px;">提现将扣除<?php if(($_GET['type']) == "2"): ?>2%<?php else: ?>5%<?php endif; ?>的手续费</div><!--cont-->
          <div class="cont1 cont2">注：每次提现金额在50到5万之间</div><!--cont-->
            <div class="cont1"><input name="money" id="money" type="text" class="bd1" value="" placeholder="请输入提现金额"/></div><!--cont-->
            
            
        </div><!--text-->
        <div class="clear"></div>
        <input type="button" name="button" id="pxbtn" value="提交" class="tj"/>
        <a href="<?php echo U('Distribution/getMoneyList',array('token'=>$token));?>">
        <div class="cont3">
        	<div class="cont_left1"><img src="<?php echo RES;?>/distri/images/txjl.png" class="tb"><span class="dd">提现记录</span></div><!--cont_left-->
            <div class="cont_right2"><a href="<?php echo U('Distribution/getMoneyList',array('token'=>$token));?>">></a></div><!--cont_right-->
        </div><!--cont3-->
        </a>
        <a href="<?php echo U('Distribution/getMoneyProcess',array('token'=>$token));?>"><div class="cont3">
        	<div class="cont_left1"><img src="<?php echo RES;?>/distri/images/yj.png" class="tb"><span class="dd">佣金结算流程说明</span></div><!--cont_left-->
            <div class="cont_right2"><a href="<?php echo U('Distribution/getMoneyProcess',array('token'=>$token));?>">></a></div><!--cont_right-->
        </div><!--cont3-->
		</a>
    
    </div><!--container-->
<script>
	$(document).ready(function() {

	 $("#pxbtn").bind("click",
		function() {

			var self = $(this);
			var wecha_id = "<?php echo ($wecha_id); ?>";
			var name = $('#name').val();
			var tele = $('#tele').val();
			var money = $('#money').val();
			var bankname = $('#bankName').val();
			var banknumber = $('#bankNumber').val();
			var alinumber = $('#aliNumber').val();
			var aliname = $('#aliName').val();

			if (wecha_id == '') {

				showTip("异常的访问链接");

				return;

			}
			if(name==''){
				showTip("姓名不能为空");

				return;
			}
			if(tele==''){
				showTip("手机号码不能为空");

				return;
			}
			var type=$(".choose-pay").find(".dd").attr("data-type");
			if(type==1){
				if(aliname==''){
					showTip("支付宝姓名不能为空");

					return;
				}
				if(alinumber==''){
					showTip("支付宝账号不能为空");

					return;
				}
			}else{
				if(bankname==''){
					showTip("开户银行不能为空");

					return;
				}
				if(banknumber==''){
					showTip("银行卡号不能为空");

					return;
				}
			}

			if(money==''){
				showTip("提现金额不能为空");

				return;
			}
			if(isNaN(money)){
				showTip("提现金额必须为整数数字");

				return;
			}
			if(parseInt(money)>parseInt($('#nowMoney').val())){
				showTip("提现金额超出可提现值");

				return;
			}
			if(parseInt(money)<50||parseInt(money)>50000){
				showTip("每次提现金额在50到5万之间");

				return;
			}
			var submitData = {
				name: name,
				tele: tele,
				money: money,
				bankname:bankname,
				banknumber:banknumber,				
				alinumber:alinumber,				
				aliname:aliname,
				paytype:type			
			};
			$.post("<?php echo U('Distribution/getMoney',array('token'=>$token,'wecha_id'=>$wecha_id,'type'=>$type));?>", submitData,
			function(bakcdata) {
				var obj = eval('(' + bakcdata + ')');

				if (obj.success == 1) {
					showTip(obj.info);
					setTimeout("window.location.href='<?php echo U('Distribution/getMoneyList',array('token'=>$token));?>'", 2000);

					return

				} else {

					showTip(obj.info);

					return

				}

			});

		});
	});
	function showTip(tipTxt) {
	  var div = document.createElement('div');
	  div.innerHTML = '<div class="deploy_ctype_tip"><p>' + tipTxt + '</p></div>';
	  var tipNode = div.firstChild;
	  $(".container").after(tipNode);
	  setTimeout(function () {
		$(tipNode).remove();
	  }, 1500);
	}
</script>
</body>
</html>