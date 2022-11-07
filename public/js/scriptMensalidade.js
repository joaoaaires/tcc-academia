$(document).ready( function() {
	$("#formularioMensalidade").validate({
		// Define as regras
		rules:{
			mes:{
				required: true,
			},
			status:{
				required: true,
			},
			valor:{
				required: true,
			},
		},
		
		// Define as mensagens de erro para cada regra
		messages:{
			mes:{
				required: "Escolha um Mês"
			},
			status:{
				required: "Escolha Status"
			},
			valor:{
				required: "Valor em braco"
			},
		},
		// Troca de Classe e Cor
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
			element
			.text('').addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		}		
	});

	$("#formularioMedida").validate({
		// Define as regras
		rules:{
			altura:{
				required: true,
			},
			peso:{
				required: true,
			},
			brc_dir:{
				required: true,
			},
			brc_esq:{
				required: true,
			},
			peitoral:{
				required: true,
			},
			barriga:{
				required: true,
			},
			quadril:{
				required: true,
			},
			cx_dir:{
				required: true,
			},
			cx_esq:{
				required: true,
			},
			pnt_dir:{
				required: true,
			},
			pnt_esq:{
				required: true,
			},
		},
		
		// Define as mensagens de erro para cada regra
		messages:{
			altura:{
				required: "Error"
			},
			peso:{
				required: "Error"
			},
			brc_dir:{
				required: "Error"
			},
			brc_esq:{
				required: "Error"
			},
			peitoral:{
				required: "Error",
			},
			barriga:{
				required: "Error",
			},
			quadril:{
				required: "Error",
			},
			cx_dir:{
				required: "Error",
			},
			cx_esq:{
				required: "Error",
			},
			pnt_dir:{
				required: "Error",
			},
			pnt_esq:{
				required: "Error",
			},
		},
		// Troca de Classe e Cor
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
			element
			.text('').addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		}		
	});
});