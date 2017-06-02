
function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function jgrowl(text) {
	if (isUndefined(text)) {
		return false;
	}

	var applyFrame = document.getElementById("apply_frame_growl");

	if (!applyFrame) {
		applyFrame = document.createElement('div');
		applyFrame.id = "apply_frame_growl";
		applyFrame.style.dsiplay = "none";
		document.body.appendChild(applyFrame);
		
		// init jgrowl
		$("#apply_frame_growl").load("prompt/growl.html"/*tpa=http://game.haopai365.com/static/script/prompt/growl.html*/, function() {
			
			$("#apply_frame_growl").overlay({
				target : '#growl_dialog',
				load : true,
				top : '60%',
				onBeforeLoad : function() {
					$('#growl_dialog').html("<p>" + text + "</p>");

				}
			});
		});
		
		
	} else {
		$("#growl_dialog").show();
		$('#growl_dialog').html("<p>" + text + "</p>");
	}
	
	if(window.pTimer!=null){
		window.clearTimeout(window.pTimer);
	}
	
	window.pTimer = window.setTimeout(function() {
		$('#growl_dialog').hide();
	}, 2000);

}

/*成功提示*/
function promptSuccess(title, content, adUrl){
	var tipHtml = 
		'<a class="close" onclick="closeSuccessPrompt();"></a>'
//		+'  <div class="title">'+title+'</div>'
		+'  <div class="content">'
		+'  		<div class="ad">'
		+'  			<img src="../a-d/successtip.jpg"/*tpa=http://game.haopai365.com/static/a-d/successtip.jpg*/ width="516px" height="121px">'
		+'  		</div>'
		+'		<div class="details">'
		+'			<h2>'+title+'</h2>'
		+'			<div style="padding-top:5px;">'
		+ '好拍网, 全国最大最专业的网上拍卖平台！&nbsp;<a href="../../app/help.htm"/*tpa=http://game.haopai365.com/app/help*/>《新手指南》</a>'
		+'			</div>'
		+'		</div>'
		+'</div>';
	
	var applyFrame = document.getElementById("successTip");

	if (!applyFrame) {
		applyFrame = document.createElement('div');
		applyFrame.id = "successTip";
		applyFrame.style.dsiplay = "none";
		document.body.appendChild(applyFrame);
	}
	//applyFrame.innerHTML = tipHtml;
	
	$("#successTip").html(tipHtml).fadeTo(1000,0.85, function() {
		window.successTimer = window.setTimeout(function() {
			$("#successTip").fadeOut('fast');
		}, 5000);
	});	
}
/*关闭成功提示*/
function closeSuccessPrompt() {
	$("#successTip").fadeOut('fast');
}


/*加载登陆配置*/
function initLoginConfig() {
	
	$("#loginTrigger").overlay({
	
		  mask: {
			color: '#ebecff',
			loadSpeed: 200,
			opacity: 0.9
			},
			effect: 'apple',
			target: '#loginBox',
	
			onBeforeLoad: function() {
				$("#boxContent").html('加载中...');
				$("#boxContent").load('../../member/login.jsp.htm'/*tpa=http://game.haopai365.com/member/login.jsp*/);
			}
	
	});
}
function initCommonAction() {
	$('#search_keywordHidden').bind('focus', function(){
		$('#search_keyword').show().focus();
		$('#search_keywordHidden').hide();
	});
	
	$('#search_keyword').bind('blur', function(){
		var e = $(this);
		if (e.val() == '') {
			$('#search_keywordHidden').show();
			$('#search_keyword').hide();
		}
	});	
}

/* 弹出登陆对话框 */
function showLogin() {
	 $("#loginTrigger").click();
}


/*加载登陆信息*/
function loadLoginInfo(user) {
	if (user.isLogin == 0) {
		
		content=
			'<ul id="loginNav" class="clearfix">'+
			'<li><a id="loginBtn" class="strong" href="../../app/login.htm"/*tpa=http://game.haopai365.com/app/login*/ title="登录">登录</a></li>'+
			'<li class="separator">|</li>'+
			'<li><h2><a id="signup" href="../../app/register.htm"/*tpa=http://game.haopai365.com/app/register*/ title="免费注册" style="color:#f60;">注册</a></h2></li>'+
			'</ul>';
	} else {
			var msgHtml = '<a href="../../app/homepage/message.htm"/*tpa=http://game.haopai365.com/app/homepage/message*/ title="查看消息">消息<span style="font-weight:500;color:red;">('+user.msgcount+')</span></a>';
			if (user.msgcount > 0) {
				msgHtml = '<img src="../images/common/newpm.gif"/*tpa=http://game.haopai365.com/static/images/common/newpm.gif*/ /><a href="../../app/homepage/message.htm"/*tpa=http://game.haopai365.com/app/homepage/message*/ title="查看消息">消息<span style="font-weight:500;color:red;">('+user.msgcount+')</span></a>';
			}
			content=
			'<ul class="clearfix">'+
				'<li>'+
					'您好，'+
					'<span>'+user.nickname+'</span>，'+
					'<a title="到个人中心" href="../../app/homepage.htm"/*tpa=http://game.haopai365.com/app/homepage*/>个人中心</a>'+
				'</li>'+
				'<li>'+msgHtml+
				'</li>'+					
				'<li class="dropMenu" id="accountBalanceWrap">'+
					'<h3 id="viewMyAccount" onMouseOver="accountMenuOn();">'+'账户信息'+
						'<span class="f10">▼</span>'+
					'</h3>'+
				'</li>'+
				'<li>'+
					'<a title="安全退出" href="javascript:logout();">退出</a>'+
				'</li>'+
			'</ul>';
	}
	
	$("#userInfo").html(content);
}

/*查看账户信息*/
function accountMenuOn(){
	$.ajaxSetup({cache:false});
	if ($('#accountMenu').is(':hidden')) {
		$('#accountMenu').html('加载中...').show(); 
		$.getJSON("/app?type=ajax&action=getaccountinfo", function(result) {
			
			var role = "买家";
			if (result.mode == 1) {
				role = "卖家";
			}
			
			var titleHtml = 
				 "<ul>" +
					 "<li>账户信息</li>" +
					 "<li title='经验值&nbsp;"+result.exp+"'>"+role+"等级：<span style='color:red;font-size:12px'>"+result.level+"</span></li>" +
					 "<li>可用金额：<span style='color:red;font-size:12px'>&yen;"+result.gold+"</span><span style='font-weight:normal;color:blue;'><a href='../../app/homepage/deposit/log.htm'/*tpa=http://game.haopai365.com/app/homepage/deposit/log*/>详情</a></span></li>" +
					 "<li>冻结金额：<span style='color:red;font-size:12px'>&yen;"+result.frozen+"</span></li>" +
			 	 "</ul>";
			$('#accountMenu').html(titleHtml); 
		});
	}
}

function accountMenuOff(){
	if(window.accountTimer!=null){
		window.clearTimeout(window.accountTimer);
	}
	
	window.accountTimer = window.setTimeout(function() {
		$("#accountMenu").hide();
	}, 5000);
}

function getCopper(){
	$.getJSON("/app?type=ajax&action=getfreecard", function(result) {
		$("#accountMenu").hide();
		jgrowl(result.errorcode);
	});
}

/* 退出 */
function logout() {
	window.location.href = "../../index.htm"/*tpa=http://game.haopai365.com/app/logout*/;
}

/* Cookie help */
function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds * 1000);
	domain = !domain ? cookiedomain : domain;
	path = !path ? cookiepath : path;
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '/')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
}

function getcookie(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}

function configForm(){
	$(".input").hover(
			function(){
				$(this).addClass("input-hover");
			},
			function(){
				$(this).removeClass("input-hover");
	});
}

function formatFloat(src, pos){
    return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
}

//限制只能输入数字和逗号
function clearNoNum(obj) {
   //先把非数字的都替换掉，除了数字和,
   obj.value = obj.value.replace(/[^\d.]/g,"");
   //必须保证第一个为数字而不是,
   obj.value = obj.value.replace(/^\./g,"");
}

function clearNoNumExdot(obj) {
	obj.value = obj.value.replace(/[^\d]/g,"");
}

function keepDefNum(obj, defvalue) {
	obj.value = obj.value.replace(/[^\d]/g,"");
	if (obj.value == '') {
		obj.value = defvalue;
		return;
	}
}

//限制只能输入数字和逗号
function keep2Num(obj) {
   //先把非数字的都替换掉，除了数字和,
   obj.value = obj.value.replace(/[^\d.]/g,"");
   if (obj.value == '') {
	   obj.value =  0; 
	   return;
   }
   //必须保证第一个为数字而不是,
   obj.value = formatFloat(obj.value.replace(/^\./g,""),2);
}