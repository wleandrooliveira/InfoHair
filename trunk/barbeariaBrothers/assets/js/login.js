$(document).ready(function() {
	
	$('#btnLogin').click(function(){
		
		if($('#username').val() == '') {
			snack('Preencha o nome de usuário!', 'warning');
		} else if($('#passwd').val() == '') {
			snack('Preencha a senha!', 'warning');
		} else { //Login
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: 'index',
				data: {
					username: $('#username').val(),
					passwd: $('#passwd').val()
						},
				success: function(data) {
					console.log(data);
					
					if(data.sucesso == 1) {
						$(location).attr('href', '../home/index');
						
					} else {
						snack(data.ocorrencia, 'danger');
					}
					
				},
				error: function(data) {
					snack('Falha no servidor!', 'danger');
//						console.log(data);
				}	
			});
		}
	});
	
});