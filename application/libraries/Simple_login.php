<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Simple_login
{
	protected $CI;
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('admin_model');
	}

	public function login($username,$password){

		$check = $this->CI->admin_model->login($username,$password);
		//jika ada data user, create session login
		if($check){
			$id 			= $check->id;
			$nama 			= $check->nama;
			$id_level 		= $check->id_level;
			$foto			= $check->foto;
			$fakultas		= $check->fakultas;
			$email			= $check->email;
			$status			= $check->status;

			//create session
			$this->CI->session->set_userdata('id',$id);
			$this->CI->session->set_userdata('nama',$nama);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('id_level',$id_level);
			$this->CI->session->set_userdata('password',$password);
			$this->CI->session->set_userdata('foto',$foto);
			$this->CI->session->set_userdata('fakultas',$fakultas);
			$this->CI->session->set_userdata('email',$email);
			$this->CI->session->set_userdata('status',$status);
			//redirect ke halaman admin yang di proteksi

			$ambil_detail_thn_akademik = $this->CI->admin_model->ambil_detail_thn_akademik(); 
			$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

			
			if( $this->CI->session->userdata('status') == "1"){
			
			if( $this->CI->session->userdata('id_level') == "1"){
				redirect(base_url('admin/home/kalkulasi_pendaftar'),'refresh');
			}
			else if( $this->CI->session->userdata('id_level') == "2"){
				redirect(base_url('admin/home/kalkulasi_pendaftar'),'refresh');
					
			}else if( $this->CI->session->userdata('id_level') == "3"){
				redirect(base_url('admin/home/form_utama'),'refresh');
			}}else{
				redirect(base_url('login'),'refresh');
		}

		}else{

			$this->CI->session->set_flashdata('warning','Anda memasukan nama pengguna atau password yang salah');
			redirect(base_url('login'),'refresh');
		}
	}

	public function cek_login(){
		if($this->CI->session->userdata('id') == "" && $this->CI->session->userdata('id_level') == ""){
			$this->CI->session->set_flashdata('warning','Anda belum login');
			redirect(base_url('login'),'refresh');
		}
	}

	public function logout(){
		//membuang semua session yang telah di set

		$ambil_detail_thn_akademik = $this->CI->admin_model->ambil_detail_thn_akademik(); 
		$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

		$this->CI->session->unset_userdata('id');
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('password');
		$this->CI->session->unset_userdata('id_level');
		$this->CI->session->unset_userdata('foto');
		$this->CI->session->unset_userdata('fakultas');
		$this->CI->session->unset_userdata('status');
		//setelah di buang redirect ke login
		$this->CI->session->set_flashdata('warning','Anda berhasil logout');
			redirect(base_url('login'),'refresh');
		
	}

	public function logout_admin(){
		//membuang semua session yang telah di set

		$ambil_detail_thn_akademik = $this->CI->admin_model->ambil_detail_thn_akademik(); 
		$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

		$this->CI->session->unset_userdata('id');
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('password');
		$this->CI->session->unset_userdata('id_level');
		$this->CI->session->unset_userdata('foto');
		$this->CI->session->unset_userdata('fakultas');
		$this->CI->session->unset_userdata('status');
		//setelah di buang redirect ke login
		$this->CI->session->set_flashdata('warning','Anda berhasil logout');
			redirect(base_url('login/admin'),'refresh');
		
	}

	public function lupa_password($username,$email){
		$check = $this->CI->admin_model->lupa_password($username,$email);
		//jika ada data user, create session login
		if($check){
			$nama 			= $check->nama;
			$id_level		= $check->id_level;

			//create session
			$this->CI->session->set_userdata('nama',$nama);
			$this->CI->session->set_userdata('username',$username);
			$this->CI->session->set_userdata('email',$email);
			$this->CI->session->set_userdata('id_level',$id_level);
			//redirect ke halaman admin yang di proteksi

			$this->CI->session->set_flashdata('warning','Silahkan masukan password baru');
			redirect(base_url('home/password_baru/'),'refresh');
			

		}else{
			$this->CI->session->set_flashdata('warning','Username / Email yang anda masukan tidak cocok, silahkan masukan Username / Email yang benar dan terdaftar');
			redirect(base_url('home/lupa_password'),'refresh');
		}
	}


}