<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo RES;?>/jifen/css/qrcode.css">
    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <title>我的二维码</title>
</head>
<body style="background:#1c8d7c;" max-width="640px">
    <!-- <div class="index_left">
        <div class="index_left_title">
            <img src="<?php echo RES;?>/jifen/images/index_03.png"></div>
        <div class="index_left_bg">
            <div class="index_left_img">
                <img src="<?php echo RES;?>/jifen/images/index_09.png"></div>
            <div class="index_left_txt">推荐二维码:<?php echo ($account["recommend"]); ?></div>
        </div>
    </div> -->
    <div class="index_right">
        <div class="index_right_img">
            <img src="<?php echo ($account["headimgurl"]); ?>">
        </div>
        <!-- <div class="index_right_name"><?php echo ($account["member"]["nickname"]); ?></div> -->
        <div class="index_right_name">我的推荐码:<a href="javascript:;" style="color: #fff;font-size: 30px;"><?php echo ($account["recommend"]); ?></a></div>
    </div>
    <div class="index_all">
        <div class="index_people">
            <img src="<?php echo RES;?>/jifen/images/index_10.png"></div>
        <div class="index_erweima">
            <img src="<?php echo ($account["wxcode"]); ?>"></div>
    </div>
    <div class="index_details">[长按图片识别二维码添加]</div>
</body>
    <script>
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
</script>
    <script type="text/javascript">
window.shareData = {  
            "moduleName":"Distribution",
            "moduleID":"<?php echo ($res['id']); ?>",
            "imgUrl": "<?php echo ($account['headimgurl']); ?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Distribution/generateQrcode',array('token' => $_GET['token'],'aid'=>$account['id'],'mid'=>$my['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Distribution/generateQrcode',array('token' => $_GET['token'],'aid'=>$account['id'],'mid'=>$my['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Distribution/generateQrcode',array('token' => $_GET['token'],'aid'=>$account['id'],'mid'=>$my['id']));?>",
            "tTitle": "<?php echo ($res['title']); ?>",
            "tContent": "点击加入柒彩汇"
        };
</script>
    <?php echo ($shareScript); ?>
</html>