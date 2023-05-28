<section class="vh-100" style="background-color: #508bfc;">
	<div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card shadow-2-strong" style="border-radius: 1rem;">
					<div class="card-body p-5 text-center">
						<h3 class="mb-5">Entrar na sua conta</h3>
						<form action="<?php echo base_url('users/login'); ?>" method="post">
							<div class="form-outline mb-4">
								<label class="form-label" for="email">E-mail</label>
								<input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required />
							</div>

							<div class="form-outline mb-4">
								<label class="form-label" for="password">Senha</label>
								<input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Senha" required/>
							</div>

							<button class="btn btn-primary btn-lg btn-block" type="submit" name="loginSubmit" value="1">Entrar</button>

							<p>Não tem uma conta? <a href="<?php echo base_url('users/registration'); ?>">Criar conta</a></p>

							<?php
								if(!empty($success_msg)){
									echo '<p class="text-success">'.$success_msg.'</p>';
								}elseif(!empty($error_msg)){
									echo '<p class="text-danger"">'.$error_msg.'</p>';
								}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
