<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Login extends CI_Controller
{
	//HALAMAN LOGIN
	public function index()
	{
		$detail_institusi = $this->admin_model->detail_institusi();

		$this->form_validation->set_rules('username','Username','required',
								array('requiered' => '%s harus diisi'));

		$this->form_validation->set_rules('password','Password','required',
								array('requiered' => '%s harus diisi'));

		if ($this->form_validation->run()) {
			$username 			= $this->input->post('username');
			$password 			= $this->input->post('password');
			//proses ke simpel login
			$this->simple_login->login($username,$password);
		}

		//end valid 
		$data = array('title'             => 'Halaman Login',
					  'detail_institusi'  => $detail_institusi,
                       'isi'              => 'admin/login');
        $this->load->view('admin/login', $data, FALSE);
	}

	public function logout(){
		//ambil dari simple login
			$this->simple_login->logout();
		
	}
}