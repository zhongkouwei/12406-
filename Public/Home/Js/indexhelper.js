
/* 启动服务端反推监听 */
function startServerListener(){
	$.ajax({
	      url: "/app?type=ajax&action=getperiodforindex&callback=?",
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
/* 启动倒计时处理器 */
function startTimer(){
	
	nTimeOut++;
	window._tnews++;
	
	// 处理新闻
	if (window._tnews > 900) {
		loadNews();
		window._tnews = 0;
	}
	
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
	 });
	 
	 if (inbidids != '') {
		 inbidids = inbidids.substr(1);
	 }
	 
	 $.getJSON('/app?type=ajax&action=getperiodforindexex', {'pids':inbidids} ,function(periods){
		 
		 nTimeOut=0;
		 bTimeOutState=0;
		 
		 if (periods != null) {
			 if (periods.length>0) {
				 for (var c in periods){
					 refreshAuction(periods[c]);
				 }
			 }
			 else
				 refreshAuction(periods);
		 }

	});
}

/* 刷新拍卖对象 */
function refreshAuction(period) {
	
	// 处理参与人数
	$('#bid_count_'+period.id).text(period.joincount);
	// 处理剩余数量
	$('#end_count_'+period.id).text(period.bargaincount);
	
	// 处理价格
	refreshPrice('#price_'+period.id, period.currPrice);
	// 处理时间
	refreshTime(period);
	// 处理成交状态
	refreshState(period);
}



//==========================
// news 
//==========================
/*加载新闻公告*/
function loadNews() {
	
	 $.getJSON('/app?type=ajax&action=getnews', function(news){
		 var content='';
		 
		 if (news != null && news.length > 0){
			 for (var i=0;i<news.length;i++) {
				content += 
					'<li>'+
						'<a href="../../app/newinfo-'+news[i].newID+'.html"/*tpa=http://game.haopai365.com/app/newinfo-'+news[i].newID+'.html*/ title="'+news[i].topic+'" target="_blank"><span class="'+news[i].typeclass+'">'+news[i].topic+'</span></a>'+
					'</li>'; 
			 }
		 } else {
			 content = '<li><span>暂无记录!</span></li>';
		 }
		 
		 $('#homenews').html(content);
		
	 });
}


/* 绑定图片滑动事件 */
function bindPeriodHover(){
	 $("#today .futureAuctions:first").addClass("futureAuctionsOn");
	 $(".futureAuctions").mouseover(function(){
	 $(this).addClass("futureAuctionsOn").siblings().removeClass("futureAuctionsOn");
	 }).mouseout(function(){
	 $(this).addClass("futureAuctionsOn").siblings().removeClass("futureAuctionsOn");
	 });
}


function loadActivity(){
	$("#applyFrame").html("<a class='normal-close' onclick='closeActivity();'></a><a href='../../index.htm'/*tpa=http://game.haopai365.com/*/ target='_blank'><img border='0' src='../a-d/95-sale.jpg'/*tpa=http://game.haopai365.com/static/a-d/95-sale.jpg*/ width='752px' height='443px' /></a>").slideDown(1000, function() {
		window.successTimer = window.setTimeout(closeActivity, 5000);
	});
}

function closeActivity(){
	$("#applyFrame").animate({
		   top: -500, opacity: 'hidden'
		 }, { duration: 1000 });
}

function showSlider() {
	$('#recommendedPic').append('<a href="../../app/help/content/seller/add_auction.html"/*tpa=http://game.haopai365.com/app/help/content/seller/add_auction.html*/ title="" >'+
		'<img width="732" height="228" alt="" src="./Public/Home/Images/a-d/index/20111016.jpg"/*tpa=http://game.haopai365.com/static/a-d/index/20111016.jpg*/ alt=""/></a>');
	$('#recommendedPic').append('<a href="../../app/register.htm"/*tpa=http://game.haopai365.com/app/register*/ title="" >'+
		'<img width="732" height="228" alt="" src="./Public/Home/Images/a-d/index/20111019.jpg"/*tpa=http://game.haopai365.com/static/a-d/index/20111019.jpg*/ alt=""/></a>');
	$('#recommendedPic').append('<a href="../../app/register.htm"/*tpa=http://game.haopai365.com/app/register*/ title="" >'+
		'<img width="732" height="228" alt="" src="./Public/Home/Images/a-d/index/20111017.jpg"/*tpa=http://game.haopai365.com/static/a-d/index/20111017.jpg*/ alt=""/></a>');
	  
	  $('#recommendedPic').bxSlider({
		  	mode: 'horizontal',
		  	infiniteLoop: true,
		  	speed: 800,	
		  	auto:true,
		  	controls :false,
		  	pause: 4000,
		  	autoHover: true,
		  	pager :true,
		  	pagerLocation:'bottom' 
	 });
}

function bindGameNav() {
	var hotHtml = $('#navBody ul').html();
	$('#wordIndex li').bind('mouseenter', function() {
		var e = $(this);
		var id = e.attr("id");
		
		if (e.attr('class') == 'active') {
			return;
		}
		$('#wordIndex .active').removeClass('active');
		
		if (id == 'hot') {
			$('#navBody ul').html(hotHtml);
			return;
		}
		
		e.addClass('active');
		
		// get values
		/*
		$.getJSON("/app?type=ajax&action=getproductgametype2&tid="+id, function(sublist)  {
			
			if (sublist) {
				var gameCon = '';
				for (var i = 0 ; i < sublist.length; i++) {
					gameCon += '<li><a target="_blank" href="'+sublist[i].id+'">'+sublist[i].name+'</a></li>';
				}
				
				$('#navBody ul').html(gameCon);
			} 
		});
		*/
		var cdata = $('#gameCache').data(id);
		if (cdata) {
			$('#navBody ul').html(cdata);
			return;
		}
		
		$.ajax({
			  type: "GET",
			  url: "/app?type=ajax&action=getproductgametype2&tid="+id,
			  dataType: "json",
			  cache:true,
		      success: function(sublist)  {
					
		    	  	var gameCon = '';
					if (sublist) {
						for (var i = 0 ; i < sublist.length; i++) {
							gameCon += '<li><a target="_blank" href="../../app/search-type1='+id+'&type2='+sublist[i].id+'&type3=-1&type4=-1.htm"/*tpa=http://game.haopai365.com/app/search?type1='+id+'&type2='+sublist[i].id+'&type3=-1&type4=-1*/>'+sublist[i].name+'</a></li>';
						}
						
						$('#navBody ul').html(gameCon);
					}  else {
						$('#navBody ul').html('');
					}
					
					$('#gameCache').data(id, gameCon);
				}
			});
	});
	
}
