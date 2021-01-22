<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        // cek_admin();
        $this->load->model('supplier_m');
    }

	public function index()
	{
		$data['row'] = $this->supplier_m->get();
		$this->template->load('template', 'supplier/supplier_data', $data);
	}

	public function hapus($id)
	{
		$this->supplier_m->hapus($id);
		$error = $this->db->error();
		if($error['code'] != null){
			echo "<script>alert('Data tidak bisa dihapus karena sudah berelasi')</script>";
		} else {
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('supplier'). "'</script>";
	}

	public function tambah()
	{
		$supplier = new stdClass();
		$supplier->id_supplier = null;
		$supplier->nama = null;
		$supplier->phone = null;
		$supplier->alamat = null;
		$supplier->keterangan = null;

		$data = array(
			'page' => 'tambah',
			'row' => $supplier
		);
		$this->template->load('template', 'supplier/supplier_form', $data);
	}

	public function edit($id)
	{
		$query = $this->supplier_m->get($id);
		if($query->num_rows() > 0) {
			$supplier = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $supplier
			);
			$this->template->load('template', 'supplier/supplier_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" .site_url('supplier'). "';</script>";
		}
	}

	public function proses() 
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->supplier_m->tambah($post);
		} elseif (isset($_POST['edit'])){
			$this->supplier_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('supplier'). "'</script>";
	}
}