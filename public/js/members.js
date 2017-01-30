$(function() {

  $('.input-group.date').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    todayHighlight: true,
    readonly: true
  });
  
  $('#membersLink').on('click','.list-group-item.parent',function(e) {
			e.preventDefault();
      var id = $(this).data('id');
      $(this).siblings('.children-' + id).toggleClass('hide');
  });
	
	$('#image').on('change',function() {
		var image = document.getElementById('image');
		if (!image.files[0].name.match(/\.(jpg|jpeg|png|gif)$/))
		{
			alert('Please only upload image files');
			image.value = "";
		}
	});
	
	$('#image_2').on('change',function() {
		var image = document.getElementById('image_2');
		if (!image.files[0].name.match(/\.(jpg|jpeg|png|gif)$/))
		{
			alert('Please only upload image files');
			image.value = "";
		}
	});
	
	$('#pdf').on('change',function() {
		var image = document.getElementById('pdf');
		if (!image.files[0].name.match(/\.(pdf)$/))
		{
			alert('Please only upload pdf files');
			image.value = "";
		}
	});
});