<section class="vh-100" style="background-color: #2779e2;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-9">

        <h3 class="text-white mb-4">Criar Conta</h3>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">

			  <form action="<?php echo base_url('users/registration'); ?>" method="post">
				<div class="row align-items-center pt-4 pb-3">
				  <div class="col-md-3 ps-5">
					<h6 class="mb-0">Name</h6>
				  </div>
				  <div class="col-md-9 pe-5">
					<input type="text" class="form-control form-control-lg" name="name" required />
				  </div>
				</div>

				<hr class="mx-n3">

				<div class="row align-items-center py-3">
				  <div class="col-md-3 ps-5">
					<h6 class="mb-0">Email</h6>
				  </div>
				  <div class="col-md-9 pe-5">
					<input type="email" class="form-control form-control-lg" name="email" placeholder="example@example.com" required />
				  </div>
				</div>

				<hr class="mx-n3">

				<div class="row align-items-center py-3">
				  <div class="col-md-3 ps-5">
					<h6 class="mb-0">Senha</h6>

				  </div>
				  <div class="col-md-9 pe-5">
					  <input type="password" class="form-control form-control-lg" name="password" placeholder="senha" required />
				  </div>
				</div>

				<hr class="mx-n3">

				<div class="row align-items-center py-3">
				  <div class="col-md-3 ps-5">
					<h6 class="mb-0">Sexo</h6>
				  </div>
				  <div class="col-md-9 pe-5">
					  <div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Masculino" />
						  <label class="form-check-label" for="inlineRadio1">Masculino</label>
					  </div>

					  <div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Feminino" />
						  <label class="form-check-label" for="inlineRadio2">Feminino</label>
					  </div>
				  </div>
				</div>

				  <hr class="mx-n3">

				  <div class="row align-items-center py-3">
					  <div class="col-md-3 ps-5">
						  <h6 class="mb-0">Telefone</h6>

					  </div>
					  <div class="col-md-9 pe-5">
						  <input type="text" class="form-control form-control-lg" name="phone" placeholder="Telefone" required />
					  </div>
				  </div>

				<hr class="mx-n3">

				  <div class="form-check d-flex justify-content-start mb-4 pb-3">
					  <input class="form-check-input me-3" type="checkbox" value="terms" id="terms" required />
					  <label class="form-check-label text-black" for="form2Example3">
						  Eu aceito o <a href="#!" class="text-black"><u>Termos e condições</u></a> e a <a href="#!" class="text-black"><u>Política de Privacidade</u></a>
					  </label>
				  </div>

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
				  <button type="submit" class="btn btn-primary btn-lg" name="signupSubmit" value="1">Criar</button>
				</div>

			  	<p>Já tem uma conta? <a href="<?php echo base_url('users/login'); ?>">Entrar aqui</a></p>
			  </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
