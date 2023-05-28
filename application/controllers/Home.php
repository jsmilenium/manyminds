<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user');
	}

	public function index()
	{
		if(!$this->session->userdata('isUserLoggedIn')){
			redirect(base_url() . 'users/login');
		}else{
			$data = $this->user->findById($this->session->userdata('userId'));
			$users['users'] = $this->user->findAll();
			$this->load->view('layout/header', $data);
			$this->load->view('home/index', $users);
			$this->load->view('layout/footer');
		}
	}
}
