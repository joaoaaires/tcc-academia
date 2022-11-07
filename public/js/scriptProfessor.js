$(document).ready( function() {
	$("#formularioProfessor").validate({
		// Define as regras
		rules:{
			nome:{
				required: true,
			},
			cpf:{
				required: true,
				verificaCPF:true
			},
			nasc:{
				required: true,
				dateBR:true
			},
			sexo:{
				required: true
			},
			fone:{
				required: true
			},
		},
		
		// Define as mensagens de erro para cada regra
		messages:{
			nome:{
				required: "Digite o seu nome"
			},
			cpf:{
				required: "Digite o seu CPF"
			},
			nasc:{
				required: "Digite sua Data de Nascimento"
			},
			sexo:{
				required: "Escolha uma das opções"
			},
			fone:{
				required: "Digite seu telefone para contato"
			}
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
	
	jQuery.validator.addMethod("verificaCPF", function(value, element) {
    	value = value.replace('.','');
    	value = value.replace('.','');
    	cpf = value.replace('-','');
    	while(cpf.length < 11) cpf = "0"+ cpf;
    	var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    	var a = [];
    	var b = new Number;
    	var c = 11;
    	for (i=0; i<11; i++){
        	a[i] = cpf.charAt(i);
	        if (i < 9) b += (a[i] * --c);
   		 }
   		 if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
    		b = 0;
    		c = 11;
    	for (y=0; y<10; y++) b += (a[y] * c--);
    		if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
    		if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) return false;
    return true;
}, "Informe um CPF válido."); // Mensagem padrão

jQuery.validator.addMethod("dateBR", function(value, element) {
     //contando chars
    if(value.length!=10) return false;
    // verificando data
    var data        = value;
    var dia         = data.substr(0,2);
    var barra1      = data.substr(2,1);
    var mes         = data.substr(3,2);
    var barra2      = data.substr(5,1);
    var ano         = data.substr(6,4);
    if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)return false;
    if((mes==4||mes==6||mes==9||mes==11)&&dia==31)return false;
    if(mes==2 && (dia>29||(dia==29 && ano % 4 != 0 || ano % 100 == 0 && ano % 400 != 0)))return false;
    if(ano < 1900)return false;
    return true;
}, "Informe uma data válida");  // Mensagem padrão
});

//jQuery.validator.addMethod("verificaFone", function(value, element, param) {
//    return this.optional(element) || /^[0-9]{8}$/.test(value);
//},"Digite seu numero.");

jQuery(function($){
$("#cpf").mask("999.999.999-99");
$("#nasc").mask("99/99/9999");
$("#fone").mask("(999)9999-9999");
});