<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maba_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); //memanggil database
    }

    public function detail_maba()
	{
		$id = $this->session->userdata('id_pendaftaran');

		$this->db->select('maba_pendaftaran.*,
						  tbl_kecamatan.nama as kec,
						  tbl_kabupaten.nama as kab,
						  tbl_provinsi.nama as prov,
						  tbl_institusi.nama as nama_institusi,
						  tbl_institusi.namabank,
						  tbl_institusi.norekening,
						  tbl_institusi_gelombang.gelombang as nama_gelombang,
						  tbl_institusi_gelombang.biaya,
						  tbl_institusi_gelombang.angkatan,
						  tbl_institusi_jurusan.jurusan,
						  tbl_institusi_jenis_daftar.jenis_daftar');
		$this->db->from('maba_pendaftaran');
		$this->db->where('maba_pendaftaran.id_pendaftaran',$id);
		$this->db->join('tbl_provinsi', 'tbl_provinsi.id_prov = maba_pendaftaran.provinsi','left');
		$this->db->join('tbl_kabupaten', 'tbl_kabupaten.id_kab = maba_pendaftaran.kabupaten','left');
		$this->db->join('tbl_kecamatan', 'tbl_kecamatan.id_kec = maba_pendaftaran.kecamatan','left');
		$this->db->join('tbl_institusi', 'tbl_institusi.id_institusi = maba_pendaftaran.id_institusi','left');
		$this->db->join('tbl_institusi_gelombang', 'tbl_institusi_gelombang.id_gelombang = maba_pendaftaran.gelombang','left');
		$this->db->join('tbl_institusi_jurusan', 'tbl_institusi_jurusan.id_jurusan = maba_pendaftaran.pilihan1','left');
		$this->db->join('tbl_institusi_jenis_daftar', 'tbl_institusi_jenis_daftar.kode = maba_pendaftaran.jenis_daftar','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function cek_seluruh_maba()
	{

		$this->db->select('*');
		$this->db->from('maba_pendaftaran');
		$this->db->order_by('id_pendaftaran');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_gelombang($id_gelombang)
	{

		$this->db->select('*');
		$this->db->from('tbl_institusi_gelombang');
		$query = $this->db->get();
		return $query->row();
	}


	public function detail_gelombang_agen($id_gelombang)
	{

		$this->db->select('*');
		$this->db->from('tbl_institusi_gelombang');
		$this->db->where('id_gelombang',$id_gelombang);
		$query = $this->db->get();
		return $query->row();
	}
	public function detail_maba_konfirmasi($id_pendaftaran)
	{

		$this->db->select('*');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where('id_pendaftaran',$id_pendaftaran);
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_maba_edit($id_pendaftaran)
	{
		$this->db->select('maba_pendaftaran.*,
						  tbl_kecamatan.nama as kec,
						  tbl_kabupaten.nama as kab,
						  tbl_provinsi.nama as prov,
						  tbl_institusi.nama as nama_institusi,
						  tbl_institusi.namabank,
						  tbl_institusi.norekening,
						  tbl_institusi_gelombang.gelombang as nama_gelombang,
						  tbl_institusi_jurusan.jurusan,
						  tbl_institusi_jenis_daftar.jenis_daftar');
		$this->db->from('maba_pendaftaran');
		$this->db->where('maba_pendaftaran.id_pendaftaran',$id_pendaftaran);
		$this->db->join('tbl_provinsi', 'tbl_provinsi.id_prov = maba_pendaftaran.provinsi','left');
		$this->db->join('tbl_kabupaten', 'tbl_kabupaten.id_kab = maba_pendaftaran.kabupaten','left');
		$this->db->join('tbl_kecamatan', 'tbl_kecamatan.id_kec = maba_pendaftaran.kecamatan','left');
		$this->db->join('tbl_institusi', 'tbl_institusi.id_institusi = maba_pendaftaran.id_institusi','left');
		$this->db->join('tbl_institusi_gelombang', 'tbl_institusi_gelombang.id_gelombang = maba_pendaftaran.gelombang','left');
		$this->db->join('tbl_institusi_jurusan', 'tbl_institusi_jurusan.id_jurusan = maba_pendaftaran.pilihan1','left');
		$this->db->join('tbl_institusi_jenis_daftar', 'tbl_institusi_jenis_daftar.jenis_daftar = maba_pendaftaran.jenis_daftar','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function cek_data_maba()
	{
		$nisn = $this->input->post('nisn');

		$this->db->select('maba_pendaftaran.*,
						  tbl_kecamatan.nama as kec,
						  tbl_kabupaten.nama as kab,
						  tbl_provinsi.nama as prov');
		$this->db->from('maba_pendaftaran');
		$this->db->where('maba_pendaftaran.nisn',$nisn);
		$this->db->join('tbl_provinsi', 'tbl_provinsi.id_prov = maba_pendaftaran.provinsi','left');
		$this->db->join('tbl_kabupaten', 'tbl_kabupaten.id_kab = maba_pendaftaran.kabupaten','left');
		$this->db->join('tbl_kecamatan', 'tbl_kecamatan.id_kec = maba_pendaftaran.kecamatan','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_file_syarat($id_pendaftaran)
	{

		$this->db->select('*');
		$this->db->from('maba_file_syarat');
		$this->db->where('idpendaftaran',$id_pendaftaran);
		$query = $this->db->get();
		return $query->result();
	}

    public function login($email,$password)
	{
		$this->db->select('*');
		$this->db->from('maba_pendaftaran');
		$this->db->where(array('email' 	  	=> $email,
							   'password'	=> md5($password)));
		$this->db->order_by('id_pendaftaran','desc');
		$query = $this->db->get();
		return $query->row();
	}
    
    public function tambah_maba($data){
		$this->db->insert('maba_pendaftaran',$data);
	}

	 public function tambah_konfirmasi($data2){
		$this->db->insert('maba_konfirmasi_bayar',$data2);
	}

	public function edit_pendaftaran_tanpa_id($data){
	  $id_pendaftaran = $this->session->userdata('id_pendaftaran');

      $this->db->where('id_pendaftaran', $id_pendaftaran);
      $this->db->update('maba_pendaftaran', $data);
	}

	public function edit_konfirmasi($data){

      $this->db->where('id_konfirmasi', $data['id_konfirmasi']);
      $this->db->update('maba_konfirmasi_bayar', $data);
	}

	public function lupa_password($email)
	{
		$this->db->select('*');
		$this->db->from('maba_pendaftaran');
		$this->db->where(array('email' 	  		=> $email));
		$this->db->order_by('id_pendaftaran','desc');
		$query = $this->db->get();
		return $query->row();
	}


	public function bantuan_maba($data){
		$this->db->insert('bantuan_maba',$data);
	}

	 public function detail_keluh_maba()
	{
		$id = $this->session->userdata('id_pendaftaran');

		$this->db->select('*');
		$this->db->from('bantuan_maba');
		$this->db->where('id_komen',$id);
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}

	//select agama
	public function select_agama()
	{

		$this->db->select('*');
		$this->db->from('agama');
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	//select pekerjaan
	public function select_pekerjaan()
	{

		$this->db->select('*');
		$this->db->from('pekerjaan');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	//select STATUS SIPIL
	public function select_sipil()
	{

		$this->db->select('*');
		$this->db->from('statussipil');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	//select penghasilan
	public function penghasilan()
	{

		$this->db->select('*');
		$this->db->from('penghasilan');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}

	//select pendidikan terakhir
	public function pendidikanterakhir()
	{

		$this->db->select('*');
		$this->db->from('pendidikanterakhir');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		return $query->result();
	}

    public function edit_pendaftaran($data){
		$this->db->where('id_pendaftaran', $data['id_pendaftaran']);
		$this->db->update('maba_pendaftaran', $data); 
	}

	//chained prov
	public function get_provinsi()
    {
        $this->db->order_by('nama', 'asc');
        return $this->db->get('tbl_provinsi')->result();
    }
    public function get_kota()
    {
        // kita joinkan tabel kota dengan provinsi
        $this->db->select('tbl_kabupaten.*,
        				  tbl_kabupaten.nama as kab');
        $this->db->from('tbl_kabupaten');
        $this->db->join('tbl_provinsi', 'tbl_kabupaten.id_prov = tbl_provinsi.id_prov');
        $this->db->order_by('kab', 'asc');
        $query = $this->db->get();
		return $query->result();
    }
    public function get_kecamatan()
    {
        // kita joinkan tabel kecamatan dengan kota
        $this->db->select('tbl_kecamatan.*,
        				tbl_kecamatan.nama as kec');
        $this->db->from('tbl_kecamatan');
        $this->db->join('tbl_kabupaten', 'tbl_kecamatan.id_kab = tbl_kabupaten.id_kab');
        $this->db->order_by('kec', 'asc');
        $query = $this->db->get();
		return $query->result();
    }
    // untuk edit ambil dari id level paling bawah
    public function get_selected_by_id_kecamatan($id_kec)
    {
        $this->db->where('id_kec', $id_kec);
        $this->db->join('tbl_kabupaten', 'tbl_kecamatan.id_kab = tbl_kabupaten.id_kab');
        $this->db->join('tbl_provinsi', 'tbl_kabupaten.id_prov = tbl_provinsi.id_prov');
        return $this->db->get('tbl_kecamatan')->row();
    }

    //end chained

    //chained kampus

    public function get_institusi()
    {
        $this->db->order_by('nama', 'asc');
        return $this->db->get('tbl_institusi')->result();
    }

     public function get_jurusan()
    {
        // kita joinkan tabel kota dengan provinsi
        $this->db->select('tbl_institusi_jurusan.*','tbl_institusi_jurusan.jurusan');
        $this->db->from('tbl_institusi_jurusan');
        $this->db->where('tbl_institusi_jurusan.status','1');
        $this->db->join('tbl_institusi', 'tbl_institusi_jurusan.id_institusi = tbl_institusi.id_institusi');
        $this->db->order_by('tbl_institusi_jurusan.jurusan', 'asc');
        $query = $this->db->get();
		return $query->result();
    }

     public function jenis_daftar()
    {
        // kita joinkan tabel program dengan provinsi
        $this->db->select('*');
        $this->db->from('tbl_institusi_jenis_daftar');
        $this->db->order_by('jenis_daftar', 'asc');
        $query = $this->db->get();
		return $query->result();
    }

     public function get_program()
    {
        // kita joinkan tabel program dengan provinsi
        $this->db->select('tbl_institusi_program.*');
        $this->db->from('tbl_institusi_program');
        $this->db->join('tbl_institusi', 'tbl_institusi_program.id_institusi = tbl_institusi.id_institusi');
        $this->db->order_by('tbl_institusi_program.program', 'asc');
        $query = $this->db->get();
		return $query->result();
    }

     public function get_gelombang()
    {
        // kita joinkan tabel gelombang dengan jurusan
        $this->db->select('tbl_institusi_gelombang.*');
        $this->db->from('tbl_institusi_gelombang');
        $this->db->where('tbl_institusi_gelombang.aktiv','1');
        $this->db->join('tbl_institusi_jurusan', 'tbl_institusi_gelombang.id_jurusan = tbl_institusi_jurusan.id_jurusan');
        $this->db->order_by('tbl_institusi_gelombang.gelombang', 'asc');
        $query = $this->db->get();
		return $query->result();
    }

    // untuk edit ambil dari id level paling bawah
    public function get_selected_by_id_gelombang($id_gelombang)
    {
        $this->db->where('id_gelombang', $id_gelombang);
        $this->db->join('tbl_institusi_jurusan', 'tbl_institusi_gelombang.id_jurusan = tbl_institusi_jurusan.id_jurusan');
        $this->db->join('tbl_institusi', 'tbl_institusi_jurusan.id_institusi = tbl_institusi.id_institusi');
        return $this->db->get('tbl_institusi_gelombang')->row();
    }

     // untuk edit ambil dari id level paling bawah admin
    public function get_selected_by_id_jurusan($id_jurusan)
    {
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->join('tbl_institusi', 'tbl_institusi_jurusan.id_institusi = tbl_institusi.id_institusi');
        return $this->db->get('tbl_institusi_jurusan')->row();
    }

     public function ambil_gelombang($id_gelombang)
    {
        $this->db->select('*');
        $this->db->from('tbl_institusi_gelombang');
        $this->db->where('id_gelombang',$id_gelombang);
        $query = $this->db->get();
		return $query->row();
    }

     public function ambil_institusi($id_institusi)
    {
        $this->db->select('*');
        $this->db->from('tbl_institusi');
        $this->db->where('id_institusi',$id_institusi);
        $query = $this->db->get();
		return $query->row();
    }

    public function ambil_maba($popup)
    {
        $this->db->select('*');
        $this->db->from('maba_pendaftaran');
        $this->db->where('popup',$popup);
        $query = $this->db->get();
		return $query->row();
    }



}