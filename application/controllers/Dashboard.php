<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		tidak_login();
		$this->load->model(['barang_m', 'customer_m']);
		$data['total_barang'] = $this->barang_m->hitungJumlahBarang();
		$data['total_pelanggan'] = $this->customer_m->hitungJumlahPelanggan();

		$this->template->load('template', 'dashboard', $data);
	}
}
