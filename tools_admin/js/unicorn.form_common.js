/**
 * Unicorn Admin Template
 * Version 2.2.0
 * Diablo9983 -> diablo9983@gmail.com
**/
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio]').iCheck({
    	checkboxClass: 'icheckbox_flat-blue',
    	radioClass: 'iradio_flat-blue'
	});
	
	$('select').select2();
    $('.colorpicker').colorpicker();
    $('.datepicker').datepicker();
    $('.spinner').spinner();

});
