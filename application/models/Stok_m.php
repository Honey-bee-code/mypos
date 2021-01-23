<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('t_stok');
        if($id != null){
            $this->db->where('id_stok', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function hapus($id)
    {
        $this->db->where('id_stok', $id);
        $this->db->delete('t_stok');
    }

    public function get_stok_masuk()
    {
        $this->db->select('t_stok.id_stok, p_barang.barcode, p_barang.nama as nama_barang, 
        qty, tanggal, detail, supplier.nama as nama_supplier, p_barang.id_barang');
        $this->db->from('t_stok');
        $this->db->join('p_barang', 't_stok.id_barang = p_barang.id_barang');
        $this->db->join('supplier', 't_stok.id_supplier = supplier.id_supplier', 'left'); // left join
        $this->db->where('tipe', 'masuk');
        $this->db->order_by('id_stok', 'desc');

        $query = $this->db->get();
        return $query;
    }

    public function get_stok_keluar()
    {
        $this->db->select('t_stok.id_stok, p_barang.barcode, p_barang.nama as nama_barang, 
        qty, tanggal, detail, supplier.nama as nama_supplier, p_barang.id_barang');
        $this->db->from('t_stok');
        $this->db->join('p_barang', 't_stok.id_barang = p_barang.id_barang');
        $this->db->join('supplier', 't_stok.id_supplier = supplier.id_supplier', 'left'); // left join
        $this->db->where('tipe', 'keluar');
        $this->db->order_by('id_stok', 'desc');

        $query = $this->db->get();
        return $query;
    }


    public function tambah_stok_masuk($post)
    {
        $param = [
            'id_barang' => $post['id_barang'],
            'tipe' => 'masuk',
            'detail' => $post['detail'],
            'id_supplier' => $post['supplier'] == '' ? null : $post['supplier'],
            'qty' => $post['qty'],
            'tanggal' => $post['tanggal'],
            'id_user' => $this->session->userData('userid'),
        ];
        $this->db->insert('t_stok', $param);
    }

    public function tambah_stok_keluar($post)
    {
        $param = [
            'id_barang' => $post['id_barang'],
            'tipe' => 'keluar',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'tanggal' => $post['tanggal'],
            'id_user' => $this->session->userData('userid'),
        ];
        $this->db->insert('t_stok', $param);
    }

}