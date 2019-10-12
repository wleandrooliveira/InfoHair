							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Nome</th>
										<th>Telefone</th>
                                        <th>Data de Nascimento</th>
                                        <th class="text-center">A&ccedil;&otilde;es</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($clientes) > 0) {
                                    	foreach ($clientes as $clie_item): ?>
		                                    <tr>
		                                        <td><?= $clie_item['nome'] ?></td>
		                                        <td><?= $clie_item['telefone'] ?></td>
		                                        <td><?= $clie_item['dataNascimento'] ?></td>
		                                        <td class="text-center">
		                                        	<a href="<?= base_url() ?>clientes/form/<?= $clie_item['idCliente'] ?>"><button type="button" class="btn btn-sm btn-warning"><i class=" fa fa-edit"></i> Editar</button></a>
		                                        	<button type="button" class="btn btn-sm btn-danger btnExcluir" data-toggle="modal" data-target="#confirm-delete" data-url="<?= 'delete/' . $clie_item['idCliente'] ?>"><i class=" fa fa-times"></i> Excluir</button>
		                                        </td>
		                                    </tr>
                                    <?php endforeach;
                                    } else { ?>
	                                    <tr>
	                                    	<td colspan="4" class="text-center">Nenhum Cliente cadastrado.</td>
	                                    </tr>
                                    <?php                                     
                                    }?>
                                </tbody>
							</table>