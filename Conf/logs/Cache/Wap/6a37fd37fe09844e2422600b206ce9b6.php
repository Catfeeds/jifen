<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/agent.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>
	<title>登陆我的分店</title>
</head>
<body id="scnhtm5">
	<div class="agent_blur">
		
	</div>
	<div class="agent_wrap">
		<div class="agent_content">
			<div class="agent_header">
				<div class="agent_title">
					咪咪兔商城代理登陆
				</div>
				<div class="agent_logo">
					<img src="<?php echo RES;?>/original/images/mmtlogo.jpg">
				</div>
			</div>
			<form action="#" method="post" id="agent_form">
				<p class="agent_input_item agent_username iconfont">
					<input name="username" id="username" type="text" placeholder="账号:">
				</p>
				<p class="agent_input_item agent_password iconfont">
					<input name="password" id="password" type="text" placeholder="密码:">
				</p>
				<p class="agent_checkbox_item">
	                <input type="hidden" name="nologin" id="nologin" />
					<input  type="checkbox" id="nologin_30"/>
					&nbsp;&nbsp;
					<label for="nologin_30" style="color: #ddd;">30天免登陆</label>
				</p>
				<p class="agent_submit_item">
					<input type="button" id="form-submit" value="登陆">
				</p>
			</form>
		</div>
	</div>
</body>
</html>
    <script>
    (function($){
        //30天免登陆
        $('#nologin_30').on('click',function(){
            if($(this).is(":checked")){
                $('#nologin').val(1);
            }else{
                $('#nologin').val(0);
            }
        })
        //登陆操作
        var submit_btn=$("#form-submit");
        submit_btn.on("click",function(){
            var password=$("#password").val();
            var name=$("#username").val();
            if(name==""){
                return floatNotify.simple('请输入账号');
                return false;
            }
            if(password==""){
                return floatNotify.simple('请输入密码');
                return false;
            }
            $('#agent_form').submit();
        })
    })(jQuery)
</script>