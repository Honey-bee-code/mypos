<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->from('p_unit');
        if($id != null) {
            $this->db->where('id_unit', $id);
        }
        $this->db->order_by('id_unit', 'desc'); // inovasiku
        $query = $this->db->get();
        return $query;
    }

    public function hapus($id)
	{
        $this->db->where('id_unit', $id);
        $this->db->delete('p_unit');
    }

    public function tambah($post)
    {
        $param =[
            'nama' => $post['nama_unit'],
        ];
        $this->db->insert('p_unit', $param);
    }

    public function edit($post)
    {
        $param =[
            'nama' => $post['nama_unit'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_unit', $post['id']);
        $this->db->update('p_unit', $param);
    }


}
