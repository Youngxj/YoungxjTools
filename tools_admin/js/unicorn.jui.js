/**
 * Unicorn Admin Template
 * Version 2.2.0
 * Diablo9983 -> diablo9983@gmail.com
**/
$(function(){
	// UI Dialog
     $("#dialog").dialog({
		autoOpen: false,
		resizeable: false,
		buttons: {
			"Ok": function () {
				$(this).dialog("close");
			},
			"Cancel": function () {
				$(this).dialog("close");
			}
		},
		show: {
			effect: "puff",
			duration: 500
		},
		hide: {
			effect: "puff",
			duration: 500
		}
	});

     // Modal Dialog message
	$("#modal-dialog").dialog({
		autoOpen: false,
		modal: true,
		resizeable: false,
		buttons: {
			Ok: function () {
				$(this).dialog("close");
			}
		},
		show: {
			effect: "drop",
			duration: 400,
			direction: "up"
		},
		hide: {
			effect: "drop",
			duration: 400,
			direction: "down"
		}
	});
	$("#open-dialog").click(function(){
		$("#dialog").dialog("open");
		return false;
	});
	$("#open-modal").click(function(){
		$("#modal-dialog").dialog("open");
		return false;
	})

	// Datepicker
	$('#ui-datepicker').datepicker({
		defaultDate: "+1w",
		numberOfMonths: 2,
		onClose: function( selectedDate ) {
			$( "#ui-datepicker-2" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$('#ui-datepicker-2').datepicker({
		defaultDate: "+1w",
		numberOfMonths: 2,
		onClose: function( selectedDate ) {
			$( "#ui-datepicker" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	$('#ui-datepicker-inline').datepicker();

	// Horizontal Slider
	$('#h-slider').slider({
		range: true,
		values: [17, 67]
	});
	$('#h-slider-2').slider({
		range: true,
		values: [4, 75]
	});
	$('#h-slider-3').slider({
		range: true,
		values: [45, 97]
	});
	$('#h-slider-4').slider({
		range: true,
		values: [25, 37]
	});
	$('#h-slider-5').slider({
		range: true,
		values: [3, 27]
	});

	// Vertical sliders
	$( "#eq > span" ).each(function() {
		// read initial values from markup and remove that
		var value = parseInt( $( this ).text(), 10 );
		$( this ).empty().slider({
			value: value,
			range: "min",
			animate: true,
			orientation: "vertical"
		});
	});

    // Autocomplete
    var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];
     
    $("#tags").autocomplete({
    	source: availableTags
    });

    // Menu
    $("#menu").menu();

    // Accordion
    $( "#accordion" ).accordion({
        header: '.widget-title',
        animation: "easeInOutBounce",
        collapsible: true,
        heightStyle: "content"
    });

    $('.col-grid').sortable({
    	connectWith: '.col-grid',
    	placeholder: "ui-state-highlight"
    });

    // Spinner
	var spinner = $( "#spinner" ).spinner();
	 
	$( "#disable" ).click(function() {
		if ( spinner.spinner( "option", "disabled" ) ) {
			spinner.spinner( "enable" );
		} else {
			spinner.spinner( "disable" );
		}
	});
	$( "#destroy" ).click(function() {
		if ( spinner.data( "ui-spinner" ) ) {
			spinner.spinner( "destroy" );
		} else {
			spinner.spinner();
		}
	});
	$( "#getvalue" ).click(function() {
		alert( spinner.spinner( "value" ) );
	});
	$( "#setvalue" ).click(function() {
		spinner.spinner( "value", 5 );
	});
});