<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->from('supplier');
        if($id != null) {
            $this->db->where('id_supplier', $id);
        }
        $this->db->order_by('id_supplier', 'desc'); // inovasiku
        $query = $this->db->get();
        return $query;
    }

    public function hapus($id)
	{
        $this->db->where('id_supplier', $id);
        $this->db->delete('supplier');
    }

    public function tambah($post)
    {
        $param =[
            'nama' => $post['nama_supplier'],
            'phone' => $post['phone'],
            'alamat' => $post['alamat_supplier'],
            'keterangan' => empty($post['keterangan']) ? null : $post['keterangan'],
        ];
        $this->db->insert('supplier', $param);
    }

    public function edit($post)
    {
        $param =[
            'nama' => $post['nama_supplier'],
            'phone' => $post['phone'],
            'alamat' => $post['alamat_supplier'],
            'keterangan' => empty($post['keterangan']) ? null : $post['keterangan'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_supplier', $post['id']);
        $this->db->update('supplier', $param);
    }


}
