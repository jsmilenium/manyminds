<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model
{
	public $table = 'users';

	public function __construct()
	{
		parent::__construct();
	}

	public function login($email, $password, $userIp)
	{
		// $userIp = $_SERVER['REMOTE_ADDR']
		$password = md5($password);
		$data = $this->db->where([
			'email' => $email,
			'password' => $password,
			'status' => 1, // 1 = active, 0 = inactive
		])->get($this->table)->result();

		if (!empty($data)) {
			$this->logRegister($data[0]->id, $userIp, 1);
			return $data[0];
		}else {
			$this->logRegister(0, $userIp, 0);
		}
		return false;
	}

	private function logRegister($userId, $userIp, $ok)
	{
		$data = [
			'user_id' => $userId,
			'ip' => $userIp,
			'ok' => (int) $ok,
			'created_at' => date('Y-m-d H:i:s'),
		];

		$this->db->insert('logs_authorization', $data);
		return $this->db->insert_id();
	}

	public function insert($data = array()) {
		try {
			if(!empty($data)){
				$insert = $this->db->insert($this->table, $data);

				if(!$insert) {
					throw new Exception('Houve um erro ao criar o usuário.');
				}

				return $this->db->insert_id();
			}

			throw new Exception('Dados inválidos.');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function update($data = array(), $id) {
		try {
			if(!empty($data) && !empty($id)){
				$update = $this->db->update($this->table, $data, ['id' => $id]);

				if(!$update) {
					throw new Exception('Houve um erro ao atualizar o usuário.');
				}

				return true;
			}

			throw new Exception('Dados inválidos.');
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function emailCheck($email)
	{
		$data = $this->db->where([
			'email' => $email
		])->get($this->table)->result();

		if (!empty($data)) {
			return true;
		}
		return false;
	}

	public function findById($id)
	{
		$data = $this->db->where([
			'id' => $id
		])->get($this->table)->result();

		if (!empty($data)) {
			return $data[0];
		}
		return false;
	}

	public function findAll()
	{
		$data = $this->db->get($this->table)->result();

		if (!empty($data)) {
			return $data;
		}
		return false;
	}

	public function changeStatusUser($id, $status)
	{
		$data = $this->db->where([
			'id' => $id
		])->update($this->table, ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);

		if ($data) {
			return true;
		}
		return false;
	}

	public function verifyIpAttempts($ip)
	{
		$attempt_limit = 3;
		$attempt_count = $this->db
			->from('logs_authorization')
			->where('ip', $ip)
			->where('ok', 0)
			->where('created_at >=', date('Y-m-d H:i:s', strtotime('-1 minutes')))
			->count_all_results();

		if($attempt_count >= $attempt_limit) {
			return true;
		}
		return false;
	}
}
