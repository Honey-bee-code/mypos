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
		$keranjang = $this->penjualan_m->get_cart();
		$data = array(
			'customer' => $pelanggan,
			'invoice' => $this->penjualan_m->invoice_no(),
			'barang' => $this->barang_m->get()->result(),
			'keranjang' => $keranjang,
		);
        $this->template->load('template', 'transaksi/penjualan/penjualan_form', $data);
	}

	public function proses()
	{
		$data = $this->input->post(null, TRUE);

		if(isset($_POST['tambah_keranjang'])) {
			$id_barang = $this->input->post('id_barang');
			$cek_keranjang = $this->penjualan_m->get_cart(['t_keranjang.id_barang' => $id_barang])->num_rows();
			if($cek_keranjang > 0){
				$this->penjualan_m->update_cart_qty($data);
			} else {
				$this->penjualan_m->add_cart($data);
			}

			if($this->db->affected_rows() > 0){
				$param  = array("success" => true);
			} else {
				$param  = array("success" => false);
			}
			echo json_encode($param);
		}

		if(isset($_POST['edit_keranjang'])){
			$this->penjualan_m->edit_cart($data);

			if($this->db->affected_rows() > 0){
				$param  = array("success" => true);
			} else {
				$param  = array("success" => false);
			}
			echo json_encode($param);
		}

		if(isset($_POST['proses_pembayaran'])){
			$sale_id = $this->penjualan_m->add_sale($data);
			$keranjang = $this->penjualan_m->get_cart()->result();
			$row = [];
			foreach($keranjang as $k => $value){
				array_push($row, array(
						'id_penjualan' => $sale_id,
						'id_barang' => $value->id_barang,
						'harga' => $value->harga,
						'qty' => $value->qty,
						'diskon_barang' => $value->diskon_barang,
						'total' => $value->total,
					)
				);
			}
			$this->penjualan_m->add_sale_detail($row);
			$this->penjualan_m->hapus(['id_user' => $this->session->userdata('userid')]);

			if($this->db->affected_rows() > 0){
				$param  = array("success" => true);
			} else {
				$param  = array("success" => false);
			}
			echo json_encode($param);
		}
	}

	function cart_data(){
		$keranjang = $this->penjualan_m->get_cart();
		$data['keranjang'] = $keranjang;
		$this->load->view('transaksi/penjualan/penjualan_data', $data);
	}

	public function cart_del()
	{
		if(isset($_POST['hapus_keranjang'])) {
			$cart_id = $this->input->post('id_cart');
			$this->penjualan_m->hapus(['id_keranjang' => $cart_id]);
	
			if($this->db->affected_rows() > 0){
				$param = array("success" => true);
			} else {
				$param = array("success" => false);
			}
			echo json_encode($param);
		}

		if(isset($_POST['batal_bayar'])) {
			$this->penjualan_m->kosongkan();
			$query = $this->penjualan_m->get_cart();

			if($query->num_rows() == 0){
				$param = array("success" => true);
			} else {
				$param = array("success" => false);
			}
			echo json_encode($param);
		}
	}

	public function cetak()
	{
		echo "cetak laporan penjualan";
	}
	
	public function hapus()
	{
		echo "hapus";
	}
	

}
