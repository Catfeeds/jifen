<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
<title>我的分店-普通A分店</title>
<link href="<?php echo RES;?>/distri/css/fdlb.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/jquery-weui.css">
    <link rel="stylesheet" href="<?php echo RES;?>/original/css/style.css">
</head>

<body>
	<div class="container">
	<?php if(is_array($follow)): $i = 0; $__LIST__ = $follow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div <?php if(($vo["distritime"]) != "0"): ?>class="fd fd1"<?php else: ?>class="fd"<?php endif; ?>>
    	<div class="tx"><img <?php if(($vo["headimgurl"]) == ""): ?>src="<?php echo RES;?>/distri/images/portrait.jpg"<?php else: ?>src="<?php echo ($vo["headimgurl"]); ?>"<?php endif; ?> width="115px;"></div><!--tx-->
        <div class="left">
        	<ul class="left_ul">
            	<li>分店ID：<?php echo $vo['id']+$set['startNums'];?></li>
                <li>昵称：<?php if(($vo["headimgurl"]) == ""): ?>未获取<?php else: echo ($vo["nickname"]); endif; ?></li>
                <li>关注时间：<?php echo (date('Y-m-d',$vo["createtime"])); ?></li>
            </ul>
        </div><!--left-->
        <div class="right"><img src="<?php echo RES;?>/distri/images/jt.png"></div><!--right-->
        <div class="clear"></div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    	
    
    </div><!--container-->
</body>
</html>