$(document).ready( function() {
	$("#formularioAgenda").validate({
		// Define as regras
		rules:{
			data:{
				required: true,
			},
			hora:{
				required: true,
			},
			descricao:{
				required: true,
			},
			cliente:{
				required: true,
			},
			professor:{
				required: true,
			},
		},
		
		// Define as mensagens de erro para cada regra
		messages:{
			data:{
				required: "<i class='icon-remove'></i>",
			},
			hora:{
				required: "<i class='icon-remove'></i>",
			},
			descricao:{
				required: "<i class='icon-remove'></i>",
			},
			cliente:{
				required: "<i class='icon-remove'></i>",
			},
			professor:{
				required: "<i class='icon-remove'></i>",
			},
		},
		// Troca de Classe e Cor
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
			element
			.text("").addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		}		
	});
});