$(document).ready(function() {
	var inicioPeriodo;
	var fimPeriodo;

	$('#relPanel').hide();
	
	if($(document).has("#periodo").length) {
		
		$(function() {
			
		    $('#periodo').daterangepicker({
		        	showDropdowns: true,
		        	autoApply: true,
		            startDate: moment().subtract(5, 'days'),
		            endDate: moment(),
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
		    		inicioPeriodo = start.format('YYYY-MM-DD');
		    		fimPeriodo = end.format('YYYY-MM-DD');
		    		
		    		$('#intervalo').html(moment(fimPeriodo, 'YYYY-MM-DD').diff(moment(inicioPeriodo, 'YYYY-MM-DD'), 'days')+1);
		    });
		    
		    inicioPeriodo = $('#periodo').data('daterangepicker').startDate.format('YYYY-MM-DD');
		    fimPeriodo = $('#periodo').data('daterangepicker').endDate.format('YYYY-MM-DD');
		});
	}

	
	$('#btnGenerate').click(function() {
		
		if($('#relatorio').val() == '') {
			snack('Escolha o tipo de relatório!', 'warning');
		} else if(moment(fimPeriodo, 'YYYY-MM-DD').diff(moment(inicioPeriodo, 'YYYY-MM-DD'), 'days')+1 < 5) {
			snack('Intervalo mínimo de 5 dias entre datas!', 'warning');
		} else {
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'generate',
				data: { tipo: $('#relatorio').val(), 
						dataInicio: inicioPeriodo,				
						dataFim: fimPeriodo
				},
				success: function(data) {
					$('#tabRelatorio').html(data);
					
					if($('#relatorio').val() != 'mensagem')
						$('tr:last-child').css('font-weight', 'bold');
					
					$('#relPanel').show();
					window.location.href = '#tabRelatorio';
				},
				error: function(data) {
					snack('Falha no servidor!', 'danger');
					console.log(data);
				}	
			});
		}
		
	});
	
});