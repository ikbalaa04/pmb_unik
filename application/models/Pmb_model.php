<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pmb_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); //memanggil database
    }

    public function ganti_password($data){
		$this->db->where('id', $data['id']);
		$this->db->update('pendaftaran', $data); 
	}

    //jadwal_usm
    public function jadwal_usm_uhuy()
	{
		$id = $this->session->userdata('gelombang');

		$this->db->select('jadwalusm.*,
						  gelombang.nama as G,
						  ruang.nama as R,
						  jenisusm.nama as J');
		$this->db->from('jadwalusm');
		$this->db->where('gelombang', $id);
		$this->db->join('gelombang','gelombang.id=jadwalusm.gelombang','left');
		$this->db->join('ruang','ruang.id=jadwalusm.ruang','left');
		$this->db->join('jenisusm','jenisusm.id=jadwalusm.jenis_ujin','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }
    
    // no_urut gelombang
    public function no_urut()
	{
		$i= $this->input;
		$gelombang = $i->post('gelombang');
		
		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 		=> '1',
							   'approve' 	=> '1',
							   'gelombang'	=> $gelombang
							));
		$this->db->group_by('noujian');
		$this->db->order_by('noujian','asc');
		$query = $this->db->get();
		return $query->result();
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


	function pilih_gelombang_aktiv($id_gelombang, $data){

      $this->db->where('id_gelombang', $id_gelombang);
      $this->db->update('gelombang_aktiv', $data);
	}


    public function edit_gelombang_aktiv($data){
		$this->db->where('id', $data['id']);
		$this->db->update('gelombang', $data); 
	}


    public function jalur()
	{
				
		$this->db->select('*');
		$this->db->from('jalur');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
    }

    

    public function verifikasi()
	{
				
		$this->db->select('pendaftaran.*, prodi.nama as nama_prodi, program.nama as nama_program');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 		=> '0',
							   'approve' 	=> '0'));
		$this->db->join('prodi', 'prodi.kode = pendaftaran.jurusan_pilihan','left');
		$this->db->join('program', 'program.kode = pendaftaran.program','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function delete_verifikasi($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('pendaftaran',$data);
		
	}


	function edit_verifikasi($id, $data){
      $this->db->where('id', $id);
      $this->db->update('pendaftaran', $data);
	}


	public function edit_pendaftaran($data){
		$this->db->where('id', $data['id']);
		$this->db->update('pendaftaran', $data); 
	}

	function edit_verifikasi_pendaftaran($id, $data){
	  $id = $this->session->userdata('id');

      $this->db->where('id', $id);
      $this->db->update('pendaftaran', $data);
	}

	function edit_acc($id, $data){
      $this->db->where('id', $id);
      $this->db->update('pendaftaran', $data);
	}

	//model accept mahasiswa
    public function acc()
	{
				
		$this->db->select('pendaftaran.*,
						  prodi.kode as PS,
						  gelombang.kode as G,
						  jalur.kode as J,
						  program.kode as P,
						  konfirmasi_bayar.nama,
						  konfirmasi_bayar.bank,
						  konfirmasi_bayar.tanggal_bayar,
						  konfirmasi_bayar.file
						  ');
		$this->db->from('pendaftaran');
		$this->db->where(array('bayar' 		=> '1'));
		$this->db->join('prodi', 'prodi.kode 			= pendaftaran.pilihan1','left');
		$this->db->join('gelombang', 'gelombang.id  = pendaftaran.gelombang','left');
		$this->db->join('jalur', 'jalur.kode 			= pendaftaran.jalur','left');
		$this->db->join('program', 'program.kode 		= pendaftaran.program','left');
		$this->db->join('konfirmasi_bayar', 'konfirmasi_bayar.pendaftaranid = pendaftaran.id','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    //model camas
     public function cm()
	{
		$i=$this->input;
		$gelombang 		= $i->post('gelombang');
		$program 		= $i->post('program');
		$jenis_daftar 	= $i->post('jenis_daftar');
		$pilihan1 		= $i->post('pilihan1');
		$pilihan2 		= $i->post('pilihan2');
				
		$this->db->select('pendaftaran.*,
						  gelombang.nama as AA,
						  gelombang.biaya as AAA,
						  gelombang.tahun as AAB,
						  jalur.nama as AB,
						  pendidikanterakhir.nama as BC,
						  agama.nama as CD,
						  kewarganegaraan.nama as DE,
						  statussipil.nama as EF,
						  prodi.nama as GH,
						  program.nama as HI,
						  pekerjaan.nama as IJ,
						  penghasilan.nama as JK
						  ');
		$this->db->from('pendaftaran');

		$this->db->where(array('bayar' 		=> '1',
							   'approve' 	=> '1',
							   'gelombang'	=> $gelombang,
							   'program'	=> $program,
							   'jalur'		=> $jenis_daftar,
							   'pilihan1'	=> $pilihan1,
							   'pilihan2'	=> $pilihan2
							));
		$this->db->join('gelombang', 'gelombang.id  					= pendaftaran.gelombang','left');
		$this->db->join('jalur', 'jalur.kode 							= pendaftaran.jalur','left');
		$this->db->join('pendidikanterakhir', 'pendidikanterakhir.kode 	= pendaftaran.ortu_pendidikan','left');
		$this->db->join('agama', 'agama.kode 							= pendaftaran.agama','left');
		$this->db->join('kewarganegaraan', 'kewarganegaraan.kode 		= pendaftaran.kewarganegaraan','left');
		$this->db->join('statussipil', 'statussipil.kode 				= pendaftaran.status_sipil','left');
		$this->db->join('prodi', 'prodi.kode 							= pendaftaran.pilihan1','left');
		$this->db->join('program', 'program.kode 						= pendaftaran.program','left');
		$this->db->join('pekerjaan', 'pekerjaan.kode 					= pendaftaran.ortu_pekerjaan','left');
		$this->db->join('penghasilan', 'penghasilan.kode 				= pendaftaran.ortu_penghasilan','left');

		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function cm_ibu()
	{
		$i=$this->input;
		$gelombang 		= $i->post('gelombang');
		$program 		= $i->post('program');
		$jenis_daftar 	= $i->post('jenis_daftar');
		$pilihan1 		= $i->post('pilihan1');
		$pilihan2 		= $i->post('pilihan2');
				
		$this->db->select('pendaftaran.*,
						  gelombang.nama as AA,
						  gelombang.biaya as AAA,
						  gelombang.tahun as AAB,
						  jalur.nama as AB,
						  pendidikanterakhir.nama as BC,
						  agama.nama as CD,
						  kewarganegaraan.nama as DE,
						  statussipil.nama as EF,
						  prodi.nama as GH,
						  program.nama as HI,
						  pekerjaan.nama as IJ,
						  penghasilan.nama as JK
						  ');
		$this->db->from('pendaftaran');

		$this->db->where(array('bayar' 		=> '1',
							   'approve' 	=> '1',
							   'gelombang'	=> $gelombang,
							   'program'	=> $program,
							   'jalur'		=> $jenis_daftar,
							   'pilihan1'	=> $pilihan1,
							   'pilihan2'	=> $pilihan2
							));
		$this->db->join('gelombang', 'gelombang.id  					= pendaftaran.gelombang','left');
		$this->db->join('jalur', 'jalur.kode 							= pendaftaran.jalur','left');
		$this->db->join('pendidikanterakhir', 'pendidikanterakhir.kode 	= pendaftaran.ortu_ibu_pendidikan','left');
		$this->db->join('agama', 'agama.kode 							= pendaftaran.agama','left');
		$this->db->join('kewarganegaraan', 'kewarganegaraan.kode 		= pendaftaran.kewarganegaraan','left');
		$this->db->join('statussipil', 'statussipil.kode 				= pendaftaran.status_sipil','left');
		$this->db->join('prodi', 'prodi.kode 							= pendaftaran.pilihan1','left');
		$this->db->join('program', 'program.kode 						= pendaftaran.program','left');
		$this->db->join('pekerjaan', 'pekerjaan.kode 					= pendaftaran.ortu_ibu_pekerjaan','left');
		$this->db->join('penghasilan', 'penghasilan.kode 				= pendaftaran.ortu_ibu_penghasilan','left');

		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
    }

    public function listing_cm()
	{

		$this->db->select('pendaftaran.*,
						  prodi.nama as GH,
						  program.nama as HI,
						  ');
		$this->db->from('pendaftaran');

		$this->db->where(array('bayar' 		=> '1',
							   'approve' 	=> '1'
							));
		$this->db->join('prodi', 'prodi.kode 							= pendaftaran.pilihan1','left');
		$this->db->join('program', 'program.kode 						= pendaftaran.program','left');


		$this->db->limit(4);
		$this->db->order_by('id','desc');

		$query = $this->db->get();
		return $query->result();
    }

    public function listing_daftar_mhs()
	{

		$this->db->select('pendaftaran.*,
						  prodi.nama as GH,
						  program.nama as HI,
						  ');
		$this->db->from('pendaftaran');

		$this->db->join('prodi', 'prodi.kode 							= pendaftaran.pilihan1','left');
		$this->db->join('program', 'program.kode 						= pendaftaran.program','left');


		$this->db->limit(20);
		$this->db->order_by('id','desc');

		$query = $this->db->get();
		return $query->result();
    }

     public function listing_daftar_mhs2()
	{

		$this->db->select('pendaftaran.*,
						  prodi.nama as GH,
						  program.nama as HI,
						  ');
		$this->db->from('pendaftaran');

		$this->db->join('prodi', 'prodi.kode 							= pendaftaran.pilihan2','left');
		$this->db->join('program', 'program.kode 						= pendaftaran.program','left');


		$this->db->limit(20);
		$this->db->order_by('id','desc');

		$query = $this->db->get();
		return $query->result();
    }

    public function profil_new()
	{
		
		$id = $this->session->userdata('email');	

		$this->db->select('pendaftaran.*,
						  pendidikanterakhir.nama as BC,
						  agama.nama as CD,
						  kewarganegaraan.nama as DE,
						  statussipil.nama as EF,
						  pekerjaan.nama as IJ,
						  penghasilan.nama as JK
						  ');
		$this->db->from('pendaftaran');
		$this->db->where('email',$id);
		$this->db->join('pendidikanterakhir', 'pendidikanterakhir.id 	= pendaftaran.pendidikan_terakhir','left');
		$this->db->join('agama', 'agama.kode 							= pendaftaran.agama','left');
		$this->db->join('kewarganegaraan', 'kewarganegaraan.kode 		= pendaftaran.kewarganegaraan','left');
		$this->db->join('statussipil', 'statussipil.kode 				= pendaftaran.status_sipil','left');
		$this->db->join('pekerjaan', 'pekerjaan.kode 					= pendaftaran.ortu_pekerjaan','left');
		$this->db->join('penghasilan', 'penghasilan.kode 				= pendaftaran.ortu_penghasilan','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
    }

    public function profil_new_ibu()
	{
		
		$id = $this->session->userdata('email');	

		$this->db->select('pendaftaran.*,
						  pendidikanterakhir.nama as AA,
						  pekerjaan.nama as IJ,
						  penghasilan.nama as JK
						  ');
		$this->db->from('pendaftaran');
		$this->db->where('email',$id);
		$this->db->join('pendidikanterakhir', 'pendidikanterakhir.kode 	= pendaftaran.ortu_ibu_pendidikan','left');
		$this->db->join('pekerjaan', 'pekerjaan.kode 					= pendaftaran.ortu_ibu_pekerjaan','left');
		$this->db->join('penghasilan', 'penghasilan.kode 				= pendaftaran.ortu_ibu_penghasilan','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
    }

    public function profil_new_ayah()
	{
		
		$id = $this->session->userdata('email');	

		$this->db->select('pendaftaran.*,
						  pendidikanterakhir.nama as AA,
						  pekerjaan.nama as IJ,
						  penghasilan.nama as JK
						  ');
		$this->db->from('pendaftaran');
		$this->db->where('email',$id);
		$this->db->join('pendidikanterakhir', 'pendidikanterakhir.kode 	= pendaftaran.ortu_pendidikan','left');
		$this->db->join('pekerjaan', 'pekerjaan.kode 					= pendaftaran.ortu_pekerjaan','left');
		$this->db->join('penghasilan', 'penghasilan.kode 				= pendaftaran.ortu_penghasilan','left');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
    }

    public function tambah_berkas($data){
		$this->db->insert('file_syarat',$data);
	}

	public function listing_berkas(){
		$id = $this->session->userdata('id');	

		$this->db->select('file_syarat.*,
						  syarat.nama as AA,
						  syarat.nama as AB
						  ');
		$this->db->from('file_syarat');
		$this->db->where('idpendaftaran',$id);
		$this->db->join('syarat', 'syarat.id 				= file_syarat.idsyarat','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function listing_berkas_admin(){
		$i = $this->input;
		$id = $i->post('id');	

		$this->db->select('file_syarat.*,
						  syarat.nama as AA,
						  syarat.nama as AB
						  ');
		$this->db->from('file_syarat');
		$this->db->where('idpendaftaran',$id);
		$this->db->join('syarat', 'syarat.id 				= file_syarat.idsyarat','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function pendaftar_admin()
	{
		$i = $this->input;
		$id = $i->post('id');	

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function delete_berkas($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('file_syarat',$data);
		
	}

     public function cm_cetak($id)
	{

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    	public function detail_pendaftar_profil6()
	{
		$i=$this->input;
		$id =$i->post('pilihan1');

		$this->db->select('*,
						  prodi.nama as P');
		$this->db->from('pendaftaran');
		$this->db->where('pilihan1', $id);
		$this->db->join('prodi', 'prodi.kode 			= pendaftaran.pilihan1','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftar_profil7()
	{

		$i=$this->input;
		$id =$i->post('pilihan2');

		$this->db->select('*,
						  prodi.nama as P2');
		$this->db->from('pendaftaran');
		$this->db->where('pilihan2', $id);
		$this->db->join('prodi', 'prodi.kode 			= pendaftaran.pilihan2','left');
		$query = $this->db->get();
		return $query->row();
	}

	 public function jadwal_usm_admin()
	{
		$i=$this->input;
		$id =$i->post('gelombang');

		$this->db->select('jadwalusm.*,
						  gelombang.nama as G,
						  ruang.nama as R,
						  jenisusm.nama as J');
		$this->db->from('jadwalusm');
		$this->db->where('gelombang', $id);
		$this->db->join('gelombang','gelombang.id=jadwalusm.gelombang','left');
		$this->db->join('ruang','ruang.id=jadwalusm.ruang','left');
		$this->db->join('jenisusm','jenisusm.id=jadwalusm.jenis_ujin','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function fakultas()
	{
				
		$this->db->select('*');
		$this->db->from('institusi');		
		$this->db->group_by('kodept');
		$query = $this->db->get();
		return $query->result();
    }

     public function jurusan()
	{
				
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->group_by('kode');
		$query = $this->db->get();
		return $query->result();
    }

    //select program
    public function program()
	{
				
		$this->db->select('*');
		$this->db->from('program');
		$this->db->order_by('kode');
		$query = $this->db->get();
		return $query->result();
    }

    public function jurusan_sekolah()
	{
				
		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->group_by('sekolah_jurusan');
		$query = $this->db->get();
		return $query->result();
    }

    public function tambah($data){
		$this->db->insert('pendaftaran',$data);
	}

	public function list_gelombang()
	{
		$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_gelombang($data){
		$this->db->insert('gelombang',$data);

	}

	public function detail($id)
	{
		$this->db->select('*');
		$this->db->from('gelombang');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_gelombang($data){
		$this->db->where('id', $data['id']);
		$this->db->update('gelombang', $data); 
	}

	public function delete_gelombang($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('gelombang',$data);
		
	}

	//program kuliah
	public function list_program()
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah_program($data){
		$this->db->insert('program',$data);

	}

	public function detail_program($id)
	{
		$this->db->select('*');
		$this->db->from('program');
		$this->db->where('id', $id);
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

	public function edit_jenis($data){
		$this->db->where('id', $data['id']);
		$this->db->update('jalur', $data); 
	}

	public function delete_jenis($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('jalur',$data);
		
	}

	//prodi
	public function list_prodi()
	{
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
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

	public function edit_prodi($data){
		$this->db->where('id', $data['id']);
		$this->db->update('prodi', $data); 
	}

	public function delete_prodi($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('prodi',$data);
		
	}

	public function terakhir()
	{
		$this->db->select('*');
		$this->db->from('konfirmasi_bayar');
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}

	//ker di popup
	public function detail_pendaftar()
	{
		$this->db->select('pendaftaran.*,
						  gelombang.biaya,
						  institusi.namabank,
						  institusi.norekening,');
		$this->db->from('pendaftaran');
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->join('institusi', 'institusi.kodept = pendaftaran.institusi','left');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}


	public function cetak_bukti()
	{
		$i=$this->input;
		$email 		  = $i->post('email'); 
		$passwordasli = $i->post('passwordasli'); 

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where( array (
								 'email'    		=> $email, 
								 'passwordasli'     => $passwordasli
								));
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//end popup

	//manggil saru row pendaftaran
	public function detail_pendaftar_profil()
	{
		$id = $this->session->userdata('email');

		$this->db->select('*,
						  gelombang.nama as G');
		$this->db->from('pendaftaran');
		$this->db->where('email', $id);
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftar_profil2()
	{
		$id = $this->session->userdata('email');

		$this->db->select('*,
						  program.nama as E');
		$this->db->from('pendaftaran');
		$this->db->where('email', $id);
		$this->db->join('program', 'program.kode 		= pendaftaran.program','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftar_profil3()
	{
		$id = $this->session->userdata('email');

		$this->db->select('*,
						  jalur.nama as J');
		$this->db->from('pendaftaran');
		$this->db->where('email', $id);
		$this->db->join('jalur', 'jalur.kode = pendaftaran.jalur','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftar_profil4()
	{
		$id = $this->session->userdata('email');

		$this->db->select('*,
						  prodi.nama as P');
		$this->db->from('pendaftaran');
		$this->db->where('email', $id);
		$this->db->join('prodi', 'prodi.kode 			= pendaftaran.pilihan1','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_pendaftar_profil5()
	{
		$id = $this->session->userdata('email');

		$this->db->select('*,
						  prodi.nama as P2');
		$this->db->from('pendaftaran');
		$this->db->where('email', $id);
		$this->db->join('prodi', 'prodi.kode 			= pendaftaran.pilihan2','left');
		$query = $this->db->get();
		return $query->row();
	}


	//select status sipil
	public function select_statussipil()
	{

		$this->db->select('*');
		$this->db->from('statussipil');
		$this->db->group_by('kode');
		$query = $this->db->get();
		return $query->result();
	}

	//select pendidikan terakhir
	public function select_pendidikan()
	{

		$this->db->select('*');
		$this->db->from('pendidikanterakhir');
		$query = $this->db->get();
		return $query->result();
	}

	//select pekerjaan
	public function select_pekerjaan()
	{

		$this->db->select('*');
		$this->db->from('pekerjaan');
		$query = $this->db->get();
		return $query->result();
	}

	//select penghasilan
	public function select_penghasilan()
	{

		$this->db->select('*');
		$this->db->from('penghasilan');
		$query = $this->db->get();
		return $query->result();
	}

	//select agama
	public function select_agama()
	{

		$this->db->select('*');
		$this->db->from('agama');
		$query = $this->db->get();
		return $query->result();
	}

	//select warganegara
	public function select_warganegara()
	{

		$this->db->select('*');
		$this->db->from('kewarganegaraan');
		$query = $this->db->get();
		return $query->result();
	}

	//select jenissekolah
	public function jenissekolah()
	{

		$this->db->select('*');
		$this->db->from('jenissekolah');
		$query = $this->db->get();
		return $query->result();
	}

	//select 
	public function raja_propinsi()
	{

		$this->db->select('*');
		$this->db->from('raja_propinsi');
		$query = $this->db->get();
		return $query->result();
	}

	public function konfirmasi_bayar($data){
		$this->db->insert('konfirmasi_bayar',$data);

	}

	// public function file_syarat($data){
	// 	$this->db->insert('edu_file_syarat',$data);

	// }
	//end manggil saru row pendaftaran


	//institusi
	public function detail_institusi()
	{
		$this->db->select('*');
		$this->db->from('institusi');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	//institusi
	public function info_pmb()
	{
		$this->db->select('*');
		$this->db->from('info_pmb');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_institusi($data){
		$this->db->where('id', $data['id']);
		$this->db->update('institusi', $data); 
	}
	//end institusi

	public function pendaftar()
	{
		$id = $this->session->userdata('id');

		$this->db->select('*');
		$this->db->from('pendaftaran');
		$this->db->where('id',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}
}