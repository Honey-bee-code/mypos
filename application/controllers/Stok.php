<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        // cek_admin();
        $this->load->model(['barang_m', 'supplier_m', 'stok_m']);
    }

    public function stok_masuk_data()
    {
        $data['row'] = $this->stok_m->get_stok_masuk()->result();
        $this->template->load('template', 'transaksi/stok_masuk/stok_masuk_data', $data);
    }

    public function stok_masuk_tambah()
    {
        $barang = $this->barang_m->get()->result();
        $supplier = $this->supplier_m->get()->result();
        $data = ['barang' => $barang, 'supplier' => $supplier];
        $this->template->load('template', 'transaksi/stok_masuk/stok_masuk_form', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        $this->stok_m->tambah_stok_masuk($post);
		$this->barang_m->update_stok_masuk($post);
		if($this->db->affected_rows() > 0){
            echo "<script>alert('Data stok masuk berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('stok/masuk'). "'</script>";
    }
}