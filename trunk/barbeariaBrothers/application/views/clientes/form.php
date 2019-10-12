		<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Clientes
                            <small><?= $action ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                	<form action="">
	                	<div class="form-group">
	                		<input id="idCliente" type="hidden" value="<?= isset($cliente_item['idCliente']) ? $cliente_item['idCliente'] : 0 ?>">
							<label>Nome</label>
							<input id="nome" class="form-control" type="text" required value="<?= isset($cliente_item['nome']) ? $cliente_item['nome'] : '' ?>">
	                    </div>
						<div class="form-group">
							<label>Telefone</label><br>
							<input id="telefone" type="text" name="telefone" class= "form-control" placeholder="(99) 99999-9999" value="<?= isset($cliente_item['telefone']) ? $cliente_item['telefone'] : '' ?>">
						</div>
						<div class="form-group">
							<label>Data de Nascimento</label>
							<input id="dataNascimento" class="form-control" type="text" value="<?= isset($cliente_item['dataNascimento']) ? $cliente_item['dataNascimento'] : '' ?>">
							
						</div>
						
						<button type="button" class="btn btn-success" id="btnSave" data-action=<?= $action ?>><?= $action == 'Cadastrar' ? '<i class="fa fa-plus"></i> Cadastrar' : '<i class="fa fa-edit"></i> Salvar' ?></button>
					</form>
                </div>
				<!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->