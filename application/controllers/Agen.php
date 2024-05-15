<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('agen_model');
    $this->load->model('admin_model');
    // $this->simple_login_agen->cek_login();     
    }     



	//HALAMAN LOGIN agen
	public function index()
	{ 
		$detail_konfigurasi = $this->admin_model->detail_institusi();
		$this->form_validation->set_rules('username','Username','required',
								array('requiered' => '%s harus diisi'));

		$this->form_validation->set_rules('password','Password','required',
								array('requiered' => '%s harus diisi'));

		if ($this->form_validation->run()) {
			$username 			= $this->input->post('username');
			$password 			= $this->input->post('password');
			//proses ke simpel login
			$this->simple_login_agen->login($username,$password);
		}

		$data = array('title'             => 'Halaman Login',
                  'detail_konfigurasi' => $detail_konfigurasi,
                  'isi'              => 'agen/list');
        $this->load->view('layout_agen/wrapper', $data, FALSE);
	}

	public function logout(){
		//ambil dari simple login
		$this->simple_login_agen->logout();
	}

    public function register()
  {
        $pass = random_string('numeric', 4);
        $popup = random_string('alnum', 16);
        $detail_konfigurasi = $this->admin_model->detail_institusi();
        $agen_register = $this->admin_model->detail_agen_register();

        $valid = $this->form_validation;

        $valid->set_rules('nama','Nama','required',
                    array('required'    => '%s Harus Diisi'));

        $valid->set_rules('email','Email','required|is_unique[agen.email]',
                    array('required'    => '%s Harus Diisi',
                          'is_unique'   => '%s <strong>'.$this->input->post('email').'</strong> sudah ada. silahkan daftarkan email yang baru'));

        $valid->set_rules('username','Pengguna / Username','required|is_unique[agen.username]',
                    array('required'   => '%s harus diisi',
                          'is_unique'  => '%s <strong>'.$this->input->post('username').'</strong> sudah ada. Silahkan buat username baru.'));

        $valid->set_rules('password','Kata Sandi','required',
                 array( 'required'   => '%s harus diisi'));

        $valid->set_rules('hp','Nomor WA','required|is_unique[agen.hp]',
                 array( 'required'   => '%s harus diisi',
                        'is_unique'  => '%s <strong>'.$this->input->post('hp').'</strong> sudah ada. silahkan daftarkan nomor yang lain'));
           

        if($valid->run()){

          $i=$this->input;
          $hari = date('Y-m-d');
          $tahun = date('y');


          $data = array(  'popup'               => $popup,
                          'kode_agen'           => $agen_register->kode_agen+1,
                          'nik'                 => $i->post('nik'),
                          'nama'                => $i->post('nama'),
                          'hp'                  => $i->post('hp'),
                          'email'               => $i->post('email'),
                          'username'            => $i->post('username'),
                          'password'            => md5($i->post('password')),
                          'passwordasli'        => $i->post('password'),
                          'tanggal_input'       => $hari,
                          'jenis_agen'          => $i->post('jenis_agen'),
                          'status_agen'         => "1"

                      );


        $this->agen_model->tambah_agen($data);
        $this->session->set_flashdata('success', 'Selamat Anda telah berhasil mendaftar. <br> Silahkan login menggunakanan username dan password yang tersedia pada popup berikut, lengkapi data dalam 2x24 jam agar kami bisa memverifikasi akun anda.');
        redirect(base_url('agen/popup/'.$popup),'refresh');
        }else {
          $data = array('title'                 => 'Register Agen',
                        'detail_konfigurasi'    => $detail_konfigurasi,
                        'isi'                   => 'agen/register');
          $this->load->view('layout_agen/wrapper', $data, FALSE);
        }

  }

  public function popup($popup)
  {

      $detail_agen    = $this->agen_model->detail_agen_popup($popup);

      $data = array('title'                 => 'Register Agen',
                    'detail_agen'           => $detail_agen,
                    'isi'                   => 'agen/popup');
      $this->load->view('layout_agen/wrapper', $data, FALSE);
    

  }

  public function register_koordinator()
  {
    $list_kategori      = $this->berita_model->list_kategori();
    $pass = random_string('alnum', 8);
     $detail_konfigurasi = $this->admin_model->detail_konfigurasi();
    $select_agama     = $this->agen_model->select_agama();
    $select_pekerjaan = $this->agen_model->select_pekerjaan();
    
    $data = array('title'             => 'Register Agen',
            'select_agama'    => $select_agama,
            'list_kategori'      => $list_kategori,
            'detail_konfigurasi' => $detail_konfigurasi,
            'select_pekerjaan'  => $select_pekerjaan,
            'provinsi'      => $this->agen_model->get_provinsi(),
                  'kota'        => $this->agen_model->get_kota(),
                  'kecamatan'       => $this->agen_model->get_kecamatan(),
                  'provinsi_selected' => '',
                'kota_selected'     => '',
                'kecamatan_selected'=> '',
            'pass'        => $pass,
                       'isi'              => 'agen/register_koordinator');
        $this->load->view('layout2/wrapper', $data, FALSE);
  }

  public function tambah_koordinator()
  {

    $detail_konfigurasi = $this->admin_model->detail_konfigurasi();
    $list_kategori      = $this->berita_model->list_kategori();
    // realnya ambil data dari database, misalnya kita dapatkan data sbb:
        $id_kecamatan = $this->input->post('kecamatan');
        // kita ambil data selected nya untuk selected option
        $selected = $this->agen_model->get_selected_by_id_kecamatan($id_kecamatan);

    $pass = strtoupper(random_string('alnum', 7));
    $select_agama     = $this->agen_model->select_agama();
    $select_pekerjaan = $this->agen_model->select_pekerjaan();

    //validasi input
        $valid = $this->form_validation;

        $valid->set_rules(  'nama','Nama','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'nik','NIK','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'tempat_lahir','Tempat Lahir','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'tanggal_lahir','Tanggal Lahir','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'alamat','Alamat','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'hp','Nomer Handphone','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'email','Email','required|is_unique[agen.email]',
                    array(  'required'    => '%s Harus Diisi',
                            'is_unique'   => '%s <strong>'.$this->input->post('email').'</strong> sudah terdaftar server kami'));

        $valid->set_rules(  'password','Password','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'pekerjaan','Pekerjaan','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'username','Username','required|is_unique[agen.username]',
                    array(  'required'    => '%s Harus Diisi',
                            'is_unique'   => '%s <strong>'.$this->input->post('username').'</strong> sudah terdaftar server kami'));

        $valid->set_rules(  'kode_agen','Kode Agen','required|is_unique[agen.kode_agen]',
                    array(  'required'    => '%s Harus Diisi',
                            'is_unique'   => '%s <strong>'.$this->input->post('kode_agen').'</strong> sudah terdaftar server kami, Coba refresh kemudian klik simpan'));
           
        $config['upload_path']    = './assets/upload/image/agen';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = TRUE;
        $config['max_size']       = 4096; // KB

        $this->load->library('upload', $config);
        
        

        if (!empty($_FILES['foto_ktp']['name'])) {
          $this->upload->do_upload('foto_ktp');
          $data2= $this->upload->data();
          $foto_ktp = array('upload_data' => $this->upload->data());

          //create image
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/agen/'.$foto_ktp['upload_data']['file_name'];
          //lokasi thumbs
          $config['new_image']      = './assets/upload/image/agen/kecil/'.$foto_ktp['upload_data']['file_name'];
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 300; //pixel
          $config['height']         = 300;
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          //end create thumbnail
        }

        if (!empty($_FILES['foto_kk']['name'])) {
          $this->upload->do_upload('foto_kk');
          $data3= $this->upload->data();
          $foto_kk=$data3['file_name'];
        }

        if($valid->run()){

          $i=$this->input;
          $hari = date('Y-m-d');
        
          $data = array(  'koordinator'         => '1',
                          'kode_agen'           => $i->post('kode_agen'),
                          'nik'                 => $i->post('nik'),
                          'nama'                => $i->post('nama'),
                          'tanggal_lahir'       => $i->post('tanggal_lahir'),
                          'tempat_lahir'        => $i->post('tempat_lahir'),
                          'alamat'              => $i->post('alamat'),
                          'hp'                  => $i->post('hp'),
                          'email'               => $i->post('email'),
                          'username'            => $i->post('username'),
                          'password'            => md5($i->post('password')),
                          'passwordasli'        => $i->post('password'),
                          'pekerjaan'           => $i->post('pekerjaan'),
                          'tempat_kerja'        => $i->post('tempat_kerja'),
                          'foto_ktp'            => $foto_ktp['upload_data']['file_name'],
                          'provinsi'            => $i->post('provinsi'),
                          'kabupaten'           => $i->post('kota'),
                          'kecamatan'           => $i->post('kecamatan'),
                          'kode_pos'            => $i->post('kode_pos'),
                          'verifikasi'          => '1',
                          'tanggal_input'       => $hari
                      );
        $this->agen_model->tambah_agen($data);

        $data2 = array(  'kode_agen'           => $i->post('kode_agen')
                      );
        $this->agen_model->tambah_koordinator($data2);

        $this->session->set_flashdata('success', 'Selamat Anda telah tedaftar menjadi Koordinator Agen silahkan login dengan username dan password yang telah anda daftarkan, lengkapi data dalam 2x24 jam agar anda bisa mendaftarkan calon mahasiswa baru.');
        redirect(base_url('agen'),'refresh');
        }else {
          $data = array('title'         => 'Register Agen',
            'select_agama'              => $select_agama,
            'select_pekerjaan'          => $select_pekerjaan,
            'pass'                      => $pass,
            'provinsi'                  => $this->agen_model->get_provinsi(),
                'kota'                  => $this->agen_model->get_kota(),
                'kecamatan'             => $this->agen_model->get_kecamatan(),
                'provinsi_selected'     => $this->input->post('provinsi'),
                'kota_selected'         => $this->input->post('kota'),
                'kecamatan_selected'    => $this->input->post('kecamatan'),
                'detail_konfigurasi'    => $detail_konfigurasi,
                'list_kategori'         => $list_kategori,
                      'isi'             => 'agen/register_koordinator');
          $this->load->view('layout2/wrapper', $data, FALSE);
        }

  }



  public function register_maba()
  {
        $list_jenis         = $this->admin_model->list_jenis();
        $sumber         = $this->admin_model->list_sumber_aktif();
        $popup              = random_string('alnum', 20);
        $detail_agen   = $this->agen_model->detail_agen();
        $get_thn_akademik   = $this->admin_model->get_thn_akademik();

        $fakultas           = $this->admin_model->get_fakultas_aktif();

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('username','Nama Pengguna','required|is_unique[pendaftaran.username]',
                    array('required'   => '%s harus diisi',
                          'is_unique'  => '%s sudah ada. Buat Nama pengguna baru.'));
        
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
                       'isi'              => 'agen/register_maba');
        $this->load->view('layout2/wrapper', $data, FALSE);
        
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

          $jenis_komisi = $detail_agen->jenis_agen;
          $detail_agen_jenis = $this->admin_model->detail_agen_jenis($jenis_komisi);

          $data = array(    'tahun_akademik'    => $get_thn_akademik->id_thn_akademik,
                            'username'          => $i->post('username'),
                            'nisn'              => $i->post('nisn'),
                            'kode_agen'         => $detail_agen->kode_agen,
                            'fakultas'          => $i->post('fakultas'),
                            'popup'             => $popup,
                            'bayar'             => "1",
                            'gelombang'         => $i->post('gelombang'),
                            'gelombang_2'         => $i->post('gelombang_2'),
                            'jenis'             => $i->post('jenis'),
                            'program'           => $i->post('program'),
                            'jenjang'           => $jenjang,
                            'jurusan_pilihan'   => $i->post('prodi'),
                            'jurusan_pilihan2'  => $i->post('prodi2'),
                            'email'             => $i->post('email'),
                            'password'          => $i->post('password'),
                            'nama_lengkap'      => $i->post('nama_lengkap'),
                            'hp'                => $i->post('hp'),
                            'sekolah_nama'      => $i->post('sekolah_nama'),
                            'sekolah_jurusan'   => $i->post('sekolah_jurusan'),
                            'tanggal_daftar'    => $date,
                            'sumber'            => $detail_agen_jenis->nama_komisi. " : " .$detail_agen->nama
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

          $user = array(    'nama'              => $i->post('nama_lengkap'),
                            'username'          => $i->post('username'),
                            'password'          => md5($i->post('password')),
                            'email'             => $i->post('email'),
                            'id_level'          => '3',
                            'status'            => '1',
                            'thn_akademik'    => $get_thn_akademik->id_thn_akademik
          );
          $this->admin_model->tambah_pengguna_admin($user);

          $this->session->set_flashdata('success', 'Pendaftaran mahasiswa baru telah berhasil, silahkan lengkapi data berikut');
          redirect(base_url('agen/form_selanjutnya/'.$popup),'refresh');

          }else{
            $this->session->set_flashdata('warning', 'Pendaftaran mahasiswa baru tidak bisa dilakukan karena kalender tahun akademik belum dibuka');
            redirect(base_url('agen/register_maba'),'refresh');
        }}

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'list_jenis'       => $list_jenis,
                       'fakultas'         => $fakultas,
                       'fakultas2'         => $fakultas,
                       'sumber'           => $sumber,
                       'isi'              => 'agen/register_maba');
        $this->load->view('layout2/wrapper', $data, FALSE);
  }


  public function form_selanjutnya($popup){

        
        $detail_pendaftaran = $this->admin_model->popup_detail_pendaftaran($popup);
        $list_penghasilan   = $this->admin_model->list_penghasilan();
        $list_penghasilan1  = $this->admin_model->list_penghasilan();
        $list_penghasilan2  = $this->admin_model->list_penghasilan();
        $username       = $detail_pendaftaran->username;
        $user         = $this->admin_model->detail_pengguna_verifikasi($username);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_lengkap','Nama','required',
                    array('required'   => '%s harus diisi'));
        
        if($valid->run()===FALSE){

        $data = array( 'title'              => 'Formulir Pendaftaran', 
                       'detail'             => $detail_pendaftaran,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'list_penghasilan2'=> $list_penghasilan2,
                       'isi'                => 'agen/form_lanjutan');
        $this->load->view('layout2/wrapper', $data, FALSE);
        
        }else{

        $i=$this->input;
        $date             = date('Y-m-d H:i:s');
        $ortu_nama    = implode(",", $this->input->post('ortu_nama'));
        $ortu_tempat_lahir    = implode("|", $this->input->post('ortu_tempat_lahir'));
        $ortu_tgl_lahir     = implode("|", $this->input->post('ortu_tgl_lahir'));
        $ortu_agama     = implode(",", $this->input->post('ortu_agama'));
        $ortu_pendidikan  = implode(",", $this->input->post('ortu_pendidikan'));
        $ortu_hp      = implode(",", $this->input->post('ortu_hp'));
        $ortu_pekerjaan   = implode(",", $this->input->post('ortu_pekerjaan'));
        $ortu_penghasilan = implode(",", $this->input->post('ortu_penghasilan'));
        $ortu_alamat = implode("|", $this->input->post('ortu_alamat'));

        $data = array(    'id'                => $detail_pendaftaran->id,
                          'nisn'              => $i->post('nisn'),
                          'ipk'               => $i->post('ipk'),
                          'email'             => $i->post('email'),
                          'nama_lengkap'      => $i->post('nama_lengkap'),
                          'tempat_lahir'      => $i->post('tempat_lahir'),
                          'tanggal_lahir'     => $i->post('tanggal_lahir'),
                          'jk'                => $i->post('jk'),
                          'agama'             => $i->post('agama'),
                          'kewarganegaraan'   => $i->post('kewarganegaraan'),
                          'status_sipil'      => $i->post('status_sipil'),
                          'alamat'            => $i->post('alamat'),
                          'hp'                => $i->post('hp'),
                          'sekolah_nama'      => $i->post('sekolah_nama'),
                          'sekolah_jurusan'   => $i->post('sekolah_jurusan'),
                          'sekolah_nama_jurusan'=> $i->post('sekolah_nama_jurusan'),
                          'tahun_lulus'       => $i->post('tahun_lulus')  ,
                          'no_ijazah'         => $i->post('no_ijazah'),
                          'nilai_ijazah'      => $i->post('nilai_ijazah'),
                          'pindahan_namapt'   => $i->post('pindahan_namapt'),
                          'pindahan_fakultas' => $i->post('pindahan_fakultas'),
                          'pindahan_prodi'    => $i->post('pindahan_prodi'),
                          'pindahan_nim'      => $i->post('pindahan_nim') ,
                          'pindahan_jumlahsks'=> $i->post('pindahan_jumlahsks'),
                          'nilai_ijazah'      => $i->post('nilai_ijazah'),
                          'nik'               => $i->post('nik'),
                          'ortu_nama'       => $ortu_nama,
                          'ortu_tempat_lahir' => $ortu_tempat_lahir,
                          'ortu_tgl_lahir'    => $ortu_tgl_lahir,
                          'ortu_agama'    => $ortu_agama,
                          'ortu_pendidikan' => $ortu_pendidikan,
                          'ortu_hp'     => $ortu_hp,
                          'ortu_pekerjaan'  => $ortu_pekerjaan,
                          'ortu_penghasilan'  => $ortu_penghasilan,
                          'ortu_alamat'       => $ortu_alamat
          );

          $this->admin_model->edit_pendaftaran($data);

          $data_username = array( 'id'          => $user->id,
                                  'nama'        => $i->post('nama_lengkap'),
                                  'email'       => $i->post('email'),
                                  'hp'          => $i->post('hp')
          );
          $this->admin_model->edit_pengguna_verifikasi($data_username);

          $this->session->set_flashdata('success', 'Data telah diperbaharui');
          redirect(base_url('agen/form_selanjutnya/'.$popup),'refresh');
        }

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'detail'           => $detail_pendaftaran,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'list_penghasilan2'=> $list_penghasilan2,
                       'isi'              => 'agen/form_lanjutan');
        $this->load->view('layout2/wrapper', $data, FALSE);
  }

  public function cetak($popup){

    $this->simple_login_agen->cek_login();
    $popup = $this->maba_model->ambil_maba($popup);

    $id_institusi = $popup->id_institusi;
    $institusi = $this->maba_model->ambil_institusi($id_institusi);
    
    $id_gelombang = $popup->gelombang;
    $gelombang = $this->maba_model->ambil_gelombang($id_gelombang);

    $data = array( 'popup'            => $popup,
                   'gelombang'        => $gelombang,
                   'institusi'        => $institusi,
                   );
    $this->load->view('home/cetak_popup', $data, FALSE);
  }

  public function pernah_daftar()
  {
    $this->simple_login_agen->cek_login();
    $nisn = $this->maba_model->cek_data_maba();
    $detail_agen    = $this->agen_model->detail_agen();
    $i=$this->input;
    
    $data = array('title'             => 'Pendaftaran Mahasiswa Baru',
                  'detail_agen'       => $detail_agen,
                  'institusi'       => $this->maba_model->get_institusi(),
                  'jurusan'       => $this->maba_model->get_jurusan(),
                  'jurusan2'      => $this->maba_model->get_jurusan(),
                  'program'       => $this->maba_model->get_program(),
                  'jenis_daftar'    => $this->maba_model->jenis_daftar(),
                  'gelombang'       => $this->maba_model->get_gelombang(),
                  'program_selected'  => '',
                  'institusi_selected'=> '',
                'jurusan_selected'  => '',
                'jurusan2_selected' => '',
                'gelombang_selected'=> '',
            'nisn'        => $nisn,
            'submit'        => $i->post('nisn'),
                      'isi'              => 'agen/pernah_daftar');
        $this->load->view('agen/layout_agen/wrapper', $data, FALSE);
  }

  public function tambah_pernah_daftar()
  {
    $this->simple_login_agen->cek_login();
    $nisn = $this->maba_model->cek_data_maba();
    $detail_agen    = $this->agen_model->detail_agen();
    
    $id_institusi = $this->input->post('id_institusi');
    // realnya ambil data dari database, misalnya kita dapatkan data sbb:
        $id_gelombang = $this->input->post('gelombang');
        // kita ambil data selected nya untuk selected option
        $selected = $this->maba_model->get_selected_by_id_gelombang($id_gelombang);

        $popup = random_string('alnum', 32 );


    //validasi input
        $valid = $this->form_validation;
        
        $valid->set_rules(  'nisn','NISN','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'institusi','Perguruan Tinggi','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'gelombang','Gelombang','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'jenis_daftar','Jenis pendaftaran','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'email','Email','required|is_unique[maba_pendaftaran.email]',
                    array(  'required'    => '%s Harus Diisi',
                            'is_unique'   => '%s <strong>'.$this->input->post('email').'</strong> sudah terdaftar server kami'));

        $valid->set_rules(  'pilihan1','Pilihan pertama','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'password','Password','required',
                    array(  'required'    => '%s Harus Diisi'));

        $valid->set_rules(  'program','Program','required',
                    array(  'required'    => '%s Harus Diisi'));


        if($valid->run()){

          $i=$this->input;
          $hari = date('Y-m-d');
          
          $data = array(  'nisn'              => $i->post('nisn'),
                          'kode_agen'              => $detail_agen->kode_agen,
                          'id_institusi'        => $i->post('institusi'),
                          'verifikasi'        => '1',
                          'gelombang'             => $i->post('gelombang'),
                          'jenis_daftar'        => $i->post('jenis_daftar'),
                          'program'         => $i->post('program'),
                          'pilihan1'          => $i->post('pilihan1'),
                          'pilihan2'          => $i->post('pilihan2'),
                          'nama_lengkap'      => $i->post('nama_lengkap'),
                          'email'             => $i->post('email'),
                          'password'            => md5($i->post('password')),
                          'passwordasli'          => $i->post('password'),
                          'hp'              => $i->post('hp'),
                          'tempat_lahir'      => $i->post('tempat_lahir'),
                          'tanggal_lahir'       => $i->post('tanggal_lahir'),

                          'jk'            => $i->post('jk'),
                          'agama'           => $i->post('agama'),
                          'status_sipil'      => $i->post('status_sipil'),
                          'alamat'          => $i->post('alamat'),
                          'provinsi'        => $i->post('provinsi'),
                          'kabupaten'         => $i->post('kabupaten'),
                          'kecamatan'         => $i->post('kecamatan'),
                          'kodepos'         => $i->post('kodepos'),
                          'ortu_nama'         => $i->post('ortu_nama'),
                          'ortu_umur'         => $i->post('ortu_umur'),
                          'ortu_agama'        => $i->post('ortu_agama'),
                          'ortu_ktp'        => $i->post('ortu_ktp'),
                          'ortu_pendidikan'     => $i->post('ortu_pendidikan'),
                          'ortu_hp'         => $i->post('ortu_hp'),
                          'ortu_instansi'       => $i->post('ortu_instansi'),
                          'ortu_pekerjaan'      => $i->post('ortu_pekerjaan'),
                          'ortu_penghasilan'    => $i->post('ortu_penghasilan'),
                          'ortu_alamat'       => $i->post('ortu_alamat'),
                          'ortu_alamat_instansi'  => $i->post('ortu_alamat_instansi'),
                          'ortu_ibu'        => $i->post('ortu_ibu'),
                          'ortu_ibu_umur'       => $i->post('ortu_ibu_umur'),
                          'ortu_ibu_agama'      => $i->post('ortu_ibu_agama'),
                          'ortu_ibu_ktp'      => $i->post('ortu_ibu_ktp'),
                          'ortu_ibu_pendidikan'   => $i->post('ortu_ibu_pendidikan'),
                          'ortu_ibu_pekerjaan'    => $i->post('ortu_ibu_pekerjaan'),
                          'ortu_ibu_penghasilan'  => $i->post('ortu_ibu_penghasilan'),
                          'ortu_ibu_hp'       => $i->post('ortu_ibu_hp'),

                          'sekolah_nama'      => $i->post('sekolah_nama'),
                          'sekolah_jurusan'     => $i->post('sekolah_jurusan'),
                          'sekolah_nama_jurusan'  => $i->post('sekolah_nama_jurusan'),
                          'sekolah_alamat'  => $i->post('sekolah_alamat'),
                          'tahun_lulus'       => $i->post('tahun_lulus'),
                          'no_ijazah'         => $i->post('no_ijazah'),
                          'nilai_ijazah'      => $i->post('nilai_ijazah'),

                          'pindahan_status'     => $i->post('pindahan_status'),
                          'pindahan_namapt'     => $i->post('pindahan_namapt'),
                          'pindahan_fakultas'     => $i->post('pindahan_fakultas'),
                          'pindahan_prodi'      => $i->post('pindahan_prodi'),
                          'pindahan_nim'      => $i->post('pindahan_nim'),
                          'pindahan_jumlahsks'    => $i->post('pindahan_jumlahsks'),
                          'tinggi'          => $i->post('tinggi'),
                          'berat'           => $i->post('berat'),
                          'ktp'           => $i->post('ktp'),
                          'tgl_dibuat'          => $hari,
                          'popup'               => $popup 

                      );
        $this->maba_model->tambah_maba($data);
        // $this->session->set_flashdata('success', 'Selamat, Anda telah berhasil mendaftarkan mahasiswa baru silahkan lakukan konfirmasi pembayaran dan lengkapi data mahasiswa');
        // redirect(base_url('agen/profil'),'refresh');
        redirect(base_url('agen/popup/'.$popup),'refresh');
        }else {
          $i=$this->input;
          $data = array('title'             => 'Pendaftaran Mahasiswa Baru',
                        'detail_agen'       => $detail_agen,
              'institusi'       => $this->maba_model->get_institusi(),
                    'jurusan'       => $this->maba_model->get_jurusan(),
                    'jurusan2'      => $this->maba_model->get_jurusan(),
                    'program'       => $this->maba_model->get_program(),
                    'jenis_daftar'    => $this->maba_model->jenis_daftar(),
                    'gelombang'       => $this->maba_model->get_gelombang(),
                    'program_selected'  => $this->input->post('program'),
                    'institusi_selected'=> $selected->id_institusi,
                  'jurusan_selected'  => $selected->id_jurusan,
                  'jurusan2_selected' => $selected->jurusan,
                  'gelombang_selected'=> $selected->id_gelombang,
                  'nisn'              => $nisn,
                  'submit'            => $i->post('nisn'),
                  'isi'               => 'agen/pernah_daftar');
          $this->load->view('agen/layout_agen/wrapper', $data, FALSE);
        }

  }



	public function profil()
	{
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $this->simple_login_agen->cek_login();
        $detail_agen   = $this->agen_model->detail_agen();
        $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen($id_thn_akademik);
        $jumlah_agen_pengajuan     = $this->agen_model->jumlah_agen_pengajuan($id_thn_akademik);
        $jumlah_pengajuan     = $this->agen_model->jumlah_pengajuan($id_thn_akademik);
        $komisi_agen            = $this->agen_model->agen_pengajuan($id_thn_akademik);
        $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_pengajuan($id_thn_akademik);

          $data = array('title'             => 'Profil Agen',
                        'detail_agen'       => $detail_agen,
                        'jumlah_komisi_agen'       => $jumlah_komisi_agen,
                        'jumlah_agen_pengajuan'       => $jumlah_agen_pengajuan,
                        'jumlah_pengajuan'       => $jumlah_pengajuan,
                        'komisi_agen'       => $komisi_agen,
                        'menunggu_jumlah_pengajuan'       => $menunggu_jumlah_pengajuan,
                        'isi'               => 'agen/profil');
        $this->load->view('layout2/wrapper', $data, FALSE);
        
	}

  public function data_profil($id)
  {
        $this->simple_login_agen->cek_login();
        $detail_agen   = $this->agen_model->detail_agen();
        $valid         = $this->form_validation;

        $valid->set_rules(  'nama','Nama','required',
                    array(  'required'    => '%s Harus Diisi'));          

        if($valid->run()){
          $i = $this->input;

          $data = array(  'id'                  => $detail_agen->id,
                          'nik'                 => $i->post('nik'),
                          'nama'                => $i->post('nama'),
                          'alamat'              => $i->post('alamat'),
                          'hp'                  => $i->post('hp'),
                          'email'               => $i->post('email'),
                          'kabupaten'           => $i->post('kabupaten')
                      );
        $this->agen_model->edit_agen($data);
        $this->session->set_flashdata('success', 'Data telah diperbaharui');
        redirect(base_url('agen/data_profil/'.$detail_agen->id),'refresh');
        }else {
          $data = array('title'             => 'Profil Agen',
                        'detail_agen'       => $detail_agen,
                        'isi'               => 'agen/data_profil');
        $this->load->view('layout2/wrapper', $data, FALSE);
        } 
  }

  public function data_bank($id)
  {
        $this->simple_login_agen->cek_login();
        $detail_agen   = $this->agen_model->detail_agen();
        $valid         = $this->form_validation;

        $valid->set_rules(  'norek','Nomor Rekening','required',
                    array(  'required'    => '%s Harus Diisi'));          

        if($valid->run()){
          $i = $this->input;

          $data = array(  'id'                  => $detail_agen->id,
                          'namabank'            => $i->post('namabank'),
                          'atas_nama'           => $i->post('atas_nama'),
                          'norek'               => $i->post('norek'),
                      );
        $this->agen_model->edit_agen($data);
        $this->session->set_flashdata('success', 'Data telah diperbaharui');
        redirect(base_url('agen/data_bank/'.$detail_agen->id),'refresh');
        }else {
          $data = array('title'             => 'Profil Agen',
                        'detail_agen'       => $detail_agen,
                        'isi'               => 'agen/data_bank');
        $this->load->view('layout2/wrapper', $data, FALSE);
        } 
  }

	//HALAMAN ganti password agen
	public function lupa_password()
	{
        $detail_konfigurasi = $this->admin_model->detail_institusi();
		$this->form_validation->set_rules('username','Username','required',
								array('requiered' => '%s harus diisi'));

		if ($this->form_validation->run()) {
			$username 			= $this->input->post('username');
            $email           = $this->input->post('email');
			//proses ke simpel login
			$this->simple_login_agen->lupa_password($username,$email);
		}

		//end valid 
		$data = array('title'             => 'Halaman ganti password',
                  'detail_konfigurasi' => $detail_konfigurasi,
                   'isi'              => 'agen/ganti_password');
        $this->load->view('layout2/wrapper', $data, FALSE);
	}

	//halaman password baru
	public function password_baru()
	{
    $detail_konfigurasi = $this->admin_model->detail_institusi();
		$detail_agen = $this->agen_model->detail_agen();

		//end valid 
		$data = array('title'             => 'Halaman ganti password',
					       'detail_agen'		  => $detail_agen,
                  'detail_konfigurasi' => $detail_konfigurasi,
                  'detail_konfigurasi' => $detail_konfigurasi,
                  'isi'              => 'agen/password_baru');
        $this->load->view('layout2/wrapper', $data, FALSE);
	}

	public function ubah_password(){

    $detail_konfigurasi = $this->admin_model->detail_institusi();
		$detail_agen = $this->agen_model->detail_agen();
	    //validasi input
	    $valid = $this->form_validation;

	    $valid->set_rules( 'password','Password','required',
	                    array( 'required' => '%s harus diisi'));
	    
	    if($valid->run()===FALSE){
	      //end validasi

	    $data = array( 'title'        		=> 'Halaman Ganti password',
	    				'detail_agen'		=> $detail_agen,
                      'detail_konfigurasi' => $detail_konfigurasi,
	                    'isi'         		=> 'agen/password_baru');
	    $this->load->view('layout2/wrapper', $data, FALSE);
	    }else{
	      $i=$this->input;

	      $data = array(    'id'                => $detail_agen->id,
	                        'password'			=> md5($i->post('password')),
                          'passwordasli'      => $i->post('password')
	      );
	      $this->agen_model->ubah_agen($data);
	      $this->session->set_flashdata('success', 'Password anda telah berhasil di ubah silahkan login');
	      redirect(base_url('agen'),'refresh');
	    }
  }

  //ganti foto
  public function ganti_foto(){
 
        $this->simple_login_agen->cek_login();
        $detail_agen              = $this->agen_model->detail_agen();
        //validasi input

        $config['upload_path']    = './assets/upload/image/agen/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = TRUE;
        $config['max_size']       = 4096; // KB

        $this->load->library('upload', $config);
        
        
        if (!empty($_FILES['foto']['name'])) {
          $this->upload->do_upload('foto');
          $data= $this->upload->data();
          $foto = array('upload_data' => $this->upload->data());

          //create image
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/agen/'.$foto['upload_data']['file_name'];
          //lokasi thumbs
          $config['new_image']      = './assets/upload/image/agen/kecil/'.$foto['upload_data']['file_name'];
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 300; //pixel
          $config['height']         = 300;
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          //end create thumbnail

          if($detail_agen->foto != ""){
        	unlink('./assets/upload/image/agen/'.$detail_agen->foto);
          unlink('./assets/upload/image/agen/kecil/'.$detail_agen->foto);
      		}

          $data = array(  'id'          	  => $detail_agen->id,
                          'foto'            => $foto['upload_data']['file_name']);
                          
          $this->agen_model->edit_agen($data);
        }

        redirect(base_url('agen/profil'),'refresh');

  	}

    public function edit_berkas($id)
	{
		$this->simple_login_agen->cek_login();
		$detail_agen  	  = $this->agen_model->detail_agen();
		
		$data = array('title'             => 'Edit Berkas Agen',
			          'detail_agen'	  	  => $detail_agen,
                       'isi'              => 'agen/edit_berkas');
        $this->load->view('agen/layout_agen/wrapper', $data, FALSE);
	}

	public function edit_proses_berkas($id){
 
        $this->simple_login_agen->cek_login();
        $detail_agen              = $this->agen_model->detail_agen();
        //validasi input

        $config['upload_path']    = './assets/upload/image/agen/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = TRUE;
        $config['max_size']       = 4096; // KB

        $this->load->library('upload', $config);
        
        
        if (!empty($_FILES['foto_kk']['name'])) {
          $this->upload->do_upload('foto_kk');
          $data= $this->upload->data();
          $foto_kk=$data['file_name'];

          if($detail_agen->foto_kk != ""){
        	unlink('./assets/upload/image/agen/'.$detail_agen->foto_kk);
      		}

      	  }

      	  if (!empty($_FILES['foto_ktp']['name'])) {
          $this->upload->do_upload('foto_ktp');
          $data2= $this->upload->data();
          $foto_ktp = array('upload_data' => $this->upload->data());

          //create image
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/agen/'.$foto_ktp['upload_data']['file_name'];
          //lokasi thumbs
          $config['new_image']      = './assets/upload/image/agen/kecil/'.$foto_ktp['upload_data']['file_name'];
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 300; //pixel
          $config['height']         = 300;
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          //end create thumbnail

          if($detail_agen->foto_ktp != ""){
          unlink('./assets/upload/image/agen/'.$detail_agen->foto_ktp);
          unlink('./assets/upload/image/agen/kecil/'.$detail_agen->foto_ktp);
          }

      	  }

          $data = array(  'id'          	  	  => $detail_agen->id,
                          'foto_ktp'              => $foto_ktp['upload_data']['file_name'],
                          'foto_kk'               => $foto_kk);
                          
         $this->agen_model->edit_agen($data);

        redirect(base_url('agen/profil'),'refresh');

  	}

  	public function bantuan()
	{
		$this->simple_login_agen->cek_login();
		$detail_agen 		= $this->agen_model->detail_agen();
    $user           = $this->user_model->listing();
		
		$data = array('title'             => 'Customer Service',
      					  'detail_agen'	  	  => $detail_agen,
                  'user'              => $user,
                  'isi'              => 'agen/bantuan');
        $this->load->view('layout2/wrapper', $data, FALSE);
	}

	public function komen_agen()
	{
		$this->simple_login_agen->cek_login();
		$detail_agen 		= $this->agen_model->detail_agen();
		
		$i = $this->input;
		$id = $i->post('id');
		$username = $i->post('username');
		$isi = $i->post('isi');

		$data = array(  'komen_agen'          => $id,
						        'username'            => $username,
                    'isi'             	  => $isi);
                          
         $this->agen_model->bantuan_agen($data);

        redirect(base_url('agen/bantuan'),'refresh');
	}

  public function list_mahasiswa() {

    $this->simple_login_agen->cek_login();
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('agen/list_mahasiswa');
    $config['total_rows'] = count($this->agen_model->total_list_mahasiswa());
    $config['per_page'] = 20;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $list_mahasiswa     = $this->agen_model->list_mahasiswa($limit,$start);
    //end pagination

    //Validasi
    $valid = $this->form_validation;
    $valid -> set_rules('cari','Tulis','required',
      array('required' => '%s sesuatu dalam pencarian'));

    if($valid->run()) {
      $cari = strip_tags($this->input->post('cari'));
      $keywords = str_replace(' ','-',$cari);
      redirect(base_url('agen/cari/'.$keywords),'refresh');

    }
    //End validasi

    $data = array('title'             => 'Halaman Daftar Mahasiswa',
                  'list_mahasiswa'    => $list_mahasiswa,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'agen/list_mahasiswa'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  }	

  public function cari($keywords)
  {
    $this->simple_login_agen->cek_login();
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('agen/list_mahasiswa');
    $config['total_rows'] = count($this->agen_model->total_cari($keywords));
    $config['per_page'] = 20;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    //end pagination

    $keywords = str_replace('-',' ',strip_tags($keywords));
    $list_mahasiswa = $this->agen_model->cari($keywords,$limit,$start);

    $data = array('title'             => 'Halaman Daftar Mahasiswa',
                  'list_mahasiswa'    => $list_mahasiswa,
                  'keywords'           => $keywords,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'agen/list_mahasiswa'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  }

  public function profil_maba($id)
  {
        $this->simple_login_agen->cek_login();
        $detail_pendaftaran = $this->admin_model->detail_pendaftaran_agen($id);
        $list_penghasilan   = $this->admin_model->list_penghasilan();
        $list_penghasilan1  = $this->admin_model->list_penghasilan();
        $list_penghasilan2  = $this->admin_model->list_penghasilan();
        $username       = $detail_pendaftaran->username;
        $user         = $this->admin_model->detail_pengguna_verifikasi($username);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_lengkap','Nama','required',
                    array('required'   => '%s harus diisi'));
        
        if($valid->run()===FALSE){

        $data = array( 'title'              => 'Formulir Pendaftaran', 
                       'detail'             => $detail_pendaftaran,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'list_penghasilan2'=> $list_penghasilan2,
                       'isi'                => 'agen/profil_maba');
        $this->load->view('layout2/wrapper', $data, FALSE);
        
        }else{

        $i=$this->input;
        $date             = date('Y-m-d H:i:s');
        $ortu_nama    = implode(",", $this->input->post('ortu_nama'));
        $ortu_tempat_lahir    = implode("|", $this->input->post('ortu_tempat_lahir'));
        $ortu_tgl_lahir     = implode("|", $this->input->post('ortu_tgl_lahir'));
        $ortu_agama     = implode(",", $this->input->post('ortu_agama'));
        $ortu_pendidikan  = implode(",", $this->input->post('ortu_pendidikan'));
        $ortu_hp      = implode(",", $this->input->post('ortu_hp'));
        $ortu_pekerjaan   = implode(",", $this->input->post('ortu_pekerjaan'));
        $ortu_penghasilan = implode(",", $this->input->post('ortu_penghasilan'));
        $ortu_alamat = implode("|", $this->input->post('ortu_alamat'));

        $data = array(    'id'                => $detail_pendaftaran->id,
                          'nisn'              => $i->post('nisn'),
                          'ipk'               => $i->post('ipk'),
                          'email'             => $i->post('email'),
                          'nama_lengkap'      => $i->post('nama_lengkap'),
                          'tempat_lahir'      => $i->post('tempat_lahir'),
                          'tanggal_lahir'     => $i->post('tanggal_lahir'),
                          'jk'                => $i->post('jk'),
                          'agama'             => $i->post('agama'),
                          'kewarganegaraan'   => $i->post('kewarganegaraan'),
                          'status_sipil'      => $i->post('status_sipil'),
                          'alamat'            => $i->post('alamat'),
                          'hp'                => $i->post('hp'),
                          'sekolah_nama'      => $i->post('sekolah_nama'),
                          'sekolah_jurusan'   => $i->post('sekolah_jurusan'),
                          'sekolah_nama_jurusan'=> $i->post('sekolah_nama_jurusan'),
                          'tahun_lulus'       => $i->post('tahun_lulus'),
                          'no_ijazah'         => $i->post('no_ijazah'),
                          'nilai_ijazah'      => $i->post('nilai_ijazah'),
                          'pindahan_namapt'   => $i->post('pindahan_namapt'),
                          'pindahan_fakultas' => $i->post('pindahan_fakultas'),
                          'pindahan_prodi'    => $i->post('pindahan_prodi'),
                          'pindahan_nim'      => $i->post('pindahan_nim') ,
                          'pindahan_jumlahsks'=> $i->post('pindahan_jumlahsks'),
                          'nilai_ijazah'      => $i->post('nilai_ijazah'),
                          'nik'               => $i->post('nik'),
                          'ortu_tempat_lahir' => $ortu_tempat_lahir,
                          'ortu_tgl_lahir'    => $ortu_tgl_lahir,
                          'ortu_agama'    => $ortu_agama,
                          'ortu_pendidikan' => $ortu_pendidikan,
                          'ortu_hp'     => $ortu_hp,
                          'ortu_pekerjaan'  => $ortu_pekerjaan,
                          'ortu_penghasilan'  => $ortu_penghasilan,
                          'ortu_alamat'       => $ortu_alamat
          );

          $this->admin_model->edit_pendaftaran($data);

          $data_username = array( 'id'          => $user->id,
                                  'nama'        => $i->post('nama_lengkap'),
                                  'email'       => $i->post('email'),
                                  'hp'          => $i->post('hp')
          );
          $this->admin_model->edit_pengguna_verifikasi($data_username);

          $this->session->set_flashdata('success', 'Data telah diperbaharui');
          redirect(base_url('agen/profil_maba/'.$detail_pendaftaran->id),'refresh');
        }

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'detail'           => $detail_pendaftaran,
                       'list_penghasilan' => $list_penghasilan,
                       'list_penghasilan1'=> $list_penghasilan1,
                       'list_penghasilan2'=> $list_penghasilan2,
                       'isi'              => 'agen/profil_maba');
        $this->load->view('layout2/wrapper', $data, FALSE);
  }


  //ganti foto
  public function ganti_foto_maba($id_pendaftaran){
 
        $this->simple_login_agen->cek_login();
        $detail_maba              = $this->agen_model->detail_maba($id_pendaftaran);
        //validasi input

        $config['upload_path']    = './assets/upload/image/maba/profil/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = TRUE;
        $config['max_size']       = 4096; // KB

        $this->load->library('upload', $config);
        
        
        if (!empty($_FILES['foto']['name'])) {
          $this->upload->do_upload('foto');
          $data= $this->upload->data();
          $foto=$data['file_name'];

          if($detail_maba->foto != ""){
          unlink('./assets/upload/image/maba/profil/'.$detail_maba->foto);
          }

          $data = array(  'id_pendaftaran'    => $detail_maba->id_pendaftaran,
                          'foto'              => $foto);
                          
          $this->maba_model->edit_pendaftaran($data);
        }

        redirect(base_url('agen/profil_maba/'.$detail_maba->id_pendaftaran),'refresh');

    }

        public function upload_berkas($id){

        $this->simple_login_agen->cek_login();
        $detail     = $this->admin_model->detail_pendaftaran_agen($id);

        $id_berkas = $this->input->post('id_berkas');
        $detail_berkas_master   = $this->admin_model->detail_berkas_master($id_berkas);

        $id_pendaftar = $detail->id;
        $program = $detail->program;
        $cek_detail_berkas_masuk_pendaftar  = $this->admin_model->detail_berkas_masuk_pendaftar($id_berkas,$id_pendaftar,$program);
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules( 'nama_lengkap','Nama','required',
                      array( 'required' => '%s harus diisi'));

        if($valid->run()){
          //jika foto tidak kosong
          if(! empty($_FILES['berkas']['name'])){
          $config['upload_path']    = './assets/upload/berkas/';
          $config['allowed_types']  = $detail_berkas_master->type_file;
          $config['max_size']       = $detail_berkas_master->besar_berkas; // KB
          $config['encrypt_name']     = TRUE;

          $this->load->library('upload', $config);
        
        if(! $this->upload->do_upload('berkas')) {
        
        //end validasi

        $data = array( 'title'        => 'Halaman Upload Berkas',
                 'detail'       => $detail,
                 'error'        => $this->upload->display_errors(),
                 'isi'          => 'agen/upload_berkas');
        $this->load->view('layout2/wrapper', $data, FALSE);

        }else{
          $upload_foto = array('upload_data' => $this->upload->data());
          
          $data = array(  'id_pendaftar'    => $detail->id,       
                  'id_berkas'     => $detail_berkas_master->id_berkas,    
                  'file_masuk'    => $upload_foto['upload_data']['file_name'],
                  'program'       => $detail_berkas_master->program
        );
          if(empty($cek_detail_berkas_masuk_pendaftar)){
            $this->admin_model->tambah_berkas_masuk($data);
            $this->session->set_flashdata('success', 'berkas berhasil di upload');
          redirect(base_url('agen/upload_berkas/'.$detail->id),'refresh');
          }else{
            $this->session->set_flashdata('warning', 'Berkas ini sudah diupload');
            redirect(base_url('agen/upload_berkas/'.$detail->id),'refresh');
          }

        }}}
          $data = array(  'title'         => 'Halaman Upload Berkas ',
                    'detail'      => $detail,
                    'isi'           => 'agen/upload_berkas');
            $this->load->view('layout2/wrapper', $data, FALSE);
    }


    public function edit_upload_berkas($id_berkas_masuk){

    $detail   = $this->admin_model->detail_pendaftaran_mahasiswa();

    $detail_berkas_masuk_full   = $this->admin_model->detail_berkas_masuk_full($id_berkas_masuk);
    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules('nama_lengkap','Nama','required',
                    array( 'required' => '%s harus diisi'));

    if($valid->run()){
      //jika foto tidak kosong
      if(! empty($_FILES['berkas']['name'])){
      $config['upload_path']    = './assets/upload/berkas/';
      $config['allowed_types']  = $detail_berkas_masuk_full->type_file;
      $config['max_size']       = $detail_berkas_masuk_full->besar_berkas; // KB
      $config['encrypt_name']     = TRUE;

      $this->load->library('upload', $config);
    
    if(! $this->upload->do_upload('berkas')) {
    
    //end validasi

    $data = array( 'title'        => 'Halaman Upload Berkas',
             'detail'       => $detail,
             'error'        => $this->upload->display_errors(),
             'isi'          => 'agen/upload_berkas');
    $this->load->view('layout2/wrapper', $data, FALSE);

    }else{
      $upload_foto = array('upload_data' => $this->upload->data());

      unlink('./assets/upload/berkas/'.$detail_berkas_masuk_full->file_masuk);
      
      $data = array(  'id_berkas_masuk'   => $detail_berkas_masuk_full->id_berkas_masuk,    
              'file_masuk'    => $upload_foto['upload_data']['file_name'],
              'program'       => $detail_berkas_masuk_full->program
    );
      $this->admin_model->edit_berkas_masuk($data);
      $this->session->set_flashdata('success', 'Data telah di upload ulang');
      redirect(base_url('agen/upload_berkas/'.$detail_berkas_masuk_full->id_pendaftar),'refresh');
    }}}
      $data = array(  'title'         => 'Halaman Upload Berkas ',
                'detail'      => $detail,
                'isi'           => 'agen/upload_berkas');
      $this->load->view('layout2/wrapper', $data, FALSE);
  }
  

  public function konfirmasi_pembayaran($id)
  {

        $this->simple_login_agen->cek_login();
        $detail_agen    = $this->agen_model->detail_agen();

        $detail     = $this->admin_model->detail_pendaftaran_agen($id);
        $kode       = $detail->jurusan_pilihan;
        $prodi  = $this->admin_model->detail_prodi_kode($kode);
        $valid = $this->form_validation;
        $valid->set_rules('bank','Nama Bank / Metode pembayaran ','required',
                      array( 'required' => '%s harus diisi'));

        if($valid->run()){
            //jika foto tidak kosong
            if(! empty($_FILES['bukti_bayar']['name'])){
            $config['upload_path']      = './assets/upload/bukti/';
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = 220; // KB
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);
        
            if(! $this->upload->do_upload('bukti_bayar')) {
            
            //end validasi

            $data = array( 'title'              => 'Halaman Konfirmasi Bayar ',
                           'detail'             => $detail,
                           'error'              => $this->upload->display_errors(),
                           'prodi'              => $prodi,
                           'isi'                => 'agen/konfirmasi_bayar');
            $this->load->view('layout2/wrapper', $data, FALSE);

            }else{
                $upload_foto = array('upload_data' => $this->upload->data());

                //create thumbnail
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/upload/bukti/'.$upload_foto['upload_data']['file_name'];
                //lokasi thumbs
                $config['new_image']        = './assets/upload/bukti/thumbs/'.$upload_foto['upload_data']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 800; //pixel
                $config['height']           = 800;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                //end create thumbnail

                if($detail->bukti_bayar != ""){
                    unlink('./assets/upload/bukti/'.$detail->bukti_bayar);
                    unlink('./assets/upload/bukti/thumbs/'.$detail->bukti_bayar);
                }
                
                //slug
                $data = array(  'id'                => $detail->id,         
                                                'atas_nama'         => $this->input->post('atas_nama'),
                                                'bank'              => $this->input->post('bank'),
                                                'bukti_bayar'   => $upload_foto['upload_data']['file_name'],
                                                'tgl_bayar'         => $this->input->post('tgl_bayar')
            );
                $this->admin_model->edit_pendaftaran($data);
                $this->session->set_flashdata('success', 'Bukti telah di upload');
                redirect(base_url('agen/konfirmasi_pembayaran/'.$detail->id),'refresh');
            }}else{
                //tanpa foto
                $data = array(  'id'                => $detail->id,
                                'atas_nama'         => $this->input->post('atas_nama'),
                                'bank'              => $this->input->post('bank'),
                                'tgl_bayar'         => $this->input->post('tgl_bayar')
            );
                $this->admin_model->edit_pendaftaran($data);
                $this->session->set_flashdata('success', 'Data telah di edit');
                redirect(base_url('agen/konfirmasi_pembayaran/'.$detail->id),'refresh');
            }}
                $data = array(  'title'             => 'Halaman Konfirmasi Bayar',
                                'detail'            => $detail,
                                'prodi'   => $prodi,
                                'isi'               => 'agen/konfirmasi_bayar');
                $this->load->view('layout2/wrapper', $data, FALSE);
       
  }

  public function edit_konfirmasi_pembayaran($id_pendaftaran)
  {
      
    $this->simple_login_agen->cek_login();
    $user           = $this->user_model->listing();
    $detail_agen    = $this->agen_model->detail_agen();
    $detail_maba        = $this->agen_model->detail_maba($id_pendaftaran);
    $id_gelombang       = $detail_maba->gelombang;
    $detail_gelombang   = $this->maba_model->detail_gelombang_agen($id_gelombang);
    $detail_konfirmasi  = $this->agen_model->detail_maba_konfirmasi($id_pendaftaran);

        $valid = $this->form_validation;

        $valid->set_rules(  'atas_nama','Nama dalam slip','required',
                    array(  'required'    => '%s Harus Diisi'));
           
        if($valid->run()){

          $i=$this->input;

        $data = array(   'id_konfirmasi'   => $detail_konfirmasi->id_konfirmasi,
                         'id_pendaftaran'  => $detail_maba->id_pendaftaran,
                         'atas_nama'       => $i->post('atas_nama'),
                         'nomor'           => $i->post('nomor'),
                         'bank'            => $i->post('bank'),
                         'tanggal_bayar'   => $i->post('tanggal_bayar')
        );
        $this->maba_model->edit_konfirmasi($data);

        $this->session->set_flashdata('success', 'konfirmasi pembayaran telah diperbaharui, tungu 2x24 jam untuk verifikasi bukti pembayaran anda');
        redirect(base_url('agen/konfirmasi_pembayaran/'.$detail_maba->id_pendaftaran),'refresh');

       }else{

      $data = array('title'             => 'Konfirmasi Pembayaran',
                    'detail_maba'       => $detail_maba,
                    'detail_agen'       => $detail_agen,
                    'detail_gelombang'  => $detail_gelombang,
                    'user'              => $user,
                    'detail_konfirmasi' => $detail_konfirmasi,
                    'isi'               => 'agen/konfirmasi_bayar');
      $this->load->view('layout2/wrapper', $data, FALSE);
    }
     
  }

  public function bantuan_maba($id_pendaftaran)
  {
    $this->simple_login_agen->cek_login();
    $detail_maba        = $this->agen_model->detail_maba($id_pendaftaran);
    $detail_keluh_maba  = $this->agen_model->detail_keluh_maba($id_pendaftaran);
    
    $data = array('title'             => 'Bantuan Calon Mahasiwa',
                  'total'             => '('.count($detail_keluh_maba).') Percakapan',
                  'detail_maba'       => $detail_maba,
                  'detail_keluh_maba' => $detail_keluh_maba,
                      'isi'              => 'agen/bantuan_maba');
        $this->load->view('agen/layout_agen/wrapper', $data, FALSE);
  }

  public function komen_maba($id_pendaftaran)
  {
    $this->simple_login_agen->cek_login();
    $detail_maba        = $this->agen_model->detail_maba($id_pendaftaran);
    
    $i = $this->input;
    $id = $i->post('id_pendaftaran');
    $nama_lengkap = $i->post('nama_lengkap');
    $isi = $i->post('isi');

    $data = array(  'id_komen'       => $id,
                    'username'      => $nama_lengkap,
                    'isi'           => $isi);
                          
         $this->maba_model->bantuan_maba($data);

        redirect(base_url('agen/bantuan_maba/'.$detail_maba->id_pendaftaran),'refresh');
  }

   public function edit_berkas_maba($id_pendaftaran)
  {
    $this->simple_login_agen->cek_login();
    $detail_maba        = $this->agen_model->detail_maba($id_pendaftaran);
    
    $data = array('title'             => 'Edit Berkas Mahasiswa',
                'detail_maba'       => $detail_maba,
                       'isi'              => 'agen/edit_berkas_maba');
        $this->load->view('agen/layout_agen/wrapper', $data, FALSE);
  }

  public function edit_proses_mb($id_pendaftaran){
 
        $this->simple_login_agen->cek_login();
        $detail_maba        = $this->agen_model->detail_maba($id_pendaftaran);
        //validasi input

        $config['upload_path']    = './assets/upload/image/maba/berkas/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = TRUE;
        $config['max_size']       = 4096; // KB

        $this->load->library('upload', $config);
        
        
        if (!empty($_FILES['mb_skhu']['name'])) {
          $this->upload->do_upload('mb_skhu');
          $data= $this->upload->data();
          $mb_skhu=$data['file_name'];

          if($detail_maba->mb_skhu != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->mb_skhu);
          }

          $data = array('id_pendaftaran'      => $detail_maba->id_pendaftaran,
                          'mb_skhu'             => $mb_skhu);

          $this->maba_model->edit_pendaftaran($data);

          }

          if (!empty($_FILES['mb_ktp_kk']['name'])) {
          $this->upload->do_upload('mb_ktp_kk');
          $data2= $this->upload->data();
          $mb_ktp_kk=$data2['file_name'];

           if($detail_maba->mb_ktp_kk != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->mb_ktp_kk);
          }

          $data = array('id_pendaftaran'      => $detail_maba->id_pendaftaran,
                          'mb_ktp_kk'       => $mb_ktp_kk);

          $this->maba_model->edit_pendaftaran($data);

          }

          if (!empty($_FILES['mb_ijazah']['name'])) {
          $this->upload->do_upload('mb_ijazah');
          $data3= $this->upload->data();
          $mb_ijazah=$data3['file_name'];

           if($detail_maba->mb_ijazah != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->mb_ijazah);
          }

          $data = array('id_pendaftaran'      => $detail_maba->id_pendaftaran,
                          'mb_ijazah'           => $mb_ijazah);

          $this->maba_model->edit_pendaftaran($data);

          }

          if (!empty($_FILES['mb_foto']['name'])) {
          $this->upload->do_upload('mb_foto');
          $data4= $this->upload->data();
          $mb_foto=$data4['file_name'];

           if($detail_maba->mb_foto != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->mb_foto);
          }

          $data = array('id_pendaftaran'      => $detail_maba->id_pendaftaran,
                          'mb_foto'       => $mb_foto);

          $this->maba_model->edit_pendaftaran($data);

          }

          if (!empty($_FILES['mb_kerja']['name'])) {
          $this->upload->do_upload('mb_kerja');
          $data5= $this->upload->data();
          $mb_kerja=$data5['file_name'];

           if($detail_maba->mb_kerja != ""){
          unlink('./assets/upload/image/maba/berkas'.$detail_maba->mb_kerja);
          }

          $data = array(  'id_pendaftaran'      => $detail_maba->id_pendaftaran,
                          'mb_kerja'      => $mb_kerja);
                          
         $this->maba_model->edit_pendaftaran($data);

          }else{

          redirect(base_url('agen/edit_berkas_maba/'.$detail_maba->id_pendaftaran),'refresh');

          }

        redirect(base_url('agen/edit_berkas_maba/'.$detail_maba->id_pendaftaran),'refresh');

    }

    public function edit_proses_pd($id_pendaftaran){
 
        $this->simple_login_agen->cek_login();
        $detail_maba        = $this->agen_model->detail_maba($id_pendaftaran);
        //validasi input

        $config['upload_path']    = './assets/upload/image/maba/berkas/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['encrypt_name']   = TRUE;
        $config['max_size']       = 4096; // KB

        $this->load->library('upload', $config);
        
        
        if (!empty($_FILES['pd_transkip']['name'])) {
          $this->upload->do_upload('pd_transkip');
          $data= $this->upload->data();
          $pd_transkip=$data['file_name'];

          if($detail_maba->pd_transkip != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->pd_transkip);
          }

          }

          if (!empty($_FILES['pd_surat_pindah']['name'])) {
          $this->upload->do_upload('pd_surat_pindah');
          $data2= $this->upload->data();
          $pd_surat_pindah=$data2['file_name'];

           if($detail_maba->pd_surat_pindah != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->pd_surat_pindah);
          }

          }

          if (!empty($_FILES['pd_foto']['name'])) {
          $this->upload->do_upload('pd_foto');
          $data3= $this->upload->data();
          $pd_foto=$data3['file_name'];

           if($detail_maba->pd_foto != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->pd_foto);
          }

          }

          if (!empty($_FILES['pd_ijazah_sma']['name'])) {
          $this->upload->do_upload('pd_ijazah_sma');
          $data4= $this->upload->data();
          $pd_ijazah_sma=$data4['file_name'];

           if($detail_maba->pd_ijazah_sma != ""){
          unlink('./assets/upload/image/maba/berkas/'.$detail_maba->pd_ijazah_sma);
          }

          }

            $data = array('id_pendaftaran'          => $detail_maba->id_pendaftaran,
                          'pd_transkip'             => $pd_transkip,
                          'pd_foto'               => $pd_foto,
                          'pd_surat_pindah'       => $pd_surat_pindah,
                          'pd_ijazah_sma'       => $pd_ijazah_sma);
                          
           $this->maba_model->edit_pendaftaran($data);

          redirect(base_url('agen/edit_berkas_maba/'.$detail_maba->id_pendaftaran),'refresh');


    }


  public function komisi_jumlah_agen()
  {
    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $kode_agen = $detail_agen->kode_agen;
    $jumlah_agen    = $this->admin_model->jumlah_agen_rekomendasi($kode_agen);
    $komisi_agen            = $this->agen_model->agen_rekomendasi_pengajuan();
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_rekomendasi_pengajuan();
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_rekomendasi_pengajuan();

    $data = array('title'             => 'Halaman Komisi Rekomdasi',
                  'jumlah_agen'       => $jumlah_agen,
                  'komisi_agen'       => $komisi_agen,
                  'jumlah_agen_pengajuan'=> $jumlah_agen_pengajuan,
                  'menunggu_jumlah_pengajuan'=> $menunggu_jumlah_pengajuan,
                  'jumlahkan'         => $this->admin_model->total_diterima_rekomendasi_maba_agen($kode_agen),
                  'isi'              => 'agen/komisi_rekomendasi');
        $this->load->view('layout2/wrapper', $data, FALSE);
  }

    //HALAMAN komisi koordinator
  public function komisi_koordinator()
  {
    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $kode_agen = $detail_agen->kode_agen;
    $detail_jumlah_agen = $this->agen_model->detail_jumlah_agen($kode_agen);
    $id_koordinator = $detail_jumlah_agen->id_koordinator;
    $jumlah_agen    = $this->admin_model->jumlah_agen($id_koordinator);
    $komisi_agen            = $this->agen_model->agen_koordinator_pengajuan();
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_koordinator_pengajuan();
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_koordinator_pengajuan();

    $data = array('title'             => 'Halaman Komisi Koordinator Agen',
                  'jumlah_agen'       => $jumlah_agen,
                  'detail_jumlah_agen'=> $detail_jumlah_agen,
                  'komisi_agen'       => $komisi_agen,
                  'jumlah_agen_pengajuan'=> $jumlah_agen_pengajuan,
                  'menunggu_jumlah_pengajuan'=> $menunggu_jumlah_pengajuan,
                  'jumlahkan'         => $this->admin_model->total_diterima_maba_agen($id_koordinator),
                  'isi'              => 'agen/komisi_koordinator');
        $this->load->view('layout2/wrapper', $data, FALSE);
  }

   public function pencairan_koordinator()
  {
    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $kode_agen = $detail_agen->kode_agen;
    $detail_jumlah_agen = $this->agen_model->detail_jumlah_agen($kode_agen);
    $id_koordinator = $detail_jumlah_agen->id_koordinator;
    $jumlah_agen    = $this->admin_model->jumlah_agen($id_koordinator);

    $jumlahkan = $this->admin_model->total_diterima_maba_agen($id_koordinator);
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_koordinator_pengajuan();
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_koordinator_pengajuan();

    $saldo = $jumlahkan->total*5000;
    $menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;

    $menunggu_sementara = $saldo-$menunggu;

    $i = $this->input;
    $tgl_pengajuan = $i->post('tgl_pengajuan');
    $pengajuan = $i->post('pengajuan');
    $hari = date('Y-m-d');


    if($pengajuan < 10000){

      $this->session->set_flashdata('warning', 'Maaf Saldo Anda Tidak mencukupi, minimal pengajuan RP.10.000,.');
      redirect(base_url('agen/komisi_koordinator'),'refresh');

    }else{
      $data = array(  'kode_agen'             => $detail_agen->kode_agen,
                      'pengajuan'             => $pengajuan,
                      'tgl_pengajuan'         => $tgl_pengajuan,
                      'tgl_dibuat'             => $hari);

      $this->agen_model->tambah_pengajuan_koordinator($data);
      $this->session->set_flashdata('success', 'Selamat anda telah berhasil melakukan pengajuan mohon cek secara berkala pengajuan anda saat hari / jam kerja');
      redirect(base_url('agen/komisi_koordinator'),'refresh');
    }
  
  }

  public function pencairan_rekomendasi()
  {
    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $kode_agen = $detail_agen->kode_agen;
    $detail_jumlah_agen = $this->agen_model->detail_jumlah_agen($kode_agen);
    $jumlah_agen    = $this->admin_model->jumlah_agen_rekomendasi($kode_agen);

    $jumlahkan = $this->admin_model->total_diterima_rekomendasi_maba_agen($kode_agen);
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_rekomendasi_pengajuan();
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_rekomendasi_pengajuan();

    $saldo = $jumlahkan->total*5000;
    $menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;

    $menunggu_sementara = $saldo-$menunggu;

    $i = $this->input;
    $tgl_pengajuan = $i->post('tgl_pengajuan');
    $pengajuan = $i->post('pengajuan');
    $hari = date('Y-m-d');


    if($pengajuan < 10000){

      $this->session->set_flashdata('warning', 'Maaf Saldo Anda Tidak mencukupi, minimal pengajuan RP.10.000,.');
      redirect(base_url('agen/komisi_jumlah_agen'),'refresh');

    }else{
      $data = array(  'kode_agen'             => $detail_agen->kode_agen,
                      'pengajuan'             => $pengajuan,
                      'tgl_pengajuan'         => $tgl_pengajuan,
                      'tgl_dibuat'             => $hari);

      $this->agen_model->tambah_pengajuan_koordinator($data);
      $this->session->set_flashdata('success', 'Selamat anda telah berhasil melakukan pencairan silahkan cek secara berkala status pencairan anda di menu riwayat pencairan pada saat hari / jam kerja');
      redirect(base_url('agen/komisi_jumlah_agen'),'refresh');
    }
  
  }

  public function list_maba_agen($kode_agen) {

    $this->simple_login_agen->cek_login();
    $list_mahasiswa     = $this->agen_model->list_maba_agen($kode_agen);
    $agen     = $this->agen_model->detai_list_maba_agen($kode_agen);

    $data = array('title'             => 'Halaman Daftar Mahasiswa',
                  'list_mahasiswa'    => $list_mahasiswa,
                  'agen'              => $agen,
                  'isi'               => 'agen/list_maba_agen'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  } 


    public function komisi() {

    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

    $this->simple_login_agen->cek_login();
    $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen($id_thn_akademik);
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('agen/komisi');
    $config['total_rows'] = count($this->agen_model->total_komisi_agen($id_thn_akademik));
    $config['per_page'] = 20;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $komisi_agen     = $this->agen_model->komisi_agen($limit,$start,$id_thn_akademik);
    //end pagination

    //Validasi
    $valid = $this->form_validation;
    $valid -> set_rules('cari','Tulis','required',
      array('required' => '%s sesuatu dalam pencarian'));

    if($valid->run()) {
      $cari = strip_tags($this->input->post('cari'));
      $keywords = str_replace(' ','-',$cari);
      redirect(base_url('agen/cari_mahasiswa/'.$keywords),'refresh');

    }
    //End validasi

    $data = array('title'             => 'Daftar Komisi',
                  'komisi_agen'       => $komisi_agen,
                  'jumlah_komisi_agen'=> $jumlah_komisi_agen,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'agen/komisi'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  } 

  public function cari_mahasiswa($keywords)
  {
    $this->simple_login_agen->cek_login();
    $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen();
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('agen/komisi');
    $config['total_rows'] = count($this->agen_model->total_cari_mahasiswa($keywords));
    $config['per_page'] = 20;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    //end pagination

    $keywords = str_replace('-',' ',strip_tags($keywords));
    $komisi_agen     = $this->agen_model->cari_mahasisawa($keywords,$limit,$start);

    $data = array('title'             => 'Daftar Komisi',
                  'komisi_agen'       => $komisi_agen,
                  'jumlah_komisi_agen'=> $jumlah_komisi_agen,
                  'keywords'           => $keywords,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'agen/komisi'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  }

  
  
  public function agen_pengajuan() {

    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen($id_thn_akademik);
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_agen_pengajuan($id_thn_akademik);
    $jumlah_pengajuan     = $this->agen_model->jumlah_pengajuan($id_thn_akademik);
    $komisi_agen            = $this->agen_model->agen_pengajuan($id_thn_akademik);
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_pengajuan($id_thn_akademik);

    $data = array('title'             => 'Daftar Riwayat Pengajuan',
                  'komisi_agen'       => $komisi_agen,
                  'detail_agen'       => $detail_agen,
                  'jumlah_komisi_agen'=> $jumlah_komisi_agen,
                  'jumlah_pengajuan'=> $jumlah_pengajuan,
                  'jumlah_agen_pengajuan'=> $jumlah_agen_pengajuan,
                  'menunggu_jumlah_pengajuan'=> $menunggu_jumlah_pengajuan,
                  'isi'               => 'agen/pengajuan'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  }

  public function riwayat_pencarian() {

    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

    $this->simple_login_agen->cek_login();
    $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen($id_thn_akademik);
    $jumlah_agen_pengajuan     = $this->agen_model->jumlah_agen_pengajuan($id_thn_akademik);
    $komisi_agen            = $this->agen_model->agen_pengajuan($id_thn_akademik);
    $menunggu_jumlah_pengajuan     = $this->agen_model->menunggu_jumlah_pengajuan($id_thn_akademik);

    $data = array('title'             => 'Daftar Riwayat Pengajuan',
                  'komisi_agen'       => $komisi_agen,
                  'jumlah_komisi_agen'=> $jumlah_komisi_agen,
                  'jumlah_agen_pengajuan'=> $jumlah_agen_pengajuan,
                  'menunggu_jumlah_pengajuan'=> $menunggu_jumlah_pengajuan,
                  'isi'               => 'agen/riwayat_pencarian'); 
    $this->load->view('layout2/wrapper', $data, FALSE);
  }

  public function pencairan()
  {
    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
    $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $jumlah_komisi_agen     = $this->agen_model->jumlah_komisi_agen($id_thn_akademik);
    $jumlah_pengajuan     = $this->agen_model->jumlah_pengajuan($id_thn_akademik);

    $saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_pengajuan->total_pengajuan;

    $i = $this->input;
    $tgl_pengajuan = $i->post('tgl_pengajuan');
    $pengajuan = $i->post('pengajuan');
    $hari = date('Y-m-d');

    if($detail_agen->namabank =='' && $detail_agen->atas_nama =='' && $detail_agen->norek ==''){

      $this->session->set_flashdata('warning', 'Maaf untuk saat ini anda belum bisa melakukan pencairan karena  belum mengisi data akun bank, silahkan isi terlebih dahulu akun bank anda dengan klik tombol Edit Akun Bank ');
      redirect(base_url('agen/agen_pengajuan'),'refresh');

    }else{

    if($saldo >= 0){

      $data = array(  'kode_agen'             => $jumlah_komisi_agen->kode_agen,
                      'pengajuan'             => $pengajuan,
                      'tgl_pengajuan'         => $tgl_pengajuan,
                      'tgl_dibuat'             => $hari,
                      'thn_akademik'          => $id_thn_akademik);

      $this->agen_model->tambah_pengajuan($data);
      $this->session->set_flashdata('success', 'Selamat anda telah berhasil melakukan pengajuan mohon cek secara berkala pengajuan anda saat hari / jam kerja');
      redirect(base_url('agen/agen_pengajuan'),'refresh');
    }else{
      $this->session->set_flashdata('warning', 'Maaf Saldo Anda Tidak mencukupi atau anda sedang menunggu konfirmasi pengajuan');
      redirect(base_url('agen/agen_pengajuan'),'refresh');
    }}
  
  }

  //cetak kartu ujian
    public function cetak_kartu($id)
  {
    $this->simple_login_agen->cek_login();
    $detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
    $gelombang          = $detail_pendaftaran->gelombang;
    $jadwal_usm         = $this->admin_model->jadwal_usm_admin($gelombang);
    $detail_institusi   = $this->admin_model->detail_institusi();
    $fakultas           = $detail_pendaftaran->fakultas;
    $detail_fakultas    = $this->admin_model->kartu_fakultas($fakultas);
    $program            = $detail_pendaftaran->program;
    $kartu_program      = $this->admin_model->kartu_program($program);


    $data = array('title'            => 'Halaman Cetak Kartu',
                  'jadwal_usm'              => $jadwal_usm,
                  'detail_pendaftaran'        => $detail_pendaftaran,
                  'detail_fakultas'           => $detail_fakultas,
                  'kartu_program'           => $kartu_program,
                  'detail_institusi'          => $detail_institusi,
                  'isi'              => 'kartu/cetak');
        $this->load->view('kartu/cetak', $data, FALSE);
  }

   //cetak Formulir
    public function cetak_formulir($id_pendaftaran)
  {
    $this->simple_login_agen->cek_login();
    $detail_mahasiswa = $this->admin_model->detail_mahasiswa($id_pendaftaran);
    $id_institusi = $detail_mahasiswa->id_institusi;
    $detail_profil     = $this->admin_model->detail_kampus($id_institusi);


    $data = array('title'            => 'Halaman Cetak Kartu',
                  'detail_profil'    => $detail_profil,
                  'detail_mahasiswa' => $detail_mahasiswa,
                  'isi'              => 'cetak_kartu/formulir');
        $this->load->view('cetak_kartu/formulir', $data, FALSE);
  }

  public function member_koordinator()
  {

    $this->simple_login_agen->cek_login();
    $detail_agen    = $this->agen_model->detail_agen();
    $kode_agen       = $detail_agen->kode_agen;
    $detail_member   = $this->admin_model->detail_member_koordinator($kode_agen);

        $valid = $this->form_validation;

        $valid->set_rules(  'nama','Nama Lengkap','required',
                    array(  'required'    => '%s Harus Diisi'));
           
        if($valid->run()){

          $i=$this->input;
          $today = date('Y-m-d');

        $data = array(  'kode_agen'         => $detail_agen->kode_agen,
                         'nama'             => $i->post('nama'),
                         'status_pendaftaran' => '0',
                         'tanggal'          => $today
        );
        $this->admin_model->tambah_member($data);

        $this->session->set_flashdata('success', 'pendaftaran member koordinator telah terkirim, silahkan cek secara berkala status member koordinator anda');
        redirect(base_url('agen/member_koordinator/'),'refresh');

       }else{

      $data = array('title'             => 'Pendaftaran Member Koordinator',
                    'detail_agen'       => $detail_agen,
                    'detail_member'     => $detail_member,
                    'isi'              => 'agen/member');
      $this->load->view('layout2/wrapper', $data, FALSE);
    }
       
  }
}