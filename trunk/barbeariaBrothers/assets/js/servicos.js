$(document).ready(function() {
	
	if($(document).has("#tabServ").length) {
		loadTable();
	}
	
	$('#btnSave').click(function() {
		
		/** Validation **/
		if($('#servico').val().length < 3) {
			snack('Servi&ccedil;o inv&aacute;lido! M&iacute;nimo: 3 letras.', 'warning');
			$('#servico').focus();
		} else if($('#preco').val() == length < 12) {
			snack('Pre&ccedil;o inv&aacute;lido!.', 'warning');
		}  else {
	
			if($(this).data('action') == 'Cadastrar') {
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: 'form',
					data: {servico: $('#servico').val(),
							preco: $('#preco').val(),
						},
					success: function(data) {
						console.log(data);
						if(data == 1) {
							snack('Servi&ccedil;o cadastrado!', 'success');
							setTimeout(function(){ $(location).attr('href', 'index'); }, 3000);
							
						} else {
							snack('Falha ao cadastrar!', 'danger');
						}
						
					},
					error: function(data) {
						snack('Falha no servidor!', 'danger');
						console.log(data);
					}	
				});
			} else { //Editar
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: 'form',
					data: { idServico: $('#idServico').val(), 
						servico: $('#servico').val(),				
						preco: $('#preco').val(),
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
			
});

/** load index table **/
function loadTable() {
	$.get('table', function(data) {
		$('#tabServ').html(data);

		$('.btnExcluir').click( function() {
			var url = $(this).data('url');
			
			$('#btnOk').click(function() {

				$.get(url, function(data) {
					if(data == 1) { //success
						snack('Servi&ccedil;o exclu&iacute;do com sucesso!', 'success');
					} else { //Fail
						snack('Falha ao excluir servi&ccedil;o!', 'danger');
					}
					
					$('#confirm-delete').modal('hide');
					loadTable();
				});
				
			});

		});

	});
}