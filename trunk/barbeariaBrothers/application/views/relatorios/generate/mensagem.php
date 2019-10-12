				<h3 class="text-center"><strong>Relat&oacute;rio de Atendimentos por Dia de <?= $dataInicio ?> at&eacute; <?= $dataFim ?></strong></h3>
				<br>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th style="width: 15%;">Cliente</th>
							<th style="width: 10%;">Mensagem</th>
							<th style="width: 40%;">Texto</th>
							<th style="width: 5%;">Data</th>
							<th style="width: 15%;">Envio</th>
							<th style="width: 20%;">Situa&ccedil;&atilde;o</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(count($relatorios) > 0) {
								foreach ($relatorios as $relat_item): ?>
									<tr>
										<td><?= $relat_item['cliente'] ?></td>
										<td><?= $relat_item['tipo'] ?></td>
										<td><?= $relat_item['mensagem'] ?></td>
										<td class="text-center"><?= $relat_item['data'] ?></td>
										<td class="text-center"><?= $relat_item['dataEnvio'] ?></td>
										<td title="<?= $relat_item['descMisterPostman'] ?>"><button class="btn-circle circle-<?= $status[$relat_item['situacao']]['class'] ?>"><i class="fa fa-<?= $status[$relat_item['situacao']]['icon'] ?>"></i></button><strong class="text-left"> <?= $relat_item['situacao'] ?></strong></td>
									</tr>
								<?php endforeach;
							} else { ?>
								<tr>
									<td colspan="6" class="text-center">Dados insuficientes para gerar relatório.</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>