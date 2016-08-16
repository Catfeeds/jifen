<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>我的推广-点击链接列表</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo RES;?>/distri/css/jquery.mobile-1.3.2.min.css">
<script src="<?php echo RES;?>/distri/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo RES;?>/distri/js/jquery.mobile-1.3.2.min.js"></script>
<style>
.ui-content{padding:0}
.ui-btn{text-align:left}
.header{display:-webkit-box;-webkit-box-align:center;}
.header img{width:25%;display:block}
.header div{padding-left:5%;font-size:16px;line-height:30px;font-weight:bold}
.middleShow{display:-webkit-box;text-align:center;height:50px;line-height:50px;color:#fff;}
.middleShow span{display:block;background:url(http://www.xiaomiguzi.com/bg2014.jpg) repeat;width:50%;}
.middleShow span.leftInfo{border-right:1px #fff solid;border-top:1px #fff solid}
.middleShow span.rightInfo{border-top:1px #fff solid}
</style>
</head>
<body >

<div data-role="page" id="pageone" style="background:#fff4a7">
  <div data-role="content" data-theme="e">
   <div style="padding:10px 20px;">
		<?php if(is_array($click)): $i = 0; $__LIST__ = $click;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#" rel="external" data-role="button" data-icon="star" data-iconpos="right"><div class="header"><img <?php if(($vo["headimgurl"]) == ""): ?>src="<?php echo RES;?>/distri/images/portrait.jpg"<?php else: ?>src="<?php echo ($vo["headimgurl"]); ?>"<?php endif; ?>><div><span>昵称：<?php if(($vo["headimgurl"]) == ""): ?>未获取<?php else: echo ($vo["nickname"]); endif; ?></span><br/><span>点击时间：<?php echo (date('Y-m-d',$vo["updatetime"])); ?></span></div></div></a><?php endforeach; endif; else: echo "" ;endif; ?>
   </div>
  </div>
  
</div> 
<script>
function onBridgeReady(){
 WeixinJSBridge.call('hideOptionMenu');
}

if (typeof WeixinJSBridge == "undefined"){
    if( document.addEventListener ){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }
}else{
    onBridgeReady();
}
</script>
</body>
</html>