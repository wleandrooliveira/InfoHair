				<input type="hidden" value="<?= count($mensagens) ?>" id="nMsg">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th style="width: 15%;">Cliente</th>
							<th style="width: 10%;">Mensagem</th>
							<th style="width: 50%;">Texto</th>
							<th style="width: 5%;">Data</th>
							<th style="width: 10%;">Envio</th>
							<th style="width: 20%;">Situa&ccedil;&atilde;o</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(count($mensagens) > 0) {
								foreach ($mensagens as $msg_item): ?>
									<tr>
										<td><?= $msg_item['cliente'] ?></td>
										<td><?= $msg_item['tipo'] ?></td>
										<td><?= $msg_item['mensagem'] ?></td>
										<td class="text-center"><?= $msg_item['data'] ?></td>
										<td class="text-center"><?= $msg_item['dataEnvio'] ?></td>
										<td title="<?= $msg_item['descMisterPostman'] ?>"><button class="btn-circle circle-<?= $status[$msg_item['situacao']]['class'] ?>"><i class="fa fa-<?= $status[$msg_item['situacao']]['icon'] ?>"></i></button><strong class="text-left"> <?= $msg_item['situacao'] ?></strong></td>
									</tr>
								<?php endforeach;
							} else { ?>
								<tr>
									<td colspan="6" class="text-center">Nenhuma Mensagem Hoje.</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>