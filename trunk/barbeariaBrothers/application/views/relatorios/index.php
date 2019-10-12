		<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Relat&oacute;rios
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
                                                
                <div class="row">
                	<form action="">
						
						<div class="form-group">
							<div class="panel panel-red">
								<div class="panel-heading"><i class="fa fa-table"></i> <label>Configura&ccedil;&otilde;es</label></div>
								<div class="panel-body">
									<div class="form-group">
										<label>Tipo</label>
										<select class="form-control" id="relatorio" required>
											<option value="">Selecione...</option>						
											<option value="dia">Atendimento Geral Detalhado por Dia</option>
											<option value="servico">Atendimento Detalhado por Servi&ccedil;o</option>
											<option value="funcionario">Atendimentos Detalhado por Funcion&aacute;rios</option>
											<option value="mensagem">Hist&oacute;rico Mensagens</option>
										</select>
									</div>
									
									<div class="form-group">
										<label>Per&iacute;odo</label>
										<input id="periodo" class="form-control" type="text" value="">
										<p class="text-muted pull-right"><span id="intervalo">5</span> Dia(s)</p>									
									</div>
									
									<div class="text-center">
	                					<button id="btnGenerate" type="button" class="btn btn-lg btn-primary"><i class="fa fa-gear"></i> Gerar Relat&oacute;rio</button>
	                				</div>
								</div>
							</div> <!-- end panel -->
						</div>
				
					</form>
                </div>
				<!-- /.row -->

                <div class="row" id="relPanel">
					<div class="col-lg-12">
					<div class="panel panel-default">
					  <div class="panel-body">
					    <div class="table-responsive" id="tabRelatorio">
							<!-- Table data -->
                        </div>
                        <!-- /tabRelatorio -->
					  </div>
					</div>
                     </div>
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->