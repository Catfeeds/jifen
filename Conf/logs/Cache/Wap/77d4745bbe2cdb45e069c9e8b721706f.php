<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<title><?php echo ($company["name"]); ?></title>
<link href="<?php echo RES;?>/css/store/css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
<link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
<link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
<script type="text/javascript" src="<?php echo RES;?>/css/store/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/css/store/js/jquery.lazyload.js"></script> 
<script type="text/javascript"> 
jQuery(document).ready(function ($) { 
 $("img").lazyload({
  placeholder : "<?php echo RES;?>/css/store/images/grey.gif",
  effect : "fadeIn" 
 }); 
}); 
</script>
</head>

<body>
<!-- <div id="per_pic"><img src="<?php echo ($my["headimgurl"]); ?>" /></div> -->

<!--banner-->

    <div class="slider">
      <ul class="warp" id="fd">
        <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="li"><a <?php if(($vo["url"]) == ""): ?>href="javascript:;"<?php else: ?>href="<?php echo ($vo["url"]); ?>"<?php endif; ?>><img src="<?php echo ($vo["picurl"]); ?>" style="height:335px;width:100%"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  <script type="text/javascript" src="<?php echo RES;?>/css/store/js/yxMobileSlider.js"></script>
  <script>
    var imgh=0;
    $(".slider ul li").each(function(){
        imgh=$(this).find("img").height()>imgh?$(this).find("img").height():imgh;
    });
    $(".slider ul li").each(function(){
        $(this).find("img").height(imgh);
    });
    $(".slider").yxMobileSlider({width:640,height:320,during:3000})
  </script>
<!--banner-->


<div class="clear"></div>
<div class="index_nav">
  
</div>

  <style type="text/css">
     .index_news_all{
      background: #fff;
     }
     .index_left_img{
      width: 40px;
      height: 40px;
      background:#fb2d9a; 
      border-radius: 50%;
     }
     .index_left_img p{
      width: 100%;
      text-align: center;
      font-size: 25px;
      line-height: 42px;
      color: #fff;  
     }

     .index_middle_all{
      margin-left: 10px;
     }
     .index_middle_all_title{
      font-size: 24px;
      color: #000;
     }
     .index_middle_all_details{
      font-size: 16px;
      color: #000;
     }
     .index_right_all_title{
      background:#fb2d9a;
      width: 70px;
      height: 70px;
      margin-right: 0;
      color: #fff;
     }
  </style>
  <a href="<?php echo U('Store/article');?>">
  <div class="weui_cells index_news_all" style="margin-top: 0;">
        <div class="weui_cell" style="padding-right:0px;">
          <div class="weui_cell_hd index_left_img">
            <p class="iconfont">&#xe61a;</p>
          </div>
          <div class="weui_cell_bd weui_cell_primary index_middle_all">
            <p class="index_middle_all_title">新闻中心</p>
            <p class="index_middle_all_details">咪咪兔最新讯息公告</p>
          </div>
          <!-- <div class="weui_cell_ft index_right_all" style="padding-right:0px;">
             <p class="index_right_all_img"></p>
             <p class="index_right_all_title">说明文字</p>
          </div> -->
        </div>
      </div>
    </div>
  </a>
  <div class="index_cat_class">
  <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="weui_cells" style="width: 33.33333333333333%;float: left;margin-top: 5px; padding: 4px;">
    <a href="<?php echo U('Store/products',array('catid' => $list['id']));?>">
          <div class="weui_cell" style="padding: 0;">
            <div class="weui_cell_hd"><img src="<?php echo ($list["logourl"]); ?>" alt="" style="width:40px; height: 40px;margin-right:5px;display:block"></div>
            <div class="weui_cell_bd weui_cell_primary">
              <p style="color: #fff;"><?php echo ($list["name"]); ?></p>
            </div>
          </div>
    </a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <?php if(is_array($guanggao)): $i = 0; $__LIST__ = $guanggao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="ad" style="margin-top: 10px;">
    <a href="<?php echo ($list["url"]); ?>">
      <img src="<?php echo ($list["picurl"]); ?>" />
    </a>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list['parentid']) == "0"): ?><div id="product">
     <div class="pro_main new_all">
          <div class="new_title">
				<span style="float:right;padding-right:15px;"><a href="<?php echo U('Store/products',array('token' => $token, 'catid' => $list['id']));?>" style="color:#666666;line-height:25px;">更多</a></span>
               <div class="new_pic"></div>
               <div class="new_name"><?php echo ($list["name"]); ?></div>
               <div class="clear"></div>
        </div>
		  <?php if(is_array($bproducts)): $i = 0; $__LIST__ = $bproducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><div class="pro_all">
                <a href="<?php echo U('Store/product',array('id' => $hostlist['id']));?>">
                 <div class="pro_pic"><img src="<?php echo ($hostlist["logourl"]); ?>" /></div>
                 <div class="line"></div>
                 <div class="pro_name"><?php echo (msubstr($hostlist["name"],0,11)); ?></div>
                 <div class="line1"></div>
                 <div class="pro_price">现价:￥<?php echo ($hostlist["price"]); ?> &nbsp;&nbsp; <span>已售:<?php echo ($hostlist["fakemembercount"]); ?></span></div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div> 
</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

<div id="product">
     <div class="pro_main">
          <?php if(is_array($bproducts)): $i = 0; $__LIST__ = $bproducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><div class="pro_all">
                <a href="<?php echo U('Store/product',array('id' => $hostlist['id']));?>">
                 <div class="pro_pic"><img src="<?php echo ($hostlist["logourl"]); ?>" /></div>
                 <div class="line"></div>
                 <div class="pro_name"><?php echo (msubstr($hostlist["name"],0,11)); ?></div>
                 <div class="line1"></div>
                 <div class="pro_price">现价:￥<?php echo ($hostlist["price"]); ?> &nbsp;&nbsp; <span>已售:<?php echo ($hostlist["fakemembercount"]); ?></span></div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
     </div>
</div>

  <!-- <div class="clear"></div>
    <div class="copy" style="text-align:center;line-height:20px;font-size:12px;">技术支持：微广互动</div> -->
<!--foot开始-->
<div style="height: 60px;"></div>
<div class="public_foot">
  <div class="weui-row weui-no-gutter">
    <div class="weui-col-25">
      <a href="<?php echo U('Store/index');?>" class="public_footer_index">
        <p class="iconfont">&#xe60d;</p>
        <p>首页</p>
      </a>
    </div>
    <div class="weui-col-25">
      <a href="<?php echo U('Store/cats');?>" class="public_footer_products">
        <p class="iconfont">&#xe60c;</p>
        <p>分类</p>
      </a>
    </div>
    <div class="weui-col-25">
      <a href="<?php echo U('Store/cart');?>" class="public_footer_shopcat">
        <p class="iconfont">&#xe60e;</p>
        <p>购物车</p>
      </a>
    </div>
    <div class="weui-col-25">
      <a href="<?php echo U('Distribution/index');?>" class="public_my">
        <p class="iconfont">&#xe6ca;</p>
        <p>我的</p>
      </a>
    </div>
</div>

<script>
    var module = "<?php echo MODULE_NAME;?>";
      var action = "<?php echo ACTION_NAME;?>";
      if(module == "Store" && action == "index"){
        $('.public_footer_index').addClass('public_footer_choose');
      }
      if(module == "Store" && action == "cats"){
        $('.public_footer_products').addClass('public_footer_choose');
      }
      if(module == "Store" && action == "cart"){
        $('.public_footer_shopcat').addClass('public_footer_choose');
      }
      if(module == "Distribution" && action == "index"){
        $('.public_my').addClass('public_footer_choose');
      }
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


</div>
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
            "timeLineLink": "<?php echo C('site_url') . U('Store/index',array('mid'=>$my['id'],'aid'=>$account['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/index',array('mid'=>$my['id'],'aid'=>$account['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/products',array('mid'=>$my['id'],'aid'=>$account['id']));?>",
            "tTitle": "<?php echo ($company["name"]); ?>",
            "tContent": "<?php echo ($res["text"]); ?>"
        };
</script>
<?php echo ($shareScript); ?>

</body>
</html>