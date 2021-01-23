<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->from('p_kategori');
        if($id != null) {
            $this->db->where('id_kategori', $id);
        }
        $this->db->order_by('id_kategori', 'desc'); // inovasiku
        $query = $this->db->get();
        return $query;
    }

    public function hapus($id)
	{
        $this->db->where('id_kategori', $id);
        $this->db->delete('p_kategori');
    }

    public function tambah($post)
    {
        $param =[
            'nama' => $post['nama_kategori'],
        ];
        $this->db->insert('p_kategori', $param);
    }

    public function edit($post)
    {
        $param =[
            'nama' => $post['nama_kategori'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_kategori', $post['id']);
        $this->db->update('p_kategori', $param);
    }


}
