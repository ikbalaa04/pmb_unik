<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); //memanggil database
    }

    //Model Data Pengguna
    public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where(array('username' 	=> $username,
							   'password'   => md5($password)));
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	// public function lupa_password($email)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('pendaftaran');
	// 	$this->db->where(array('email' 	  		=> $email));
	// 	$this->db->order_by('id','desc');
	// 	$query = $this->db->get();
	// 	return $query->row();
	// }

	
	public function listing_pengguna($id_thn_akademik)
	{
		$this->db->select('pengguna.*,
						  level.level,
						  level.id as id_level,
						  fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('pengguna');
		$this->db->where('thn_akademik', $id_thn_akademik);
		$this->db->join('level', 'level.id = pengguna.id_level','left');
		$this->db->join('fakultas', 'fakultas.id = pengguna.fakultas','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function listing_pengguna_admin()
	{
		$this->db->select('pengguna.*,
						  level.level,
						  level.id as id_level,
						  fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('pengguna');
		$this->db->join('level', 'level.id = pengguna.id_level','left');
		$this->db->join('fakultas', 'fakultas.id = pengguna.fakultas','left');
		$this->db->not_like(array('id_level' => '2', 
							      'id_level' => '3'));
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function listing_level()
	{
		$this->db->select('*');
		$this->db->from('level');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function level_cbt()
	{
		$this->db->select('*');
		$this->db->from('user_level');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_pengguna($data){
		$this->db->insert('pengguna',$data);
	}

	public function tambah_user($data_user){
		$this->db->insert('user',$data_user);
	}

	public function tambah_pengguna_admin($pengguna){
		$this->db->insert('pengguna',$pengguna);
	}

	public function delete_pengguna($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('pengguna',$data);
		
	}

	public function delete_user($data_user)
	{
		$this->db->where('username', $data_user['username']);
		$this->db->delete('user',$data_user);
		
	}

	public function detail_pengguna($id)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pengguna_email($email)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('username', $email);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pengguna_admin($username)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('username', $username);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	// public function detail_pengguna_username($username)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('pengguna');
	// 	$this->db->where('username', $username);
	// 	$this->db->order_by('id','desc');
	// 	$query = $this->db->get();
	// 	return $query->row();
	// }

	public function edit_pengguna($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('pengguna',$data);
		
	}

	public function edit_pengguna_admin($pengguna)
	{
		$this->db->where('id', $pengguna['id']);
		$this->db->update('pengguna',$pengguna);
		
	}

	public function edit_user($data_user)
	{
		$this->db->where('username', $data_user['username']);
		$this->db->update('user',$data_user);
		
	}

	public function detail_user($username)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username' , $username);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_pengguna_verifikasi($data_username)
	{
		$this->db->where('id', $data_username['id']);
		$this->db->update('pengguna',$data_username);
		
	}

	public function edit_pengguna_email($dataa)
	{
		$this->db->where('id', $dataa['id']);
		$this->db->update('pengguna',$dataa);
		
	}

	//End Model Data Pengguna

	//institusi
	public function pilih_institusi()
	{
		$this->db->select('*');
		$this->db->from('konfigurasi');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_institusi()
	{
		$this->db->select('*');
		$this->db->from('konfigurasi');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_institusi($data){
		$this->db->where('id', $data['id']);
		$this->db->update('konfigurasi', $data); 
	}
	//end institusi

	//gelombang
	public function list_gelombang($id_thn_akademik)
	{
		$this->db->select('gelombang.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where(array('thn_akademik' => $id_thn_akademik));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_gelombang($data){
		$this->db->insert('gelombang',$data);

	}

	public function pilih_gelombang_fakultas($id_thn_akademik){
 	
		$fakultas = $this->session->userdata('fakultas');

    	$this->db->select('gelombang.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas, 'gelombang.thn_akademik' => $id_thn_akademik));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.fakultas','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function edit_gelombang_fakultas(){
 	
		$awal = date('Y-m-d');
    	$akhir = '2040-01-01';

    	$fakultas = $this->session->userdata('fakultas');
    	$date = date('Y');

    	$this->db->select('gelombang.*, fakultas.singkatan');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas, 
							   'gelombang.tahun'    => $date, 
							   'gelombang.status'   => '1',
        					   'date_end >=' 		=> $awal,
                 			   'date_end <=' 		=> $akhir));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		// $this->db->order_by(array('gelombang.tahun' 		=> '1',
		// 					      'gelombang.fakultas' 		=> '1'));
		$query = $this->db->get();
		return $query->result();
    }

    public function gelombang_verifikasi_fakultas(){
 	

    	$fakultas = $this->session->userdata('fakultas');
    	$date = date('Y');

    	$this->db->select('gelombang.*, fakultas.singkatan');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas, 
							   'gelombang.tahun'    => $date));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		// $this->db->order_by(array('gelombang.tahun' 		=> '1',
		// 					      'gelombang.fakultas' 		=> '1'));
		$query = $this->db->get();
		return $query->result();
    }

    public function pilih_gelombang($id_thn_akademik){

    	$this->db->select('gelombang.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.thn_akademik' => $id_thn_akademik));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.fakultas','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function pilih_gelombang_apt(){

    	$this->db->select('gelombang.*, fakultas.singkatan');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => '4'));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function pilih_gelombang_admin($fakultas){

    	$awal = date('Y-m-d');
    	$akhir = '2040-01-01';

    	$this->db->select('gelombang.*, fakultas.singkatan');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas,
							   'gelombang.status' 	=> '1',
        					   'date_end >=' 		=> $awal,
                 			   'date_end <=' 		=> $akhir));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function edit_verifikasi_gelombang($fakultas){

    	$this->db->select('gelombang.*, fakultas.singkatan');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas,
							   'gelombang.status' 	=> '1'));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function pilih_gelombang_user($fakultas){

    	$this->db->select('gelombang.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function pilih_gelombang_user2($fakultas2){

    	$this->db->select('gelombang.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas2));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		$query = $this->db->get();
		return $query->result();
    }

  //   public function pilih_fakultas(){

  //   	$this->db->select('*');
		// $this->db->from('fakultas');
		// $this->db->order_by('nama_fakultas','asc');
		// $query = $this->db->get();
		// return $query->result();
  //   }

	public function detail_gelombang($id)
	{
		$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_gelombang_id($id_gelombang)
	{
		$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->where('id', $id_gelombang);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function popup_gelombang($gelombang)
	{
		$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->where('id', $gelombang);
		$query = $this->db->get();
		return $query->row();
	}

	// public function accept_gelombang($gelombang)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('gelombang');
	// 	$this->db->where('id', $gelombang);
	// 	$this->db->order_by('id','desc');
	// 	$query = $this->db->get();
	// 	return $query->row();
	// }

	public function edit_gelombang($data){
		$this->db->where('id', $data['id']);
		$this->db->update('gelombang', $data); 
	}

	public function delete_gelombang($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('gelombang',$data);
		
	}

	// no_urut gelombang
    public function no_urut($id_thn_akademik)
	{
		$i= $this->input;
		$gelombang = $i->post('gelombang');
		$prodi = $i->post('prodi');
		
		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 		=> '1',
							   'approve' 	=> '1',
							   'tahun_akademik'	=> $id_thn_akademik,
							   'gelombang'	=> $gelombang,
							   'jurusan_pilihan'=> $prodi
							));
		$this->db->group_by('noujian');
		$this->db->order_by('noujian','asc');
		$query = $this->db->get();
		return $query->result();
    }

    //daftar hadir
    public function daftar_hadir($id_thn_akademik)
	{
		$i= $this->input;
		$gelombang 	= $i->post('gelombang');
		$awal 		= $i->post('awal');
		$akhir 		= $i->post('akhir');
		$prodi 	   	= $this->input->post('prodi');
		
		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 		=> '1',
							   'approve' 	=> '1',
							   'gelombang'	=> $gelombang,
							   'jurusan_pilihan'=> $prodi,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'id >='		=> $awal,
							   'id <='		=> $akhir
							));
		$this->db->group_by('noujian');
		$this->db->order_by('tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function nama_prodi(){
    	$i= $this->input;
		$prodi 	   = $this->input->post('prodi');

    	$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where('kode', $prodi);
		$query = $this->db->get();
		return $query->row();
    }

    public function no_gelombang(){
    	$i= $this->input;
		$gelombang = $i->post('gelombang');

    	$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->where('id', $gelombang);
		$query = $this->db->get();
		return $query->row();
    }

    public function no_fakultas(){
    	$i= $this->input;
		$fakultas = $i->post('fakultas');

    	$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->where('id', $fakultas);
		$query = $this->db->get();
		return $query->row();
    }

    public function fakultas_hadir(){
    	$i= $this->input;
		$gelombang = $i->post('gelombang');
    	$this->db->select('gelombang.*, gelombang.nama as nama_gelombang, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where('gelombang.id', $gelombang);
		$this->db->join('fakultas', 'fakultas.id = gelombang.fakultas','left');
		$query = $this->db->get();
		return $query->row();
    }
    

    public function gelombang_konfirmasi_bayar(){
    	$id = $this->session->userdata('gelombang');

    	$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
    }

     public function gelombang_aktiv()
	{ 

		$this->db->select('gelombang_aktiv.*,
						   gelombang.id,
						   gelombang.nama');
		$this->db->from('gelombang_aktiv');
		$this->db->join('gelombang', 'gelombang.id = gelombang_aktiv.aktiv','left');
		$this->db->group_by('aktiv');
		$query = $this->db->get();
		return $query->result();
    }

     public function gelombang_aktiv_pilih()
	{ 

		$this->db->select('*');
		$this->db->from('gelombang_aktiv');
		$this->db->group_by('id_gelombang');
		$query = $this->db->get();
		return $query->result();
    }


	public function pilih_gelombang_aktiv($id_gelombang, $data){

      $this->db->where('id_gelombang', $id_gelombang);
      $this->db->update('gelombang_aktiv', $data);
	}


    public function edit_gelombang_aktiv($data){
		$this->db->where('id', $data['id']);
		$this->db->update('gelombang', $data); 
	}
	//end gelombang

	//program kuliah
	public function list_program_baru()
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_program()
	{
		$this->db->select('program.*, program.id as kode_program, fakultas.nama_fakultas');
		$this->db->from('program');
		$this->db->join('fakultas','fakultas.id=program.fakultas','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_program_aktif()
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->where('status', 1);
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_program_admin()
	{
		$this->db->select('program.*, program.id as kode_program');
		$this->db->from('program');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_program_fakultas_pendaftar($fakultas)
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->where(array('fakultas' => $fakultas, 'status' => '1' ));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_program_fakultas()
	{


		$this->db->select('program.*, program.id as kode_program');
		$this->db->from('program');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_program($data){
		$this->db->insert('program',$data);

	}

	public function detail_program($id)
	{
		$this->db->select('program.*');
		$this->db->from('program');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_program_kode($kode)
	{
		$this->db->select('program.*');
		$this->db->from('program');
		$this->db->where('kode', $kode);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function kartu_program($program)
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->where('id', $program);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_program($data){
		$this->db->where('id', $data['id']);
		$this->db->update('program', $data); 
	}

	public function delete_program($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('program',$data);
		
	}
	//End Program kuliah

	//jenis pendaftaran
	public function list_jenis()
	{
		$this->db->select('*');
		$this->db->from('jalur');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_jenis($data){
		$this->db->insert('jalur',$data);

	}

	public function detail_jenis($id)
	{
		$this->db->select('*');
		$this->db->from('jalur');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_jenis_kode($kode)
	{
		$this->db->select('*');
		$this->db->from('jalur');
		$this->db->where('kode', $kode);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_jenis($data){
		$this->db->where('id', $data['id']);
		$this->db->update('jalur', $data); 
	}

	public function delete_jenis($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('jalur',$data);
		
	}
	//End jenis daftar

	//prodi
	public function list_prodi()
	{
		$this->db->select('prodi.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('prodi');
		$this->db->join('fakultas','fakultas.id=prodi.fakultas','left');
		$this->db->order_by('fakultas.nama_fakultas','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_prodi_aktif()
	{
		$this->db->select('prodi.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('prodi');
		$this->db->where(array('prodi.status'   => '1'));
		$this->db->join('fakultas','fakultas.id=prodi.fakultas','left');
		$this->db->order_by('fakultas.nama_fakultas','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_prodi_beranda()
	{
		$this->db->select('prodi.*, fakultas.nama_fakultas');
		$this->db->from('prodi');
		$this->db->join('fakultas','fakultas.id=prodi.fakultas','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function fakultas_prodi()
	{
		$fakultas = $this->session->userdata('fakultas');

		$this->db->select('prodi.*, fakultas.singkatan');
		$this->db->from('prodi');
		$this->db->where(array('fakultas'		=> $fakultas,
							   'prodi.status'   => '1'));
		$this->db->join('fakultas','fakultas.id=prodi.fakultas','left');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tampil_prodi_aktif($fakultas)
	{

		$this->db->select('prodi.*, fakultas.singkatan');
		$this->db->from('prodi');
		$this->db->where(array('fakultas'		=> $fakultas,
							   'prodi.status'   => '1'));
		$this->db->join('fakultas','fakultas.id=prodi.fakultas','left');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function admin_prodi($fakultas)
	{

		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where(array('fakultas'=> $fakultas,
							   'status'  => '1'));
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function admin_prodi2($fakultas2)
	{

		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where(array('fakultas'=> $fakultas2,
							   'status'  => '1'));
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function popup_prodi($kode)
	{

		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where('kode', $kode);
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_prodi($data){
		$this->db->insert('prodi',$data);

	}

	public function detail_prodi($id)
	{
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_prodi_kode($kode)
	{
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where('kode', $kode);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function pilihan1($kode1)
	{
		$this->db->select('prodi.id, prodi.kode, prodi.nama, prodi.jenjang');
		$this->db->from('prodi');
		$this->db->where('kode', $kode1);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function pilihan2($kode2)
	{
		$this->db->select('prodi.id, prodi.kode, prodi.nama, prodi.jenjang');
		$this->db->from('prodi');
		$this->db->where('kode', $kode2);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_prodi($data){
		$this->db->where('id', $data['id']);
		$this->db->update('prodi', $data); 
	}

	public function delete_prodi($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('prodi',$data);
		
	}
	//End prodi

	//fakultas
	public function list_fakultas()
	{
		$this->db->select('fakultas.*, konfigurasi.nama');
		$this->db->from('fakultas');
		$this->db->join('konfigurasi','konfigurasi.id=fakultas.id_institusi','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function pilih_fakultas()
	{
		$this->db->select('*');
		$this->db->from('fakultas');
		// $this->db->where('status','1');
		$this->db->order_by('nama_fakultas','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function select_fakultas($fakultas)
	{
		$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->where('id',$fakultas);
		$this->db->order_by('nama_fakultas','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function select_fakultas2($fakultas2)
	{
		$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->where('id',$fakultas2);
		$this->db->order_by('nama_fakultas','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_fakultas($data){
		$this->db->insert('fakultas',$data);

	}

	public function detail_fakultas($id)
	{
		$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function kartu_fakultas($fakultas)
	{
		$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->where('id', $fakultas);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_fakultas($data){
		$this->db->where('id', $data['id']);
		$this->db->update('fakultas', $data); 
	}

	public function delete_fakultas($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('fakultas',$data);
		
	}
	//End fakultas

	//blum bayar
	public function karantina_agen($id_thn_akademik,$kode_agen)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.bukti_bayar, pendaftaran.jenjang, pendaftaran.username, pendaftaran.jenis, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.ipk, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'kode_agen'				=> $kode_agen,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

	public function karantina($id_thn_akademik)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.username, pendaftaran.jenis, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.ipk, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function karantina_fakultas($id_thn_akademik)
	{

		$fakultas = $this->session->userdata('fakultas');
				
		$this->db->select('pendaftaran.id,pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.username,  pendaftaran.program, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.ipk, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.fakultas' 	=> $fakultas,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function karantina_filter($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
				
		$this->db->select('pendaftaran.id, pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.username,  pendaftaran.program, pendaftaran.verifikasi_karantina, pendaftaran.jenjang,  pendaftaran.keterangan_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.ipk, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.jurusan_pilihan' 	=> $prodi,
							   'pendaftaran.gelombang' 	=> $gelombang,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
    }

   
	//verifikasi
	public function verifikasi_agen($id_thn_akademik,$kode_agen)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.kode_agen, pendaftaran.username, pendaftaran.jenis, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.ipk, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'kode_agen'				=> $kode_agen,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function mahasiswa_agen($id_thn_akademik,$kode_agen)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.kode_agen, pendaftaran.noujian, pendaftaran.username, pendaftaran.jenis, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.ipk, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'kode_agen'				=> $kode_agen));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

	public function verifikasi($id_thn_akademik)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.kode_agen, pendaftaran.username, pendaftaran.jenis, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.ipk, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function verifikasi_pmb($id_thn_akademik)
	{

		$fakultas = $this->session->userdata('fakultas');
				
		$this->db->select('pendaftaran.id,pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.username, pendaftaran.kode_agen, pendaftaran.program, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.ipk, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.fakultas' 	=> $fakultas,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function verifikasi_filter($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
		// $tahun     = $this->input->post('tahun');
				
		$this->db->select('pendaftaran.id, pendaftaran.jenjang, pendaftaran.bukti_bayar, pendaftaran.kode_agen, pendaftaran.username,  pendaftaran.program, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.ipk, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.jurusan_pilihan' 	=> $prodi,
							   'pendaftaran.gelombang' 	=> $gelombang,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
    }

	//verifikasi

	// pendaftaran
	public function edit_pendaftaran($data){
      $this->db->where('id', $data['id']);
      $this->db->update('pendaftaran', $data);
	}

	public function edit_pendaftaran_password($dataa){
      $this->db->where('id', $dataa['id']);
      $this->db->update('pendaftaran', $dataa);
	}

	public function tambah_pendaftaran($data){
		$this->db->insert('pendaftaran',$data);
	}

	public function detail_pendaftaran($id)
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftaran_mahasiswa()
	{

		$username  = $this->session->userdata('username');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('username',$username);
		$query = $this->db->get();
		return $query->row();
	}

	public function popup_detail_pendaftaran($popup)
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('popup',$popup);
		$query = $this->db->get();
		return $query->row();
	}

	public function list_chat_mahasiswa($id)
	{

		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where('id_pendaftar',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_chat($data){
		$this->db->insert('chat',$data);

	}

	public function detail_pendaftaran_pengguna($username)
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('username',$username);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//end pendaftaran

	//accept

	public function accept_agen($id_thn_akademik,$kode_agen)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.kode_agen, pendaftaran.username, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.noujian, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.ipk, pendaftaran.fix, pendaftaran.non_fix, pendaftaran.jenis, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'kode_agen'	=> $kode_agen,
							   'bayar' 		=> '1', 
							   'approve' 	=> '1',
							   'fix' 		=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','desc');
		$query = $this->db->get();
		return $query->result();
    }

	public function accept($id_thn_akademik)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.kode_agen, pendaftaran.username, pendaftaran.sumber, pendaftaran.keterangan_sumber,pendaftaran.bukti_bayar,pendaftaran.noujian, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.ipk, pendaftaran.fix, pendaftaran.non_fix, pendaftaran.jenis, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'bayar' 		=> '1', 
							   'approve' 	=> '1',
							   'fix' 		=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function accept_pmb($id_thn_akademik)
	{

		$fakultas = $this->session->userdata('fakultas');
				
		$this->db->select('pendaftaran.id, pendaftaran.kode_agen, pendaftaran.username, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.program, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas,pendaftaran.bukti_bayar, pendaftaran.ipk, pendaftaran.fix, pendaftaran.non_fix, pendaftaran.jurusan_pilihan2, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi,  program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.fakultas' 	=> $fakultas,
							   'bayar' 					=> '1',
							   'approve' 				=> '1',
							   'fix' 					=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function accept_filter($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
		
				
		$this->db->select('pendaftaran.id, pendaftaran.kode_agen, pendaftaran.username, pendaftaran.sumber, pendaftaran.keterangan_sumber,  pendaftaran.program, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.verifikasi_berkas, pendaftaran.bukti_bayar, pendaftaran.ipk, pendaftaran.fix, pendaftaran.non_fix, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2,  pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'								=> $id_thn_akademik,
							   'pendaftaran.gelombang' 						=> $gelombang,
							   'pendaftaran.jurusan_pilihan' 				=> $prodi,
							   'bayar' 										=> '1',
							   // 'pendaftaran.tahun'			=> $tahun,
							   'approve' 									=> '1',
							   'fix' 										=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }

      public function accept_filter_apt()
	{

		$gelombang = $this->input->post('gelombang');
				
		$this->db->select('pendaftaran.id, pendaftaran.program, pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.jenjang, pendaftaran.keterangan_berkas, pendaftaran.bukti_bayar, pendaftaran.ipk, pendaftaran.fix, pendaftaran.non_fix, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang,  pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'bayar' 										=> '1',
							   // 'pendaftaran.tahun'			=> $tahun,
							   'approve' 									=> '1',
							   'fix' 										=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function jadwal_usm_admin($program)

	{

		$i=$this->input;

		$this->db->select('jadwalusm.*,
						  gelombang.nama as G,
						  gedung.nama as GD,
						  jenisusm.nama as J');
		$this->db->from('jadwalusm');
		$this->db->where(array('jadwalusm.program' 						=> $program));
		$this->db->join('gelombang','gelombang.id=jadwalusm.gelombang','left');
		$this->db->join('gedung','gedung.id=jadwalusm.ruang','left');
		$this->db->join('jenisusm','jenisusm.id=jadwalusm.jenis_ujin','left');
		$this->db->order_by('jadwalusm.tgl_ujian','asc');
		$query = $this->db->get();

		return $query->result();

    }

    public function excel_pmb($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'pendaftaran.jurusan_pilihan' 				=> $prodi,
							   'tahun_akademik'								=> $id_thn_akademik,
							   'bayar' 										=> '1',
							   'approve' 									=> '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }


    public function excel_verifikasi($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi     = $this->input->post('prodi');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'tahun_akademik'								=> $id_thn_akademik,
							   'pendaftaran.jurusan_pilihan'				=> $prodi,
							   'bayar' 										=> '1',
							   'approve' 									=> '0',
							   'fix' 										=> '0',
							   'non_fix' 									=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function excel_diterima($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'pendaftaran.jurusan_pilihan' 				=> $prodi,
							   'tahun_akademik'								=> $id_thn_akademik,
							   'bayar' 										=> '1',
							   'approve' 									=> '1',
							   'fix' 										=> '1',
							   'non_fix' 									=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function excel_regis($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
		$registrasi_ulang = $this->input->post('registrasi_ulang');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'bayar' 										=> '1',
							   'pendaftaran.jurusan_pilihan' 				=> $prodi,
							   'tahun_akademik'								=> $id_thn_akademik,
								'registrasi_ulang'							=> $registrasi_ulang,
							   'approve' 									=> '1',
							   'fix' 										=> '1',
							   'non_fix' 									=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function excel_tahunan()
	{	
		$tahun = $this->input->post('tahun');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('year(tanggal_daftar)' => $tahun));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('fakultas.nama_fakultas','asc');
		$this->db->order_by('year(tanggal_daftar)','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function backup_excel()
	{
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('fakultas.nama_fakultas','asc');
		$this->db->order_by('year(tanggal_daftar)','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function excel_pmb_apt()
	{

		$gelombang = $this->input->post('gelombang');
		// $tahun     = $this->input->post('tahun');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'bayar' 										=> '1',
							   // 'pendaftaran.tahun'			=> $tahun,
							   'approve' 									=> '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function excel_karantina($id_thn_akademik)
	{
							   
		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
		// $tahun     = $this->input->post('tahun');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'								=> $id_thn_akademik,
							   'pendaftaran.gelombang' 						=> $gelombang,
							   'pendaftaran.jurusan_pilihan' 				=> $prodi,
							   'bayar' 										=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function excel_lulus()
	{

		$gelombang = $this->input->post('gelombang');
		$prodi 	   = implode("", $this->input->post('prodi'));
		// $tahun     = $this->input->post('tahun');
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $gelombang,
							   'bayar' 										=> '1',
							   // 'pendaftaran.tahun'			=> $tahun,
							   'approve' 									=> '1',
							   'fix' 										=> '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->like('jurusan_pilihan',$prodi, 'after');
		$this->db->order_by('pendaftaran.nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    //sesi urutan daftar hadir
    public function sesi_dari($g,$p)
	{
				
		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $g,
							   'bayar' 										=> '1',
							   'approve' 									=> '1'));
		$this->db->like('jurusan_pilihan',$p, 'after');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }

     public function sesi_dari_apt($g)
	{
				
		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang' 						=> $g,
							   'bayar' 										=> '1',
							   'approve' 									=> '1'));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }


	//end accept

	//diterima
	public function diterima($id_thn_akademik)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.verifikasi_regis, pendaftaran.bukti_regis, pendaftaran.registrasi_ulang, pendaftaran.jenjang, pendaftaran.username, pendaftaran.registrasi_ulang,  pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.noujian, pendaftaran.keterangan_berkas, pendaftaran.fix,  pendaftaran.verifikasi_berkas, pendaftaran.keterangan_berkas, pendaftaran.ipk,  pendaftaran.jenis, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'=> $id_thn_akademik,
							   'bayar' 		=> '1', 
							   'approve' 	=> '1',
							   'fix'		=> '1',
							   'non_fix'	=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function diterima_pmb($id_thn_akademik)
	{

		$fakultas  = $this->session->userdata('fakultas');
				
		$this->db->select('pendaftaran.id, pendaftaran.verifikasi_regis, pendaftaran.bukti_regis,pendaftaran.registrasi_ulang, pendaftaran.username, pendaftaran.jenjang, pendaftaran.registrasi_ulang, pendaftaran.sumber, pendaftaran.verifikasi_berkas, pendaftaran.keterangan_sumber, pendaftaran.program, pendaftaran.keterangan_berkas, pendaftaran.keterangan_berkas, pendaftaran.ipk,  pendaftaran.fix, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi,  program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.fakultas' 	=> $fakultas,
							   'bayar' 					=> '1',
							   'approve' 				=> '1',
							   'fix'				    => '1',
							   'non_fix'				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function diterima_filter($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
				
		$this->db->select('pendaftaran.id, pendaftaran.verifikasi_regis, pendaftaran.bukti_regis,pendaftaran.registrasi_ulang, pendaftaran.username, pendaftaran.jenjang, pendaftaran.registrasi_ulang,  pendaftaran.sumber, pendaftaran.verifikasi_berkas, pendaftaran.keterangan_berkas, pendaftaran.keterangan_sumber, pendaftaran.program, pendaftaran.keterangan_berkas, pendaftaran.ipk, pendaftaran.fix, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'								=> $id_thn_akademik,
							   'pendaftaran.gelombang' 						=> $gelombang,
							   'pendaftaran.jurusan_pilihan'				=> $prodi,
							   'bayar' 										=> '1',
							   // 'pendaftaran.tahun'			=> $tahun,
							   'approve' 									=> '1',
							   'fix'										=> '1',
							   'non_fix'									=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }


    //registrasi ulang
	public function registrasi_ulang($id_thn_akademik)
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.registrasi_ulang, pendaftaran.bukti_regis, pendaftaran.atas_regis, pendaftaran.bank_regis, pendaftaran.tgl_regis,pendaftaran.jenjang, pendaftaran.username, pendaftaran.registrasi_ulang, pendaftaran.verifikasi_regis, pendaftaran.sumber, pendaftaran.keterangan_sumber, pendaftaran.noujian, pendaftaran.keterangan_berkas, pendaftaran.fix, pendaftaran.verifikasi_berkas, pendaftaran.keterangan_berkas, pendaftaran.ipk,  pendaftaran.jenis, pendaftaran.program, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'=> $id_thn_akademik,
							   'bayar' 		=> '1', 
							   'approve' 	=> '1',
							   'fix'		=> '1',
							   'non_fix'	=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function registrasi_ulang_pmb($id_thn_akademik)
	{

		$fakultas  = $this->session->userdata('fakultas');
				
		$this->db->select('pendaftaran.id, pendaftaran.registrasi_ulang, pendaftaran.bukti_regis, pendaftaran.atas_regis, pendaftaran.bank_regis, pendaftaran.tgl_regis,pendaftaran.username, pendaftaran.jenjang, pendaftaran.registrasi_ulang, pendaftaran.verifikasi_regis, pendaftaran.sumber, pendaftaran.verifikasi_berkas, pendaftaran.keterangan_sumber, pendaftaran.program, pendaftaran.keterangan_berkas, pendaftaran.keterangan_berkas,pendaftaran.ipk,  pendaftaran.fix, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi,  program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'			=> $id_thn_akademik,
							   'pendaftaran.fakultas' 	=> $fakultas,
							   'bayar' 					=> '1',
							   'approve' 				=> '1',
							   'fix'				    => '1',
							   'non_fix'				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function registrasi_ulang_filter($id_thn_akademik)
	{

		$gelombang = $this->input->post('gelombang');
		$prodi = $this->input->post('prodi');
		$registrasi_ulang = $this->input->post('registrasi_ulang');

				
		$this->db->select('pendaftaran.id, pendaftaran.registrasi_ulang, pendaftaran.bukti_regis, pendaftaran.atas_regis, pendaftaran.bank_regis, pendaftaran.tgl_regis, pendaftaran.verifikasi_regis,  pendaftaran.username, pendaftaran.jenjang, pendaftaran.registrasi_ulang,  pendaftaran.sumber, pendaftaran.verifikasi_berkas, pendaftaran.keterangan_berkas, pendaftaran.keterangan_sumber, pendaftaran.program, pendaftaran.keterangan_berkas, pendaftaran.ipk, pendaftaran.fix, pendaftaran.noujian, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, pendaftaran.bayar, pendaftaran.approve, pendaftaran.atas_nama, pendaftaran.tgl_bayar, pendaftaran.bank, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, gelombang.nama as nama_gelombang, gelombang.kode as KG, gelombang.tahun as tahun_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'								=> $id_thn_akademik,
							   'pendaftaran.gelombang' 						=> $gelombang,
							   'pendaftaran.jurusan_pilihan'				=> $prodi,
							   'registrasi_ulang'							=> $registrasi_ulang,
							   'bayar' 										=> '1',
							   // 'pendaftaran.tahun'			=> $tahun,
							   'approve' 									=> '1',
							   'fix'										=> '1',
							   'non_fix'									=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.tanggal_update','asc');
		$query = $this->db->get();
		return $query->result();
    }


	//berkas berkas
	  public function view($id){

	  	$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	  }
	  
	 //daftar mahasiswa di admin dan di pengguna


    public function get_fakultas_aktif()
    {
        $this->db->select('*');
        $this->db->from('fakultas');
        $this->db->where('status','1');
        $this->db->order_by('nama_fakultas','asc');
        $query = $this->db->get();
		return $query->result();
    }

    public function get_fakultas()
    {
        $this->db->select('*');
        $this->db->from('fakultas');
        $this->db->order_by('nama_fakultas','asc');
        $query = $this->db->get();
		return $query->result();
    }

    public function get_list_prodi($id_fakultas){
        $hasil=$this->db->query("SELECT * FROM prodi WHERE fakultas='$id_fakultas'");
        return $hasil->result();
    }

    public function get_fakultas_user()
    {
    	$fakultas  = $this->session->userdata('fakultas');

        $this->db->select('*');
        $this->db->from('fakultas');
        $this->db->where(array('status'=>'1', 'id' => $fakultas));
        $this->db->order_by('nama_fakultas','asc');
        $query = $this->db->get();
		return $query->result();
    }

    public function get_prodi($fakultas)
    {

    	$this->db->select('prodi.*, prodi.id as id_prodi');
        $this->db->from('prodi');
        $this->db->where(array('prodi.status' => '1', 'fakultas' => $fakultas));
        $this->db->join('fakultas', 'fakultas.id = prodi.fakultas');
        $this->db->order_by('prodi.nama', 'asc');
        $query = $this->db->get();
		return $query->result();

    }

    public function get_program($fakultas)
    {

    	$this->db->select('program.*, program.id as id_program');
        $this->db->from('program');
        $this->db->where(array('fakultas' => $fakultas));
        $this->db->join('fakultas', 'fakultas.id = program.fakultas');
        $this->db->order_by('program.nama', 'asc');
        $query = $this->db->get();
		return $query->result();

    }

    public function get_gelombang($fakultas,$id_thn_akademik)
    {

    	$awal = date('Y-m-d');
    	$akhir = '2040-01-01';

    	$this->db->select('gelombang.*, fakultas.singkatan');
		$this->db->from('gelombang');
		$this->db->where(array('gelombang.fakultas' => $fakultas,
							   'gelombang.thn_akademik' => $id_thn_akademik,
							   'gelombang.status' 	=> '1',
        					   'date_end >=' 		=> $awal,
                 			   'date_end <=' 		=> $akhir));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('gelombang.tahun','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function get_gelombang_user($fakultas)
    {
    	$awal = date('Y-m-d');
    	$akhir = '2040-01-01';

    	$this->db->select('gelombang.*, gelombang.id as id_gelombang');
        $this->db->from('gelombang');
        $this->db->where(array('fakultas' 	 		=> $fakultas, 
        					   'gelombang.status'	=> '1',
        					   'date_end >=' 		=> $awal,
                 			   'date_end <=' 		=> $akhir));
        $this->db->join('fakultas', 'fakultas.id = gelombang.fakultas');
        $this->db->order_by('gelombang.nama','asc');
        $query = $this->db->get();
		return $query->result();
    }

    public function get_gelombang_admin($fakultas,$id_thn_akademik)
    {

    	$this->db->select('gelombang.*, gelombang.id as id_gelombang');
        $this->db->from('gelombang');
        $this->db->where(array('fakultas' => $fakultas, 'gelombang.thn_akademik' => $id_thn_akademik));
        $this->db->join('fakultas', 'fakultas.id = gelombang.fakultas');
        $this->db->order_by('gelombang.nama','asc');
        $query = $this->db->get();
		return $query->result();
    }

   
	public function popup($popup)
    {
        $this->db->select('*');
        $this->db->from('pendaftaran');
        $this->db->where('popup',$popup);
        $query = $this->db->get();
		return $query->row();
    }

    public function popup_login($id)
    {
        $this->db->select('*');
        $this->db->from('pendaftaran');
        $this->db->where('id',$id);
        $query = $this->db->get();
		return $query->row();
    }

    //end pendaftaran

    //lupa password

    public function lupa_password($username,$email)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where(array('username' => $username, 'email'=> $email));
		$query = $this->db->get();
		return $query->row();
	}

	public function save_password()
	{
		$username = $this->session->userdata('username');

		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where(array('username' => $username));
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pengguna_username()
	{
		$username = $this->session->userdata('username');

		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pengguna_password($username)
	{

		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftar_username()
	{
		$username = $this->session->userdata('username');

		$this->db->select('*');
		$this->db->from('pendaftar');
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	//end lupa password

	//pendaftar di beranda

	public function pendaftar_tes()
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.sekolah_nama,  pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.foto, pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 					=> '1',
							   'approve'				=> '1',
							   'fix'					=> '0',
							   'non_fix'				=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->limit(14);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function pendaftar_konfirmasi()
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.foto, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas,  gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 					=> '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->limit(8);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function pendaftar_terbaru()
	{
				
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.sekolah_nama, pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.foto, pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->limit(12);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    //end pendaftar di beranda

	//berita
	public function berita()
	{

		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('galeri', '0');
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function galeri()
	{

		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('galeri', '1');
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_berita($data){
		$this->db->insert('berita',$data);
	}

	public function detail_berita($id_berita)
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('id_berita', $id_berita);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_berita($data)
	{
		$this->db->where('id_berita', $data['id_berita']);
		$this->db->update('berita',$data);
		
	}

	public function delete_berita($data)
	{
		$this->db->where('id_berita', $data['id_berita']);
		$this->db->delete('berita',$data);
		
	}

	public function informasi()
	{

		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array('status'   => 'Publish', 'galeri' => '0'));
		$this->db->limit(3);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function galeri_beranda()
	{

		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array('status'   => 'Publish', 'galeri' => '1'));
		$this->db->limit(10);
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	//end berita

		//penghasilan
	public function list_penghasilan()
	{
		$this->db->select('*');
		$this->db->from('penghasilan');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//end penghasilan

	//baca berita
	public function judul_seo($judul_seo)
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('judul_seo', $judul_seo);
		$query = $this->db->get();
		return $query->row();
	}
	//end baca berita

	//aktivitas sistem
	public function tambah_aktivitas($data){
		$this->db->insert('aktivitas_sistem',$data);
	}

	public function tambah_aktivitas_home($data_home){
		$this->db->insert('aktivitas_sistem',$data_home);
	}

	public function listing_aktivitas($id_thn_akademik)
	{
		$this->db->select('*');
		$this->db->from('aktivitas_sistem');
		$this->db->where('thn_akademik', $id_thn_akademik);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}


	public function today_farmasi()
	{
		$hari = date('d');
		$bulan = date('m');
		$tahun = date('Y');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('day(tanggal_daftar)'   => $hari,
							   'month(tanggal_daftar)' => $bulan,
							   'year(tanggal_daftar)'  => $tahun));
		$this->db->like('jurusan_pilihan','48', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function today_kimia()
	{
		$hari = date('d');
		$bulan = date('m');
		$tahun = date('Y');


		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('day(tanggal_daftar)'   => $hari,
							   'month(tanggal_daftar)' => $bulan,
							   'year(tanggal_daftar)'  => $tahun));
		$this->db->like('jurusan_pilihan','47', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function today_apoteker()
	{
		$hari = date('d');
		$bulan = date('m');
		$tahun = date('Y');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('day(tanggal_daftar)'   => $hari,
							   'month(tanggal_daftar)' => $bulan,
							   'year(tanggal_daftar)'  => $tahun));
		$this->db->like('jurusan_pilihan','34', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	//total karantina

	public function karantina_farmasi()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' => '0'));
		$this->db->like('jurusan_pilihan','48', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function karantina_kimia()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' => '0'));
		$this->db->like('jurusan_pilihan','47', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function karantina_apoteker()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' => '0'));
		$this->db->like('jurusan_pilihan','34', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	//total verifikasi

	public function verifikasi_farmasi()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' => '1'));
		$this->db->like('jurusan_pilihan','48', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function verifikasi_kimia()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' => '1'));
		$this->db->like('jurusan_pilihan','47', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function verifikasi_apoteker()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' => '1'));
		$this->db->like('jurusan_pilihan','34', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	//total accept

	public function approve_farmasi()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('approve' => '1'));
		$this->db->like('jurusan_pilihan','48', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function approve_kimia()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('approve' => '1'));
		$this->db->like('jurusan_pilihan','47', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function approve_apoteker()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('approve' => '1'));
		$this->db->like('jurusan_pilihan','34', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	//total diterima

	public function diterima_farmasi()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('fix' => '1'));
		$this->db->like('jurusan_pilihan','48', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function diterima_kimia()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('fix' => '1'));
		$this->db->like('jurusan_pilihan','47', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function diterima_apoteker()
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('fix' => '1'));
		$this->db->like('jurusan_pilihan','34', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	//total pertahun

	public function tahun_farmasi()
	{
		$tahun = date('Y');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('year(tanggal_daftar)' => $tahun));
		$this->db->like('jurusan_pilihan','48', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function tahun_kimia()
	{
		$tahun = date('Y');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('year(tanggal_daftar)' => $tahun));
		$this->db->like('jurusan_pilihan','47', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function tahun_apoteker()
	{
		$tahun = date('Y');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('year(tanggal_daftar)' => $tahun));
		$this->db->like('jurusan_pilihan','34', 'after');
		$query = $this->db->get();
		return $query->result();
	}

	public function statistik_pendaftar_tahunan_beranda()
	{
		$tahun = date('Y');

		$this->db->select('pendaftaran.gelombang, count(username) as pendaftar, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang,');
		$this->db->from('pendaftaran');
		$this->db->where(array('year(tanggal_daftar)' => $tahun));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('nama_gelombang','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function statistik_pendaftar_mipa($fakultas)
	{

		$this->db->select('pendaftaran.gelombang, count(username) as pendaftar, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang,');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.fakultas' => $fakultas ));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('pendaftaran.jurusan_pilihan');
		$query = $this->db->get();
		return $query->result();
	}

	//pendaftran per gelombang
	public function total_pendaftar_farmasi()
	{

		$this->db->select('pendaftaran.jurusan_pilihan, pendaftaran.gelombang, sum(bayar=0) as karantina, sum(bayar) as verifikasi, sum(approve) as accept, sum(fix) as fix, pendaftaran.fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang,');
		$this->db->from('pendaftaran');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->like('jurusan_pilihan','48', 'after');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('nama_gelombang','ASC');
		$query = $this->db->get();
		return $query->result();
	}


	public function total_pendaftar_apt()
	{

		$this->db->select('pendaftaran.jurusan_pilihan, pendaftaran.gelombang, sum(bayar=0) as karantina, sum(bayar) as verifikasi, sum(approve) as accept, sum(fix) as fix, pendaftaran.fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang,');
		$this->db->from('pendaftaran');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->like('jurusan_pilihan','34', 'after');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('nama_gelombang','ASC');
		$query = $this->db->get();
		return $query->result();
	}


	public function total_pendaftar()
	{

		$this->db->select('pendaftaran.gelombang, sum(bayar) as verifikasi, sum(approve) as terverifikasi, sum(fix) as fix,  sum(non_fix) as non_fix, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.bayar' => '1', 'jurusan_pilihan' => '32'));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id  = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode  = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('gelombang.nama','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_pendaftar_kimia()
	{

		$this->db->select('pendaftaran.gelombang, sum(bayar) as verifikasi, sum(approve) as terverifikasi, sum(fix) as fix,  sum(non_fix) as non_fix, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.bayar' => '1', 'jurusan_pilihan' => '87'));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id  = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode  = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('gelombang.nama','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_pendaftar_apoteker()
	{

		$this->db->select('pendaftaran.gelombang, sum(bayar) as verifikasi, sum(approve) as terverifikasi, sum(fix) as fix,  sum(non_fix) as non_fix, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.bayar' => '1', 'jurusan_pilihan' => '30'));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id  = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode  = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('gelombang.nama','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_pendaftar_mipa($gelombang)
	{

		$this->db->select('pendaftaran.gelombang, sum(bayar) as verifikasi, sum(approve) as terverifikasi, sum(fix) as fix,  sum(non_fix) as non_fix, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang,');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.bayar' => '1', 'pendaftaran.gelombang' => $gelombang));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id  = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode  = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('pendaftaran.jurusan_pilihan');
		$this->db->order_by('fakultas.nama_fakultas','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_pendaftar_filter()
	{

		$gelombang = $this->input->post('gelombang');
		$fakultas  = $this->input->post('fakultas');

		$this->db->select('pendaftaran.gelombang, sum(bayar) as verifikasi, sum(approve) as terverifikasi, sum(fix) as fix,  sum(non_fix) as non_fix, pendaftaran.fakultas, fakultas.nama_fakultas, gelombang.tahun as tahun_gelombang, gelombang.id as id_gelombang, gelombang.nama as nama_gelombang,');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.bayar' => '1', 'pendaftaran.fakultas' => $fakultas, 'pendaftaran.gelombang' => $gelombang));
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id  = pendaftaran.fakultas','left');
		$this->db->group_by('pendaftaran.gelombang');
		$this->db->order_by('fakultas.nama_fakultas','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	//manage biaya
	public function list_biaya_beranda()
	{
		$this->db->select('biaya.*, fakultas.singkatan, fakultas.nama_fakultas, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('biaya');
		$this->db->where(array('biaya.status' => '1', 'biaya.utama' => '1'));
		$this->db->join('prodi', 'prodi.kode = biaya.prodi','left');
		$this->db->join('fakultas', 'fakultas.id = biaya.fakultas','left');
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}

	public function list_biaya()
	{
		$this->db->select('biaya.*, fakultas.singkatan, fakultas.nama_fakultas, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('biaya');
		$this->db->join('prodi', 'prodi.kode = biaya.prodi','left');
		$this->db->join('fakultas', 'fakultas.id = biaya.fakultas','left');
		$this->db->order_by('biaya.id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_biaya($data){
		$this->db->insert('biaya',$data);

	}

	public function detail_biaya($id)
	{
		$this->db->select('biaya.*, fakultas.nama_fakultas ');
		$this->db->from('biaya');
		$this->db->where('biaya.id', $id);
		$this->db->join('fakultas', 'fakultas.id = biaya.fakultas','left');
		$this->db->order_by('biaya.id','desc');
		$query = $this->db->get();
		return $query->row();
	}


	public function edit_biaya($data){
		$this->db->where('id', $data['id']);
		$this->db->update('biaya', $data); 
	}

	//lebih banyak biaya di beranda
    public function lebih_biaya($limit,$start)
	{
								
		$this->db->select('biaya.*, prodi.nama as nama_prodi, fakultas.nama_fakultas, fakultas.singkatan, prodi.jenjang');
		$this->db->from('biaya');
		$this->db->where('biaya.status', '1');
		$this->db->join('prodi', 'prodi.kode = biaya.prodi','left');
		$this->db->join('fakultas', 'fakultas.id = biaya.fakultas','left');
		$this->db->limit($limit,$start);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_lebih_biaya()
	{
								
		$this->db->select('biaya.*, prodi.nama as nama_prodi, fakultas.nama_fakultas, fakultas.singkatan, prodi.jenjang');
		$this->db->from('biaya');
		$this->db->where('biaya.status', '1');
		$this->db->join('prodi', 'prodi.kode = biaya.prodi','left');
		$this->db->join('fakultas', 'fakultas.id = biaya.fakultas','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    //jenjang
	public function list_jenjang()
	{
		$this->db->select('*');
		$this->db->from('jenjang');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_jenjang_aktif()
	{
		$this->db->select('*');
		$this->db->from('jenjang');
		$this->db->where('status', '1');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_jenjang($id)
	{
		$this->db->select('*');
		$this->db->from('jenjang');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_jenjang($data){
		$this->db->where('id', $data['id']);
		$this->db->update('jenjang', $data); 
	}

	//End jenjang

	public function detail_pengguna_delete($username)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('username', $username);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pengguna_verifikasi($username)
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('username', $username);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function delete_pengguna_user($data_user)
	{
		$this->db->where('username', $data_user['username']);
		$this->db->delete('pengguna',$data_user);
		
	}

	public function delete_karantina($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('pendaftaran',$data);
		
	}

	public function delete_verifikasi($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('pendaftaran',$data);
		
	}

	function delete_pendaftar_username($data)
	{
	    if (!empty($data)) {
        $this->db->where_in('username', $data);
        $this->db->delete('pendaftaran');
    	}
	}

	function delete_user_username($dataa)
	{
	    if (!empty($dataa)) {
        $this->db->where_in('username', $dataa);
        $this->db->delete('pengguna');
    	}
	}

	function delete_user_pilih($data)
	{
	    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->delete('pengguna');
    	}
	}

	function delete_gelombang_banyak($data)
	{
	    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->delete('gelombang');
    	}
	}

	function delete_aktivitas($data)
	{
	    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->delete('aktivitas_sistem');
    	}
	}


	//lebih banyak berita 
    public function lebih_berita($limit,$start)
	{
								
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array('status' => 'Publish', 'galeri' => '0'));
		$this->db->limit($limit,$start);
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_lebih_berita()
	{
								
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array('status' => 'Publish', 'galeri' => '0'));
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get();
		return $query->result();
    }

    //lebih banyak galeri
    public function lebih_galeri($limit,$start)
	{
								
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array('status' => 'Publish', 'galeri' => '1'));
		$this->db->limit($limit,$start);
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_lebih_galeri()
	{
								
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array('status' => 'Publish', 'galeri' => '1'));
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get();
		return $query->result();
    }

    //lebih banyak pendaftar
    public function lebih_pendaftar($limit,$start)
	{
								
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.sekolah_nama, pendaftaran.kampus_asal, pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.foto, pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->limit($limit,$start);
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_lebih_pendaftar()
	{
								
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.sekolah_nama, pendaftaran.kampus_asal, pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.foto, pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kelulusan($limit,$start)
	{	
		$noujian = $this->input->post('noujian');
								
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.username, pendaftaran.sekolah_nama,  pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.foto, pendaftaran.fix, pendaftaran.non_fix,pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('noujian' => $noujian, 'bayar' 	=> '1', 'approve' => '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->limit($limit,$start);
		$this->db->order_by('nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kelulusan()
	{
		$noujian = $this->input->post('noujian');
								
		$this->db->select('pendaftaran.id, pendaftaran.noujian, pendaftaran.username, pendaftaran.sekolah_nama, pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.foto, pendaftaran.fix, pendaftaran.non_fix,  pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('noujian' => $noujian, 'bayar' 	=> '1', 'approve' => '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    
    // sumber_informasi
	public function list_sumber()
	{
		$this->db->select('*');
		$this->db->from('sumber_informasi');
		$this->db->order_by('urutan','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_sumber_aktif()
	{
		$this->db->select('*');
		$this->db->from('sumber_informasi');
		$this->db->where(array('status' => '1'));
		$this->db->order_by('urutan','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_sumber($data){
		$this->db->insert('sumber_informasi',$data);

	}

	public function detail_sumber($id)
	{
		$this->db->select('*');
		$this->db->from('sumber_informasi');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_sumber($data){
		$this->db->where('id', $data['id']);
		$this->db->update('sumber_informasi', $data); 
	}

	public function delete_sumber($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('sumber_informasi',$data);
		
	}
	//End sumber_informasi

	public function kelulusan_login()
	{	
		$fakultas  = $this->input->post('fakultas');
		$gelombang = $this->input->post('gelombang');
								
		$this->db->select('pendaftaran.id, pendaftaran.username, pendaftaran.noujian, pendaftaran.foto, pendaftaran.sekolah_nama, pendaftaran.jenjang, pendaftaran.ipk, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.fix, pendaftaran.non_fix,pendaftaran.program, pendaftaran.jenis, pendaftaran.fakultas, pendaftaran.gelombang, pendaftaran.jurusan_pilihan, pendaftaran.jurusan_pilihan2, pendaftaran.nama_lengkap, pendaftaran.email, pendaftaran.password, pendaftaran.hp, pendaftaran.sekolah_nama, pendaftaran.sekolah_jurusan, pendaftaran.sekolah_nama_jurusan, pendaftaran.program, pendaftaran.tanggal_daftar, prodi.nama as nama_prodi, program.nama as nama_program, fakultas.singkatan, fakultas.nama_fakultas, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.fakultas' => $fakultas, 'pendaftaran.gelombang' => $gelombang, 'bayar' 	=> '1', 'approve' => '1'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.id = pendaftaran.program','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->order_by('nama_lengkap','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function detail_agen_register()
	{
		$this->db->select('*');
		$this->db->from('agen');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function jumlah_agen_mengikuti($kode_agen)
	{

		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where('kepala_agen',$kode_agen);
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_prodi_kode2($kode2)
	{
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->where('kode', $kode2);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_member_koordinator($kode_agen)
	{

		$this->db->select('*');
		$this->db->from('agen_koordinator_pendaftaran');
		$this->db->where('kode_agen',$kode_agen);
		$query = $this->db->get();
		return $query->row();
	}

	public function ambil_tAkademik()
	{
		$this->db->select('*');
		$this->db->from('tahun_akademik');
		$this->db->where(array('status_thn_akademik' => '1'));
		$this->db->limit(1);
		$this->db->order_by('id_thn_akademik','desc');
		$query = $this->db->get();
		return $query->row();
	}


	public function detail_pendaftaran_agen($id)
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id',$id);
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->row();
	}

	public function list_peran()
	{

		$this->db->select('*');
		$this->db->from('komisi');
		$this->db->where('status_komisi',1);
		$this->db->order_by('nama_komisi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_agen_jenis($jenis_komisi)
	{

		$this->db->select('*');
		$this->db->from('komisi');
		$this->db->where('jenis_komisi',$jenis_komisi);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_thn_akademik()
    {

    	$awal = date('Y-m-d');
    	$akhir = '2050-01-01';

    	$this->db->select('*');
		$this->db->from('tahun_akademik');
		$this->db->where(array('status_thn_akademik' 	=> '1',
        					   'berlaku >=' 		=> $awal,
                 			   'berlaku <=' 		=> $akhir));
		$this->db->limit(1);
		$this->db->order_by('id_thn_akademik','desc');
		$query = $this->db->get();
		return $query->row();
    }

    public function tambah_konfirmasi($data2){
		$this->db->insert('maba_konfirmasi_bayar',$data2);
	}

	public function tambah_user_tes($data_tes){
		$this->db->insert('cbt_user',$data_tes);
	}

	public function edit_user_tes($data_user){
		$this->db->where('user_name', $data_user['user_name']);
		$this->db->update('cbt_user', $data_user); 
	}

	public function edit_konfirmasi($data2){
		$this->db->where('kode_agen', $data2['kode_agen']);
		$this->db->update('maba_konfirmasi_bayar', $data2); 
	}

	public function delete_konfirmasi($data_konfirmasi)
	{
		$this->db->where('id_pendaftaran', $data_konfirmasi['id_pendaftaran']);
		$this->db->delete('maba_konfirmasi_bayar',$data_konfirmasi);
		
	}

	public function delete_user_tes($user_tes)
	{
		$this->db->where('user_name', $user_tes['user_name']);
		$this->db->delete('cbt_user',$user_tes);
		
	}

	public function list_thn_akademik()
	{
		$this->db->select('*');
		$this->db->from('tahun_akademik');
		$this->db->order_by('nama_thn_akademik','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_thn_akademik($data){
		$this->db->insert('tahun_akademik',$data);

	}

	public function tambah_grup_tes($data_grup){
		$this->db->insert('cbt_user_grup',$data_grup);

	}

	public function detail_grup_nama($grup_nama)
	{

		$this->db->select('*');
		$this->db->from('cbt_user_grup');
		$this->db->where('grup_nama',$grup_nama);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_thn_akademik($data){
		$this->db->where('id_thn_akademik', $data['id_thn_akademik']);
		$this->db->update('tahun_akademik', $data); 
	}

	public function edit_grup($data_grup){
		$this->db->where('grup_id', $data_grup['grup_id']);
		$this->db->update('cbt_user_grup', $data_grup); 
	}


	public function edit_ambil_thn_akademik($data_ambil){
		$this->db->where('id_thn_akademik', $data_ambil['id_thn_akademik']);
		$this->db->update('tahun_akademik', $data_ambil); 
	}

	public function detail_thn_akademik($id_thn_akademik)
	{

		$this->db->select('*');
		$this->db->from('tahun_akademik');
		$this->db->where('id_thn_akademik',$id_thn_akademik);
		$query = $this->db->get();
		return $query->row();
	}

	public function ambil_detail_thn_akademik()
	{

		$this->db->select('*');
		$this->db->from('tahun_akademik');
		$this->db->where('utama_thn_akademik','1');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function list_jenis_agen()
	{
		$this->db->select('*');
		$this->db->from('komisi');
		$this->db->order_by('id_komisi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_jenis_agen($data){
		$this->db->insert('komisi',$data);

	}

	public function detail_jenis_agen($id_komisi)
	{
		$this->db->select('*');
		$this->db->from('komisi');
		$this->db->where('id_komisi', $id_komisi);
		$this->db->order_by('id_komisi','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_jenis_agen($data){
		$this->db->where('id_komisi', $data['id_komisi']);
		$this->db->update('komisi', $data); 
	}


	public function list_agen()
	{
		$this->db->select('agen.id, agen.nama, agen.status_agen, agen.kode_agen, agen.jenis_agen, komisi.jenis_komisi, komisi.nama_komisi');
		$this->db->from('agen');
		$this->db->join('komisi', 'komisi.jenis_komisi = agen.jenis_agen','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_agen_filter()
	{
		$jenis_agen  = $this->input->post('jenis_agen');

		$this->db->select('agen.id, agen.nama, agen.kode_agen, agen.status_agen, agen.jenis_agen, komisi.jenis_komisi, komisi.nama_komisi');
		$this->db->from('agen');
		$this->db->where('jenis_agen', $jenis_agen);
		$this->db->join('komisi', 'komisi.jenis_komisi = agen.jenis_agen','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_agen($data){
		$this->db->insert('agen',$data);

	}

	public function detail_agen($id)
	{
		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_agen($data){
		$this->db->where('id', $data['id']);
		$this->db->update('agen', $data); 
	}

	public function detail_agen_pengajuan($id_komisi)
    {
		$this->db->select('*');
		$this->db->from('agen_pengajuan');
		$this->db->where('id_komisi',$id_komisi);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_pengajuan($data)
	{
		$this->db->where('id_komisi', $data['id_komisi']);
		$this->db->update('agen_pengajuan',$data);
		
	}

	public function kalkulasi($id_thn_akademik)
	{
		
		$this->db->select('jenis_agen, sum(komisi) as komisi, sum(saldo_pika) as saldo ');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('thn_akademik'	=> $id_thn_akademik
							));
		$this->db->group_by('jenis_agen');
		$this->db->order_by('jenis_agen','asc');
		$query = $this->db->get();
		return $query->result();
    }


    public function total_kalkulasi($id_thn_akademik)
	{
		
		$this->db->select('sum(komisi) as komisi_total, sum(saldo_pika) as saldo_total ');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('thn_akademik'	=> $id_thn_akademik
							));
		$this->db->group_by('thn_akademik', $id_thn_akademik);
		$query = $this->db->get();
		return $query->result();
    }

    public function tampil_fakultas()
	{
		
		$this->db->select('*');
		$this->db->from('fakultas');
		$this->db->group_by('nama_fakultas', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_belum_bayar($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as belum_bayar, gelombang.nama as nama_gelombang, gelombang.id as id_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'				=> $fakultas,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('gelombang', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    


    public function kalkulasi_sudah_bayar($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang, gelombang.id as id_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'				=> $fakultas,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('gelombang', 'asc');
		$query = $this->db->get();
		return $query->result();
    }


    


    public function kalkulasi_terverifikasi($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang, gelombang.id as id_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'				=> $fakultas,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('gelombang', 'asc');
		$query = $this->db->get();
		return $query->result();
    }


    


    public function kalkulasi_diterima($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang, gelombang.id as id_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'			=> $fakultas,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('gelombang', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    


    public function kalkulasi_registrasi($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang, gelombang.id as id_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'			=> $fakultas,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('gelombang', 'asc');
		$query = $this->db->get();
		return $query->result();
    }


    


    public function detail_cbt_user($user_name)
	{
		$this->db->select('*');
		$this->db->from('cbt_user');
		$this->db->where('user_name', $user_name);
		$this->db->order_by('user_id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function list_tes_cbt($user_id)
	{

		$this->db->select('cbt_tes_user.*, cbt_tes.tes_nama');
		$this->db->from('cbt_tes_user');
		$this->db->where('tesuser_user_id',$user_id);
		$this->db->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_user.tesuser_tes_id','left');
		$query = $this->db->get();
		return $query->result();
	}

	public function skor_jawaban_tes($tesuser_id)
	{
		
		$this->db->select('sum(tessoal_nilai) as jumlah_skor');
		$this->db->from('cbt_tes_soal');
		$this->db->where('tessoal_tesuser_id',$tesuser_id);
		$this->db->group_by('tessoal_tesuser_id', $tesuser_id);
		$query = $this->db->get();
		return $query->row();
    }


    //keuangan
	public function keuangan($id_thn_akademik)
	{
				
		$this->db->select('pendaftaran.*, prodi.jenjang, prodi.nama as nama_prodi, prodi.biaya as jumlah_biaya, fakultas.nama_fakultas');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 					=> '1', 
							   'approve' 				=> '1',
							   'tahun_akademik' 			=> $id_thn_akademik));
		$this->db->join('prodi', 'prodi.kode  = pendaftaran.jurusan_pilihan','left');
		$this->db->join('fakultas', 'fakultas.id  = pendaftaran.fakultas','left');
		$this->db->group_by('pendaftaran.jurusan_pilihan','asc');
		$this->db->order_by('prodi.nama','ASC');
		$query = $this->db->get();
		return $query->result();
    }

    public function ambil_approve($kode)
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 					=> '1', 
							   'approve' 				=> '1',
							   'jurusan_pilihan' 		=> $kode));
		$query = $this->db->get();
		return $query->result();
	}

	//upload_berkas
	public function list_berkas_aktif($program)
	{
				
		$this->db->select('berkas.*, program.nama as nama_program');
		$this->db->from('berkas');
		$this->db->where(array('berkas.status' => '1', 'berkas.program' => $program ));
		$this->db->join('program', 'program.id  = berkas.program','left');
		$this->db->order_by('urutan','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function list_berkas()
	{
				
		$this->db->select('berkas.*, program.nama as nama_program');
		$this->db->from('berkas');
		$this->db->join('program', 'program.id  = berkas.program','left');
		$this->db->order_by('program.nama','asc');
		$this->db->order_by('urutan','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function berkas_terupload($id_pendaftar)
	{

		$this->db->select('berkas_masuk.*, berkas.nama_berkas, berkas.besar_berkas, berkas.type_file');
		$this->db->from('berkas_masuk');
		$this->db->where(array('id_pendaftar' => $id_pendaftar));
		$this->db->join('berkas', 'berkas.id_berkas  = berkas_masuk.id_berkas','left');
		$this->db->order_by('berkas.id_berkas','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function detail_berkas_masuk($id_berkas_masuk)
	{
		
		$this->db->select('*');
		$this->db->from('berkas_masuk');
		$this->db->where('id_berkas_masuk',$id_berkas_masuk);
		$query = $this->db->get();
		return $query->row();
    }

    public function cek_detail_berkas_masuk($berkas_file,$id_pendaftar,$program)
	{
		
		$this->db->select('*');
		$this->db->from('berkas_masuk');
		$this->db->where(array('id_pendaftar' => $id_pendaftar, 'id_berkas' => $berkas_file, 'program' => $program));
		$query = $this->db->get();
		return $query->row();
    }

    public function detail_berkas_master($id_berkas)
	{
		
		$this->db->select('*');
		$this->db->from('berkas');
		$this->db->where('id_berkas',$id_berkas);
		$query = $this->db->get();
		return $query->row();
    }

    public function tambah_berkas_masuk($data){
		$this->db->insert('berkas_masuk',$data);

	}
	
	public function edit_berkas_masuk($data){
		$this->db->where('id_berkas_masuk', $data['id_berkas_masuk']);
		$this->db->update('berkas_masuk', $data); 
	}

	public function tambah_berkas($data){
		$this->db->insert('berkas',$data);

	}
	
	public function edit_berkas($data){
		$this->db->where('id_berkas', $data['id_berkas']);
		$this->db->update('berkas', $data); 
	}

	public function detail_berkas_masuk_full($id_berkas_masuk)
	{
		
		$this->db->select('berkas_masuk.*, berkas.nama_berkas, berkas.besar_berkas, berkas.type_file');
		$this->db->from('berkas_masuk');
		$this->db->where('id_berkas_masuk',$id_berkas_masuk);
		$this->db->join('berkas', 'berkas.id_berkas  = berkas_masuk.id_berkas','left');
		$query = $this->db->get();
		return $query->row();
    }

    public function detail_berkas_masuk_pendaftar($id_berkas,$id_pendaftar,$program)
	{
		
		$this->db->select('berkas_masuk.*, berkas.nama_berkas, berkas.besar_berkas, berkas.type_file');
		$this->db->from('berkas_masuk');
		$this->db->where(array('id_pendaftar' => $id_pendaftar, 'berkas_masuk.id_berkas' => $id_berkas, 'berkas_masuk.program' => $program));
		$this->db->join('berkas', 'berkas.id_berkas  = berkas_masuk.id_berkas','left');
		$query = $this->db->get();
		return $query->row();
    }

    public function kalkulasi_pendaftar($id_thn_akademik,$prodi)
	{
		
		$this->db->select('pendaftaran.id, gelombang.nama as nama_gelombang, gelombang.id as id_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'		=> $prodi,
							   'tahun_akademik'			=> $id_thn_akademik
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('gelombang', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function list_kalkulasi_gelombang($fakultas,$id_thn_akademik)
	{
		$this->db->select('gelombang.*, fakultas.singkatan, fakultas.nama_fakultas');
		$this->db->from('gelombang');
		$this->db->where(array('fakultas'		=> $fakultas, 'gelombang.thn_akademik'=> $id_thn_akademik));
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function prodi_pendaftar($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('pendaftaran.id, prodi.nama as nama_prodi, prodi.jenjang, prodi.kode');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.gelombang'	=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('prodi.kode', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_belum_bayar($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as belum_bayar, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan' 		=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_sudah_bayar($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'			=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_terverifikasi($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as terverifikasi, sum(jumlahbayar) as masuk, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'		=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_diterima($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as diterima, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'		=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_gagal($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as gagal, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'		=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '1'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_registrasi($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as registrasi, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'		=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function kalkulasi_prodi_fix_registrasi($id_thn_akademik,$prodi,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as fix_registrasi, prodi.nama as nama_prodi, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('jurusan_pilihan'		=> $prodi,
							   'gelombang'				=> $gelombang,
							   'tahun_akademik'			=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1',
							   'verifikasi_regis' 		=> '1'
							));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('jurusan_pilihan', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    
    //gelombang
    public function total_kalkulasi_belum_bayar_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as belum_bayar, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

     public function total_kalkulasi_sudah_bayar_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_terverifikasi_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as terverifikasi, sum(jumlahbayar) as masuk, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_diterima_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as diterima, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_gagal_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as gagal, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '1'));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_registrasi_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as registrasi, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_fix_registrasi_gelombang($id_thn_akademik,$gelombang)
	{
		
		$this->db->select('count(pendaftaran.id) as fix_registrasi, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('gelombang'	=> $gelombang,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1',
							   'verifikasi_regis' 		=> '1'));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    //fakultas

    public function total_kalkulasi_belum_bayar($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as belum_bayar, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

     public function total_kalkulasi_sudah_bayar($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_terverifikasi($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as terverifikasi, sum(jumlahbayar) as masuk, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_diterima($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as diterima, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_gagal($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as gagal, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '1'));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_registrasi($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as registrasi, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_kalkulasi_fix_registrasi($id_thn_akademik,$fakultas)
	{
		
		$this->db->select('count(pendaftaran.id) as fix_registrasi, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('fakultas.id'	=> $fakultas,
							   'tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1',
							   'verifikasi_regis' 		=> '1'));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$query = $this->db->get();
		return $query->result();
    }

    public function total_seluruh_kalkulasi_belum_bayar($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as belum_bayar, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '0',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }
	public function total_seluruh_kalkulasi_sudah_bayar($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as sudah_bayar, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '0',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }
	public function total_seluruh_kalkulasi_terverifikasi($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as terverifikasi, sum(jumlahbayar) as masuk, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }
	public function total_seluruh_kalkulasi_diterima($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as diterima, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }
    public function total_seluruh_kalkulasi_gagal($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as gagal, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '0',
							   'non_fix' 				=> '1' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }
	public function total_seluruh_kalkulasi_registrasi($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as registrasi, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }
    public function total_seluruh_kalkulasi_fix_registrasi($id_thn_akademik)
	{
		
		$this->db->select('count(pendaftaran.id) as fix_registrasi, gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik,
							   'approve' 				=> '1',
							   'bayar' 					=> '1',
							   'fix' 					=> '1',
							   'non_fix' 				=> '0',
							   'registrasi_ulang' 		=> '1',
							   'verifikasi_regis' 		=> '1' ));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->result();
    }


     public function grafik_bar_pendaftar($id_thn_akademik)
    {
    	$this->db->select('count(pendaftaran.id) as jumlah_pendaftar, prodi.nama, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('prodi.nama','asc');
		$query = $this->db->get();
		return $query->result();
    }

     public function grafik_bar_gelombang($id_thn_akademik)
    {
    	$this->db->select('count(pendaftaran.id) as jumlah_pendaftar, gelombang.nama as nama_gelombang, gelombang.tahun, fakultas.singkatan, fakultas.nama_fakultas ');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik));
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('gelombang','asc');
		$this->db->order_by('fakultas.nama_fakultas','asc');
		$query = $this->db->get();
		return $query->result();
    }


    public function grafik_bar_fakultas($id_thn_akademik)
    {
    	$this->db->select('count(pendaftaran.id) as jumlah_pendaftar, fakultas.singkatan, fakultas.nama_fakultas ');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik));
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->group_by('fakultas','asc');
		$this->db->order_by('fakultas.nama_fakultas','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function grafik_bar_pendaftar_baru($id_thn_akademik)
    {
    	$this->db->select('count(pendaftaran.id) as jumlah_pendaftar, pendaftaran.jurusan_pilihan, prodi.nama, prodi.jenjang');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('prodi.nama','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function grafik_bar_pendaftar_baru_gelombang($id_thn_akademik,$kode)
    {
    	$this->db->select('count(pendaftaran.id) as jumlah_pendaftar, pendaftaran.jurusan_pilihan, gelombang.nama');
		$this->db->from('pendaftaran');
		$this->db->where(array('tahun_akademik'	=> $id_thn_akademik, 'jurusan_pilihan' => $kode));
		$this->db->join('gelombang', 'gelombang.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->group_by('gelombang.nama','asc');
		$query = $this->db->get();
		return $query->result();
    }
	

 }