<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function index()
	{
        tidak_login();
        $this->template->load('template', 'transaksi/penjualan/penjualan_form');
	}
}
