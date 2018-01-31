$( document ).ready(function() {
	
	$("#main-sidebar").height($("#box_overlay").height());
	
});

jQuery.extend(jQuery.validator.messages, {
    required: "Este campo não pode ser vazio",
    remote: "Please fix this field.",
    email: "Porfavor informe um e-mail valido.",
    url: "URL inválida.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Informe somente números.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Campos diferentes.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Tamanho do campo inválido."),
    minlength: jQuery.validator.format("Tamanho do campo inválido."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );