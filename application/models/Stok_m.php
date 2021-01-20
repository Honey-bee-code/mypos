<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_m extends CI_Model {


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

}