<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ID=edge, chorome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo RES;?>/original/css/weui.min.css">
  <link rel="stylesheet" href="<?php echo RES;?>/original/css/notification.css"></head>
<body id="scnhtm5" style="background-color: #ececec;">
  <div class="container">
    <div class="info_edit_wrap_title">
      <div class="info_edit_wrap_title_item info_edit_wrap_title_left close_edit_wrap">返回</div>
      <div class="info_edit_wrap_title_item info_edit_wrap_title_center">个人设置</div>
      <div class="info_edit_wrap_title_item info_edit_wrap_title_right"></div>
    </div>
    <div class="bd">
      <div class="weui_cells weui_cells_access" style="margin-top: 5px;">
        <a class="weui_cell" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">头像</p>
          </div>
          <div class="">
            <img id="headimg" style="width: 40px; height: 40px; border-radius: 50%;" src="<?php echo ($account["headimgurl"]); ?>"></div>
          <input type="file" name="shoplogo" id="shoplogo">
          <div id="img_upload_loading">
            <img src="<?php echo RES;?>/original/images/loading.gif" alt=""></div>

        </a>
        <a class="weui_cell editinfo_btn" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">真实姓名</p>
          </div>
          <div class="weui_cell_ft editinfo_con" data-name="nickname"><?php echo ($account["nickname"]); ?></div>
        </a>
        <a class="weui_cell editinfo_btn" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">手机号</p>
          </div>
          <div class="weui_cell_ft editinfo_con" data-name="tele"><?php echo ($account["tele"]); ?></div>
        </a>
        <a class="weui_cell editinfo_btn" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">微信名</p>
          </div>
          <div class="weui_cell_ft editinfo_con" data-name="petname"><?php echo ($account["petname"]); ?></div>
        </a>
        <a class="weui_cell" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">当前账号</p>
          </div>
          <div class=" editinfo_con"><?php echo ($account["username"]); ?></div>
        </a>
        <a class="weui_cell editinfo_btn" href="javascript:;">
          <div class="weui_cell_bd weui_cell_primary">
            <p class="editinfo_title">设置新密码</p>
          </div>
          <div class="weui_cell_ft editinfo_con" data-name="password"></div>
        </a>

      </div>

    </div>
    <!-- 修改页面 -->
    <div id="info_edit_wrap">
      <div class="info_edit_wrap_title">
        <div class="info_edit_wrap_title_item info_edit_wrap_title_left" id="close_info_edit">返回</div>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_center" id="eidt_info_title"></div>
        <div class="info_edit_wrap_title_item info_edit_wrap_title_right"></div>
      </div>
      <div class="weui_cells_form" style="padding-top: 10px;">
        <div class="weui_cell info_edit_old_password" style="display: none;">
          <div class="weui_cell_bd weui_cell_primary weui_cell_infoedit" style="box-shadow: 0 0 5px #D6D6D6;">
            <input id="info_edit_old_password" class="weui_input weui_input_infoedit" type="password" placeholder="输入原密码" value="">
            <span class="weui_infoedit_delete">×</span>
          </div>
        </div>
        <div class="weui_cell">
          <div class="weui_cell_bd weui_cell_primary weui_cell_infoedit" style="box-shadow: 0 0 5px #D6D6D6;">
            <input id="info_edit_item" class="weui_input weui_input_infoedit" type="text" placeholder="输入信息" value="2222">
            <span class="weui_infoedit_delete">×</span>
          </div>
        </div>
      </div>

      <div class="weui_cells" style="padding: 0 10px; background-color: rgba(255,255,255,0);">
        <a href="javascript:;" class="weui_btn weui_btn_primary" id="save_info">保存</a>
      </div>
    </div>
    <!-- 修改页面 -->
  </div>
</body>
</html>
<script src="<?php echo RES;?>/js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RES;?>/original/js/notification.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RES;?>/original/js/ajaxfileupload.js" type="text/javascript"></script>
<!-- input控件操作 -->
<script>
  (function($){
    var edit_input = $('.weui_input_infoedit');
    var delete_btn = $('.weui_infoedit_delete');
    var input_info = edit_input.val();
    //起始判断
    if(input_info){
      delete_btn.css('opacity',1);
    }
    //输入
    edit_input.on('keyup',function(){
      input_info = edit_input.val();
      if(input_info){
        delete_btn.css('opacity',1);
      }else{
        delete_btn.css('opacity',0);
      }
    })
    //删除
    delete_btn.on('click',function(){
      edit_input.val('');
      delete_btn.css('opacity',0);
    })
  })($)
</script>
<!-- input控件操作 -->

<script>
  (function(){
    //修改信息
    var info_edit_item = $("#info_edit_item");//修改信息内容
    var save = $("#save_info");//保存按钮
    var info_edit_wrap = $("#info_edit_wrap");//修改框
    var close_info_edit = $('#close_info_edit');//关闭修改弹出框
    var edit_btn = $(".editinfo_btn");//需要修改的按钮
    var name,data,info_item,title;
    var title_item = $('#eidt_info_title');//修改框显示的内容

    //弹出编辑框
    edit_btn.on("click",function(){
      info_item = $(this).find('.editinfo_con');
      name = info_item.data('name');
      data = info_item.text();
      title = $(this).find('.editinfo_title').text();
      title_item.text(title);
      info_edit_item.val(data);
      info_edit_wrap.animate({'left':0},300);
    })
    //关闭编辑框
    close_info_edit.bind('click',function(){
      info_edit_wrap.animate({'left':'100%'},300);
      $('.weui_infoedit_delete').css('opacity',1);
    })
    //保存信息按钮
    save.on("click",function(){
      var new_info = info_edit_item.val();
      if(new_info){
        info_item.text(new_info);
        close_info_edit.click();
        // $.ajax({
        //   data:{name:name,info:new_info},
        //   type:'post',
        //   dataType:'json',
        //   success:function(data){
        //     console.log(data);
        //     info_item.text(new_info);
        //     close_info_edit.click();
        //   }
        // })
        floatNotify.simple('修改成功');
      }else{
        floatNotify.simple('内容不能为空');
        return false;
      }
    })
    //修改店铺头像
    $(document).on('change',"#shoplogo",function(){
      var loading=$("#img_upload_loading");
      loading.show();
      $.ajaxFileUpload ({
     url: "<?php echo U('Distribution/headpic');?>",
     type: 'post',
     secureuri:false,
     fileElementId:'shoplogo',
     dataType: 'json',
         success: function (data){
          console.log(data);
          loading.hide();
          if(data.status==1){
            $("#headimg").attr("src",data.data);
          }else if(data.status==2){
            floatNotify.simple("上传失败，只支持JPG图片");
            return;
          }else if(data.status==3){
            floatNotify.simple("只能三天更新一次!");
            return;
          }
         }
      })
      return false;
    })
  })($)
</script>