requirejs.config({
	paths:{
		"jquery":"jquery-1.8.3.min",
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
});

requirejs(['jquery','velocity','velocity-ui'],function($,Velocity){
	var ali=$(".ali-box");
	var bank=$(".bank-box");
	var payBtn=$(".choose-pay");
	Velocity.RegisterEffect('toleft_hide',{
		defaultDuration:500,
		calls:[
			[{left:["-100%",0]}],
		]
	})
	Velocity.RegisterEffect('toleft_show',{
		defaultDuration:500,
		calls:[
			[{left:[0,"100%"]}],
		]
	})
	Velocity.RegisterEffect('toright_hide',{
		defaultDuration:500,
		calls:[
			[{left:["100%",0]}],
		]
	})
	Velocity.RegisterEffect('toright_show',{
		defaultDuration:500,
		calls:[
			[{left:[0,"-100%"]}],
		]
	})
	var seqInit="";
	payBtn.on("click",function(){
		var type=$(this).find(".dd").attr("data-type");
		if(type==1){
			seqInit=[
				{
					e:ali,
					p:'toleft_hide',
					o:{duration:300},
				},
				{
					e:bank,
					p:'toleft_show',
					o:{duration:300},
				},
			];
			Velocity.RunSequence(seqInit);
			$(this).find(".dd").text("切换到支付宝");
			$(this).find(".dd").attr("data-type",2);
			$(this).find(".pay-icon").addClass("bank-icon").removeClass("ali-icon");
		}else{
			seqInit=[
				{
					e:bank,
					p:'toright_hide',
					o:{duration:300},
				},
				{
					e:ali,
					p:'toright_show',
					o:{duration:300},
				}
			];
			Velocity.RunSequence(seqInit);
			$(this).find(".dd").text("切换到银行卡");
			$(this).find(".dd").attr("data-type",1);
			$(this).find(".pay-icon").addClass("ali-icon").removeClass("bank-icon");
		}
	})
});