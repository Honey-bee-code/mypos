<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		sudah_login();
		$this->load->view('login');
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['login'])){
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			if($query->num_rows() > 0){
				$row = $query->row();
				$param = array(
					'userid' => $row->id_user,
					'level' => $row->level,
					'nama' => addslashes($row->nama),
				);
				$this->session->set_userdata($param);
				echo "<script>
					alert('Selamat datang ".$this->session->userdata('nama').", login berhasil');
					window.location='" .site_url('dashboard'). "'
					</script>";
			} else {
				echo "<script>
					alert('Maaf, login gagal. Username / password salah');
					window.location='" .site_url('auth/login'). "'
					</script>";
			}
		}
	}

	public function logout()
	{
		$param = array('userid', 'level');
		$this->session->unset_userdata($param);
		redirect('auth/login');
	}
}
