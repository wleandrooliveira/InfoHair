				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Servi&ccedil;o(s)</th>
							<th>Funcion&aacute;rio</th>
							<th>Cliente</th>
							<th>Data</th>
							<th>Hora</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(count($atendimentos) > 0) {
								foreach ($atendimentos as $atend_item): ?>
									<tr>
										<td><?= $atend_item['servico'] ?></td>
										<td><?= $atend_item['funcionario'] ?></td>
										<td><?= $atend_item['cliente'] ?></td>
										<td><?= $atend_item['data'] ?></td>
										<td><?= $atend_item['hora'] ?></td>
										<td><strong>R$ <?= str_replace('.', ',', $atend_item['total']) ?></strong></td>
									</tr>
								<?php endforeach;
							} else { ?>
								<tr>
									<td colspan="6" class="text-center">Nenhum Atendimento Encontrado.</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>