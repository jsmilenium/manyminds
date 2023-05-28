<div class="container h-100">
	<div class="row d-flex justify-content-center align-items-center h-100">
	  <div class="col-xl-9">

		<h3 class="text-black mb-4">Editar Usuário</h3>

		<div class="card" style="border-radius: 15px;">
		  <div class="card-body">

			  <form action="<?php echo base_url('users/update/'.$id); ?>" method="post">
				  <div class="form-outline mb-4">
					  <label class="form-label" for="name">Nome</label>
					  <input type="text" id="email" name="name" class="form-control form-control-lg" placeholder="Nome" required value="<?php echo $name ;?>"/>
				  </div>

				  <div class="form-outline mb-4">
					  <label class="form-label" for="email">E-mail</label>
					  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?php echo $email ;?>"/>
				  </div>

				  <div class="form-outline mb-4">
					  <label class="form-label" for="email">Password</label>
					  <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Senha" />
				  </div>

				  <div class="form-outline mb-4">
					  <label class="form-label" for="email">Sexo</label>
					  <div class="col-md-9 pe-5">
						  <div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Masculino" <?php if($gender == 'Masculino'){echo 'checked';}?>/>
							  <label class="form-check-label" for="inlineRadio1">Masculino</label>
						  </div>

						  <div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Feminino" <?php if($gender == 'Feminino'){echo 'checked';}?> />
							  <label class="form-check-label" for="inlineRadio2">Feminino</label>
						  </div>
					  </div>
				  </div>

				  <div class="form-outline mb-4">
					  <label class="form-label" for="email">Telefone</label>
					  <input type="text" id="password" name="phone" class="form-control form-control-lg" placeholder="Telefone" required value="<?php echo $phone ;?>" />
				  </div>

				<hr class="mx-n3">

				  <?php
				  if(!empty($success_msg)){
					  echo '<p class="text-success">'.$success_msg.'</p>';
				  }elseif(!empty($error_msg)){
					  echo '<p class="text-danger"">'.$error_msg.'</p>';
				  }elseif(!empty($email_check)){
					  echo '<p class="text-danger"">'.$email_check.'</p>';
				  }
				  ?>

				<div class="px-0 py-4">
				  <button type="submit" class="btn btn-primary btn-lg" name="updateSubmit" value="1">Salvar</button>
				</div>

			  </form>

		  </div>
		</div>
	  </div>
	</div>
</div>
