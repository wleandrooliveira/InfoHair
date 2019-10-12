$(document).ready(function() {
	var dataNascimento;
	var telEmpty = true;
	
	if($(document).has("#tabClie").length) {
		loadTable();
	}
	
	$("#telefone").mask("(99) 99999-9999",{placeholder:"(__) _____-____"});
	
	if($(document).has("#dataNascimento").length) {
		$(function() {
			
		    $('#dataNascimento').daterangepicker({
		        	singleDatePicker: true,
		        	showDropdowns: true,
		        	locale: {
		                "format": "DD/MM/YYYY",
		                "separator": " - ",
		                "applyLabel": "Aplicar",
		                "cancelLabel": "Cancelar",
		                "fromLabel": "De",
		                "toLabel": "Até",
		                "customRangeLabel": "Custom",
		                "weekLabel": "W",
		                "daysOfWeek": [
		                    "Dom",
		                    "Seg",
		                    "Ter",
		                    "Qua",
		                    "Qui",
		                    "Sex",
		                    "Sab"
		                ],
		                "monthNames": [
		                    "Janeiro",
		                    "Fevereiro",
		                    "Março",
		                    "Abril",
		                    "Maio",
		                    "Junho",
		                    "Julho",
		                    "Agosto",
		                    "Setembro",
		                    "Outubro",
		                    "Novembro",
		                    "Dezembro"
		                ],
		                "firstDay": 1
		            }
		    	}, function(start, end, label) {
		    		dataNascimento = start.format('YYYY-MM-DD');
		    });
		    
		    dataNascimento = $('#dataNascimento').data('daterangepicker').startDate.format('YYYY-MM-DD');
		});
	}

	
	$('#btnSave').click(function() {
		
		/** Validation **/
		if($('#nome').val().length < 3) {
			snack('Nome inv&aacute;lido! M&iacute;nimo: 3 letras.', 'warning');
			$('#nome').focus();
		} else if($('#telefone').val() == '' && telEmpty == true) {
			    if (confirm("Telefone vazio! Deseja continuar?")) {
			    	telEmpty = false;
			    	snack('Clique no botão novamente!', 'info');
			    }
		} else {
			if($(this).data('action') == 'Cadastrar') {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: 'form',
					data: {nome: $('#nome').val(),
							telefone: $('#telefone').val(),
							dataNascimento: dataNascimento,
							idCliente: null
							},
					success: function(data) {
						//console.log(data);
						if(data.sucesso == 1) {
							snack(data.ocorrencia, 'success');
							setTimeout(function(){ $(location).attr('href', 'index'); }, 3000);
							
						} else {
							snack(data.ocorrencia, 'danger');
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
					dataType: 'JSON',
					url: 'form',
					data: { idCliente: $('#idCliente').val(), 
						nome: $('#nome').val(),				
						telefone: $('#telefone').val(),
						dataNascimento: dataNascimento
					},
					success: function(data) {
						//console.log(data);
						if(data.sucesso == 1) {
							snack(data.ocorrencia, 'success');
							setTimeout(function(){ $(location).attr('href', '../index'); }, 3000);
						} else {
							snack(data.ocorrencia, 'danger');
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
		$('#tabClie').html(data);

		$('.btnExcluir').click( function() {
			var url = $(this).data('url');
			
			$('#btnOk').click(function() {

				$.get(url, function(data) {
					if(data == 1) { //success
						snack('Cliente exclu&iacute;do com sucesso!', 'success');
					} else { //Fail
						snack('Falha ao excluir cliente!', 'danger');
					}
					
					$('#confirm-delete').modal('hide');
					loadTable();
				});
				
			});

		});

	});
}