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
requirejs(['jquery','personalInfoEdit','address','orders','common','topup','transfer'],function($,pedit,address,orders,common){
    var address_wrap = $('#address_list_wrap');
    var common = new common.Common();
    //个人信息修改
    $(document).on('click','.info_edit',function(e){
        common.loadPage(e,$(this),function(){
            new pedit.PInfoEdit({});
            common.editShow();
        })
    })
    //地址列表
    $(document).on('click','#address_list_btn',function(e){
        common.loadPage(e,$(this),function(){
            new address.Address({});
            common.editShow();
        })
    })
});