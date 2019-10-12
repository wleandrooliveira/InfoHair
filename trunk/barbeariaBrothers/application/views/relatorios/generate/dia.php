				<h3 class="text-center"><strong>Relat&oacute;rio de Atendimentos por Dia de <?= $dataInicio ?> at&eacute; <?= $dataFim ?></strong></h3>
				<br>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Dia</th>
							<th>Total de Clientes</th>
							<th>Total de Servi&ccedil;os</th>
							<th>Valor Total</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(count($relatorios) > 0) {
								foreach ($relatorios as $relat_item): ?>
									<tr>
										<td><?= $relat_item['dia'] ?></td>
										<td><?= $relat_item['qtdCliente'] ?></td>
										<td><?= $relat_item['qtdServico'] ?></td>
										<td><strong>R$ <?= str_replace('.', ',', $relat_item['totalDia']) ?></strong></td>
									</tr>
								<?php endforeach;
							} else { ?>
								<tr>
									<td colspan="4" class="text-center">Dados insuficientes para gerar relatório.</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>