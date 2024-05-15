<?php
defined('BASEPATH') OR exit('No direct script cmess allowed');

class Usm extends CI_CONTROLLER
{
    public function __construct(){
    parent::__construct();
    $this->load->model('usm_model');
    $this->load->model('admin_model');
    $this->simple_login->cek_login();
    }

    //Gedung
    public function gedung(){

        $gedung = $this->usm_model->gedung();

        $data = array( 'title'          => 'Halaman Gedung',
                       'gedung'     		=> $gedung,
                       'isi'            => 'admin/usm/gedung/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah(){

      $valid = $this->form_validation;

      $valid->set_rules( 'kode','Kode gedung','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Gedung',
                    'isi'         => 'admin/usm/gedung/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'nama'              => $i->post('nama'),
                        'kode'              => $i->post('kode')
      );
        $this->usm_model->tambah_gedung($data);
        $this->session->set_flashdata('sukses', 'Data gedung telah ditambahkan');
        redirect(base_url('admin/usm/gedung'),'refresh');
      }

    }

    public function edit($id){

    $detail_gedung = $this->usm_model->detail_gedung($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'kode','Kode gedung','required',
                array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'                   => 'Halaman Edit Gedung',
                   'detail_gedung'           => $detail_gedung, 
                   'isi'                     => 'admin/usm/gedung/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array( 'id'                => $id,
                     'nama'              => $i->post('nama'),
                     'kode'              => $i->post('kode')
      );
      $this->usm_model->edit_gedung($data);
      $this->session->set_flashdata('sukses', 'Data telah diedit');
      redirect(base_url('admin/usm/gedung'),'refresh');
    }
  }

  	public function delete($id){
      $data=array('id' => $id);
      $this->usm_model->delete_gedung($data);
      $this->session->set_flashdata('sukses', 'Data telah di hapus');
      redirect(base_url('admin/usm/gedung'),'refresh');
  }

  	 //End Gedung

  //Jenis usm
    public function jenis_usm(){

        $jenis_usm = $this->usm_model->jenis_usm();

        $data = array( 'title'          	=> 'Halaman Jenis USM',
                       'jenis_usm'     		=> $jenis_usm,
                       'isi'            	=> 'admin/usm/jenis_usm/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_jenis_usm(){

      $valid = $this->form_validation;

      $valid->set_rules( 'nama','Nama jenis','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      => 'Halaman Tambah Jenis USM',
                    'isi'         => 'admin/usm/jenis_usm/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'nama'              => $i->post('nama')
      );
        $this->usm_model->tambah_jenis_usm($data);
        $this->session->set_flashdata('sukses', 'Data Jenis telah ditambahkan');
        redirect(base_url('admin/usm/jenis_usm'),'refresh');
      }

    }

    public function edit_jenis_usm($id){

    $detail_jenis_usm = $this->usm_model->detail_jenis_usm($id); 

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama jenis','required',
                array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'                  => 'Halaman Edit Jenis USM',
                   'detail_jenis_usm'       => $detail_jenis_usm, 
                   'isi'                    => 'admin/usm/jenis_usm/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                => $id,
                        'nama'              => $i->post('nama')
      );
      $this->usm_model->edit_jenis_usm($data);
      $this->session->set_flashdata('sukses', 'Data telah diedit');
      redirect(base_url('admin/usm/jenis_usm'),'refresh');
    }
  }

  	public function delete_jenis_usm($id){
      $data=array('id' => $id);
      $this->usm_model->delete_jenis_usm($data);
      $this->session->set_flashdata('sukses', 'Data telah di hapus');
      redirect(base_url('admin/usm/jenis_usm'),'refresh');
  }

  	 //End Gedung


  	// ruang
    public function ruang(){

        $ruang = $this->usm_model->ruang();

        $data = array( 'title'          => 'Halaman Jenis USM',
                       'ruang'     			=> $ruang,
                       'isi'            => 'admin/usm/ruang/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_ruang(){

      $jenis_usm = $this->usm_model->jenis_usm();
      $gedung    = $this->usm_model->gedung();
      $valid     = $this->form_validation;

      $valid->set_rules( 'nama','Nama Ruang','required',
                  array( 'required' => '%s harus diisi'));

      $valid->set_rules( 'kode_gedung','Nama Gedung','required',
                  array( 'required' => '%s harus diisi'));

      $valid->set_rules( 'idjenis','Jenis USM','required',
                  array( 'required' => '%s harus diisi'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'            => 'Halaman Tambah ruang',
                     'jenis_usm'        => $jenis_usm, 
                     'gedung'           => $gedung, 
                     'isi'              => 'admin/usm/ruang/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'kode_gedung'           => $i->post('kode_gedung'),
                        'idjenis'               => $i->post('idjenis'),
        				        'nama'              		=> $i->post('nama'),
                        'lantai'              	=> $i->post('lantai')
      );
        $this->usm_model->tambah_ruang($data);
        $this->session->set_flashdata('sukses', 'Data Jenis telah ditambahkan');
        redirect(base_url('admin/usm/ruang'),'refresh');
      }

    }

    public function edit_ruang($id){

    $detail_ruang = $this->usm_model->detail_ruang($id); 
    $jenis_usm = $this->usm_model->jenis_usm();
    $gedung    = $this->usm_model->gedung();

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'nama','Nama Ruang','required',
                  array( 'required' => '%s harus diisi'));

    $valid->set_rules( 'kode_gedung','Nama Gedung','required',
                  array( 'required' => '%s harus diisi'));

      $valid->set_rules( 'idjenis','Jenis USM','required',
                  array( 'required' => '%s harus diisi'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array( 'title'            => 'Halaman Edit Ruang',
                   'detail_ruang'     => $detail_ruang, 
                   'jenis_usm'        => $jenis_usm, 
                   'gedung'           => $gedung,
                   'isi'              => 'admin/usm/ruang/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                		=> $id,
                        'kode_gedung'           => $i->post('kode_gedung'),
                        'idjenis'               => $i->post('idjenis'),
                        'nama'                  => $i->post('nama'),
                        'lantai'                => $i->post('lantai')
      );
      $this->usm_model->edit_ruang($data);
      $this->session->set_flashdata('sukses', 'Data telah diedit');
      redirect(base_url('admin/usm/ruang'),'refresh');
    }
  }

  	public function delete_ruang($id){
      $data=array('id' => $id);
      $this->usm_model->delete_ruang($data);
      $this->session->set_flashdata('sukses', 'Data telah di hapus');
      redirect(base_url('admin/usm/ruang'),'refresh');
  }

  	 //End ruang


  	// jadwal usm
    public function jadwal_usm(){

        $jadwal_usm = $this->usm_model->jadwal_usm();
        

        $data = array( 'title'          	=> 'Halaman Jadwal USM',
                       'jadwal_usm'     	=> $jadwal_usm,
                       'isi'            	=> 'admin/usm/jadwal_usm/list');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_jadwal_usm(){

      $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
      $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

      $gedung       = $this->usm_model->gedung();
      $jenis       = $this->usm_model->jenis_usm();

      if ($this->session->userdata('id_level')=='1') {
          $gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);

      }elseif($this->session->userdata('id_level')=='2'){
          $gelombang   = $this->admin_model->pilih_gelombang_fakultas($id_thn_akademik);
      }

      $valid = $this->form_validation;

       $valid->set_rules( 'program','Program','required',
                    array( 'required' => '%s harus dipilih'));

      if($valid->run()===FALSE){
      //end validasi
       $data = array('title'      		=> 'Halaman Tambah Jadwal USM',
      			       	 'gelombang'     	=> $gelombang,
      			       	 'gedung'     		=> $gedung,
      			       	 'jenis'     		  => $jenis,
                     'isi'         		=> 'admin/usm/jadwal_usm/tambah');
        $this->load->view('admin/layout/wrapper', $data, FALSE);
      
      }else{

        $i=$this->input;
        $data = array(  'gelombang'             => $i->post('gelombang'),
                        'prodi'                 => $i->post('prodi'),
                        'ruang'              		=> $i->post('gedung'),
        				        'jenis_ujin'            => $i->post('jenis_ujin'),
        				        'tgl_ujian'             => $i->post('tgl_ujian'),
                        'jam_mulai'             => $i->post('jam_mulai'),
        				        'jam_selesai'           => $i->post('jam_selesai'),
                        'program'           => $i->post('program')
      );
        $this->usm_model->tambah_jadwal_usm($data);
        $this->session->set_flashdata('sukses', 'Data Jenis telah ditambahkan');
        redirect(base_url('admin/usm/jadwal_usm'),'refresh');
      }

    }

    public function edit_jadwal_usm($id){

    $detail_jadwal_usm  = $this->usm_model->detail_jadwal_usm($id); 
    $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
      $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

      if ($this->session->userdata('id_level')=='1') {
          $gelombang   = $this->admin_model->pilih_gelombang($id_thn_akademik);
      }elseif($this->session->userdata('id_level')=='2'){
          $gelombang   = $this->admin_model->pilih_gelombang_fakultas($id_thn_akademik);
      }

    $gedung     = $this->usm_model->gedung();
    $jenis     = $this->usm_model->jenis_usm();

    //validasi input
    $valid = $this->form_validation;

    $valid->set_rules( 'program','Program','required',
                    array( 'required' => '%s harus dipilih'));

    if($valid->run()===FALSE){
      //end validasi

    $data = array(  'title'               => 'Halaman Edit Jadwal USM',
                    'detail_jadwal_usm'   => $detail_jadwal_usm, 
                    'gelombang'     		  => $gelombang,
			       	      'gedung'     			    => $gedung,
			       	      'jenis'     			    => $jenis,
                    'isi'                 => 'admin/usm/jadwal_usm/edit');
    $this->load->view('admin/layout/wrapper', $data, FALSE);
    }else{
      $i=$this->input;
      $data = array(    'id'                		=> $id,
                        'gelombang'             => $i->post('gelombang'),
                        'prodi'                 => $i->post('prodi'),
                        'ruang'              		=> $i->post('gedung'),
                				'jenis_ujin'            => $i->post('jenis_ujin'),
                				'tgl_ujian'             => $i->post('tgl_ujian'),
                        'jam_mulai'             => $i->post('jam_mulai'),
        				        'jam_selesai'           => $i->post('jam_selesai'),
                        'program'           => $i->post('program')
      );
      $this->usm_model->edit_jadwal_usm($data);
      $this->session->set_flashdata('sukses', 'Data telah diedit');
      redirect(base_url('admin/usm/jadwal_usm'),'refresh');
    }
  }

  	public function delete_jadwal_usm($id){
      $data=array('id' => $id);
      $this->usm_model->delete_jadwal_usm($data);
      $this->session->set_flashdata('sukses', 'Data telah di hapus');
      redirect(base_url('admin/usm/jadwal_usm'),'refresh');
  }

  	 //End jadwal usm
}