<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /><meta charset="utf-8" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta name="format-detection" content="telephone=no"/>
<title><?php echo ($metaTitle); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta name="format-detection" content="telephone=no" />
<script src="<?php echo RES;?>/css/store/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/jquery.lazyload.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/notification.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/swiper.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/store/js/main.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="<?php echo RES;?>/css/store/css/touch_index1.css">
<link type="text/css" rel="stylesheet" href="<?php echo RES;?>/css/store/css/style.css" />
<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
</head>
<link type="text/css" rel="stylesheet" href="<?php echo RES;?>/css/store/css/css.css" />
<body style="max-width: 640px; margin: 0 auto;">
<!-- <div style="width:100%;height:40px;line-height:40px;background:#fff;text-align:center;background-color:#5DD1F8"><span style="float:right;padding-right:10px;"><a href="<?php echo U('Store/index',array('token' => $_GET['token'], 'catid' => $hostlist['id'],'wecha_id'=>$wecha_id));?>"><img src="<?php echo RES;?>/css/store/css/img/home2.png"></a></span><span style="padding-left:10px;float:left"><a href="javascript:history.go(-1)"><img src="<?php echo RES;?>/css/store/css/img/return2.png" ></a></span><span style="font-size:16px;color:#fff"><?php echo (msubstr($metaTitle,0,10)); ?></span></div> -->
<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i; if(($hostlist['parentid']) == "0"): ?><div id="classify_title"><?php echo ($hostlist["name"]); ?></div>
<style>
   /* .class_all3{
        white-space: nowrap; 
        overflow-x:auto;
        overflow-y:hidden;
    }
    .class_lei_all{
        display: inline-block;
        white-space: normal;
        height: 85px;
    }*/
</style>
<div id="class_all2">
     <div class="class_all3">
          <div class="class_lei_all">
              <div class="class_lei_pic">
                  <a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $hostlist['id']));?>">
                      <img width="60" height="60" <?php if(($hostlist["logourl"]) == ""): ?>src="<?php echo ($company["logourl"]); ?>"
                      <?php else: ?>          
                      src="<?php echo ($hostlist["logourl"]); ?>"<?php endif; ?>
                  />
                  </a>
              </div>
              <div class="class_lei_name">
                  <a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $hostlist['id']));?>">全部<!-- <?php echo ($hostlist["name"]); ?> -->
                  </a>
              </div>
          </div>
          <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo['parentid']) == $hostlist['id']): ?><div class="class_lei_all">
                   <div class="class_lei_pic"><a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $vo['id']));?>"><img width="60" height="60" <?php if(($vo["logourl"]) == ""): ?>src="<?php echo ($company["logourl"]); ?>"<?php else: ?>src="<?php echo ($vo["logourl"]); ?>"<?php endif; ?> /></a></div>
                  <div class="class_lei_name"><a href="<?php echo U('Store/products',array('token' => $_GET['token'], 'catid' => $vo['id']));?>"><?php echo ($vo["name"]); ?></a></div>
              </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
     </div>
</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
<style>
    .foot_er{
        max-width: 640px;
    }
</style>
<!--foot开始-->
<div style="height: 60px;"></div>
<div class="public_foot">
    <div class="weui-row weui-no-gutter">
      <div class="weui-col-25">
        <a href="<?php echo U('Store/index');?>">
          <p class="iconfont">&#xe60d;</p>
          <p>首页</p>
        </a>
      </div>
      <div class="weui-col-25">
        <a href="<?php echo U('Store/cats');?>">
          <p class="iconfont">&#xe60c;</p>
          <p>分类</p>
        </a>
      </div>
      <div class="weui-col-25">
        <a href="<?php echo U('Store/cart');?>">
          <p class="iconfont">&#xe60e;</p>
          <p>购物车</p>
        </a>
      </div>
      <div class="weui-col-25">
        <a href="<?php echo U('Distribution/index');?>">
          <p class="iconfont">&#xe6ca;</p>
          <p>我的</p>
        </a>
      </div>
    </div>
</div>

<script>
    (function($){
      var module = "<?php echo MODULE_NAME;?>";
      var action = "<?php echo ACTION_NAME;?>";
      var rule_wrap = $(".rule");
      if(module == "Store" && action == "daily"){
        $('.daily').addClass('choose');
      }
      if(module == "Store" && action == "cats"){
        $('.cats').addClass('choose');
      }
      if(module == "Store" && action == "index"){
        $('.Sindex').addClass('choose');
      }
      if(module == "Distribution" && action == "index"){
        $('.Dindex').addClass('choose');
      }
    })(jQuery)
  </script>
<!--foot结束-->

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
  <div class="clear"></div>
    <?php if((ACTION_NAME) != "herolist"): ?><section class="foot"></section><?php endif; ?>
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
            "moduleName":"Store",
            "moduleID":"<?php echo ($res['id']); ?>",
            "imgUrl": "<?php echo ($res['pic']); ?>", 
            "timeLineLink": "<?php echo C('site_url') . U('Store/cats',array('token' => $_GET['token'],'mid'=>$my['id'],'aid'=>$account['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/cats',array('token' => $_GET['token'],'mid'=>$my['id'],'aid'=>$account['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/cats',array('token' => $_GET['token'],'mid'=>$my['id'],'aid'=>$account['id']));?>",
            "tTitle": "<?php echo ($title); ?>",
            "tContent": "<?php echo ($res["text"]); ?>"
        };
</script>
<?php echo ($shareScript); ?>
</html>