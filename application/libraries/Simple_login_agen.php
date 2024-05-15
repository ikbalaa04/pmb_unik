<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Simple_login_agen
{
	protected $CI;
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('agen_model');
	}

	public function login($username,$password){
		$check = $this->CI->agen_model->login($username,$password);
		//jika ada data user, create session login
		if($check){
			$id 			 = $check->id;
			$kode_agen 		 = $check->kode_agen;
			$nama 			 = $check->nama;
			$status_agen 			 = $check->status_agen;

			//create session
			$this->CI->session->set_userdata('id',$id);
			$this->CI->session->set_userdata('kode_agen',$kode_agen);
			$this->CI->session->set_userdata('nama',$nama);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('password',$password);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('status_agen',$status_agen);
			//redirect ke halaman admin yang di proteksi

			if( $this->CI->session->userdata('status_agen') == "1"){
			redirect(base_url('agen/profil'),'refresh');
			}else{
				$this->CI->session->set_flashdata('warning','Maaf anda tidak bisa login karena akun anda telah diblokir admin');
			redirect(base_url('agen'),'refresh');
			}

			// }elseif( $this->CI->session->userdata('verifikasi') == "0"){
			// 	$this->CI->session->set_flashdata('warning','Maaf anda belum bisa login saat ini, mohon menunggu pemberitahuan dari kami dalam 1x24 jam');
			// 	redirect(base_url('agen'),'refresh');
			// }
			// if( $this->CI->session->userdata('akses_level') == "admin"){
			// redirect(base_url('admin/dasbor'),'refresh');
			// }elseif($this->CI->session->userdata('akses_level') == "user"){
			// redirect(base_url('admin/dasbor_user'),'refresh');
			// }elseif($this->CI->session->userdata('akses_level') == "personalia"){
			// redirect(base_url('admin/dasbor_personalia'),'refresh');
			// }

		}else{
			$this->CI->session->set_flashdata('warning','Anda memasukan username atau password yang salah');
			redirect(base_url('agen'),'refresh');
		}
	}

	public function cek_login(){
		if($this->CI->session->userdata('username') == "" && $this->CI->session->userdata('id') == ""){
			$this->CI->session->set_flashdata('warning','Anda belum login');
			redirect(base_url('agen'),'refresh');
		}
	}

	public function logout(){
		//membuang semua session yang telah di set
		$this->CI->session->unset_userdata('id');
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('kode_agen');
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('password');
		//setelah di buang redirect ke login
		$this->CI->session->set_flashdata('success','Anda berhasil logout');
		redirect(base_url('agen'),'refresh');
		
	}

	public function lupa_password($username,$email){
		$check = $this->CI->agen_model->lupa_password($username,$email);
		//jika ada data user, create session login
		if($check){
			$id 			= $check->id;

			//create session
			$this->CI->session->set_userdata('id',$id);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('email',$email);
			//redirect ke halaman admin yang di proteksi

			redirect(base_url('agen/password_baru'),'refresh');
			

		}else{
			$this->CI->session->set_flashdata('warning','Anda memasukan username yang tidak terdaftar');
			redirect(base_url('agen/lupa_password'),'refresh');
		}
	}

	
}