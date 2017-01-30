if (document.domain == 'localhost')
{
	var URL = 'http://localhost/running_club/';
}
else
{
	var URL = 'https://www.bearbrookrunningclub.co.uk/';
}


$(function() {
   
	$('.flexslider-other').flexslider({
      animation: "slide",
      startAt: 1,
      controlNav: false,
			slideshow: false
   });
	 
	 $('.flexslider-diary').flexslider({
      animation: "slide",
      startAt: $('#currentMonth').val(),
      controlNav: false,
			slideshow: false
   });
  
	$('.openwindow').on('click',function() {
		var url = $(this).data('url');
		window.location = url;
	});
	
	$('.delete').on('click',function(e) {
		e.stopPropagation();
		if (confirm('Are you sure?')) 
			return true;
		else
			return false;
	});
	
	//hide error message on focus
	$('input.text, textarea, select').on('focus',function() {
		$('.error').fadeOut();
	});
	
	$("form").validator({
		position: 'top left',
		offset: [-7, -5],
		messageAttr: 'data-message',
		message: '<div />' // em element is the arrow
	});

});