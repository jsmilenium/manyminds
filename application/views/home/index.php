<div class="container">
	<h3 class="my-3">Lista de Usuários</h3>
		<?php
		if(!empty($users)){ ?>
			<table id="users" class="table table-bordered table-hover table-striped">
				<thead class="">
				<tr>
					<th>User Id</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Sexo</th>
					<th>Telefone</th>
					<th>Status</th>
					<th>Data de Criação</th>
					<th>#</th>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($users as $user) : ?>
						<tr>
							<td><?php echo $user->id; ?></td>
							<td><?php echo $user->name; ?></td>
							<td><?php echo $user->email; ?></td>
							<td><?php echo $user->gender; ?></td>
							<td><?php echo $user->phone; ?></td>
							<td><span class="badge
								<?php echo $user->status ? 'bg-success' : 'bg-dark'; ?>">
								<?php echo $user->status ? 'Ativo' : 'Inativo'; ?></span>
							</td>
							<td><?php echo date('d/m/Y',strtotime($user->created_at)); ?></td>
							<td>
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
										Ações
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
										<?php if($user->status){ ;?>
											<li><a class="dropdown-item" href="<?php echo base_url('users/update/'.$user->id); ?>">Editar</a></li>
										<?php } ?>
										<li><a class="dropdown-item" href="<?php echo base_url('users/changeStatusUser/'.$user->id); ?>"><?php echo $user->status ? 'Inativar' : 'Ativar'; ?></a></li>
									</ul>
								</div>
							</td>
						</tr>
						<?php endforeach; ?>
				</tbody>
			</table>
		<?php }else { ?>
			<tr>
				<td colspan="5">Nenhum usuário encontrado</td>
			</tr>
		<?php }	?>
</div>
