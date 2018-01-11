$( document ).ready(function() {
	
	
	$('.dropify').dropify({
		tpl: {
			wrap:'<div class="dropify-wrapper" style="height: 93px; width:285px"></div>'
		},
		messages: {
			'default': '285 x 93',
			'replace': '',
			'remove':  'Remover',
			'error':   ''
		},
		error: {
			'fileSize': 'Arquivo muito grande ({{ value }} max).',
			'minWidth': 'Largura minima permitida ({{ value }}px).',
			'maxWidth': 'Largura máxima permitida ({{ value }}px).',
			'minHeight': 'Altura minima permitida ({{ value }}px).',
			'maxHeight': 'Altura maxima permitida ({{ value }}px).',
			'imageFormat': 'Somente os formatos ({{ value }} são permitidos).'
		}
	});
	
	$('#grupo_form').validate({
		rules: {
			nm_grupo: {
				minlength: 1,
				maxlength: 50,
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
		}
	});
	
});

$(function () {
$('[data-mask]').inputmask()
})