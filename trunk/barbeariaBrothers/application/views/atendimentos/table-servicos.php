<?php if(count($servicos) > 0) : ?>
<table class="table">
	<tbody>
		<?php foreach ($servicos as $serv_item): ?>
				<tr>
					<td><button class="btn-circle circle-primary"><i class="fa fa-check"></i></button><strong class="text-left"> <?= $serv_item['descricao'] ?></strong></td>
					<td><strong>R$ <?= str_replace('.', ',', $serv_item['precoBase']) ?></strong></td>
					<td contenteditable="true" class='celQtd strong' data-precoBase="<?= $serv_item['precoBase']?>"><?= $serv_item['quantidade'] ?></td>
					<td><strong><?= str_replace('.', ',', $serv_item['subtotal']) ?></strong></td>
					<td><button type="button" class="btn btn-danger btnExcluir idServico" data-id="<?= $serv_item['idServico'] ?>" data-url="<?= 'delete/' . $serv_item['idServico'] ?>"><i class="fa fa-trash"></i></button></td>
				</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php endif;?>
