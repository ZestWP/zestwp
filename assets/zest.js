jQuery(document).ready( function($) {
	$('.lists tbody tr:even').addClass('alternate');
	$('a.trash').click(function() {
		return confirm('You are sure  to delete');
	});
	$('.multidelete').click(function(){
		return confirm('You are sure  to delete');
	});
	$(".mSelect").click(function () {
		  $('.case').attr('checked', this.checked);
		  $('.mSelect').attr('checked', this.checked);
	});
	$(".case").click(function(){
		if($(".case").length == $(".case:checked").length) {
			$(".mSelect").attr("checked", "checked");
		} else {
			$(".mSelect").removeAttr("checked");
		}
	});
	
	if(jQuery().datepicker) 
		$('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
	$('#form-campaign').submit(function(){
		if ( ! validateForm( $(this) ) )
			return false;
	});
	
});