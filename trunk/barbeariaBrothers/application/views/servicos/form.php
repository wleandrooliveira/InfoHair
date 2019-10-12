
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Servi&ccedil;os <small><?= $action ?></small>
				</h1>

			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<form action="">
				<div class="form-group">
					<input id="idServico" type="hidden"
						value="<?= isset($servico_item['idServico']) ? $servico_item['idServico'] : 0 ?>">
					<label>Servi&ccedil;o</label>
					<input id="servico"class="form-control" type="text" required value="<?= isset($servico_item['descricao']) ? $servico_item['descricao'] : '' ?>">
				</div>
				<label>Pre&ccedil;o</label><br>
				<div class="form-group input-group">
					<span class="input-group-addon">R$</span>
					<input id="preco" type="text" name="preco" class="form-control" required value="<?= isset($servico_item['precoBase']) ? $servico_item['precoBase'] : '' ?>">
					<span class="input-group-addon">,00</span>
				</div>

				<button type="button" class="btn btn-success" id="btnSave"
					data-action=<?= $action ?>><?= $action == 'Cadastrar' ? '<i class="fa fa-plus"></i> Cadastrar' : '<i class="fa fa-edit"></i> Salvar' ?></button>
			</form>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->