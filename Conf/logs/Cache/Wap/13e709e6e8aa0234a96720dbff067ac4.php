<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>会员注册</title>
<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">

<script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>

<style>
*::-webkit-input-placeholder { 
color: #fefefe; 
} 
*:-moz-placeholder { 
color: #fefefe; 
} 
*:-ms-input-placeholder { 
/* IE10+ */ 
color: #fefefe; 
} 
</style>
</head>

<body id="scnhtm5">
    <div class="container">
    <div class="clear"></div>
    
    <div class="login_content">
        <div class="bg">
            <img src="<?php echo RES;?>/original/images/bg1.jpg" class="img"></div>
        <div class="xx">
            <div class="top">
                <div class="tx">
                    <img src="<?php echo ($company["logourl"]); ?>" class="img1"></div>
                <!--tx--> </div>
            <form id="form1" name="form1" method="post" action="#">
                <div class="text"> <i class="icon1 iconfont">&#xe6ca;</i>
                    <input name="username" id="username" type="text" class="name" value="" placeholder="微信号"/>    
                </div>
                <div class="text"> <i class="icon1 iconfont">&#xe61a;</i>
                    <input name="nickname" id="nickname" type="text" class="name" value="" placeholder="真实姓名"/>    
                </div>
                <div class="text"> <i class="icon1 iconfont">&#xe619;</i>
                    <input name="tele" id="tele" type="text" class="name" value="" placeholder="手机号"/>    
                </div>
                <div class="text"> <i class="icon1 iconfont">&#xe618;</i>
                    <input name="password" id="password" type="password" class="name" value="" placeholder="密码"/>    
                </div>
                <div class="text"> <i class="icon1 iconfont">&#xe618;</i>
                    <input name="repassword" id="repassword" type="password" class="name" value="" placeholder="重复密码"/>    
                </div>
				<input name="wecha_id" id="wecha_id" type="hidden" value="<?php echo ($wecha_id); ?>"/>    
            </form>
                <!--text-->    
                <div class="clear"></div>
                <div class="text1">
                    <input type="button" class="tj" id="form-submit" value="立即注册"/>    
                </div>
            <!--text1--> </div>
        <!--xx--> </div>
    <!--content-->    
    
    <script>
        (function($){
            var submit_btn=$("#form-submit");
            submit_btn.on("click",function(){
                var password=$("#password").val();
                var repassword=$("#repassword").val();
                var username=$("#username").val();
                var tele=$("#tele").val();
                var nickname=$("#nickname").val();
				var wecha_id = $("#wecha_id").val();
				if (wecha_id == ''){
                    return floatNotify.simple('异常访问');
                    return false;
                }
                if(username==""){
                    return floatNotify.simple('请输入微信名');
                    return false;
                }
                if(nickname==""){
                    return floatNotify.simple('请输入真实姓名');
                    return false;
                }
                if(tele==""){
                    return floatNotify.simple('请输入手机号');
                    return false;
                }
                if(password==""){
                    return floatNotify.simple('请输入密码');
                    return false;
                }
                var reg = /^[A-Za-z0-9]{6,16}$/;
                if(reg.test(password) == false){
                    return floatNotify.simple('密码必须由6-16位字母、数字组成');
                }
                if(password != repassword){
                    return floatNotify.simple('两次密码不相同');
                    return false;
                }

                confirm =floatNotify.confirm("微信号很重要,确定该微信号为您的真实微信号吗？", "",
                    function(t, n) {
                        if(n==true){
                            $('#form1').submit();
                        }
                    this.hide();
                  }),
                confirm.show();
                // $.ajax({
                //     url:"<?php echo U('Distribution/register',array('token'=>$_GET['token'],'wecha_id'=>$wecha_id));?>",
                //     data:{password:password,name:name},
                //     type:"post",
                //     dataType:"json",
                //     success:function(data){
                //         console.log(data);
                //         if(data.status==1){
                //             location.href="<?php echo U('Distribution/index',array('token'=>$_GET['token'],'wecha_id'=>$wecha_id));?>";
                //         }else{
                //             floatNotify.simple(data.info);
                //         }
                //     }
                // });
            })
        })(jQuery)
    </script>
     
    
    


</div>
</body>
</html>