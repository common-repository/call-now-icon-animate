jQuery(document).ready(function($){
    $('.cnbm-color-field').wpColorPicker();
    $('.cnbm-color-field-hover').wpColorPicker();
	$("#settings").hide();
	$(".minus").hide();;
	$("h4.cnbm_settings").click(function() {
		$("#settings").slideToggle();
		$(".plus").toggle();
		$(".minus").toggle();
	});
});