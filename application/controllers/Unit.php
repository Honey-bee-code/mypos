<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        // cek_admin();
        $this->load->model('unit_m');
    }

	public function index()
	{
		$data['row'] = $this->unit_m->get();
		$this->template->load('template', 'produk/unit/unit_data', $data);
	}

	public function hapus($id)
	{
		$this->unit_m->hapus($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('unit'). "'</script>";
	}

	public function tambah()
	{
		$unit = new stdClass();
		$unit->id_unit = null;
		$unit->nama = null;

		$data = array(
			'page' => 'tambah',
			'row' => $unit
		);
		$this->template->load('template', 'produk/unit/unit_form', $data);
	}

	public function edit($id)
	{
		$query = $this->unit_m->get($id);
		if($query->num_rows() > 0) {
			$unit = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $unit
			);
			$this->template->load('template', 'produk/unit/unit_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" .site_url('unit'). "';</script>";
		}
	}

	public function proses() 
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->unit_m->tambah($post);
		} elseif (isset($_POST['edit'])){
			$this->unit_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('unit'). "'</script>";
	}
}