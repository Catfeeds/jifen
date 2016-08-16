// define(['jquery'],function(){
//     function Common(){

//     }
//     Common.prototype = {

//     }
//     return{
//         Common:Common
//     }
    var append_wrap = $("<div class='show_wrap'></div>");
    $('body').prepend(append_wrap);
    var append_wrap2 = $("<div class='show_wrap2'></div>");
    $('body').prepend(append_wrap2);
    var showspeed = 300;
    var show_wrap = $('.show_wrap');
    var index_wrap = $('.index_wrap');
    var show_wrap2 = $('.show_wrap2');
    var loading = $("<div id='public_loading_page'> <div class='public_loading_page_img_item'> <img src='./tpl/Wap/default/common/images/loading.gif'> <p>加载中...</p> </div> </div>")
    function Loading(){
        $("body").prepend(loading);
    }
    Loading.prototype._show = function(){
        loading.show();
    }
    Loading.prototype._hide = function(){
        loading.hide();
    }
    function historyWrite() {
        //记录历史
        history.pushState('', '', "");
    }
    var load = new Loading();
    var animate_running = 0;
    //显示编辑框
    function editShow() {
        if (show_wrap.is(':visible') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')){
            if(animate_running == 0){
                animate_running = 1
                show_wrap2.show().animate({
                    'left': 0
                }, showspeed,function(){
                    load._hide();
                });
                show_wrap.animate({
                    'left': '-100%',
                }, showspeed, function() {
                    show_wrap.hide();
                    animate_running = 0;
                });
            }
            return;
            // show_wrap2.show().removeClass('move_left0-100').addClass('move_left100-0');
            // setTimeout(function(){load._hide();},300)

            // show_wrap.removeClass('move_left-100-0 move_left100-0').addClass('move_left-100');
            // setTimeout(function(){show_wrap.hide();},300)
        }else if(show_wrap2.is(':hidden') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')){
            if(animate_running == 0){
                animate_running = 1
                index_wrap.animate({
                    'left': '-100%'
                },showspeed,
                function(){
                    index_wrap.hide()
                });
                show_wrap.show().animate({
                        'left': 0,
                },
                showspeed,function(){
                    load._hide();
                    animate_running = 0;
                });
            }
            return;
            // index_wrap.addClass('move_left-100');
            // setTimeout(function(){index_wrap.hide();index_wrap.removeClass('move_left-100')},300)
            // show_wrap.removeClass('move_left0-100').show().addClass('move_left100-0');
            // setTimeout(function(){load._hide();},300)
        }
    }
    //关闭编辑框
    function editHide() {
        if (show_wrap.is(':visible') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')) {
            if(animate_running == 0){
                animate_running = 1
                index_wrap.show().animate({
                        'left': '0'
                    },
                    showspeed);
                show_wrap.animate({
                    'left': '100%',
                }, showspeed, function() {
                    show_wrap.hide();
                    animate_running = 0;
                });
            }
            return;
            // index_wrap.show().removeClass('move_left-100').addClass('move_left-100-0');
            // show_wrap.removeClass('move_left100-0').addClass('move_left0-100');
            // setTimeout(function(){
            //     show_wrap.hide().removeClass('move_left0-100 move_left-100-0').css('left','100%');
            //     show_wrap2.hide().removeClass('move_left0-100').css('left','100%');
            // },300)
        } else if(show_wrap2.is(':visible') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')) {
            if(animate_running == 0){
                animate_running = 1
                show_wrap2.animate({
                    'left': '100%'
                }, showspeed, function() {
                    show_wrap2.hide();
                });
                show_wrap.show().animate({
                    'left': '0',
                }, showspeed,function(){
                    animate_running = 0;
                });
            }
            return;
            // show_wrap2.removeClass('move_left100-0').addClass('move_left0-100');
            // setTimeout(function(){show_wrap2.hide();},300)

            
            // show_wrap.show().removeClass('move_left-100').addClass('move_left-100-0');

            // $('.weui_infoedit_delete').css('opacity', 1);
        }
    }
    //显示二级编辑框
    function editShow2() {
        show_wrap2.show().animate({
            'left': 0
        }, showspeed);
        show_wrap.animate({
            'left': '-100%',
        }, showspeed, function() {
            show_wrap.hide();
        });
    }
    //关闭二级编辑框
    function editHide2() {
        show_wrap2.animate({
            'left': '100%'
        }, showspeed, function() {
            show_wrap2.hide();
        });
        show_wrap.show().animate({
            'left': '0',
        }, showspeed);
        $('.weui_infoedit_delete').css('opacity', 1);
    }

    //加载页面
    function loadPage(e, obj, callback) {
        load._show();
        var href = obj.attr('href') + ' .container';
        if (show_wrap.is(':visible')) {
            if(show_wrap2.html().length == 0 && $.type($('#myaddress').html()) != 'undefined'){
                historyWrite();
            }else{
                historyWrite();
            }
            injection(show_wrap2, href, callback, e);
        } else {
            if(show_wrap.html().length == 0 && $.type($('#myaddress').html()) != 'undefined'){
                historyWrite();
            }else{
                historyWrite();
            }
            injection('', href, callback, e);
        }
    }

    function injection(obj, href, callback, e) {
        if (obj == '') {
            obj = show_wrap;
        }
        if (e) {
            e.preventDefault();
        }
        obj.load(href, callback);
    }
    //背景效果图
    var imgitem = $('.movebg');
    var nums = imgitem.length;
    var index = 1;
    setInterval(function() {
        imgitem.eq(index).addClass('slideshow-image').siblings().removeClass('slideshow-image');
        index >= nums - 1 ? index = 0 : index++;
    }, 6000);
    //监听返回按钮
    window.addEventListener('popstate', function() {
        editHide();
        console.log('aa');
    }, false);
    //监听返回按钮
    $(document).on('click', '.close_edit_wrap', function() {
        // console.log('aa');
        // setTimeout(editHide(),3000);
        editHide();
        if($.type($('#myaddress').html()) != 'undefined' && index_wrap.is(':visible')){
            $('#remark').focus();
        }
    })
    //设置超链接按钮
    $(document).on('click','.coad_lnfo_bage',function(e){
        loadPage(e,$(this),function(){
            editShow();
        })
    })
    //设置HTML BODY定位
    $('html,body').css({'height':'100%'});
    $('body').css({'position':'relative'});
// })