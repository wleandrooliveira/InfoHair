		<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Funcion&aacute;rios
                            <small><?= $action ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                	<form action="">
	                	<div class="form-group">
	                		<input id="idFuncionario" type="hidden" value="<?= isset($funcionario_item['idFuncionario']) ? $funcionario_item['idFuncionario'] : 0 ?>">
							<label>Nome</label>
							<input id="nome" class="form-control" type="text" required value="<?= isset($funcionario_item['nome']) ? $funcionario_item['nome'] : '' ?>">
	                    </div>
						<div class="form-group">
							<label>Perfil</label>
							<select class="form-control" id="perfil" required>
								<option value="">Selecione...</option>						
								<option value="atendente" <?php if($funcionario_item['perfil'] == 'Atendente') echo 'selected' ?>>Atendente</option>
								<option value="socio" <?php if($funcionario_item['perfil'] == 'Sócio') echo 'selected' ?>>S&oacute;cio</option>
							</select>
						</div>
						<div class="form-group" id="senhaGroup">
							<label>Senha</label>
							<input id="senha" class="form-control" type="password">
							<p class="help-block">Senha deve conter no mínimo 4 caracteres.</p>
						</div>
						
						<button type="button" class="btn btn-success" id="btnSave" data-action=<?= $action ?>><?= $action == 'Cadastrar' ? '<i class="fa fa-plus"></i> Cadastrar' : '<i class="fa fa-edit"></i> Salvar' ?></button>
					</form>
                </div>
				<!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->