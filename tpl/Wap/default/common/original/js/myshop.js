requirejs.config({
	paths:{
        "jquery":'jquery-1.11.1.min',
        "velocity":"velocity.min",
        "velocity-ui":"velocity.ui.min",
	},
	shim:{
        "velocity":{
            deps:["jquery"]
        },
        "velocity-ui":{
            deps:["velocity"]
        }
    },
	urlArgs:"bust=" + (new Date()).getTime(),
});
// var index_wrap = $('.content_wrap');
requirejs(['jquery','common','edit_agent_info','agenttransfer'],function($,common,gedit){
    var common = new common.Common();
    //个人信息修改
    $(document).on('click','.info_edit',function(e){
        common.loadPage(e,$(this),function(){
            new gedit.PInfoEdit({});
            common.editShow();
        })
    })
})