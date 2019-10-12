				<h3 class="text-center"><strong>Relat&oacute;rio de Atendimentos por Funcion&aacute;rios de <?= $dataInicio ?> at&eacute; <?= $dataFim ?></strong></h3>
				<br>
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Funcion&aacute;rio</th>
							<th>Quantidade de Atendimentos</th>
							<th>Quantidade de Clientes</th>
							<th>Dias Trabalhados</th>
							<th>M&eacute;dia de Atendimentos / Dia</th>						
							<th>M&eacute;dia de Valor / Dia</th>						
							<th>Valor Total</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(count($relatorios) > 0) {
								foreach ($relatorios as $relat_item): ?>
									<tr>
										<td><?= $relat_item['nome'] ?></td>
										<td><?= $relat_item['qtdCliente'] ?></td>
										<td><?= $relat_item['qtdAtendimento'] ?></td>
										<td><?= $relat_item['diasTrabalhados'] ?></td>
										<td><?= $relat_item['mediaAtendimento'] ?></td>
										<td><strong>R$ <?= $relat_item['mediaValor'] ?></strong></td>
										<td><strong>R$ <?= str_replace('.', ',', $relat_item['totalFuncionario']) ?></strong></td>
									</tr>
								<?php endforeach;
							} else { ?>
								<tr>
									<td colspan="6" class="text-center">Dados insuficientes para gerar relatório.</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>