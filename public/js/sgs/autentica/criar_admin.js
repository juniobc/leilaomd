$( document ).ready(function() {
	
	
});

var validator = $( "#usuario_form" ).validate({
	rules: {
		cpf_usr: {
			required: true,
			digits: true,
			minlength: 11,
			maxlength: 11
		},
		email_usr: {
			required: true,
			email: true,
			maxlength: 128
		},
		nm_usr: {
			required: true,
			maxlength: 150			
		},
		sbr_nm_usr: {
			maxlength: 150,
			required: true
		},
		rg_usr: {
			maxlength: 8,
			required: true,
			digits: true
		},
		uf_rg_usr: {
			maxlength: 2,
			required: true
		},
		orgao_rg_usr: {
			maxlength: 20,
			required: true
		},
		senha_usr: {
			minlength: 6,
			maxlength: 64,
			required: true
		},
		confirm_senha_usr: {
			minlength: 6,
			maxlength: 64,
			equalTo: "#senha_usr",
			required: true
		}
	},
	groups: {
		inputGroup: "rg_usr uf_rg_usr orgao_rg_usr"
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
		if(error[0].id == "inputGroup-error"){
			error.attr('class', 'help-block col-xs-offset-3 col-xs-9');
			error.insertAfter(element.parent().parent().children().last())
		}else{
			
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
			
		}
		
	},
	submitHandler: function(form) {
        $(".overlay").show();
		$("#usuario_form")[0].submit(); 
    }
});