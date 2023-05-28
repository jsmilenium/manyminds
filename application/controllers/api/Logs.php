<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('logsauth', 'logsauth');
	}

	public function index()
	{
		$response = [];
		$logs = $this->logsauth->findAll();

		if($logs){
			foreach($logs as $log){
				$response[] = [
					'id' => $log->id,
					'user' => $log->user,
					'ip' => $log->ip,
					'ok' => $log->ok,
					'created_at' => $log->created_at
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
