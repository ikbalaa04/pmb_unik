<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usm_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); //memanggil database
    }
    

    //gedung
    public function gedung()
	{
				
		$this->db->select('*');
		$this->db->from('gedung');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function tambah_gedung($data){
		$this->db->insert('gedung',$data);

	}

	public function detail_gedung($id)
	{
		$this->db->select('*');
		$this->db->from('gedung');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_gedung($data){
		$this->db->where('id', $data['id']);
		$this->db->update('gedung', $data); 
	}


	public function delete_gedung($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('gedung',$data);
		
	}
	//end gedung


	//jenis_usm
    public function jenis_usm()
	{
				
		$this->db->select('*');
		$this->db->from('jenisusm');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function tambah_jenis_usm($data){
		$this->db->insert('jenisusm',$data);

	}

	public function detail_jenis_usm($id)
	{
		$this->db->select('*');
		$this->db->from('jenisusm');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_jenis_usm($data){
		$this->db->where('id', $data['id']);
		$this->db->update('jenisusm', $data); 
	}


	public function delete_jenis_usm($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('jenisusm',$data);
		
	}
	//end jenis_usm


 	//ruang
    public function ruang()
	{
				
		$this->db->select('ruang.*, jenisusm.nama as nama_jenis, gedung.nama as nama_gedung');
		$this->db->from('ruang');
		$this->db->join('jenisusm','jenisusm.id=ruang.idjenis','left');
		$this->db->join('gedung','gedung.id=ruang.kode_gedung','left');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function tambah_ruang($data){
		$this->db->insert('ruang',$data);

	}

	public function detail_ruang($id)
	{
		$this->db->select('*');
		$this->db->from('ruang');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_ruang($data){
		$this->db->where('id', $data['id']);
		$this->db->update('ruang', $data); 
	}


	public function delete_ruang($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('ruang',$data);
		
	}
	//end ruang


	//jadwal_usm
    public function jadwal_usm()
	{
				
		$this->db->select('jadwalusm.*,
						  gelombang.nama as G,
						  gelombang.fakultas,
						  gelombang.tahun,
						  fakultas.singkatan,
						  fakultas.nama_fakultas,
						  gedung.nama as GD,
						  jenisusm.nama as J, prodi.jenjang, prodi.nama as nama_prodi, program.nama as nama_program');
		$this->db->from('jadwalusm');
		$this->db->join('gelombang','gelombang.id=jadwalusm.gelombang','left');
		$this->db->join('fakultas','fakultas.id=gelombang.fakultas','left');
		$this->db->join('gedung','gedung.id=jadwalusm.ruang','left');
		$this->db->join('prodi','prodi.kode=jadwalusm.prodi','left');
		$this->db->join('program','program.id=jadwalusm.program','left');
		$this->db->join('jenisusm','jenisusm.id=jadwalusm.jenis_ujin','left');
		$this->db->order_by('gelombang.nama','asc');
		$query = $this->db->get();
		return $query->result();
    }


    public function tambah_jadwal_usm($data){
		$this->db->insert('jadwalusm',$data);

	}

	public function detail_jadwal_usm($id)
	{
		$this->db->select('*');
		$this->db->from('jadwalusm');
		$this->db->where('id', $id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->row();
	}

	function delete_jadwal_usm_pilihan($data)
	{
	    if (!empty($data)) {
        $this->db->where_in('id', $data);
        $this->db->delete('jadwalusm');
    	}
	}

	public function edit_jadwal_usm($data){
		$this->db->where('id', $data['id']);
		$this->db->update('jadwalusm', $data); 
	}


	public function delete_jadwal_usm($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('jadwalusm',$data);
		
	}
	//end jadwal usm
}