define(['jquery','loading','velocity','velocity-ui'],function($,loading,animate){
    var append_wrap = $("<div class='show_wrap'></div>");
    $('body').prepend(append_wrap);
    var append_wrap2 = $("<div class='show_wrap2'></div>");
    $('body').prepend(append_wrap2);
    var showspeed = 300;
    var show_wrap = $('.show_wrap');
    var index_wrap = $('.index_wrap');
    var show_wrap2 = $('.show_wrap2');
    var animate_running = 0;
    var load;
    function Common(){
        //背景效果图
        // var imgitem = $('.movebg');
        // var nums = imgitem.length;
        // var index = 1;
        // setInterval(function() {
        //     imgitem.eq(index).addClass('slideshow-image').siblings().removeClass('slideshow-image');
        //     index >= nums - 1 ? index = 0 : index++;
        // }, 6000);

        //设置HTML BODY定位
        $('html,body').css({'height':'100%'});
        $('body').css({'position':'relative'});

        load = new loading.Loading();
        this._inite();
    }
    Common.prototype = {
        _inite:function(){
            var that = this;
            //监听页面返回按钮
            window.addEventListener('popstate', function() {
                console.log('aa');
                that.editHide();
            }, false);
            //设置超链接按钮
            $(document).on('click','.coad_lnfo_bage',function(e){
                that.loadPage(e,$(this),function(){
                    that.editShow();
                })
            })
            //监听页面返回按钮
            $(document).on('click', '.close_edit_wrap', function() {
                that.editHide();
                if($.type($('#myaddress').html()) != 'undefined' && index_wrap.is(':visible')){
                    $('#remark').focus();
                }
            })
        },
        //记录历史
        historyWrite : function(){
            history.pushState('', '', "");
        },
        //加载页面
        injection : function(obj, href, callback, e){
            if (obj == '') {
                obj = show_wrap;
            }
            if (e) {
                e.preventDefault();
            }
            obj.load(href, callback);
        },
        //加载页面前的操作
        loadPage : function(e, obj, callback){
            load._show();
            var href = obj.attr('href') + ' .container';
            if (show_wrap.is(':visible')) {
                if(show_wrap2.html().length == 0 && $.type($('#myaddress').html()) != 'undefined'){
                    this.historyWrite();
                }else{
                    this.historyWrite();
                }
                this.injection(show_wrap2, href, callback, e);
            } else {
                if(show_wrap.html().length == 0 && $.type($('#myaddress').html()) != 'undefined'){
                    this.historyWrite();
                }else{
                    this.historyWrite();
                }
                this.injection('', href, callback, e);
            }
        },
        //显示编辑框
        editShow : function(){
            if (show_wrap.is(':visible') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')){
                if(animate_running == 0){
                    animate_running = 1
                    show_wrap2.show().velocity({
                        'left': 0
                    }, showspeed,function(){
                        load._hide();
                    });
                    show_wrap.velocity({
                        'left': '-100%',
                    }, showspeed, function() {
                        show_wrap.hide();
                        animate_running = 0;
                    });
                }
                return;
            }else if(show_wrap2.is(':hidden') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')){
                if(animate_running == 0){
                    animate_running = 1
                    index_wrap.velocity({
                        'left': '-100%'
                    },showspeed,
                    function(){
                        index_wrap.hide()
                    });
                    show_wrap.show().velocity({
                            'left': 0,
                    },
                    showspeed,function(){
                        load._hide();
                        animate_running = 0;
                    });
                }
                return;
            }
        },
        //关闭编辑框
        editHide : function(){
            if (show_wrap.is(':visible') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')) {
                if(animate_running == 0){
                    animate_running = 1
                    index_wrap.show().velocity({
                            'left': '0'
                        },
                        showspeed);
                    show_wrap.velocity({
                        'left': '100%',
                    }, showspeed, function() {
                        show_wrap.hide();
                        animate_running = 0;
                    });
                }
                return;
            } else if(show_wrap2.is(':visible') && !show_wrap.is(':animated') && !show_wrap2.is(':animated')) {
                if(animate_running == 0){
                    animate_running = 1
                    show_wrap2.velocity({
                        'left': '100%'
                    }, showspeed, function() {
                        show_wrap2.hide();
                    });
                    show_wrap.show().velocity({
                        'left': '0',
                    }, showspeed,function(){
                        animate_running = 0;
                    });
                }
                return;
            }
        }
    }
    return{
        Common:Common
    }
})