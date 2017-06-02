/*

	[HAOPAI365] (C)2010-2011 GuangLin Inc.
	$Id: auction_detail.js 100 2010-08-20$
*/

/* 启动倒计时处理器 */

/* 启动服务端反推监听 */
function startServerListener(){
	$.ajax({
	      url: "/app?type=ajax&action=auctioninfo&pid="+window._hotPeriodId+"&callback=?",
	      type: "POST",
	      dataType: "json",
	      success: function(param){
	    	 nTimeOut = 0;
	         bTimeOutState=0;
	         var periods = param.period;
	         var user = param.user;
	    	 
	    	 if(periods.length>0) {
	    		 for (var c in periods){
	    			 refreshAuction(periods[c]);
	    		 }
	    	 }
	    	 else {
	    		 refreshAuction(periods);
	    	 }
	    	 
	    	 if(user!=null)
	    	 {
	    		 refreshUser(user);
	    	 } else {
    			window._islogined = 0;
    			  loadLoginInfo({"isLogin":0});
	    	 }
	    	 
	    	 startServerListener();
	      },
	      error: function(jqXHR, textStatus, errorThrown){
	    	  startServerListener();
	      }
	   }
	);
}

function showProductImage()
{
	$("#proImage img").not(":first").hide();
	$("#proThumbnails a").click(function(){
		if ($("#" + this.rel).is(":hidden"))
		{
			$("#proImage img").slideUp();
			$("#" + this.rel).slideDown();
		}
	}).focus(function(){
		$(this).blur();
	});
}

function startTimer(){
	
	nTimeOut++;
	
	for( var i=0; i< window._periods.length;i++) {
		var period = window._periods[i];
		var leaveTime = Number(period[3]);
		
		// 已成交或取消的拍卖状态不处理 
		if (period[4] == 3 || period[4] == 4) {
			continue;
		}
		
		// 标识即将结束的id
		if (leaveTime <= 60) {
			$('#'+period[1]).val(2);
		} 
		
		processTime("#time_"+period[1], period[1], leaveTime, period[5]);		//处理时间
			
		window._periods[i][3] = leaveTime -1;
	}
	
	if(window.ShowTimer!=null){
		window.clearTimeout(window.ShowTimer);
	}
	window.ShowTimer = window.setTimeout("startTimer()",1000);
}

/* 刷新快结束的拍卖列表  */
function refreshList() {
	nTimeOut = 5;
	 var inbidids = '';
	 
	 $("input[name='closeto_finish']").each(function(i){
		 if (this.value == 2) {
			 inbidids += ',' + this.id;
		 }
	 });;
	 
	 if (inbidids != '') {
		 inbidids = inbidids.substr(1);
	 }
	 
	 $.getJSON('/app?type=ajax&action=auctioninfoex', {'pids':inbidids,'pid':window.cpID} ,function(params){
		 
		 nTimeOut=0;
		 bTimeOutState=0;
		 
		 if (params != null) {
			 var periods = params.periods;
			 var loglist = params.loglist;
			 
			 if(periods.length>0) {
				 for (var c in periods){
					 refreshAuction(periods[c]);
				 }
			 }
			 else
				 refreshAuction(periods);
			 
			 refreshLog(loglist, 1);
		 }
	});
}

/* 刷新拍卖对象 */
function refreshAuction(period) {
	
	
	// 处理参与人数
	$('#bid_count_'+period.id).text(period.joincount);
	
	// 处理价格
	refreshPrice('#price_'+period.id, period.currPrice);
	// 处理时间
	refreshTime(period);
	// 处理成交状态
	refreshState(period);
	
	// 处理热门拍卖
	if (window._hotPeriodId == period.id) {
		// 处理参与人数
		$('#hot_bid_count_'+period.id).text(period.joincount);
		// 处理剩余数量
		$('#hot_end_count_'+period.id).text(period.bargaincount);
		// 处理价格
		refreshPrice('#hot_price_'+period.id, period.currPrice);
		
		$('#myPriceShow').html("&yen;"+period.bidPrice);
		$('#myCountShow').html(period.Count);
	}
	
	// 处理用户
	$('#bidder_'+period.id).html(period.uname);
	// 处理价格
	refreshPrice('#price_'+period.id, period.currPrice);
	// 处理时间
	refreshTime(period);
	// 处理成交状态
	refreshState(period);
	
	// 刷新出价记录
	if (window.cpID == period.id && period.status==0) {
		refreshLog(period, 2);
	}
	
}