requirejs.config({
	paths:{
        "jquery":'jquery-1.11.1.min',
	},
	// shim: {
 //        "notification": {
 //            deps: [ "jquery" ]
 //        },
 //    },
	urlArgs:"bust=" + (new Date()).getTime(),
});
requirejs(['jquery','personalInfoEdit','address','orders','common'],function($,pedit,address,orders){
    var address_wrap = $('#address_list_wrap');
    //个人信息修改
    $(document).on('click','.info_edit',function(e){
        loadPage(e,$(this),function(){
            new pedit.PInfoEdit({});
            editShow();
        })
    })
    //地址列表
    $(document).on('click','#address_list_btn',function(e){
        loadPage(e,$(this),function(){
            new address.Address({});
            editShow();
        })
    })
});