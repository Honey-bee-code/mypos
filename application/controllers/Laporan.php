<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        cek_admin();
        $this->load->model(['penjualan_m', 'stok_m', 'customer_m', 'user_m']);
    }

	public function penjualan()
	{
        $this->load->library('pagination');
        
        //reset taruh paling atas
        if(isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        }
        if(isset($_POST['filter'])) {
            $post = $this->input->post(null, TRUE);
            $this->session->set_userdata('search', $post);
        } else {
            $post = $this->session->userdata('search');
        }


        $config['base_url'] = site_url('laporan/penjualan');
        $config['total_rows'] = $this->penjualan_m->get_sale_pagination()->num_rows();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['next_link'] = 'Sesudah';
        $config['prev_link'] = 'Sebelum';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $data['customer'] = $this->customer_m->get()->result();
        $data['kasir'] = $this->user_m->get()->result();
        $data['row'] = $this->penjualan_m->get_sale_pagination($config['per_page'], $this->uri->segment(3));
        $data['post'] = $post;

		$this->template->load('template', 'laporan/laporan_penjualan', $data);
    }
    
    public function produk($sale_id)
    {
        $detail = $this->penjualan_m->get_sale_detail($sale_id)->result();
        echo json_encode($detail);
    }

    public function stok()
    {
        $data['row'] = $this->stok_m->get()->result();

		$this->template->load('template', 'laporan/laporan_stok', $data);
    }

    public function hapus_stok($id)
    {
        $this->stok_m->hapus($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('laporan/stok'). "'</script>";
    }
   	
}