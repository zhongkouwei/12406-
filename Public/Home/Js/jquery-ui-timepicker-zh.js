/* German translation for the jQuery Timepicker Addon */
/* Written by Marvin */
(function($) {
	$.timepicker.regional['zh'] = {
		closeText: '关闭',
		prevText: '上一个',
		nextText: '下一个',
		currentText: '当前',
		monthNames: ['01','02','03','04','05','06','07','08','09','10','11','12'],
		monthNamesShort:['一月','二月','三月','四月','五月','六月',
		         		                   		'七月','八月','九月','十月','十一月','十二月'],
		dayNames: ['日','一','二','三','四','五','六'],
		dayNamesShort: ['日','一','二','三','四','五','六'],
		dayNamesMin:  ['日','一','二','三','四','五','六'],
		dateFormat: 'yy-MM-dd',
		firstDay: 7,
		hourText: '时',
		minuteText: '分',
		timeText: '时间',
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.timepicker.setDefaults($.timepicker.regional['zh']);
})(jQuery);
