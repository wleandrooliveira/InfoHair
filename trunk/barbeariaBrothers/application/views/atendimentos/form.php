		<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Atendimento
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                	<form action="">
                	
	                	<div class="form-group">
							<div class="panel panel-primary">
								<div class="panel-heading"><label>Cliente</label></div>
								<div class="panel-body">
									<input id="idCliente" type="hidden">
									<input id="cliente" class="form-control" type="text" required placeholder="Nome ou Telefone...">
								</div>
								<a target="_blank" href="<?= base_url() ?>clientes/form">
									<div class="panel-footer">
										<span class="pull-left"><i class="fa fa-plus-circle"></i><strong> Novo Cliente</strong></span>
	                                    <div class="clearfix"></div>
									</div>
								</a>
							</div> <!-- end panel -->
	                    </div>
	                    
						<div class="form-group">
							<div class="panel panel-primary">
									<div class="panel-heading"><label>Funcion&aacute;rio</label></div>
									<div class="panel-body">
										<input id="idFuncionario" type="hidden">
										<input id="funcionario" class="form-control" type="text" required placeholder="Nome...">
									</div>
								</div> <!-- end panel -->
						</div>
						
						<div class="form-group">
							<div class="panel panel-primary">
								<div class="panel-heading"><label>Servi&ccedil;o</label></div>
								<div class="panel-body">
									<input id="servico" class="form-control" type="text" placeholder="Descrição...">
									
									<div class="table-responsive" id="listServico" style="margin-top: 15px;">
										<!-- servicos -->
									</div> <!-- table responsive -->
								</div> <!-- panel-body -->
								
								<div class="panel-footer">
									<h4 class="text-right" style="margin-right: 20%;">Total: <strong id="total">R$ 0,00</strong></h4>
								</div>
							</div> <!-- End Panel -->
							
						</div>
						
						<button type="button" class="btn btn-lg btn-success center-block" id="btnSave" ><i class="fa fa-save"></i> Salvar</button>
					</form>
                </div> <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->