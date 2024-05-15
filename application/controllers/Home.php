<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_CONTROLLER
{
    public function __construct(){
    parent::__construct();
    $this->load->model('admin_model');
    }
    
    public function index(){

        $detail_institusi      = $this->admin_model->detail_institusi();
        $pendaftar_tes         = $this->admin_model->pendaftar_tes();
        $pendaftar_terbaru     = $this->admin_model->pendaftar_terbaru();
        $pendaftar_konfirmasi  = $this->admin_model->pendaftar_konfirmasi();
        $informasi             = $this->admin_model->informasi();
        $list_prodi            = $this->admin_model->list_prodi_beranda();
        $list_prodi_bawah      = $this->admin_model->list_prodi_beranda();
        $list_biaya            = $this->admin_model->list_biaya_beranda();
        $galeri                = $this->admin_model->galeri_beranda();
        $fakultas              = $this->admin_model->pilih_fakultas();
        $statistik_pendaftar   = $this->admin_model->statistik_pendaftar_tahunan_beranda();

        $data = array('title'               => 'Penerimaan Mahasiswa Baru',
                      'detail_institusi'    => $detail_institusi,
                      'pendaftar_tes'       => $pendaftar_tes,
                      'pendaftar_terbaru'   => $pendaftar_terbaru,
                      'pendaftar_konfirmasi'=> $pendaftar_konfirmasi,
                      'informasi'           => $informasi,
                      'list_prodi'          => $list_prodi,
                      'list_prodi_bawah'    => $list_prodi_bawah,
                      'statistik_pendaftar' => $statistik_pendaftar,
                      'list_biaya'          => $list_biaya,
                      'galeri'              => $galeri,
                      'fakultas'            => $fakultas,
                      'isi'                 => 'home/list');
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function pendaftaran(){

        $list_jenis         = $this->admin_model->list_jenis();
        $sumber         = $this->admin_model->list_sumber_aktif();
        $popup              = random_string('alnum', 20);
        $get_thn_akademik   = $this->admin_model->get_thn_akademik();

        $fakultas           = $this->admin_model->get_fakultas_aktif();

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('username','Nama Pengguna / Username','required|is_unique[pendaftaran.username]|max_length[25]',
                    array('required'   => '%s harus diisi',
                          'is_unique'  => '%s sudah ada. Buat Nama pengguna baru.',
                          'min_length' => '%s maksimal 25 karakter'));

        $valid->set_rules('email','Email','required|is_unique[pendaftaran.email]',
                    array('required'   => '%s harus diisi',
                          'is_unique'  => '%s sudah terdaftar, Silahkan masukan email baru'));

        $valid->set_rules('hp','Nomor HP/WA','required|min_length[12]|max_length[14]',
                 array( 'required'   => '%s harus diisi',
                        'min_length' => '%s minimal 12 angka',
                        'max_length' => '%s maksimal 14 angka'));
        
        if($valid->run()===FALSE){

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'sumber'           => $sumber,   
                       'fakultas'         => $fakultas,
                       'fakultas2'        => $fakultas,
                       'isi'              => 'home/pendaftaran');
        $this->load->view('layout/wrapper', $data, FALSE);
        
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
                            'kode_agen'         => "Mandiri",
                            'fakultas'          => $i->post('fakultas'),
                            'popup'             => $popup,
                            'bayar'             => "1",
                            'gelombang'         => $i->post('gelombang'),
                            'gelombang_2'       => $i->post('gelombang_2'),
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
                            'pindahan_namapt'   => $i->post('sekolah_nama'),
                            'pindahan_prodi'    => $i->post('sekolah_jurusan'),
                            'tanggal_daftar'    => $date,
                            'sumber'            => $i->post('sumber')
          );

          if($jenjang == 'S2' && $jenjang2 == 'S2'){  
          $this->admin_model->tambah_pendaftaran($data);
          }elseif($jenjang == 'S2' && $jenjang2 != 'S2'){
          $this->session->set_flashdata('warning', 'Tidak bisa melakukan pendaftaran jika jenjang pilihan pertama S2 dan jenjang pilihan kedua bukan S2');
          redirect(base_url('home/pendaftaran'),'refresh');
          }elseif($jenjang != 'S2' && $jenjang2 == 'S2'){
          $this->session->set_flashdata('warning', 'Tidak bisa melakukan pendaftaran jika jenjang pilihan pertama bukan S2 dan jenjang pilihan kedua S2');
          redirect(base_url('home/pendaftaran'),'refresh');
          }elseif($jenjang == 'Profesi' && $jenjang2 == 'Profesi'){  
          $this->admin_model->tambah_pendaftaran($data);
          }elseif($jenjang == 'Profesi' && $jenjang2 != 'Profesi'){
          $this->session->set_flashdata('warning', 'Tidak bisa melakukan pendaftaran jika jenjang pilihan pertama Profesi dan jenjang pilihan Kedua bukan Profesi');
          redirect(base_url('home/pendaftaran'),'refresh');
          }elseif($jenjang != 'Profesi' && $jenjang2 == 'Profesi'){
          $this->session->set_flashdata('warning', 'Tidak bisa melakukan pendaftaran jika jenjang pilihan pertama bukan profesi dan jenjang pilihan kedua Profesi');
          redirect(base_url('home/pendaftaran'),'refresh');
          }elseif($jenjang != 'S2' && $jenjang2 != 'S2'){
          $this->admin_model->tambah_pendaftaran($data);
          }elseif($jenjang != 'Profesi' && $jenjang2 != 'Profesi'){
          $this->admin_model->tambah_pendaftaran($data);
          }

          $pengguna = array('nama'              => $i->post('nama_lengkap'),
                            'username'          => $i->post('username'),
                            'password'          => md5($i->post('password')),
                            'email'             => $i->post('email'),
                            'id_level'          => '3',
                            'fakultas'          => $i->post('fakultas'),
                            'prodi'             => $i->post('prodi'),
                            'status'            => '1',
                            'thn_akademik'      => $get_thn_akademik->id_thn_akademik,
                            'nik'              => $i->post('nik')
          );
          $this->admin_model->tambah_pengguna_admin($pengguna);

          $this->session->set_flashdata('success', 'Data telah di tambahkan');
          redirect(base_url('home/popup/'.$popup),'refresh');
          }else{
          $this->session->set_flashdata('warning', 'Pendaftaran tidak bisa dilakukan karena kalender tahun akademik belum dibuka');
            redirect(base_url('home/pendaftaran'),'refresh');
        }}

        $data = array( 'title'            => 'Formulir Pendaftaran', 
                       'sumber'           => $sumber,  
                       'fakultas'         => $fakultas,
                       'fakultas2'        => $fakultas,
                       'isi'              => 'home/pendaftaran');
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function get_list_prodi(){
        $fakultas = $this->input->post('fakultas');
        $data = $this->admin_model->get_prodi($fakultas);
        echo json_encode($data);
    }

    public function get_gelombang()
    {
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $fakultas = $this->input->post('fakultas');
        $data = $this->admin_model->get_gelombang($fakultas,$id_thn_akademik);
        echo json_encode($data);
    }

    function get_gelombang_admin()
    {
        $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
        $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

        $fakultas=$this->input->post('fakultas');
        $data=$this->admin_model->get_gelombang_admin($fakultas,$id_thn_akademik);
        echo json_encode($data);
    }

    public function popup($popup){

        $popup = $this->admin_model->popup($popup);
        
        $id = $popup->id;

        $detail_pendaftar = $this->admin_model->detail_pendaftaran($id);
        
        $detail_institusi = $this->admin_model->detail_institusi();

        $data = array('title'               => 'Popup Pendaftaran',
                      'detail_pendaftar'    => $detail_pendaftar,
                      'detail_institusi'    => $detail_institusi,
                      'isi'                 => 'popup/list');
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function cetak_popup($popup){

        $popup = $this->admin_model->popup($popup);
        
        $id = $popup->id;

        $gelombang = $popup->gelombang;

        $kode = $popup->jurusan_pilihan;
        
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

    public function lupa_password()
    {

      $this->form_validation->set_rules('username','Username','required',
                  array('requiered' => '%s tidak ditemukan'));
      $this->form_validation->set_rules('email','Email','required',
                  array('requiered' => '%s tidak ditemukan'));

      if ($this->form_validation->run()) {
        $username       = $this->input->post('username');
        $email          = $this->input->post('email');
        //proses ke simpel login
        $this->simple_login->lupa_password($username,$email);
      }

      //end valid 
      $data = array('title'             => 'Halaman Lupa Password',
                    'isi'               => 'home/ubah_password');
      $this->load->view('home/ubah_password', $data, FALSE);
    }

     //halaman password baru
    public function password_baru()
    {

      $username = $this->admin_model->save_password();

      //end valid 
      $data = array('title'            => 'Halaman Ubah Password',
                    'username'         => $username,
                    'isi'              => 'home/password_baru');
      $this->load->view('home/password_baru', $data, FALSE);
    }

    public function save_password(){

      $pengguna         = $this->admin_model->detail_pengguna_username(); 
      $username         = $pengguna->username; 
      $pengguna_user    = $this->admin_model->detail_pendaftaran_pengguna($username); 

      $detail_user    = $this->admin_model->detail_user($username); 

      //validasi input
      $valid = $this->form_validation;

      $valid->set_rules('password','Password','required|min_length[6]',
                 array( 'required'   => '%s harus diisi',
                        'min_length' => '%s minimal 6 karakter'));

      if($valid->run()===FALSE){
        //end validasi

      $data = array( 'title'    => 'Halaman Password Baru',
                     'pengguna_user'     => $pengguna_user,
                     'isi'      => 'home/password_baru');
      $this->load->view('home/password_baru', $data, FALSE);
      }else{

        $i=$this->input;
        $data = array(  'id'          => $pengguna->id,
                        'password'    => md5($i->post('password'))
      );
        $this->admin_model->edit_pengguna($data);

        // jika pengguna mahasiswa
        if($pengguna->id_level == 3) {
          $dataa = array( 'id'          => $pengguna_user->id,
                          'password'    => $i->post('password'));
          $this->admin_model->edit_pendaftaran_password($dataa);

          if($pengguna_user->approve == 1) {
            $data_user = array( 'user_name'    => $pengguna_user->username,
                                'user_password'    => $i->post('password'));
          $this->admin_model->edit_user_tes($data_user);
          }

        }else{
          $data_user = array('username'=> $detail_user->username,
                             'password'    => sha1($i->post('password')));
          $this->admin_model->edit_user($data_user);
        }

        $this->session->set_flashdata('success', 'Password berhasil diubah');
        redirect(base_url('login'),'refresh');
      }
    }

    public function berita($judul_seo) {

    $lihat       = $this->admin_model->judul_seo($judul_seo);

    $data = array('title'           => 'Halaman Berita',
                  'lihat'           => $lihat,
                  'isi'             => 'home/berita'); 
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function semua_berita() {

    $lihat       = $this->admin_model->judul_seo($judul_seo);

    $data = array('title'           => 'Halaman Berita',
                  'lihat'           => $lihat,
                  'isi'             => 'home/berita'); 
    $this->load->view('layout/wrapper', $data, FALSE);
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

  public function lebih_biaya() {
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('home/lebih_biaya');
    $config['total_rows'] = count($this->admin_model->total_lebih_biaya());
    $config['per_page'] = 9;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $lebih_biaya     = $this->admin_model->lebih_biaya($limit,$start);
    //end pagination

    $data = array('title'             => 'Halaman Daftar Biaya Kuliah',
                  'list_biaya'        => $lebih_biaya,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'home/lebih_biaya'); 
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function lebih_berita() {
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('home/lebih_berita');
    $config['total_rows'] = count($this->admin_model->total_lebih_berita());
    $config['per_page'] = 1;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $lebih_berita     = $this->admin_model->lebih_berita($limit,$start);
    //end pagination

    $data = array('title'             => 'Halaman Daftar Semua Berita',
                  'informasi'         => $lebih_berita,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'home/lebih_berita'); 
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function lebih_galeri() {
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('home/lebih_galeri');
    $config['total_rows'] = count($this->admin_model->total_lebih_galeri());
    $config['per_page'] = 9;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $lebih_galeri     = $this->admin_model->lebih_galeri($limit,$start);
    //end pagination

    $data = array('title'             => 'Halaman Daftar Semua Berita',
                  'galeri'            => $lebih_galeri,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'home/lebih_galeri'); 
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function kelulusan() {
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('home/kelulusan');
    $config['total_rows'] = count($this->admin_model->total_kelulusan());
    $config['per_page'] = 200;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $kelulusan     = $this->admin_model->kelulusan($limit,$start);
    //end pagination

    $data = array('title'             => 'Halaman Daftar Semua Berita',
                  'kelulusan'         => $kelulusan,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'home/kelulusan'); 
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function lebih_pendaftar() {
    //pagination
    $this->load->library('pagination');

    $config['base_url'] = base_url('home/lebih_pendaftar');
    $config['total_rows'] = count($this->admin_model->total_lebih_pendaftar());
    $config['per_page'] = 9;
    $config['uri_segment'] = 3;
    //limit
    $limit        = $config['per_page']; 
    $start        = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;

    $this->pagination->initialize($config);
    $pendaftar_terbaru     = $this->admin_model->lebih_pendaftar($limit,$start);
    //end pagination

    $data = array('title'             => 'Halaman Daftar Semua Pndaftar',
                  'pendaftar_terbaru' => $pendaftar_terbaru,
                  'paginasi'          => $this->pagination->create_links(),
                  'isi'               => 'home/lebih_pendaftar'); 
    $this->load->view('layout/wrapper', $data, FALSE);
  }

}