<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if($id != null) {
            $this->db->where('id_user', $id);
        }
        $this->db->order_by('id_user', 'desc'); // inovasiku
        $query = $this->db->get();
        return $query;
    }

    public function tambah($post) 
    {
        $param['nama'] = $post['nama'];
        $param['username'] = $post['username'];
        $param['password'] = sha1($post['password']);
        $param['alamat'] = $post['alamat'];
        $param['level'] = $post['level'];
        $param['photo'] = $post['photo'];
        $this->db->insert('user', $param);
    }

    public function hapus($id)
	{
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }

    public function edit($post)
    {
        $param['nama'] = $post['nama'] ;
        $param['username'] = $post['username'];
        if(!empty($post['password'])){
            $param['password'] = sha1($post['password']);
        }
        $param['alamat'] = $post['alamat'];
        $param['level'] = $post['level'];

        if($post['photo'] != null) {
            $param['photo'] = $post['photo'];
        }
        $this->db->where('id_user', $post['userid']);
        $this->db->update('user', $param);
    }


}
