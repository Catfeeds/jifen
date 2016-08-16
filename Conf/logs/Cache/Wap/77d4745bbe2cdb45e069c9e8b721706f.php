<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<title><?php echo ($company["name"]); ?></title>
<link href="<?php echo RES;?>/css/store/css/main.css" rel="stylesheet" type="text/css" />
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
  <li>
    <a href="<?php echo U('Store/products',array('token'=>$_GET['token']));?>">
        <div style="width:45px;margin:0 auto"><i class="iconfont">&#xe616;</i></div>
          <p>全部商品</p>
      </a>
  </li>
  <li>
    <a href="<?php echo U('Store/cats',array('token'=>$_GET['token']));?>">
        <div style="width:45px;margin:0 auto"><i class="iconfont">&#xe615;</i></div>
          <p>商品分类</p>
      </a>
  </li>
  <li>
    <a href="<?php echo U('Store/my',array('token'=>$_GET['token']));?>">
        <div style="width:45px;margin:0 auto"><i class="iconfont">&#xe617;</i></div>
          <p>我的订单</p>
      </a>
  </li>
  <li>
    <a href="<?php echo U('Store/cart',array('token'=>$_GET['token']));?>">
        <div style="width:45px;margin:0 auto"><i class="iconfont">&#xe60e;</i></div>
          <p>购物车</p>
      </a>
  </li>
  <li>
    <a href="<?php echo U('Distribution/index',array('token'=>$_GET['token']));?>">
        <div style="width:45px;margin:0 auto"><i class="iconfont">&#xe6ca;</i></div>
          <p>个人中心</p>
      </a>
  </li>
</div>
<?php if(is_array($guanggao)): $i = 0; $__LIST__ = $guanggao;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="ad" style="margin-top: 0;">
    <a href="<?php echo ($list["url"]); ?>">
      <img src="<?php echo ($list["picurl"]); ?>" />
    </a>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- <div id="item">
     <div class="item_all">
          <div class="item_icon">
               <div class="item_pic"><img src="<?php echo RES;?>/css/store/images/index_04.png" /></div>
               <div class="item_name">跨境专区</div>
          </div>
         <div class="item_icon">
              <div class="item_pic"><img src="<?php echo RES;?>/css/store/images/index_06.png" /></div>
              <div class="item_name">海外直销</div>
       </div>
          <div class="item_icon">
               <div class="item_pic"><img src="<?php echo RES;?>/css/store/images/index_09.png" /></div>
               <div class="item_name">闪电发货</div>
          </div>
          <div class="item_icon">
               <div class="item_pic"><img src="<?php echo RES;?>/css/store/images/index_10.png" /></div>
               <div class="item_name">满299包邮</div>
          </div>
          <div class="item_icon">
               <div class="item_pic"><img src="<?php echo RES;?>/css/store/images/index_12.png" /></div>
               <div class="item_name">正品保障</div>
          </div>
          <div class="clear"></div>
     </div>
</div> -->
<!-- <div id="theme">
    <div class="theme_all1">
          <div class="theme_title">
              <div class="theme_pic"></div>
              <div class="theme_name">主题馆</div>
              <div class="clear"></div>
          </div>
        <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list2): $mod = ($i % 2 );++$i; if(($list2['parentid']) == "0"): ?><div class="theme_all">
                <a href="<?php echo U('Store/products',array('token' => $token,'catid' => $list2['id']));?>">
                 <div class="theme_img"><img src="<?php echo ($list2["logourl"]); ?>" /></div>
                 <div class="theme_all_name">
                      <div class="theme_all_name1"><?php echo ($list2["name"]); ?></div>
                 </div>
                </a>
            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div> -->
<?php if(!empty($fproducts)): ?><div id="new">
       <div class="new_all">
            <div class="new_title">
          <span style="float:right;padding-right:15px;"><a href="<?php echo U('Store/products');?>" style="color:#666666;line-height:25px;">更多</a></span>
                 <div class="new_pic"></div>
                 <div class="new_name">主打商品</div>
                 <div class="clear"></div>
          </div>
        <?php if(is_array($fproducts)): $i = 0; $__LIST__ = $fproducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist2): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Store/product',array('token' => $token, 'id' => $hostlist2['id']));?>">
        <div class="new_pro">
           <div class="new_pro_pic"><img src="<?php echo ($hostlist2["logourl"]); ?>" /></div>
           <div class="new_pro_all">
              <div class="new_pro_name"><?php echo ($hostlist2["name"]); ?></div>
              <!-- <div class="new_pro_details"><?php echo ($hostlist2["des"]); ?></div> -->
              <div class="new_cart">
                 <div class="new_price">￥<?php echo ($hostlist2["showprice"]); ?></div>
                 <div class="new_sales">销量：<?php echo ($hostlist2["fakemembercount"]); ?></div>
                 <!-- <div class="new_cart_pic"><img src="<?php echo RES;?>/css/store/images/index_28.png" /></div> -->
                 <div class="clear"></div>
              </div>
           </div>
        </div>
        </a><?php endforeach; endif; else: echo "" ;endif; ?>
      </div> 
  </div><?php endif; ?>
<?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i; if(($list['parentid']) == "0"): ?><!-- <div id="theme">
    <div class="theme_all1">
          <div class="theme_title">
              <div class="theme_pic"></div>
              <div class="theme_name"><?php echo ($list["name"]); ?></div>
              <div class="clear"></div>
          </div>
        <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list2): $mod = ($i % 2 );++$i; if(($list2['parentid']) == $list["id"]): ?><div class="theme_all">
                <a href="<?php echo U('Store/products',array('token' => $token, 'wecha_id'=>$wecha_id,'catid' => $list2['id']));?>">
                 <div class="theme_img"><img src="<?php echo ($list2["logourl"]); ?>" /></div>
                 <div class="theme_all_name">
                      <div class="theme_all_name1"><?php echo ($list2["name"]); ?></div>
                      <div class="theme_all_name2"><?php echo ($list2["des"]); ?></div>
                 </div>
                </a>
            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div> -->
<div id="new">
     <div class="new_all">
          <div class="new_title">
				<span style="float:right;padding-right:15px;"><a href="<?php echo U('Store/products',array('token' => $token, 'catid' => $list['id']));?>" style="color:#666666;line-height:25px;">更多</a></span>
               <div class="new_pic"></div>
               <div class="new_name"><?php echo ($list["name"]); ?></div>
               <div class="clear"></div>
        </div>
		  <?php if(is_array($list['products'])): $i = 0; $__LIST__ = $list['products'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist2): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Store/product',array('token' => $token, 'id' => $hostlist2['id']));?>">
			<div class="new_pro">
				 <div class="new_pro_pic"><img src="<?php echo ($hostlist2["logourl"]); ?>" /></div>
				 <div class="new_pro_all">
					  <div class="new_pro_name"><?php echo ($hostlist2["name"]); ?></div>
					  <!-- <div class="new_pro_details"><?php echo ($hostlist2["des"]); ?></div> -->
					  <div class="new_cart">
						   <div class="new_price">￥<?php echo ($hostlist2["showprice"]); ?></div>
						   <div class="new_sales">销量：<?php echo ($hostlist2["fakemembercount"]); ?></div>
						   <!-- <div class="new_cart_pic"><img src="<?php echo RES;?>/css/store/images/index_28.png" /></div> -->
						   <div class="clear"></div>
					  </div>
				 </div>
			</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div> 
</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

<div id="product">
     <div class="pro_main">
          <!-- <?php if(is_array($cats)): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cats): $mod = ($i % 2 );++$i; if(is_array($cats['products'])): $i = 0; $__LIST__ = $cats['products'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><div class="pro_all">
                    <a href="<?php echo U('Store/product',array('token' => $token, 'id' => $hostlist['id']));?>">
                     <div class="pro_pic"><img src="<?php echo ($hostlist["logourl"]); ?>" /></div>
                     <div class="line"></div>
                     <div class="pro_name"><?php echo (msubstr($hostlist["name"],0,15)); ?></div>
                     <div class="line1"></div>
                     <div class="pro_price">现价:￥<?php echo ($hostlist["price"]); ?> &nbsp;&nbsp; <span>已售:<?php echo ($hostlist["fakemembercount"]); ?></span></div>
                    </a>
                </div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?> -->
          <?php if(is_array($bproducts)): $i = 0; $__LIST__ = $bproducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><div class="pro_all">
                <a href="<?php echo U('Store/product',array('token' => $token, 'id' => $hostlist['id']));?>">
                 <div class="pro_pic"><img src="<?php echo ($hostlist["logourl"]); ?>" /></div>
                 <div class="line"></div>
                 <div class="pro_name"><?php echo (msubstr($hostlist["name"],0,11)); ?></div>
                 <div class="line1"></div>
                 <div class="pro_price">现价:￥<?php echo ($hostlist["showprice"]); ?> &nbsp;&nbsp; <span>已售:<?php echo ($hostlist["fakemembercount"]); ?></span></div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
     </div>
</div>

  <div class="clear"></div>
    <div class="copy" style="text-align:center;line-height:20px;font-size:12px;">技术支持：微广互动</div>
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
            "timeLineLink": "<?php echo C('site_url') . U('Store/index',array('token' => $token,'mid'=>$my['id'],'aid'=>$account['id']));?>",
            "sendFriendLink": "<?php echo C('site_url') . U('Store/index',array('token' => $token,'mid'=>$my['id'],'aid'=>$account['id']));?>",
            "weiboLink": "<?php echo C('site_url') . U('Store/products',array('token' => $token,'mid'=>$my['id'],'aid'=>$account['id']));?>",
            "tTitle": "<?php echo ($company["name"]); ?>",
            "tContent": "<?php echo ($res["text"]); ?>"
        };
</script>
<?php echo ($shareScript); ?>

</body>
</html>