<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_m extends CI_Model {


    public function get($id = null)
    {
        $this->db->from('customer');
        if($id != null) {
            $this->db->where('id_customer', $id);
        }
        $this->db->order_by('id_customer', 'desc'); // inovasiku
        $query = $this->db->get();
        return $query;
    }

    public function hapus($id)
	{
        $this->db->where('id_customer', $id);
        $this->db->delete('customer');
    }

    public function tambah($post)
    {
        $param =[
            'nama' => $post['nama_customer'],
            'gender' => $post['gender'],
            'phone' => $post['phone'],
            'alamat' => $post['alamat_customer'],
        ];
        $this->db->insert('customer', $param);
    }

    public function edit($post)
    {
        $param =[
            'nama' => $post['nama_customer'],
            'gender' => $post['gender'],
            'phone' => $post['phone'],
            'alamat' => $post['alamat_customer'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id_customer', $post['id']);
        $this->db->update('customer', $param);
    }

    public function hitungJumlahPelanggan()
    {   
        // $query = $this->db->get('customer');
        // if($query->num_rows()>0)
        // {
        // return $query->num_rows();
        // }
        // else
        // {
        // return 0;
        // }
        $query = $this->db->query('SELECT count(id_customer) as jumlah_customer from customer');
        return $query->first_row()->jumlah_customer;
    }


}
