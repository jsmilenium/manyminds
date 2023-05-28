<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('user');

		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
	}

	public function index()
	{
		if($this->isUserLoggedIn){
			redirect('/home');
		}else{
			redirect('users/login');
		}
	}

	public function login()
	{
		$data = array();

		if($this->session->userdata('success_msg')){
			$data['success_msg'] = '';
		}
		if($this->session->userdata('error_msg')){
			$data['error_msg'] = '';
		}

		$ip = $_SERVER['REMOTE_ADDR'];
		$verifyIpAttempts = $this->user->verifyIpAttempts($ip);

		if($verifyIpAttempts){
			$data['error_msg'] = 'Você excedeu o número de tentativas de login, tente novamente mais tarde.';

			$this->load->view('elements/header', $data);
			$this->load->view('users/login', $data);
			$this->load->view('elements/footer');
		}

		if($this->input->post('loginSubmit')){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() == true){
				$checkLogin = $this->user->login(
					$this->input->post('email'),
					$this->input->post('password'),
					$ip
				);
				if($checkLogin){
					$this->session->set_userdata('isUserLoggedIn', true);
					$this->session->set_userdata('userId', $checkLogin->id);
					$this->session->set_userdata('userName', $checkLogin->name);
					redirect('home');
				}else{
					$data['error_msg'] = 'E-mail ou senha inválidos, por favor tente novamente.';
				}
			}else{
				$data['error_msg'] = 'Por favor preencha todos os campos obrigatórios.';
			}
		}

		$this->load->view('elements/header', $data);
		$this->load->view('users/login', $data);
		$this->load->view('elements/footer');
	}

	public function registration()
	{
		$data = $userData = array();

		if($this->input->post('signupSubmit')){
			$this->form_validation->set_rules('name', 'Nome', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Senha', 'required');
			$this->form_validation->set_rules('gender', 'Sexo', 'required');
			$this->form_validation->set_rules('phone', 'Telefone', 'required');

			$userData = array(
				'name' => strip_tags($this->input->post('name')),
				'email' => strip_tags($this->input->post('email')),
				'password' => md5($this->input->post('password')),
				'gender' => strip_tags($this->input->post('gender')),
				'phone' => strip_tags($this->input->post('phone'))
			);

			if($this->form_validation->run() == true){

				if(!$this->emailCheck($userData['email'])) {
					$data['email_check'] = 'O e-mail informado já existe.';
				}else {
					$insert = $this->user->insert($userData);
					if ($insert) {
						$this->session->set_userdata('success_msg', 'Sua conta foi criada com sucesso. Por favor entre com a sua conta.');
						redirect('users/login');
					} else {
						$data['error_msg'] = 'Houve um problema, por favor tente novamente.';
					}
				}
			}else{
				$data['error_msg'] = 'Por favor preencha todos os campos obrigatórios.';
			}
		}

		$data['user'] = $userData;

		$this->load->view('elements/header', $data);
		$this->load->view('users/registration', $data);
		$this->load->view('elements/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('isUserLoggedIn');
		$this->session->unset_userdata('userId');
		$this->session->sess_destroy();
		redirect(base_url() . 'users/login');
	}

	public function emailCheck($email)
	{
		$checkEmail = $this->user->emailCheck($email);
		if($checkEmail){
			return false;
		}else{
			return true;
		}
	}

	public function changeStatusUser($id)
	{
		$user = $this->user->findById($id);
		if($user){
			$status = $user->status ? 0 : 1;
			$this->user->changeStatusUser($id, $status);
			redirect('/home');
		}
	}

	public function update($id)
	{
		$data = $this->user->findById($id);

		if($this->input->post('updateSubmit')){
			$this->form_validation->set_rules('name', 'Nome', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Senha', 'required');
			$this->form_validation->set_rules('gender', 'Sexo', 'required');
			$this->form_validation->set_rules('phone', 'Telefone', 'required');

			$userData = array(
				'name' => strip_tags($this->input->post('name')),
				'email' => strip_tags($this->input->post('email')),
				'password' => md5($this->input->post('password')),
				'gender' => strip_tags($this->input->post('gender')),
				'phone' => strip_tags($this->input->post('phone'))
			);

			if($this->form_validation->run() == true){
				$update = $this->user->update($userData, $data->id);
				if ($update) {
					redirect('home');
				} else {
					$data['error_msg'] = 'Houve um problema, por favor tente novamente.';
				}
			}else{
				$data['error_msg'] = 'Por favor preencha todos os campos obrigatórios.';
			}
		}

		$this->load->view('layout/header', $data);
		$this->load->view('users/edit', $data);
		$this->load->view('layout/footer');

	}

}
