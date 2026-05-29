<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['mahasiswa_required_fields'] = array(
	'utama' => array(
		array('name' => 'fakultas', 'label' => 'Fakultas Pilihan 1'),
		array('name' => 'gelombang', 'label' => 'Gelombang Pilihan 1'),
		array('name' => 'jurusan_pilihan', 'label' => 'Pilihan 1'),
		array('name' => 'gelombang_2', 'label' => 'Gelombang Pilihan 2'),
		array('name' => 'jurusan_pilihan2', 'label' => 'Pilihan 2'),
		array('name' => 'program', 'label' => 'Jalur Pendaftaran'),
		array('name' => 'jenis', 'label' => 'Jenis Pendaftaran'),
	),
	'lanjutan' => array(
		array('name' => 'nik', 'label' => 'NIK', 'rules' => 'required|min_length[16]|max_length[16]'),
		array('name' => 'nama_lengkap', 'label' => 'Nama Lengkap'),
		array('name' => 'tempat_lahir', 'label' => 'Tempat Lahir'),
		array('name' => 'tanggal_lahir', 'label' => 'Tanggal Lahir'),
		array('name' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
		array('name' => 'jk', 'label' => 'Jenis Kelamin'),
		array('name' => 'baju', 'label' => 'Ukuran Baju'),
		array('name' => 'agama', 'label' => 'Agama'),
		array('name' => 'kewarganegaraan', 'label' => 'Kewarganegaraan'),
		array('name' => 'alamat', 'label' => 'Alamat'),
		array('name' => 'kecamatan', 'label' => 'Kecamatan'),
		array('name' => 'kota', 'label' => 'Kabupaten/Kota'),
		array('name' => 'prov', 'label' => 'Provinsi'),
		array('name' => 'hp', 'label' => 'Nomor HP'),
		array('name' => 'ortu_nama', 'index' => 0, 'rule_name' => 'ortu_nama[0]', 'label' => 'Nama Ayah'),
		array('name' => 'ortu_nama', 'index' => 1, 'rule_name' => 'ortu_nama[1]', 'label' => 'Nama Ibu'),
		array('name' => 'ortu_nik', 'index' => 0, 'rule_name' => 'ortu_nik[0]', 'label' => 'NIK Ayah', 'rules' => 'required|min_length[16]|max_length[16]'),
		array('name' => 'ortu_nik', 'index' => 1, 'rule_name' => 'ortu_nik[1]', 'label' => 'NIK Ibu', 'rules' => 'required|min_length[16]|max_length[16]'),
		array('name' => 'sekolah_nama', 'label' => 'Asal Sekolah', 'condition' => 'bukan_pd'),
		array('name' => 'sekolah_jurusan', 'label' => 'Asal Jurusan', 'condition' => 'bukan_pd'),
		array('name' => 'tahun_lulus', 'label' => 'Tahun Lulus', 'rules' => 'required|min_length[4]|max_length[4]', 'condition' => 'bukan_pd'),
		array('name' => 'pindahan_namapt', 'label' => 'Asal Kampus', 'condition' => 'pd'),
		array('name' => 'pindahan_prodi', 'label' => 'Asal Program Studi', 'condition' => 'pd'),
	),
);
