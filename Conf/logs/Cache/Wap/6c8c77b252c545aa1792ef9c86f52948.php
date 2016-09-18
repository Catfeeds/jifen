<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($title); ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
	<link href="<?php echo RES;?>/css/store/css/topicon.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo RES;?>/css/store/css/iconfont.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo RES;?>/css/store/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		html,body{
			background-color: #EFEFF4;
			font-size: 12px;
		}
		li{
			list-style: none;
		}
		a{
			color: #000;
		}
		.list{
			padding-top: 4rem;
		}
		.list li{
		    background-color: #fff;
		    border-top: 1px solid #ECECEC;
		    height: 3rem;
		    line-height: 3rem;
		    padding: 0 0.3rem 0 0.3rem;
		    color: #131313;
		    margin-bottom: 0.5rem;
		    font-size: 1.2rem;
		}
		.list li .title{
			float: left;
			width: 68%;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}
		.list li .time{
			float: right;
		}
		.clear{
			clear: both;
		}
	</style>
</head>
<body>
	<div id="top-box" style="display: block; height: auto;">
		<div id="search-wrap">
			<div id="search-box">
				<div class="search-con">
					<i class="search-box-search-icon icon-search"></i>
					<form id="form1" name="form1" method="post" action="<?php echo U('Store/article',array('token' => $_GET['token'],'wecha_id'=>$wecha_id));?>">
						<input class="search-input" type="search" name="search_name" placeholder="请输入标题关键词" value="<?php echo ($_POST['search_name']); ?>"> 
					</form>
					<i class="search-box-delete-icon icon-cross"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="list">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><a href="<?php echo ($list["url"]); ?>">
				<li>
					<span class="title"><?php echo ($list["title"]); ?></span>
					<span class="time">
						<span class="add-time"><!-- <?php echo (date("Y-m-d",$list["createtime"])); ?> --></span>
						<span class="icon iconfont">〉</span>
					</span>
					<div class="clear"></div>
				</li>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<script>
		$(document).keydown(function(evt){
			evt = (evt) ? evt : window.event;
			if (evt.keyCode) {
			  if(evt.keyCode == 13){
			   	$("#form1").submit();
			  }
			}
		})
		var cancel_btn=$(".search-box-delete-icon");
		cancel_btn.on("click",function(){
			$(".search-input").val("");
			$("#form1").submit();
		})
	</script>
</body>
</html>