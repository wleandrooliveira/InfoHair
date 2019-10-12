var saldo = 0;
var msgs = 0;

$(document).ready(function() {
	
	if($(document).has("#tabMsg").length) {
		loadTable();
	}
	
	$('#btnSend').click(function() {		
		if(saldo > 0 && msgs <= saldo) {
			$.ajax({
				type: 'GET',
				dataType: 'html',
				url: 'sendAll',
				success: function(data) {
					loadTable();
					console.log(data);
					if(data) {
						snack('Mensagens Enviadas com Sucesso!', 'success');
					} else {
						snack('Algumas Mensagens Apresentaram Erro ao Serem Enviadas!', 'warning');
					}
				},
				error: function(data) {
					console.log(data);
					snack('Erro não identificado!', 'danger');
				},
				beforeSend: function() {
					$("body").css("cursor", "progress");
					snack('Enviando Mensagens, aguarde...', 'info');
				},
				complete: function() {
					$("body").css("cursor", "default");
				}
			});
			
		} else {
			snack('Créditos Insuficientes!', 'danger');
		}

	});
	
});

/** load index table **/
function loadTable() {
	$.get('table', function(data) {
		$('#tabMsg').html(data);
	});
	
	$.ajax({
		type: 'GET',
		dataType: 'html',
		url: 'getSaldo',
		success: function(data) {
//				console.log(data);
			$('#saldo').html(data);
			$('#totalMsg').html($('#nMsg').val());
			
			saldo = parseInt(data);
			msgs = parseInt($('#nMsg').val());
		},
		error: function(data) {
			console.log(data);
		}
	});
	
}
