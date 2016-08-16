define(['jquery'],function(){
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
	return{
		Loading:Loading
	};
})