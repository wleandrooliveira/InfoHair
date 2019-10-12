$(document).ready(function() {
	
	if($(document).has("#tabFunc").length) {
		loadTable();
	}
	
	/** save funcionario data **/
	if($('#perfil').val() == 'socio') {
		$('#senhaGroup').show();
	} else {
		$('#senhaGroup').hide();	
	}
	
	$('#btnSave').click(function() {
		
		/** Validation **/
		if($('#nome').val().length < 3) {
			snack('Nome inv&aacute;lido! M&iacute;nimo: 3 letras.', 'warning');
			$('#nome').focus();
		} else if($('#perfil').val() == "") {
			snack('Selecione um perfil!.', 'warning');
		} else if($('#perfil').val() == 'socio' && $('#senha').val().length < 4) {
			snack('Senha inv&aacute;lida!.', 'warning');
			$('#senha').focus();
		} else {
	
			if($(this).data('action') == 'Cadastrar') {
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: 'form',
					data: {nome: $('#nome').val(),
							perfil: $('#perfil').val(),
							senha: $('#senha').val()
							},
					success: function(data) {
	//					console.log(data);
						if(data == 1) {
							snack('Funcion&aacute;rio cadastrado!', 'success');
							setTimeout(function(){ $(location).attr('href', 'index'); }, 3000);
							
						} else {
							snack('Falha ao cadastrar!', 'danger');
						}
						
					},
					error: function(data) {
						snack('Falha no servidor!', 'danger');
	//					console.log(data);
					}	
				});
			} else { //Editar
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: 'form',
					data: { idFuncionario: $('#idFuncionario').val(), 
						nome: $('#nome').val(),				
						perfil: $('#perfil').val(),
						senha: $('#senha').val()
					},
					success: function(data) {
						console.log(data);
						if(data == 1) {
							snack('Altera&ccedil;&otilde;es salvas!', 'success');
							setTimeout(function(){ $(location).attr('href', '../index'); }, 3000);
						} else {
							snack('Falha ao cadastrar!', 'danger');
						}
						
					},
					error: function(data) {
						snack('Falha no servidor!', 'danger');
						console.log(data);
					}	
				});
			}
		}
	});
	
	$('#perfil').change(function() {
		if($(this).val() == 'socio') {
			$('#senhaGroup').show();
		} else {
			$('#senhaGroup').hide();
			$('#senha').val("");
		}
		
	});
	
	
});

/** load index table **/
function loadTable() {
	$.get('table', function(data) {
		$('#tabFunc').html(data);

		$('.btnExcluir').click( function() {
			var url = $(this).data('url');
			
			$('#btnOk').click(function() {

				$.get(url, function(data) {
					if(data == 1) { //success
						snack('Funcion&aacute;rio exclu&iacute;do com sucesso!', 'success');
					} else { //Fail
						snack('Falha ao excluir funcion&aacute;rio!', 'danger');
					}
					
					$('#confirm-delete').modal('hide');
					loadTable();
				});
				
			});

		});

	});
}