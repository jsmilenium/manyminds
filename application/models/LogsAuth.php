<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class LogsAuth extends CI_Model
{
	public $table = 'vw_logsauth';

	public function __construct()
	{
		parent::__construct();
	}

	public function findAll()
	{
		$data = $this->db->get($this->table)->result();

		if (!empty($data)) {
			return $data;
		}
		return false;
	}

}
