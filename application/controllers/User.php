<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        tidak_login();
        cek_admin();
        $this->load->model('user_m');
        $this->load->library('form_validation');        
    }

	public function index()
	{
        $data['row'] = $this->user_m->get();

		$this->template->load('template', 'user/user_data', $data);
    }
    
    public function tambah()
    {
        

        $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[user.nama]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]',
            array('matches' =>'%s tidak sesuai dengan Password')
        );
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
        $this->form_validation->set_message('min_length', '{field} minimal 4 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah dipakai, silahkan coba yang lain');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/user_form_tambah');
        } else {
            $config['upload_path']    = './uploads/photos/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg';
            $config['max_size']       = 2048;
            $config['file_name']	  = 'photo-'.date('ymd').'-'.substr(md5(rand()),0,10);
            $this->load->library('upload', $config);

            $post = $this->input->post(null, TRUE);

            if(@$_FILES['photo']['name'] != null) {
                if($this->upload->do_upload('photo')) {
                    $post['photo'] = $this->upload->data('file_name');
                    $this->user_m->tambah($post);
                    if($this->db->affected_rows() > 0){
                        echo "<script>alert('Data berhasil disimpan')</script>";
                    }
                    echo "<script>window.location='" .site_url('user'). "'</script>";
                } else {
                    $error = strip_tags(str_replace('</p>','',$this->upload->display_errors()));
                    echo "<script>alert('$error')</script>";
                    echo "<script>window.location='" .site_url("user/tambah"). "'</script>";
                }
            } else {
                if($this->db->affected_rows() > 0){
                    echo "<script>alert('Data berhasil disimpan')</script>";
                }
                echo "<script>window.location='" .site_url('user'). "'</script>";
            }
        
        }

    }

    public function hapus()
    {
        $id = $this->input->post('userid');
        
        $user = $this->user_m->get($id)->row();
		if($user->photo != null){
			$target_file = './uploads/photos/'.$user->photo;
			unlink($target_file); // menghapus gambar
		}


        $this->user_m->hapus($id);

        if($this->db->affected_rows() > 0){
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        echo "<script>window.location='" .site_url('user'). "'</script>";
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|callback_cek_nama'); // callback_
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|callback_cek_username'); // callback_
        
        if($this->input->post('password')){
            $this->form_validation->set_rules('password', 'Password', 'min_length[4]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
                array('matches' =>'%s tidak sesuai dengan Password')
            );
        }
        if($this->input->post('passconf')){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
                array('matches' =>'%s tidak sesuai dengan Password')
            );
        }
        $this->form_validation->set_rules('level', 'Level', 'required');
        
        $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
        $this->form_validation->set_message('min_length', '{field} minimal 4 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah dipakai, silahkan coba yang lain');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE) {
            $query = $data['row'] = $this->user_m->get($id);
            if($query->num_rows() > 0){
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else {
                echo "<script>alert('Data tidak ditemukan');";
                echo "window.location='" .site_url('user'). "';</script>";
            }
        } else {
            $config['upload_path']    = './uploads/photos/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg';
            $config['max_size']       = 2048;
            $config['file_name']	  = 'photo-'.date('ymd').'-'.substr(md5(rand()),0,10);
            $this->load->library('upload', $config);

            $post = $this->input->post(null, TRUE);

            if(@$_FILES['photo']['name'] != null) {
                if($this->upload->do_upload('photo')) {

                    $user = $this->user_m->get($id)->row();
                    if($user->photo != null){
                        $target_file = './uploads/photos/'.$user->photo;
                        unlink($target_file); // menghapus gambar
                    }

                    $post['photo'] = $this->upload->data('file_name');
                    $this->user_m->edit($post);
                    if($this->db->affected_rows() > 0){
                        echo "<script>alert('Data berhasil disimpan')</script>";
                    }
                    echo "<script>window.location='" .site_url('user'). "'</script>";
                } else {
                    $error = strip_tags(str_replace('</p>','',$this->upload->display_errors()));
                    echo "<script>alert('$error')</script>";
                    echo "<script>window.location='" .site_url("user/edit"). "'</script>";
                }
            } else {
                $post['photo'] = null;
                $this->user_m->edit($post);
                if($this->db->affected_rows() > 0){
                    echo "<script>alert('Data berhasil disimpan')</script>";
                }
                echo "<script>window.location='" .site_url('user'). "'</script>";
            }
        }

    }

    function cek_nama(){
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE nama = '$post[nama]' AND id_user != '$post[userid]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('cek_nama', '{field} ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    } 
    
    function cek_username(){
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND id_user != '$post[userid]'");
        if($query->num_rows() > 0){
            $this->form_validation->set_message('cek_username', '{field} ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
