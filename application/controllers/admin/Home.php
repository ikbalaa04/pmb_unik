<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_CONTROLLER
{
	public function __construct(){
    parent::__construct();
    $this->load->model('admin_model');
    $this->load->model('usm_model');
    $this->load->library('mahasiswa_profile');
    if ($this->input->post('hp') !== NULL) {
        $_POST['hp'] = $this->admin_model->normalize_nomor_wa($this->input->post('hp'));
    }
	//proteksi halaman
    $this->simple_login->cek_login();
    $this->cek_kelengkapan_profil_mahasiswa();
    }

    private function cek_kelengkapan_profil_mahasiswa()
    {
        if ($this->session->userdata('id_level') != '3') {
            return;
        }

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
        if (!$detail_pendaftaran || $this->mahasiswa_profile->is_complete($detail_pendaftaran)) {
            return;
        }

        $method = $this->router->fetch_method();
        $allowed = array('formulir', 'form_utama', 'form_lanjutan', 'isi_form');
        if (in_array($method, $allowed)) {
            return;
        }

        $this->session->set_flashdata(
            'warning',
            'Silakan lengkapi data berikut terlebih dahulu: '.implode(', ', $this->mahasiswa_profile->missing_labels($detail_pendaftaran)).'.'
        );
        redirect(base_url($this->mahasiswa_profile->completion_target($detail_pendaftaran)), 'refresh');
    }

    private function capital_each_word($value)
    {
        $value = trim((string) $value);
        if ($value === '') {
            return $value;
        }

        if (function_exists('mb_convert_case')) {
            return mb_convert_case(mb_strtolower($value, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
        }

        return ucwords(strtolower($value));
    }

    private function capital_each_word_array($values)
    {
        $result = array();
        foreach ((array) $values as $value) {
            $result[] = $this->capital_each_word($value);
        }

        return $result;
    }

    public function required_value($value)
    {
        $value = trim((string) $value);
        return $value !== '' && $value !== '-' && $value !== '0';
    }

    private function is_empty_form_value($value)
    {
        $value = trim((string) $value);
        return $value === '' || $value === '-' || $value === '0';
    }

    private function post_or_existing($name, $existing, $capital_each_word = FALSE)
    {
        $value = $this->input->post($name);
        if ($this->is_empty_form_value($value)) {
            return $existing;
        }

        return $capital_each_word ? $this->capital_each_word($value) : $value;
    }

    private function post_array_or_existing($name, $existing, $separator, $capital_each_word = FALSE)
    {
        $posted = $this->input->post($name);
        $existing_parts = explode($separator, (string) $existing);

        if (!is_array($posted)) {
            return $existing;
        }

        $result = array();
        $length = max(count($posted), count($existing_parts));
        for ($index = 0; $index < $length; $index++) {
            $value = isset($posted[$index]) ? $posted[$index] : '';
            if ($this->is_empty_form_value($value)) {
                $value = isset($existing_parts[$index]) ? $existing_parts[$index] : '';
            } elseif ($capital_each_word) {
                $value = $this->capital_each_word($value);
            }

            $result[] = $value;
        }

        return implode($separator, $result);
    }

    private function clean_form_value($value, $capital_each_word = FALSE)
    {
        $value = trim((string) $value);
        if ($this->is_empty_form_value($value)) {
            return '';
        }

        return $capital_each_word ? $this->capital_each_word($value) : $value;
    }

    private function form_value_or_legacy($name, $legacy, $separator, $index, $capital_each_word = FALSE)
    {
        $value = $this->input->post($name);
        if ($this->is_empty_form_value($value)) {
            $parts = explode($separator, (string) $legacy);
            $value = isset($parts[$index]) ? $parts[$index] : '';
        }

        return $this->clean_form_value($value, $capital_each_word);
    }

    private function set_if_column_exists(&$data, $column, $value, $table = 'pendaftaran')
    {
        if ($this->db->field_exists($column, $table)) {
            $data[$column] = $value;
        }
    }

    private function legacy_parent_value($legacy, $separator, $index, $capital_each_word = FALSE)
    {
        $parts = explode($separator, (string) $legacy);
        $value = isset($parts[$index]) ? $parts[$index] : '';

        return $this->clean_form_value($value, $capital_each_word);
    }

    private function sync_explicit_parent_columns(&$data, $ortu_nama = '', $ortu_tempat_lahir = '', $ortu_tgl_lahir = '', $ortu_agama = '', $ortu_nik = '', $ortu_pendidikan = '', $ortu_hp = '', $ortu_pekerjaan = '', $ortu_penghasilan = '', $ortu_alamat = '')
    {
        $this->set_if_column_exists($data, 'nama_ayah', $this->legacy_parent_value($ortu_nama, ',', 0, TRUE));
        $this->set_if_column_exists($data, 'nik_ayah', $this->legacy_parent_value($ortu_nik, ',', 0));
        $this->set_if_column_exists($data, 'tempat_lahir_ayah', $this->legacy_parent_value($ortu_tempat_lahir, '|', 0, TRUE));
        $this->set_if_column_exists($data, 'tanggal_lahir_ayah', $this->legacy_parent_value($ortu_tgl_lahir, '|', 0));
        $this->set_if_column_exists($data, 'agama_ayah', $this->legacy_parent_value($ortu_agama, ',', 0));
        $this->set_if_column_exists($data, 'pendidikan_ayah', $this->legacy_parent_value($ortu_pendidikan, ',', 0));
        $this->set_if_column_exists($data, 'hp_ayah', $this->legacy_parent_value($ortu_hp, ',', 0));
        $this->set_if_column_exists($data, 'pekerjaan_ayah', $this->legacy_parent_value($ortu_pekerjaan, ',', 0, TRUE));
        $this->set_if_column_exists($data, 'penghasilan_ayah', $this->legacy_parent_value($ortu_penghasilan, ',', 0));
        $this->set_if_column_exists($data, 'nama_ibu', $this->legacy_parent_value($ortu_nama, ',', 1, TRUE));
        $this->set_if_column_exists($data, 'nik_ibu', $this->legacy_parent_value($ortu_nik, ',', 1));
        $this->set_if_column_exists($data, 'tempat_lahir_ibu', $this->legacy_parent_value($ortu_tempat_lahir, '|', 1, TRUE));
        $this->set_if_column_exists($data, 'tanggal_lahir_ibu', $this->legacy_parent_value($ortu_tgl_lahir, '|', 1));
        $this->set_if_column_exists($data, 'agama_ibu', $this->legacy_parent_value($ortu_agama, ',', 1));
        $this->set_if_column_exists($data, 'pendidikan_ibu', $this->legacy_parent_value($ortu_pendidikan, ',', 1));
        $this->set_if_column_exists($data, 'hp_ibu', $this->legacy_parent_value($ortu_hp, ',', 1));
        $this->set_if_column_exists($data, 'pekerjaan_ibu', $this->legacy_parent_value($ortu_pekerjaan, ',', 1, TRUE));
        $this->set_if_column_exists($data, 'penghasilan_ibu', $this->legacy_parent_value($ortu_penghasilan, ',', 1));
        $this->set_if_column_exists($data, 'alamat_orang_tua', $this->legacy_parent_value($ortu_alamat, '|', 0));
        $this->set_if_column_exists($data, 'nama_wali', $this->legacy_parent_value($ortu_nama, ',', 2, TRUE));
        $this->set_if_column_exists($data, 'nik_wali', $this->legacy_parent_value($ortu_nik, ',', 2));
        $this->set_if_column_exists($data, 'tempat_lahir_wali', $this->legacy_parent_value($ortu_tempat_lahir, '|', 2, TRUE));
        $this->set_if_column_exists($data, 'tanggal_lahir_wali', $this->legacy_parent_value($ortu_tgl_lahir, '|', 2));
        $this->set_if_column_exists($data, 'agama_wali', $this->legacy_parent_value($ortu_agama, ',', 2));
        $this->set_if_column_exists($data, 'pendidikan_wali', $this->legacy_parent_value($ortu_pendidikan, ',', 2));
        $this->set_if_column_exists($data, 'hp_wali', $this->legacy_parent_value($ortu_hp, ',', 2));
        $this->set_if_column_exists($data, 'pekerjaan_wali', $this->legacy_parent_value($ortu_pekerjaan, ',', 2, TRUE));
        $this->set_if_column_exists($data, 'penghasilan_wali', $this->legacy_parent_value($ortu_penghasilan, ',', 2));
        $this->set_if_column_exists($data, 'alamat_wali', $this->legacy_parent_value($ortu_alamat, '|', 1));
    }

    private function required_post_array_errors($fields)
    {
        $errors = array();
        foreach ($fields as $field) {
            $posted = $this->input->post($field['name']);
            $value = is_array($posted) && isset($posted[$field['index']]) ? $posted[$field['index']] : '';
            if ($this->is_empty_form_value($value)) {
                $errors[] = $field['label'].' harus diisi';
            }
        }

        return $errors;
    }

    //Menu Dasbor
    public function dasbor(){
        $detail_pendaftaran 		= $this->admin_model->detail_pendaftaran_mahasiswa();
        $total_pendaftar  			= $this->admin_model->total_pendaftar(); 
        $total_pendaftar_kimia  	= $this->admin_model->total_pendaftar_kimia(); 
        $total_pendaftar_apoteker  	= $this->admin_model->total_pendaftar_apoteker(); 

        $data = array('title' 					=> 'Halaman Dasbor',
        			  'detail'					=> $detail_pendaftaran,
        			  'total_pendaftar'			=> $total_pendaftar,
        			  'total_pendaftar_kimia'	=> $total_pendaftar_kimia,
        			  'total_pendaftar_apoteker'=> $total_pendaftar_apoteker,
                      'isi'   					=> 'admin/dasbor/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function normalisasi_nomor_wa_lama(){
        $result = $this->admin_model->update_nomor_wa_lama();
        $this->session->set_flashdata('success', 'Normalisasi nomor WA selesai. Pendaftaran: '.$result['pendaftaran'].', Agen: '.$result['agen'].', Pengguna: '.$result['pengguna']);
        redirect(base_url('admin/home/dasbor'),'refresh');
    }
    //End Dasbor

    //Menu Data Pengguna 
    public function pengguna(){
    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

		$pengguna = $this->admin_model->listing_pengguna($id_thn_akademik);

		$data = array( 'title' => 'Halaman Pengguna',
								   'pengguna'  => $pengguna,
								   'isi'   => 'admin/pengguna/list');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function user_admin(){

		$pengguna = $this->admin_model->listing_pengguna_admin();

		$data = array( 'title' => 'Halaman Pengguna Admin',
								   'pengguna'  => $pengguna,
								   'isi'   => 'admin/pengguna/list_admin');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function tambah_pengguna(){

		$level 			= $this->admin_model->listing_level(); 
		$pilih_fakultas = $this->admin_model->pilih_fakultas(); 

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama','Nama lengkap','required',
					array('required' => '%s harus diisi'));

		$valid->set_rules('username','Username','required|min_length[6]|max_length[32]|is_unique[pengguna.username]',
					array('required'   => '%s harus diisi',
						  'min_length' => '%s minimal 6 karakter',
						  'max_length' => '%s maksimal 32 karakter',
						  'is_unique'  => '%s sudah ada. Buat username baru.'));

		$valid->set_rules('username','Username','required|is_unique[user.username]',
					array('required'   => '%s harus diisi',
						  'is_unique'  => '%s sudah ada. Buat username baru.'));

		$valid->set_rules('password','Password','required|min_length[6]',
					array( 'required' 	=> '%s harus diisi',
						   'min_length' => '%s minimal 6 karakter'));

		if($valid->run()===FALSE){
			//end validasi

		$data = array( 'title' 		=> 'Halaman Tambah Pengguna',
					   'level'   	=> $level,
					   'fakultas'   => $pilih_fakultas,
					   'isi'   		=> 'admin/pengguna/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i=$this->input;
			$data = array(  'nama' 			=> $i->post('nama'),
											'username' 		=> $i->post('username'),
											'password' 		=> md5($i->post('password')),
											'email' 		=> $i->post('email'),
											'hp' 			=> $i->post('hp'),
											'id_level' 		=> $i->post('id_level'),
											'fakultas' 		=> $i->post('fakultas'),
											'status' 		=> $i->post('status'));
			$this->admin_model->tambah_pengguna($data);

			$data_user = array( 'username' 		=> $i->post('username'),
													'password' 		=> sha1($i->post('password')),
													'nama' 			=> $i->post('nama'),
													'level' 		=> $i->post('level'));
			$this->admin_model->tambah_user($data_user);
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
			redirect(base_url('admin/home/user_admin'),'refresh');
		}
	}

	public function edit_pengguna($id){

		$pengguna 			= $this->admin_model->detail_pengguna($id); 
		$username 	= $pengguna->username;
		$detail_user = $this->admin_model->detail_user($username); 
		$level 			= $this->admin_model->listing_level(); 
		$pilih_fakultas = $this->admin_model->pilih_fakultas(); 

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama','Nama lengkap','required',
					array(		'required' => '%s harus diisi'));

		if($valid->run()){
			//jika foto tidak kosong
			if(! empty($_FILES['foto']['name'])){
			$config['upload_path']   	= './assets/upload/profil/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg|jpeg';
			$config['max_size']      	= 1200; // KB
			$config['encrypt_name']   	= TRUE;

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('foto')) {
		
		//end validasi

		$data = array( 'title' 		=> 'Halaman Edit Pengguna : ' . $pengguna->nama,
					   'pengguna'  		=> $pengguna,
					   'level'   	=> $level,
					   'fakultas'   => $pilih_fakultas,
					   'error'   	=> $this->upload->display_errors(),
					   'isi'   		=> 'admin/pengguna/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/profil/'.$upload_foto['upload_data']['file_name'];
			//lokasi thumbs
			$config['new_image']		= './assets/upload/profil/thumbs/'.$upload_foto['upload_data']['file_name'];
			$config['create_thumb']		= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; //pixel
			$config['height']       	= 250;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail

			if($pengguna->foto != ""){
			unlink('./assets/upload/profil/'.$pengguna->foto);
			unlink('./assets/upload/profil/thumbs/'.$pengguna->foto);
			}
			
			$i=$this->input;
			$data = array(  'id' 			=> $pengguna->id,
							'nama' 			=> $i->post('nama'),
							'username' 		=> $i->post('username'),
							'email' 		=> $i->post('email'),
							'hp' 			=> $i->post('hp'),
							'foto' 			=> $upload_foto['upload_data']['file_name'],
							'id_level' 		=> $i->post('id_level'),
							'fakultas' 		=> $i->post('fakultas'),
							'status' 		=> $i->post('status'));
			$this->admin_model->edit_pengguna($data);

			$detail_user = array(  'username' 		=> $detail_user->username,
														'nama' 			=> $i->post('nama'),
													'level' 		=> $i->post('level'));
			$this->admin_model->edit_user($detail_user);

			$this->session->set_flashdata('success', 'Data berhasil diedit');
			redirect(base_url('admin/home/user_admin'),'refresh');
		}}else{
			//tanpa foto
			$i=$this->input;
			//slug
			$data = array(  'id' 			=> $pengguna->id,
							'nama' 			=> $i->post('nama'),
							'username' 		=> $i->post('username'),
							'email' 		=> $i->post('email'),
							'hp' 			=> $i->post('hp'),
							'id_level' 		=> $i->post('id_level'),
							'fakultas' 		=> $i->post('fakultas'),
							'status' 		=> $i->post('status')
		);
			$this->admin_model->edit_pengguna($data);

			$detail_user = array(  'username' 		=> $detail_user->username,
														'nama' 			=> $i->post('nama'),
													'level' 		=> $i->post('level'));
			$this->admin_model->edit_user($detail_user);

			$this->session->set_flashdata('success', 'Data berhasil diedit');
			redirect(base_url('admin/home/user_admin'),'refresh');
		}}
			$data = array( 'title' 		=> 'Halaman Edit Pengguna : ' . $pengguna->nama,
					   	   'pengguna'  		=> $pengguna,
					       'level'   	=> $level,
					       'fakultas'   => $pilih_fakultas,
					       'isi'   		=> 'admin/pengguna/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function ePass($id){

		$pengguna  		= $this->admin_model->detail_pengguna($id); 
		$level 		= $this->admin_model->listing_level(); 
		
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('password','Password','required|min_length[3]',
					array( 'required' 	=> '%s harus diisi',
						   'min_length' => '%s minimal 3 karakter'));

		if($valid->run()===FALSE){
			//end validasi

		$data = array( 'title' 		=> 'Halaman Edit Pengguna : ' . $pengguna->nama,
					   'pengguna'  		=> $pengguna,
					   'level'   	=> $level,
					   'isi'   		=> 'admin/pengguna/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			
			$i=$this->input;

        	$data = array(  'id'          => $pengguna->id,
                        	'password'    => md5($i->post('password'))
      );
        $this->admin_model->edit_pengguna($data);

        $username 	= $pengguna->username;
		$detail_user = $this->admin_model->detail_user($username); 
        $detail_user = array(  'username' 		=> $detail_user->username,
							   'password' 			=> sha1($i->post('password')));
			$this->admin_model->edit_user($detail_user);

        $this->session->set_flashdata('success', 'Password berhasil diubah');
		redirect(base_url('admin/home/user_admin'),'refresh');
		}
	}

	public function delete_pengguna($id){
			$data=array('id' => $id);
			$this->admin_model->delete_pengguna($data);

			$detail_pengguna = $this->admin_model->detail_pengguna($id);
			$username = $detail_pengguna->username;

			$data_user=array('username' => $username);
			$this->admin_model->delete_user($data_user);
			

			$this->session->set_flashdata('success', 'Data berhasil di hapus');
			redirect(base_url('admin/home/user_admin'),'refresh');
	}

	//End menu Data Pengguna 

	//Menu konfigurasi institusi
	public function konfigurasi(){

        $detail_institusi = $this->admin_model->detail_institusi();

       //validasi input
	    $valid = $this->form_validation;

	    $data = array( 'title'      				=> 'Halaman Konfigurasi Utama',
	                   'detail_institusi'        	=>  $detail_institusi, 
	                   'isi'       					=> 'admin/konfigurasi/list');
	    $this->load->view('admin/layout/wrapper', $data, FALSE);
	    
	   }

	public function edit_konfigurasi(){

        $detail_institusi = $this->admin_model->detail_institusi();

       //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules( 'nama','Nama Universitas','required',
	                  array( 'required' => '%s harus diisi'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'      				=> 'Halaman Konfigurasi Utama',
	                   'detail_institusi'        	=>  $detail_institusi, 
	                   'isi'       					=> 'admin/konfigurasi/list');
	    $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;
	      $data = array(    'id'                	=> $detail_institusi->id,
	                        'deskripsi'           => $i->post('deskripsi'),
	                        'nama'              	=> $i->post('nama'),
	                        'deskripsi_beranda'    => $i->post('deskripsi_beranda'),
	                        'judul'             => $i->post('judul'),
	                        'singkatan'             => $i->post('singkatan'),
	                        'alamat'        		=> $i->post('alamat'),
	                        'ukuran_biaya'        	=> $i->post('ukuran_biaya'),
	                        'email'          		=> $i->post('email'),
	                        'telp'        			=> $i->post('telp'),
	                        'about'        			=> $i->post('about'),
	                        'informasi_utama'       => $i->post('informasi_utama'),
	                        'alur_pendaftaran'       => $i->post('alur_pendaftaran'),
	                        'fb'        			=> $i->post('fb'),
	                        'ig'        			=> $i->post('ig'),
	                        'twitter'          		=> $i->post('twitter'),
	                        'website'				=> $i->post('website'),
	                        'panduan_website'		=> $i->post('panduan_website'),
	                        'panduan_mahasiswa'		=> $i->post('panduan_mahasiswa'),
	                        'kota'					=> $i->post('kota'),
	                        'maps'        			=> $i->post('maps'),
	                        'syarat_berkas'          		=> $i->post('syarat_berkas'),
	                        'wa_konfirmasi'		=> $i->post('wa_konfirmasi'),
	                        'wa_konfirmasi_berkas'					=> $i->post('wa_konfirmasi_berkas'),
	                        'batas_lulus'					=> $i->post('batas_lulus'),
	                        'status_batas_lulus'					=> $i->post('status_batas_lulus'),
	                        'status_pencairan'					=> $i->post('status_pencairan')
	      );
	      if ($this->db->field_exists('wa_group', 'konfigurasi')) {
	        $data['wa_group'] = $i->post('wa_group');
	      }
	      if ($this->db->field_exists('wa_group_kelulusan', 'konfigurasi')) {
	        $data['wa_group_kelulusan'] = $i->post('wa_group_kelulusan');
	      }
	      $this->admin_model->edit_institusi($data);
	      $this->session->set_flashdata('success', 'Data telah diedit');
	      redirect(base_url('admin/home/konfigurasi'),'refresh');
	    }
	   }


	   //edit kongigurasi logo
	   public function konfigurasi_logo(){

		$detail_institusi = $this->admin_model->detail_institusi();
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules( 'id','id instansi','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
		
			$config['upload_path']   	= './assets/upload/logo/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg|jpeg';
			$config['max_size']      	= 1000; // KB

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('logo')) {
		
		//end validasi

		$data = array( 'title'   			=> 'Halaman Edit Logo',
					   'detail_institusi'	=> $detail_institusi,
					   'error'   			=> $this->upload->display_errors(),
					   'isi'     			=> 'admin/institusi/logo');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/logo/'.$upload_foto['upload_data']['file_name'];
			//lokasi thumbs
			$config['new_image']		= './assets/upload/logo/thumbs/'.$upload_foto['upload_data']['file_name'];
			$config['create_thumb']		= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; //pixel
			$config['height']       	= 250;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail

			if($detail_institusi->logo != ""){
				unlink('./assets/upload/logo/'.$detail_institusi->logo);
				unlink('./assets/upload/logo/thumbs/'.$detail_institusi->logo);
			}
			
			$i=$this->input;
			//slug
			$data = array(  'id' 				=> $detail_institusi->id,				
							'logo' 				=> $upload_foto['upload_data']['file_name']
		);
			$this->admin_model->edit_institusi($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/konfigurasi_logo'),'refresh');
		}}
			$data = array( 	'title'   			=> 'Halaman Edit Logo',
					   		'detail_institusi'	=> $detail_institusi,
					   		'isi'     			=> 'admin/konfigurasi/logo');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function konfigurasi_bg(){

		$detail_institusi = $this->admin_model->detail_institusi();
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules( 'id','id instansi','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
		
			$config['upload_path']   	= './assets/upload/bg/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg|jpeg';
			$config['max_size']      	= 3000; // KB

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('bg')) {
		
		//end validasi

		$data = array( 'title'   			=> 'Halaman Edit Background Login',
					   'detail_institusi'	=> $detail_institusi,
					   'error'   			=> $this->upload->display_errors(),
					   'isi'     			=> 'admin/konfigurasi/bg');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/bg/'.$upload_foto['upload_data']['file_name'];
			//lokasi thumbs
			$config['new_image']		= './assets/upload/bg/thumbs/'.$upload_foto['upload_data']['file_name'];
			$config['create_thumb']		= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 500; //pixel
			$config['height']       	= 500;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail

			if($detail_institusi->bg != ""){
				unlink('./assets/upload/bg/'.$detail_institusi->bg);
				unlink('./assets/upload/bg/thumbs/'.$detail_institusi->bg);
			}
			
			$i=$this->input;
			//slug
			$data = array(  'id' 				=> $detail_institusi->id,				
							'bg' 				=> $upload_foto['upload_data']['file_name']
		);
			$this->admin_model->edit_institusi($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/konfigurasi_bg'),'refresh');
		}}
			$data = array( 	'title'   			=> 'Halaman Edit Background',
					   		'detail_institusi'	=> $detail_institusi,
					   		'isi'     			=> 'admin/konfigurasi/bg');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function konfigurasi_bg_beranda(){

		$detail_institusi = $this->admin_model->detail_institusi();
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules( 'id','id instansi','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
		
			$config['upload_path']   	= './assets/upload/bg/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg|jpeg';
			$config['max_size']      	= 3000; // KB

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('bg_beranda')) {
		
		//end validasi

		$data = array( 'title'   			=> 'Halaman Edit Background',
					   'detail_institusi'	=> $detail_institusi,
					   'error'   			=> $this->upload->display_errors(),
					   'isi'     			=> 'admin/konfigurasi/bg');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/bg/'.$upload_foto['upload_data']['file_name'];
			//lokasi thumbs
			$config['new_image']		= './assets/upload/bg/thumbs/'.$upload_foto['upload_data']['file_name'];
			$config['create_thumb']		= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 500; //pixel
			$config['height']       	= 500;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail

			if($detail_institusi->bg_beranda != ""){
				unlink('./assets/upload/bg/'.$detail_institusi->bg_beranda);
				unlink('./assets/upload/bg/thumbs/'.$detail_institusi->bg_beranda);
			}
			
			$i=$this->input;
			//slug
			$data = array(  'id' 				=> $detail_institusi->id,				
							'bg_beranda' 		=> $upload_foto['upload_data']['file_name']
		);
			$this->admin_model->edit_institusi($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/konfigurasi_bg'),'refresh');
		}}
			$data = array( 	'title'   			=> 'Halaman Edit Background',
					   		'detail_institusi'	=> $detail_institusi,
					   		'isi'     			=> 'admin/konfigurasi/bg');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	//Menu Gelombang
	public function gelombang(){
		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
		 $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $list_gelombang 		= $this->admin_model->list_gelombang($id_thn_akademik);

        $data = array( 'title'          		=> 'Halaman Data Gelombang',
                       'list_gelombang' 		=> $list_gelombang,
                       'isi'            		=> 'admin/gelombang/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function edit_gelombang_aktiv(){
        $i 	= $this->input;
        $id = $i->post('id'); 

        $data = array('gelombang_aktiv' => $id);
        $this->admin_model->edit_gelombang_aktiv($data);
        redirect(base_url('admin/home/gelombang'),'refresh');
    }

    public function tambah_gelombang(){

      $pilih_fakultas 		= $this->admin_model->pilih_fakultas();
      $valid 				= $this->form_validation;

      $valid->set_rules( 'nama','Nama gelombang','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      		=> 'Penerimaan Mahasiswa Baru',
       				 'pilih_fakultas'	=> $pilih_fakultas,
                     'isi'        		=> 'admin/gelombang/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

		 $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
		 $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $i=$this->input;
        $data = array(  'fakultas'			=> $i->post('fakultas'),
                        'nama'              => $i->post('nama'),
                        'kode'              => $i->post('kode'),
                        // 'date_start'        => $i->post('date_start'),
                        'date_end'          => $i->post('date_end'),
                        'tahun'             => $i->post('tahun'),
                        'angkatan'          => $i->post('angkatan'),
                        'status'          	=> $i->post('status'),
                        'keterangan'        => $i->post('keterangan'),
                        'thn_akademik'      => $id_thn_akademik
      );
        if($id_thn_akademik){
        $this->admin_model->tambah_gelombang($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/gelombang'),'refresh');
        }else{
        $this->session->set_flashdata('success', 'Tahun akademik tidak ada yang aktif');
        redirect(base_url('admin/home/gelombang'),'refresh');
        }
        
      }

    }

    public function edit_gelombang($id){

    $pilih_fakultas 		= $this->admin_model->pilih_fakultas();
    $list 					= $this->admin_model->detail_gelombang($id);

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama gelombang','required',
                array( 'required' => '%s harus diisi'));
    
    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'  		=> 'Halaman Edit Gelombang',
                   'list'   		=> $list, 
                   'pilih_fakultas'	=> $pilih_fakultas,
                   'isi'    		=> 'admin/gelombang/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;

      $data = array(    'id'                => $id,
      					'fakultas'			=> $i->post('fakultas'),
                        'nama'              => $i->post('nama'),
                        'kode'              => $i->post('kode'),
                        // 'date_start'        => $i->post('date_start'),
                        'date_end'          => $i->post('date_end'),
                        'tahun'             => $i->post('tahun'),
                        'angkatan'          => $i->post('angkatan'),
                        'status'          	=> $i->post('status'),
                        'keterangan'        => $i->post('keterangan')
      );
      $this->admin_model->edit_gelombang($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/gelombang'),'refresh');
    }
  }

  public function delete_gelombang($id){
      $data=array('id' => $id);
      $this->admin_model->delete_gelombang($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/gelombang'),'refresh');
  }

  public function aktiv_gelombang($id_gelombang){

      $gelombang_aktiv_pilih  = $this->admin_model->gelombang_aktiv_pilih();
      $i=$this->input;

      $data = array(    'id_gelombang'       => 1,
                        'aktiv'              => $i->post('id_gelombang_aktiv'),
      );
      $this->admin_model->pilih_gelombang_aktiv($id_gelombang, $data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/gelombang'),'refresh');
    
  }
	//End menu gelombang

  	//Menu program kuliah
  	public function program_kuliah(){
        $list_program = $this->admin_model->list_program();

        $data = array( 'title'          => 'Halaman Program Kuliah',
                       'list_program'   => $list_program,
                       'isi'            => 'admin/program_kuliah/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_program_kuliah(){

      $pilih_fakultas 	= $this->admin_model->pilih_fakultas();
      $valid = $this->form_validation;

      $valid->set_rules( 'nama','Nama jenis_daftar','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      		=> 'Halaman Tambah Program Kuliah', 
                     'pilih_fakultas'   => $pilih_fakultas, 
                     'isi'         		=> 'admin/program_kuliah/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'kode'              => $i->post('kode'),
                        'nama'              => $i->post('nama'),
                        'status'            => $i->post('status'),
                        'keterangan'        => $i->post('keterangan'),
                        'tipe_program'        => $i->post('tipe_program')
      );
        $this->admin_model->tambah_program($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/program_kuliah'),'refresh');
      }

    }

    public function edit_program_kuliah($id){

    $pilih_fakultas = $this->admin_model->pilih_fakultas();
    $list 			= $this->admin_model->detail_program($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama jenis daftar','required',
                  array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array(  'title'                   => 'Halaman Edit Jenis Pendaftar',
                    'list'                    => $list, 
                    'pilih_fakultas'          => $pilih_fakultas, 
                    'isi'                     => 'admin/program_kuliah/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                => $id,
                        'kode'              => $i->post('kode'),
                        'nama'              => $i->post('nama'),
                        'status'            => $i->post('status'),
                        'keterangan'        => $i->post('keterangan'),
                        'tipe_program'        => $i->post('tipe_program')

      );
      $this->admin_model->edit_program($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/program_kuliah'),'refresh');
    }
  }

  public function delete_program_kuliah($id){
      $data=array('id' => $id);
      $this->admin_model->delete_program($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/program_kuliah'),'refresh');
  }
  	//End program kuliah

  //Menu jenis daftar
  public function jenis_daftar(){
        $list_jenis = $this->admin_model->list_jenis();

        $data = array( 'title'          => 'Halaman Jenis Pendaftar',
                       'list_jenis' 	=> $list_jenis,
                       'isi'            => 'admin/jenis_pendaftar/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_jenis_daftar(){

      $valid = $this->form_validation;

      $valid->set_rules( 'nama','Nama jenis_daftar','required',
                    array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Jenis Pendaftar',
                    'isi'         => 'admin/jenis_pendaftar/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'kode'              => $i->post('kode'),
                        'nama'              => $i->post('nama'),
                        'status'            => $i->post('status'),
      );
        $this->admin_model->tambah_jenis($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/jenis_daftar'),'refresh');
      }

    }

    public function edit_jenis_daftar($id){

    $detail_jenis = $this->admin_model->detail_jenis($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama jenis daftar','required',
                  array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      			=> 'Halaman Edit Jenis Pendaftar',
                    'detail_jenis'          => $detail_jenis, 
                    'isi'       			=> 'admin/jenis_pendaftar/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                => $id,
                        'kode'              => $i->post('kode'),
                        'nama'              => $i->post('nama'),
                        'status'            => $i->post('status'),
      );
      $this->admin_model->edit_jenis($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/jenis_daftar'),'refresh');
    }
  }

  public function delete_jenis_daftar($id){
      $data=array('id' => $id);
      $this->admin_model->delete_jenis($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/jenis_daftar'),'refresh');
  }
  //End menu jenis daftar

  //Menu Prodi
  public function prodi(){
        $list_prodi = $this->admin_model->list_prodi();

        $data = array( 'title'          => 'Halaman Program Studi',
                       'list_prodi'     => $list_prodi,
                       'isi'            => 'admin/prodi/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_prodi(){

      $pilih_fakultas = $this->admin_model->pilih_fakultas();
      $pilih_jenjang = $this->admin_model->list_jenjang();
      $valid 		  = $this->form_validation;

      $valid->set_rules( 'kode','Kode Prodi','required|is_unique[prodi.kode]',
                  array( 'required'   => '%s harus diisi',
                  	     'is_unique'  => '%s sudah ada. Buat kode baru.'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'           => 'Halaman Tambah Program Studi',
       				 'pilih_fakultas'  => $pilih_fakultas,
       				 'pilih_jenjang'   => $pilih_jenjang,
                     'isi'             => 'admin/prodi/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'fakultas'     => $i->post('fakultas'),
                        'jenjang'      => $i->post('jenjang'),
                        'kode'         => $i->post('kode'),
                        'nama'         => $i->post('nama'),
                        'namabank'     => $i->post('namabank'),
                        'norek'        => $i->post('norek'),
                        'biaya'        => $i->post('biaya'),
                        'status'       => $i->post('status'),
                        'rincian_regis'       => $i->post('rincian_regis')
      );
        $this->admin_model->tambah_prodi($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/prodi'),'refresh');
      }

    }

    public function edit_prodi($id){

    $detail_prodi = $this->admin_model->detail_prodi($id); 
    $pilih_fakultas = $this->admin_model->pilih_fakultas();
    $pilih_jenjang = $this->admin_model->list_jenjang();

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama Prodi','required',
                array( 'required'   => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'                    => 'Halaman Edit Program Studi',
                    'detail_prodi'            => $detail_prodi, 
                    'pilih_fakultas'  		  => $pilih_fakultas,
                    'pilih_jenjang'   => $pilih_jenjang,
                    'isi'                     => 'admin/prodi/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                   => $id,
                        'fakultas'             => $i->post('fakultas'),
                        'jenjang'              => $i->post('jenjang'),
                        'kode'                 => $i->post('kode'),
                        'nama'                 => $i->post('nama'),
                        'namabank'             => $i->post('namabank'),
                        'norek'                => $i->post('norek'),
                        'biaya'                => $i->post('biaya'),
                        'status'       		   => $i->post('status'),
                        'rincian_regis'       => $i->post('rincian_regis')
      );
      $this->admin_model->edit_prodi($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/prodi'),'refresh');
    }
  }

  public function delete_prodi($id){
      $data=array('id' => $id);
      $this->admin_model->delete_prodi($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/prodi'),'refresh');
  }
  //End menu prodi

  //Menu fakultas
  public function fakultas(){
        $list_fakultas = $this->admin_model->list_fakultas();

        $data = array( 'title'          => 'Halaman Data Fakultas',
                       'list_fakultas' 	=> $list_fakultas,
                       'isi'            => 'admin/fakultas/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_fakultas(){

      $detail_institusi = $this->admin_model->pilih_institusi(); 
      $valid = $this->form_validation;

      $valid->set_rules( 'nama_fakultas','Nama Fakultas','required',
                    array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      		=> 'Halaman Tambah Fakultas',
       				 'detail_institusi' => $detail_institusi,
                     'isi'         		=> 'admin/fakultas/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'id_institusi'      => $i->post('id_institusi'),
        				'kode'              => $i->post('kode'),
                        'nama_fakultas'     => $i->post('nama_fakultas'),
                        'singkatan'     	=> $i->post('singkatan'),
                        'status'     		=> $i->post('status')
      );
        $this->admin_model->tambah_fakultas($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/fakultas'),'refresh');
      }

    }

    public function edit_fakultas($id){

    $detail_fakultas = $this->admin_model->detail_fakultas($id); 
    $detail_institusi = $this->admin_model->pilih_institusi(); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama_fakultas','Nama Fakultas','required',
                  array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      		=> 'Halaman Edit Fakultas',
                   'detail_fakultas'    => $detail_fakultas, 
                   'detail_institusi'   => $detail_institusi,
                   'isi'       			=> 'admin/fakultas/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                => $id,
                        'id_institusi'      => $i->post('id_institusi'),
        				'kode'              => $i->post('kode'),
                        'nama_fakultas'     => $i->post('nama_fakultas'),
                        'singkatan'     	=> $i->post('singkatan'),
                        'status'     		=> $i->post('status')
      );
      $this->admin_model->edit_fakultas($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/fakultas'),'refresh');
    }
  }

  public function delete_fakultas($id){
      $data=array('id' => $id);
      $this->admin_model->delete_fakultas($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/fakultas'),'refresh');
  }
  //End menu fakultas

  //karantina

    public function tandai_karantina($id){
        
        $date 			    = date('y-m-d h:i:s');
        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 	   			=> $detail_pendaftaran->id,
        			  'bayar' 			=> '1',
                      'tanggal_update'  => $date);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/karantina'),'refresh');
    }

    public function tolak_karantina($id){
        
        $date 			    = date('y-m-d h:i:s');
        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 	   			=> $detail_pendaftaran->id,
        			  'verifikasi_karantina' => '1',
                      'tanggal_update'  => $date);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/karantina'),'refresh');
    }

    public function tandai_karantina_agen($id){
        
        $date 			    = date('y-m-d h:i:s');
        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 	   			=> $detail_pendaftaran->id,
        			  'bayar' 			=> '1',
                      'tanggal_update'  => $date);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/karantina_agen/'.$detail_pendaftaran->kode_agen),'refresh');
    }

    public function delete_karantina($id){
      $data = array('id' => $id);
      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $data_user = array('username' => $detail_pendaftaran->username);

	  $this->admin_model->delete_pengguna_user($data_user);
      $this->admin_model->delete_karantina($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/karantina'),'refresh');
  	}

  	public function delete_karantina_agen($id){
      $data = array('id' => $id);
      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $data_user = array('username' => $detail_pendaftaran->username);

	  $this->admin_model->delete_pengguna_user($data_user);
      $this->admin_model->delete_karantina($data);
      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/karantina_agen/'.$detail_pendaftaran->kode_agen),'refresh');
  	}

  	public function excel_karantina(){
  		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $excel_pmb          = $this->admin_model->excel_karantina($id_thn_akademik);
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();

        $data = array('title'   		=> 'Export Data Karantina PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'isi'     		=> 'admin/karantina/excel');
        $this->load->view('admin/karantina/excel', $data, FALSE);
    }

    public function karantina_agen($kode_agen){
 
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $karantina 			  = $this->admin_model->karantina_agen($id_thn_akademik,$kode_agen);
        
        $data = array( 'title'          			=> count($karantina).'&nbsp;Data Belum Bayar',
                       'karantina'     				=> $karantina,
                       'isi'            			=> 'admin/agen/karantina');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

  	public function karantina(){
 
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        if ($this->session->userdata('id_level')=='1') {
          $karantina 			  = $this->admin_model->karantina($id_thn_akademik);
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $karantina   	 	 = $this->admin_model->karantina($id_thn_akademik);
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
          
        }
        

        $data = array( 'title'          			=> count($karantina).'&nbsp;Data Belum Bayar',
                       'karantina'     				=> $karantina,
                       // 'detail_tahun'				=> $detail_tahun,
                       'pilih_gelombang'   			=> $pilih_gelombang,
                       'isi'            			=> 'admin/karantina/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function karantina_filter(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $karantina 			= $this->admin_model->karantina_filter($id_thn_akademik);

        if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          			=> count($karantina).'&nbsp;Data Karantina',
                       'karantina'     				=> $karantina,
                       'pilih_gelombang'   		=> $pilih_gelombang,
                       'isi'           	 			=> 'admin/karantina/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

  //end karantina

  //verifikasi
    public function verifikasi(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        if ($this->session->userdata('id_level')=='1') {
          $verifikasi 			  = $this->admin_model->verifikasi($id_thn_akademik);
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);


        }elseif($this->session->userdata('id_level')=='2'){
          $verifikasi   	 	 = $this->admin_model->verifikasi($id_thn_akademik);
          $pilih_gelombang   	 = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          => 'Sudah Bayar Belum Terverifikasi',          
                       'verifikasi'     => $verifikasi,
                       // 'detail_tahun'   => $detail_tahun,
                       // 'pass'           => $pass,
                       'pilih_gelombang'=> $pilih_gelombang,
                       'isi'            => 'admin/verifikasi/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
    
    public function verifikasi_agen($kode_agen){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $verifikasi  = $this->admin_model->verifikasi_agen($id_thn_akademik,$kode_agen);


        $data = array( 'title'          => 'Sudah Bayar Belum Terverifikasi',          
                       'verifikasi'     => $verifikasi,
                       'isi'            => 'admin/agen/verifikasi');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function verifikasi_filter(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $verifikasi 		= $this->admin_model->verifikasi_filter($id_thn_akademik);

        if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          			=> 'Sudah Bayar Belum Terverifikasi',
                       'verifikasi'     			=> $verifikasi,
                       // 'pass'           			=> $pass,
                       // 'detail_tahun'				=> $detail_tahun,
                       'pilih_gelombang'   			=> $pilih_gelombang,
                       'isi'           	 			=> 'admin/verifikasi/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tandai_verifikasi($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $date = date('Y-m-d h:i:s');
        $today = date('Y-m-d');
        $kode = $detail_pendaftaran->jurusan_pilihan;
        $detail_prodi = $this->admin_model->detail_prodi_kode($kode);

        $id_thn_akademik = $detail_pendaftaran->tahun_akademik;
        $detail_thn_akademik = $this->admin_model->detail_thn_akademik($id_thn_akademik);
        $grup_nama = $detail_thn_akademik->nama_thn_akademik;
        $detail_grup_nama = $this->admin_model->detail_grup_nama($grup_nama);

        $id_gelombang = $detail_pendaftaran->gelombang;
        $detail_gelombang_id = $this->admin_model->detail_gelombang_id($id_gelombang); 
        
        

        if($detail_pendaftaran->approve == '0'){
        $data = array('id' 				=> $detail_pendaftaran->id,
        	          'approve' 		=> '1',
                      'jumlahbayar' 	=> $detail_prodi->biaya,
                      'tanggal_update' 	=> $date);
        $this->admin_model->edit_pendaftaran($data);

        $data_tes = array(   'user_grup_id'   => $detail_grup_nama->grup_id,
	                         'user_name'      => $detail_pendaftaran->username,
	                         'user_password'  => $detail_pendaftaran->password,
	                         'user_firstname' => $detail_pendaftaran->nama_lengkap,
	                         'user_level'	  => "1",
	                         'user_detail'	  => $detail_gelombang_id->nama
         );
        $this->admin_model->tambah_user_tes($data_tes);

        if($detail_pendaftaran->kode_agen == "Mandiri"){

        $data2 = array(  'id_pendaftaran'  => $detail_pendaftaran->id,
                         'tanggal_konfirmasi'=> $today,
                         'kode_agen'       => "Mandiri",
                         'komisi'          => "0",
                         'saldo_pika'       => $detail_prodi->biaya,
                         'thn_akademik'     => $detail_pendaftaran->tahun_akademik,
                         'jenis_agen'     => "Mandiri"
         );
        $this->admin_model->tambah_konfirmasi($data2);

        }else{

	        $kode_agen = $detail_pendaftaran->kode_agen;
	        $detail_agen = $this->agen_model->detail_agen_kode($kode_agen);
	        $jenis_komisi = $detail_agen->jenis_agen;
	        $detail_agen_jenis = $this->admin_model->detail_agen_jenis($jenis_komisi);

	        $data2 = array(  'id_pendaftaran'  => $detail_pendaftaran->id,
	                         'tanggal_konfirmasi'=> $today,
	                         'kode_agen'       => $detail_pendaftaran->kode_agen,
	                         'komisi'          => $detail_agen_jenis->jumlah_komisi,
	                         'saldo_pika'      => $detail_prodi->biaya,
                           'thn_akademik'    => $detail_pendaftaran->tahun_akademik,
                           'jenis_agen'      => $detail_agen_jenis->nama_komisi
	         );
	        $this->admin_model->tambah_konfirmasi($data2);
        }}else{
        $this->session->set_flashdata('success', 'Data sudah diverifikasi');
        redirect(base_url('admin/home/verifikasi'),'refresh');
        }

        redirect(base_url('admin/home/verifikasi'),'refresh');
    }

    public function tandai_verifikasi_agen($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $date = date('Y-m-d h:i:s');
        $today = date('Y-m-d');
        $kode = $detail_pendaftaran->jurusan_pilihan;
        $detail_prodi = $this->admin_model->detail_prodi_kode($kode);

        $id_thn_akademik = $detail_pendaftaran->tahun_akademik;
        $detail_thn_akademik = $this->admin_model->detail_thn_akademik($id_thn_akademik);
        $grup_nama = $detail_thn_akademik->nama_thn_akademik;
        $detail_grup_nama = $this->admin_model->detail_grup_nama($grup_nama);

        $id_gelombang = $detail_pendaftaran->gelombang;
        $detail_gelombang_id = $this->admin_model->detail_gelombang_id($id_gelombang); 
        
        

        if($detail_pendaftaran->approve == '0'){
        $data = array('id' 				=> $detail_pendaftaran->id,
        	          'approve' 		=> '1',
                      'jumlahbayar' 	=> $detail_prodi->biaya,
                      'tanggal_update' 	=> $date);
        $this->admin_model->edit_pendaftaran($data);

        $data_tes = array(   'user_grup_id'   => $detail_grup_nama->grup_id,
	                         'user_name'      => $detail_pendaftaran->username,
	                         'user_password'  => $detail_pendaftaran->password,
	                         'user_firstname' => $detail_pendaftaran->nama_lengkap,
	                         'user_level'	  => "1",
	                         'user_detail'	  => $detail_gelombang_id->nama
         );
        $this->admin_model->tambah_user_tes($data_tes);

        if($detail_pendaftaran->kode_agen == "Mandiri"){

        $data2 = array(  'id_pendaftaran'  => $detail_pendaftaran->id,
                         'tanggal_konfirmasi'=> $today,
                         'kode_agen'       => "Mandiri",
                         'komisi'          => "0",
                         'saldo_pika'       => $detail_prodi->biaya,
                         'thn_akademik'     => $detail_pendaftaran->tahun_akademik,
                         'jenis_agen'     => "Mandiri"
         );
        $this->admin_model->tambah_konfirmasi($data2);

        }else{

	        $kode_agen = $detail_pendaftaran->kode_agen;
	        $detail_agen = $this->agen_model->detail_agen_kode($kode_agen);
	        $jenis_komisi = $detail_agen->jenis_agen;
	        $detail_agen_jenis = $this->admin_model->detail_agen_jenis($jenis_komisi);

	        $data2 = array(  'id_pendaftaran'  => $detail_pendaftaran->id,
	                         'tanggal_konfirmasi'=> $today,
	                         'kode_agen'       => $detail_pendaftaran->kode_agen,
	                         'komisi'          => $detail_agen_jenis->jumlah_komisi,
	                         'saldo_pika'      => $detail_prodi->biaya,
                           'thn_akademik'    => $detail_pendaftaran->tahun_akademik,
                           'jenis_agen'      => $detail_agen_jenis->nama_komisi
	         );
	        $this->admin_model->tambah_konfirmasi($data2);
        }}else{
        $this->session->set_flashdata('success', 'Data sudah diverifikasi');
        redirect(base_url('admin/home/verifikasi_agen/'.$detail_pendaftaran->kode_agen),'refresh');
        }

        redirect(base_url('admin/home/verifikasi_agen/'.$detail_pendaftaran->kode_agen),'refresh');
    }

    public function back_verifikasi($id){

    	$detail_pendaftaran 		= $this->admin_model->detail_pendaftaran($id);
        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'bayar' 		=> '0');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/verifikasi'),'refresh');

    }

    public function balik_verifikasi($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'approve' 	=> '0');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/verifikasi'),'refresh');

    }

    public function unduh($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/bukti/';
      $file   = $detail_pendaftaran->bukti_bayar;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_regis($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/bukti/';
      $file   = $detail_pendaftaran->bukti_regis;
      force_download($folder.$file, NULL);
  	
  	}

  	public function edit_verifikasi($id){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
  		$jenjang 			= $this->admin_model->list_jenjang_aktif();
  		$list_jenis 		= $this->admin_model->list_jenis();
  		$list_penghasilan 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan1 	= $this->admin_model->list_penghasilan();
  		$fakultas 			= $detail_pendaftaran->fakultas;
  		$select_fakultas	= $this->admin_model->select_fakultas($fakultas);
  		$username 			= $detail_pendaftaran->username;
  		$pengguna 				= $this->admin_model->detail_pengguna_verifikasi($username);

		if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang 		  = $this->admin_model->edit_verifikasi_gelombang($fakultas);
          $list_program 		  = $this->admin_model->list_program_admin();
          $prodi				  = $this->admin_model->admin_prodi($fakultas);
          $prodi1				  = $this->admin_model->admin_prodi($fakultas);

        }elseif($this->session->userdata('id_level')=='2'){
          $pilih_gelombang 		  = $this->admin_model->edit_verifikasi_gelombang($fakultas);
          $list_program 		  = $this->admin_model->list_program_admin();
          $prodi				  = $this->admin_model->admin_prodi($fakultas);
          $prodi1				  = $this->admin_model->admin_prodi($fakultas);
        }

        //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules('jenjang','Jenjang','required',
	                  array( 'required' => '%s harus dipilih'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Halaman Edit Data Mahasiswa',          
                       'detail'     	  => $detail_pendaftaran,
                       'list_jenis'		  => $list_jenis,
                       'jenjang'		  => $jenjang,
                       'prodi'		      => $prodi,
                       'prodi1'		      => $prodi1,
                       'list_program'	  => $list_program,
                       'pilih_gelombang'  => $pilih_gelombang,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'select_fakultas'  => $select_fakultas,
                       'berkas'			  => $this->admin_model->view($id),
                       'isi'              => 'admin/verifikasi/edit');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;
	      $ortu_nama 		= implode(",", $this->input->post('ortu_nama'));
	      $ortu_tempat_lahir 		= implode("|", $this->input->post('ortu_tempat_lahir'));
	      $ortu_tgl_lahir 		= implode("|", $this->input->post('ortu_tgl_lahir'));
	      $ortu_agama 		= implode(",", $this->input->post('ortu_agama'));
	      $ortu_pendidikan 	= implode(",", $this->input->post('ortu_pendidikan'));
	      $ortu_hp 			= implode(",", $this->input->post('ortu_hp'));
	      $ortu_pekerjaan   = implode(",", $this->input->post('ortu_pekerjaan'));
	      $ortu_penghasilan = implode(",", $this->input->post('ortu_penghasilan'));
	      $ortu_alamat = implode("|", $this->input->post('ortu_alamat'));

	      $data = array(    'id'                => $detail_pendaftaran->id,
	        				'nisn'              => $i->post('nisn'),
	                        'ipk'     	=> $i->post('ipk'),
	                        'program'	      	=> $i->post('program'),
	        				'jenis'             => $i->post('jenis'),
	                        'jenjang'   		=> $i->post('jenjang'),
	                        'email'  			=> $i->post('email'),
	                        'nama_lengkap'      => $i->post('nama_lengkap'),
	                        'tempat_lahir'      => $i->post('tempat_lahir'),
	        				'tanggal_lahir'     => $i->post('tanggal_lahir'),
	                        'jk'     			=> $i->post('jk'),
	                        'agama'     		=> $i->post('agama'),
	                        'kewarganegaraan'	=> $i->post('kewarganegaraan'),
	        				'status_sipil'      => $i->post('status_sipil'),
	                        'alamat'      		=> $i->post('alamat'),
	                        'hp'      			=> $i->post('hp'),
	                        'ortu_nama'   		=> $ortu_nama,
	        				'ortu_tempat_lahir' => $ortu_tempat_lahir,
	        				'ortu_tgl_lahir'   	=> $ortu_tgl_lahir,
	                        'ortu_agama' 		=> $ortu_agama,
	                        'ortu_pendidikan'	=> $ortu_pendidikan,
	                        'ortu_hp'			=> $ortu_hp,
	        				'ortu_pekerjaan'	=> $ortu_pekerjaan,
	                        'ortu_penghasilan'  => $ortu_penghasilan,
	                        'ortu_alamat'      	=> $ortu_alamat,
	                        'sekolah_nama'      => $i->post('sekolah_nama'),
	                        'sekolah_jurusan'   => $i->post('sekolah_jurusan'),
	                        'sekolah_nama_jurusan'=> $i->post('sekolah_nama_jurusan'),
	                        'tahun_lulus'		=> $i->post('tahun_lulus')	,
	        				'no_ijazah'      	=> $i->post('no_ijazah'),
	                        'nilai_ijazah'      => $i->post('nilai_ijazah'),
	                        'pindahan_status'   => $i->post('pindahan_status'),
	        				'pindahan_namapt'   => $i->post('pindahan_namapt'),
	                        'pindahan_fakultas' => $i->post('pindahan_fakultas'),
	                        'pindahan_prodi'	=> $i->post('pindahan_prodi'),
	                        'pindahan_nim'		=> $i->post('pindahan_nim')	,
	        				'pindahan_jumlahsks'=> $i->post('pindahan_jumlahsks'),
	                        'nilai_ijazah'      => $i->post('nilai_ijazah'),
	                        'nik'      => $i->post('nik'),
	                        'npsn'      => $i->post('npsn'),
	                        'baju'				=> $i->post('baju')
	      );
	      $this->sync_explicit_parent_columns($data, $ortu_nama, $ortu_tempat_lahir, $ortu_tgl_lahir, $ortu_agama, isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : '', $ortu_pendidikan, $ortu_hp, $ortu_pekerjaan, $ortu_penghasilan, $ortu_alamat);
	      $this->admin_model->edit_pendaftaran($data);

	      $data_username = array(   'id'                => $pengguna->id,
			                        'nama'      		=> $i->post('nama_lengkap'),
			                        'email'  			=> $i->post('email'),
			                        'hp'  				=> $i->post('hp')
	      );
	      $this->admin_model->edit_pengguna_verifikasi($data_username);
	      $this->session->set_flashdata('success', 'Data telah diedit');
	      redirect(base_url('admin/home/edit_verifikasi/'.$detail_pendaftaran->id),'refresh');
	    }
    }

    public function edit_tanpa_prodi($id){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
  		$jenjang 			= $this->admin_model->list_jenjang_aktif();
  		$list_jenis 		= $this->admin_model->list_jenis();
  		$list_penghasilan 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan1 	= $this->admin_model->list_penghasilan();
  		$fakultas 			= $detail_pendaftaran->fakultas;
  		$select_fakultas	= $this->admin_model->select_fakultas($fakultas);
  		$username 			= $detail_pendaftaran->username;
  		$pengguna 				= $this->admin_model->detail_pengguna_verifikasi($username);

		if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang 		  = $this->admin_model->edit_verifikasi_gelombang($fakultas);
          $list_program 		  = $this->admin_model->list_program_admin();
          $prodi				  = $this->admin_model->admin_prodi($fakultas);
          $prodi1				  = $this->admin_model->admin_prodi($fakultas);

        }elseif($this->session->userdata('id_level')=='2'){
          $prodi				 = $this->admin_model->fakultas_prodi();
          $list_program 		 = $this->admin_model->list_program_admin();
          $prodi1				 = $this->admin_model->list_prodi();
          $pilih_gelombang 		  = $this->admin_model->edit_verifikasi_gelombang($fakultas);
        }

        //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules('jenjang','Jenjang','required',
	                  array( 'required' => '%s harus dipilih'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Halaman Edit Data Mahasiswa',          
                       'detail'     	  => $detail_pendaftaran,
                       'list_jenis'		  => $list_jenis,
                       'jenjang'		  => $jenjang,
                       'prodi'		      => $prodi,
                       'prodi1'		      => $prodi1,
                       'list_program'	  => $list_program,
                       'pilih_gelombang'  => $pilih_gelombang,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'select_fakultas'  => $select_fakultas,
                       'berkas'			  => $this->admin_model->view($id),
                       'isi'              => 'admin/verifikasi/edit_tanpa_prodi');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;
	      $ortu_nama 		= implode(",", $this->input->post('ortu_nama'));
	      $ortu_tempat_lahir 		= implode("|", $this->input->post('ortu_tempat_lahir'));
	      $ortu_tgl_lahir 		= implode("|", $this->input->post('ortu_tgl_lahir'));
	      $ortu_agama 		= implode(",", $this->input->post('ortu_agama'));
	      $ortu_pendidikan 	= implode(",", $this->input->post('ortu_pendidikan'));
	      $ortu_hp 			= implode(",", $this->input->post('ortu_hp'));
	      $ortu_pekerjaan   = implode(",", $this->input->post('ortu_pekerjaan'));
	      $ortu_penghasilan = implode(",", $this->input->post('ortu_penghasilan'));
	      $ortu_alamat = implode("|", $this->input->post('ortu_alamat'));

	      $data = array(    'id'                => $detail_pendaftaran->id,
	        				'nisn'              => $i->post('nisn'),
	                        'ipk'     	=> $i->post('ipk'),
	                        'program'	      	=> $i->post('program'),
	        				'jenis'             => $i->post('jenis'),
	                        'jenjang'   		=> $i->post('jenjang'),
	                        'email'  			=> $i->post('email'),
	                        'nama_lengkap'      => $i->post('nama_lengkap'),
	                        'tempat_lahir'      => $i->post('tempat_lahir'),
	        				'tanggal_lahir'     => $i->post('tanggal_lahir'),
	                        'jk'     			=> $i->post('jk'),
	                        'agama'     		=> $i->post('agama'),
	                        'kewarganegaraan'	=> $i->post('kewarganegaraan'),
	        				'status_sipil'      => $i->post('status_sipil'),
	                        'alamat'      		=> $i->post('alamat'),
	                        'hp'      			=> $i->post('hp'),
	                        'ortu_nama'   		=> $ortu_nama,
	        				'ortu_tempat_lahir' => $ortu_tempat_lahir,
	        				'ortu_tgl_lahir'   	=> $ortu_tgl_lahir,
	                        'ortu_agama' 		=> $ortu_agama,
	                        'ortu_pendidikan'	=> $ortu_pendidikan,
	                        'ortu_hp'			=> $ortu_hp,
	        				'ortu_pekerjaan'	=> $ortu_pekerjaan,
	                        'ortu_penghasilan'  => $ortu_penghasilan,
	                        'ortu_alamat'      	=> $ortu_alamat,
	                        'sekolah_nama'      => $i->post('sekolah_nama'),
	                        'sekolah_jurusan'   => $i->post('sekolah_jurusan'),
	                        'sekolah_nama_jurusan'=> $i->post('sekolah_nama_jurusan'),
	                        'tahun_lulus'		=> $i->post('tahun_lulus')	,
	        				'no_ijazah'      	=> $i->post('no_ijazah'),
	                        'nilai_ijazah'      => $i->post('nilai_ijazah'),
	                        'pindahan_status'   => $i->post('pindahan_status'),
	        				'pindahan_namapt'   => $i->post('pindahan_namapt'),
	                        'pindahan_fakultas' => $i->post('pindahan_fakultas'),
	                        'pindahan_prodi'	=> $i->post('pindahan_prodi'),
	                        'pindahan_nim'		=> $i->post('pindahan_nim')	,
	        				'pindahan_jumlahsks'=> $i->post('pindahan_jumlahsks'),
	                        'nilai_ijazah'      => $i->post('nilai_ijazah'),
	                        'nik'      => $i->post('nik'),
	                        'npsn'      => $i->post('npsn'),
	                        'baju'				=> $i->post('baju')

	      );
	      $this->sync_explicit_parent_columns($data, $ortu_nama, $ortu_tempat_lahir, $ortu_tgl_lahir, $ortu_agama, isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : '', $ortu_pendidikan, $ortu_hp, $ortu_pekerjaan, $ortu_penghasilan, $ortu_alamat);
	      $this->admin_model->edit_pendaftaran($data);

	      $data_username = array(   'id'                => $pengguna->id,
			                        'nama'      		=> $i->post('nama_lengkap'),
			                        'email'  			=> $i->post('email'),
			                        'hp'  				=> $i->post('hp')
	      );
	      $this->admin_model->edit_pengguna_verifikasi($data_username);
	      $this->session->set_flashdata('success', 'Data telah diedit');
	      redirect(base_url('admin/home/edit_tanpa_prodi/'.$detail_pendaftaran->id),'refresh');
	    }
    }

    public function edit_prodi_pendaftar($id){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules('gelombang','Gelombang','required',
	                  array( 'required' => '%s harus diisi'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Halaman Edit Data Mahasiswa',          
                       'detail'     	  => $detail_pendaftaran,
                       'isi'              => 'admin/verifikasi/edit_prodi');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;

	      $data = array(    'id'                => $detail_pendaftaran->id,
	                        'fakultas'          => $i->post('fakultas'),
							'gelombang'         => $i->post('gelombang'),
                            'gelombang_2'         => $i->post('gelombang_2'),
							'jurusan_pilihan'   => $i->post('prodi'),
                            'jurusan_pilihan2'  => $i->post('prodi2')
	      );
		      $this->admin_model->edit_pendaftaran($data);

		      $username = $detail_pendaftaran->username;
          $detail_pengguna = $this->admin_model->detail_pengguna_admin($username);

          $pengguna = array(  'id'              => $detail_pengguna->id,   
                            'fakultas'          => $i->post('fakultas'),
                            'prodi'             => $i->post('prodi')
          );
          $this->admin_model->edit_pengguna_admin($pengguna);

	      $this->session->set_flashdata('success', 'Data telah diedit');
	      redirect(base_url('admin/home/edit_prodi_pendaftar/'.$detail_pendaftaran->id),'refresh');
	    }
    }
  //end verifikasi

    //berkas
       public function berkas_pd($id){

		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

			$this->load->library('upload');
			$dataInfo = array();
		    $files = $_FILES;
		    $cpt = count($_FILES['userfile']['name']);
		    for($i=0; $i<$cpt; $i++)
		    {
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
		 
		        $this->upload->initialize($this->_set_pd());
		        $this->upload->do_upload();
		        $dataInfo[] = $this->upload->data();
		        
		    }


		    $data = array($dataInfo[0]['file_name'], $dataInfo[1]['file_name'], $dataInfo[2]['file_name'], $dataInfo[3]['file_name'], $dataInfo[4]['file_name'], $dataInfo[5]['file_name'], $dataInfo[6]['file_name']);

		    $this->load->library('image_lib');

		    foreach($data as $d) : 
		    $config['image_library']    = 'gd2';
		    $config['source_image']     = './assets/upload/berkas/pd/'.$d;
		    //lokasi thumbs
		    $config['new_image']        = './assets/upload/berkas/pd/thumbs/'.$d;
		    $config['create_thumb']     = TRUE;
		    $config['maintain_ratio']   = TRUE;
		    $config['width']            = 250;
		    $config['height']           = 250;   
		    $config['thumb_marker']     = '';

		    $this->image_lib->clear();
		    $this->image_lib->initialize($config);
		    $this->image_lib->resize();

		    endforeach;

			if($detail_pendaftaran->skhu != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->skhu);
				unlink('./assets/upload/berkas/thumbs/pd/'.$detail_pendaftaran->skhu);
			}
		    
			if($detail_pendaftaran->ijazah != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->ijazah);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->ijazah);
			}		    

			if($detail_pendaftaran->ktp != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->ktp);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->ktp);
			}

			if($detail_pendaftaran->kopertis != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->kopertis);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->kopertis);
			}

			if($detail_pendaftaran->transkip != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->transkip);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->transkip);
			}

			if($detail_pendaftaran->suket_kerja != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->suket_kerja);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->suket_kerja);
			}
			
			if($detail_pendaftaran->suket_pindah != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->suket_pindah);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->suket_pindah);
			}


		    $data   = array('id'    		=> $detail_pendaftaran->id,				
							'skhu'  		=> $dataInfo[0]['file_name'],
					        'ijazah' 		=> $dataInfo[1]['file_name'],
					        'ktp' 			=> $dataInfo[2]['file_name'],
					    	'kopertis'  	=> $dataInfo[3]['file_name'],
					        'transkip' 		=> $dataInfo[4]['file_name'],
					        'suket_kerja' 	=> $dataInfo[5]['file_name'],
					    	'suket_pindah'  => $dataInfo[6]['file_name']);

			$this->admin_model->edit_pendaftaran($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/edit_verifikasi/'.$detail_pendaftaran->id),'refresh');
		   
		       
	}

	public function berkas_mb($id){

		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

			$this->load->library('upload');
			$dataInfo = array();
		    $files = $_FILES;
		    $cpt = count($_FILES['userfile']['name']);
		    for($i=0; $i<$cpt; $i++)
		    {
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
		 
		        $this->upload->initialize($this->_set());
		        $this->upload->do_upload();
		        $dataInfo[] = $this->upload->data();
		    }


		    $data = array($dataInfo[0]['file_name'], $dataInfo[1]['file_name'], $dataInfo[2]['file_name'], $dataInfo[3]['file_name']);

		    $this->load->library('image_lib');

		    foreach($data as $d) : 
		    $config['image_library']    = 'gd2';
		    $config['source_image']     = './assets/upload/berkas/mb/'.$d;
		    //lokasi thumbs
		    $config['new_image']        = './assets/upload/berkas/mb/thumbs/'.$d;
		    $config['create_thumb']     = TRUE;
		    $config['maintain_ratio']   = TRUE;
		    $config['width']            = 250;
		    $config['height']           = 250;   
		    $config['thumb_marker']     = '';

		    $this->image_lib->clear();
		    $this->image_lib->initialize($config);
		    $this->image_lib->resize();

		    endforeach;

		    if($detail_pendaftaran->skhu != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->skhu);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->skhu);
			}
		    
			if($detail_pendaftaran->ijazah != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->ijazah);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->ijazah);
			}		    

			if($detail_pendaftaran->ktp != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->ktp);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->ktp);
			}

			if($detail_pendaftaran->suket_kerja != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->suket_kerja);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->ktp);
			}

		    $data   = array('id'    		=> $detail_pendaftaran->id,				
							'skhu'  		=> $dataInfo[0]['file_name'],
					        'ijazah' 		=> $dataInfo[1]['file_name'],
					        'ktp' 			=> $dataInfo[2]['file_name'],
					        'suket_kerja' 	=> $dataInfo[3]['file_name']);

			$this->admin_model->edit_pendaftaran($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/edit_verifikasi/'.$detail_pendaftaran->id),'refresh');
	       
	}

		private function _set()
		{
		    $config = array();
		    $config['upload_path']      = './assets/upload/berkas/mb/';
		    $config['allowed_types']    = 'jpg|jpeg|png|gif';
		    $config['max_size']         = '2048'; // 2 MB
		    $config['encrypt_name']		= TRUE;
		 
		    return $config;
		}

		private function _set_pd()
		{
		    $config = array();
		    $config['upload_path']      = './assets/upload/berkas/pd/';
		    $config['allowed_types']    = 'jpg|jpeg|png|gif';
		    $config['max_size']         = '2048'; // 2 MB
		    $config['encrypt_name']		= TRUE;
		 
		    return $config;
		}

	public function detail_berkas($id){

        $detail = $this->admin_model->detail_pendaftaran($id);

        $data = array( 'title'          			=> 'Halaman Detail Berkas Mahasiswa',
                       'detail'     				=> $detail,
                       'isi'           	 			=> 'admin/verifikasi/berkas');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    //unduh berkas mhs pd

    public function unduh_suket_pindah_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->suket_pindah;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_ktp_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->ktp;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_ijazah_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->ijazah;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_skhu_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->skhu;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_suket_kerja_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->suket_kerja;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_kopertis_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->kopertis;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_transkip_pd($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/pd/';
      $file   = $detail_pendaftaran->transkip;
      force_download($folder.$file, NULL);
  	
  	}

  	//end unduh berkas mhs pd

  	//unduh berkas mhs mb


  	public function unduh_ktp_mb($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/mb/';
      $file   = $detail_pendaftaran->ktp;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_ijazah_mb($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/mb/';
      $file   = $detail_pendaftaran->ijazah;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_skhu_mb($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/mb/';
      $file   = $detail_pendaftaran->skhu;
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_suket_kerja_mb($id){

      $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
      $folder = './assets/upload/berkas/mb/';
      $file   = $detail_pendaftaran->suket_kerja;
      force_download($folder.$file, NULL);
  	
  	}

  	//end unduh berkas mhs mb

    //end berkas  

    //accept
    public function accept_agen($kode_agen){

    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $accept 			  	  = $this->admin_model->mahasiswa_agen($id_thn_akademik,$kode_agen);

        $data = array( 'title'          => 'Halaman Accept Test Mahasiswa',          
                       'accept'     	=> $accept,
                       'isi'            => 'admin/agen/accept');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function accept(){

    		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        if ($this->session->userdata('id_level')=='1') {
          $accept 			  	  = $this->admin_model->accept($id_thn_akademik);
          $list_prodi 		  	  = $this->admin_model->list_prodi();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $accept 			  	  = $this->admin_model->accept($id_thn_akademik);
          $list_prodi 		  	  = $this->admin_model->list_prodi();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          => 'Data Peserta Terverifikasi',          
                       'accept'     	=> $accept,
                       'list_prodi'		=> $list_prodi,
                       'pilih_gelombang'=> $pilih_gelombang,
                       'isi'            => 'admin/accept/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

        public function accept_filter(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $accept 			= $this->admin_model->accept_filter($id_thn_akademik);

        if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          			=> 'Data Peserta Terverifikasi',
                       'accept'     				=> $accept,
                       'pilih_gelombang'   			=> $pilih_gelombang,
                       'isi'           	 			=> 'admin/accept/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

     public function balik_accept($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
    	$data = array(  'id' 	=> $detail_pendaftaran->id,
			   			 'approve' 	=> '0',
			   			 'fix' 		=> '0',
			   			 'non_fix' 	=> '0',
                         'nim' => NULL,
			   			 'jumlahbayar' 	=> '0');
        $this->admin_model->edit_pendaftaran($data);

		$data_konfirmasi =array('id_pendaftaran' => $detail_pendaftaran->id);
		$this->admin_model->delete_konfirmasi($data_konfirmasi);

		$user_tes =array('user_name' => $detail_pendaftaran->username);
		$this->admin_model->delete_user_tes($user_tes);

      redirect(base_url('admin/home/accept'),'refresh');

    }

	    public function lulus_accept($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
	        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'fix' 		=> '1',
        			   'non_fix' 	=> '0');
	        $this->admin_model->edit_pendaftaran($data);
	        $this->admin_model->generate_nim_pendaftar($detail_pendaftaran->id);
	        redirect(base_url('admin/home/accept'),'refresh');

	    }

    public function gagal_accept($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
	        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'fix' 		=> '0',
                       'non_fix' => '1',
                       'nim' => NULL);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept'),'refresh');

    }

    public function gagal_diterima($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
	        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'fix' 		=> '0',
                       'non_fix' => '1',
                       'nim' => NULL);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/diterima'),'refresh');

    }


    public function gagal_regis($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $data = array( 'id' 							=> $detail_pendaftaran->id,
        			   			'registrasi_ulang' 	=> '0');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/diterima'),'refresh');

    }

    

    public function ujian($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $fakultas = $this->admin_model->fakultas_pilihan_pertama($detail_pendaftaran);
        $noujian = $this->admin_model->generate_nomor_ujian($fakultas);

        $data = array('id' 		=> $detail_pendaftaran->id, 
        			  'noujian' => $noujian);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept'),'refresh');
    }

    public function generate_semua_nomor_ujian(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
        $pendaftaran = $this->admin_model->pendaftaran_belum_nomor_ujian($id_thn_akademik);
        $jumlah = 0;

        foreach ($pendaftaran as $pendaftar) {
            $fakultas = $this->admin_model->fakultas_pilihan_pertama($pendaftar);
            $noujian = $this->admin_model->generate_nomor_ujian($fakultas);
            $data = array(
                'id' => $pendaftar->id,
                'noujian' => $noujian
            );
            $this->admin_model->edit_pendaftaran($data);
            $jumlah++;
        }

        if ($jumlah > 0) {
            $this->session->set_flashdata('success', $jumlah.' nomor ujian berhasil digenerate');
        } else {
            $this->session->set_flashdata('warning', 'Tidak ada peserta terverifikasi yang belum memiliki nomor ujian');
        }
        redirect(base_url('admin/home/accept'),'refresh');
    }

    public function generate_semua_nomor_ujian_apt(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
        $pendaftaran = $this->admin_model->pendaftaran_belum_nomor_ujian($id_thn_akademik);
        $jumlah = 0;

        foreach ($pendaftaran as $pendaftar) {
            $fakultas = $this->admin_model->fakultas_pilihan_pertama($pendaftar);
            $noujian = $this->admin_model->generate_nomor_ujian($fakultas);
            $data = array(
                'id' => $pendaftar->id,
                'noujian' => $noujian
            );
            $this->admin_model->edit_pendaftaran($data);
            $jumlah++;
        }

        if ($jumlah > 0) {
            $this->session->set_flashdata('success', $jumlah.' nomor ujian berhasil digenerate');
        } else {
            $this->session->set_flashdata('warning', 'Tidak ada peserta terverifikasi yang belum memiliki nomor ujian');
        }
        redirect(base_url('admin/home/accept_apt'),'refresh');
    }

    public function cetak_kartu_admin($id){

      $detail_pendaftaran 			= $this->admin_model->detail_pendaftaran($id);
	      $gelombang 					= $detail_pendaftaran->gelombang;
	      $prodi 					= $detail_pendaftaran->jurusan_pilihan;
	      $program 					= $detail_pendaftaran->program;
	      $detail_prodi 				= $this->admin_model->detail_prodi_kode($prodi);
	      $jenjang_jadwal 				= !empty($detail_prodi->jenjang) ? $detail_prodi->jenjang : $detail_pendaftaran->jenjang;
	      $jadwal_usm                 	= $this->admin_model->jadwal_usm_admin($program, $jenjang_jadwal);
      $detail_institusi             = $this->admin_model->detail_institusi();
      $fakultas 					= $detail_pendaftaran->fakultas;
      $detail_fakultas				= $this->admin_model->kartu_fakultas($fakultas);
      $program 						= $detail_pendaftaran->program;
      $kartu_program				= $this->admin_model->kartu_program($program);
      

        $data = array('title'                     => 'Cetak Kartu Ujian',
                      'jadwal_usm'          	  => $jadwal_usm,
                      'detail_pendaftaran'        => $detail_pendaftaran,
                      'detail_fakultas'        	  => $detail_fakultas,
                      'kartu_program'        	  => $kartu_program,
                      'detail_institusi'          => $detail_institusi);
        $this->load->view('kartu/cetak', $data, FALSE);
      }

    public function no_urut(){

    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $no_urut             = $this->admin_model->no_urut($id_thn_akademik);
        $no_gelombang        = $this->admin_model->no_gelombang();

        $data = array('title'       => 'Cetak Nomer Urut Ujian',
                      'no_urut'     => $no_urut,
                      'no_gelombang'=> $no_gelombang,
                      'isi'         => 'admin/accept/nourut');
        $this->load->view('admin/accept/nourut', $data, FALSE);
    }

    public function daftar_hadir(){

    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $daftar_hadir             	= $this->admin_model->daftar_hadir($id_thn_akademik);
        $detail_institusi         	= $this->admin_model->detail_institusi();
        $fakultas_hadir				= $this->admin_model->fakultas_hadir();
        $nama_prodi			 		= $this->admin_model->nama_prodi();

        $data = array('title'         	=> 'Cetak Daftar Hadir Ujian',
                      'daftar_hadir'  	=> $daftar_hadir,
                      'detail_institusi'=> $detail_institusi,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'nama_prodi'		=> $nama_prodi,
                      'isi'           	=> 'admin/accept/hadir');
        $this->load->view('admin/accept/hadir', $data, FALSE);
    }

    public function excel(){

    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
 
    	$fakultas_hadir		= $this->admin_model->fakultas_hadir();
        $excel_pmb          = $this->admin_model->excel_pmb($id_thn_akademik);
        $nama_prodi			= $this->admin_model->nama_prodi();

        $data = array('title'   		=> 'Export Data PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'nama_prodi'		=> $nama_prodi,
                      'isi'     		=> 'admin/accept/excel');
        $this->load->view('admin/accept/excel', $data, FALSE);
        
    }

    //end accept mipa
    //accept apoteker

     public function accept_apt(){


        if ($this->session->userdata('id_level')=='1') {
          $accept 			  	  = $this->admin_model->accept_apt();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang_apt();

        }elseif($this->session->userdata('id_level')=='2'){
         $accept 			  	  = $this->admin_model->accept_apt();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang_apt();
        }

        $data = array( 'title'          => 'Halaman Accept Test Mahasiswa',          
                       'accept'     	=> $accept,
                       'pilih_gelombang'=> $pilih_gelombang,
                       'isi'            => 'admin/accept/list_apt');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function accept_filter_apt(){

        $accept 			= $this->admin_model->accept_filter_apt();

        if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang   = $this->admin_model->pilih_gelombang();

        }elseif($this->session->userdata('id_level')=='2'){
           $pilih_gelombang   = $this->admin_model->pilih_gelombang();
        }

        $data = array( 'title'          			=> 'Halaman Accept Test Mahasiswa',
                       'accept'     				=> $accept,
                       'pilih_gelombang'   			=> $pilih_gelombang,
                       'isi'           	 			=> 'admin/accept/list_apt');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function balik_accept_apt($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'approve' 	=> '0');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept_apt'),'refresh');

    }

	    public function lulus_accept_apt($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
	        $data = array( 'id' 		=> $detail_pendaftaran->id,
        			   'fix' 		=> '1');
	        $this->admin_model->edit_pendaftaran($data);
	        $this->admin_model->generate_nim_pendaftar($detail_pendaftaran->id);
	        redirect(base_url('admin/home/accept_apt'),'refresh');

	    }

    public function gagal_accept_apt($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
	        $data = array( 'id' 		=> $detail_pendaftaran->id,
                       'fix' => '0',
                       'nim' => NULL);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept_apt'),'refresh');

    }

    public function ujian_apt($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $fakultas = $this->admin_model->fakultas_pilihan_pertama($detail_pendaftaran);
        $noujian = $this->admin_model->generate_nomor_ujian($fakultas);

        $data = array('id' 		=> $detail_pendaftaran->id, 
        			  'noujian' => $noujian);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept_apt'),'refresh');
    }

    //end accept

    //diterima
    public function diterima(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        if ($this->session->userdata('id_level')=='1') {
          $diterima 			  = $this->admin_model->diterima($id_thn_akademik);
          $list_prodi 		  	  = $this->admin_model->list_prodi();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $diterima 			  = $this->admin_model->diterima($id_thn_akademik);
          $list_prodi 		  	  = $this->admin_model->list_prodi();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          => 'Halaman Calon Mahasiswa Diterima',          
                       'diterima'     	=> $diterima,
                       // 'detail_tahun'   => $detail_tahun,
                       'list_prodi'		=> $list_prodi,
                       'pilih_gelombang'=> $pilih_gelombang,
                       'isi'            => 'admin/diterima/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

	    public function diterima_filter(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $diterima 			= $this->admin_model->diterima_filter($id_thn_akademik);

        if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
          $list_prodi 		 = $this->admin_model->list_prodi();

        }elseif($this->session->userdata('id_level')=='2'){
            $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
          $list_prodi 		 = $this->admin_model->list_prodi();
        }

        $data = array( 'title'          			=> 'Halaman Calon Mahasiswa Diterima',
                       'diterima'     				=> $diterima,
                       // 'detail_tahun'				=> $detail_tahun,
                       'list_prodi'					=> $list_prodi,
                       'pilih_gelombang'   			=> $pilih_gelombang,
                       'isi'           	 			=> 'admin/diterima/list');
	        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }

	    public function generate_nim_diterima(){
	        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik();
	        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
	        $result = $this->admin_model->generate_nim_lulus($id_thn_akademik);
	        $message = $result['berhasil'].' NIM berhasil digenerate';
	        if ($result['gagal'] > 0) {
	            $message .= ', '.$result['gagal'].' gagal karena mapping fakultas/prodi belum cocok';
	            $this->session->set_flashdata('warning', $message);
	        } else {
	            $this->session->set_flashdata('success', $message);
	        }
	        redirect(base_url('admin/home/diterima'),'refresh');
	    }

	    public function balik_diterima($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
	        $data = array( 'id' 		=> $detail_pendaftaran->id,
                       'fix' => '0',
                       'nim' => NULL);
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept'),'refresh');

    }

    public function excel_lullus(){
        $excel_pmb          = $this->admin_model->excel_lulus();
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();
        $nama_prodi			= $this->admin_model->nama_prodi();

        $data = array('title'   		=> 'Export Data PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'nama_prodi'		=> $nama_prodi,
                      'isi'     		=> 'admin/diterima/excel');
        $this->load->view('admin/diterima/excel', $data, FALSE);
    }
    //end diterima

    //tambah mahasiswa
    public function tambah_mahasiswa(){

	    $list_jenis         = $this->admin_model->list_jenis();
        $sumber         = $this->admin_model->list_sumber_aktif();
        $popup              = random_string('alnum', 20);
        $get_thn_akademik   = $this->admin_model->get_thn_akademik();

        if ($this->session->userdata('id_level')=='1') {
		  $fakultas 			  = $this->admin_model->get_fakultas();

        }elseif($this->session->userdata('id_level')=='2'){
          $fakultas 			  = $this->admin_model->get_fakultas();
        }

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('username','Nama Pengguna','required|is_unique[pendaftaran.username]',
                    array('required'   => '%s harus diisi',
                          'is_unique'  => '%s sudah ada. Buat Nama pengguna baru.'));

        $valid->set_rules('nisn','NISN','required|is_unique[pendaftaran.nisn]|min_length[10]',
                    array('required'   => '%s harus diisi',
                          'is_unique'  => '%s sudah terdaftar',
                          'min_length' => '%s minimal 10 angka'));
        
        $valid->set_rules('email','Email','required',
                    array('required'   => '%s harus diisi'));

        $valid->set_rules('hp','Nomor HP/WA','required|min_length[12]|max_length[14]',
                 array( 'required'   => '%s harus diisi',
                        'min_length' => '%s minimal 12 angka',
                        'max_length' => '%s maksimal 14 angka'));
        
        if($valid->run()===FALSE){

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'list_jenis'       => $list_jenis,
                       'fakultas'         => $fakultas,
                       'fakultas2'        => $fakultas,
                       'sumber'           => $sumber,
                       'isi'              => 'admin/verifikasi/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        
        }else{

        if(!empty($get_thn_akademik->id_thn_akademik)){

          $i=$this->input;
          $date             = date('Y-m-d H:i:s');
          $kode = $i->post('prodi');
          $detail_prodi_kode  = $this->admin_model->detail_prodi_kode($kode);
          $jenjang = $detail_prodi_kode->jenjang;

          $kode2 = $i->post('prodi2');
          $detail_prodi_kode2  = $this->admin_model->detail_prodi_kode2($kode2);
          $jenjang2 = $detail_prodi_kode2->jenjang;

          $data = array(    'tahun_akademik'    => $get_thn_akademik->id_thn_akademik,
                            'username'          => $i->post('username'),
                            'nisn'              => $i->post('nisn'),
                            'kode_agen'         => "Mandiri",
                            'fakultas'          => $i->post('fakultas'),
                            'popup'             => $popup,
                            'bayar'         	=> "1",
                            'gelombang'         => $i->post('gelombang'),
                            'gelombang_2'         => $i->post('gelombang_2'),
                            'jenis'             => $i->post('jenis'),
                            'jenjang'           => $jenjang,
                            'jurusan_pilihan'   => $i->post('prodi'),
                            'jurusan_pilihan2'  => $i->post('prodi2'),
                            'email'             => $i->post('email'),
                            'password'          => $i->post('password'),
                            'nama_lengkap'      => $i->post('nama_lengkap'),
                            'hp'                => $i->post('hp'),
                            'tanggal_daftar'    => $date,
                            'sumber'            => $i->post('sumber'),
          );

          if($jenjang == 'S2' && $jenjang2 == 'S2'){  
          $this->admin_model->tambah_pendaftaran($data);
          }elseif($jenjang == 'S2' && $jenjang2 != 'S2'){
          $this->session->set_flashdata('warning', 'Tidak bisa melakukan pendaftaran jika jenjang pilihan pertama S2 dan jenjang pilihan kedua S1');
          redirect(base_url('agen/register_maba'),'refresh');
          }elseif($jenjang != 'S2' && $jenjang2 == 'S2'){
          $this->session->set_flashdata('warning', 'Tidak bisa melakukan pendaftaran jika jenjang pilihan pertama S1 dan jenjang pilihan kedua S2');
          redirect(base_url('agen/register_maba'),'refresh');
          }elseif($jenjang != 'S2' && $jenjang2 != 'S2'){
          $this->admin_model->tambah_pendaftaran($data);
          }

          $pengguna = array(    'nama'              => $i->post('nama_lengkap'),
                            'username'          => $i->post('username'),
                            'password'          => md5($i->post('password')),
                            'email'             => $i->post('email'),
                            'id_level'          => '3',
                            'status'            => '1',
                            'thn_akademik'    => $get_thn_akademik->id_thn_akademik
          );
          $this->admin_model->tambah_pengguna_admin($pengguna);

          $this->session->set_flashdata('success', 'Pendaftaran mahasiswa baru telah berhasil');
          redirect(base_url('admin/home/verifikasi'),'refresh');

          }else{
            $this->session->set_flashdata('warning', 'Pendaftaran mahasiswa baru tidak bisa dilakukan karena kalender tahun akademik belum dibuka');
            redirect(base_url('admin/home/verifikasi'),'refresh');
        }}

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'list_jenis'       => $list_jenis,
                       'fakultas'         => $fakultas,
                       'fakultas2'         => $fakultas,
                       'sumber'           => $sumber,
                       'isi'              => 'admin/verifikasi/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	function get_prodi()
    {
        $fakultas =$this->input->post('fakultas');
        $data=$this->admin_model->get_prodi($fakultas);
        echo json_encode($data);
    }

    function get_gelombang()
    {
        $fakultas=$this->input->post('fakultas');
        $data=$this->admin_model->get_gelombang_user($fakultas);
        echo json_encode($data);
    }

    function get_list_program()
    {
        $fakultas=$this->input->post('fakultas');
        $data=$this->admin_model->get_program($fakultas);
        echo json_encode($data);
    }

    function get_gelombang_admin()
    {
        $fakultas=$this->input->post('fakultas');
        $data=$this->admin_model->get_gelombang_admin($fakultas);
        echo json_encode($data);
    }

    //end tambah mahasiswa

    //profil mahasiswa
    public function mahasiswa(){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
  		$list_program 		= $this->admin_model->list_program();
  		$list_jenis 		= $this->admin_model->list_jenis();
  		$list_penghasilan 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan1 	= $this->admin_model->list_penghasilan();
  		$id 				= $detail_pendaftaran->id;
  		$fakultas 			= $detail_pendaftaran->fakultas;
  		$select_fakultas	= $this->admin_model->select_fakultas($fakultas);

  		$pilih_gelombang 	  = $this->admin_model->pilih_gelombang_user($fakultas);
        $prodi				  = $this->admin_model->admin_prodi($fakultas);
        $prodi1				  = $this->admin_model->admin_prodi($fakultas);

        //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules('nama_lengkap','Nama Lengkap','required',
	                  array( 'required' => '%s harus diisi'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Halaman Edit Data Mahasiswa',          
                       'detail'     	  => $detail_pendaftaran,
                       'list_jenis'		  => $list_jenis,
                       'prodi'		      => $prodi,
                       'prodi1'		      => $prodi1,
                       'list_program'	  => $list_program,
                       'pilih_gelombang'  => $pilih_gelombang,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'select_fakultas'  => $select_fakultas,
                       'berkas'			  => $this->admin_model->view($id),
                       'isi'              => 'admin/mahasiswa/edit');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;
	      $ortu_nama 		= implode(",", $this->input->post('ortu_nama'));
	      $ortu_ttl 		= implode("|", $this->input->post('ortu_ttl'));
	      $ortu_agama 		= implode(",", $this->input->post('ortu_agama'));
	      $ortu_pendidikan 	= implode(",", $this->input->post('ortu_pendidikan'));
	      $ortu_hp 			= implode(",", $this->input->post('ortu_hp'));
	      $ortu_pekerjaan   = implode(",", $this->input->post('ortu_pekerjaan'));
	      $ortu_penghasilan = implode(",", $this->input->post('ortu_penghasilan'));

	      $data = array(    'id'                => $detail_pendaftaran->id,
	      					'kampus_asal'		=> $i->post('kampus_asal'),
	      					'ipk'				=> $i->post('ipk'),
	                        'nama_lengkap'      => $i->post('nama_lengkap'),
	                        'tempat_lahir'      => $i->post('tempat_lahir'),
	        				'tanggal_lahir'     => $i->post('tanggal_lahir'),
	                        'jk'     			=> $i->post('jk'),
	                        'agama'     		=> $i->post('agama'),
	                        'kewarganegaraan'	=> $i->post('kewarganegaraan'),
	        				'status_sipil'      => $i->post('status_sipil'),
	                        'alamat'      		=> $i->post('alamat'),
	                        'hp'      			=> $i->post('hp'),
	                        'ortu_nama'   		=> $ortu_nama,
	        				'ortu_ttl'   		=> $ortu_ttl,
	                        'ortu_agama' 		=> $ortu_agama,
	                        'ortu_pendidikan'	=> $ortu_pendidikan,
	                        'ortu_hp'			=> $ortu_hp,
	        				'ortu_pekerjaan'	=> $ortu_pekerjaan,
	                        'ortu_penghasilan'  => $ortu_penghasilan,
	                        'ortu_alamat'      	=> $i->post('nilai_ijazah'),
	                        'sekolah_nama'      => $i->post('sekolah_nama'),
	                        'sekolah_jurusan'   => $i->post('sekolah_jurusan'),
	                        'sekolah_nama_jurusan'=> $i->post('sekolah_nama_jurusan'),
	                        'tahun_lulus'		=> $i->post('tahun_lulus')	,
	        				'no_ijazah'      	=> $i->post('no_ijazah'),
	                        'nilai_ijazah'      => $i->post('nilai_ijazah'),
	                        'pindahan_status'   => $i->post('pindahan_status'),
	        				'pindahan_namapt'   => $i->post('pindahan_namapt'),
	                        'pindahan_fakultas' => $i->post('pindahan_fakultas'),
	                        'pindahan_prodi'	=> $i->post('pindahan_prodi'),
	                        'pindahan_nim'		=> $i->post('pindahan_nim')	,
	        				'pindahan_jumlahsks'=> $i->post('pindahan_jumlahsks'),
	                        'nilai_ijazah'      => $i->post('nilai_ijazah')
	      );
	      $this->sync_explicit_parent_columns($data, $ortu_nama, isset($detail_pendaftaran->ortu_tempat_lahir) ? $detail_pendaftaran->ortu_tempat_lahir : '', isset($detail_pendaftaran->ortu_tgl_lahir) ? $detail_pendaftaran->ortu_tgl_lahir : '', $ortu_agama, isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : '', $ortu_pendidikan, $ortu_hp, $ortu_pekerjaan, $ortu_penghasilan, isset($detail_pendaftaran->ortu_alamat) ? $detail_pendaftaran->ortu_alamat : '');
	      $this->admin_model->edit_pendaftaran($data);
	      $this->session->set_flashdata('success', 'Data telah diedit');
	      redirect(base_url('admin/home/mahasiswa/'),'refresh');
	    }
    }

		    public function form_utama(){
	        if ($this->router->fetch_method() == 'form_utama') {
	            redirect(base_url('admin/home/formulir'), 'refresh');
	        }

	  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
	  		$list_jenis 		= $this->admin_model->list_jenis();
	  		$jenjang 			= $this->admin_model->list_jenjang_aktif();
	  		$sumber         	= $this->admin_model->list_sumber_aktif();
	  		$fakultas_aktif     = $this->admin_model->get_fakultas_aktif();
	  		$kuota_ubah_prodi   = isset($detail_pendaftaran->kuota_ubah_prodi) ? (int) $detail_pendaftaran->kuota_ubah_prodi : 0;
	  		$sisa_ubah_prodi    = max(0, 1 - $kuota_ubah_prodi);
	  		$id 				= $detail_pendaftaran->id;
	  		$fakultas 			= $detail_pendaftaran->fakultas;
	  		$select_fakultas	= $this->admin_model->select_fakultas($fakultas);
	  		
	  		$id_gelombang = $detail_pendaftaran->gelombang_2;
	    	$detail_gelombang = $this->admin_model->detail_gelombang_id($id_gelombang);
	    	$fakultas2 = $detail_gelombang ? $detail_gelombang->fakultas : $fakultas;
	    	$select_fakultas2	= $this->admin_model->select_fakultas2($fakultas2);

	  		$list_program 		= $this->admin_model->list_program_fakultas_pendaftar($fakultas);
	  		$pilih_gelombang 	  = $this->admin_model->pilih_gelombang_user($fakultas);
  		$pilih_gelombang_2 	  = $this->admin_model->pilih_gelombang_user2($fakultas2);
        $prodi				  = $this->admin_model->admin_prodi($fakultas);
        $prodi1				  = $this->admin_model->admin_prodi2($fakultas2);

        //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules('program','Jalur pendaftaran','required',
	                  array( 'required' => '%s harus diisi'));
        if (!$this->mahasiswa_profile->form_complete('utama', $detail_pendaftaran)) {
            $this->mahasiswa_profile->apply_validation_rules($valid, 'utama', $detail_pendaftaran);
        }

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Halaman Formulir',          
                       'detail'     	  => $detail_pendaftaran,
                       'required_missing_labels' => $this->mahasiswa_profile->missing_labels($detail_pendaftaran),
                       'wajib_utama_belum_lengkap' => !$this->mahasiswa_profile->form_complete('utama', $detail_pendaftaran),
                       'list_jenis'		  => $list_jenis,
	                       'prodi'		      => $prodi,
	                       'prodi1'		      => $prodi1,
	                       'jenjang'		  => $jenjang,
	                       'sumber'			  => $sumber,
	                       'fakultas_aktif'  => $fakultas_aktif,
	                       'fakultas2'       => $fakultas2,
	                       'sisa_ubah_prodi' => $sisa_ubah_prodi,
	                       'list_program'	  => $list_program,
	                       'pilih_gelombang'  => $pilih_gelombang,
	                       'pilih_gelombang_2'  => $pilih_gelombang_2,
	                       'select_fakultas'  => $select_fakultas,
                       'select_fakultas2'  => $select_fakultas2,
                       'berkas'			  => $this->admin_model->view($id),
                       'isi'              => 'admin/mahasiswa/utama');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
		    }else{
		      $i=$this->input;
		      $fakultas_baru = $i->post('fakultas') != '' ? $i->post('fakultas') : $detail_pendaftaran->fakultas;
		      $gelombang_baru = $i->post('gelombang') != '' ? $i->post('gelombang') : $detail_pendaftaran->gelombang;
		      $prodi_baru = $i->post('jurusan_pilihan') != '' ? $i->post('jurusan_pilihan') : $detail_pendaftaran->jurusan_pilihan;
		      $gelombang_2_baru = $i->post('gelombang_2') != '' ? $i->post('gelombang_2') : $detail_pendaftaran->gelombang_2;
		      $prodi_2_baru = $i->post('jurusan_pilihan2') != '' ? $i->post('jurusan_pilihan2') : $detail_pendaftaran->jurusan_pilihan2;
		      $prodi_diubah = (
		      	$fakultas_baru != $detail_pendaftaran->fakultas ||
		      	$gelombang_baru != $detail_pendaftaran->gelombang ||
		      	$prodi_baru != $detail_pendaftaran->jurusan_pilihan ||
		      	$gelombang_2_baru != $detail_pendaftaran->gelombang_2 ||
		      	$prodi_2_baru != $detail_pendaftaran->jurusan_pilihan2
		      );

              $wajib_utama_belum_lengkap = !$this->mahasiswa_profile->form_complete('utama', $detail_pendaftaran);

		      if($prodi_diubah && $sisa_ubah_prodi <= 0 && !$wajib_utama_belum_lengkap){
		        $this->session->set_flashdata('warning', 'Kuota perubahan pilihan program studi sudah habis. Mahasiswa hanya bisa mengubah pilihan 1 kali.');
			        redirect(base_url('admin/home/formulir'),'refresh');
		      }

		      if($prodi_diubah){
		        $detail_prodi_baru = $this->admin_model->detail_prodi_kode($prodi_baru);
		        $detail_prodi_2_baru = $this->admin_model->detail_prodi_kode2($prodi_2_baru);
		        $detail_gelombang_baru = $this->admin_model->detail_gelombang_id($gelombang_baru);
		        $detail_gelombang_2_baru = $this->admin_model->detail_gelombang_id($gelombang_2_baru);

		        if(empty($detail_prodi_baru) || empty($detail_prodi_2_baru) || empty($detail_gelombang_baru) || empty($detail_gelombang_2_baru)){
		          $this->session->set_flashdata('warning', 'Pilihan fakultas, gelombang, atau program studi tidak valid.');
			          redirect(base_url('admin/home/formulir'),'refresh');
		        }

		        $jenjang_aktif = array();
		        foreach($jenjang as $item_jenjang){
		          $jenjang_aktif[$item_jenjang->nama] = true;
		        }

		        if(!isset($jenjang_aktif[$detail_prodi_baru->jenjang]) || !isset($jenjang_aktif[$detail_prodi_2_baru->jenjang])){
		          $this->session->set_flashdata('warning', 'Program studi yang dipilih tidak tersedia karena jenjangnya sedang tidak aktif.');
			          redirect(base_url('admin/home/formulir'),'refresh');
		        }

		        if($detail_prodi_baru->fakultas != $fakultas_baru || $detail_gelombang_baru->fakultas != $fakultas_baru){
		          $this->session->set_flashdata('warning', 'Pilihan pertama tidak sesuai dengan fakultas yang dipilih.');
			          redirect(base_url('admin/home/formulir'),'refresh');
		        }

		        if($detail_prodi_2_baru->fakultas != $detail_gelombang_2_baru->fakultas){
		          $this->session->set_flashdata('warning', 'Pilihan kedua tidak sesuai dengan fakultas yang dipilih.');
			          redirect(base_url('admin/home/formulir'),'refresh');
		        }

		        if(
		          ($detail_prodi_baru->jenjang == 'S2' && $detail_prodi_2_baru->jenjang != 'S2') ||
		          ($detail_prodi_baru->jenjang != 'S2' && $detail_prodi_2_baru->jenjang == 'S2') ||
		          ($detail_prodi_baru->jenjang == 'Profesi' && $detail_prodi_2_baru->jenjang != 'Profesi') ||
		          ($detail_prodi_baru->jenjang != 'Profesi' && $detail_prodi_2_baru->jenjang == 'Profesi')
		        ){
		          $this->session->set_flashdata('warning', 'Jenjang pilihan pertama dan pilihan kedua tidak boleh dicampur antara S2/Profesi dan jenjang lain.');
			          redirect(base_url('admin/home/formulir'),'refresh');
		        }
		      }

		      $data = array(    'id'                => $detail_pendaftaran->id,
		                        'jenis'				=> $i->post('jenis'),
		                        'program'			=> $i->post('program'),
								'keterangan_sumber'	=> $i->post('keterangan_sumber'),
								'valid_lanjutan'	=> "1"
		      );

		      if($prodi_diubah){
		      	$data['fakultas'] = $fakultas_baru;
		      	$data['gelombang'] = $gelombang_baru;
		      	$data['gelombang_2'] = $gelombang_2_baru;
		      	$data['jurusan_pilihan'] = $prodi_baru;
		      	$data['jurusan_pilihan2'] = $prodi_2_baru;
		      	$data['jenjang'] = $detail_prodi_baru->jenjang;
                if (!$wajib_utama_belum_lengkap) {
		      	    $data['kuota_ubah_prodi'] = $kuota_ubah_prodi + 1;
                }
		      }

		      $this->admin_model->edit_pendaftaran($data);

		      if($prodi_diubah){
		      	$pengguna = $this->admin_model->detail_pengguna_verifikasi($detail_pendaftaran->username);
		      	if($pengguna){
		      		$data_pengguna = array(
		      			'id'       => $pengguna->id,
		      			'fakultas' => $fakultas_baru,
		      			'prodi'    => $prodi_baru
		      		);
		      		$this->admin_model->edit_pengguna_verifikasi($data_pengguna);
		      	}
		      	$this->session->set_flashdata('success', 'Pilihan program studi berhasil diubah. Kuota perubahan pilihan sudah habis.');
		      }else{
		      $this->session->set_flashdata('success', 'Data telah diedit');
		      }
			      redirect(base_url('admin/home/formulir?step=diri'),'refresh');
			    }
		    }

	    public function formulir(){
	        $step = $this->input->post('form_step');
	        if ($step == '') {
	            $step = $this->input->get('step');
	        }

	        if (in_array($step, array('data_diri', 'orang_tua', 'diri', 'ortu'))) {
	            return $this->form_lanjutan();
	        }

	        return $this->form_utama();
	    }

    public function isi_form(){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();

	      $data = array(    'id'                => $detail_pendaftaran->id,
							'valid_lanjutan'	=> "1"
	      );
	      $this->admin_model->edit_pendaftaran($data);
		      redirect(base_url('admin/home/formulir?step=diri'),'refresh');
	    
    }

    public function form_lanjutan(){
        if ($this->router->fetch_method() == 'form_lanjutan') {
            redirect(base_url('admin/home/formulir?step=diri'), 'refresh');
        }

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
  		$username 			= $detail_pendaftaran->username;
  		$pengguna 				= $this->admin_model->detail_pengguna_verifikasi($username);

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
  		$list_penghasilan 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan1 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan2 	= $this->admin_model->list_penghasilan();

        //validasi input
	    $valid = $this->form_validation;

        $form_step = $this->input->post('form_step');
        if ($this->input->post('simpan_data_diri')) {
            $form_step = 'data_diri';
        } elseif ($this->input->post('simpan_orang_tua')) {
            $form_step = 'orang_tua';
        }
        $step_simpan = $form_step == 'data_diri' ? 'data_diri' : 'orang_tua';
        $this->mahasiswa_profile->apply_validation_rules($valid, 'lanjutan', $detail_pendaftaran, $step_simpan);


		    if($valid->run()===FALSE){
		      //end validasi

		    $data = array( 'title'            => 'Halaman Formulir',          
	                       'detail'     	  => $detail_pendaftaran,
	                       'required_missing_labels' => $this->mahasiswa_profile->missing_labels($detail_pendaftaran),
	                       'form_lanjutan_step' => $step_simpan == 'orang_tua' ? 'ortu' : 'diri',
	                       'list_penghasilan' => $list_penghasilan,
	                       'list_penghasilan1'=> $list_penghasilan1,
	                       'list_penghasilan2'=> $list_penghasilan2,
	                       'isi'              => 'admin/mahasiswa/lanjutan');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;

          if ($form_step == 'data_diri') {
              $data = array(
                  'id' => $detail_pendaftaran->id,
                  'nisn' => $this->post_or_existing('nisn', $detail_pendaftaran->nisn),
                  'ipk' => $this->post_or_existing('ipk', $detail_pendaftaran->ipk),
                  'email' => $this->post_or_existing('email', $detail_pendaftaran->email),
                  'nama_lengkap' => $this->post_or_existing('nama_lengkap', $detail_pendaftaran->nama_lengkap, TRUE),
                  'tempat_lahir' => $this->post_or_existing('tempat_lahir', $detail_pendaftaran->tempat_lahir, TRUE),
                  'tanggal_lahir' => $this->post_or_existing('tanggal_lahir', $detail_pendaftaran->tanggal_lahir),
                  'jk' => $this->post_or_existing('jk', $detail_pendaftaran->jk),
                  'agama' => $this->post_or_existing('agama', $detail_pendaftaran->agama),
                  'kewarganegaraan' => $this->post_or_existing('kewarganegaraan', $detail_pendaftaran->kewarganegaraan),
                  'status_sipil' => $this->post_or_existing('status_sipil', $detail_pendaftaran->status_sipil),
                  'alamat' => $this->post_or_existing('alamat', $detail_pendaftaran->alamat),
                  'hp' => $this->post_or_existing('hp', $detail_pendaftaran->hp),
                  'sekolah_nama' => $this->post_or_existing('sekolah_nama', $detail_pendaftaran->sekolah_nama),
                  'sekolah_jurusan' => $this->post_or_existing('sekolah_jurusan', $detail_pendaftaran->sekolah_jurusan),
                  'sekolah_nama_jurusan' => $this->post_or_existing('sekolah_nama_jurusan', $detail_pendaftaran->sekolah_nama_jurusan),
                  'tahun_lulus' => $this->post_or_existing('tahun_lulus', $detail_pendaftaran->tahun_lulus),
                  'no_ijazah' => $this->post_or_existing('no_ijazah', $detail_pendaftaran->no_ijazah),
                  'nilai_ijazah' => $this->post_or_existing('nilai_ijazah', $detail_pendaftaran->nilai_ijazah),
                  'pindahan_namapt' => $this->post_or_existing('pindahan_namapt', $detail_pendaftaran->pindahan_namapt, TRUE),
                  'pindahan_fakultas' => $this->post_or_existing('pindahan_fakultas', $detail_pendaftaran->pindahan_fakultas, TRUE),
                  'pindahan_prodi' => $this->post_or_existing('pindahan_prodi', $detail_pendaftaran->pindahan_prodi, TRUE),
                  'pindahan_nim' => $this->post_or_existing('pindahan_nim', $detail_pendaftaran->pindahan_nim),
                  'pindahan_jumlahsks' => $this->post_or_existing('pindahan_jumlahsks', $detail_pendaftaran->pindahan_jumlahsks),
                  'nik' => $this->post_or_existing('nik', $detail_pendaftaran->nik),
                  'kecamatan' => $this->post_or_existing('kecamatan', $detail_pendaftaran->kecamatan, TRUE),
                  'kota' => $this->post_or_existing('kota', $detail_pendaftaran->kota, TRUE),
                  'prov' => $this->post_or_existing('prov', $detail_pendaftaran->prov, TRUE),
                  'npsn' => $this->post_or_existing('npsn', $detail_pendaftaran->npsn),
                  'baju' => $this->post_or_existing('baju', $detail_pendaftaran->baju)
              );
              $this->admin_model->edit_pendaftaran($data);

              $data_username = array(
                  'id' => $pengguna->id,
                  'nama' => $data['nama_lengkap'],
                  'email' => $data['email'],
                  'hp' => $data['hp']
              );
              $this->admin_model->edit_pengguna_verifikasi($data_username);

              $this->session->set_flashdata('success', 'Data diri telah disimpan. Silakan lengkapi data orang tua/wali.');
	              redirect(base_url('admin/home/formulir?step=ortu'), 'refresh');
	          }

	      $nama_ayah = $this->form_value_or_legacy('nama_ayah', $detail_pendaftaran->ortu_nama, ',', 0, TRUE);
	      $nama_ibu = $this->form_value_or_legacy('nama_ibu', $detail_pendaftaran->ortu_nama, ',', 1, TRUE);
	      $nama_wali = $this->form_value_or_legacy('nama_wali', $detail_pendaftaran->ortu_nama, ',', 2, TRUE);
	      $nik_ayah = $this->form_value_or_legacy('nik_ayah', isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : ',,', ',', 0);
	      $nik_ibu = $this->form_value_or_legacy('nik_ibu', isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : ',,', ',', 1);
	      $nik_wali = $this->form_value_or_legacy('nik_wali', isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : ',,', ',', 2);
	      $tempat_lahir_ayah = $this->form_value_or_legacy('tempat_lahir_ayah', $detail_pendaftaran->ortu_tempat_lahir, '|', 0, TRUE);
	      $tempat_lahir_ibu = $this->form_value_or_legacy('tempat_lahir_ibu', $detail_pendaftaran->ortu_tempat_lahir, '|', 1, TRUE);
	      $tempat_lahir_wali = $this->form_value_or_legacy('tempat_lahir_wali', $detail_pendaftaran->ortu_tempat_lahir, '|', 2, TRUE);
	      $tanggal_lahir_ayah = $this->form_value_or_legacy('tanggal_lahir_ayah', $detail_pendaftaran->ortu_tgl_lahir, '|', 0);
	      $tanggal_lahir_ibu = $this->form_value_or_legacy('tanggal_lahir_ibu', $detail_pendaftaran->ortu_tgl_lahir, '|', 1);
	      $tanggal_lahir_wali = $this->form_value_or_legacy('tanggal_lahir_wali', $detail_pendaftaran->ortu_tgl_lahir, '|', 2);
	      $agama_ayah = $this->form_value_or_legacy('agama_ayah', $detail_pendaftaran->ortu_agama, ',', 0);
	      $agama_ibu = $this->form_value_or_legacy('agama_ibu', $detail_pendaftaran->ortu_agama, ',', 1);
	      $agama_wali = $this->form_value_or_legacy('agama_wali', $detail_pendaftaran->ortu_agama, ',', 2);
	      $pendidikan_ayah = $this->form_value_or_legacy('pendidikan_ayah', $detail_pendaftaran->ortu_pendidikan, ',', 0);
	      $pendidikan_ibu = $this->form_value_or_legacy('pendidikan_ibu', $detail_pendaftaran->ortu_pendidikan, ',', 1);
	      $pendidikan_wali = $this->form_value_or_legacy('pendidikan_wali', $detail_pendaftaran->ortu_pendidikan, ',', 2);
	      $hp_ayah = $this->form_value_or_legacy('hp_ayah', $detail_pendaftaran->ortu_hp, ',', 0);
	      $hp_ibu = $this->form_value_or_legacy('hp_ibu', $detail_pendaftaran->ortu_hp, ',', 1);
	      $hp_wali = $this->form_value_or_legacy('hp_wali', $detail_pendaftaran->ortu_hp, ',', 2);
	      $pekerjaan_ayah = $this->form_value_or_legacy('pekerjaan_ayah', $detail_pendaftaran->ortu_pekerjaan, ',', 0, TRUE);
	      $pekerjaan_ibu = $this->form_value_or_legacy('pekerjaan_ibu', $detail_pendaftaran->ortu_pekerjaan, ',', 1, TRUE);
	      $pekerjaan_wali = $this->form_value_or_legacy('pekerjaan_wali', $detail_pendaftaran->ortu_pekerjaan, ',', 2, TRUE);
	      $penghasilan_ayah = $this->form_value_or_legacy('penghasilan_ayah', $detail_pendaftaran->ortu_penghasilan, ',', 0);
	      $penghasilan_ibu = $this->form_value_or_legacy('penghasilan_ibu', $detail_pendaftaran->ortu_penghasilan, ',', 1);
	      $penghasilan_wali = $this->form_value_or_legacy('penghasilan_wali', $detail_pendaftaran->ortu_penghasilan, ',', 2);
	      $alamat_orang_tua = $this->form_value_or_legacy('alamat_orang_tua', $detail_pendaftaran->ortu_alamat, '|', 0);
	      $alamat_wali = $this->form_value_or_legacy('alamat_wali', $detail_pendaftaran->ortu_alamat, '|', 1);

	      $ortu_nama = implode(',', array($nama_ayah, $nama_ibu, $nama_wali));
	      $ortu_tempat_lahir = implode('|', array($tempat_lahir_ayah, $tempat_lahir_ibu, $tempat_lahir_wali));
	      $ortu_tgl_lahir = implode('|', array($tanggal_lahir_ayah, $tanggal_lahir_ibu, $tanggal_lahir_wali));
	      $ortu_agama = implode(',', array($agama_ayah, $agama_ibu, $agama_wali));
	      $ortu_nik = implode(',', array($nik_ayah, $nik_ibu, $nik_wali));
	      $ortu_pendidikan = implode(',', array($pendidikan_ayah, $pendidikan_ibu, $pendidikan_wali));
	      $ortu_hp = implode(',', array($hp_ayah, $hp_ibu, $hp_wali));
	      $ortu_pekerjaan = implode(',', array($pekerjaan_ayah, $pekerjaan_ibu, $pekerjaan_wali));
	      $ortu_penghasilan = implode(',', array($penghasilan_ayah, $penghasilan_ibu, $penghasilan_wali));
	      $ortu_alamat = implode('|', array($alamat_orang_tua, $alamat_wali));

	      $data = array(    'id'                => $detail_pendaftaran->id,
	                        'ortu_nama'   		=> $ortu_nama,
	        				'ortu_tempat_lahir' => $ortu_tempat_lahir,
	        				'ortu_tgl_lahir'   	=> $ortu_tgl_lahir,
		                        'ortu_agama' 		=> $ortu_agama,
		                        'ortu_nik' 		=> $ortu_nik,
		                        'ortu_pendidikan'	=> $ortu_pendidikan,
	                        'ortu_hp'			=> $ortu_hp,
	        				'ortu_pekerjaan'	=> $ortu_pekerjaan,
	                        'ortu_penghasilan'  => $ortu_penghasilan,
	                        'ortu_alamat'      	=> $ortu_alamat
	      );
	      $this->set_if_column_exists($data, 'nama_ayah', $nama_ayah);
	      $this->set_if_column_exists($data, 'nik_ayah', $nik_ayah);
	      $this->set_if_column_exists($data, 'tempat_lahir_ayah', $tempat_lahir_ayah);
	      $this->set_if_column_exists($data, 'tanggal_lahir_ayah', $tanggal_lahir_ayah);
	      $this->set_if_column_exists($data, 'agama_ayah', $agama_ayah);
	      $this->set_if_column_exists($data, 'pendidikan_ayah', $pendidikan_ayah);
	      $this->set_if_column_exists($data, 'hp_ayah', $hp_ayah);
	      $this->set_if_column_exists($data, 'pekerjaan_ayah', $pekerjaan_ayah);
	      $this->set_if_column_exists($data, 'penghasilan_ayah', $penghasilan_ayah);
	      $this->set_if_column_exists($data, 'nama_ibu', $nama_ibu);
	      $this->set_if_column_exists($data, 'nik_ibu', $nik_ibu);
	      $this->set_if_column_exists($data, 'tempat_lahir_ibu', $tempat_lahir_ibu);
	      $this->set_if_column_exists($data, 'tanggal_lahir_ibu', $tanggal_lahir_ibu);
	      $this->set_if_column_exists($data, 'agama_ibu', $agama_ibu);
	      $this->set_if_column_exists($data, 'pendidikan_ibu', $pendidikan_ibu);
	      $this->set_if_column_exists($data, 'hp_ibu', $hp_ibu);
	      $this->set_if_column_exists($data, 'pekerjaan_ibu', $pekerjaan_ibu);
	      $this->set_if_column_exists($data, 'penghasilan_ibu', $penghasilan_ibu);
	      $this->set_if_column_exists($data, 'alamat_orang_tua', $alamat_orang_tua);
	      $this->set_if_column_exists($data, 'nama_wali', $nama_wali);
	      $this->set_if_column_exists($data, 'nik_wali', $nik_wali);
	      $this->set_if_column_exists($data, 'tempat_lahir_wali', $tempat_lahir_wali);
	      $this->set_if_column_exists($data, 'tanggal_lahir_wali', $tanggal_lahir_wali);
	      $this->set_if_column_exists($data, 'agama_wali', $agama_wali);
	      $this->set_if_column_exists($data, 'pendidikan_wali', $pendidikan_wali);
	      $this->set_if_column_exists($data, 'hp_wali', $hp_wali);
	      $this->set_if_column_exists($data, 'pekerjaan_wali', $pekerjaan_wali);
	      $this->set_if_column_exists($data, 'penghasilan_wali', $penghasilan_wali);
	      $this->set_if_column_exists($data, 'alamat_wali', $alamat_wali);
	      $this->admin_model->edit_pendaftaran($data);

		      $this->session->set_flashdata('success', 'Data orang tua/wali telah disimpan');
		      redirect(base_url('admin/home/formulir?step=ortu'),'refresh');
		    }
    }

    public function form_wali(){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
  		$list_penghasilan 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan1 	= $this->admin_model->list_penghasilan();
  		$list_penghasilan2 	= $this->admin_model->list_penghasilan();

        //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules('id','ID','required',
	                  array( 'required' => '%s kosong'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Halaman Form Orang Tua / Wali',          
                       'detail'     	  => $detail_pendaftaran,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'list_penghasilan2'=> $list_penghasilan2,
                       'isi'              => 'admin/mahasiswa/wali');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;
	      $ortu_nama 		= implode(",", $this->input->post('ortu_nama'));
	      $ortu_tempat_lahir 		= implode("|", $this->input->post('ortu_tempat_lahir'));
	      $ortu_tgl_lahir 		= implode("|", $this->input->post('ortu_tgl_lahir'));
	      $ortu_agama 		= implode(",", $this->input->post('ortu_agama'));
	      $ortu_pendidikan 	= implode(",", $this->input->post('ortu_pendidikan'));
	      $ortu_hp 			= implode(",", $this->input->post('ortu_hp'));
	      $ortu_pekerjaan   = implode(",", $this->input->post('ortu_pekerjaan'));
	      $ortu_penghasilan = implode(",", $this->input->post('ortu_penghasilan'));
	      $ortu_alamat = implode("|", $this->input->post('ortu_alamat'));

	      $data = array(    'id'                => $detail_pendaftaran->id,
	        				'ortu_nama'   		=> $ortu_nama,
	        				'ortu_tempat_lahir' => $ortu_tempat_lahir,
	        				'ortu_tgl_lahir'   	=> $ortu_tgl_lahir,
	                        'ortu_agama' 		=> $ortu_agama,
	                        'ortu_pendidikan'	=> $ortu_pendidikan,
	                        'ortu_hp'			=> $ortu_hp,
	        				'ortu_pekerjaan'	=> $ortu_pekerjaan,
	                        'ortu_penghasilan'  => $ortu_penghasilan,
	                        'ortu_alamat'      	=> $ortu_alamat
	      );
	      $this->sync_explicit_parent_columns($data, $ortu_nama, $ortu_tempat_lahir, $ortu_tgl_lahir, $ortu_agama, isset($detail_pendaftaran->ortu_nik) ? $detail_pendaftaran->ortu_nik : '', $ortu_pendidikan, $ortu_hp, $ortu_pekerjaan, $ortu_penghasilan, $ortu_alamat);
	      $this->admin_model->edit_pendaftaran($data);
	      $this->session->set_flashdata('success', 'Data telah diedit');
	      redirect(base_url('admin/home/form_wali'),'refresh');
	    }
    }

    //berkas
       public function berkas_pd_mhs(){

		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();

			$this->load->library('upload');
			$dataInfo = array();
		    $files = $_FILES;
		    $cpt = count($_FILES['userfile']['name']);
		    for($i=0; $i<$cpt; $i++)
		    {
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
		 
		        $this->upload->initialize($this->_set_pd_mhs());
		        $this->upload->do_upload();
		        $dataInfo[] = $this->upload->data();
		        
		    }


		    $data = array($dataInfo[0]['file_name'], $dataInfo[1]['file_name'], $dataInfo[2]['file_name'], $dataInfo[3]['file_name'], $dataInfo[4]['file_name'], $dataInfo[5]['file_name'], $dataInfo[6]['file_name']);

		    $this->load->library('image_lib');

		    foreach($data as $d) : 
		    $config['image_library']    = 'gd2';
		    $config['source_image']     = './assets/upload/berkas/pd/'.$d;
		    //lokasi thumbs
		    $config['new_image']        = './assets/upload/berkas/pd/thumbs/'.$d;
		    $config['create_thumb']     = TRUE;
		    $config['maintain_ratio']   = TRUE;
		    $config['width']            = 250;
		    $config['height']           = 250;   
		    $config['thumb_marker']     = '';

		    $this->image_lib->clear();
		    $this->image_lib->initialize($config);
		    $this->image_lib->resize();

		    endforeach;

			if($detail_pendaftaran->skhu != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->skhu);
				unlink('./assets/upload/berkas/thumbs/pd/'.$detail_pendaftaran->skhu);
			}
		    
			if($detail_pendaftaran->ijazah != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->ijazah);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->ijazah);
			}		    

			if($detail_pendaftaran->ktp != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->ktp);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->ktp);
			}

			if($detail_pendaftaran->kopertis != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->kopertis);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->kopertis);
			}

			if($detail_pendaftaran->transkip != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->transkip);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->transkip);
			}

			if($detail_pendaftaran->suket_kerja != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->suket_kerja);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->suket_kerja);
			}
			
			if($detail_pendaftaran->suket_pindah != ""){
				unlink('./assets/upload/berkas/pd/'.$detail_pendaftaran->suket_pindah);
				unlink('./assets/upload/berkas/pd/thumbs/'.$detail_pendaftaran->suket_pindah);
			}


		    $data   = array('id'    		=> $detail_pendaftaran->id,				
							'skhu'  		=> $dataInfo[0]['file_name'],
					        'ijazah' 		=> $dataInfo[1]['file_name'],
					        'ktp' 			=> $dataInfo[2]['file_name'],
					    	'kopertis'  	=> $dataInfo[3]['file_name'],
					        'transkip' 		=> $dataInfo[4]['file_name'],
					        'suket_kerja' 	=> $dataInfo[5]['file_name'],
					    	'suket_pindah'  => $dataInfo[6]['file_name']);

			$this->admin_model->edit_pendaftaran($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/mahasiswa'),'refresh');
		   
		       
	}

	public function berkas_mb_mhs(){

		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();

			$this->load->library('upload');
			$dataInfo = array();
		    $files = $_FILES;
		    $cpt = count($_FILES['userfile']['name']);
		    for($i=0; $i<$cpt; $i++)
		    {
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
		 
		        $this->upload->initialize($this->_set_mhs());
		        $this->upload->do_upload();
		        $dataInfo[] = $this->upload->data();
		    }


		    $data = array($dataInfo[0]['file_name'], $dataInfo[1]['file_name'], $dataInfo[2]['file_name'], $dataInfo[3]['file_name']);

		    $this->load->library('image_lib');

		    foreach($data as $d) : 
		    $config['image_library']    = 'gd2';
		    $config['source_image']     = './assets/upload/berkas/mb/'.$d;
		    //lokasi thumbs
		    $config['new_image']        = './assets/upload/berkas/mb/thumbs/'.$d;
		    $config['create_thumb']     = TRUE;
		    $config['maintain_ratio']   = TRUE;
		    $config['width']            = 250;
		    $config['height']           = 250;   
		    $config['thumb_marker']     = '';

		    $this->image_lib->clear();
		    $this->image_lib->initialize($config);
		    $this->image_lib->resize();

		    endforeach;

		    if($detail_pendaftaran->skhu != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->skhu);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->skhu);
			}
		    
			if($detail_pendaftaran->ijazah != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->ijazah);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->ijazah);
			}		    

			if($detail_pendaftaran->ktp != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->ktp);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->ktp);
			}

			if($detail_pendaftaran->suket_kerja != ""){
				unlink('./assets/upload/berkas/mb/thumbs/'.$detail_pendaftaran->suket_kerja);
				unlink('./assets/upload/berkas/mb/'.$detail_pendaftaran->ktp);
			}

		    $data   = array('id'    		=> $detail_pendaftaran->id,				
							'skhu'  		=> $dataInfo[0]['file_name'],
					        'ijazah' 		=> $dataInfo[1]['file_name'],
					        'ktp' 			=> $dataInfo[2]['file_name'],
					        'suket_kerja' 	=> $dataInfo[3]['file_name']);

			$this->admin_model->edit_pendaftaran($data);
			$this->session->set_flashdata('success', 'Data telah di edit');
			redirect(base_url('admin/home/mahasiswa'),'refresh');
	       
	}

		private function _set_mhs()
		{
		    $config = array();
		    $config['upload_path']      = './assets/upload/berkas/mb/';
		    $config['allowed_types']    = 'jpg|jpeg|png|gif';
		    $config['max_size']         = '2048'; // 2 MB
		    $config['encrypt_name']		= TRUE;
		 
		    return $config;
		}

		private function _set_pd_mhs()
		{
		    $config = array();
		    $config['upload_path']      = './assets/upload/berkas/pd/';
		    $config['allowed_types']    = 'jpg|jpeg|png|gif';
		    $config['max_size']         = '2048'; // 2 MB
		    $config['encrypt_name']		= TRUE;
		 
		    return $config;
		}

	public function buka_berkas($id){

        $detail = $this->admin_model->detail_pendaftaran($id);
        

        $data = array( 'title'          			=> 'Halaman Detail Berkas Mahasiswa : '.$detail->nama_lengkap,
                       'detail'     				=> $detail,
                       'isi'           	 			=> 'admin/accept/berkas');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function verifikasi_berkas($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'keterangan_berkas' 	=> $this->input->post('keterangan_berkas'),
        	          'verifikasi_berkas' 	=> $this->input->post('verifikasi_berkas'));
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/buka_berkas/'.$detail_pendaftaran->id),'refresh');
    }

		public function detail_berkas_mhs(){

        $detail = $this->admin_model->detail_pendaftaran_mahasiswa();
        

        $data = array( 'title'          			=> 'Halaman Detail Berkas Mahasiswa',
                       'detail'     				=> $detail,
                       'isi'           	 			=> 'admin/mahasiswa/berkas');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function konfirmasi_bayar(){

		$detail 	= $this->admin_model->detail_pendaftaran_mahasiswa();
		$kode 		= $detail->jurusan_pilihan;
		$prodi  = $this->admin_model->detail_prodi_kode($kode);
		$valid = $this->form_validation;

		$valid->set_rules('bank','Nama Bank / Metode pembayaran ','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
			//jika foto tidak kosong
			if(! empty($_FILES['bukti_bayar']['name'])){
			$config['upload_path']   	= './assets/upload/bukti/';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size']      	= 1028; // KB
			$config['encrypt_name']   	= TRUE;

			$this->load->library('upload', $config);
		
			if(! $this->upload->do_upload('bukti_bayar')) {
			
			//end validasi

			$data = array( 'title'   			=> 'Halaman Konfirmasi Bayar ',
						   'detail'				=> $detail,
						   'prodi'	  => $prodi,
						   'isi'     			=> 'admin/mahasiswa/konfirmasi_bayar');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect(base_url('admin/home/konfirmasi_bayar'),'refresh');

			}else{
				$upload_foto = array('upload_data' => $this->upload->data());

				//create thumbnail
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './assets/upload/bukti/'.$upload_foto['upload_data']['file_name'];
				//lokasi thumbs
				$config['new_image']		= './assets/upload/bukti/thumbs/'.$upload_foto['upload_data']['file_name'];
				$config['create_thumb']		= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800; //pixel
				$config['height']       	= 800;
				$config['thumb_marker']     = '';

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				//end create thumbnail

				if($detail->bukti_bayar != ""){
					unlink('./assets/upload/bukti/'.$detail->bukti_bayar);
					unlink('./assets/upload/bukti/thumbs/'.$detail->bukti_bayar);
				}
				
				//slug
				$data = array(  'id' 				=> $detail->id,			
												'atas_nama'			=> $this->input->post('atas_nama'),
												'bank'				=> $this->input->post('bank'),
												'bukti_bayar' 	=> $upload_foto['upload_data']['file_name'],
												'tgl_bayar'			=> $this->input->post('tgl_bayar')
			);
				$this->admin_model->edit_pendaftaran($data);
				$this->session->set_flashdata('success', 'Data telah di edit');
				redirect(base_url('admin/home/konfirmasi_bayar'),'refresh');
			}}else{
				//tanpa foto
				$data = array(  'id' 				=> $detail->id,
								'atas_nama'			=> $this->input->post('atas_nama'),
								'bank'				=> $this->input->post('bank'),
								'tgl_bayar'			=> $this->input->post('tgl_bayar')
			);
				$this->admin_model->edit_pendaftaran($data);
				$this->session->set_flashdata('success', 'Bukti telah di upload');
				redirect(base_url('admin/home/konfirmasi_bayar'),'refresh');
			}}
				$data = array( 	'title'   			=> 'Halaman Konfirmasi Bayar',
						   		'detail'			=> $detail,
						   		'prodi'	  => $prodi,
						   		'isi'     			=> 'admin/mahasiswa/konfirmasi_bayar');
				$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	public function profil_mahasiswa(){

		$detail 	= $this->admin_model->detail_pendaftaran_mahasiswa();
		$email 		= $detail->username; 
		$pengguna 	= $this->admin_model->detail_pengguna_email($email);

		//validasi input
		$valid 		= $this->form_validation;

		$valid->set_rules( 'id','id instansi','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
		
			$config['upload_path']   	= './assets/upload/profil/';
			$config['allowed_types'] 	= 'gif|jpg|png|svg|jpeg';
			$config['max_size']      	= 424; // KB
			$config['encrypt_name']   	= TRUE;

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('foto')) {
		
		//end validasi

		$data = array( 'title'   			=> 'Halaman Cetak Kartu Ujian',
					   'detail'				=> $detail,
					   'error'   			=> $this->upload->display_errors(),
					   'isi'     			=> 'admin/mahasiswa/profil');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create thumbnail
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/profil/'.$upload_foto['upload_data']['file_name'];
			//lokasi thumbs
			$config['new_image']		= './assets/upload/profil/thumbs/'.$upload_foto['upload_data']['file_name'];
			$config['create_thumb']		= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250; //pixel
			$config['height']       	= 250;
			$config['thumb_marker']     = '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail

			if($detail->foto != ""){
				unlink('./assets/upload/profil/'.$detail->foto);
				unlink('./assets/upload/profil/thumbs/'.$detail->foto);
			}
			
			$i=$this->input;
			//slug
			$data = array(  'id' 				=> $detail->id,				
							'foto' 				=> $upload_foto['upload_data']['file_name']
		);
			$this->admin_model->edit_pendaftaran($data);

			$dataa = array( 'id' 			=> $pengguna->id,
							'foto' 			=> $upload_foto['upload_data']['file_name']
		);
			$this->admin_model->edit_pengguna_email($dataa);
			$this->session->set_flashdata('success', 'Profil anda telah di perbaharui');
			redirect(base_url('admin/home/profil_mahasiswa'),'refresh');
		}}
			$data = array( 	'title'   			=> 'Halaman Cetak Kartu Ujian',
					   		'detail'			=> $detail,
					   		'isi'     			=> 'admin/mahasiswa/profil');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function cetak_kartu_ujian(){

	      $detail_pendaftaran 			= $this->admin_model->detail_pendaftaran_mahasiswa();
	      $program 						= $detail_pendaftaran->program;
	      $prodi 						= $detail_pendaftaran->jurusan_pilihan;
	      $detail_prodi 				= $this->admin_model->detail_prodi_kode($prodi);
	      $jenjang_jadwal 				= !empty($detail_prodi->jenjang) ? $detail_prodi->jenjang : $detail_pendaftaran->jenjang;
	      $jadwal_usm                 	= $this->admin_model->jadwal_usm_admin($program, $jenjang_jadwal);
      $detail_institusi             = $this->admin_model->detail_institusi();
      $fakultas 					= $detail_pendaftaran->fakultas;
      $detail_fakultas				= $this->admin_model->kartu_fakultas($fakultas);
      $kartu_program				= $this->admin_model->kartu_program($program);
      

        $data = array('title'                     => 'Cetak Kartu Ujian',
                      'jadwal_usm'          	  => $jadwal_usm,
                      'detail_pendaftaran'        => $detail_pendaftaran,
                      'detail_fakultas'        	  => $detail_fakultas,
                      'kartu_program'        	  => $kartu_program,
                      'detail_institusi'          => $detail_institusi);
        $this->load->view('kartu/cetak', $data, FALSE);
      }
    //profil mahasiswa

    //BERITA
    public function berita() {

		$berita = $this->admin_model->berita();
		
		$data 	= array('title' 		=> 'Data Berita',
					  	'berita'  		=> $berita,
					  	'isi'   		=> 'admin/berita/list');	
		$this->load->view('admin/layout/wrapper', $data, FALSE);
       
	}

	public function galeri() {

		$galeri = $this->admin_model->galeri();
		
		$data 	= array('title' 		=> 'Data Berita',
					  	'galeri'  		=> $galeri,
					  	'isi'   		=> 'admin/berita/galeri');	
		$this->load->view('admin/layout/wrapper', $data, FALSE);
       
	}

	public function tambah_berita(){

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('judul','Judul','required|is_unique[berita.judul]',
					array('required' 		=> '%s harus diisi',
						  'is_unique' 		=> '%s sudah ada'));
		
		if($valid->run()){
		
		$config['upload_path']   	= './assets/upload/berita/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['encrypt_name']   	= TRUE;
		$config['max_size']      	= 3072; // KB

		$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('foto')) {
		
		//end validasi

		$data = array( 'title'   	=>  'Halaman Tambah Informasi',
					   'isi'     	=>  'admin/berita/tambah',
					   'error'   	=>  $this->upload->display_errors());
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create image
		      $config['image_library']  = 'gd2';
		      $config['source_image']   = './assets/upload/berita/'.$upload_foto['upload_data']['file_name'];
		      //lokasi thumbs
		      $config['new_image']      = './assets/upload/berita/thumbs/'.$upload_foto['upload_data']['file_name'];
		      $config['create_thumb']   = TRUE;
		      $config['maintain_ratio'] = TRUE;
		      $config['width']          = 500; //pixel
		      $config['height']         = 500;
		      $config['thumb_marker']   = '';

		      $this->load->library('image_lib', $config);

		      $this->image_lib->resize();
		      //end create thumbnail

			$i=$this->input;
			$date = date('Y-m-d H:i:s');
			$username = $this->session->userdata('nama');
			$slug_berita = url_title($this->input->post('judul'), 'dash', TRUE);

			$data = array( 	'username' 			=> $username,
							'kategori' 			=> $i->post('kategori'),
							'judul' 			=> $i->post('judul'),
							'judul_seo' 		=> $slug_berita,
							'isi_berita' 		=> $i->post('isi_berita'),
							'foto' 				=> $upload_foto['upload_data']['file_name'],
							'status'			=> $i->post('status'),
							'tanggal'			=> $date,
							'galeri'			=> '0'
		);
			$this->admin_model->tambah_berita($data);
			$this->session->set_flashdata('success', 'Data telah ditambahkan');
			redirect(base_url('admin/home/berita'),'refresh');
		}}
			$data = array( 'title'   	=>  'Halaman Tambah Informasi',
						   'isi'     	=>  'admin/berita/tambah');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function tambah_galeri(){

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('judul','Judul','required|is_unique[berita.judul]',
					array('required' 		=> '%s harus diisi',
						  'is_unique' 		=> '%s sudah ada'));
		
		if($valid->run()){
		
		$config['upload_path']   	= './assets/upload/berita/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['encrypt_name']   	= TRUE;
		$config['max_size']      	= 3072; // KB

		$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('foto')) {
		
		//end validasi

		$data = array( 'title'   	=>  'Halaman Tambah Galeri',
					   'isi'     	=>  'admin/berita/tambah_galeri',
					   'error'   	=>  $this->upload->display_errors());
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create image
		      $config['image_library']  = 'gd2';
		      $config['source_image']   = './assets/upload/berita/'.$upload_foto['upload_data']['file_name'];
		      //lokasi thumbs
		      $config['new_image']      = './assets/upload/berita/thumbs/'.$upload_foto['upload_data']['file_name'];
		      $config['create_thumb']   = TRUE;
		      $config['maintain_ratio'] = TRUE;
		      $config['width']          = 500; //pixel
		      $config['height']         = 500;
		      $config['thumb_marker']   = '';

		      $this->load->library('image_lib', $config);

		      $this->image_lib->resize();
		      //end create thumbnail

			$i=$this->input;
			$date = date('Y-m-d H:i:s');

			$data = array( 	'judul' 			=> $i->post('judul'),
							'foto' 				=> $upload_foto['upload_data']['file_name'],
							'status'			=> $i->post('status'),
							'tanggal'			=> $date,
							'galeri'			=> '1'
		);
			$this->admin_model->tambah_berita($data);
			$this->session->set_flashdata('success', 'Data telah ditambahkan');
			redirect(base_url('admin/home/galeri'),'refresh');
		}}
			$data = array( 'title'   	=>  'Halaman Tambah Galeri',
						   'isi'     	=>  'admin/berita/tambah_galeri');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function edit_berita($id_berita){

		$detail_berita = $this->admin_model->detail_berita($id_berita);
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules(	'judul','Judul','required',
					array(	'required' 		=> '%s harus diisi'));
		
		if($valid->run()){
		if(! empty($_FILES['foto']['name'])){
		$config['upload_path']   	= './assets/upload/berita/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['encrypt_name']   	= TRUE;
		$config['max_size']      	= 3076; // KB

		$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('foto')) {
		
		//end validasi

		$data = array( 'title'   		=>  'Halaman Edit Informasi',
					   'detail_berita'	=>  $detail_berita,
					   'isi'     		=>  'admin/berita/edit',
					   'error'   		=>  $this->upload->display_errors());
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create image
		      $config['image_library']  = 'gd2';
		      $config['source_image']   = './assets/upload/berita/'.$upload_foto['upload_data']['file_name'];
		      //lokasi thumbs
		      $config['new_image']    = './assets/upload/berita/thumbs/'.$upload_foto['upload_data']['file_name'];
		      $config['create_thumb']   = TRUE;
		      $config['maintain_ratio'] = TRUE;
		      $config['width']          = 300; //pixel
		      $config['height']         = 300;
		      $config['thumb_marker']     = '';

		      $this->load->library('image_lib', $config);

		      $this->image_lib->resize();
		      //end create thumbnail

		       if($detail_berita->foto != ""){
		          unlink('./assets/upload/berita/'.$detail_berita->foto);
		          unlink('./assets/upload/berita/thumbs/'.$detail_berita->foto);
		          }

			$i=$this->input;
			$username = $this->session->userdata('nama');
			$slug_berita = url_title($this->input->post('judul'), 'dash', TRUE);

			// $checkboxes = $i->post('tag');
			// $tag = implode(", ",$checkboxes);

			$data = array( 	'id_berita'			=> $detail_berita->id_berita,
							'username' 			=> $username,
							'kategori' 			=> $i->post('kategori'),
							'judul' 			=> $i->post('judul'),
							'judul_seo' 		=> $slug_berita,
							'isi_berita' 		=> $i->post('isi_berita'),
							'foto' 				=> $upload_foto['upload_data']['file_name'],
							'status'			=> $i->post('status')

		);
			$this->admin_model->edit_berita($data);
			$this->session->set_flashdata('success', 'Data telah diperbaharui');
			redirect(base_url('admin/home/berita'),'refresh');
		}}else{

			$i=$this->input;
			$username = $this->session->userdata('nama');
			$slug_berita = url_title($this->input->post('judul'), 'dash', TRUE);

			// $checkboxes = $i->post('tag');
			// $tag = implode(", ",$checkboxes);

			$data = array( 	'id_berita'			=> $detail_berita->id_berita,
							'username' 			=> $username,
							'kategori' 			=> $i->post('kategori'),
							'judul' 			=> $i->post('judul'),
							'judul_seo' 		=> $slug_berita,
							'status'			=> $i->post('status'),
							'isi_berita' 		=> $i->post('isi_berita')
		);
			$this->admin_model->edit_berita($data);
			$this->session->set_flashdata('success', 'Data telah diperbaharui');
			redirect(base_url('admin/home/berita'),'refresh');
		}}
			$data = array( 'title'   		=>  'Halaman Edit Informasi',
						   'detail_berita'	=>  $detail_berita,
						   'isi'     		=>  'admin/berita/edit');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function edit_galeri($id_berita){

		$detail_berita = $this->admin_model->detail_berita($id_berita);
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules(	'judul','Judul','required',
					array(	'required' 		=> '%s harus diisi'));
		
		if($valid->run()){
		if(! empty($_FILES['foto']['name'])){
		$config['upload_path']   	= './assets/upload/berita/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['encrypt_name']   	= TRUE;
		$config['max_size']      	= 3076; // KB

		$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('foto')) {
		
		//end validasi

		$data = array( 'title'   		=>  'Halaman Edit Galeri',
					   'detail_berita'	=>  $detail_berita,
					   'isi'     		=>  'admin/berita/edit_galeri',
					   'error'   		=>  $this->upload->display_errors());
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			//create image
		      $config['image_library']  = 'gd2';
		      $config['source_image']   = './assets/upload/berita/'.$upload_foto['upload_data']['file_name'];
		      //lokasi thumbs
		      $config['new_image']    = './assets/upload/berita/thumbs/'.$upload_foto['upload_data']['file_name'];
		      $config['create_thumb']   = TRUE;
		      $config['maintain_ratio'] = TRUE;
		      $config['width']          = 300; //pixel
		      $config['height']         = 300;
		      $config['thumb_marker']     = '';

		      $this->load->library('image_lib', $config);

		      $this->image_lib->resize();
		      //end create thumbnail

		       if($detail_berita->foto != ""){
		          unlink('./assets/upload/berita/'.$detail_berita->foto);
		          unlink('./assets/upload/berita/thumbs/'.$detail_berita->foto);
		          }

			$i=$this->input;

			// $checkboxes = $i->post('tag');
			// $tag = implode(", ",$checkboxes);

			$data = array( 	'id_berita'			=> $detail_berita->id_berita,
							'judul' 			=> $i->post('judul'),
							'foto' 				=> $upload_foto['upload_data']['file_name'],
							'status'			=> $i->post('status'),

		);
			$this->admin_model->edit_berita($data);
			$this->session->set_flashdata('success', 'Data telah diperbaharui');
			redirect(base_url('admin/home/galeri'),'refresh');
		}}else{

			$i=$this->input;

			// $checkboxes = $i->post('tag');
			// $tag = implode(", ",$checkboxes);

			$data = array( 	'id_berita'			=> $detail_berita->id_berita,
							'judul' 			=> $i->post('judul'),
							'status'			=> $i->post('status')
		);
			$this->admin_model->edit_berita($data);
			$this->session->set_flashdata('success', 'Data telah diperbaharui');
			redirect(base_url('admin/home/galeri'),'refresh');
		}}
			$data = array( 'title'   		=>  'Halaman Edit Galeri',
						   'detail_berita'	=>  $detail_berita,
						   'isi'     		=>  'admin/berita/edit_galeri');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function hapus_berita($id_berita){

			//proses hapus foto
			$detail_berita = $this->admin_model->detail_berita($id_berita);
			if($detail_berita->foto != ""){
			unlink('./assets/upload/berita/'.$detail_berita->foto);
			unlink('./assets/upload/berita/thumbs/'.$detail_berita->foto);
			}
			//end
			$data=array('id_berita' => $id_berita);
			$this->admin_model->delete_berita($data);
			$this->session->set_flashdata('success', 'Data telah di hapus');
			redirect(base_url('admin/home/berita'),'refresh');
	}

	public function hapus_galeri($id_berita){

			//proses hapus foto
			$detail_berita = $this->admin_model->detail_berita($id_berita);
			if($detail_berita->foto != ""){
			unlink('./assets/upload/berita/'.$detail_berita->foto);
			unlink('./assets/upload/berita/thumbs/'.$detail_berita->foto);
			}
			//end
			$data=array('id_berita' => $id_berita);
			$this->admin_model->delete_berita($data);
			$this->session->set_flashdata('success', 'Data telah di hapus');
			redirect(base_url('admin/home/galeri'),'refresh');
	}
    //END BERITA

    //popup calon mahasiswa di login
    public function cetak_popup($id){

        $popup = $this->admin_model->popup_login($id);

        $gelombang = $popup->gelombang;

        $Pecah = explode(",", $popup->jurusan_pilihan );

        for ( $i = 0; $i < count( $Pecah ); $i++ ) {
                $Pecah[$i] . "<br />";
                }

        $kode = $Pecah[0];
        
        $popup_prodi = $this->admin_model->popup_prodi($kode);

        $gelombang_biaya = $this->admin_model->popup_gelombang($gelombang);

        $detail_pendaftar = $this->admin_model->detail_pendaftaran($id);
        
        $detail_institusi = $this->admin_model->detail_institusi();

        $fakultas = $popup->fakultas;
        
        $detail_fakultas = $this->admin_model->kartu_fakultas($fakultas);

        $data = array('title'               => 'Popup Pendaftaran',
                      'detail_pendaftar'    => $detail_pendaftar,
                      'popup_prodi'         => $popup_prodi,
                      'detail_fakultas'     => $detail_fakultas,
                      'gelombang_biaya'     => $gelombang_biaya,
                      'detail_institusi'    => $detail_institusi);
        $this->load->view('popup/cetak', $data, FALSE);
    }

    public function kelulusan(){

		$detail 	= $this->admin_model->detail_pendaftaran_mahasiswa();

		$data = array( 'title'   			=> 'Halaman Kelulusan Ujian Saringan Masuk',
					   'detail'				=> $detail,
					   'isi'     			=> 'admin/mahasiswa/kelulusan');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}

	//cek ip
	private function get_client_ip() {
    
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
	}

	// Mendapatkan jenis web browser pengunjung
	private function get_client_browser() {
	    $browser = '';
	    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
	        $browser = 'Netscape';
	    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
	        $browser = 'Firefox';
	    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
	        $browser = 'Chrome';
	    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
	        $browser = 'Opera';
	    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
	        $browser = 'Internet Explorer';
	    else
	        $browser = 'Other';
	    return $browser;
	}

	//Menu aktivitas sistem 
    public function aktivity()
	{
		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
		$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

		$aktitas = $this->admin_model->listing_aktivitas($id_thn_akademik);

		$data = array( 'title' 	  => 'Halaman Aktivitas Sistem',
					   'aktitas'  => $aktitas,
					   'isi'   	  => 'admin/aktivitas');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	//jadwal di pengguna
	public function jadwal_usm(){

      $detail_pendaftaran 			= $this->admin_model->detail_pendaftaran_mahasiswa();
	      $gelombang 					= $detail_pendaftaran->gelombang;
	      $prodi 					= $detail_pendaftaran->jurusan_pilihan;
	      $program 					= $detail_pendaftaran->program;
	      $detail_prodi 				= $this->admin_model->detail_prodi_kode($prodi);
	      $jenjang_jadwal 				= !empty($detail_prodi->jenjang) ? $detail_prodi->jenjang : $detail_pendaftaran->jenjang;
	      $jadwal_usm                 	= $this->admin_model->jadwal_usm_admin($program, $jenjang_jadwal);
        

        $data = array( 'title'          	=> 'Halaman Jadwal Tes',
                       'jadwal_usm'     	=> $jadwal_usm,
                       'isi'            	=> 'admin/jadwal');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


	public function upload_berkas(){

		$detail 	= $this->admin_model->detail_pendaftaran_mahasiswa();

		$id_berkas = $this->input->post('id_berkas');
		$detail_berkas_master 	= $this->admin_model->detail_berkas_master($id_berkas);

		$id_pendaftar = $detail->id;
		$program = $detail->program;
		$cek_detail_berkas_masuk_pendaftar 	= $this->admin_model->detail_berkas_masuk_pendaftar($id_berkas,$id_pendaftar,$program);
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_lengkap','Nama','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
			//jika foto tidak kosong
			if(! empty($_FILES['berkas']['name'])){
			$config['upload_path']   	= './assets/upload/berkas/';
			$config['allowed_types'] 	= $detail_berkas_master->type_file;
			$config['max_size']      	= $detail_berkas_master->besar_berkas; // KB
			$config['encrypt_name']   	= TRUE;

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('berkas')) {
		
		//end validasi

		$data = array( 'title'   			=> 'Halaman Upload Berkas',
					   'detail'				=> $detail,
					   'error'   			=> $this->upload->display_errors(),
					   'isi'     			=> 'admin/mahasiswa/berkas');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		}else{
			$upload_foto = array('upload_data' => $this->upload->data());
			
			$data = array(  'id_pendaftar' 		=> $detail->id,				
							'id_berkas' 		=> $detail_berkas_master->id_berkas,		
							'file_masuk' 		=> $upload_foto['upload_data']['file_name'],
							'program' 			=> $detail_berkas_master->program
		);
			if(empty($cek_detail_berkas_masuk_pendaftar)){
				$this->admin_model->tambah_berkas_masuk($data);
				$this->session->set_flashdata('success', 'berkas berhasil di upload');
			redirect(base_url('admin/home/detail_berkas_mhs'),'refresh');
			}else{
				$this->session->set_flashdata('warning', 'Berkas ini sudah diupload');
				redirect(base_url('admin/home/detail_berkas_mhs'),'refresh');
			}

		}}}
			$data = array( 	'title'   			=> 'Halaman Upload Berkas ',
					   		'detail'			=> $detail,
					   		'isi'     			=> 'admin/mahasiswa/berkas');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function unduh_berkas($id_berkas_masuk){

      $detail_berkas_masuk = $this->admin_model->detail_berkas_masuk($id_berkas_masuk);
      $folder = './assets/upload/berkas/';
      $file   = $detail_berkas_masuk->file_masuk;
      force_download($folder.$file, NULL);
  	
  	}

  	public function edit_upload_berkas($id_berkas_masuk){

		$detail 	= $this->admin_model->detail_pendaftaran_mahasiswa();

		$detail_berkas_masuk_full 	= $this->admin_model->detail_berkas_masuk_full($id_berkas_masuk);
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama_lengkap','Nama','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
			//jika foto tidak kosong
			if(! empty($_FILES['berkas']['name'])){
			$config['upload_path']   	= './assets/upload/berkas/';
			$config['allowed_types'] 	= $detail_berkas_masuk_full->type_file;
			$config['max_size']      	= $detail_berkas_masuk_full->besar_berkas; // KB
			$config['encrypt_name']   	= TRUE;

			$this->load->library('upload', $config);
		
		if(! $this->upload->do_upload('berkas')) {
		
		//end validasi

		$data = array( 'title'   			=> 'Halaman Upload Berkas',
					   'detail'				=> $detail,
					   'error'   			=> $this->upload->display_errors(),
					   'isi'     			=> 'admin/mahasiswa/berkas');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

		}else{
			$upload_foto = array('upload_data' => $this->upload->data());

			unlink('./assets/upload/berkas/'.$detail_berkas_masuk_full->file_masuk);
			
			$data = array(  'id_berkas_masuk' 	=> $detail_berkas_masuk_full->id_berkas_masuk,		
							'file_masuk' 		=> $upload_foto['upload_data']['file_name'],
							'program' 			=> $detail_berkas_masuk_full->program
		);
			$this->admin_model->edit_berkas_masuk($data);
			$this->session->set_flashdata('success', 'Data telah di upload ulang');
			redirect(base_url('admin/home/detail_berkas_mhs'),'refresh');
		}}}
			$data = array( 	'title'   			=> 'Halaman Upload Berkas ',
					   		'detail'			=> $detail,
					   		'isi'     			=> 'admin/mahasiswa/berkas');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}



    public function verifikasi_berkas_agen($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '2');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/verifikasi_agen/'.$detail_pendaftaran->kode_agen),'refresh');
    }

    public function accept_berkas($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '2');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept'),'refresh');
    }

    public function accept_berkas_agen($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '2');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept_agen/'.$detail_pendaftaran->kode_agen),'refresh');
    }

    public function tolak_berkas($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '1');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/verifikasi'),'refresh');
    }

    public function tolak_berkas_agen($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '1');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/verifikasi_agen/'.$detail_pendaftaran->kode_agen),'refresh');
    }

    public function tolak_berkas_accept($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '1');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept'),'refresh');
    }

    public function tolak_berkas_accept_agen($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);

        $data = array('id' 					=> $detail_pendaftaran->id,
        	          'verifikasi_berkas' 	=> '1');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/accept_agen/'.$detail_pendaftaran->kode_agen),'refresh');
    }

    //Menu chat
    public function chat()
	{
	    $detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
		$id 				= $detail_pendaftaran->id;
		$list_chat 			= $this->admin_model->list_chat_mahasiswa($id);
		
		$data = array( 'title'   	=> 'Halaman Live Chat',
					   'detail'		=> $detail_pendaftaran,
					   'list_chat'  => $list_chat,
					   'isi'     	=> 'admin/mahasiswa/chat');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function chat_admin($id)
	{

		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
		$list_chat 	        = $this->admin_model->list_chat_mahasiswa($id);
		
		$data = array( 'title'   	=> 'Halaman Live Chat',
					   'detail'		=> $detail_pendaftaran,
					   'list_chat'  => $list_chat,
					   'isi'     	=> 'admin/mahasiswa/chat');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function tambah_chat(){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
        $i=$this->input;

        $data = array('id_pendaftar' 		=> $detail_pendaftaran->id,
        	          'nama' 				=> $detail_pendaftaran->nama_lengkap,
        	          'level' 				=> '3',
        	          'isi'					=> $i->post('isi')
        	         );
        $this->admin_model->tambah_chat($data);
        redirect(base_url('admin/home/chat'),'refresh');
    }

    public function tambah_chat_admin($id){

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $i=$this->input;

        $data = array('id_pendaftar' 		=> $detail_pendaftaran->id,
        	          'nama' 				=> $this->session->userdata('nama'),
        	          'level' 				=> $this->session->userdata('id_level'),
        	          'isi'					=> $i->post('isi')
        	         );
        $this->admin_model->tambah_chat($data);
        redirect(base_url('admin/home/chat_admin/'.$detail_pendaftaran->id),'refresh');
    }

    //manage biaya
  	public function biaya(){
        $list_biaya = $this->admin_model->list_biaya();

        $data = array( 'title'          => 'Halaman List Biaya',
                       'list_biaya'   	=> $list_biaya,
                       'isi'            => 'admin/biaya/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function edit_biaya($id){

      $pilih_fakultas = $this->admin_model->get_fakultas();
      $detail_biaya   = $this->admin_model->detail_biaya($id);
      $id_fakultas 	  = $detail_biaya->fakultas;
      $prodi 		  = $this->admin_model->get_list_prodi($id_fakultas);
      $list_program   = $this->admin_model->list_program_baru();
      $valid 		  = $this->form_validation;

      $valid->set_rules( 'biaya','Biaya','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      		=> 'Halaman Edit Rincian Biaya', 
       				 'pilih_fakultas'   => $pilih_fakultas,
       				 'detail_biaya'		=> $detail_biaya,
       				 'prodi'			=> $prodi,
       				 'list_program'		=> $list_program,
                     'isi'         		=> 'admin/biaya/edit');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'id'				=> $detail_biaya->id,
        				'fakultas'          => $i->post('fakultas'),
        				'prodi'        	 	=> $i->post('prodi'),
                        'program'           => $i->post('program'),
                        'biaya'        		=> $i->post('biaya'),
                        'isi'        		=> $i->post('isi'),
                        'utama'        		=> $i->post('utama'),
                        'status'        	=> $i->post('status')
      );
        $this->admin_model->edit_biaya($data);
        $this->session->set_flashdata('success', 'Data telah diubah');
        redirect(base_url('admin/home/biaya'),'refresh');
      }

    }

    public function tambah_biaya(){

      $pilih_fakultas = $this->admin_model->get_fakultas();
      $list_program   = $this->admin_model->list_program_baru();
      
      $valid 	= $this->form_validation;

      $valid->set_rules( 'biaya','Biaya','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      		=> 'Halaman Tambah Rincian Biaya', 
       				 'pilih_fakultas'   => $pilih_fakultas,
       				 'list_program'		=> $list_program,
                     'isi'         		=> 'admin/biaya/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'fakultas'          => $i->post('fakultas'),
        				'prodi'        	 	=> $i->post('prodi'),
                        'program'           => $i->post('program'),
                        'biaya'        		=> $i->post('biaya'),
                        'isi'        		=> $i->post('isi'),
                        'utama'        		=> $i->post('utama'),
                        'status'        	=> $i->post('status')
      );
        $this->admin_model->tambah_biaya($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/biaya'),'refresh');
      }

    }

    public function get_list_prodi(){
        $id_fakultas = $this->input->post('fakultas');
        $data = $this->admin_model->get_list_prodi($id_fakultas);
        echo json_encode($data);
    }

    // public function list_prodi(){

    //     $id_fakultas = $this->input->post('fakultas');
    //     $prodi = $this->admin_model->get_list_prodi($id_fakultas);
 
    //     // Set defaultnya dengan tag option Pilih
    //     $lists = "<option value=''>-Pilih-</option>";
    //     foreach($prodi as $prodi){
    //         $lists .= "<option value='".$prodi->id."'>".$prodi->jenjang."-".$prodi->nama."</option>"; // Tambahkan tag option ke variabel $lists
    //     }
    //     $callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
    //     echo json_encode($callback); // konversi varibael $callback menjadi JSON
    // }

    //Menu Jenjang
  	public function jenjang(){
        $list_jenjang = $this->admin_model->list_jenjang();

        $data = array( 'title'          => 'Halaman Jenjang',
                       'list_jenjang'   => $list_jenjang,
                       'isi'            => 'admin/jenjang/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function edit_aktif_jenjang($id){

      $jenjang 			= $this->admin_model->detail_jenjang($id); 

      $i=$this->input;
      $data = array(    'id'                => $jenjang->id,
      					'status'            => '1');
      $this->admin_model->edit_jenjang($data);
      $this->session->set_flashdata('success', 'Data jenjang telah aktif');
      redirect(base_url('admin/home/jenjang'),'refresh');
    
  }

  	public function edit_nonaktif_jenjang($id){

      $jenjang 			= $this->admin_model->detail_jenjang($id); 

      $i=$this->input;
      $data = array(    'id'                => $jenjang->id,
      					'status'            => '0');
      $this->admin_model->edit_jenjang($data);
      $this->session->set_flashdata('success', 'Data jenjang telah non-aktif');
      redirect(base_url('admin/home/jenjang'),'refresh');
    
  }

  	//End jenjang

  	public function excel_verifikasi(){
  		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $excel_pmb          = $this->admin_model->excel_verifikasi($id_thn_akademik);
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();

        $data = array('title'   		=> 'Export Data PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'isi'     		=> 'admin/verifikasi/export');
        $this->load->view('admin/verifikasi/export', $data, FALSE);
    }

	    public function export_pendaftaran_excel($status = 'registrasi'){
	        $allowed = array('registrasi', 'terverifikasi', 'diterima', 'registrasi_ulang');
	        if (!in_array($status, $allowed)) {
	            show_404();
	        }

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
        $labels = array(
            'registrasi' => 'Registrasi',
            'terverifikasi' => 'Terverifikasi',
            'diterima' => 'Diterima',
	            'registrasi_ulang' => 'Registrasi Ulang'
	        );

	        $filters = array(
	            'gelombang' => $this->input->get('gelombang') !== NULL ? $this->input->get('gelombang') : $this->input->post('gelombang'),
	            'prodi' => $this->input->get('prodi') !== NULL ? $this->input->get('prodi') : $this->input->post('prodi'),
	            'registrasi_ulang' => $this->input->get('registrasi_ulang') !== NULL ? $this->input->get('registrasi_ulang') : $this->input->post('registrasi_ulang')
	        );

	        $excel_pmb = $this->admin_model->export_pendaftaran_status($id_thn_akademik, $status, $filters);

        $this->load->library('excel');
        $excel = new PHPExcel();
        $sheet = $excel->getSheet(0);
        $sheet->setTitle(substr($labels[$status], 0, 31));

        $headers = array(
            'No', 'Status Data', 'Tanggal Daftar', 'Tanggal Update', 'Username', 'No. Ujian', 'Sumber',
            'NIK', 'NISN', 'Nama Lengkap', 'Jenis', 'Program', 'Fakultas', 'Gelombang', 'Pilihan 1',
            'Pilihan 2', 'Email', 'No WA', 'Asal Sekolah', 'Jurusan Sekolah', 'Tahun Lulus',
            'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Agama', 'Alamat', 'Kecamatan',
            'Kota', 'Provinsi', 'Status Bayar', 'Status Verifikasi', 'Status Diterima',
            'Registrasi Ulang', 'Verifikasi Registrasi', 'Berkas', 'Jumlah Bayar', 'Bank Bayar',
            'Atas Nama Bayar', 'Tanggal Bayar', 'Bank Regis', 'Atas Nama Regis', 'Tanggal Regis'
        );

        foreach ($headers as $col => $header) {
            $sheet->setCellValueByColumnAndRow($col, 1, $header);
            $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }
        $sheet->freezePane('A2');
        $sheet->getStyle('A1:AP1')->getFont()->setBold(true);
        $sheet->getStyle('A1:AP1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');

        $row_number = 2;
        $no = 1;
        foreach ($excel_pmb as $row) {
            $berkas = $row->verifikasi_berkas == '1' ? 'Sudah Dicek' : ($row->keterangan_berkas ?: 'Belum Dicek');
            $values = array(
                $no,
                $labels[$status],
                $row->tanggal_daftar,
                $row->tanggal_update,
                $row->username,
                $row->noujian,
                trim($row->sumber.' '.$row->keterangan_sumber),
                $row->nik,
                $row->nisn,
                strtoupper($row->nama_lengkap),
                $row->jenis,
                $row->nama_program,
                trim($row->singkatan.' - '.$row->nama_fakultas),
                trim($row->nama_gelombang.' '.$row->tahun_gelombang),
                trim($row->jenjang_prodi.' '.$row->nama_prodi),
                trim($row->jenjang_prodi2.' '.$row->nama_prodi2),
                $row->email,
                $row->hp,
                $row->sekolah_nama,
                $row->sekolah_jurusan ?: $row->sekolah_nama_jurusan,
                $row->tahun_lulus,
                $row->tempat_lahir,
                $row->tanggal_lahir,
                $row->jk,
                $row->agama,
                $row->alamat,
                $row->kecamatan,
                $row->kota,
                $row->prov,
                ((string) $row->bayar === '1') ? 'Sudah Bayar' : 'Belum Bayar',
                ((string) $row->approve === '1') ? 'Terverifikasi' : 'Belum Terverifikasi',
                ((string) $row->fix === '1') ? 'Diterima' : 'Belum Diterima',
                ((string) $row->registrasi_ulang === '1') ? 'Sudah Registrasi' : 'Belum Registrasi',
                ((string) $row->verifikasi_regis === '1') ? 'Terverifikasi' : 'Belum Terverifikasi',
                $berkas,
                $row->jumlahbayar,
                $row->bank,
                $row->atas_nama,
                $row->tgl_bayar,
                $row->bank_regis,
                $row->atas_regis,
                $row->tgl_regis
            );

            foreach ($values as $col => $value) {
                $sheet->setCellValueExplicitByColumnAndRow($col, $row_number, $value, PHPExcel_Cell_DataType::TYPE_STRING);
            }
            $row_number++;
            $no++;
        }

        $filename = 'Data_PMB_'.$labels[$status].'_'.date('Ymd_His').'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
    }

    public function export_data(){
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik();
        $default_tahun = $this->default_tahun_siakad($ambil_detail_thn_akademik->nama_thn_akademik);

        $data = array(
            'title' => 'Export Data',
            'tahun_akademik' => $this->admin_model->list_thn_akademik(),
            'list_prodi' => $this->admin_model->list_prodi(),
            'default_tahun' => $default_tahun,
            'isi' => 'admin/export/data'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function export_data_siakad(){
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik();
        $id_thn_akademik = $this->input->post('id_thn_akademik') ?: 'all';
        $prodi = $this->input->post('prodi') ?: 'all';
        $tahun_ajar = $this->input->post('tahun_ajar') ?: $this->default_tahun_siakad($ambil_detail_thn_akademik->nama_thn_akademik);
        $tahun_masuk = $this->input->post('tahun_masuk') ?: $tahun_ajar;
        $kelas = $this->input->post('kelas');
        $status = $this->input->post('status') ?: '1';
	        $sumber_nim = $this->input->post('sumber_nim') ?: 'nim';
        $data_lulus = $this->admin_model->export_siakad_mahasiswa_lulus($id_thn_akademik, $prodi);

        $this->load->library('excel');
        $excel = new PHPExcel();
        $sheet = $excel->getSheet(0);
        $sheet->setTitle('Template Mahasiswa');
        $headers = array('NO', 'PRODI', 'NAMA', 'NIM', 'NIK', 'TAHUN AJAR', 'TAHUN MASUK', 'PASSWORD', 'EMAIL', 'STATUS', 'JENIS KELAMIN', 'KELAS', 'TEMPAT LAHIR', 'TGL LAHIR');
        foreach ($headers as $col => $header) {
            $sheet->setCellValueByColumnAndRow($col, 1, $header);
        }
        $sheet->freezePane('A2');
        $sheet->getStyle('A1:N1')->getFont()->setBold(true);
        $sheet->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D9D9D9');
        foreach (range('A', 'N') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $row = 2;
        $no = 1;

        foreach ($data_lulus as $mhs) {
            $nim = $this->nim_siakad($mhs, $sumber_nim);
            $sheet->setCellValueByColumnAndRow(0, $row, $no);
            $sheet->setCellValueExplicitByColumnAndRow(1, $row, $this->id_prodi_siakad($mhs), PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueByColumnAndRow(2, $row, strtoupper($mhs->nama_lengkap));
            $sheet->setCellValueExplicitByColumnAndRow(3, $row, $nim, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(4, $row, $mhs->nik, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(5, $row, $tahun_ajar, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(6, $row, $tahun_masuk, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(7, $row, $nim, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueByColumnAndRow(8, $row, $mhs->email ?: ($nim.'@student.siakadku.ac.id'));
            $sheet->setCellValueByColumnAndRow(9, $row, $status);
            $sheet->setCellValueByColumnAndRow(10, $row, $this->jenis_kelamin_siakad($mhs->jk));
            $sheet->setCellValueByColumnAndRow(11, $row, $kelas);
            $sheet->setCellValueByColumnAndRow(12, $row, $mhs->tempat_lahir);
            $sheet->setCellValueExplicitByColumnAndRow(13, $row, $mhs->tanggal_lahir, PHPExcel_Cell_DataType::TYPE_STRING);
            $row++;
            $no++;
        }

        $filter_tahun = $id_thn_akademik == 'all' ? 'semua_tahun' : $id_thn_akademik;
        $filter_prodi = $prodi == 'all' ? 'semua_prodi' : $prodi;
        $filter_prodi = preg_replace('/[^A-Za-z0-9_-]/', '-', $filter_prodi);
        $filename = 'template_mahasiswa_pmb_lulus_'.$filter_tahun.'_'.$filter_prodi.'_'.$tahun_ajar.'_'.$tahun_masuk.'_'.date('YmdHis').'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
    }

    private function default_tahun_siakad($nama_thn_akademik)
    {
        preg_match('/([0-9]{4})/', $nama_thn_akademik, $match);
        $tahun = isset($match[1]) ? $match[1] : (date('n') >= 8 ? date('Y') : date('Y') - 1);
        $semester = date('n') >= 8 ? '1' : '2';
        return $tahun.$semester;
    }

    private function id_prodi_siakad($mhs)
    {
        $map = array(
            'S1|PAI' => '9',
            'S1|PBA' => '10',
            'S1|BKPI' => '11',
            'S1|PIAUD' => '12',
            'S1|EKOS' => '13',
            'S1|HKI' => '14',
            'S1|MHU' => '15',
            'S1|KPI' => '16',
            'S2|MPI' => '17',
            'S2|PBA' => '18'
        );
        $jenjang = isset($mhs->jenjang_prodi_lulus) && trim($mhs->jenjang_prodi_lulus) != '' ? $mhs->jenjang_prodi_lulus : $mhs->jenjang;
        $kode = isset($mhs->kode_prodi_lulus) && trim($mhs->kode_prodi_lulus) != '' ? $mhs->kode_prodi_lulus : $mhs->jurusan_pilihan;
        $key = strtoupper(trim($jenjang)).'|'.strtoupper(trim($kode));
        return isset($map[$key]) ? $map[$key] : $mhs->id_prodi_lulus;
    }

	    private function nim_siakad($mhs, $sumber_nim)
	    {
	        if ($sumber_nim == 'nim' && isset($mhs->nim) && trim($mhs->nim) != '') {
	            return $mhs->nim;
	        }
	        if ($sumber_nim == 'username') {
	            return $mhs->username;
	        }
        return $mhs->noujian ?: $mhs->username;
    }

    private function jenis_kelamin_siakad($jk)
    {
        $jk = strtoupper(trim($jk));
        if ($jk == 'L' || $jk == 'LAKI-LAKI') {
            return 'Laki-Laki';
        }
        if ($jk == 'P' || $jk == 'PEREMPUAN') {
            return 'Perempuan';
        }
        return $jk;
    }

    public function excel_diterima(){
    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $excel_pmb          = $this->admin_model->excel_diterima($id_thn_akademik);
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();

        $data = array('title'   		=> 'Export Data PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'isi'     		=> 'admin/diterima/excel');
        $this->load->view('admin/diterima/excel', $data, FALSE);
    }


    public function excel_regis(){
    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $excel_pmb          = $this->admin_model->excel_regis($id_thn_akademik);
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();

        $data = array('title'   		=> 'Export Data PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'isi'     		=> 'admin/regis/excel');
        $this->load->view('admin/regis/excel', $data, FALSE);
    }

    public function excel_regis_belum(){
    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $excel_pmb          = $this->admin_model->excel_regis($id_thn_akademik);
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();

        $data = array('title'   		=> 'Export Data PMB',
                      'excel_pmb'      	=> $excel_pmb,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'isi'     		=> 'admin/regis/excel_belum');
        $this->load->view('admin/regis/excel_belum', $data, FALSE);
    }


    public function delete_verifikasi($id){
      $pengguna = $this->admin_model->detail_pendaftaran($id);    
      $username = $pengguna->username;
      $d_user = $this->admin_model->detail_pengguna_delete($username);

      $data_user=array('username' => $d_user->username);
      $this->admin_model->delete_pengguna_user($data_user);

      $data=array('id' => $id);
      $this->admin_model->delete_verifikasi($data);

      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/verifikasi'),'refresh');
  	}

  	public function delete_verifikasi_agen($id){
      $pengguna = $this->admin_model->detail_pendaftaran($id);    
      $username = $pengguna->username;
      $d_user = $this->admin_model->detail_pengguna_delete($username);

      $data_user=array('username' => $d_user->username);
      $this->admin_model->delete_pengguna_user($data_user);

      $data=array('id' => $id);
      $this->admin_model->delete_verifikasi($data);

      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/verifikasi_agen/'.$pengguna->kode_agen),'refresh');
  	}

  	public function delete_accept($id){
      $pengguna = $this->admin_model->detail_pendaftaran($id);    
      $username = $pengguna->username;
      $d_user = $this->admin_model->detail_pengguna_delete($username);

      $data_user=array('username' => $d_user->username);
      $this->admin_model->delete_pengguna_user($data_user);

      $data=array('id' => $id);
      $this->admin_model->delete_verifikasi($data);

      $this->session->set_flashdata('success', 'Data telah di hapus');
      redirect(base_url('admin/home/accept'),'refresh');
  	}

  	public function delete_pilihan_karantina(){
	 	$data = $this->input->post('username'); // Ambil data id
		$this->admin_model->delete_pendaftar_username($data);
		$this->admin_model->delete_user_username($data);

        $this->session->set_flashdata('success', 'Data pendaftar yang belum bayar berhasil dihapus');
      	redirect(base_url('admin/home/karantina'),'refresh');
	 }

  	public function delete_pilihan(){
	 	$data = $this->input->post('username'); // Ambil data id
		$this->admin_model->delete_pendaftar_username($data);
		$this->admin_model->delete_user_username($data);

        $this->session->set_flashdata('success', 'Data pendaftar yang sudah bayar berhasil dihapus');
      	redirect(base_url('admin/home/verifikasi'),'refresh');
	 }

	public function delete_pilihan_accept(){
	 	$data = $this->input->post('username'); // Ambil data id
		$this->admin_model->delete_pendaftar_username($data);
		$this->admin_model->delete_user_username($data);

        $this->session->set_flashdata('success', 'Data pendaftar berhasil di hapus');
      	redirect(base_url('admin/home/accept'),'refresh');
	 }

	 public function delete_pilihan_diterima(){
	 	$data = $this->input->post('username'); // Ambil data id
		$this->admin_model->delete_pendaftar_username($data);
		$this->admin_model->delete_user_username($data);

        $this->session->set_flashdata('success', 'Data Pendaftar berhasil di hapus');
      	redirect(base_url('admin/home/diterima'),'refresh');
	 }

	 public function delete_gelombang_banyak(){
	 	$data = $this->input->post('id'); // Ambil data id
		$this->admin_model->delete_gelombang_banyak($data);

        $this->session->set_flashdata('success', 'Data gelombang berhasil di hapus');
      	redirect(base_url('admin/home/gelombang'),'refresh');
	 }


	public function delete_aktivitas(){
	 	$data = $this->input->post('id'); // Ambil data id
		$this->admin_model->delete_aktivitas($data);
		
        $this->session->set_flashdata('success', 'Data Aktivitas Sistem berhasil di hapus');
      	redirect(base_url('admin/home/aktivity'),'refresh');
	 }

	public function delete_user(){
	 	$data = $this->input->post('id'); // Ambil data id
		$this->admin_model->delete_user_pilih($data);
		
        $this->session->set_flashdata('success', 'Data User berhasil di hapus');
      	redirect(base_url('admin/home/pengguna'),'refresh');
	 }

	public function cetak_formulir($id)
  {

    $detail_pendaftaran 	= $this->admin_model->detail_pendaftaran($id);
    $gelombang 				= $detail_pendaftaran->gelombang;
    $id 					= $detail_pendaftaran->gelombang;
	    $prodi 					= $detail_pendaftaran->jurusan_pilihan;
	    $id_gelombang 			= $this->admin_model->detail_gelombang($id);
	    $program 				= $detail_pendaftaran->program;
	    $detail_prodi 			= $this->admin_model->detail_prodi_kode($prodi);
	    $jenjang_jadwal 		= !empty($detail_prodi->jenjang) ? $detail_prodi->jenjang : $detail_pendaftaran->jenjang;
	    $jadwal_usm             = $this->admin_model->jadwal_usm_admin($program, $jenjang_jadwal);
    $detail_institusi       = $this->admin_model->detail_institusi();
    $fakultas 				= $detail_pendaftaran->fakultas;
    $detail_fakultas		= $this->admin_model->kartu_fakultas($fakultas);
	    $kartu_program			= $this->admin_model->kartu_program($program);
      

        $data = array('title'                     => 'Cetak Formulir',
                      'jadwal_usm'          	  => $jadwal_usm,
                      'detail_pendaftaran'        => $detail_pendaftaran,
                      'detail_fakultas'        	  => $detail_fakultas,
                      'kartu_program'        	  => $kartu_program,
                      'detail_institusi'          => $detail_institusi,
                      'gelombang'			  	  => $id_gelombang,
                      'isi'              		  => 'kartu/formulir');
        $this->load->view('kartu/formulir', $data, FALSE);

  }

  public function lulus_pilihan($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
    	$id_gelombang = $detail_pendaftaran->gelombang_2;
    	$detail_gelombang = $this->admin_model->detail_gelombang_id($id_gelombang);
	        $data = array( 'id' 			=> $detail_pendaftaran->id,
        			   'fakultas' 		=> $detail_gelombang->fakultas,
        			   'fix' 			=> '1',
        			   'non_fix' 		=> '0',
                       'nim' => NULL,
        			   'gelombang'=> $detail_pendaftaran->gelombang_2,
        			   'gelombang_2'=> $detail_pendaftaran->gelombang,
        			   'jurusan_pilihan'=> $detail_pendaftaran->jurusan_pilihan2,
        			   'jurusan_pilihan2'=> $detail_pendaftaran->jurusan_pilihan);
	        $this->admin_model->edit_pendaftaran($data);
	        $this->admin_model->generate_nim_pendaftar($detail_pendaftaran->id);

	        $username = $detail_pendaftaran->username;
        $detail_pengguna = $this->admin_model->detail_pengguna_admin($username);

        $pengguna = array(  'id'              => $detail_pengguna->id,   
                            'fakultas'          => $detail_gelombang->fakultas,
                            'prodi'             => $detail_pendaftaran->jurusan_pilihan2
          );
          $this->admin_model->edit_pengguna_admin($pengguna);


        redirect(base_url('admin/home/accept'),'refresh');

    }

   public function lulus_pilihan_diterima($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
    	$id_gelombang = $detail_pendaftaran->gelombang_2;
    	$detail_gelombang = $this->admin_model->detail_gelombang_id($id_gelombang);
	        $data = array( 'id' 			=> $detail_pendaftaran->id,
        			   'fakultas' 		=> $detail_gelombang->fakultas,
                       'nim' => NULL,
        			   'gelombang'=> $detail_pendaftaran->gelombang_2,
        			   'gelombang_2'=> $detail_pendaftaran->gelombang,
        			   'jurusan_pilihan'=> $detail_pendaftaran->jurusan_pilihan2,
        			   'jurusan_pilihan2'=> $detail_pendaftaran->jurusan_pilihan);
	        $this->admin_model->edit_pendaftaran($data);
	        $this->admin_model->generate_nim_pendaftar($detail_pendaftaran->id);

	        $username = $detail_pendaftaran->username;
        $detail_pengguna = $this->admin_model->detail_pengguna_admin($username);

        $pengguna = array(  'id'              => $detail_pengguna->id,   
                            'fakultas'          => $detail_gelombang->fakultas,
                            'prodi'             => $detail_pendaftaran->jurusan_pilihan2
          );
          $this->admin_model->edit_pengguna_admin($pengguna);

        redirect(base_url('admin/home/diterima'),'refresh');

    }

   //Menu Backup Data
    public function backup(){

        $data = array('title' 				=> 'Halaman Bakcup Data',
                      'isi'   				=> 'admin/backup');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function backup_excel(){
        $backup_excel          = $this->admin_model->backup_excel();

        $data = array('title'   		=> 'Backup Data Excel Pendaftar ',
                      'backup_excel'    => $backup_excel,
                      'isi'     		=> 'admin/backup_excel');
        $this->load->view('admin/backup_excel', $data, FALSE);
    }

    // backup files in directory
  function backup_file()
  {
     $opt = array(
       'src' => base_url(), // dir name to backup
       'dst' => 'backup_db/files' // dir name backup output destination
     );
     
     // Codeigniter v3x
     $this->load->library('recurseZip_lib', $opt);
     $download = $this->recursezip_lib->compress();
     
     /* Codeigniter v2x
     $zip    = $this->load->library('recurseZip_lib', $opt);     
     $download = $zip->compress();
     */
     
     redirect(base_url($download));
  }
   
  // backup database.sql
  public function backup_db()
  {
     $this->load->dbutil();
   
     $prefs = array(
       'format' => 'zip',
       'filename' => 'my_db_backup.sql'
     );
   
     $backup =& $this->dbutil->backup($prefs);
   
     $db_name = 'backup_db-pmb-' . date("Y-m-d-H-i-s") . '.zip'; // file name
     $save  = 'backup_db/' . $db_name; // dir name backup output destination
   
     $this->load->helper('file');
     write_file($save, $backup);
   
     $this->load->helper('download');
     force_download($db_name, $backup);
  }

  public function excel_tahun(){
        $backup_excel          = $this->admin_model->excel_tahunan();
        $fakultas_hadir		= $this->admin_model->fakultas_hadir();

        $data = array('title'   		=> 'Export Data Tahunan PMB',
                      'backup_excel'    => $backup_excel,
                      'fakultas_hadir'	=> $fakultas_hadir,
                      'isi'     		=> 'admin/excel_tahunan');
        $this->load->view('admin/excel_tahunan', $data, FALSE);
    }

   public function panduan(){
        $data = array('title' 				=> 'Halaman Panduan Aplikasi PMB',
                      'isi'   				=> 'admin/panduan');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function nonaktif_user($id){

    	$pengguna 			= $this->admin_model->detail_pengguna($id); 
        $data = array( 'id' 		=> $pengguna->id,
        			   'status' 	=> '0');
        $this->admin_model->edit_pengguna($data);
        redirect(base_url('admin/home/pengguna'),'refresh');

    }

    public function aktifkan($id){

    	$pengguna 			= $this->admin_model->detail_pengguna($id); 
        $data = array( 'id' 		=> $pengguna->id,
        			   'status' 	=> '1');
        $this->admin_model->edit_pengguna($data);
        redirect(base_url('admin/home/pengguna'),'refresh');

    }

    public function nonaktif_user_admin($id){

    	$pengguna 			= $this->admin_model->detail_pengguna($id); 
        $data = array( 'id' 		=> $pengguna->id,
        			   'status' 	=> '0');
        $this->admin_model->edit_pengguna($data);
        redirect(base_url('admin/home/user_admin'),'refresh');

    }

    public function aktifkan_admin($id){

    	$pengguna 			= $this->admin_model->detail_pengguna($id); 
        $data = array( 'id' 		=> $pengguna->id,
        			   'status' 	=> '1');
        $this->admin_model->edit_pengguna($data);
        redirect(base_url('admin/home/user_admin'),'refresh');

    }

    public function kontak()
	{
		$detail = $this->admin_model->detail_pendaftaran_mahasiswa();
		$pengguna   = $this->admin_model->listing_pengguna_admin();

		$data = array( 'title' 			=> 'Halaman Kontak Admin',
					   'detail'  		=> $detail,
					   'pengguna'			=> $pengguna,
					   'isi'   			=> 'admin/kontak');
		$this->load->view('admin/layout/wrapper', $data, FALSE);

	}

	public function sumber(){
        $list_sumber = $this->admin_model->list_sumber();

        $data = array( 'title'          => 'Halaman Sumber Referensi',
                       'list_sumber' 	=> $list_sumber,
                       'isi'            => 'admin/sumber/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_sumber(){

      $valid = $this->form_validation;

      $valid->set_rules( 'nama','Nama Sumber','required',
                    array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Sumber Referensi',
                    'isi'         => 'admin/sumber/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'nama'              => $i->post('nama'),
                        'status'            => $i->post('status'),
                        'urutan'            => $i->post('urutan')
      );
        $this->admin_model->tambah_sumber($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/sumber'),'refresh');
      }

    }

    public function edit_sumber($id){

    $detail_sumber = $this->admin_model->detail_sumber($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama sumber refernsi','required',
                  array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      			=> 'Halaman Edit Sumber Referensi',
                    'detail_sumber'          => $detail_sumber, 
                    'isi'       			=> 'admin/sumber/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                => $id,
                        'nama'              => $i->post('nama'),
                        'status'            => $i->post('status'),
                        'urutan'            => $i->post('urutan')
      );
      $this->admin_model->edit_sumber($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/sumber'),'refresh');
    }
  }

  public function kelulusan_login(){

  		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $lulus 			  	  = $this->admin_model->kelulusan_login();
        $list_prodi 		  	  = $this->admin_model->list_prodi();
        $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        $data = array( 'title'          => 'Halaman Kelulusan',          
                       'lulus'     	=> $lulus,
                       'list_prodi'		=> $list_prodi,
                       'pilih_gelombang'=> $pilih_gelombang,
                       'isi'            => 'admin/kelulusan');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function kelulusan_peserta(){

        $detail 			  	  = $this->admin_model->detail_pendaftaran_mahasiswa();

        $data = array( 'title'          => 'Halaman Kelulusan',          
                       'detail'     	=> $detail,
                       'isi'            => 'admin/kelulusan_peserta');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function thn_akademik(){
        $list_thn_akademik = $this->admin_model->list_thn_akademik();

        $data = array( 'title'          	=> 'Halaman Tahun Akademik',
                       'list_thn_akademik' 	=> $list_thn_akademik,
                       'isi'           	 	=> 'admin/thn_akademik/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_thn_akademik(){

      $valid = $this->form_validation;

      $valid->set_rules('nama_thn_akademik','Nama','required|is_unique[tahun_akademik.nama_thn_akademik]',
                    array('required'   => '%s tahun akademik harus diisi',
                          'is_unique'  => '%s sudah ada. Buat Nama tahun akademik baru.'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Tahun Akademik',
                    'isi'         => 'admin/thn_akademik/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'nama_thn_akademik'     => $i->post('nama_thn_akademik'),
                        'status_thn_akademik'  => $i->post('status_thn_akademik'),
                        'berlaku'            	=> $i->post('berlaku')
      );
        $this->admin_model->tambah_thn_akademik($data);

        $data_grup = array( 'grup_nama'    => $i->post('nama_thn_akademik')
      );
        $this->admin_model->tambah_grup_tes($data_grup);


        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/thn_akademik'),'refresh');
      }

    }

    public function edit_thn_akademik($id_thn_akademik){

    $detail_thn_akademik = $this->admin_model->detail_thn_akademik($id_thn_akademik); 
    $grup_nama = $detail_thn_akademik->nama_thn_akademik;
    $detail_grup_nama = $this->admin_model->detail_grup_nama($grup_nama); 
    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama_thn_akademik','Nama','required',
                  array( 'required' => '%s tahun akademik harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      			=> 'Halaman Edit Tahun Akademik',
                    'detail_thn_akademik'   => $detail_thn_akademik, 
                    'isi'       			=> 'admin/thn_akademik/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;

      $data_grup = array(   'grup_id'      => $detail_grup_nama->grup_id,
      						'grup_nama'    => $i->post('nama_thn_akademik')
      );
      $this->admin_model->edit_grup($data_grup);

      $data = array(    'id_thn_akademik'       => $detail_thn_akademik->id_thn_akademik,
                        'nama_thn_akademik'     => $i->post('nama_thn_akademik'),
                        'status_thn_akademik'  => $i->post('status_thn_akademik'),
                        'berlaku'            	=> $i->post('berlaku')
      );
      $this->admin_model->edit_thn_akademik($data);


      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/thn_akademik'),'refresh');
    }

	}

	public function thn_akademik_utama(){
        $list_thn_akademik = $this->admin_model->list_thn_akademik();

        $data = array( 'title'          	=> 'Halaman Tahun Akademik Admin',
                       'list_thn_akademik' 	=> $list_thn_akademik,
                       'isi'           	 	=> 'admin/thn_akademik/list_utama');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

	public function aktif_thn_akademik($id_thn_akademik){

    	$detail_thn_akademik = $this->admin_model->detail_thn_akademik($id_thn_akademik); 
    	$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        
    	$data_ambil = array( 'id_thn_akademik' 		=> $ambil_detail_thn_akademik->id_thn_akademik,
        			         'utama_thn_akademik' 	=> '0');
        $this->admin_model->edit_ambil_thn_akademik($data_ambil);

        $data = array( 'id_thn_akademik' 		=> $detail_thn_akademik->id_thn_akademik,
        			   'utama_thn_akademik' 	=> '1');
        $this->admin_model->edit_thn_akademik($data);
        redirect(base_url('admin/home/thn_akademik_utama'),'refresh');

    }

    public function delete_jadwal(){
      $data = $this->input->post('id');
      $this->usm_model->delete_jadwal_usm_pilihan($data);

      $this->session->set_flashdata('success', 'Data telah dihapus');
      redirect(base_url('admin/usm/jadwal_usm'),'refresh');
  	}


  	public function jenis_agen(){
        $list_jenis_agen = $this->admin_model->list_jenis_agen();

        $data = array( 'title'          	=> 'Halaman Jenis Agen',
                       'list_jenis_agen' 	=> $list_jenis_agen,
                       'isi'            	=> 'admin/jenis_agen/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_jenis_agen(){

      $valid = $this->form_validation;

      $valid->set_rules('jenis_komisi','Nama','required|is_unique[komisi.jenis_komisi]',
					array('required'   => '%s jenis agen di databse harus diisi',
						  'is_unique'  => '%s sudah ada. Buat username baru.'));

      $valid->set_rules( '','Nama','required',
                    array( 'required' => '%s jenis agen harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Jenis Agen',
                    'isi'         => 'admin/jenis_agen/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'jumlah_komisi'           => $i->post('jumlah_komisi'),
                        'jenis_komisi'            => $i->post('jenis_komisi'),
                        'nama_komisi'             => $i->post('nama_komisi'),
                        'status_komisi'            => $i->post('status_komisi')
      );
        $this->admin_model->tambah_jenis_agen($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/jenis_agen'),'refresh');
      }

    }

    public function edit_jenis_agen($id_komisi){

    $detail_jenis_agen = $this->admin_model->detail_jenis_agen($id_komisi); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama_komisi','Nama','required',
                    array( 'required' => '%s jenis agen harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      			=> 'Halaman Edit Jenis Agen',
                    'detail_jenis_agen'     => $detail_jenis_agen, 
                    'isi'       			=> 'admin/jenis_agen/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id_komisi'               => $detail_jenis_agen->id_komisi,
                        'jumlah_komisi'           => $i->post('jumlah_komisi'),
                        'jenis_komisi'            => $i->post('jenis_komisi'),
                        'nama_komisi'             => $i->post('nama_komisi'),
                        'status_komisi'            => $i->post('status_komisi')
      );
      $this->admin_model->edit_jenis_agen($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/jenis_agen'),'refresh');
    }
  }


  public function agen(){

        $list_agen = $this->admin_model->list_agen();

        $data = array( 'title'          	=> 'Halaman Agen',
                       'list_agen' 			=> $list_agen,
                       'isi'            	=> 'admin/agen/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function filter_agen(){

        $list_agen = $this->admin_model->list_agen_filter();

        $data = array( 'title'          	=> 'Halaman Agen',
                       'list_agen' 			=> $list_agen,
                       'isi'            	=> 'admin/agen/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_agen(){

      $valid = $this->form_validation;

      $valid->set_rules('jenis_komisi','Nama','required|is_unique[komisi.jenis_komisi]',
					array('required'   => '%s jenis agen di databse harus diisi',
						  'is_unique'  => '%s sudah ada. Buat username baru.'));

      $valid->set_rules( '','Nama','required',
                    array( 'required' => '%s jenis agen harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Jenis Agen',
                    'isi'         => 'admin/jenis_agen/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'jumlah_komisi'           => $i->post('jumlah_komisi'),
                        'jenis_komisi'            => $i->post('jenis_komisi'),
                        'nama_komisi'             => $i->post('nama_komisi'),
                        'status_komisi'            => $i->post('status_komisi')
      );
        $this->admin_model->tambah_jenis_agen($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/jenis_agen'),'refresh');
      }

    }

    public function edit_agen($id){

    $detail_jenis_agen = $this->admin_model->detail_jenis_agen($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama_komisi','Nama','required',
                    array( 'required' => '%s jenis agen harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      			=> 'Halaman Edit Jenis Agen',
                    'detail_jenis_agen'     => $detail_jenis_agen, 
                    'isi'       			=> 'admin/jenis_agen/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id_komisi'               => $detail_jenis_agen->id_komisi,
                        'jumlah_komisi'           => $i->post('jumlah_komisi'),
                        'jenis_komisi'            => $i->post('jenis_komisi'),
                        'nama_komisi'             => $i->post('nama_komisi'),
                        'status_komisi'            => $i->post('status_komisi')
      );
      $this->admin_model->edit_jenis_agen($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/jenis_agen'),'refresh');
    }
  }

  public function riwayat_pencairan($kode_agen) {

    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

    $detail_agen    = $this->agen_model->detail_agen_admin($kode_agen);

    $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen_admin($id_thn_akademik,$kode_agen);
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_agen_pengajuan_admin($id_thn_akademik,$kode_agen);
    $komisi_agen            = $this->agen_model->agen_pengajuan_admin($id_thn_akademik,$kode_agen);
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_pengajuan_admin($id_thn_akademik,$kode_agen);

    $data = array('title'             => 'Daftar Riwayat Pengajuan',
                  'komisi_agen'       => $komisi_agen,
                  'detail_agen'		  => $detail_agen,
                  'jumlah_komisi_agen'=> $jumlah_komisi_agen,
                  'jumlah_agen_pengajuan'=> $jumlah_agen_pengajuan,
                  'menunggu_jumlah_pengajuan'=> $menunggu_jumlah_pengajuan,
                  'isi'               => 'admin/agen/riwayat_pencairan'); 
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  public function konfirmasi_pengajuan($id_komisi){
        $komisi_agen            = $this->admin_model->detail_agen_pengajuan($id_komisi);
		$sukses = date('Y-m-d H:i:s');

        $data = array(  'id_komisi' 	   => $komisi_agen->id_komisi,
        				'kode_agen'		   => $komisi_agen->kode_agen,
        				'tgl_sukses' 	   => $sukses,
        				'status_pengajuan' => '1');
        $this->admin_model->edit_pengajuan($data);

        $data2 = array( 'kode_agen'       => $komisi_agen->kode_agen,
        				'status_pencairan' => '1');
	        $this->admin_model->edit_konfirmasi($data2);

        redirect(base_url('admin/home/riwayat_pencairan/'.$komisi_agen->kode_agen),'refresh');
    }


    public function batalkan_pengajuan($id_komisi){
        $komisi_agen            = $this->admin_model->detail_agen_pengajuan($id_komisi);

        $data = array(  'id_komisi' 	   => $komisi_agen->id_komisi,
        				'kode_agen'		   => $komisi_agen->kode_agen,
        				'tgl_sukses' 	   => "",
        				'status_pengajuan' => '0');
        $this->admin_model->edit_pengajuan($data);

        $data2 = array( 'kode_agen'       => $komisi_agen->kode_agen,
        				'status_pencairan' => '0');
	        $this->admin_model->edit_konfirmasi($data2);

        redirect(base_url('admin/home/riwayat_pencairan/'.$komisi_agen->kode_agen),'refresh');
    }

    public function kalkulasi(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    		$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $kalkulasi = $this->admin_model->kalkulasi($id_thn_akademik);

        $data = array( 'title'          	=> 'Halaman Kalkulasi TA ' .$ambil_detail_thn_akademik->nama_thn_akademik,
                       'kalkulasi' 			  => $kalkulasi,
                       'isi'            	=> 'admin/agen/kalkulasi');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function kalkulasi_pendaftar(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    		$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $tampil_fakultas = $this->admin_model->tampil_fakultas();
        $tampil_fakultas_sudah = $this->admin_model->tampil_fakultas();
        $tampil_fakultas_terverifikasi = $this->admin_model->tampil_fakultas();
        $tampil_fakultas_diterima = $this->admin_model->tampil_fakultas();
        $tampil_fakultas_registrasi = $this->admin_model->tampil_fakultas();
        $chart_pendaftar_tahunan_umum = $this->admin_model->chart_pendaftar_tahunan_umum();
        $chart_pendaftar_tahunan_per_prodi = $this->admin_model->chart_pendaftar_tahunan_per_prodi();
	        $chart_diterima_tahunan_umum = $this->admin_model->chart_diterima_tahunan_umum();
	        $chart_diterima_tahunan_per_prodi = $this->admin_model->chart_diterima_tahunan_per_prodi();
	        $chart_pendaftar_bulanan_tahunan = $this->admin_model->chart_pendaftar_bulanan_tahunan();
	        $chart_referensi_pendaftar_tahunan = $this->admin_model->chart_referensi_pendaftar_tahunan();

	        $data = array( 'title'          	=> 'Halaman Statistik Pendaftar TA ' .$ambil_detail_thn_akademik->nama_thn_akademik,
	                       'tampil_fakultas' 	=> $tampil_fakultas,
                       'tampil_fakultas_sudah' 	=> $tampil_fakultas_sudah,
                       'tampil_fakultas_terverifikasi' 	=> $tampil_fakultas_terverifikasi,
                       'tampil_fakultas_diterima' 	=> $tampil_fakultas_diterima,
                       'tampil_fakultas_registrasi' 	=> $tampil_fakultas_registrasi,
                       'tahun_akademik_aktif'    => $ambil_detail_thn_akademik,
                       'chart_pendaftar_tahunan_umum' => $chart_pendaftar_tahunan_umum,
                       'chart_pendaftar_tahunan_per_prodi' => $chart_pendaftar_tahunan_per_prodi,
	                       'chart_diterima_tahunan_umum' => $chart_diterima_tahunan_umum,
	                       'chart_diterima_tahunan_per_prodi' => $chart_diterima_tahunan_per_prodi,
	                       'chart_pendaftar_bulanan_tahunan' => $chart_pendaftar_bulanan_tahunan,
	                       'chart_referensi_pendaftar_tahunan' => $chart_referensi_pendaftar_tahunan,
	                       'isi'            			 => 'admin/agen/kalkulasi_pendaftar');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function unduh_panduan_cbt_admin(){

      $folder = './manual/';
      $file   = 'Manual_CBT_Administrator.docx';
      force_download($folder.$file, NULL);
  	
  	}

  	public function unduh_panduan_cbt(){

      $folder = './manual/';
      $file   = 'Manual_CBT_PesertaTes.docx';
      force_download($folder.$file, NULL);
  	
  	}

  	public function edit_data_agen($id){

    $detail_agen = $this->admin_model->detail_agen($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama','required',
                    array( 'required' => '%s agen harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'      			=> 'Halaman Detail Data Agen',
                    'detail_agen'     		=> $detail_agen, 
                    'isi'       			=> 'admin/agen/edit_data');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(  'id'                  => $detail_agen->id,
                      'nik'                 => $i->post('nik'),
                      'nama'                => $i->post('nama'),
                      'alamat'              => $i->post('alamat'),
                      'hp'                  => $i->post('hp'),
                      'email'               => $i->post('email'),
                      'kabupaten'           => $i->post('kabupaten')
                      );
      $this->agen_model->edit_agen($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/jenis_agen'),'refresh');
    }
  }

  public function aktifkan_agen($id){

    	$detail_agen 			= $this->admin_model->detail_agen($id); 
        $data = array( 'id' 		=> $detail_agen->id,
        			   'status_agen' 	=> '1');
        $this->admin_model->edit_agen($data);
        redirect(base_url('admin/home/agen'),'refresh');

    }

    public function nonaktifkan_agen($id){

    	$detail_agen 			= $this->admin_model->detail_agen($id); 
        $data = array( 'id' 		=> $detail_agen->id,
        			   'status_agen' 	=> '0');
        $this->admin_model->edit_agen($data);
        redirect(base_url('admin/home/agen'),'refresh');

    }


    //diterima
    public function registrasi_ulang(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        if ($this->session->userdata('id_level')=='1') {
          $diterima 			  = $this->admin_model->registrasi_ulang($id_thn_akademik);
          $list_prodi 		  	  = $this->admin_model->list_prodi();
          $pilih_gelombang 		  = $this->admin_model->pilih_gelombang($id_thn_akademik);

        }elseif($this->session->userdata('id_level')=='2'){
          $diterima   	 	 	 = $this->admin_model->registrasi_ulang($id_thn_akademik);
          $list_prodi 		  	 = $this->admin_model->list_prodi();
          $pilih_gelombang   	 = $this->admin_model->pilih_gelombang($id_thn_akademik);
        }

        $data = array( 'title'          => 'Registrasi Ulang',          
                       'diterima'     	=> $diterima,
                       // 'detail_tahun'   => $detail_tahun,
                       'list_prodi'		=> $list_prodi,
                       'pilih_gelombang'=> $pilih_gelombang,
                       'isi'            => 'admin/regis/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function registrasi_ulang_filter(){

        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $diterima 			= $this->admin_model->registrasi_ulang_filter($id_thn_akademik);

        if ($this->session->userdata('id_level')=='1') {
          $pilih_gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
          $list_prodi 		 = $this->admin_model->list_prodi();

        }elseif($this->session->userdata('id_level')=='2'){
          $pilih_gelombang   = $this->admin_model->pilih_gelombang_fakultas($id_thn_akademik);
          $list_prodi 		 = $this->admin_model->list_prodi();
        }

        $data = array( 'title'          			=> 'Registrasi Ulang',
                       'diterima'     				=> $diterima,
                       // 'detail_tahun'				=> $detail_tahun,
                       'list_prodi'					=> $list_prodi,
                       'pilih_gelombang'   			=> $pilih_gelombang,
                       'isi'           	 			=> 'admin/regis/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function balik_regis($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $data = array( 'id' 				=> $detail_pendaftaran->id,
        			   	'verifikasi_regis' 	=> '0');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/diterima'),'refresh');

    }

    public function sudah_regis($id){

    	$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
        $data = array( 'id' 							=> $detail_pendaftaran->id,
        			   			'registrasi_ulang' 	=> '1',
        			   			'verifikasi_regis' 	=> '1');
        $this->admin_model->edit_pendaftaran($data);
        redirect(base_url('admin/home/diterima'),'refresh');

    }

    public function registrasi_ulang_user(){

		$detail 	= $this->admin_model->detail_pendaftaran_mahasiswa();
		if(!$detail || $detail->bayar != '1' || $detail->approve != '1'){
			$this->session->set_flashdata('warning', 'Silakan selesaikan dan tunggu verifikasi Registrasi Pendaftaran terlebih dahulu sebelum melakukan Registrasi Ulang.');
			redirect(base_url('admin/home/konfirmasi_bayar'),'refresh');
		}

		$kode 		= $detail->jurusan_pilihan;
		$prodi  = $this->admin_model->detail_prodi_kode($kode);
		$valid = $this->form_validation;

		$valid->set_rules('bank','Nama Bank / Metode pembayaran ','required',
	                  array( 'required' => '%s harus diisi'));

		if($valid->run()){
			//jika foto tidak kosong
			if(! empty($_FILES['bukti_regis']['name'])){
			$config['upload_path']   	= './assets/upload/bukti/';
			$config['allowed_types'] 	= 'jpg|png|jpeg';
			$config['max_size']      	= 212; // KB
			$config['encrypt_name']   	= TRUE;

			$this->load->library('upload', $config);
		
			if(! $this->upload->do_upload('bukti_regis')) {
			
			//end validasi

			$data = array( 'title'   			=> 'Halaman Registrasi Ulang ',
						   'detail'				=> $detail,
						   'prodi'	  => $prodi,
						   'isi'     			=> 'admin/mahasiswa/registrasi_ulang');
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect(base_url('admin/home/registrasi_ulang_user'),'refresh');

			}else{
				$upload_foto = array('upload_data' => $this->upload->data());

				//create thumbnail
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './assets/upload/bukti/'.$upload_foto['upload_data']['file_name'];
				//lokasi thumbs
				$config['new_image']		= './assets/upload/bukti/thumbs/'.$upload_foto['upload_data']['file_name'];
				$config['create_thumb']		= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 800; //pixel
				$config['height']       	= 800;
				$config['thumb_marker']     = '';

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				//end create thumbnail

				if($detail->bukti_regis != ""){
					unlink('./assets/upload/bukti/'.$detail->bukti_regis);
					unlink('./assets/upload/bukti/thumbs/'.$detail->bukti_regis);
				}
				
				//slug
				$data = array(  'id' 				=> $detail->id,			
								'registrasi_ulang' => "1",
								'atas_regis'			=> $this->input->post('atas_nama'),
								'bank_regis'				=> $this->input->post('bank'),
								'tgl_regis'			=> $this->input->post('tgl_bayar'),
								'bukti_regis' 	=> $upload_foto['upload_data']['file_name']
			);
				$this->admin_model->edit_pendaftaran($data);
				$this->session->set_flashdata('success', 'Bukti registrasi ulang berhasil di upload');
				redirect(base_url('admin/home/registrasi_ulang_user'),'refresh');
			}}else{
				//tanpa foto
				$data = array(  'id' 				=> $detail->id,		
								'registrasi_ulang' => "1",
								'atas_regis'			=> $this->input->post('atas_nama'),
								'bank_regis'				=> $this->input->post('bank'),
								'tgl_regis'			=> $this->input->post('tgl_bayar')
			);
				$this->admin_model->edit_pendaftaran($data);
				$this->session->set_flashdata('success', 'Data telah di edit');
				redirect(base_url('admin/home/registrasi_ulang_user'),'refresh');
			}}
				$data = array( 	'title'   			=> 'Halaman Registrasi Ulang',
						   		'detail'			=> $detail,
						   		'prodi'	  => $prodi,
						   		'isi'     			=> 'admin/mahasiswa/registrasi_ulang');
				$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	public function ganti_password(){

  		$detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();

	    $valid = $this->form_validation;

	    $valid->set_rules('password_baru','Password','required',
	                  array( 'required' => '%s harus diisi'));

	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'            => 'Ganti Password',          
                       'detail'     	  => $detail_pendaftaran,
                       'isi'              => 'admin/mahasiswa/ganti_password');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;

	      $data = array(    'id'                => $detail_pendaftaran->id,
	                        'password'			=> $i->post('password_baru')
	      );
	      $this->admin_model->edit_pendaftaran($data);

	      	$username 			= $detail_pendaftaran->username;
  			$pengguna 			= $this->admin_model->detail_pengguna_verifikasi($username);
			$data_username = array( 'id'                => $pengguna->id,
			                        'password'          => md5($i->post('password_baru')),
	      );
	      $this->admin_model->edit_pengguna_verifikasi($data_username);

	      if($detail_pendaftaran->approve == 1) {
	      $data_user = array( 'user_name'          => $detail_pendaftaran->username,
			                  'user_password'     => $i->post('password_baru'),
	      );
	      $this->admin_model->edit_user_tes($data_user);
	  	  }

	      $this->session->set_flashdata('success', 'Password berhasil diganti');
	      redirect(base_url('admin/home/ganti_password'),'refresh');
	    }
	}


	public function keuangan(){

		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();
        $keuangan  	= $this->admin_model->keuangan($id_thn_akademik); 

        $data = array('title' 						=> 'Halaman Laporan Keuangan',
        			  			'detail'						=> $detail_pendaftaran,
        			  			'keuangan'					=> $keuangan,
                      'isi'   						=> 'admin/keuangan/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    //Menu custom berkas
  public function custom_berkas(){
        $list_berkas = $this->admin_model->list_berkas();

        $data = array( 'title'          => 'Halaman Berkas',
                       'list_berkas'     => $list_berkas,
                       'isi'            => 'admin/berkas/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_custom_berkas(){

      $valid 		  = $this->form_validation;

      $valid->set_rules( 'nama_berkas','Nama','required',
                  array( 'required'   => '%s berkas harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'           => 'Halaman Tambah Berkas',
                     'isi'             => 'admin/berkas/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'nama_berkas'  => $i->post('nama_berkas'),
                        'besar_berkas' => $i->post('besar_berkas'),
                        'type_file'    => $i->post('type_file'),
                        'status'       => $i->post('status'),
                        'program'      => $i->post('program'),
                        'urutan'       => $i->post('urutan')
      );
        $this->admin_model->tambah_berkas($data);
        $this->session->set_flashdata('success', 'Data telah ditambahkan');
        redirect(base_url('admin/home/custom_berkas'),'refresh');
      }

    }

    public function edit_custom_berkas($id_berkas){

    $detail_berkas = $this->admin_model->detail_berkas_master($id_berkas); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama_berkas','Nama','required',
                array( 'required'   => '%s berkas harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'                    => 'Halaman Edit Berkas',
                    'detail_berkas'            => $detail_berkas, 
                    'isi'                     => 'admin/berkas/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id_berkas'            => $detail_berkas->id_berkas,
                        'nama_berkas'          => $i->post('nama_berkas'),
                        'besar_berkas'         => $i->post('besar_berkas'),
                        'type_file'            => $i->post('type_file'),
                        'status'       		   => $i->post('status'),
                        'program'      => $i->post('program'),
                        'urutan'       => $i->post('urutan')
      );
      $this->admin_model->edit_berkas($data);
      $this->session->set_flashdata('success', 'Data telah diedit');
      redirect(base_url('admin/home/custom_berkas'),'refresh');
    }
  }

  public function statistik_bar()
	{ 

		$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
		$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

		$data = array('title'             => 'Halaman Statistik Bar Chart Pendaftar TA ' .$ambil_detail_thn_akademik->nama_thn_akademik,
                       'isi'              => 'admin/dasbor/list');
        $this->load->view('admin/dasbor/list', $data, FALSE);
	}


	public function unduh_custom(){

      $folder = './assets/';
      $file   = 'PmbCbtCustom.docx';
      force_download($folder.$file, NULL);
  	
  	}


}
