							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>C&oacute;digo</th>
										<th>Nome</th>
                                        <th>Perfil</th>
                                        <th class="text-center">A&ccedil;&otilde;es</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(count($funcionarios) > 0) {
                                    	foreach ($funcionarios as $func_item): ?>
		                                    <tr>
		                                        <td><?= $func_item['idFuncionario'] ?></td>
		                                        <td><?= $func_item['nome'] ?></td>
		                                        <td><?= $func_item['perfil'] ?></td>
		                                        <td class="text-center">
		                                        	<a href="<?= base_url() ?>funcionarios/form/<?= $func_item['idFuncionario'] ?>"><button type="button" class="btn btn-sm btn-warning"><i class=" fa fa-edit"></i> Editar</button></a>
		                                        	<button type="button" class="btn btn-sm btn-danger btnExcluir" data-toggle="modal" data-target="#confirm-delete" data-url="<?= 'delete/' . $func_item['idFuncionario'] ?>"><i class=" fa fa-times"></i> Excluir</button>
		                                        </td>
		                                    </tr>
                                    <?php endforeach;
                                    } else { ?>
	                                    <tr>
	                                    	<td colspan="4" class="text-center">Nenhum Funcion&aacute;rio cadastrado.</td>
	                                    </tr>
                                    <?php                                     
                                    }?>
                                </tbody>
							</table>