<div class="container">
	<h3 class="my-3">Logs de Login</h3>
		<?php
		if(!empty($logs)){ ?>
			<table id="users" class="table table-bordered table-hover table-striped">
				<thead class="">
				<tr>
					<th>Log Id</th>
					<th>User</th>
					<th>IP</th>
					<th>Ok?</th>
					<th>Data de Criação</th>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($logs as $log) : ?>
						<tr>
							<td><?php echo $log->id; ?></td>
							<td><?php echo $log->user; ?></td>
							<td><?php echo $log->ip; ?></td>
							<td><span class="badge
								<?php echo $log->ok ? 'bg-success' : 'bg-dark'; ?>">
								<?php echo $log->ok ? 'Sucesso' : 'Error'; ?></span>
							</td>
							<td><?php echo date('d/m/Y H:i:s',strtotime($log->created_at)); ?></td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
		<?php }else { ?>
			<tr>
				<td colspan="5">Nenhum log encontrado</td>
			</tr>
		<?php }	?>
</div>
