<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        $this->load->model(['penjualan_m', 'barang_m']);
    }

	public function index() 
	{
		$this->load->model('customer_m');
		$pelanggan = $this->customer_m->get()->result();
		$data = array(
			'customer' => $pelanggan,
			'invoice' => $this->penjualan_m->invoice_no(),
			'barang' => $this->barang_m->get()->result(),
		);
        $this->template->load('template', 'transaksi/penjualan/penjualan_form', $data);
	}

	public function proses()
	{
		$data = $this->input->post(null, TRUE);

		if(isset($_POST['tambah_keranjang'])) {
			$this->penjualan_m->add_cart($data);
		}

		if($this->db->affected_rows() > 0){
			$param  = array("success" => true);
		} else {
			$param  = array("success" => false);
		}
		echo json_encode($param);
	}
}
