<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('user', 'user');
	}

	public function index()
	{
		$response = [];
		$users = $this->user->findAll();

		if($users){
			foreach($users as $user){
				$response[] = [
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
					'status' => $user->status,
					'created_at' => $user->created_at,
					'updated_at' => $user->updated_at
				];
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
				'status' => 200,
				'message' => 'Success',
				'data' => $response
			)));
	}

}
