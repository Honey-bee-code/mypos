<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        $this->load->model('customer_m');
    }

	public function index()
	{
		$data['total_barang'] = $this->customer_m->hitungJumlahPelanggan();
		$data['row'] = $this->customer_m->get();
		$this->template->load('template', 'customer/customer_data', $data);
	}

	public function hapus($id)
	{
		$this->customer_m->hapus($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('customer'). "'</script>";
	}

	public function tambah()
	{
		$customer = new stdClass();
		$customer->id_customer = null;
		$customer->nama = null;
		$customer->gender = null;
        $customer->phone = null;
		$customer->alamat = null;

		$data = array(
			'page' => 'tambah',
			'row' => $customer
		);
		$this->template->load('template', 'customer/customer_form', $data);
	}

	public function edit($id)
	{
		$query = $this->customer_m->get($id);
		if($query->num_rows() > 0) {
			$customer = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $customer
			);
			$this->template->load('template', 'customer/customer_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" .site_url('customer'). "';</script>";
		}
	}

	public function proses() 
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->customer_m->tambah($post);
		} elseif (isset($_POST['edit'])){
			$this->customer_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('customer'). "'</script>";
	}
}