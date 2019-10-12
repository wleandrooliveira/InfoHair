							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Servi&ccedil;o</th>
                                        <th>Pre&ccedil;o</th>
                                        <th class="text-center">A&ccedil;&otilde;es</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($servicos) > 0) {
                                    	foreach ($servicos as $serv_item): ?>
		                                    <tr>
		                                        <td><?= $serv_item['descricao'] ?></td>
		                                        <td>R$ <?= number_format($serv_item['precoBase'], 2, ',', ' '); ?></td>
		                                        <td class="text-center">
		                                        	<a href="<?= base_url() ?>servicos/form/<?= $serv_item['idServico'] ?>"><button type="button" class="btn btn-sm btn-warning"><i class=" fa fa-edit"></i> Editar</button></a>
		                                        	<button type="button" class="btn btn-sm btn-danger btnExcluir" data-toggle="modal" data-target="#confirm-delete" data-url="<?= 'delete/' . $serv_item['idServico'] ?>"><i class=" fa fa-times"></i> Excluir</button>
		                                        </td>
		                                    </tr>
                                    <?php endforeach;
                                    } else { ?>
	                                    <tr>
	                                    	<td colspan="3" class="text-center">Nenhum Servi&ccedil;o cadastrado.</td>
	                                    </tr>
                                    <?php                                     
                                    }?>
                                </tbody>
							</table>