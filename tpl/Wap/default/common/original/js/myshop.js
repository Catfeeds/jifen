requirejs.config({
	paths:{
        "jquery":'jquery-1.11.1.min',
	},
	urlArgs:"bust=" + (new Date()).getTime(),
});
var index_wrap = $('.content_wrap');
requirejs(['jquery','topup','common'],function($){
	//累计收入
    // $(document).on('click','.coad_bnfo_lage',function(e){
    // 	loadPage(e,$(this),function(){
            
    //     })
    // })
})