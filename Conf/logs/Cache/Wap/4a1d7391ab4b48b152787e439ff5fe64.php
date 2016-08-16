<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo RES;?>/original/qrcode/css/qrcode.css">
    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <title>我的二维码</title>
</head>
<body>
    <div class="container">
        <img src="<?php echo RES;?>/original/qrcode/img/qrcodebg.jpg" alt="" class="qrcode_bg">
        <div class="qrcode_wrap">
            <div class="qrcode_top">
                <img src="<?php echo RES;?>/original/qrcode/img/qrcode_top.png" alt=""></div>
            <div class="account_info">
                <div class="account_info_left">
                    <img src="<?php echo ($account["headimgurl"]); ?>" alt=""></div>
                <div class="account_info_right">
                    <p>我是<?php echo ($account["petname"]); ?></p>
                    <p>
                        <img src="<?php echo RES;?>/original/qrcode/img/word1.png" alt=""></p>
                </div>
                <div class="clear"></div>
            </div>
            <p class='qrcode_word_item'>[长按图片识别二维码添加]</p>
            <div class="qrcode_img">
                <img src="<?php echo ($account["wxcode"]); ?>" alt=""></div>
        </div>
    </div>
</body>
    <script>
    (function($){
        img_h = $('.account_info_left').width();
        $('.account_info_left img').height(img_h);
    })($)
</script>
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