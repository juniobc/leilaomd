$( document ).ready(function() {
	
	$('#table_email').bootstrapTable({
		height: 200,
		columns: [
			{
				field: 'id',
				visible:false,
				align: 'center',
				valign: 'middle'
			}, 
			{
				field: 'state',
				checkbox: true,
				align: 'center',
				valign: 'middle'
			}, 
			{
				title: 'Descrição',
				field: 'descricao',
				align: 'center',
				valign: 'middle',
				sortable: true
			},
			{
				title: 'E-mail',
				field: 'email',
				align: 'center',
				valign: 'middle',
				sortable: true
			}
		],
		formatNoMatches:function(){return '';}				
	});
	
	$('#table_cidade').bootstrapTable({
		height: 200,
		columns: [
			{
				field: 'id',
				visible:false,
				align: 'center',
				valign: 'middle'
			}, 
			{
				field: 'state',
				checkbox: true,
				align: 'center',
				valign: 'middle'
			}, 
			{
				title: 'Estado',
				field: 'estado',
				align: 'center',
				valign: 'middle',
				sortable: true
			},
			{
				title: 'Cidade',
				field: 'cidade',
				align: 'center',
				valign: 'middle',
				sortable: true
			}
		],
		formatNoMatches:function(){return '';}				
	});
		
	$('#loja_form').validate({
		rules: {
			nm_loja: {
				required: true,
				maxlength: 50				
			},
			desc_atua_loja: {
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
			desc_empresa_loja: {
				required: true,
				maxlength: 255				
			},
			desc_valor_loja: {
				required: true,
				maxlength: 255				
			},
			desc_missao_loja: {
				required: true,
				maxlength: 255				
			},
			desc_visao_loja: {
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
	
	
	$('#table_listagem').bootstrapTable({
		url:'https://leilao.ml/admin/grupo/grupoJson',
		columns: [
			{
				field: 'cdLoja',
				visible:false,
				dataField: 'cdLoja'
			}, 
			{
				field: 'nmLoja',
				title: 'Nome',
				dataField: 'nmLoja',
				align: 'center',
				valign: 'middle'
			}, 
			{
				field: 'descAtuaLoja',
				title: 'Descrição da Atuação',
				dataField: 'descAtuaLoja',
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
			cadastra();
		
	});
	
	$("#btn_alterar").click(function(){
		
		if($('#grupo_form').valid())
			alterar();
		
	});
	
	$("#btn_excluir").click(function(){
		excluir();		
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

function cadastra(){
	
	$(".overlay").show();
	
	removeMsgs();
	
	var form_array = {};
	var table_email_array = {};
	
	$.each($("#loja_form").serializeArray(), function( index, value ) {
		form_array[ value['name']] = value['value'];
	});
	
	var table_email_array = {};
	var data_table_email = $('#table_email').bootstrapTable('getData');
	cont = 0;
	$.each(data_table_email, function(index, value) {
			table_email_array[cont] =  value;
			cont++;
	});
	
	$.post( document.location.origin+"/admin/loja/criar",{
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
	
	$('#cd_loja').val("");
	$('#loja_form').trigger("reset");
	$("#table_email").bootstrapTable('removeAll');
	$("#table_gpr").bootstrapTable('refresh');
	$("#btn_incluir").prop('disabled', false);
	$("#btn_alterar").prop('disabled', true);
	$("#btn_excluir").prop('disabled', true);
	
}