var validator = $( "#login_form" ).validate({
	rules: {
		cpf_usr: {
			required: true,
			digits: true,
			minlength: 11,
			maxlength: 11
		},
		senha_usr: {
			minlength: 6,
			maxlength: 64,
			required: true
		}
	},
	highlight: function(element) {
		$(element).closest('.form-group').addClass('has-error');
	},
	unhighlight: function(element) {
		$(element).closest('.form-group').removeClass('has-error');
	},
	errorElement: 'span',
	errorClass: 'help-block',
	errorPlacement: function(error, element) {
			
		if(element.parent('.input-group').length) {
			error.insertAfter(element.parent());
		} else {
			error.insertAfter(element);
		}
		
	},
	submitHandler: function(form) {
        $(".overlay").show();
		$("#login_form")[0].submit(); 
    }
});