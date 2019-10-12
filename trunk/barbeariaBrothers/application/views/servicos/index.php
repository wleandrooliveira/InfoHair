
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Servi&ccedil;os</h1>

			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive" id="tabServ">
					<!-- Table data -->
				</div>
				<!-- /tabServ -->

				<!-- Modal de confirmação de Exclusão -->
				<div class="modal fade" id="confirm-delete" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4>Aten&ccedil;&atilde;o!</h4>
							</div>
							<div class="modal-body">
								<label>Deseja realmente excluir este servi&ccedil;o?</label>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger"
									data-dismiss="modal">
									<i class="fa fa-times"></i> N&atilde;o
								</button>
								<button class="btn btn-success" id="btnOk">
									<i class="fa fa-check"></i> Sim
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Fim Modal -->
			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="text-center">
				<a href="<?= base_url() ?>servicos/form"><button type="button"
						class="btn btn-lg btn-primary">
						<i class=" fa fa-plus"></i> Cadastrar
					</button></a>
			</div>
		</div>
		<!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->