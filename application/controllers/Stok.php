<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        // cek_admin();
    }

    public function stok_masuk_data()
    {
        $this->template->load('template', 'transaksi/stok_masuk/stok_masuk_data');
    }

    public function stok_masuk_tambah()
    {
        $this->template->load('template', 'transaksi/stok_masuk/stok_masuk_form');
    }

    public function proses()
    {
        if(isset($_POST['tambah'])){
            echo "proses stok masuk tambah";
        }
    }
}