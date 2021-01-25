<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        $this->load->model('penjualan_m');
    }

	public function index()
	{
		$this->load->model('customer_m');
		$pelanggan = $this->customer_m->get()->result();
		$data = array(
			'customer' => $pelanggan,
			'invoice' => $this->penjualan_m->invoice_no(),
		);
        $this->template->load('template', 'transaksi/penjualan/penjualan_form', $data);
	}
}
