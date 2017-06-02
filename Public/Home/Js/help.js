/*
	[HAOPAI365] (C)2010-2011 GuangLin Inc.
	$Id: help.js 100 2010-05-20 04:32:17Z  $
*/

$(document).ready(function(){
	$.ajaxSetup({cache:false});
	
	$('.subMenu').hide();
	$('#'+helpShowMenu).addClass('active').next().show(); 
	
	//On Click
	$('.subTitle').click(function(){
		if( $(this).next().is(':hidden') ) { 
			$('.subTitle').removeClass('active').next().slideUp(); //Remove all .acc_trigger classes and slide up the immediate next container
			$(this).toggleClass('active').next().slideDown(); //Add .acc_trigger class to clicked trigger and slide down the immediate next container
		}
		return false; //Prevent the browser jump to the link anchor
	});
});
