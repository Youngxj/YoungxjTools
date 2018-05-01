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

	$("#form-wizard").formwizard({ 
		formPluginEnabled: true,
		validationEnabled: true,
		focusFirstInput : true,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){$("#submitted").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");},
			dataType: 'json',
			resetForm: true
		},
		validationOptions : {
			rules: {
				username: "required",
				password: "required",
				password2: {
					equalTo: "#password"
				},
				email: { required: true, email: true },
				eula: "required"
			},
			messages: {
				username: "Please enter your name or username",
				password: "You must enter the password",
				password2: { equalTo: "Password don't match" },
				email: { required: "Please, enter your email", email: "Correct email format is name@domain.com" },
				eula: "You must accept the eula"
			},
			errorClass: "help-inline",
			errorElement: "span",
			highlight:function(element, errorClass, validClass) {
			$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.form-group').removeClass('has-error');
			}
		}
	});	
});
