<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        // cek_admin();
        $this->load->model('penjualan_m');
    }

	public function penjualan()
	{
		$data['row'] = $this->penjualan_m->get_sale();
		$this->template->load('template', 'laporan/laporan_penjualan', $data);
	}

	
}