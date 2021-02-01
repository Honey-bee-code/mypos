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

    public function stok_keluar_data()
    {
        $data['row'] = $this->stok_m->get_stok_keluar()->result();
        $this->template->load('template', 'transaksi/stok_keluar/stok_keluar_data', $data);
    }

    public function stok_masuk_tambah()
    {
        $barang = $this->barang_m->get()->result();
        $supplier = $this->supplier_m->get()->result();
        $data = ['barang' => $barang, 'supplier' => $supplier];
        $this->template->load('template', 'transaksi/stok_masuk/stok_masuk_form', $data);
    }

    public function stok_keluar_tambah()
    {
        $barang = $this->barang_m->get()->result();
        $supplier = $this->supplier_m->get()->result();
        $data = ['barang' => $barang, 'supplier' => $supplier];
        $this->template->load('template', 'transaksi/stok_keluar/stok_keluar_form', $data);
    }

    public function stok_masuk_hapus()
    {
        $id_stok = $this->uri->segment(4);
        $id_barang = $this->uri->segment(5);
        $qty = $this->stok_m->get($id_stok)->row()->qty;
        $data = ['qty' => $qty, 'id_barang' => $id_barang];
        $this->barang_m->update_stok_keluar($data);
        $this->stok_m->hapus($id_stok);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data stok masuk berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('stok/masuk'). "'</script>";
    }

    public function stok_keluar_hapus()
    {
        $id_stok = $this->uri->segment(4);
        $id_barang = $this->uri->segment(5);
        $qty = $this->stok_m->get($id_stok)->row()->qty;
        $data = ['qty' => $qty, 'id_barang' => $id_barang];
        $this->barang_m->update_stok_masuk($data);
        $this->stok_m->hapus($id_stok);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data stok keluar berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('stok/keluar'). "'</script>";
    }

    public function proses_masuk()
    {
        $post = $this->input->post(null, TRUE);
        $this->stok_m->tambah_stok_masuk($post);
        $this->barang_m->update_stok_masuk($post);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data stok masuk berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('stok/masuk'). "'</script>";
    }

    public function proses_keluar()
    {
        $post = $this->input->post(null, TRUE);

		
        $this->stok_m->tambah_stok_keluar($post);
        $this->barang_m->update_stok_keluar($post);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data stok keluar berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('stok/keluar'). "'</script>";
    }
}