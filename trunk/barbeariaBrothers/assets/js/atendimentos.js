$(document).ready(function() {
	var hasServico;
	if($(document).has("#tabAtend").length) {
		loadTable();
	}
	
	/** save atendimento data **/
	
	if($(document).has("#btnSave").length) {
		autocomplete('#cliente');
		autocomplete('#funcionario');
		autocomplete('#servico');
	}

	
	$('#btnSave').click(function() {
		
		/** Validation **/
		if($('#idCliente').val().length == "") {
			snack('Selecione um Cliente!', 'danger');
			$('#cliente').focus();
		} else if($('#idFuncionario').val() == "") {
			snack('Selecione um Funcionário!.', 'danger');
			$('#funcionario').focus();
		} else if(!$(document).has(".celQtd").length) {
			snack('Adicione no Mínimo Um Serviço!.', 'danger');
			$('#servico').focus();
		} else {
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: 'form',
				data: {
					cliente: $('#idCliente').val(),				
					funcionario: $('#idFuncionario').val()					
					},
				success: function(data) {
					console.log(data);
					if(data.sucesso == 1) {
						snack(data.ocorrencia, 'success');
						setTimeout(function(){ $(location).attr('href', 'index'); }, 3000);
						
					} else {
						snack(data.ocorrencia, 'danger');
					}
					
				},
				error: function(data) {
					snack('Falha no servidor!', 'danger');
//					console.log(data);
				}	
			});
		}
	});
	
	
	
});

/** load index table **/
function loadTable() {
	var url = $(location).attr('href');
	
	if(url.indexOf('atendimentos') >= 0) {
		url = 'table';
	} else {
		url = 'atendimentos/table';
	}
	
	$.get(url, function(data) {
		$('#tabAtend').html(data);
	});
}

/** load form table **/
function loadTableServico() {
	$.get('tableServico', function(data) {
		$('#listServico').html(data);
		
		
		$('.btnExcluir').click( function() {
			var url = $(this).data('url');
			
			$.get(url, function(data) {
				loadTableServico();
			});

			autocomplete('#servico');
		});
		
		var last;
		
		$('.celQtd').focus(function() {
			last = $(this).html();
		});
		
		$('.celQtd').blur(function() {			
			qtd = $(this).html();
			
			if($.isNumeric(qtd)) {
				
				if(qtd != last) {
					id = $(this).next().next().children().data('id');
					quantidade = parseInt(qtd);
					subtotal = parseFloat($(this).data('precobase')) * quantidade;
					
		           	$.ajax({
						type: 'POST',
						dataType: 'html',
						url: 'update',
						data: { idServico: id, 
							quantidade: quantidade,				
							subtotal: subtotal
						},
						success: function(data) {
							loadTableServico();
							$('#servico').val("").trigger("change");
							autocomplete('#servico');
						},
						error: function(data) {
							console.log(data);
						}	
					});
				}
				
		   } else {
			   $(this).html(1);
			   snack('Apenas Números!', 'warning');
		   }
		});			

	});
	
	$.get('get/total', function(data) {
		if(data == "")
			data = "0,00";
		
		$('#total').html("R$ " + data.replace('.', ','));
	});
}

function autocomplete(input) {
	var field = input.replace('#', '');
	var desc = $(input).val();
	var inList = "";
	var inputId;
	
	switch(input) {
	case '#cliente': inputId = '#idCliente'; break;
	case '#funcionario': inputId = '#idFuncionario'; break;
	case '#servico': 
		$.get('get/inList', function(data) {
			inList = data;
		});
		break;
	}
	
	var options = {

		    url: "autocomplete",
		    
		    theme: "blue-light",
		    
		    ajaxSettings: {
		        dataType: "json",
		        method: "POST",
		        data: {
		          dataType: "json"
		        }
		      },

		      preparePostData: function(data) {
		    	data.field = field;
		        data.desc = desc;
		        data.inList = inList;
		        return data;
		      },

		    getValue: function(element) {
		        return element.value;
		    },

		    list: {
				maxNumberOfElements: 5,
				match: {
					enabled: true
				},
		    	onChooseEvent: function() {
		            var id = $(input).getSelectedItemData().id;
		            
		            if(input != '#servico') {
			            $(inputId).val(id).trigger("change");
		            } else {
		            	var subtotal = $(input).getSelectedItemData().subtotal;
		            	
		            	$.ajax({
							type: 'POST',
							dataType: 'html',
							url: 'insert',
							data: { idServico: id, 
								quantidade: 1,				
								subtotal: subtotal
							},
							success: function(data) {
//								console.log(data);
								loadTableServico();
								$(input).val("").trigger("change");
								autocomplete('#servico');
								$('#servico').focus();
							},
							error: function(data) {
								console.log(data);
							}	
						});
		            	
		            }
		        },
		        /*onHideListEvent: function() {
		        	
		    	},*/
		    	showAnimation: {
					type: "slide", //normal|slide|fade
					time: 400,
					callback: function() {}
				},

				hideAnimation: {
					type: "slide", //normal|slide|fade
					time: 400,
					callback: function() {}
				}
		    }
		};

		$(input).easyAutocomplete(options);
}
