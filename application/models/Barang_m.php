<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('p_barang.*, p_kategori.nama as nama_kategori, p_unit.nama as nama_unit');
        $this->db->from('p_barang');
        $this->db->join('p_kategori', 'p_kategori.id_kategori = p_barang.id_kategori');
        $this->db->join('p_unit', 'p_unit.id_unit = p_barang.id_unit');

        if($id != null) {
            $this->db->where('id_barang', $id);
        }
        $this->db->order_by('id_barang', 'desc'); // inovasiku
        $query = $this->db->get();
        return $query;
    }

    public function hapus($id)
	{
        $this->db->where('id_barang', $id);
        $this->db->delete('p_barang');
    }

    public function tambah($post)
    {
        $param =[
            'barcode' => $post['barcode'],
            'nama' => $post['nama_barang'],
            'id_kategori' => $post['kategori'],
            'id_unit' => $post['unit'],
            'harga' => $post['harga'],
            'gambar' => $post['gambar'],

        ];
        $this->db->insert('p_barang', $param);
    }

    public function edit($post)
    {
        $param =[
            'barcode' => $post['barcode'],
            'nama' => $post['nama_barang'],
            'id_kategori' => $post['kategori'],
            'id_unit' => $post['unit'],
            'harga' => $post['harga'],
            'updated' => date('Y-m-d H:i:s')
        ];

        if($post['gambar'] != null) {
            $param['gambar'] = $post['gambar'];
        }
        $this->db->where('id_barang', $post['id']);
        $this->db->update('p_barang', $param);
    }

    function cek_barcode($code, $id = null){
        $this->db->from('p_barang');
        $this->db->where('barcode', $code);
        if($id != null) {
            $this->db->where('id_barang !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function hitungJumlahBarang()
    {
        // $query = $this->db->get('p_barang');
        // if($query->num_rows()>0)
        // {
        // return $query->num_rows();
        // }
        // else
        // {
        // return 0;
        // }
        $query = $this->db->query('select count(id_barang) as jumlah_barang from p_barang');
        return $query->first_row()->jumlah_barang;
    }

}
