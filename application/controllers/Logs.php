<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('logsAuth');

		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
	}

	public function index(){
		if($this->isUserLoggedIn){
			$data['logs'] = $this->logsAuth->findAll();
			$data['name'] = $this->session->userdata('userName');

			$this->load->view('layout/header', $data);
			$this->load->view('logs/index', $data);
			$this->load->view('layout/footer');
		}else{
			redirect('users/login');
		}
	}

}
