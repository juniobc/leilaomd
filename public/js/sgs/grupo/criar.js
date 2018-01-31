$( document ).ready(function() {
		
	$('#grupo_form').validate({
		rules: {
			nm_grupo: {
				required: true,
				maxlength: 50				
			},
			desc_atua_gpr: {
				required: true,
				maxlength: 255				
			},
			nr_tel_fixo: {
				required: true,
				maxlength: 18				
			},
			nr_tel_whats: {
				required: true,
				maxlength: 19				
			},
			link_facebook: {
				required: true,
				maxlength: 150
			},
			link_instagram: {
				required: true,
				//url: true,
				maxlength: 150				
			},
			link_google_plus: {
				required: true,
				//url: true,
				maxlength: 150				
			},
			link_you_tube: {
				required: true,
				//url: true,
				maxlength: 150				
			},
			link_pinterest: {
				required: true,
				//url: true,
				maxlength: 150				
			},
			link_twitter: {
				required: true,
				//url: true,
				maxlength: 150				
			},
			desc_empresa_gpr: {
				required: true,
				maxlength: 255				
			},
			desc_valor_gpr: {
				required: true,
				maxlength: 255				
			},
			desc_missao_gpr: {
				required: true,
				maxlength: 255				
			},
			desc_visao_gpr: {
				required: true,
				maxlength: 255				
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
		submitHandler: function(form, ww) {
			$("grupo_form").submit(function(e){
				e.preventDefault();
			});
			//cadastraGrupo();
		}
	});
	
	var cont = 0;
	
	$('#add_email').click(function(){
		
		$('#desc_email').rules('add', { 
			required: true
		});
		
		$('#end_email').rules('add', { 
			required: true,
			email: true,
			maxlength: 128
		});
		
		$('#desc_email').valid();
		$('#end_email').valid();
		
		if($('#desc_email').valid() && $('#end_email').valid()){
			
			$('#table_email').bootstrapTable(
				'append', 
				[{id:'def_'+cont, descricao:$('#desc_email').val().toUpperCase(), email:$('#end_email').val().toUpperCase()}]
			);
			
			cont++;
			
			$('#desc_email').val(null);
			$('#end_email').val(null);
		}
		
		$('#desc_email').rules('remove');
		
		$('#end_email').rules('remove');
		
	});
	
	$('#remove_email').click(function(){
		
		var ids = $.map($('#table_email').bootstrapTable('getSelections'), function (row) {
			return row.id;
		});
		$('#table_email').bootstrapTable('remove', {
			field: 'id',
			values: ids
		});
		
	});
	
	/*$('.dropify').dropify({
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
			'minWidth': 'Largura minima permitida {{ value }}px.',
			'maxWidth': 'Largura máxima permitida {{ value }}px.',
			'minHeight': 'Altura minima permitida {{ value }}px.',
			'maxHeight': 'Altura maxima permitida {{ value }}px.',
			'imageFormat': 'Somente os formatos {{ value }} são permitidos.',
			'fileExtension': 'Somente os formatos {{ value }} são permitidos.'
		}
	});*/
	
	
	$('#table_gpr').bootstrapTable({
		url:'https://leilao.ml/admin/grupo/grupoJson',
		columns: [
			{
				field: 'cdGpr',
				visible:false,
				dataField: 'cdGpr'
			}, 
			{
				field: 'nmGpr',
				title: 'Nome',
				dataField: 'nmGpr',
				align: 'center',
				valign: 'middle'
			}, 
			{
				field: 'descAtuaGpr',
				title: 'Descrição da Atuação',
				dataField: 'descAtuaGpr',
				align: 'center',
				valign: 'middle'
			},
			{
				field: 'editar',
				title: 'Editar',
				align: 'center',
				events: operateEvents,
				formatter: operateFormatter
			}
		]
	});
	
	$('#btn_limpar').click(function(){
		limpar();
	});
	
	$("#btn_incluir").click(function(){
		
		if($('#grupo_form').valid())
			cadastraGrupo();
		
	});
	
	$("#btn_alterar").click(function(){
		
		if($('#grupo_form').valid())
			alterarGrupo();
		
	});
	
	$("#btn_excluir").click(function(){
		excluirGrupo();		
	});
	
	
});

window.operateEvents = {
	'click .edit': function (e, value, row, index) {
		buscarGrupo(row.cdGpr)
	}
};

function operateFormatter(value, row, index) {
	return [
		'<a class="edit" href="javascript:void(0)" title="Editar">',
		'<i class="glyphicon glyphicon-edit"></i>',
		'</a>'
	].join('');
}

$(function () {
$('[data-mask]').inputmask()
})

function buscarGrupo(cdGpr){
	
	$(".overlay").show();
	
	$.post( document.location.origin+"/admin/grupo/buscarGrupo",{
		cdGpr: cdGpr
	}).done(function( data ) {
		$(".overlay").hide();
		console.log(data);
		
		$("#cd_grupo").val(data.cdGpr);
		$("#nm_grupo").val(data.nmGpr);
		$("#desc_atua_gpr").val(data.descAtuaGpr);
		
		$("#desc_empresa_gpr").val(data.descEmpresaGpr);
		$("#desc_missao_gpr").val(data.descMissaoGpr);
		$("#desc_visao_gpr").val(data.descVisaoGpr);
		$("#desc_valor_gpr").val(data.descValorGpr);
		
		$.each(data.telefones, function(index, value){
			
			if(value.tpTel == '0'){
				$("#nr_tel_fixo").val(value.nrTel)
			}else if(value.tpTel == '1'){
				$("#nr_tel_whats").val(value.nrTel)
			}
			
		});
		
		$.each(data.midiasSocial, function(index, value){
			console.log(value.descMdSoc)	
			switch(value.descMdSoc){
				
				case 'FACEBOOK':
					$("#link_facebook").val(value.linkMdSoc);
					break;
					
				case 'INSTAGRAM':
					$("#link_instagram").val(value.linkMdSoc);
					break;
					
				case 'GOOGLE PLUS':
					$("#link_google_plus").val(value.linkMdSoc);
					break;
					
				case 'YOU TUBE':
					$("#link_you_tube").val(value.linkMdSoc);
					break;
					
				case 'PINTEREST':
					$("#link_pinterest").val(value.linkMdSoc);
					break;
					
				case 'TWITTER':
					$("#link_twitter").val(value.linkMdSoc);
					break;
				
			}
			
		});
		
		$('#table_email').bootstrapTable('removeAll');
		
		$.each(data.emails, function(index, value){
			
			$('#table_email').bootstrapTable(
				'append', 
				[{id:value.cdEmail, descricao:value.descEmail, email:value.endEmail}]
			);
			
		});
		
		habilitaEditar();
		
		
	}).fail(function(data) {
		$(".overlay").hide();
		console.log(data);
	});
	
}

function excluirGrupo(){
	
	$(".overlay").show();
	removeMsgs();
	
	$.post( document.location.origin+"/admin/grupo/excluir",{
		cd_grupo: $("#cd_grupo").val()
	}).done(function( data ) {
		$(".overlay").hide();
		console.log(data);
		if(data.cd_msg == '1'){
			$( "#msg_sucesso > p" ).remove();
			$( "#msg_sucesso" ).append('<p>' + data.desc_msg + '</p>');
			$( "#msg_sucesso" ).show();
			limpar();
		}else{
			$( "#msg_erro > p" ).remove();
			$( "#msg_erro" ).append('<p>' + data.desc_msg + '</p>');
			$( "#msg_erro" ).show();
		}		
	}).fail(function(data) {
		$(".overlay").hide();
		console.log(data);
	});
	
}

function alterarGrupo(){
	
	$(".overlay").show();
	removeMsgs();
	
	var form_array = {};
	var table_email_array = {};
	
	$.each($("#grupo_form").serializeArray(), function( index, value ) {
		form_array[ value['name']] = value['value'];
	});
	
	var table_email_array = {};
	var data_table_email = $('#table_email').bootstrapTable('getData');
	cont = 0;
	$.each(data_table_email, function(index, value) {
			table_email_array[cont] =  value;
			cont++;
	});
	
	$.post( document.location.origin+"/admin/grupo/alterar",{
		form_data: form_array,
		table_email_data:table_email_array
	}).done(function( data ) {
		$(".overlay").hide();
		console.log(data);
		if(data.cd_msg == '1'){
			$( "#msg_sucesso > p" ).remove();
			$( "#msg_sucesso" ).append('<p>' + data.desc_msg + '</p>');
			$( "#msg_sucesso" ).show();
			limpar();
		}else{
			$( "#msg_erro > p" ).remove();
			$( "#msg_erro" ).append('<p>' + data.desc_msg + '</p>');
			$( "#msg_erro" ).show();
		}		
	}).fail(function(data) {
		$(".overlay").hide();
		console.log(data);
	});
	
}

function cadastraGrupo(){
	
	$(".overlay").show();
	
	removeMsgs();
	
	var form_array = {};
	var table_email_array = {};
	
	$.each($("#grupo_form").serializeArray(), function( index, value ) {
		form_array[ value['name']] = value['value'];
	});
	
	var table_email_array = {};
	var data_table_email = $('#table_email').bootstrapTable('getData');
	cont = 0;
	$.each(data_table_email, function(index, value) {
			table_email_array[cont] =  value;
			cont++;
	});
	
	$.post( "",{
		form_data: form_array,
		table_email_data:table_email_array
	}).done(function( data ) {
		$(".overlay").hide();
		console.log(data);
		if(data.cd_msg == '1'){
			$( "#msg_sucesso > p" ).remove();
			$( "#msg_sucesso" ).append('<p>' + data.desc_msg + '</p>');
			$( "#msg_sucesso" ).show();
			limpar();
			//$("html, body").animate({ scrollTop: 0 }, 'slow');
		}else{
			$( "#msg_erro > p" ).remove();
			$( "#msg_erro" ).append('<p>' + data.desc_msg + '</p>');
			$( "#msg_erro" ).show();
		}
	}).fail(function(data) {
		$(".overlay").hide();
		console.log(data);
	});
	
}

function removeMsgs(){
	$( "#msg_sucesso" ).hide();
	$( "#msg_erro" ).hide();
	
	$( "#msg_sucesso > p" ).remove();
	$( "#msg_erro > p" ).remove();
}

function habilitaEditar(){
	
	$("#btn_incluir").prop('disabled', true);
	$("#btn_alterar").prop('disabled', false);
	$("#btn_excluir").prop('disabled', false);
	
}

function limpar(){
	
	$('#cd_grupo').val("");
	$('#grupo_form').trigger("reset");
	$("#table_email").bootstrapTable('removeAll');
	$("#table_gpr").bootstrapTable('refresh');
	$("#btn_incluir").prop('disabled', false);
	$("#btn_alterar").prop('disabled', true);
	$("#btn_excluir").prop('disabled', true);
	
}