<?php defined('BASEPATH') OR exit('No direct script access allowed');

use QR_Code\QR_Code;

class Barang extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        tidak_login();
        // cek_admin();
        $this->load->model(['barang_m', 'kategori_m', 'unit_m']);
	}
	
		


	public function index()
	{
		$data['row'] = $this->barang_m->get();
		$this->template->load('template', 'produk/barang/barang_data', $data);
	}

	public function hapus($id)
	{
		$barang = $this->barang_m->get($id)->row();
		if($barang->gambar != null){
			$target_file = './uploads/produk/'.$barang->gambar;
			unlink($target_file); // menghapus gambar
		}

		$qrcode = $this->barang_m->get($id)->row();
		$file = './uploads/qrcode/'.$qrcode->barcode.'.png';
		if(file_exists($file)){
			unlink($file); // menghapus qrcode
		}

		$this->barang_m->hapus($id);
        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('barang'). "'</script>";
	}

	public function tambah()
	{
		$barang = new stdClass();
        $barang->id_barang = null;
        $barang->barcode = null;
		$barang->nama = null;
		$barang->harga = null;
		$barang->id_kategori = null;
		$barang->created = null;
        $barang->updated = null;
        
        $query_kategori = $this->kategori_m->get();

        $query_unit = $this->unit_m->get();
        $unit[null] = '- Pilih -';
        foreach($query_unit->result() as $unt){
            $unit[$unt->id_unit] = $unt->nama;
        }

		$data = array(
			'page' => 'tambah',
            'row' => $barang,
            'kategori' => $query_kategori,
            'unit' => $unit, 
            'selected_unit' => null
		);
		$this->template->load('template', 'produk/barang/barang_form', $data);
	}

	public function edit($id)
	{
		$query = $this->barang_m->get($id);
		if($query->num_rows() > 0) {
			$barang = $query->row();

			$query_kategori = $this->kategori_m->get();

			$query_unit = $this->unit_m->get();
			$unit[null] = '- Pilih -';
			foreach($query_unit->result() as $unt){
				$unit[$unt->id_unit] = $unt->nama;
			}
	
			$data = array(
				'page' => 'edit',
				'row' => $barang,
				'kategori' => $query_kategori,
				'unit' => $unit, 
				'selected_unit' => $barang->id_unit
			);
			$this->template->load('template', 'produk/barang/barang_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" .site_url('barang'). "';</script>";
		}
	}

	public function proses() 
	{
		$config['upload_path']    = './uploads/produk/';
		$config['allowed_types']  = 'gif|jpg|png|jpeg';
		$config['max_size']       = 2048;
		$config['file_name']	  = 'barang-'.date('ymd').'-'.substr(md5(rand()),0,10);
		$this->load->library('upload', $config);

		$post = $this->input->post(null, TRUE);

		if(isset($_POST['tambah'])){
			if($this->barang_m->cek_barcode($post['barcode'])->num_rows() > 0) {
				echo "<script>alert('Barcode " .$post['barcode']. " sudah dipakai di barang yang lain')</script>";
				echo "<script>window.location='" .site_url('barang/tambah'). "'</script>";
			} else {

				if(@$_FILES['gambar']['name'] != null) {
					if($this->upload->do_upload('gambar')) {
						$post['gambar'] = $this->upload->data('file_name');
						$this->barang_m->tambah($post);
						if($this->db->affected_rows() > 0){
							echo "<script>alert('Data berhasil disimpan')</script>";
						}
						echo "<script>window.location='" .site_url('barang'). "'</script>";
					} else {
						$error = strip_tags(str_replace('</p>','',$this->upload->display_errors()));
						echo "<script>alert('$error')</script>";
						echo "<script>window.location='" .site_url("barang/tambah"). "'</script>";
					}
				} else {
					$post['gambar'] = null;
					$this->barang_m->tambah($post);
					if($this->db->affected_rows() > 0){
						echo "<script>alert('Data berhasil disimpan')</script>";
					}
					echo "<script>window.location='" .site_url('barang'). "'</script>";
				}

			}

		} elseif (isset($_POST['edit'])){
			if($this->barang_m->cek_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
				echo "<script>alert('Barcode " .$post['barcode']. " sudah dipakai di barang yang lain')</script>";
				echo "<script>window.location='" .site_url("barang/edit/$post[id]"). "'</script>";
			} else {
				if(@$_FILES['gambar']['name'] != null) {
					if($this->upload->do_upload('gambar')) {

						$barang = $this->barang_m->get($post['id'])->row();
						if($barang->gambar != null){
							$target_file = './uploads/produk/'.$barang->gambar;
							unlink($target_file); // menghapus gambar
						}

						$post['gambar'] = $this->upload->data('file_name');
						$this->barang_m->edit($post);
						if($this->db->affected_rows() > 0){
							echo "<script>alert('Data berhasil disimpan')</script>";
						}
						echo "<script>window.location='" .site_url('barang'). "'</script>";
					} else {
						$error = $this->upload->display_errors();
						echo "<script>alert('$error')</script>";
						echo "<script>window.location='" .site_url("barang/edit/$post[id]"). "'</script>";
					}
				} else {
					$post['gambar'] = null;
					$this->barang_m->edit($post);
					if($this->db->affected_rows() > 0){
						echo "<script>alert('Data berhasil disimpan')</script>";
					}
					echo "<script>window.location='" .site_url('barang'). "'</script>";
				}
			}
		}

		if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil disimpan')</script>";
        }
        echo "<script>window.location='" .site_url('barang'). "'</script>";
	}

	function barcode_qrcode($id){
		$data['row'] = $this->barang_m->get($id)->row();
		$this->template->load('template', 'produk/barang/barcode_qrcode', $data);
				
	}

	function barcode_print($id) {
		$data['row'] = $this->barang_m->get($id)->row();
		$html = $this->load->view('produk/barang/barcode_print', $data, true);
		$this->fungsi->PdfGenerator($html, 'barcode-'.$data['row']->barcode, 'A4', 'potrait');
	}

	function qrcode_print($id) {
		$data['row'] = $this->barang_m->get($id)->row();
		// $row = $data['row'];
		$path = base_url("uploads/qrcode/qrcode-".$data['row']->barcode.'.png');
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$image_path = file_get_contents($path);
		// konversi gambar ke base64
		// <img src=""data:image/png;base64, iVBORw0....." />
		$data['qrcode'] = 'data:image/' . $type . ';base64,' . base64_encode($image_path);
		$html = $this->load->view('produk/barang/qrcode_print', $data, true);
		$this->fungsi->PdfGenerator($html, 'qrcode-'.$data['row']->barcode, 'A4', 'potrait');
	}

	function coba_qrcode() {
		QR_Code::png('fahad lengi');
	}

}