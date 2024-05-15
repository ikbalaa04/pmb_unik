<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agen_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); //memanggil database
    }

    public function tambah_koordinator($data2){
		$this->db->insert('agen_koordinator',$data2);
	}

    public function detail_agen()
	{
		$id = $this->session->userdata('id');

		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where('id',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_agen_admin($kode_agen)
	{

		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where('kode_agen',$kode_agen);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_agen_popup($popup)
	{

		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where('popup',$popup);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_agen_kode($kode_agen)
	{

		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where('kode_agen',$kode_agen);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_jumlah_agen($kode_agen)
	{

		$this->db->select('*');
		$this->db->from('agen_koordinator');
		$this->db->where('kode_agen',$kode_agen);
		$query = $this->db->get();
		return $query->row();
	}

	//list_mahasiswa
	public function list_maba_agen($kode_agen)
	{

		$this->db->select('pendaftaran.*,
						  fakultas.nama_fakultas,
						  gelombang.nama as nama_gelombang,
						  agen.nama');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.kode_agen' => $kode_agen,
							   'pendaftaran.bayar'		=> '1'));
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.id_institusi','left');
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//detail_agen
	public function detai_list_maba_agen($kode_agen)
	{

		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where(array('kode_agen' => $kode_agen));
		$query = $this->db->get();
		return $query->row();
	}

	//list_mahasiswa
	public function list_mahasiswa($limit,$start)
	{
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('pendaftaran.*,
						  fakultas.nama_fakultas,
						  gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.kode_agen' => $kode_agen));
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->limit($limit,$start);
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_list_mahasiswa()
	{
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('pendaftaran.*,
						  fakultas.nama_fakultas,
						  gelombang.nama as nama_gelombang');
		$this->db->from('pendaftaran');
		$this->db->where(array('pendaftaran.kode_agen' => $kode_agen));
		$this->db->join('fakultas', 'fakultas.id = pendaftaran.fakultas','left');
		$this->db->join('gelombang', 'gelombang.id = pendaftaran.gelombang','left');
		$this->db->order_by('pendaftaran.id','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//Pencarian umum di frontand
	public function cari($keywords,$limit,$start)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('pendaftaran.*,
						  tbl_institusi.nama as nama_institusi,
						  tbl_institusi_jurusan.jurusan,
						  tbl_institusi_gelombang.gelombang');
		$this->db->from('pendaftaran');
		$this->db->where('kode_agen',$kode_agen);
		$this->db->join('tbl_institusi', 'tbl_institusi.id_institusi = pendaftaran.id_institusi','left');
		$this->db->join('tbl_institusi_gelombang', 'tbl_institusi_gelombang.id_gelombang = pendaftaran.gelombang','left');
		$this->db->join('tbl_institusi_jurusan', 'tbl_institusi_jurusan.id_jurusan = pendaftaran.pilihan1','left');
		//like
		$this->db->limit($limit,$start);
		$this->db->like('nama_lengkap',$keywords);
		$this->db->order_by('id_pendaftaran','desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_cari($keywords)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('pendaftaran.*,
						  tbl_institusi.nama as nama_institusi,
						  tbl_institusi_jurusan.jurusan,
						  tbl_institusi_gelombang.gelombang');
		$this->db->from('pendaftaran');
		$this->db->where('kode_agen',$kode_agen);
		$this->db->join('tbl_institusi', 'tbl_institusi.id_institusi = pendaftaran.id_institusi','left');
		$this->db->join('tbl_institusi_gelombang', 'tbl_institusi_gelombang.id_gelombang = pendaftaran.gelombang','left');
		$this->db->join('tbl_institusi_jurusan', 'tbl_institusi_jurusan.id_jurusan = pendaftaran.pilihan1','left');
		//like
		$this->db->like('nama_lengkap',$keywords);
		$this->db->order_by('id_pendaftaran','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//end list_mahasiswa

    public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where(array('username' 	  	=> $username,
							   'password'	    => md5($password)));
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function lupa_password($username,$email)
	{
		$this->db->select('*');
		$this->db->from('agen');
		$this->db->where(array('username'	=> $username, 'email'	=> $email));
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	 public function ubah_agen($data){
		$this->db->where('id', $data['id']);
		$this->db->update('agen', $data); 
	}

    public function tambah_agen($data){
		$this->db->insert('agen',$data);
	}

	public function bantuan_agen($data){
		$this->db->insert('bantuan_agen',$data);
	}

	 public function detail_keluh_agen()
	{
		$id = $this->session->userdata('id');

		$this->db->select('*');
		$this->db->from('bantuan_agen');
		$this->db->where('komen_agen',$id);
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

	public function select_kecamatan()
	{

		$this->db->select('*');
		$this->db->from('tbl_kecamatan');
		$query = $this->db->get();
		return $query->result();
	}

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

    public function edit_agen($data){
		$this->db->where('id', $data['id']);
		$this->db->update('agen', $data); 
	}


	 public function detail_maba($id_pendaftaran)
	{

		$this->db->select('pendaftaran.*,
						  tbl_institusi.nama as nama_institusi,
						  tbl_institusi.namabank,
						  tbl_institusi.norekening,
						  tbl_institusi_gelombang.biaya,
						  tbl_institusi_gelombang.angkatan,
						  tbl_institusi_gelombang.gelombang as nama_gelombang,
						  tbl_institusi_jurusan.jurusan,
						  tbl_institusi_jenis_daftar.jenis_daftar');
		$this->db->from('pendaftaran');
		$this->db->where('pendaftaran.id_pendaftaran',$id_pendaftaran);
		$this->db->join('tbl_institusi', 'tbl_institusi.id_institusi = pendaftaran.id_institusi','left');
		$this->db->join('tbl_institusi_gelombang', 'tbl_institusi_gelombang.id_gelombang = pendaftaran.gelombang','left');
		$this->db->join('tbl_institusi_jurusan', 'tbl_institusi_jurusan.id_jurusan = pendaftaran.pilihan1','left');
		$this->db->join('tbl_institusi_jenis_daftar', 'tbl_institusi_jenis_daftar.kode = pendaftaran.jenis_daftar','left');
		$query = $this->db->get();
		return $query->row();
	}

	public function detail_maba_konfirmasi($id_pendaftaran)
	{

		$this->db->select('*');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('id_pendaftaran' => $id_pendaftaran,
							   'type_komisi'    => 'Pendaftaran Mahasiswa Baru'));
		$query = $this->db->get();
		return $query->row();
	}


	public function edit_pendaftaran_tanpa_id($data){

      $this->db->where('id_pendaftaran', $data['id_pendaftaran']);
      $this->db->update('pendaftaran', $data);
	}

	 public function detail_keluh_maba($id_pendaftaran)
	{

		$this->db->select('*');
		$this->db->from('bantuan_maba');
		$this->db->where('id_komen',$id_pendaftaran);
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}


	//komisi agen
	public function komisi_agen($limit,$start,$id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('maba_konfirmasi_bayar.*,pendaftaran.nama_lengkap');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('maba_konfirmasi_bayar.kode_agen' => $kode_agen, 'thn_akademik' => $id_thn_akademik));
		$this->db->join('pendaftaran', 'pendaftaran.id = maba_konfirmasi_bayar.id_pendaftaran','left');
		//like
		$this->db->limit($limit,$start);
		$this->db->order_by('maba_konfirmasi_bayar.id_konfirmasi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	//total komisi agen
	public function total_komisi_agen($id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('maba_konfirmasi_bayar.*,pendaftaran.nama_lengkap');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('maba_konfirmasi_bayar.kode_agen' => $kode_agen, 'thn_akademik' => $id_thn_akademik));
		$this->db->join('pendaftaran', 'pendaftaran.id = maba_konfirmasi_bayar.id_pendaftaran','left');
		$this->db->order_by('maba_konfirmasi_bayar.id_konfirmasi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah_komisi_agen($id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(komisi) as jumlah_komisi, count(komisi) as total_maba, kode_agen');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('kode_agen' => $kode_agen, 'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	public function jumlah_komisi_agen_admin($id_thn_akademik,$kode_agen)
    {

		$this->db->select('sum(komisi) as jumlah_komisi, count(komisi) as total_maba, kode_agen');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where(array('kode_agen' => $kode_agen, 'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	//Pencarian mahasiswa di komisi
	public function cari_mahasisawa($keywords,$limit,$start)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('maba_konfirmasi_bayar.*,pendaftaran.nama_lengkap');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where('maba_konfirmasi_bayar.kode_agen',$kode_agen);
		$this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran = maba_konfirmasi_bayar.id_pendaftaran','left');
		//like
		$this->db->limit($limit,$start);
		$this->db->like('pendaftaran.nama_lengkap',$keywords);
		$this->db->order_by('maba_konfirmasi_bayar.id_konfirmasi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_cari_mahasiswa($keywords)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('maba_konfirmasi_bayar.*,pendaftaran.nama_lengkap');
		$this->db->from('maba_konfirmasi_bayar');
		$this->db->where('maba_konfirmasi_bayar.kode_agen',$kode_agen);
		$this->db->join('pendaftaran', 'pendaftaran.id_pendaftaran = maba_konfirmasi_bayar.id_pendaftaran','left');
		//like
		$this->db->like('pendaftaran.nama_lengkap',$keywords);
		$this->db->order_by('maba_konfirmasi_bayar.id_konfirmasi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	//riwayat agen
	public function agen_pengajuan($id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('*');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'thn_akademik' => $id_thn_akademik));
		$this->db->order_by('id_komisi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function agen_pengajuan_admin($id_thn_akademik,$kode_agen)
    {

		$this->db->select('*');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'thn_akademik' => $id_thn_akademik));
		$this->db->order_by('id_komisi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	//riwayat pengajuan koordinator
	public function agen_koordinator_pengajuan()
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('*');
		$this->db->from('agen_koordinator_pengajuan');
		$this->db->where('kode_agen',$kode_agen);
		$this->db->order_by('id_komisi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function agen_rekomendasi_pengajuan()
    {
		$kode_agen = $this->session->userdata('kode_agen');
		$this->db->select('*');
		$this->db->from('agen_rekomendasi_pengajuan');
		$this->db->where('kode_agen',$kode_agen);
		$this->db->order_by('id_komisi_rekomendasi','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah_agen_pengajuan($id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as jumlah_pengajuan');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '1', 
							   'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	public function jumlah_agen_pengajuan_admin($id_thn_akademik,$kode_agen)
    {

		$this->db->select('sum(pengajuan) as jumlah_pengajuan');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '1', 
							   'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	public function jumlah_pengajuan($id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as total_pengajuan');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen, 
							   'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	public function menunggu_jumlah_pengajuan($id_thn_akademik)
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as menunggu_jumlah_pengajuan');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '0', 
							   'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	public function menunggu_jumlah_pengajuan_admin($id_thn_akademik,$kode_agen)
    {

		$this->db->select('sum(pengajuan) as menunggu_jumlah_pengajuan');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '0', 
							   'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_pengajuan($data){
		$this->db->insert('agen_pengajuan',$data);
	}

	public function jumlah_koordinator_pengajuan()
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as jumlah_pengajuan');
		$this->db->from('agen_koordinator_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '1',));
		$query = $this->db->get();
		return $query->row();
	}

	public function jumlah_rekomendasi_pengajuan()
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as jumlah_pengajuan');
		$this->db->from('agen_rekomendasi_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '1',));
		$query = $this->db->get();
		return $query->row();
	}

	public function menunggu_jumlah_koordinator_pengajuan()
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as menunggu_jumlah_pengajuan');
		$this->db->from('agen_koordinator_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '0',));
		$query = $this->db->get();
		return $query->row();
	}

	public function menunggu_jumlah_rekomendasi_pengajuan()
    {
		$kode_agen = $this->session->userdata('kode_agen');

		$this->db->select('sum(pengajuan) as menunggu_jumlah_pengajuan');
		$this->db->from('agen_rekomendasi_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'status_pengajuan' => '0',));
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah_pengajuan_koordinator($data){
		$this->db->insert('agen_koordinator_pengajuan',$data);
	}

	public function total_pengajuan_agen($id_thn_akademik,$kode_agen)
    {

		$this->db->select('*');
		$this->db->from('agen_pengajuan');
		$this->db->where(array('kode_agen' => $kode_agen,
							   'thn_akademik' => $id_thn_akademik));
		$query = $this->db->get();
		return $query->result();
	}


}