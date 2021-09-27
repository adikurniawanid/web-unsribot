<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function __construct()
	{
		$this->db = db_connect();
	}

	public function index()
	{
		if (!isset($_SESSION['user_id'])) {
			return redirect()->to(base_url('Auth/Login'));
		}

		$data = [
			'judul' => 'Home',
			'data_list' => $this->db->query("call get_jumlah_data_list()")->getRowArray(),
		];

		return view('admin/dashboard', $data);
	}
}
