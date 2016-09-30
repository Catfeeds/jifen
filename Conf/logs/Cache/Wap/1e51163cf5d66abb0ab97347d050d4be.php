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
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Agent/myTeam',array('aid'=>$vo['id']));?>">
            <div class="fd fd1">
            	<div class="tx">
                    <img src="<?php echo ($vo["headimgurl"]); ?>" width="115px;">
                </div>
                <div class="left">
                	<ul class="left_ul">
                    	<li>
                            <label style="color: green;">绿:<?php echo sprintf('%.0f',$vo['green']);?></label>
                            <label style="color: red;">红:<?php echo sprintf('%.0f',$vo['red']);?></label>
                            <label style="color: black;">黑:<?php echo sprintf('%.0f',$vo['black']);?></label>
                        </li>
                        <li>账号:<?php echo ($vo["username"]); ?></li>
                        <li>创建时间:<?php echo (date('Y-m-d',$vo["addtime"])); ?></li>
                    </ul>
                </div><!--left-->
                <div class="right"><img src="<?php echo RES;?>/distri/images/jt.png"></div><!--right-->
                <div class="clear"></div>
            </div>
        </a><?php endforeach; endif; else: echo "" ;endif; ?>
    	
    
    </div><!--container-->
</body>
</html>