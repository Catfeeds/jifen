<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/bgmove.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.min.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css?time=<?php echo time();?>">
    <link rel="stylesheet" href="<?php echo RES;?>/jifen/css/style.css">

    <link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/others/main2.css">
    <script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
    <title><?php echo ($title); ?></title>
</head>
<body id="scnhtm5">
    <!-- 轮播背景 -->
    <!-- <div class="slideshow">
    <div class="movebg slideshow-image" style="background-image: url('<?php echo RES;?>/original/images/1.jpg');"></div>
    <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/2.jpg')"></div>
    <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/3.jpg')"></div>
    <div class="movebg" style="background-image: url('<?php echo RES;?>/original/images/4.jpg')"></div>
</div>
-->
<!-- 轮播背景 -->
<div class="content_wrap index_wrap">
    <a class="dis_head info_edit" href="<?php echo U('Distribution/mypic');?>">
        <img id="index_headimgurl" src="<?php echo ($account["headimgurl"]); ?>">
        <p id="index_nickname"><?php echo (($account["username"])?($account["username"]):"未填写"); ?></p>
        <?php if(($account["admin"]) != "1"): ?><p style="font-size: 15px;">
                推荐二维码:
                <label><?php echo ($account["recommend"]); ?></label>
            </p><?php endif; ?>
        <div class="clear"></div>
    </a>
    <div class="weui_cells weui_cells_extend weui_cells_access">
        <?php if(($account["admin"]) != "1"): if(($account["bartender"]) == "1"): ?><a class="weui_cell weui_cell_extend info_edit" href="<?php echo U('Distribution/myInfo');?>">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe601;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>我的资料</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                    <a class="weui_cell weui_cell_extend" href="javascript:;" onclick="if(window.confirm('确认退出？')){location.href='<?php echo U('Distribution/loginoutAjax');?>'}">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe61b;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>退出登陆</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                    <div class="weui_search_bar" id="search_bar">
                      <form class="weui_search_outer" action="#" method="post" id="bartender_account_select"> 
                        <div class="weui_search_inner">
                          <i class="weui_icon_search"></i>
                          <input name="username" type="search" class="weui_search_input" id="account_search_input" placeholder="搜索账号" required/>
                          <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                        </div>
                        <label for="account_search_input" class="weui_search_text" id="search_text" style="top: 4px;">
                          <i class="weui_icon_search"></i>
                          <span>搜索账号</span>
                        </label>
                      </form>
                      <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
                    </div>
                    <div class="weui_search_bar" id="search_bar">
                      <form class="weui_search_outer" action="#" method="post" id="bartender_agent_select"> 
                        <div class="weui_search_inner">
                          <i class="weui_icon_search"></i>
                          <input name="agentname" type="search" class="weui_search_input" id="agent_search_input" placeholder="搜索代理点" required/>
                          <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                        </div>
                        <label for="agent_search_input" class="weui_search_text" id="search_text" style="top: 4px;">
                          <i class="weui_icon_search"></i>
                          <span>搜索代理点</span>
                        </label>
                      </form>
                      <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
                    </div>
                    <script>
                         $('#account_search_input').keydown(function(event){
                             if(event.keyCode == 13){
                                $('#bartender_account_select').submit();
                             }
                         })
                         $('#agent_search_input').keydown(function(event){
                             if(event.keyCode == 13){
                                $('#bartender_agent_select').submit();
                             }
                         })
                    </script>
                    <div class="weui-row weui-row-extend weui-no-gutter">
                        <div class="weui-col-100">
                            <a href="javascript:;">
                                <p class="money_color1" style="color:red; font-size: 1.6rem;"><?php echo ($account['red']); ?></p>
                                <p style="color:red; font-size: 0.9rem;">转账咪豆</p>
                            </a>
                        </div>
                    </div>
                    <style>
                        .weui-row-extend2{
                            padding: 0;text-align: center;font-size: 20px;color: #4a8586;
                        }
                        .extend-green{
                            color: green;
                        }
                        .extend-red{
                            color: red;
                        }
                        .index_font_size{
                            font-size: 17px;
                        }
                    </style>
                    <!-- <div class="weui-row-extend weui-row-extend2" id="index_detail">明细∨</div> -->
                    <div id="index_show_details">
                        <div class="weui-row weui-row-extend weui-row-extend2 weui-no-gutter">
                            <div class="weui-col-25 cursor_ios extend-red index_font_size">红色咪豆</div>
                            <div class="weui-col-25 cursor_ios index_font_size">账号</div>
                            <div class="weui-col-25 cursor_ios index_font_size">代理点</div>
                            <div class="weui-col-25 cursor_ios index_font_size">时间</div>
                        </div>
                        <?php if(is_array($transfers)): $i = 0; $__LIST__ = $transfers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="weui-row weui-row-extend weui-row-extend2 weui-no-gutter" style="-ms-flex-align: center;-webkit-align-items: center; -webkit-box-align: center;align-items: center;">
                                <div class="weui-col-25 cursor_ios extend-red index_font_size">(<?php echo ($key+1); ?>)<?php echo (($list["red"])?($list["red"]):0); ?></div>
                                <div class="weui-col-25 cursor_ios index_font_size"><?php echo ($list["outaccount"]["username"]); ?></div>
                                <div class="weui-col-25 cursor_ios index_font_size"><?php echo ($list["fromagent"]["name"]); ?></div>
                                <div class="weui-col-25 cursor_ios index_font_size" <?php if(!empty($list["fromgid"])): ?>style="color: red;"<?php endif; ?>><?php echo (date("Y-m-d H:i:s",$list["addtime"])); ?></div>
                            </div>
                            <div style="background-color: #fff; font-size: 16px; margin-bottom: 8px;">
                                <?php if(!empty($list["fromgid"])): ?><a href="javascript:;" style="color: red;">(代理点转入)</a><?php endif; ?>

                                    <label <?php if(!empty($list["fromgid"])): ?>style="color: red;"<?php endif; ?>>备注：<?php echo ($list["remark"]); ?></label>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>                   
                    <?php else: ?>
                    <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Distribution/topUp');?>" style="background-color: #28b2f1; text-align: center;">
                        <!-- <div class="weui_cell_hd weui_cell_hd_extend iconfont2">&#xe999;</div> -->
                        <div class="weui_cell_bd weui_cell_primary">
                            <p style="font-size: 20px;color: #fff;height: 35px;line-height: 35px;">充值咪豆</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                    <div class="weui-row weui-row-extend weui-no-gutter">
                        <div class="weui-col-25">
                            <a href="<?php echo U('Distribution/earnDetails',array('type'=> 'green'));?>" class="coad_lnfo_bage">
                                <p class="money_color1" style="color:green; font-size: 1.6rem;"><?php echo sprintf('%.1f',$account['green']);?></p>
                                <p style="color:green; font-size: 0.9rem;">绿色咪豆</p>
                            </a>
                        </div>
                        <div class="weui-col-25">
                            <a href="<?php echo U('Distribution/earnDetails',array('type'=> 'black'));?>" class="coad_lnfo_bage">
                                <p class="money_color1" style="color:black; font-size: 1.6rem;"><?php echo sprintf('%.1f',$account['black']);?></p>
                                <p style="color:black; font-size: 0.9rem;">黑色咪豆</p>
                            </a>
                        </div>
                        <div class="weui-col-25">
                            <a href="<?php echo U('Distribution/getMoneyList');?>" class="coad_lnfo_bage">
                                <p class="money_color1" style="color:red; font-size: 1.6rem;"><?php echo sprintf('%.1f',$account_data['red2']);?></p>
                                <p style="color:red; font-size: 0.9rem;">公司补贴</p>
                            </a>
                        </div>
                        <div class="weui-col-25">
                            <a href="<?php echo U('Distribution/getMoneyList');?>" class="coad_lnfo_bage">
                                <p class="money_color1" style="color:red; font-size: 1.6rem;"><?php echo sprintf('%.1f',$account_data['red1']);?></p>
                                <p style="color:red; font-size: 0.9rem;">转账咪豆</p>
                            </a>
                        </div>
                    </div>
                    <style>
                                    .weui-row-extend2{
                                        padding: 0;text-align: center;font-size: 20px;color: #4a8586;
                                    }
                                    .extend-green{
                                        color: green;
                                    }
                                    .extend-red{
                                        color: red;
                                    }
                                    .index_font_size{
                                        font-size: 17px;
                                    }
                                </style>
                    <!-- <div class="weui-row-extend weui-row-extend2" id="index_detail">明细∨</div> -->
                    <div id="index_show_details">
                        <div class="weui-row weui-row-extend weui-row-extend2 weui-no-gutter">
                            <div class="weui-col-33 cursor_ios extend-green index_font_size">绿色咪豆</div>
                            <div class="weui-col-33 cursor_ios index_font_size">黑色咪豆</div>
                            <div class="weui-col-33 cursor_ios index_font_size">时间</div>
                        </div>
                        <?php if(is_array($lolist)): $i = 0; $__LIST__ = $lolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="weui-row weui-row-extend weui-row-extend2 weui-no-gutter" style="-ms-flex-align: center;-webkit-align-items: center; -webkit-box-align: center;align-items: center;">
                                <div class="weui-col-33 cursor_ios extend-green index_font_size"><?php echo (($list["green"])?($list["green"]):0); ?>(<?php echo (($list["distribution"])?($list["distribution"]):0); ?>)</div>
                                <div class="weui-col-33 cursor_ios index_font_size"><?php echo (($list["black"])?($list["black"]):0); ?></div>
                                <div class="weui-col-33 cursor_ios index_font_size"><?php echo (date("Y-m-d H:i:s",$list["addtime"])); ?></div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <script>
                                    (function($){
                                        $('#index_detail').click(function(){
                                            $('#index_show_details').slideToggle();
                                        })
                                    })($)
                                </script>
                    <a class="weui_cell weui_cell_extend coad_lnfo_bage cursor_ios" href="<?php echo U('Store/my');?>">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe603;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>我的订单</p>
                        </div>
                        <div class="weui_cell_ft weui_cell_ft_extend">查看全部订单</div>
                    </a>
                    <div class="weui-row weui-row-extend weui-no-gutter">
                        <div class="weui-col-25 cursor_ios">
                            <a href="<?php echo U('Store/my',array('status'=> 0));?>" class="coad_lnfo_bage">
                                <?php if(!empty($cart_data["unpaid"])): ?><span><?php echo ($cart_data["unpaid"]); ?></span><?php endif; ?>
                                <p class="iconfont">&#xe606;</p>
                                <p>待付款</p>
                            </a>
                        </div>
                        <div class="weui-col-25 cursor_ios">
                            <a href="<?php echo U('Store/my',array('status'=> 1));?>" class="coad_lnfo_bage">
                                <?php if(!empty($cart_data["unsent"])): ?><span><?php echo ($cart_data["unsent"]); ?></span><?php endif; ?>
                                <p class="iconfont">&#xe605;</p>
                                <p>待发货</p>
                            </a>
                        </div>
                        <div class="weui-col-25 cursor_ios">
                            <a href="<?php echo U('Store/my',array('status'=> 2));?>" class="coad_lnfo_bage">
                                <?php if(!empty($cart_data["unreceive"])): ?><span><?php echo ($cart_data["unreceive"]); ?></span><?php endif; ?>
                                <p class="iconfont">&#xe604;</p>
                                <p>待收货</p>
                            </a>
                        </div>
                        <div class="weui-col-25 cursor_ios">
                            <a href="<?php echo U('Store/my',array('status'=> 3));?>" class="coad_lnfo_bage">
                                <?php if(!empty($cart_data["finished"])): ?><span><?php echo ($cart_data["finished"]); ?></span><?php endif; ?>
                                <p class="iconfont">&#xe608;</p>
                                <p>已完成</p>
                            </a>
                        </div>
                    </div>
                    <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Distribution/ChooseTeam');?>">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe600;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>团队管理</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                    <a class="weui_cell weui_cell_extend coad_lnfo_bage" href="<?php echo U('Distribution/collection');?>" id="my_collection">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe602;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>我的收藏</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                    <a class="weui_cell weui_cell_extend info_edit" href="<?php echo U('Distribution/myInfo');?>">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe601;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>我的资料</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                    <a class="weui_cell weui_cell_extend" href="<?php echo U('Distribution/generateQrcode');?>">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe607;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>推广二维码</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>

                    <a class="weui_cell weui_cell_extend" href="<?php echo U('Distribution/myAddress');?>" id="address_list_btn">
                        <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe609;</div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>地址列表</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a><?php endif; ?>
            <?php else: ?>
            <a class="weui_cell weui_cell_extend coad_lnfo_bage cursor_ios" href="<?php echo U('Store/my');?>">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe603;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>我的订单</p>
                </div>
                <div class="weui_cell_ft weui_cell_ft_extend">查看全部订单</div>
            </a>
            <div class="weui-row weui-row-extend weui-no-gutter">
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 0));?>" class="coad_lnfo_bage">
                        <?php if(!empty($cart_data["unpaid"])): ?><span><?php echo ($cart_data["unpaid"]); ?></span><?php endif; ?>
                        <p class="iconfont">&#xe606;</p>
                        <p>待付款</p>
                    </a>
                </div>
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 1));?>" class="coad_lnfo_bage">
                        <?php if(!empty($cart_data["unsent"])): ?><span><?php echo ($cart_data["unsent"]); ?></span><?php endif; ?>
                        <p class="iconfont">&#xe605;</p>
                        <p>待发货</p>
                    </a>
                </div>
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 2));?>" class="coad_lnfo_bage">
                        <?php if(!empty($cart_data["unreceive"])): ?><span><?php echo ($cart_data["unreceive"]); ?></span><?php endif; ?>
                        <p class="iconfont">&#xe604;</p>
                        <p>待收货</p>
                    </a>
                </div>
                <div class="weui-col-25 cursor_ios">
                    <a href="<?php echo U('Store/my',array('status'=> 3));?>" class="coad_lnfo_bage">
                        <?php if(!empty($cart_data["finished"])): ?><span><?php echo ($cart_data["finished"]); ?></span><?php endif; ?>
                        <p class="iconfont">&#xe608;</p>
                        <p>已完成</p>
                    </a>
                </div>
            </div>
            <a class="weui_cell weui_cell_extend" href="<?php echo U('Distribution/myAddress');?>" id="address_list_btn">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe609;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>地址列表</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a><?php endif; ?>
        <?php if(($account["bartender"]) != "1"): ?><a class="weui_cell weui_cell_extend" href="javascript:;" onclick="if(window.confirm('确认退出？')){location.href='<?php echo U('Distribution/loginoutAjax');?>'}">
                <div class="weui_cell_hd weui_cell_hd_extend iconfont">&#xe61b;</div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>退出登陆</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a><?php endif; ?>
    </div>
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
<!-- <div class="show_wrap"></div>
-->
</body>
</html>
<!-- 加载信息框 -->
<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RES;?>/original/js/require.js" data-main="<?php echo RES;?>/original/js/main"></script>
<script type="text/javascript">
        //rem设置
        // (function(doc, win) {
        //     var docEl = doc.documentElement,
        //         resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        //         recalc = function() {
        //             var clientWidth = docEl.clientWidth>=400?400:docEl.clientWidth;
        //             if (!clientWidth) return;
        //             docEl.style.fontSize = 12 * (clientWidth / 320) + 'px';
        //             //宽与高度
        //             document.body.style.height = clientWidth * (900 / 1440) + "px"
        //         };
        //     win.addEventListener(resizeEvt, recalc, false);
        //     doc.addEventListener('DOMContentLoaded', recalc, false);
        // })(document, window);
</script>
<script>
    function getAction(module,action){
        return "http://<?php echo ($url_par); ?>?g=Wap&m="+module+"&a="+action;
    }
</script>