<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>用户中心-我的推广二维码</title>
<meta charset="utf-8" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width" />
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
input{text-align:center}
</style>
</head>
<body style="overflow:hidden">

<div data-role="page" id="pageone">
  <div data-role="content" data-theme="e">
   <div style="margin:10px auto;width:100%;text-align:center;height:60px;"><img src="<?php echo ($my['headimgurl']); ?>" style="width:60px;vertical-align:middle;float:left;display:block;padding-left:10%"><span style="line-height:30px;padding-left:10px;font-weight:bold;display:block;float:left;text-align:left;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">我是&nbsp&nbsp<font style="color:red"><?php echo (msubstr($my['nickname'],0,8)); ?></font><br/>我为玩赚商城代言</span>
   </div>
   <div style="text-align:center;margin-top:10px;"><img src="<?php echo RES;?>/distri/images/bjj.png" style="height:120px;width:80%"></div>
   <div style="text-align:center;background:url(<?php echo RES;?>/distri/images/scannerBg1.jpg);width:100%;min-height:355px;">
		<div data-role="fieldcontain">
			<div><img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=<?php echo ($code_url); ?>" width="50%"></div>
			<div style="height:30px;line-height:30px;color:#fff">长按此图 识别图中二维码 搞定！</div>
			<div style="height:30px;line-height:30px;color:#D3056A;font-weight:bold">F2C模式：厂家一手货源（物超所值的产品）直接到消费者手中</div>
		</div>
   </div>
  </div>
</div> 
<script type="text/javascript">
function onBridgeReady(){
 WeixinJSBridge.call('showOptionMenu');
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
window.shareData = {  
	"moduleName":"Distribution",
	"moduleID": 0,
	"lid": 0,
	"mid": "<?php echo ($my["id"]); ?>",
	"imgUrl": "<?php echo ($res["pic"]); ?>", 
	"sendFriendLink": "<?php echo C('site_url'); echo U('Distribution/forward',array('token'=>$_GET['token'],'mid'=>$my['id']));?>",
	"tTitle": "<?php echo ($res["title"]); ?>",
	"tContent": "<?php echo ($res["text"]); ?>",
};
</script>
<?php echo ($shareScript); ?>
</body>
</html>