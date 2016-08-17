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
requirejs(['jquery','common','topup'],function($,common){
	var common = new common.Common();
})