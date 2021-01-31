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
        $this->load->library('pagination');
        $data['row'] = $this->penjualan_m->get_sale();
        // $id = $this->input->post('id_sale');
        // $data['detail'] = $this->penjualan_m->get_sale_detail($id);

		$this->template->load('template', 'laporan/laporan_penjualan', $data);
    }
    
    public function produk($sale_id)
    {
        $detail = $this->penjualan_m->get_sale_detail($sale_id)->result();
        echo json_encode($detail);
    }
   	
}