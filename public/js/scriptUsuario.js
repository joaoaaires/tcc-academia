$(document).ready( function() {
	$("#formularioUsuario").validate({
		// Define as regras
		rules:{
			nome:{
				// nome será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 10
			},
			login:{
				// login será obrigatório (required) e precisará ser um e-mail válido (email)
				required: true, minlength: 5
			},
			senha:{
				// senha será obrigatório (required) e terá tamanho mínimo (minLength)
				required: true, minlength: 4
			}
		},
		
		highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('Ok!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			},
		// Define as mensagens de erro para cada regra
		messages:{
			nome:{
				required: "Digite o seu nome",
				minLength: "O seu nome deve conter, no mínimo, 10 caracteres"
			},
			login:{
				required: "Digite o seu login",
				minLength: "O seu login deve conter, no mínimo, 5 caracteres"
			},
			senha:{
				required: "Digite a sua senha",
				minLength: "A sua senha deve conter, no mínimo, 4 caracteres"
			}
		}
	});
});

function showSenha (ID) {
 if (document.getElementById(ID).type == "password") {
   document.getElementById(ID).type = "text";
 }
 else {
   document.getElementById(ID).type = "password";
 }
};