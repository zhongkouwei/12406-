/*jquery highlight*/
jQuery.fn.highlightFade=function(settings){var o=(settings&&settings.constructor==String)?{start:settings}:settings||{};var d=jQuery.highlightFade.defaults;var i=o['interval']||d['interval'];var a=o['attr']||d['attr'];var ts={'linear':function(s,e,t,c){return parseInt(s+(c/t)*(e-s));},'sinusoidal':function(s,e,t,c){return parseInt(s+Math.sin(((c/t)*90)*(Math.PI/180))*(e-s));},'exponential':function(s,e,t,c){return parseInt(s+(Math.pow(c/t,2))*(e-s));}};var t=(o['iterator']&&o['iterator'].constructor==Function)?o['iterator']:ts[o['iterator']]||ts[d['iterator']]||ts['linear'];if(d['iterator']&&d['iterator'].constructor==Function)t=d['iterator'];return this.each(function(){if(!this.highlighting)this.highlighting={};var e=(this.highlighting[a])?this.highlighting[a].end:jQuery.highlightFade.getBaseValue(this,a)||[255,255,255];var c=jQuery.highlightFade.getRGB(o['start']||o['colour']||o['color']||d['start']||[255,255,128]);var s=jQuery.speed(o['speed']||d['speed']);var r=o['final']||(this.highlighting[a]&&this.highlighting[a].orig)?this.highlighting[a].orig:jQuery.curCSS(this,a);if(o['end']||d['end'])r=jQuery.highlightFade.asRGBString(e=jQuery.highlightFade.getRGB(o['end']||d['end']));if(typeof o['final']!='undefined')r=o['final'];if(this.highlighting[a]&&this.highlighting[a].timer)window.clearInterval(this.highlighting[a].timer);this.highlighting[a]={steps:((s.duration)/i),interval:i,currentStep:0,start:c,end:e,orig:r,attr:a};jQuery.highlightFade(this,a,o['complete'],t);});};jQuery.highlightFade=function(e,a,o,t){e.highlighting[a].timer=window.setInterval(function(){var newR=t(e.highlighting[a].start[0],e.highlighting[a].end[0],e.highlighting[a].steps,e.highlighting[a].currentStep);var newG=t(e.highlighting[a].start[1],e.highlighting[a].end[1],e.highlighting[a].steps,e.highlighting[a].currentStep);var newB=t(e.highlighting[a].start[2],e.highlighting[a].end[2],e.highlighting[a].steps,e.highlighting[a].currentStep);jQuery(e).css(a,jQuery.highlightFade.asRGBString([newR,newG,newB]));if(e.highlighting[a].currentStep++>=e.highlighting[a].steps){jQuery(e).css(a,e.highlighting[a].orig||'');window.clearInterval(e.highlighting[a].timer);e.highlighting[a]=null;if(o&&o.constructor==Function)o.call(e);}},e.highlighting[a].interval);};jQuery.highlightFade.defaults={start:[255,255,128],interval:50,speed:400,attr:'backgroundColor'};jQuery.highlightFade.getRGB=function(c,d){var result;if(c&&c.constructor==Array&&c.length==3)return c;if(result=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(c))return[parseInt(result[1]),parseInt(result[2]),parseInt(result[3])];else if(result=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(c))return[parseFloat(result[1])*2.55,parseFloat(result[2])*2.55,parseFloat(result[3])*2.55];else if(result=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(c))return[parseInt("0x"+result[1]),parseInt("0x"+result[2]),parseInt("0x"+result[3])];else if(result=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(c))return[parseInt("0x"+result[1]+result[1]),parseInt("0x"+result[2]+result[2]),parseInt("0x"+result[3]+result[3])];else return jQuery.highlightFade.checkColorName(c)||d||null;};jQuery.highlightFade.asRGBString=function(a){return"rgb("+a.join(",")+")";};jQuery.highlightFade.getBaseValue=function(e,a,b){var s,t;b=b||false;t=a=a||jQuery.highlightFade.defaults['attr'];do{s=jQuery(e).css(t||'backgroundColor');if((s!=''&&s!='transparent')||(e.tagName.toLowerCase()=="body")||(!b&&e.highlighting&&e.highlighting[a]&&e.highlighting[a].end))break;t=false;}while(e=e.parentNode);if(!b&&e.highlighting&&e.highlighting[a]&&e.highlighting[a].end)s=e.highlighting[a].end;if(s==undefined||s==''||s=='transparent')s=[255,255,255];return jQuery.highlightFade.getRGB(s);};jQuery.highlightFade.checkColorName=function(c){if(!c)return null;switch(c.replace(/^\s*|\s*$/g,'').toLowerCase()){case'aqua':return[0,255,255];case'black':return[0,0,0];case'blue':return[0,0,255];case'fuchsia':return[255,0,255];case'gray':return[128,128,128];case'green':return[0,128,0];case'lime':return[0,255,0];case'maroon':return[128,0,0];case'navy':return[0,0,128];case'olive':return[128,128,0];case'purple':return[128,0,128];case'red':return[240,255,0];case'silver':return[192,192,192];case'teal':return[0,128,128];case'white':return[255,255,255];case'yellow':return[255,255,0];}};


/* 初始拍卖样式 */
function initStyle()
{
	//tabview
	var $tabs = $(".tab a");

	$tabs.bind("click", function(){
		var tabId = $(this).attr("href");
		var tabIdStr = tabId.split("#");
		var currentTabId = '#'+tabIdStr[1];
		$(currentTabId).show().siblings(".content").hide();
		$(this).parent("li").addClass("on").siblings().removeClass("on");
		$(this).parent("h2").parent("li").addClass("on").siblings().removeClass("on");
		return false;
	})
	.focus(function(){
		$(this).blur();
	});

	$(".button button").bind("click",function(){
		$(this).blur();
	});

	$(".input:disabled").addClass("input-disabled");

	$(".button").hover(
	function(){
		$(this).addClass("button-hover");
	},
	function(){
		$(this).removeClass("button-hover");
	});

}

/* 绑定按钮事件 */
function bindEvent() {
	//拍卖的按钮
	$("#hotButton .bidbutton").click(function(){
		var periodId=$(this).attr("name");
		var isfinish=$(this).hasClass("bidImgButton_ended");
		if(!isfinish){
			if(window._islogined==0){
				showLogin();
			}else{
				bid(periodId);
			}
		}
	});
}


/* 出价 */
function bid(id) {
	 var myprice = $("#myprice").val();
	 var mycount = $("#mycount").val();
	
	 $.getJSON('app?type=ajax&action=userbid', {'price':myprice,'count':mycount,'pID':id} ,function(state){
		 
		 switch(state) {
		 case 0:
			 window.location.href = "../../app/homepage/deposit/lack-pID=.htm"/*tpa=http://game.haopai365.com/app/homepage/deposit/lack?pID=*/+id;
			 break;
		 case 1:
			 jgrowl("出价成功!");
			 break;
		 case 2:
			 jgrowl("本期拍卖已取消!");
			 break;
		 case 3:
			 jgrowl("未开拍!");
			 break;
		 case 4:
			 jgrowl("出价太过频繁!");
			 break;
		 case 5:
			 showLogin();
			 break;
		 case 6:
			 jgrowl("您无拍卖权限,请与管理员联系!");
			 break;
		 case 7:
			 jgrowl("购买商品最少1件!");
			 break;
		 case 8:
			 jgrowl("您不能参与自己的拍卖!");
			 break;
		 case 9:
			 jgrowl("您的出价不能高于市场价!");
			 break;
		 }
		 
 	});
}


/* 处理成交状态 */
function refreshState(period) {
	
	if(period != null){
		
		if (period.status == 3) {
			// 结束
			disableBtn(period.id);//完成状态统一处理
		} else if (period.status == 4) {
			// 取消
			cancelBtn(period.id);//完成状态统一处理
		} 
		
		if(period.awake == 1) {
			promptSuccess("恭喜&nbsp;"+period.uname+"&nbsp;拍得"+period.pname);
		}
		// clear var
	}
	
}

/*刷新历史成交*/
function refreshLog(period, mode) {
	if(mode==1){
		
		if (period == "null") {
			return;
		}
		
		var html_header='<table class="chart" id="bidlogBox"><thead><th width="30%">昵称</th><th>IP</th><th>出价时间</th></thead>';
		var html_footer='</table>';	
		var html_body='';
		//更新所有记录
		for (var i=0; i<period.length; i++){
			html_body+='<tr title="来自:'+period[i].ufrom+',出价时间:'+period[i].ubidtime+'"><td><a style="display:block; height:16px; overflow:hidden;cursor:default;" href="javascript:void(0);"  title="'+period[i].uname+'，昵称过长自动隐藏">'+period[i].uname+'</a></td><td class="f10">'+period[i].uip+'</td><td class="f10">&yen;'+period[i].ubidtime+'</td></tr>';
		}
		$('#bidHistoryList').html(html_header+html_body+html_footer);
	}else{
		var html_tr='<tr title="来自:'+period.ufrom+',出价时间:'+period.ubidtime+'"><td><a style="display:block; height:16px; overflow:hidden;cursor:default;" href="javascript:void(0);"  title="'+period.uname+'，昵称过长自动隐藏">'+period.uname+'</a></td><td class="f10">'+period.uip+'</td><td class="f10">'+period.ubidtime+'</td></tr>';
		if($("#bidHistoryList table tr").size()>9){
				$("#bidHistoryList table tr:last").remove();
		}
		
		if ($("#bidlogBox").html()!=null) {
			$("#bidHistoryList table").prepend(html_tr);
		} else {
			var html_header='<table class="chart" id="bidlogBox"><thead><th width="30%">昵称</th><th>IP</th><th>时间</th></thead>';
			var html_footer='</table>';	
			$('#bidHistoryList').html(html_header+html_tr+html_footer);
		}
	}
}

/*处理游戏完成后的变化,统一处理*/
function disableBtn(id){
	$("#time_"+id).text('拍卖成功').attr('style','color:#a6a6a6');
	$("#bid_btn_"+id).addClass('button-disabled');
	$("#bid_"+id).attr("class","bidbutton bidImgButton bidImgButton_ended");
	
	if(id==window._hotPeriodId){
		$("#hot_time_"+id).text('拍卖成功').attr('style','color:#a6a6a6');
		$("#hot_bid_btn_"+id).addClass('button-disabled');
		$("#hot_"+id).attr("class","bidbutton bidImgButton bidImgButton_ended");
	}
}

/*处理游戏完成后的变化,统一处理*/
function cancelBtn(id){
	$("#time_"+id).text('拍卖取消').attr('style','color:#a6a6a6');
	$("#bid_btn_"+id).addClass('button-disabled');
	$("#bid_"+id).attr("class","bidbutton bidImgButton bidImgButton_ended");
	
	if(id==window._hotPeriodId){
		$("#hot_time_"+id).text('拍卖取消').attr('style','color:#a6a6a6');
		$("#hot_bid_btn_"+id).addClass('button-disabled');
		$("#hot_"+id).attr("class","bidbutton bidImgButton bidImgButton_ended");
	}
}

/*处理用户*/
function refreshUser(user) {
	refreshLoginState(user.myid, user.myname, user.msgcount);
}

/*刷新登陆状态*/
function refreshLoginState(id, name, msgcount) {
	// 未登录
	if (id == 0) {
		window._islogined = 0;
		
		  loadLoginInfo({"isLogin":0});
	} else {
		window._islogined = 1;
		
		if ($("#loginedNickname")[0] == null)
		  loadLoginInfo({"isLogin":1,"nickname":name, "userid":id, "msgcount":msgcount});
	}
}

/* 处理价格 */
function refreshPrice(k, v) {
	$(k).html(v);
	
	$(k).highlightFade({color:'red',speed:800});
}

/* 清理系统变量 */
function resetVars(){

}

/* 刷新出价记录 */
function refreshHistory() {
	
	
}

/* 刷新时间 */
function refreshTime(period) {
	var leaveTime = period.lasttime;
	processTime("#time_"+period.id, period.id, leaveTime, period.isbegin);
	
	for( var i=0; i< window._periods.length;i++) {
		var temp = window._periods[i];
		
		if (temp[1] == period.id) {
			// 处理状态
			window._periods[i][4] = period.status;
			// 处理时间
			window._periods[i][3] = leaveTime -1;
		}
	}
}


/*处理时间*/
function processTime(id,key,v,s){
	// 处理热门时间
	var timeObj = $(id);
	if(timeObj){
		var t=getLocTime(id,key,v,s);
		timeObj.html(t);
	}
	
	if (window._hotPeriodId == key) {
		var t=getLocTime(id,key,v,s);
		$("#hot_time_"+key).html(t);		//处理时间
	} 
}

//+---------------------------------------------------
//|	Time format
//+---------------------------------------------------
function getLocTime(id,key,t,s){
	if (nTimeOut > 10) {
		bTimeOutState=1;
		refreshList();
	}
	if(bTimeOutState==1)
		return ('<font color="#A6A6A6" >网络连接慢</font>');

	if(t <= 0){
		if (s == 1) {
			return ('<font color="red">即将成交</font>');
		} else {
			return ('<font color="red">即将开拍</font>');
		}
		
	}else{
		if(t>60*60*24){
			//var d=Div(t,(60*60*24));
			var h=Div(t,(60*60));
			var i=Div(Mod(Mod(t,(60*60*24)),(60*60)),60);
			var s=Mod(Mod(Mod(t,(60*60*24)),(60*60)),60);
			return (Ft(h)+':'+Ft(i)+':'+Ft(s));
		}else if(t>60*60){
			var h=Div(t,(60*60));
			var i=Div(Mod(t,(60*60)),60);
			var s=Mod(Mod(t,(60*60)),60);
			return (Ft(h)+':'+Ft(i)+':'+Ft(s));
		}else if(t>60){
			var i=Div(t,60);
			var s=Mod(t,60);
			return ('00:'+Ft(i)+':'+Ft(s));
		}else if(t>30){
			return ('<font color="green">00:00:'+Ft(t)+'</font>');
		}else if(t>0){
			return ('<font color="red">00:00:'+Ft(t)+'</font>');
		}
	}
}



//+---------------------------------------------------
//|	Math Div
//+---------------------------------------------------
function Div(exp1, exp2) {
	var n1 = Math.round(exp1); //四舍五入
	var n2 = Math.round(exp2); //四舍五入
	var rslt = n1 / n2; //除
	if (rslt >= 0) {
		rslt = Math.floor(rslt); //返回小于等于原rslt的最大整数。
	}else{
		rslt = Math.ceil(rslt); //返回大于等于原rslt的最小整数。
	}
	return rslt;
}

//+---------------------------------------------------
//|	Math Mod
//+---------------------------------------------------
function Mod(exp1, exp2) {
	var n1 = Math.round(exp1); //四舍五入
	var n2 = Math.round(exp2); //四舍五入
	var rslt = n1 % n2; //除
	if (rslt >= 0) {
		rslt = Math.floor(rslt); //返回小于等于原rslt的最大整数。
	}else{
		rslt = Math.ceil(rslt); //返回大于等于原rslt的最小整数。
	}
	return rslt;
}

//+---------------------------------------------------
//|	Math Ft
//+---------------------------------------------------
function Ft(d) {
	if(d<10){
		d="0"+d
	}
	return d;
}
