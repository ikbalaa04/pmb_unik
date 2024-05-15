-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2023 at 10:18 AM
-- Server version: 10.5.18-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1801752_pmbcbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `id` int(20) NOT NULL,
  `popup` varchar(16) NOT NULL,
  `kode_agen` char(100) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `nama` char(100) NOT NULL,
  `alamat` text NOT NULL,
  `hp` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `username` char(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `passwordasli` varchar(100) NOT NULL,
  `namabank` char(50) NOT NULL,
  `atas_nama` char(100) NOT NULL,
  `norek` char(50) NOT NULL,
  `pekerjaan` char(100) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `kabupaten` varchar(40) NOT NULL,
  `tanggal_input` date DEFAULT NULL,
  `jenis_agen` varchar(30) NOT NULL,
  `status_agen` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agen_pengajuan`
--

CREATE TABLE `agen_pengajuan` (
  `id_komisi` int(11) NOT NULL,
  `kode_agen` varchar(30) NOT NULL,
  `pengajuan` int(100) NOT NULL,
  `tgl_pengajuan` datetime NOT NULL,
  `tgl_sukses` datetime DEFAULT NULL,
  `status_pengajuan` int(3) NOT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  `thn_akademik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` varchar(400) NOT NULL,
  `image` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `pilihan` char(200) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `judul`, `deskripsi`, `image`, `link`, `status`, `pilihan`, `urutan`) VALUES
(52, 'Jadwal Pendaftaran', 'Jadwal Pendaftaran', 'rywbw.png', 'http://pmb.stieyasaanggana.ac.id', 1, '', 0),
(53, 'Keuangan Perbankan', 'Keuangan Perbankan', 'dwtdb.png', 'http://pmb.stieyasaanggana.ac.id', 1, '', 0),
(54, 'Manajemen', 'Manajemen', '7gg38.png', 'http://pmb.stieyasaanggana.ac.id', 1, '', 0),
(55, 'News', 'News Konfirmasi', '7qtww.png', 'http://stieyasaanggana.ac.id/index.php/en/component/content/category/9-data-stieya', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(100) NOT NULL,
  `isi_berita` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('Publish','Draft') NOT NULL DEFAULT 'Draft',
  `tanggal` datetime NOT NULL,
  `galeri` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `username`, `kategori`, `judul`, `judul_seo`, `isi_berita`, `foto`, `status`, `tanggal`, `galeri`) VALUES
(2, '', '', 'Smart Classroom Kampus 4', '', NULL, '0d4f9e38fb15a53fd5543bc1ec07e5ea.jpg', 'Draft', '2021-01-14 09:20:39', 1),
(3, '', '', 'Auditorium Kampus 3 UTI', '', NULL, 'e16729ff080e21b0435fe4637cba3eb0.jpg', 'Publish', '2021-01-21 10:36:31', 1),
(4, '', '', 'Kampus 4 UTI', '', NULL, '0f1ee444309f12ffe1cd891480e8567b.jpg', 'Publish', '2021-01-21 11:02:45', 1),
(5, '', '', 'Laboratorium Kampus 3 UTI', '', NULL, 'a4172a4ba1a95f22487cf977fb918e2f.jpg', 'Publish', '2021-01-21 11:05:33', 1),
(6, '', '', 'Auditorium Kampus 3 UTI Views 2', '', NULL, '2aac9a78d7746e1dbd796ced7e8c676a.jpg', 'Publish', '2021-01-21 11:06:35', 1),
(7, '', '', 'Smart Classroom 1 Kampus 4', '', NULL, '49fe119eb68df19dcf31061ef780a084.jpg', 'Publish', '2021-01-21 11:07:29', 1),
(8, '', '', 'Smart Classroom 2 Kampus 4', '', NULL, '29430ac3fa780176c66081f64c70d374.jpg', 'Publish', '2021-01-21 11:08:08', 1),
(9, '', '', 'Laboratorium Kampus 3 UTI', '', NULL, 'd10afed25ecaa8eb2e5fb7635f20ec65.jpg', 'Draft', '2021-01-21 11:09:28', 1),
(10, '', '', 'Kegiatan Belajar Mengajar di Ruangan Smart Classroom 1 Kampus 4', '', NULL, '337f9b64856a2ab35b126ad73dca6829.jpg', 'Publish', '2021-01-21 14:23:52', 1),
(11, '', '', 'Kegiatan Belajar Di Ruang Smart Classroom 2 UTI', '', NULL, '8109337469c4cd05a7e8e04125675c77.jpg', 'Publish', '2021-01-21 14:25:36', 1),
(12, '', '', 'Laboratorium 3 Kampus 3 UTI', '', NULL, '7051960062a9468816417266a40e022e.jpg', 'Publish', '2021-01-23 00:20:34', 1),
(21, 'ADMIN PMB', 'Pengumuman', 'Penerimaan Mahasiswa Baru Universitas Terbaik Indonesia TA 2023/2024', 'penerimaan-mahasiswa-baru-universitas-terbaik-indonesia-ta-20232024', '<p>Telah dibuka pendaftaran penerimaan mahasiswa baru Program Studi S1 Farmasi dan S1 Kimia Tahun Ajaran 2023/2024</p>\r\n', '8b480fc7a492032861ecd34bce8d226d.png', 'Publish', '2021-11-02 13:50:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `nama_berkas` varchar(250) NOT NULL,
  `besar_berkas` char(4) NOT NULL,
  `type_file` char(50) NOT NULL,
  `status` int(1) NOT NULL,
  `program` char(3) NOT NULL,
  `urutan` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `nama_berkas`, `besar_berkas`, `type_file`, `status`, `program`, `urutan`) VALUES
(1, 'Rata-rata nilai raport 80 pada semester 1-5 untuk pelajaran MTK, Kimia, Fisika, Biologi dan B.Inggris', '3000', 'pdf', 1, '19', '1'),
(2, 'SCAN Ijazah', '1024', 'pdf', 1, '23', '1'),
(3, 'SKHU', '1024', 'pdf', 1, '23', '2'),
(4, 'SCAN e-KTP', '200', 'pdf', 1, '23', '3'),
(5, 'Transkip Nilai', '2000', 'pdf', 1, '23', '4'),
(6, 'SCAN e-KTP', '200', 'pdf', 1, '13', '1'),
(7, 'SCAN Ijazah S1 Farmasi dan Transkip Nilai', '2000', 'pdf', 1, '13', '2'),
(8, 'Surat Keterangan Catatan Kepolisian (SKCK)', '500', 'pdf', 1, '13', '3'),
(9, 'Surat Keterangan Kesehatan dari Dokter', '500', 'pdf', 1, '13', '4'),
(10, 'Pas Photo Ukuran 4x6, 3x4 dan 2x3 masing-masing 4 lembar', '1000', 'pdf', 1, '13', '5'),
(11, 'SCAN Sertifikat Akreditasi Program Studi Asal S1 (Bagi Non-Alumni)', '500', 'pdf', 1, '13', '5');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_masuk`
--

CREATE TABLE `berkas_masuk` (
  `id_berkas_masuk` int(11) NOT NULL,
  `id_pendaftar` int(11) NOT NULL,
  `id_berkas` int(11) NOT NULL,
  `file_masuk` char(80) NOT NULL,
  `program` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkas_masuk`
--

INSERT INTO `berkas_masuk` (`id_berkas_masuk`, `id_pendaftar`, `id_berkas`, `file_masuk`, `program`) VALUES
(1, 3, 1, 'f4a49fd2b2568510bafa1b19f8744b18.pdf', 19),
(2, 12, 1, '2e42944e881a63b775de4d49112033a6.pdf', 19),
(3, 16, 1, '9093812655274594006db5f002af9aea.pdf', 19);

-- --------------------------------------------------------

--
-- Table structure for table `biaya`
--

CREATE TABLE `biaya` (
  `id` int(11) NOT NULL,
  `fakultas` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `biaya` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `utama` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `biaya`
--

INSERT INTO `biaya` (`id`, `fakultas`, `prodi`, `program`, `biaya`, `isi`, `utama`, `status`) VALUES
(4, 1, '42', 'Reguler', '6.400.000,.', '<p style=\"text-align:center\">Uang Kuliah / Semester</p>\r\n\r\n<p style=\"text-align:center\">Uang SKS / Sks</p>\r\n\r\n<p style=\"text-align:center\">Uang Praktikum</p>\r\n\r\n<p style=\"text-align:center\">Uang Bangunan</p>\r\n\r\n<p style=\"text-align:center\">Jas Almamater</p>\r\n\r\n<p style=\"text-align:center\">Jas Laboratorium</p>\r\n\r\n<p style=\"text-align:center\">Kartu Tanda Mahasiswa</p>\r\n\r\n<p style=\"text-align:center\">Asuransi</p>\r\n\r\n<p style=\"text-align:center\">PKKMB</p>\r\n\r\n<p style=\"text-align:center\">Dana Kemahasiswaan</p>\r\n\r\n<p style=\"text-align:center\">Batik Angkatan</p>\r\n\r\n<p style=\"text-align:center\">Bela Negara</p>\r\n\r\n<p style=\"text-align:center\">Internet</p>\r\n\r\n<p style=\"text-align:center\">UTS</p>\r\n\r\n<p style=\"text-align:center\">UAS</p>\r\n', 1, 1),
(10, 1, '42', 'Non Reguler', '7.400.000,.', '<p style=\"text-align:center\">Uang Kuliah / Semester</p>\r\n\r\n<p style=\"text-align:center\">Uang SKS / Sks</p>\r\n\r\n<p style=\"text-align:center\">Uang Praktikum</p>\r\n\r\n<p style=\"text-align:center\">Uang Bangunan</p>\r\n\r\n<p style=\"text-align:center\">Jas Almamater</p>\r\n\r\n<p style=\"text-align:center\">Jas Laboratorium</p>\r\n\r\n<p style=\"text-align:center\">Kartu Tanda Mahasiswa</p>\r\n\r\n<p style=\"text-align:center\">Asuransi</p>\r\n\r\n<p style=\"text-align:center\">PKKMB</p>\r\n\r\n<p style=\"text-align:center\">Dana Kemahasiswaan</p>\r\n\r\n<p style=\"text-align:center\">Batik Angkatan</p>\r\n\r\n<p style=\"text-align:center\">Bela Negara</p>\r\n\r\n<p style=\"text-align:center\">Internet</p>\r\n\r\n<p style=\"text-align:center\">UTS</p>\r\n\r\n<p style=\"text-align:center\">UAS</p>\r\n', 1, 1),
(11, 7, '30', 'Reguler', '6.400.000,.', '<p style=\"text-align:center\">Uang Kuliah / Semester</p>\r\n\r\n<p style=\"text-align:center\">Uang SKS / Sks</p>\r\n\r\n<p style=\"text-align:center\">Uang Praktikum</p>\r\n\r\n<p style=\"text-align:center\">Uang Bangunan</p>\r\n\r\n<p style=\"text-align:center\">Jas Almamater</p>\r\n\r\n<p style=\"text-align:center\">Jas Laboratorium</p>\r\n\r\n<p style=\"text-align:center\">Kartu Tanda Mahasiswa</p>\r\n\r\n<p style=\"text-align:center\">Asuransi</p>\r\n\r\n<p style=\"text-align:center\">PKKMB</p>\r\n\r\n<p style=\"text-align:center\">Dana Kemahasiswaan</p>\r\n\r\n<p style=\"text-align:center\">Batik Angkatan</p>\r\n\r\n<p style=\"text-align:center\">Bela Negara</p>\r\n\r\n<p style=\"text-align:center\">Internet</p>\r\n\r\n<p style=\"text-align:center\">UTS</p>\r\n\r\n<p style=\"text-align:center\">UAS</p>\r\n', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_jawaban`
--

CREATE TABLE `cbt_jawaban` (
  `jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_soal_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban_detail` text NOT NULL,
  `jawaban_benar` tinyint(1) NOT NULL DEFAULT 0,
  `jawaban_aktif` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbt_jawaban`
--

INSERT INTO `cbt_jawaban` (`jawaban_id`, `jawaban_soal_id`, `jawaban_detail`, `jawaban_benar`, `jawaban_aktif`) VALUES
(186, 57, '<p>1 Syawal</p>\r\n', 1, 1),
(187, 57, '<p>1 Agustus</p>', 0, 1),
(188, 57, '<p>1 Januari</p>', 0, 1),
(189, 57, '<p>1 Desember</p>', 0, 1),
(190, 57, '<p>14 Februari</p>', 0, 1),
(191, 56, '<p>Nazril Irham</p>', 1, 1),
(192, 56, '<p>Joko Susilo</p>', 0, 1),
(193, 56, '<p>Wahyu Saputra</p>\r\n', 0, 1),
(194, 56, '<p>Aril Piterpen</p>', 0, 1),
(195, 56, 'Joko Wow', 0, 1),
(196, 55, '<p>Soekarno</p>', 1, 1),
(197, 55, '<p>Soeharto</p>\r\n', 0, 1),
(198, 55, '<p>Susilo Bambang Yudhoyono</p>\r\n', 0, 1),
(199, 55, '<p>BJ. Habibie</p>\r\n', 0, 1),
(200, 55, '<p>Joko Widodo</p>\r\n', 0, 1),
(201, 54, '<p>Sun East Mall</p>', 1, 1),
(202, 54, '<p>Matahari</p>', 0, 1),
(203, 54, '<p>Bulan</p>', 0, 1),
(204, 54, '<p>Tanah Abang</p>', 0, 1),
(205, 54, '<p>Tanah Lempong</p>', 0, 1),
(206, 53, '<p>Sekolah Menengah Kejuruan</p>', 1, 1),
(207, 53, '<p>Sekolah Menengah Kejujuran</p>', 0, 1),
(208, 53, '<p>Sekolah Maju Sendiri</p>', 0, 1),
(209, 53, '<p>Sekolah Mak Ku</p>', 0, 1),
(210, 53, '<p>Sekolah Memilih Kekasih</p>', 0, 1),
(211, 64, 'Akhirnya aku menemukanmu', 1, 1),
(212, 64, 'Akhir dirimu', 0, 1),
(213, 64, 'Susahnya jadi dia', 0, 1),
(214, 64, 'Jones', 0, 1),
(215, 64, 'Josan - Jomblo Pas Pasan', 0, 1),
(621, 161, '<p>Aksi bela Jomblo</p>\r\n', 1, 1),
(622, 161, '<p>Aksi bela cewek</p>\r\n', 0, 1),
(623, 161, '<p>14 Februari</p>\r\n', 0, 1),
(624, 161, '<p>Hari Valentine</p>\r\n', 0, 1),
(625, 161, '<p>Turun ke jalan</p>\r\n', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_konfigurasi`
--

CREATE TABLE `cbt_konfigurasi` (
  `konfigurasi_id` int(11) NOT NULL,
  `konfigurasi_kode` varchar(50) NOT NULL,
  `konfigurasi_isi` varchar(500) NOT NULL,
  `konfigurasi_keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cbt_konfigurasi`
--

INSERT INTO `cbt_konfigurasi` (`konfigurasi_id`, `konfigurasi_kode`, `konfigurasi_isi`, `konfigurasi_keterangan`) VALUES
(1, 'link_login_operator', 'ya', 'Menampilkan Link Login Operator'),
(2, 'cbt_nama', 'Computer Based-Test', 'Nama Penyelenggara ZYACBT'),
(3, 'cbt_keterangan', 'Ujian Online Berbasis Komputer', 'Keterangan Penyelenggara ZYACBT'),
(4, 'cbt_mobile_lock_xambro', 'tidak', 'Melakukan Lock pada browser mobile agar menggunakan Xambro Saja'),
(5, 'cbt_informasi', '<p>Silahkan pilih Tes yang diikuti dari daftar tes yang tersedia dibawah ini. Apabila tes tidak muncul, silahkan menghubungi Operator yang bertugas.</p>\r\n', 'Informasi yang diberika di Dashboard peserta tes\'');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_modul`
--

CREATE TABLE `cbt_modul` (
  `modul_id` bigint(20) UNSIGNED NOT NULL,
  `modul_nama` varchar(255) NOT NULL,
  `modul_aktif` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbt_modul`
--

INSERT INTO `cbt_modul` (`modul_id`, `modul_nama`, `modul_aktif`) VALUES
(9, 'Default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_sessions`
--

CREATE TABLE `cbt_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_soal`
--

CREATE TABLE `cbt_soal` (
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `soal_topik_id` bigint(20) UNSIGNED NOT NULL,
  `soal_detail` text NOT NULL,
  `soal_tipe` smallint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=Pilihan ganda, 2=essay, 3=jawaban singkat',
  `soal_kunci` text DEFAULT NULL COMMENT 'Kunci untuk soal jawaban singkat',
  `soal_difficulty` smallint(6) NOT NULL DEFAULT 1,
  `soal_aktif` tinyint(1) NOT NULL DEFAULT 0,
  `soal_audio` varchar(200) DEFAULT NULL,
  `soal_audio_play` int(11) NOT NULL DEFAULT 0,
  `soal_timer` smallint(10) DEFAULT NULL,
  `soal_inline_answers` tinyint(1) NOT NULL DEFAULT 0,
  `soal_auto_next` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbt_soal`
--

INSERT INTO `cbt_soal` (`soal_id`, `soal_topik_id`, `soal_detail`, `soal_tipe`, `soal_kunci`, `soal_difficulty`, `soal_aktif`, `soal_audio`, `soal_audio_play`, `soal_timer`, `soal_inline_answers`, `soal_auto_next`) VALUES
(53, 7, 'Apakah kepanjangan dari SMK ?', 1, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(54, 7, '<p>Nama salah satu Mall yang ada di kota genteng adalah ...<br></p>', 1, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(55, 7, '<p>Siapakah nama tokoh berikut ?</p><p><img src=\"[base_url]uploads/topik_7/soekarno.jpg\" style=\"max-width: 600px;\"><br></p>', 1, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(56, 7, '<p>Siapakah vokalis band NOAH ?<br></p>', 1, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(57, 7, '<p>Tanggal berapakah hari raya Idul Fitri ?</p>\r\n', 1, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(61, 7, 'Jelaskan apa yang dimaksud dengan Jomblo ?', 2, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(62, 7, '<p>PT. Tiar Perkasa ingin melebarkan sayap usaha di bidang kuliner.</p><p>Dari pernyataan tersebut, sebutkan siapa kekasih mas Tiar ?</p>', 2, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(63, 7, '<p>Jelaskan kenapa Liverpool FC susah sekali untuk juara Premiere Leage !</p>\r\n', 2, NULL, 1, 1, NULL, 1, NULL, 0, 0),
(64, 7, '<p>Apakah judul lagu berikut ini?</p>', 1, NULL, 1, 1, 'naff_-_akhirnya_ku_menemukanmu.mp3', 1, NULL, 0, 0),
(161, 7, '<p>Jelaskan arti poster dibawah ini ?</p>\r\n\r\n<p><img src=\"[base_url]uploads/topik_7/5a49b252e7aea.jpeg\" style=\"height:283px; width:300px\" /></p>\r\n', 1, NULL, 1, 1, NULL, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tes`
--

CREATE TABLE `cbt_tes` (
  `tes_id` bigint(20) UNSIGNED NOT NULL,
  `tes_nama` varchar(255) NOT NULL,
  `tes_detail` text NOT NULL,
  `tes_begin_time` datetime DEFAULT NULL,
  `tes_end_time` datetime DEFAULT NULL,
  `tes_duration_time` smallint(10) UNSIGNED NOT NULL DEFAULT 0,
  `tes_ip_range` varchar(255) NOT NULL DEFAULT '*.*.*.*',
  `tes_results_to_users` tinyint(1) NOT NULL DEFAULT 0,
  `tes_detail_to_users` tinyint(1) NOT NULL DEFAULT 0,
  `tes_score_right` decimal(10,2) DEFAULT 1.00,
  `tes_score_wrong` decimal(10,2) DEFAULT 0.00,
  `tes_score_unanswered` decimal(10,2) DEFAULT 0.00,
  `tes_max_score` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tes_token` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tesgrup`
--

CREATE TABLE `cbt_tesgrup` (
  `tstgrp_tes_id` bigint(20) UNSIGNED NOT NULL,
  `tstgrp_grup_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tes_soal`
--

CREATE TABLE `cbt_tes_soal` (
  `tessoal_id` bigint(20) UNSIGNED NOT NULL,
  `tessoal_tesuser_id` bigint(20) UNSIGNED NOT NULL,
  `tessoal_user_ip` varchar(39) DEFAULT NULL,
  `tessoal_soal_id` bigint(20) UNSIGNED NOT NULL,
  `tessoal_jawaban_text` text DEFAULT NULL,
  `tessoal_nilai` decimal(10,2) DEFAULT NULL,
  `tessoal_creation_time` datetime DEFAULT NULL,
  `tessoal_display_time` datetime DEFAULT NULL,
  `tessoal_change_time` datetime DEFAULT NULL,
  `tessoal_reaction_time` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `tessoal_ragu` int(1) NOT NULL DEFAULT 0 COMMENT '1=ragu, 0=tidak ragu',
  `tessoal_order` smallint(6) NOT NULL DEFAULT 1,
  `tessoal_num_answers` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `tessoal_comment` text DEFAULT NULL,
  `tessoal_audio_play` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tes_soal_jawaban`
--

CREATE TABLE `cbt_tes_soal_jawaban` (
  `soaljawaban_tessoal_id` bigint(20) UNSIGNED NOT NULL,
  `soaljawaban_jawaban_id` bigint(20) UNSIGNED NOT NULL,
  `soaljawaban_selected` smallint(6) NOT NULL DEFAULT -1,
  `soaljawaban_order` smallint(6) NOT NULL DEFAULT 1,
  `soaljawaban_position` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tes_token`
--

CREATE TABLE `cbt_tes_token` (
  `token_id` int(11) NOT NULL,
  `token_isi` varchar(20) NOT NULL,
  `token_user_id` int(11) NOT NULL,
  `token_ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `token_aktif` int(11) NOT NULL DEFAULT 1 COMMENT 'Umur Token dalam menit, 1 = 1 hari penuh',
  `token_tes_id` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cbt_tes_token`
--

INSERT INTO `cbt_tes_token` (`token_id`, `token_isi`, `token_user_id`, `token_ts`, `token_aktif`, `token_tes_id`) VALUES
(12, '299403', 5, '2019-12-12 02:53:22', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tes_topik_set`
--

CREATE TABLE `cbt_tes_topik_set` (
  `tset_id` bigint(20) UNSIGNED NOT NULL,
  `tset_tes_id` bigint(20) UNSIGNED NOT NULL,
  `tset_topik_id` bigint(20) UNSIGNED NOT NULL,
  `tset_tipe` smallint(6) NOT NULL DEFAULT 1,
  `tset_difficulty` smallint(6) NOT NULL DEFAULT 1,
  `tset_jumlah` smallint(6) NOT NULL DEFAULT 1,
  `tset_jawaban` smallint(6) NOT NULL DEFAULT 0,
  `tset_acak_jawaban` int(11) NOT NULL DEFAULT 1,
  `tset_acak_soal` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_tes_user`
--

CREATE TABLE `cbt_tes_user` (
  `tesuser_id` bigint(20) UNSIGNED NOT NULL,
  `tesuser_tes_id` bigint(20) UNSIGNED NOT NULL,
  `tesuser_user_id` bigint(20) UNSIGNED NOT NULL,
  `tesuser_status` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `tesuser_creation_time` datetime NOT NULL,
  `tesuser_comment` text DEFAULT NULL,
  `tesuser_token` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_topik`
--

CREATE TABLE `cbt_topik` (
  `topik_id` bigint(20) UNSIGNED NOT NULL,
  `topik_modul_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `topik_nama` varchar(255) NOT NULL,
  `topik_detail` text DEFAULT NULL,
  `topik_aktif` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbt_topik`
--

INSERT INTO `cbt_topik` (`topik_id`, `topik_modul_id`, `topik_nama`, `topik_detail`, `topik_aktif`) VALUES
(7, 9, 'Soal Uji Coba', 'Kumpulan Soal untuk Uji Coba ', 1),
(8, 9, 'Testing', 'testing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_user`
--

CREATE TABLE `cbt_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_grup_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_ip` varchar(39) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_birthdate` date DEFAULT NULL,
  `user_birthplace` varchar(255) DEFAULT NULL,
  `user_level` smallint(3) UNSIGNED NOT NULL DEFAULT 1,
  `user_detail` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbt_user`
--

INSERT INTO `cbt_user` (`user_id`, `user_grup_id`, `user_name`, `user_password`, `user_email`, `user_regdate`, `user_ip`, `user_firstname`, `user_birthdate`, `user_birthplace`, `user_level`, `user_detail`) VALUES
(27, 10, 'aa', 'aa', NULL, '2023-01-01 00:55:44', NULL, 'a', NULL, NULL, 1, 'Gelombang 1'),
(28, 10, 'hafizh', 'bisul_pisan', NULL, '2023-01-02 01:48:00', NULL, 'Aldiansyah', NULL, NULL, 1, 'Gelombang 1'),
(29, 10, 'sedo', '123', NULL, '2023-01-02 01:49:10', NULL, 'Udin', NULL, NULL, 1, 'Gelombang 1'),
(31, 10, 'ISMA AULIA YUNINGSIH ', 'Bismillah1', NULL, '2023-02-07 03:22:44', NULL, 'ISMA AULIA YUNINGSIH', NULL, NULL, 1, 'Gelombang 1 Batch 1'),
(32, 10, 'jujun', '123', NULL, '2023-02-07 09:20:34', NULL, 'Jujun', NULL, NULL, 1, 'Gelombang 1 Batch 1'),
(33, 10, 'aneunrplh ', 'Hafidzahmutqin30j', NULL, '2023-02-19 10:37:06', NULL, 'Aneu Nurpalah', NULL, NULL, 1, 'Gelombang 1 Batch 1'),
(34, 10, 'simahkmly@gmail.com', '010203', NULL, '2023-02-19 10:37:11', NULL, 'Simah kamaliya', NULL, NULL, 1, 'Gelombang 1 Batch 1');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_user_grup`
--

CREATE TABLE `cbt_user_grup` (
  `grup_id` bigint(20) UNSIGNED NOT NULL,
  `grup_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cbt_user_grup`
--

INSERT INTO `cbt_user_grup` (`grup_id`, `grup_nama`) VALUES
(7, '2022/2023'),
(10, '2023/2024'),
(6, '2024/2025');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `id_institusi` int(1) NOT NULL DEFAULT 1,
  `kode` varchar(20) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `id_institusi`, `kode`, `nama_fakultas`, `singkatan`, `status`) VALUES
(1, 0, '10', 'Fakultas Matematika dan IPA (Sarjana)', 'FMIPA (Sarjana)', 1),
(2, 0, '11', 'Fakultas Matematika dan IPA (Profesi)', 'FMIPA (Profesi)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id` int(11) NOT NULL,
  `nama` char(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `kode` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id`, `nama`, `created_at`, `kode`) VALUES
(1, 'Kampus 4 UNIGA (OSCE CENTER)', '2023-02-01 14:28:00', '#'),
(2, 'Kampus 4 UNIGA (CBT CENTER)', '2023-02-01 14:28:08', '#'),
(3, 'Kampus 3 UNIGA', '2023-02-01 14:28:17', '#');

-- --------------------------------------------------------

--
-- Table structure for table `gelombang`
--

CREATE TABLE `gelombang` (
  `id` int(11) NOT NULL,
  `fakultas` int(11) NOT NULL,
  `nama` char(255) NOT NULL,
  `kode` char(15) NOT NULL,
  `biaya` varchar(20) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `tahun` char(30) NOT NULL,
  `angkatan` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `thn_akademik` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `gelombang`
--

INSERT INTO `gelombang` (`id`, `fakultas`, `nama`, `kode`, `biaya`, `date_start`, `date_end`, `tahun`, `angkatan`, `status`, `keterangan`, `thn_akademik`) VALUES
(1, 1, 'Gelombang 1 Batch 1', 'G1', '', '0000-00-00', '2023-02-28', '2023', '2023/2024', 1, '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `jadwalusm`
--

CREATE TABLE `jadwalusm` (
  `id` int(11) NOT NULL,
  `gelombang` int(11) DEFAULT NULL,
  `prodi` int(11) DEFAULT NULL,
  `ruang` int(11) DEFAULT NULL,
  `jenis_ujin` char(11) DEFAULT NULL,
  `tgl_ujian` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `program` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `jadwalusm`
--

INSERT INTO `jadwalusm` (`id`, `gelombang`, `prodi`, `ruang`, `jenis_ujin`, `tgl_ujian`, `jam_mulai`, `jam_selesai`, `created_at`, `program`) VALUES
(1, NULL, NULL, 2, '8', '2023-03-04', '09:00:00', 'Selesai', '2023-02-01 14:28:53', 23),
(2, NULL, NULL, 1, '7', '2023-02-04', '11:00:00', 'Selesai', '2023-02-01 14:29:34', 23),
(3, NULL, NULL, 1, '7', '2023-03-04', '11:00:00', 'Selesai', '2023-02-01 14:29:53', 19),
(4, NULL, NULL, 1, '7', '2023-03-04', '11:00:00', 'Selesai', '2023-02-01 14:30:20', 22);

-- --------------------------------------------------------

--
-- Table structure for table `jalur`
--

CREATE TABLE `jalur` (
  `id` int(11) NOT NULL,
  `kode` char(3) NOT NULL,
  `nama` char(40) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `jalur`
--

INSERT INTO `jalur` (`id`, `kode`, `nama`, `status`, `created_at`) VALUES
(10, 'MB', 'Mahasiswa Baru', 1, '2015-12-14 06:27:50'),
(21, 'PD', 'Pindahan', 1, '2020-03-21 00:16:20'),
(26, 'LJ', 'Lintas Jalur', 1, '2022-12-28 09:54:42'),
(27, 'AJ', 'Alih Jenjang', 1, '2022-12-28 09:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `jenisusm`
--

CREATE TABLE `jenisusm` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `jenisusm`
--

INSERT INTO `jenisusm` (`id`, `nama`, `created_at`) VALUES
(7, 'Wawancara', '2018-01-27 04:58:58'),
(8, 'CBT', '2019-12-17 00:42:56'),
(9, 'Mini OSCE', '2022-06-07 08:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id`, `nama`, `status`) VALUES
(1, 'D1', 0),
(2, 'D2', 0),
(3, 'D3', 1),
(4, 'D4', 0),
(5, 'S1', 1),
(6, 'S2', 0),
(7, 'S3', 0),
(8, 'Profesi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `komisi`
--

CREATE TABLE `komisi` (
  `id_komisi` int(11) NOT NULL,
  `jumlah_komisi` varchar(15) NOT NULL,
  `jenis_komisi` varchar(30) NOT NULL,
  `nama_komisi` varchar(30) NOT NULL,
  `status_komisi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` int(11) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `nama` char(255) NOT NULL,
  `deskripsi_beranda` varchar(350) NOT NULL,
  `judul` varchar(70) NOT NULL,
  `singkatan` char(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `ukuran_biaya` varchar(10) NOT NULL,
  `email` char(255) NOT NULL,
  `telp` char(100) NOT NULL,
  `logo` char(100) NOT NULL,
  `bg_beranda` varchar(100) NOT NULL,
  `bg` char(100) NOT NULL,
  `about` text NOT NULL,
  `informasi_utama` text NOT NULL,
  `alur_pendaftaran` text NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ig` varchar(70) NOT NULL,
  `twitter` char(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `panduan_website` text NOT NULL,
  `panduan_mahasiswa` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `maps` text NOT NULL,
  `syarat_berkas` text NOT NULL,
  `wa_konfirmasi` varchar(15) NOT NULL,
  `wa_konfirmasi_berkas` varchar(15) NOT NULL,
  `batas_lulus` char(10) NOT NULL,
  `status_batas_lulus` int(1) NOT NULL,
  `status_pencairan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `keywords`, `deskripsi`, `nama`, `deskripsi_beranda`, `judul`, `singkatan`, `alamat`, `ukuran_biaya`, `email`, `telp`, `logo`, `bg_beranda`, `bg`, `about`, `informasi_utama`, `alur_pendaftaran`, `fb`, `ig`, `twitter`, `website`, `panduan_website`, `panduan_mahasiswa`, `kota`, `maps`, `syarat_berkas`, `wa_konfirmasi`, `wa_konfirmasi_berkas`, `batas_lulus`, `status_batas_lulus`, `status_pencairan`) VALUES
(1, '', '', 'UNIVERSITAS SIGUNTANG MAHAPUTRA', '<p>Penerimaan Mahasiswa Baru Universitas Terbaik Indonesia</p>\r\n', 'UNSIGMA', 'UNSIGMA', 'Jl. Jati No.42, Langensari, Kec. Tarogong Kaler, Kabupaten Cimahi, Jawa Barat 44151', '', 'admin@uti.ac.id', '6281380970449', 'B79E95FF-D578-45C6-B365-3B8B8CD81306.png', 'a4172a4ba1a95f22487cf977fb918e2f.jpg', 'WhatsApp_Image_2023-02-01_at_15_20_371.jpeg', '', '<p style=\"text-align:center\">Penerimaan Mahasiswa Baru Universitas Terbaik Indonesia</p>\r\n\r\n<p style=\"text-align:center\">Gelombang 1 - Februari s/d Maret 2023</p>\r\n\r\n<p style=\"text-align:center\">Gelombang 2 -&nbsp;April s/d Mei 2023</p>\r\n\r\n<p style=\"text-align:center\">Gelombang 3 -&nbsp;Juni s/d Juli 2023</p>\r\n\r\n<p style=\"text-align:center\">Gelombang 4 -&nbsp;Agustus s/d September 2023</p>\r\n', '<p>1. Mengisi formulir pada form yang sudah disesediakan<br />\r\n2. Setelah pendaftaran berhasil, maka akan muncul&nbsp;popup berupa data,&nbsp;username dan password yang akan digunakan untuk login<br />\r\n3. Silahkan login menggunakan username dan password yang tertera pada popup<br />\r\n4. Selanjutnya lengkapi semua data yang belum diisi pada menu <strong>Data Calon Mahasiswa</strong>, kami akan verifikasi jika semua data telah diisi<br />\r\n5. Jika sudah diverifikasi silahkan melakukan registrasi pendaftaran ke nomor rekening yang sudah tertera di menu&nbsp;<strong>Registrasi Pendaftaran</strong><br />\r\n6. Kirim bukti registrasi pendaftaran ke nomor WA yang tertera pada bagian bawah di menu&nbsp;<strong>Registrasi Pendaftaran</strong><br />\r\n7. Tunggu hingga registrasi pendaftaran sudah terverifikasi<br />\r\n8. Jika sudah terverifikasi nanti akan diberikan Nomor Ujian&nbsp;<br />\r\n9. Ujian akan dilaksanakan sesuai jadwal yang tersedia pada menu <strong>Jadwal Ujian</strong><br />\r\n10. Setelah ujian nanti akan ada pengumuman kelulusan, kelulusan bisa dilihat pada menu <strong>Kelulusan</strong><br />\r\n11. Setelah dinyatakan lulus silahkan untuk melakukan daftar ulang dan menghubungi bagian keuangan, nomor tersebut bisa dilihat pada menu <strong>Kontak Admin atau&nbsp;Registrasi Pendaftaran</strong></p>\r\n', '#', 'https://www.instagram.com/utiofficial/', '#', 'https://uti.ac.id', '<p><span style=\"font-size:16pt\"><span style=\"color:black\">LOGIN</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Bagian login merupakan bagian pertama yang digunakan sebelum masuk kebagian system utama, dalam bagian system utama nantinya di bagi menjadi 3 bagian, yaitu Superadmin, Admin PMB, dan Calon Mahasiswa. Untuk login Calon Mahasiswa menggunakan username dan password pada saat pendaftaran, sementara untuk Admin PMB menggunaan Username dan Passoword yang telah dibuatkan oleh Super Admin, nantinya Admin PMB akan menampilkan data pendaftar sesuai fakultasnya</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h1 style=\"text-align:justify\"><span style=\"font-size:16pt\"><span style=\"color:black\">ADMIN</span></span></h1>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Setelah berhasil melakukan login, Super Admin berperan untuk mengatur segala kegiatan system yang telah tersedia, berikut beberapa hak akses yang bisa dilakukan oleh super admin yaitu:</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><strong><span style=\"font-size:11pt\">Menu Konfigurasi</span></strong></span></p>\r\n\r\n<p><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Konfigurasi Utama</span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:14.6667px\">terdapat beberapa konfigurasi yang akan ditampilkan di halaman awal website</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><em>Batas Nilai CBT </em></strong>digunaka untuk mengatur nilai kelulusan ujian CBT dari peserta jika batas nilai misalnya diisi 50.00 maka peserta yang nilai ujian cbtntya lebih dari atau sama dengan 50 akan otomatis dinyatakan lulus</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><em>Status Batas Lulus CBT&nbsp;</em></strong>untuk menampilkan atau menyembunyikan kolom <strong>ujian CBT</strong> pada menu kelulusan</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><em>Infromasi Utama </em></strong>untuk menampilkan informasi utama pada bagian beranda</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><em>Alur pendaftaran</em> </strong>bagian<strong> </strong>ini untuk mengatur alur dari pendafataran PMB pada bagian formulir pendaftaran</span></li>\r\n	<li style=\"text-align:justify\"><em><strong>Deskripsi Beranda</strong></em>&nbsp;<span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan deskripsi utama pada halaman awal website</span></li>\r\n	<li style=\"text-align:justify\"><em><strong><span style=\"font-size:11pt\">Persyaratan Deskripsi&nbsp;</span></strong></em><span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan persyaratan yang harus di upload pendaftar</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><em>Status pencairan agen&nbsp;</em></strong>untuk menampilkan atau menyembunyikan fitur pencairan pada halaman pencairan agen</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Konfigurasi Background</span></span></strong></p>\r\n\r\n<p style=\"text-align:justify\">bagian ini digunakan untuk mengganti background dari halaman login dan beranda, untuk melihat hasilnya saat background di ganti harus di hapus terlebih dahulu bagian history browsernya.</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Admin CBT</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Pada menu ini Super Admin atau Admin PMB akan diarahkan ke halaman login admin cbt, silahkan login menggunakan username dan password yang sama dengan login ke website PMB</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\">Menu kalkulasi</span></span></strong></p>\r\n\r\n<p><strong><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Kalkulasi Pendaftar</span></span></strong></p>\r\n\r\n<p><span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan kalulasi pendaftar yang baru daftar / belum bayar, sudah bayar, terverifikasi, diterima dan juga yang sudah registrasi ulang</span></p>\r\n\r\n<p><strong><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Kalkulasi Agen</span></span></strong></p>\r\n\r\n<p><span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan&nbsp;data pendaftar yang dilakukan oleh agen berupa data pendaftar awal / belum bayar, sudah bayar, terverifikasi dan juga pengajuan agen tersebut</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\">Menu Agen</span></span></strong></p>\r\n\r\n<p><strong><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Data Agen</span></span></strong></p>\r\n\r\n<p><span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan data agen yang sudah mendaftar</span></p>\r\n\r\n<p><strong><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Jenis Agen</span></span></strong></p>\r\n\r\n<p><span style=\"font-size:11pt\">bagian ini digunakan untuk membuat jenis agen dan juga komisi yang akan di dapat agen</span></p>\r\n\r\n<p><strong><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\">Link Agen</span></span></strong></p>\r\n\r\n<p><span style=\"font-size:11pt\">bagian ini digunakan masuk ke halaman login agen</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\">Menu Tahun Akademik</span></span></strong></p>\r\n\r\n<p><span style=\"color:#2ecc71\"><span style=\"font-size:14.6667px\"><strong>Tahun Akdemik</strong></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">bagian ini digunakan untuk menambahkan tahun akademik dan bagian vital dari PMB, karena pendaftaran PMB akan bisa dilakukan jika status tahun akademik <strong>aktif </strong>dan <strong>masih berlaku</strong></span></li>\r\n	<li><span style=\"font-size:14.6667px\">data tahun akademik yang sudah dibuat akan otomatis dibuatkan grup untuk tes, jadi saat nanti membuat tes di website cbt pastikan grup yang dipilih untuk tese sesuai pada saat tahun akademik yang sedang berjalan atau masih berlaku</span></li>\r\n	<li><span style=\"font-size:11pt\">tahun akademik yang akan masuk saat pendaftaran adalah tahun akademik yang terbaru status <strong>aktif </strong>dan <strong>masih berlaku</strong></span></li>\r\n</ul>\r\n\r\n<p><span style=\"color:#2ecc71\"><span style=\"font-size:14.6667px\"><strong>Tahun Akdemik Admin</strong></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan data pendaftar sesuai tahun akademik admin yang <strong>aktif</strong></span></li>\r\n	<li><span style=\"font-size:11pt\">data yang akan telihat pada menu belum bayar, sudah bayar, terverifikasi dan diterima yaitu yang status tahun akademiknya <strong>aktif</strong></span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Master</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Menu Gelombang</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bagian ini digunakan untuk menampilkan gelombang pendaftaran di bagian formulir pendaftaran </span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">gelombang yang nanti akan tampil sesuai dengan fakultas yang di pilih</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">gelombang yang akan tampil yang statusnya aktif</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">gelombang akan berakhir sesuai tanggal yang di tentukan</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Program Pendaftaran</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">program yang akan di tampilkan adalah program yang statusnya aktif</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">untuk kode diharuskan berbeda-beda</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Program Studi</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bagian ini digunakan untuk membuat prodi sesuai fakultas</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">prodi yang akan di tampilkan untuk calon pendaftar adalah yang statusnya aktif</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">untuk bagian biaya, nomor rekening dan nama bank harus diisi agar saat calon mahasiswa daftar, mendapat informasi mengenai registrasi pembayaran</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">diusahakan untuk kode prodi harus berbeda-beda</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>List Biaya</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bagian ini digunakan untuk membuat daftar biaya berupa detailnya</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">list biaya ini akan tampil pada halaman awal website</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">yang akan ditampilkan pada halaman awal website jika statusnya aktif dan utamanya yes</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Belum Bayar</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Pada menu ini Super Admin atau Admin PMB akan melihat data pendaftar yang baru masuk dan baru bayar.</span><span style=\"font-size:11pt\">&nbsp;berikut beberapa fitur pada menu verifikasi :</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Filter data berdasarkan Fakultas dan gelombang, setelah itu baru bisa backup data mahasiswa yang belum bayar</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa chat WA kepada pendaftar dengan syarat nomor WA yang di daftarkan peserta benar - bernar terdaftar di WA dan format nomor WA nya harus menggunakan awalan 62, seperti contoh ini 62897979799xxx</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa melihat detail bukti registrasi pembayaran yang dilakukan mahasiswa</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Memverifikasi data pembayaran dengan klik tombol verifikasi pembayaran</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Sudah Bayar</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Pada menu ini Super Admin atau Admin PMB akan melihat data pendaftar yang pembayaranya sudah diverifikasi.</span><span style=\"font-size:11pt\">&nbsp;berikut beberapa fitur pada menu verifikasi :</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Filter data berdasarkan Fakultas dan gelombang, setelah itu baru bisa backup data mahasiswa yang baru diverifikasi pembayaranya</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa chat WA kepada pendaftar dengan syarat nomor WA yang di daftarkan peserta benar - bernar terdaftar di WA dan format nomor WA nya harus menggunakan awalan 62, seperti contoh ini 62897979799xxx</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa melihat berkas yang di upload peserta, memverifikasi dan menolak berkas peserta dan nantinya akan ada informasi belum diverifikasi, berkas ditolak dan terverifikasi pada bagian dasbor mahasiswa ataupun pada bagian menu verifikasi sendiri</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa melihat detail bukti registrasi pembayaran yang dilakukan mahasiswa</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Memverifikasi data mahasiswa sehingga nantinya data yang sudah di verifikasi pada menu sudah bayar akan pindah ke menu terverifikasi</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa melihat detail dan edit data mahasiswa juga edit prodi olehh admin</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Terverifikasi</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Pada menu ini Super Admin atau Admin PMB akan melihat data pendaftar yang pembayaran dan datanya&nbsp;sudah diverifikasi.</span><span style=\"font-size:11pt\">&nbsp;berikut beberapa fitur pada menu verifikasi :</span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">setelah pendaftar terverifikasi maka akun cbt pendaftar akan dibuatkan otomatis dan pendaftar bisa klik link dan bisa login dengan username dan password yang telah didaftarkan pada website pmb</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:14.6667px\">pendaftar yang akan mengikuti tes adalah pendaftar yang sudah masuk menu ini</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Filter data berdasarkan gelombang dan jurusan setelah itu baru </span><span style=\"font-size:11pt\">bisa backup data mahasiswa yang sudah di verifikasi dan akan mengikuti tes</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bisa generate nomor urut ujian, pada saat generate atau ganti no ujian pastikan filter dlu datanya berdasarkan fakultas dan gelombang</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa melihat berkas yang di upload peserta</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa generate dan ganti nomor ujian peserta, agar semuanya berurutan maka sebelum generate atau ganti nomor ujian filter dulu datanya</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa mencetak kartu ujian peserta</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa mencetak formulir pendaftaran peserta</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa menolak status verifikasi, jadi data akan di kembalikan ke menu sudah bayar</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa meluluskan atau mengagalkan kelulusan mahasiswa</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bisa meluluskan peserta ke pilihan 2 jika pilihan 1 dan 2 nya berbeda</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bisa dan edit data pesera</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Diterima</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Filter data berdasarkan fakultas dan gelombang, setelah itu&nbsp;</span><span style=\"font-size:11pt\">bisa backup data mahasiswa yang sudah lulus atau diterima</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa melihat berkas yang di upload peserta </span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Bisa menggagalkan status kelulusan, jadi data akan di kembalikan ke menu terverifikasi</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">bisa&nbsp;edit data pesera</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Kelulusan</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Pada menu ini admin dan peserta bisa melihat data kelulusan peserta berdasarkan fakultas dan gelombang, jika pada konfigurasi utama status batas lulus aktif maka saat filter kelulusan akan tampil kolom status CBT, yaitu berupa peserta yang sudah ikut tes menggunakan link cbt yang sudah disediakan dan akan otomatis ada keterangan lulus tidaknya jika pada konfigurasi utama batas nilai lulusnya diisi, misal 50.00</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Ujian Saringan Masuk</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Jenis USM membuat jenis ujian saringan masuk </span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Jadwal USM membuat jadwal ujian sesuai gelombang dan nanti akan tampil jadwal yang sudah di tentukan di kartu ujian</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">tempat untuk menambahkan lokasi ujian</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Informasi</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Menu Berita</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini berisi berita berupa pengumuman atau informasi dan nantinya akan di tampilkan di halaman utama juka statusnya publish, dan hanya admin yang dapat membuka menu ini</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Menu Galeri</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini berisi foto galeri yang nantinya akan di tampilkan di halaman utama jika statusnya publish, dan hanya admin yang dapat membuka menu ini</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Users</strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Menu Pengguna</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:14.6667px\">berupa akun pendaftar, dan ada tombol untuk menonaktifkan pendaftar jika admin ingin menonaktifkan akun supaya tidak bisa login</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#2ecc71\"><span style=\"font-size:11pt\"><strong>Menu Admin</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:14.6667px\">berupa akun admin dan admin fakultas, dan ada tombol edit juga ada tombol&nbsp;untuk menonaktifkan admin fakultas jika admin ingin menonaktifkan akun supaya tidak bisa login</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#e74c3c\"><span style=\"font-size:11pt\"><strong>Menu Backup</strong></span></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Export data excel semua peserta</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Export data Excel semua peserta tahunan</span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Backup Database PMB</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p><span style=\"font-size:16pt\"><span style=\"color:black\">LOGIN</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Calon Mahasiswa menggunakan username dan password pada saat pendaftaran.</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p><span style=\"font-size:16pt\"><span style=\"color:black\">CALON MAHASISWA</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Setelah berhasil melakukan login, peserta dapat mengakses beberapa menu berikut:</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Menu Registrasi Pendaftaran</span></strong></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"color:black\">Pada menu </span>Registrasi Pendaftaran<span style=\"color:black\">&nbsp;mahasiswa dapat mengupload bukti pembayaran dengan maksimal ukuran gambar 500&nbsp;kb</span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"color:black\">jika sudah melakukan upload bukti pembayaran silahkan melakukan konfirmasi ke no wa yang sudah tersedia di bawah tombol upload</span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Menu Data Calon Mahasiswa</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#2ecc71\">Menu Form Utama</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini berisi form pengisian data-data utama</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#2ecc71\">Menu Lanjutan</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini berisi form pengisian data-data lanjutan mengenai data pribadi dan sekolah / perguruan tinggi</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#2ecc71\">Menu Orang tua / wali</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini berisi form pengisian data-data orang tuan atau wali</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Cetak Formulir</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini digunakan untuk mencetak formulir berupa data-data yang telah diisi peserta </span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Cetak Kartu Ujian</span></strong></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini digunakan untuk mencetak kartu ujian peserta, peserta bisa mencetak kartu ujian jika sudah ada nomor ujian </span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\">Pada menu ini juga peserta diharuskan mengupload foto profil dengan ukuran gambar maksimal 50&nbsp;KB</span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Kontak Admin</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini berisi nomor - nomor WA admin yang bisa dihubungi peserta</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Upload Berkas</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Menu ini digunakan peserta untuk mengupload persyaratan&nbsp;berkas-berkas&nbsp;dalam 1 file berupa word atau pdf maksimal file 3 MB.</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><strong><span style=\"color:#e74c3c\">Link CBT</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\">Akan muncul link CBT jika status mahasiswa sudah terverifikasi oleh admin, dan peserta bisa login sesuai username dan password yang digunakan untuk login ke website PMB</span></p>\r\n', 'Palembang', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.232772758659!2d108.2122371509271!3d-7.327732474074806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5747f9d5fd3b%3A0xa5cdb7ee8b21c05b!2sUtama%20Sport!5e0!3m2!1sen!2sid!4v1675762642400!5m2!1sen!2sid\" width=\"100%\" height=\"350\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '<p style=\"text-align:center\"><strong>Tabel Persyaratan dan Jenis Seleksi Jalur Bebas Tes</strong></p>\r\n\r\n<table border=\"1\" cellspacing=\"0\">\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Jalur Seleksi</th>\r\n			<th scope=\"col\">Uraian</th>\r\n			<th scope=\"col\">Syarat dan Berkas</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>PMDK-RAPORT</td>\r\n			<td>adalah penelusuran minat dan kemampuan berdasar nilai raport.</td>\r\n			<td>Rata- rata nilai raport 80 pada semester 1-5 untuk pelajaran matematika, kimia, fisika, biologi dan bahasa inggris<br />\r\n			(Berkas: Upload berkas berupa file pdf, didalamnya terdapat hasil scan rata-rata nilai raport)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>PMDK-SSO</td>\r\n			<td>adalah penelusuran minat dan kemampuan berdasar seni, sains, olahraga.</td>\r\n			<td>Minimal juara tingkat provinsi<br />\r\n			(Berkas: Upload berkas berupa file pdf, didalamnya terdapat hasil scan sertifikat)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><strong>Tabel Persyaratan Berkas Non-PMDK yang Harus di Upload</strong></p>\r\n\r\n<table border=\"1\" cellspacing=\"0\">\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Jalur Seleksi</th>\r\n			<th scope=\"col\">Syarat dan Berkas</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Non-PMDK</td>\r\n			<td>berikut berkas - berkas yang harus disiapkan berupa SCAN Ijazah, SKHU, KTP/KK, Transkip Nilai, Suket Kerja (jika bekerja)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<hr />\r\n<p>Jika file lebih dari 3 mb tidak bisa di upload dan silahkan anda compress&nbsp;<a href=\"https://www.ilovepdf.com/id/mengompres-pdf\" target=\"_blank\">disini</a>&nbsp;untuk (PDF) dan&nbsp;<a href=\"https://smallpdf.com/blog/compress-word\" target=\"_blank\">disini</a>&nbsp;untuk Word<br />\r\n<br />\r\n<strong>Langkah-langkah membuat PDF :</strong><br />\r\n1. Buka Microsoft Word<br />\r\n2. Copy Foto / Scan berkas<br />\r\n3. Paste di Word<br />\r\n4. Save File / Export (Klik Create PDF)</p>\r\n', '6281234857895', '6281234857894', '30.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'Superadmin'),
(2, 'Admin Fakultas'),
(3, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `maba_konfirmasi_bayar`
--

CREATE TABLE `maba_konfirmasi_bayar` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `tanggal_konfirmasi` date DEFAULT NULL,
  `kode_agen` varchar(20) DEFAULT NULL,
  `komisi` varchar(30) DEFAULT NULL,
  `saldo_pika` varchar(30) NOT NULL,
  `thn_akademik` int(11) NOT NULL,
  `status_pencairan` int(1) NOT NULL,
  `jenis_agen` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `maba_konfirmasi_bayar`
--

INSERT INTO `maba_konfirmasi_bayar` (`id_konfirmasi`, `id_pendaftaran`, `tanggal_konfirmasi`, `kode_agen`, `komisi`, `saldo_pika`, `thn_akademik`, `status_pencairan`, `jenis_agen`) VALUES
(2, 12, '2023-02-07', 'Mandiri', '0', '250000', 6, 0, 'Mandiri'),
(3, 21, '2023-02-07', 'Mandiri', '0', '250000', 6, 0, 'Mandiri'),
(4, 17, '2023-02-19', 'Mandiri', '0', '250000', 6, 0, 'Mandiri'),
(5, 16, '2023-02-19', 'Mandiri', '0', '250000', 6, 0, 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `tipe`, `id_keluarga`, `nama_menu`, `link`, `status`, `urutan`) VALUES
(1, 'T', 0, 'About', 'home/about', 1, 5),
(2, 'B', 0, 'Link Terkait', '#', 1, 9),
(3, 'B', 0, 'Teknik Uniga', '#', 0, 9),
(4, 'B', 2, 'Website Universitas', 'https://e-learningteknikelektrouniga.com/', 1, 10),
(5, 'B', 3, 'Teknik Uniga 2', 'https://fteknik.uniga.ac.id/', 1, 11),
(6, 'B', 2, 'Link Terkait 3', 'https://e-learningteknikelektrouniga.com/', 1, 12),
(7, 'T', 0, 'Profil', 'home/profil', 1, 3),
(8, 'T', 0, 'Home', '', 1, 1),
(9, 'T', 0, 'Register', 'home/pendaftaran', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(11) NOT NULL,
  `kode` char(2) NOT NULL,
  `nama` char(100) NOT NULL,
  `keterangan` char(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `kode`, `nama`, `keterangan`, `created_at`) VALUES
(1, 'A', 'DOSEN PNS-PTN/BHMN', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(2, 'B', 'DOSEN KONTRAK PTN/BHMN', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(3, 'C', 'DOSEN DPK PTS', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(4, 'D', 'DOSEN PTS', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(5, 'E', 'PNS LEMBAGA PEMERINTAH', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(6, 'F', 'TNI/POLRI', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(7, 'G', 'PEGAWAI SWASTA', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(8, 'H', 'LSM', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(9, 'I', 'WIRASWASTA', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(10, 'J', 'BELUM BEKERJA', 'PEKERJAAN SBLM-STLH STUDI', '2015-11-17 09:18:57'),
(11, 'K', 'PENSIUNAN', '', '2016-03-31 06:54:07'),
(12, 'L', 'Lain - lain', '', '2016-03-31 06:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(30) NOT NULL,
  `tahun_akademik` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nisn` char(20) NOT NULL,
  `kode_agen` varchar(30) DEFAULT NULL,
  `fakultas` int(11) NOT NULL,
  `popup` varchar(20) NOT NULL,
  `approve` tinyint(1) DEFAULT 0,
  `bayar` int(1) NOT NULL,
  `fix` int(1) NOT NULL,
  `non_fix` int(1) NOT NULL,
  `jumlahbayar` varchar(30) NOT NULL,
  `gelombang` int(11) NOT NULL,
  `gelombang_2` int(11) NOT NULL,
  `ipk` varchar(20) DEFAULT NULL,
  `jenis` char(11) DEFAULT NULL,
  `program` char(50) NOT NULL,
  `noujian` char(30) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `jurusan_pilihan` varchar(20) NOT NULL,
  `jurusan_pilihan2` char(11) NOT NULL,
  `email` char(100) NOT NULL,
  `password` char(20) NOT NULL,
  `nama_lengkap` char(120) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tempat_lahir` char(50) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` char(1) NOT NULL,
  `agama` char(30) NOT NULL,
  `kewarganegaraan` char(11) NOT NULL,
  `status_sipil` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `hp` char(50) NOT NULL,
  `ortu_nama` char(100) NOT NULL DEFAULT '-,-,-',
  `ortu_tempat_lahir` char(50) NOT NULL DEFAULT '-|-|-',
  `ortu_tgl_lahir` char(50) NOT NULL DEFAULT '-|-|-',
  `ortu_agama` char(50) NOT NULL DEFAULT '-,-,-',
  `ortu_pendidikan` char(80) NOT NULL DEFAULT '-,-,-',
  `ortu_hp` char(80) NOT NULL DEFAULT '0,0,0',
  `ortu_pekerjaan` char(150) NOT NULL DEFAULT '-,-,-',
  `ortu_penghasilan` char(80) NOT NULL DEFAULT '-,-,-',
  `ortu_alamat` varchar(500) NOT NULL DEFAULT '-|-',
  `sekolah_nama` char(120) NOT NULL,
  `sekolah_jurusan` varchar(50) DEFAULT NULL,
  `sekolah_nama_jurusan` varchar(100) DEFAULT NULL,
  `tahun_lulus` int(11) DEFAULT NULL,
  `no_ijazah` char(100) NOT NULL,
  `nilai_ijazah` char(10) NOT NULL,
  `pindahan_status` char(1) NOT NULL,
  `pindahan_namapt` char(120) DEFAULT NULL,
  `pindahan_fakultas` char(120) NOT NULL,
  `pindahan_prodi` char(120) DEFAULT NULL,
  `pindahan_nim` char(50) NOT NULL,
  `pindahan_jumlahsks` char(10) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `tanggal_update` datetime NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `bukti_bayar` varchar(40) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `keterangan_sumber` varchar(100) DEFAULT NULL,
  `keterangan_berkas` varchar(300) DEFAULT NULL,
  `verifikasi_berkas` int(1) NOT NULL,
  `registrasi_ulang` int(11) NOT NULL,
  `verifikasi_regis` int(1) NOT NULL,
  `atas_regis` char(30) NOT NULL,
  `bank_regis` char(30) NOT NULL,
  `tgl_regis` date DEFAULT NULL,
  `bukti_regis` char(50) DEFAULT NULL,
  `valid_lanjutan` int(1) NOT NULL,
  `kecamatan` char(30) NOT NULL,
  `kota` char(30) NOT NULL,
  `prov` char(30) NOT NULL,
  `npsn` char(20) DEFAULT NULL,
  `baju` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `tahun_akademik`, `username`, `nisn`, `kode_agen`, `fakultas`, `popup`, `approve`, `bayar`, `fix`, `non_fix`, `jumlahbayar`, `gelombang`, `gelombang_2`, `ipk`, `jenis`, `program`, `noujian`, `jenjang`, `jurusan_pilihan`, `jurusan_pilihan2`, `email`, `password`, `nama_lengkap`, `foto`, `tempat_lahir`, `tanggal_lahir`, `jk`, `agama`, `kewarganegaraan`, `status_sipil`, `alamat`, `hp`, `ortu_nama`, `ortu_tempat_lahir`, `ortu_tgl_lahir`, `ortu_agama`, `ortu_pendidikan`, `ortu_hp`, `ortu_pekerjaan`, `ortu_penghasilan`, `ortu_alamat`, `sekolah_nama`, `sekolah_jurusan`, `sekolah_nama_jurusan`, `tahun_lulus`, `no_ijazah`, `nilai_ijazah`, `pindahan_status`, `pindahan_namapt`, `pindahan_fakultas`, `pindahan_prodi`, `pindahan_nim`, `pindahan_jumlahsks`, `tanggal_daftar`, `tanggal_update`, `atas_nama`, `bank`, `tgl_bayar`, `bukti_bayar`, `nik`, `sumber`, `keterangan_sumber`, `keterangan_berkas`, `verifikasi_berkas`, `registrasi_ulang`, `verifikasi_regis`, `atas_regis`, `bank_regis`, `tgl_regis`, `bukti_regis`, `valid_lanjutan`, `kecamatan`, `kota`, `prov`, `npsn`, `baju`) VALUES
(2, 6, 'alisautari', '', 'Mandiri', 1, 'ItgDy1YzQxp82dV0mRNO', 0, 0, 0, 0, '', 1, 1, '', 'MB', '23', '', 'S1', 'F4', 'K1', 'utaria652@gmail.com', 'alisautari22', 'Alisa Utari', '', '', NULL, '', '', '', '', '', '6283143614713', '-,-,-', '-|-|-', '-|-|-', '-,-,-', '-,-,-', '0,0,0', '-,-,-', '-,-,-', '-|-', 'PPI 99 RANCABANGO', 'IPA', NULL, NULL, '', '', '', '', '', '', '', '', '2023-02-01 19:53:18', '0000-00-00 00:00:00', '', '', NULL, '', '', 'Sosial Media', 'Instagram', NULL, 0, 0, 0, '', '', NULL, NULL, 1, '', '', '', NULL, NULL),
(3, 6, 'indridbanowati11', '0041149915', 'Mandiri', 1, 'T5cZQlvgdX9BFoVW48pa', 0, 1, 0, 0, '0', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'indridbanowati@gmail.com', 'kuliah04', 'Indri Desthi Banowati', '', 'GARUT', '2004-12-11', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp. Sukasirna Rt. 03 Rw. 02 Ds. Salamnunggal', '6282126472211', 'Aip Saepudin,Yanti Sudianti,-', 'Garut|Garut|-', '1970-04-05|1976-02-02|-', 'Islam,Islam,-', 'SMA,S1,-', '6281290912945,6289504174596,0', 'Wiraswasta,PNS (Guru),-', '2.000.001 - 3.000.000,> 5.000.000,-', 'Kp. Sukasirna Rt. 03 Rw. 02 Ds. Salamnunggal Kec. Leles Kab. Garut|-', 'SMAN 2 GARUT', 'IPA', NULL, 2023, '', '', '', '', '', '', '', '', '2023-02-01 21:10:51', '2023-02-03 08:26:43', '', '', NULL, '', '3205095112040007', 'Lainnya', 'Keluarga', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Leles', 'Garut', 'Jawa Barat', NULL, NULL),
(4, 6, 'kailashalfa27', '', 'Mandiri', 1, 'JmAXvGOgpC7kFcr8ERfZ', 0, 0, 0, 0, '', 1, 1, '', 'MB', '19', '', 'S1', 'F4', 'F4', 'kailashalfa27@gmail.com', 'shalfa27', 'kaila shalfa humaira', '', '', NULL, '', '', '', '', '', '6289657570313', '-,-,-', '-|-|-', '-|-|-', '-,-,-', '-,-,-', '0,0,0', '-,-,-', '-,-,-', '-|-', 'SMK KESEHATAN BIDARA MUKTI', 'FARMASI', NULL, NULL, '', '', '', '', '', '', '', '', '2023-02-01 21:18:46', '0000-00-00 00:00:00', '', '', NULL, '', '', 'Sosial Media', 'instagram', NULL, 0, 0, 0, '', '', NULL, NULL, 1, '', '', '', NULL, NULL),
(5, 6, 'nisrina25', '0051950126', 'Mandiri', 1, 'OZK7Ld0oXp5zi8ClEhfU', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'nisrinanurunnisa@icloud.com', 'emolcute', 'NISRINA NURUNNISA', '', 'Garut', '2005-07-25', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp. Halteu Kidul RT. 003 RW. 004 Desa. Talagasari', '085162840705', 'Mokh. Kosasih,Oom Romlah,-', 'Garut|Garut|-', '13-01-1965|1968-10-01|-', 'Islam,Islam,-', 'S1,SMA,-', '082321286105,085321876543,0', 'PNS,Ibu Rumah Tangga,-', '> 5.000.000,< 500.000,-', 'Kp. Halteu Kidul RT.003 RW.004 Desa. Talagasari Kec. Kadungora Kab. Garut|-', 'SMAN 2 GARUT', 'IPA', NULL, 2023, '-', '-', '', '', '', '', '', '', '2023-02-01 21:21:17', '2023-02-03 09:00:32', '', '', NULL, '', '3205106507050001', 'Lainnya', 'Keluarga', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Kadungora', 'Garut', 'Jawa Barat', NULL, NULL),
(6, 6, 'Mila kamelia sari', '', 'Mandiri', 1, 'Bt4PIWrsoZuKyVOfjNCT', 0, 0, 0, 0, '', 1, 1, '', 'MB', '19', '', 'S1', 'F4', 'F4', 'milakameliasari5@gmail.com', '070326', 'Mila kamelia sari', '', '', NULL, '', '', '', '', '', '081310263276', '-,-,-', '-|-|-', '-|-|-', '-,-,-', '-,-,-', '0,0,0', '-,-,-', '-,-,-', '-|-', 'SMK BINA HARAPAN SUMEDANG', 'FARMASI', NULL, NULL, '', '', '', '', '', '', '', '', '2023-02-01 22:27:49', '0000-00-00 00:00:00', '', '', NULL, '', '', 'Sosial Media', 'Instagram', NULL, 0, 0, 0, '', '', NULL, NULL, 1, '', '', '', NULL, NULL),
(7, 6, 'Sipa Fauziah', '', 'Mandiri', 1, 'MV3S6jTeLK4vQur02b7y', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'sipaaaffauz@gmail.com', 'fauzcantik', 'Sipa Fauziah', '', 'Garut', '2004-12-01', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp.Sukasirna Rt03/Rw02 Des.Salamnunggal', '087715895642', 'Alit Suhara,Dewi Nurhaeni,-', 'Garut|Garut|-', '07-07-1972|1982-08-10|-', 'Islam,Islam,-', 'SMA,S1,-', '082315197669,085222494482,0', 'Wiraswasta ,Guru PNS,-', '-,-,-', 'Kp.Sukasirna Rt03/Rw02 Des.Salamnunggal|-', 'SMAN 2 GARUT', 'IPA', NULL, 2023, '', '', '', '', '', '', '', '', '2023-02-02 04:21:07', '2023-02-03 08:59:51', '', '', NULL, '', '3205094112040002', 'Website', NULL, NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'leles', 'Garut', 'Jawa Barat', NULL, NULL),
(9, 6, 'Muhamad Tegar R', '0045293332', 'Mandiri', 1, 'HALV1U6TErY5j0mXwyuf', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '23', '', 'S1', 'F4', 'F4', 'rahendrawanm@gmail.com', 'jangtegar97', 'Muhamad Tegar Rahendrawan', '', 'Garut', '2004-04-02', 'L', 'Islam', 'WNI', 'Belum Menikah', 'Kp.Sabilisalam', '6281546979134', 'Hendra Ahmad Rahadian,Eka Rahmawati,Nopi yulpina', 'Garut|Garut|Garut', '10-08-1982|25-06-06|21-04-03', 'Islam,Islam,Islam', 'SMA,SMA,D3', '081322615666,6285794523039,085860182687', 'Wiraswasta,Ibu rumah tangga,Wirasuwasta', '1.000.001 - 1.500.000,500.001 - 1.000.000,500.001 - 1.000.000', 'Kp.sabilisalam 001/015 Desa bungbulang kec.bungbulang kab.garut|Kp.panyingkiran 002/004 desa.bungbulang kec.bungbulang kab.garut', 'SMA NEGRI 7 GARUT', 'IPA', NULL, 2023, '', '', '', '', '', '', '', '', '2023-02-02 10:29:31', '2023-02-03 08:59:18', '', '', NULL, '', '3205310204040007', 'Staf / Karyawan Perguruan Tinggi', 'Pa Abdul mipa (081321007468)', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Bungbulang', 'Garut', 'Jawa barat', NULL, NULL),
(10, 6, 'ajengniswa394', '004164713', 'Mandiri', 1, 'FCbo9JTfqO2nGwUyDPSg', 0, 0, 0, 0, '', 1, 1, NULL, 'MB', '23', '', 'S1', 'F4', 'F4', 'ajengniswa919@gmail.com', 'AjengNf012345', 'Ajeng Niswa Nurfatwa', '', 'Garut', '2004-09-03', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp Jangkurang Rt 005 Rw 002 Desa Jangkurang', '6285722344540', 'Edwin Budiman,Rani Rosmayanti,-', 'Garut|Garut|-', '1976-10-05|1987-08-11|-', 'Islam,Islam,-', 'SMA,SMP,-', '6281313666065,6281399078309,0', 'Karyawan BUMN,Mengurus Rumah Tangga,-', '> 5.000.000,< 500.000,-', 'Kp Jangkurang Rt 005 Rw 002 Desa Jangkurang|-', 'SMK MUHAMMADIYAH 1 KADUNGORA', 'Otomatisasi tata kelola perkantoran', NULL, 2022, 'M-SMK/K13-3/ 0410455', '80,51', '', '', '', '', '', '', '2023-02-02 11:31:03', '0000-00-00 00:00:00', '', '', NULL, '', '3205094309040007', 'Lainnya', 'Mahasiswa', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Leles', 'Garut', 'Jawa Barat', NULL, NULL),
(11, 6, 'azkiyaa', '', 'Mandiri', 1, '5AgIJsd9lLfEbvmYNux2', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'K1', 'aazkiya527@gmail.com', 'manjadda', 'Azka Nurul Azkiya', '', '', '0000-00-00', '', '', '', '', '', '085793325336', '-,-,-', '-|-|-', '-|-|-', '-,-,-', '-,-,-', '0,0,0', '-,-,-', '-,-,-', '-|-', 'SMK FARMASI AS SHIFA', 'Farmasi', NULL, 0, '', '', '', '', '', '', '', '', '2023-02-02 17:41:33', '2023-02-03 08:57:58', '', '', NULL, '', '', 'Sosial Media', 'Instagram', NULL, 0, 0, 0, '', '', NULL, NULL, 1, '', '', '', NULL, NULL),
(12, 6, 'ISMA AULIA YUNINGSIH ', '0047527105', 'Mandiri', 1, 'bSnAPDy4t3p0ZEvVMwH7', 1, 1, 0, 0, '250000', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'ismaauliayuningsih8@gmail.com', 'Bismillah1', 'ISMA AULIA YUNINGSIH', '', 'CIAMIS', '2004-08-07', 'P', 'Islam', 'WNI', 'Belum Menikah', 'DUSUN. TANGKEBAN RT.018 RW.004 DESA. PURWADADI ', '6285703285476', 'ACENG HENDI SUJONO ,AAS ASYIAH ,-', 'CIAMIS |CIAMIS |-', '21 Mei 1978|1983-02-10|-', 'Islam,Islam,-', 'SMA,S1,-', '083116517953,085703910812,0', 'PU IRIGASI,GURU HONORER ,-', '1.500.001 - 2.000.000,< 500.000,-', 'DUSUN. HEGARMANAH RT.11 RW. 04 DESA. SINDANGJAYA KECAMATAN. MANGUNJAYA KABUPATEN. PANGANDARAN PROVINSI. JAWA BARAT |-', 'SMAN 1 BANJARSARI', 'IPA', NULL, 2023, '-', '-', '', '', '', '', '', '', '2023-02-02 17:53:16', '2023-02-07 10:22:44', '', '', NULL, '', '3207354708040002', 'Lainnya', 'Ketua Yayasan I\'anatush-shibyan Pangandaran ( BPK KH. Rahman Hidayat )', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'PURWADADI', 'CIAMIS', 'JAWA BARAT', NULL, NULL),
(13, 6, 'Indah nurfadilah', '3046339308', 'Mandiri', 1, 'ySKefQ5r6j9umcGdIogE', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '23', '', 'S1', 'F4', 'F4', 'indahnurfadilah294@gmail.com', 'indah29', 'Indah Nurfadilah', '', 'Garut', '2004-12-29', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Jln.Raya kadungora,kp.kiaradodot,RT/RW.004/001,desa Gandamekar,kec.kadungora,Garut', '082120839170', 'Muhtar,Diah Juariah,-', 'Garut|Garut|-', '1962-06-10|1967-06-12|-', 'Islam,Islam,-', 'SD,SMP,-', '081221169107,081221169107,0', 'Wirausahawan,Ibu Rumah Tangga,-', '1.500.001 - 2.000.000,-,-', '-Jln.Raya kadungora,kp.kiaradodot,RT/RW.004/001,desa Gandamekar,kec.kadungora,Garut|-', 'MA AL-MA\'ARIF CILAGENI', 'IPA', 'MIPA', 2023, '', '', '', '', '', '', '', '', '2023-02-02 21:30:19', '2023-02-03 08:56:44', '', '', NULL, '', '3205106912020005', 'Brosur', NULL, NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Kadungora', 'Garut', 'Jawa Barat', NULL, NULL),
(14, 6, 'Iranayrasyahlabella', '0058175396', 'Mandiri', 1, 'XHBilFuMT4RWVdxrveUa', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'K1', 'K1', 'iranayrasyahlabella20@gmail.com', 'iranayrasyahlabella', 'IRA NAYRA SYAHLA BELLA', '', 'Garut', '2025-07-28', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Jl. Rancapari RT 02/ RW 07, Desa Cihikeu ', '081395071974', 'YAYAT HIDAYATULOH,YULI WIDIANINGSIH,YAYAT HIDAYATULOH', 'Garut|Garut|Garut', '20/01/1975|25-11-30|25-05-28', 'Islam,Islam,Islam', 'SMA,SMA,SMA', '085320467888,081310115123,085320467888', 'PEGAWAI NEGERI SIPIL ,MENGURUS RUMAH TANGGA ,PEGAWAI NEGERI SIPIL', '2.000.001 - 3.000.000,< 500.000,-', 'Kp. Saradan, RT 31/ RW 10, Des Tanjungmulya, Kec. Pakenjeng, Kab. Garut, Provinsi Jawa barat |Kp. Saradan, RT 31/ RW 10, Des. Tanjungmulya, Kec. Pakenjeng, Kab. Garut, Prov. Jawa Barat ', 'SMK PGRI BUNGBULANG', 'AKUNTANSI KEUANGAN LEMBAGA', NULL, 2023, '12', '90', '', '', '', '', '', '', '2023-02-02 22:09:44', '2023-02-06 01:21:20', '', '', NULL, '', '3205336007050005', 'Lainnya', 'Mahasiswa ', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Bungbulang', 'Garut', 'Jawa Barat', NULL, NULL),
(15, 6, 'NIRMALUTFIFAHLEFI', '0067046657', 'Mandiri', 1, 'gNPM7IRSsrEGWwLdf1kt', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'nirmalutfifahlefi@gmail', 'lutfi55', 'NIRMA lUTFI FAHLEFI', '', 'Garut', '2006-05-05', 'P', 'Islam', 'WNI', 'Belum Menikah', 'KAMPUNG JATI, RT 001, RW 003, DESA DANGDEUR, KECAMATAN BANYURESMI, KABUPATEN GARUT ', '085624556450', 'A. SOPIAN ,NUR SITI MAESAROH ,-', 'GARUT|GARUT|-', '15 JULI 1983|1985-08-08|-', 'Islam,Islam,-', 'SD,SD,-', '085691772830,082119868018,0', 'WIRASWASTA,Ibu Rumah Tangga,-', '1.500.001 - 2.000.000,< 500.000,-', 'KAMPUNG JATI, RT 001, RW 003, DESA DANGDEUR, KECAMATAN BANYURESMI, KABUPATEN GARUT |-', 'SMAN 10 GARUT', 'SMA IPA', NULL, 2023, '', '', '', '', '', '', '', '', '2023-02-03 12:15:03', '2023-02-03 12:59:20', '', '', NULL, '', '3205064505060002', 'Guru BK', NULL, NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'BANYURESMI', 'GARUT', 'JAWA BARAT', NULL, NULL),
(16, 6, 'simahkmly@gmail.com', '0057266696', 'Mandiri', 1, 'Bpm6VPR2jxL59Desvtu4', 1, 1, 1, 0, '250000', 1, 1, NULL, 'MB', '19', '', 'S1', 'K1', 'F4', 'simahkimberly@gmail.com', '010203', 'Simah kamaliya', 'a5c0cb7cb4470c0292f2546f33da1d53.jpeg', 'Cirebon', '2005-02-09', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp. Cigentur DS. Padamukti RT/RW 04/04 ', '6281292632351', 'Asep Kamaludin ,Kuniah,Eutik Supiati S.Si', 'Garut |Cirebon |Garut', '08-03-1971|1978-10-19|1981-01-06', 'Islam,Islam,Islam', 'SMA,SD,S1', '966536791057,6283157149321,6281563846548', 'Supir,Wiraswasta ,Guru', '500.001 - 1.000.000,< 500.000,3.000.001 - 5.000.000', 'Kp. Cigentur DS. Padamukti RT/RW 04.04 kec. Pasirwangi kab. Garut |Kamasan Banjaran ', 'SMK PLUS QURROTA A\'YUN', 'FARMASI ', NULL, 2023, '-', '-', '', '', '', '', '', '', '2023-02-03 17:52:16', '2023-02-19 05:37:11', '', '', NULL, '', '3209184902050001', 'Alumni', 'Ibu Eutik Supiati (0815-6384-6548)', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Pasirwangi', 'Garut', 'Jawa barat', NULL, NULL),
(17, 6, 'aneunrplh ', '0039490301', 'Mandiri', 1, 'DCJQ6Znja2F59IyNkY8w', 1, 1, 0, 0, '250000', 1, 1, NULL, 'MB', '22', '', 'S1', 'K1', 'F4', 'aneunurpalah01@gmail.com', 'Hafidzahmutqin30j', 'Aneu Nurpalah', '', 'Garut', '2003-10-23', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp.Wanakerta, DS.wanakerta 44185', '085220226379', '- Ahmad Junaedi ,- Nurjanah ,-', '- Garut|- Garut|-', '- 11-07-1979|1980-05-09|-', 'Islam,Islam,-', 'SMA,SMA,-', '081214751900,0895801170879,0', '- wiraswasta ,- berdagang,-', '1.500.001 - 2.000.000,500.001 - 1.000.000,-', '- Kp.Wanakerta, DS.Wanakerta, RT/RW.03/02, Kec.Cibatu, Kan.Garut, Prov.Jawa Barat, 44185|-', 'SMK BIDARA MUKTI GARUT', 'KEPERAWATAN ', NULL, 2021, '0186342', '87', '', '', '', '', '', '', '2023-02-04 09:27:41', '2023-02-19 05:37:06', '', '', NULL, '', '3205066310030003', 'Alumni', 'Lara Ardhia Rahma 081283061780', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Cibatu', 'Garut', 'Jawa Barat', NULL, NULL),
(18, 6, 'zulfams', '0046088641', 'Mandiri', 1, 'ipAoxElQkLP81ItedhC5', 0, 0, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'Zulfamarwa23@gmail.com', 'Zulfams23', 'Zulfa Marwatus Sa\'adah', '', 'Bandung', '2005-05-23', 'P', 'Islam', 'WNI', 'Belum Menikah', 'Kp. Margahayu rt/rw 03/09 ', '628987189536', 'MAMAN SURYAMAN,TATI CHAERATI,-', 'Ciamis|Ciamis|-', '1975-06-04|1980-12-29|-', 'Islam,Islam,-', 'SD,SD,-', '62895414170807,628997135753,0', 'Buruh Harian Lepas,-,-', '2.000.001 - 3.000.000,-,-', 'Kp. Maragahayu rt/rw 03/09|-', 'SMAS ISLAM CIPASUNG', 'MIPA', NULL, 2023, '', '', '', '', '', '', '', '', '2023-02-06 15:22:42', '0000-00-00 00:00:00', '', '', NULL, '', '3204256305050005', 'Sosial Media', 'Instagram dan Whatsapp', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Cicalengka', 'Bandung', 'Jawa Barat', NULL, NULL),
(19, 6, 'Nita Fitriani', '0054359074', 'Mandiri', 1, 'TMsOHNCyD9WaG8IbgwE5', 0, 0, 0, 0, '', 1, 1, NULL, 'MB', '19', '', 'S1', 'F4', 'F4', 'hasbimunawargozali@gmail.com', 'n1t4f1tr', 'NITA FITRIANI', '', 'Garut', '2005-11-08', 'P', 'Islam', 'WNI', 'Belum Menikah', 'KP. BARUKAI CIGEDUG RT.06/RW04 DS. CIGEDUG', '085721652935', '-,-,-', '-|-|-', '-|-|-', '-,-,-', '-,-,-', '0,0,0', '-,-,-', '-,-,-', '-|-', 'SMAN 16 GARUT', 'MIPA', NULL, 2023, '', '', '', '', '', '', '', '', '2023-02-06 19:00:55', '0000-00-00 00:00:00', '', '', NULL, '', '3205186411060003', 'Mahasiswa', 'Sdri Nita 085721652935', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'CIGEDUG', 'GARUT', 'JAWA BARAT', NULL, NULL),
(20, 6, 'Ma\'ruf ', '3049378091', 'Mandiri', 1, 'oyHGYgpxCVEuQrW7cmiJ', 0, 0, 0, 0, '', 1, 1, NULL, 'MB', '23', '', 'S1', 'F4', 'F4', 'umarmaruf417@gmail.com', 'um4rm4r0f', 'Muhamad Umar Maruf', '', 'Garut', '2004-04-21', 'L', 'Islam', 'WNI', 'Belum Menikah', 'Kp kudang kulon ', '6287794019245', '-memed Muhamad ,Popo masitoh ,-', '-garut|Garut |-', '-10-07-1970|1981-06-07|-', 'Islam,Islam,-', 'SD,SD,-', '085860433203,0881023371979,0', 'Wirausaha ,Ibu rumah tangga ,-', '1.000.001 - 1.500.000,< 500.000,-', 'Kp kudang kulon |-', 'MA FAUZANIYYAH', 'IPA ', NULL, 2022, 'Skl', '80', '', '', '', '', '', '', '2023-02-06 23:24:02', '0000-00-00 00:00:00', '', '', NULL, '', '3205212104040001', 'Mahasiswa', 'Yudina Anggita (+62 853-2399-6757)', NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'Sukaresmi', 'Garut', 'Jawa barat', NULL, NULL),
(21, 6, 'jujun', '', 'Mandiri', 1, 'FDo7etEQXx0sUYaNTG1y', 1, 1, 0, 0, '250000', 1, 1, NULL, 'MB', '19', 'USM231002', 'S1', 'F4', 'K1', 'fdapa@ad.ac.id', '123', 'Jujun', 'cb5f48d935cd4b6bacd820c654184ccb.jpg', '', NULL, '', '', '', '', '', '132453645645', '-,-,-', '-|-|-', '-|-|-', '-,-,-', '-,-,-', '0,0,0', '-,-,-', '-,-,-', '-|-', 'SMA 2 CIBATU', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '2023-02-07 14:44:49', '2023-02-07 04:20:34', '', '', NULL, '', '', 'Website', NULL, NULL, 0, 0, 0, '', '', NULL, NULL, 1, '', '', '', NULL, NULL),
(22, 6, 'pertapacilik', '54645645', 'Mandiri', 1, 'p6stKmijSD83lnoUVPcr', 0, 1, 0, 0, '', 1, 1, NULL, 'MB', '23', '', 'S1', 'F4', 'F4', 'e612700@gmail.com', 'bismillah', 'Edi Sudarsono', '', 'Palembang', '2006-03-29', 'L', 'Islam', 'WNI', 'Menikah', 'Jl. Talang Keramat RT.16 RW.03 Kel. Talang Keramat Kec. Talang Kelapa', '0818612700', 'SIJAN,SATIMAH,EVI', 'PALEMBANG|PALEMBANG|PALEMBANG', '2023-02-22|2023-02-22|2023-02-14', 'Islam,Islam,Islam', 'S2,S1,D2', '0818612700,0818612700,0818612700', '-,-,-', '1.500.001 - 2.000.000,1.000.001 - 1.500.000,1.000.001 - 1.500.000', 'Jl. Talang Keramat RT.16 RW.03 Kel. Talang Keramat Kec. Talang Kelapa|Jl. Talang Keramat RT.16 RW.03 Kel. Talang Keramat Kec. Talang Kelapa', 'SMA N 3 PALEMBANG', 'IPA', NULL, 2023, '453455334', '56', '', NULL, '', NULL, '', '', '2023-02-24 11:02:02', '2023-02-24 11:09:02', '', '', NULL, '', '1607100808880007', 'Mahasiswa', NULL, NULL, 0, 0, 0, '', '', NULL, NULL, 1, 'dsfsdfsd', 'BANYUASIN', 'dsfsd', '546456456', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` char(100) NOT NULL,
  `username` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `foto` char(100) NOT NULL,
  `id_level` int(2) NOT NULL,
  `fakultas` int(11) NOT NULL,
  `prodi` char(10) DEFAULT NULL,
  `tgl_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL,
  `thn_akademik` int(11) NOT NULL,
  `nik` char(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `email`, `hp`, `foto`, `id_level`, `fakultas`, `prodi`, `tgl_submit`, `status`, `thn_akademik`, `nik`) VALUES
(38, 'ADMIN PMB', 'superadmin', '0192023a7bbd73250516f069df18b500', 'aripinzaenal212@gmail.com', '628978966588', '', 1, 0, '', '2023-02-07 09:55:26', 1, 0, ''),
(2064, 'Alisa Utari', 'alisautari', 'ffa793c31320470b6248a2fdf79836fe', 'utaria652@gmail.com', '', '', 3, 1, 'F4', '2023-02-01 12:53:18', 1, 6, NULL),
(2065, 'Indri Desthi Banowati', 'indridbanowati11', '8ad5941b13b1961d5125d87cf1ffba92', 'indridbanowati@gmail.com', '6282126472211', '', 3, 1, 'F4', '2023-02-01 14:16:25', 1, 6, NULL),
(2066, 'kaila shalfa humaira', 'kailashalfa27', '9cd2ab78dac22b5a10493ebb189448cf', 'kailashalfa27@gmail.com', '', '', 3, 1, 'F4', '2023-02-01 14:18:46', 1, 6, NULL),
(2067, 'NISRINA NURUNNISA', 'nisrina25', '737bad68b2b14e0f521cda7deb72a2da', 'nisrinanurunnisa@icloud.com', '085162840705', '', 3, 1, 'F4', '2023-02-01 14:31:10', 1, 6, NULL),
(2069, 'Mila kamelia sari', 'Mila kamelia sari', 'b972d8fa197e395ed2e01d6da40a7411', 'milakameliasari5@gmail.com', '', '', 3, 1, 'F4', '2023-02-01 15:27:49', 1, 6, NULL),
(2070, 'Sipa Fauziah', 'Sipa Fauziah', 'e5e6741a87fae84eb273d594f4bd6a59', 'sipaaaffauz@gmail.com', '087715895642', '', 3, 1, 'F4', '2023-02-01 21:40:03', 1, 6, NULL),
(2072, 'Muhamad Tegar Rahendrawan', 'Muhamad Tegar R', '96f4f280351188364a58e433356f51b3', 'rahendrawanm@gmail.com', '6281546979134', '', 3, 1, 'F4', '2023-02-02 03:50:41', 1, 6, NULL),
(2073, 'Ajeng Niswa Nurfatwa', 'ajengniswa394', '85d04c638b342e0c13d046aa4876c31a', 'ajengniswa919@gmail.com', '6285722344540', '', 3, 1, 'F4', '2023-02-02 05:23:30', 1, 6, NULL),
(2074, 'Azka Nurul Azkiya', 'azkiyaa', '4d76859fe42a507a5d93b597199aa07d', 'aazkiya527@gmail.com', '085793325336', '', 3, 1, 'F4', '2023-02-03 01:53:44', 1, 6, NULL),
(2075, 'ISMA AULIA YUNINGSIH', 'ISMA AULIA YUNINGSIH', 'ebac7e077c0ef9b6dd2ab181f359718f', 'ismaauliayuningsih8@gmail.com', '6285703285476', '', 3, 1, 'F4', '2023-02-02 12:12:35', 1, 6, NULL),
(2076, 'Indah Nurfadilah', 'Indah nurfadilah', '01951c8d01d26e1fdb8edc081f65159f', 'indahnurfadilah294@gmail.com', '082120839170', '', 3, 1, 'F4', '2023-02-02 14:55:38', 1, 6, NULL),
(2077, 'IRA NAYRA SYAHLA BELLA', 'Iranayrasyahlabella', 'b64a81ecd7b6eafa8a9214317d85b529', 'iranayrasyahlabella20@gmail.com', '081395071974', '', 3, 1, 'K1', '2023-02-02 15:18:14', 1, 6, NULL),
(2078, 'NIRMA lUTFI FAHLEFI', 'NIRMALUTFIFAHLEFI', 'cb7e4945e4ce932bbbe898862fad7083', 'nirmalutfifahlefi@gmail', '085624556450', '', 3, 1, 'F4', '2023-02-03 05:31:41', 1, 6, NULL),
(2079, 'Simah kamaliya', 'simahkmly@gmail.com', '9a286406c252a3d14218228974e1f567', 'simahkimberly@gmail.com', '6281292632351', 'a5c0cb7cb4470c0292f2546f33da1d53.jpeg', 3, 1, 'K1', '2023-02-19 10:38:46', 1, 6, NULL),
(2080, 'Aneu Nurpalah', 'aneunrplh', '7b18e7850e30a68deff148f2110529e9', 'aneunurpalah01@gmail.com', '085220226379', '', 3, 1, 'K1', '2023-02-04 14:18:27', 1, 6, NULL),
(2082, 'Zulfa Marwatus Sa\'adah', 'zulfams', '31b76f712c60dbda0278e8f9fa568307', 'Zulfamarwa23@gmail.com', '628987189536', '', 3, 1, 'F4', '2023-02-06 08:37:11', 1, 6, NULL),
(2083, 'NITA FITRIANI', 'Nita Fitriani', '30ce4f1312c0306cb0547a00ff4e9345', 'hasbimunawargozali@gmail.com', '085721652935', '', 3, 1, 'F4', '2023-02-06 12:07:15', 1, 6, NULL),
(2084, 'Muhamad Umar Maruf', 'Ma\'ruf', 'b9fb0d19a8f44b093d50d8edc403ec23', 'umarmaruf417@gmail.com', '6287794019245', '', 3, 1, 'F4', '2023-02-06 16:26:52', 1, 6, NULL),
(2085, 'Jujun', 'jujun', '202cb962ac59075b964b07152d234b70', 'fdapa@ad.ac.id', '', 'cb5f48d935cd4b6bacd820c654184ccb.jpg', 3, 1, 'F4', '2023-02-07 09:19:51', 1, 6, NULL),
(2086, 'Edi Sudarsono', 'pertapacilik', 'e172dd95f4feb21412a692e73929961e', 'e612700@gmail.com', '0818612700', '', 3, 1, 'F4', '2023-02-24 04:03:18', 1, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penghasilan`
--

CREATE TABLE `penghasilan` (
  `id` int(11) NOT NULL,
  `kode` char(2) NOT NULL,
  `nama` char(100) NOT NULL,
  `keterangan` char(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `penghasilan`
--

INSERT INTO `penghasilan` (`id`, `kode`, `nama`, `keterangan`, `created_at`) VALUES
(1, 'A', '< 500.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29'),
(2, 'B', '500.001 - 1.000.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29'),
(3, 'C', '1.000.001 - 1.500.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29'),
(4, 'D', '1.500.001 - 2.000.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29'),
(5, 'E', '2.000.001 - 3.000.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29'),
(6, 'F', '3.000.001 - 5.000.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29'),
(7, 'G', '> 5.000.000', 'PENGHASILAN ORANGTUA', '2015-11-17 09:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `fakultas` int(2) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `kode` char(10) NOT NULL,
  `nama` char(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `namabank` varchar(100) NOT NULL,
  `norek` varchar(30) NOT NULL,
  `biaya` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `rincian_regis` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `fakultas`, `jenjang`, `kode`, `nama`, `created_at`, `namabank`, `norek`, `biaya`, `status`, `rincian_regis`) VALUES
(1, 1, 'S1', 'F4', 'Farmasi', '2023-02-01 00:05:19', 'BNI (an. Fakultas MIPA)', '0360289921', '250000', 1, ''),
(2, 1, 'S1', 'K1', 'Kimia', '2023-02-01 00:05:19', 'BNI (an. Fakultas MIPA Kimia)', '3456712349', '250000', 1, ''),
(3, 2, 'Profesi', 'A0', 'Profesi Apoteker', '2023-02-01 00:05:19', 'BNI (a/n. Profesi Apoteker)', '4442019442', '500000', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `fakultas` varchar(11) DEFAULT NULL,
  `kode` char(2) NOT NULL,
  `nama` char(100) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tipe_program` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `fakultas`, `kode`, `nama`, `status`, `keterangan`, `tipe_program`) VALUES
(13, '2', 'PA', 'Profesi (Khusus Apoteker)', 1, '', 'Berbayar'),
(22, NULL, 'D', 'Prestasi', 1, '', 'Gratis'),
(19, '2', 'C', 'PMDK Raport', 1, '', 'Gratis'),
(20, '2', 'D', 'PMDK Undangan', 0, '', ''),
(23, NULL, 'B', 'Seksi Mandiri PTS', 1, '', 'Berbayar');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` int(10) NOT NULL,
  `kode_gedung` int(11) NOT NULL,
  `idjenis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `lantai` varchar(5) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `kode_gedung`, `idjenis`, `nama`, `lantai`, `created_at`) VALUES
(38, 3, 8, 'Lab. Komputer FMIPA UNIGA', '1', '2021-12-03 03:09:06'),
(55, 4, 8, 'Lab. Komputer Fakultas MIPA', '2', '2021-12-03 03:11:01'),
(57, 3, 7, 'Zoom Meetings', '1', '2021-04-19 08:35:21'),
(58, 9, 7, 'Gedung D Fakultas MIPA', '2', '2021-12-06 11:00:21'),
(59, 3, 8, 'Kampus 3 & 4 UNIGA', '1', '2022-04-15 14:08:54'),
(60, 3, 7, 'Kampus 3 UNIGA', '1', '2022-04-15 14:09:24'),
(61, 3, 9, 'Kampus 4 UNIGA', '1', '2022-06-07 08:44:34'),
(62, 9, 8, 'Ruangan OSCE Kampus 4 UNIGA', '1', '2022-06-28 13:46:28'),
(63, 9, 7, 'Ruangan CBT Kampus 4 UNIGA', '3', '2022-06-28 13:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `sumber_informasi`
--

CREATE TABLE `sumber_informasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sumber_informasi`
--

INSERT INTO `sumber_informasi` (`id`, `nama`, `status`, `urutan`) VALUES
(1, 'Dosen', 0, 11),
(2, 'Radio', 1, 5),
(3, 'Sosial Media', 1, 1),
(4, 'Koran', 1, 4),
(5, 'Brosur', 1, 6),
(6, 'Spanduk', 1, 3),
(7, 'Mahasiswa', 1, 7),
(8, 'Lainnya', 1, 12),
(9, 'Staf / Karyawan Perguruan Tinggi', 1, 8),
(10, 'Alumni', 1, 9),
(11, 'Guru BK', 1, 10),
(13, 'Website', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id_thn_akademik` int(11) NOT NULL,
  `nama_thn_akademik` varchar(20) NOT NULL,
  `status_thn_akademik` int(1) NOT NULL,
  `utama_thn_akademik` int(11) NOT NULL,
  `berlaku` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id_thn_akademik`, `nama_thn_akademik`, `status_thn_akademik`, `utama_thn_akademik`, `berlaku`) VALUES
(6, '2023/2024', 1, 1, '2023-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `opsi1` varchar(75) NOT NULL,
  `opsi2` varchar(75) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `level` varchar(50) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `opsi1`, `opsi2`, `keterangan`, `level`, `ts`) VALUES
(1, 'superadmin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'ADMIN PMB', '', '', '', 'admin', '2015-07-29 18:12:03'),
(5, 'joko', '97c358728f7f947c9a279ba9be88308395c7cc3a', 'Joko', '', '', 'Haloo', 'admin', '2019-12-12 02:53:12'),
(9, 'operator', 'e10adc3949ba59abbe56e057f20f883e', 'Operator', '', '', '', 'operator-tes', '2022-09-23 04:31:00'),
(10, 'operator2', '7d014645468c18555374b9e5c3a8ffe2172297b3', 'Acuy', '', '', '-', 'operator-tes', '2022-09-23 23:33:10'),
(11, 'operator3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'aaa', '', '', '-', 'admin', '2022-09-23 23:38:51'),
(12, 'superadmina', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'a', '', '', '-', 'admin', '2022-09-23 23:41:15'),
(13, 'tia', '601f1889667efaebb33b8c12572835da3f027f78', 'Tia Rahayu', '', '', '', 'operator-tes', '2023-02-01 12:32:49'),
(14, 'mimah', '601f1889667efaebb33b8c12572835da3f027f78', 'MImah Rohimah', '', '', '', 'operator-tes', '2023-02-01 12:33:35'),
(15, 'sri', '601f1889667efaebb33b8c12572835da3f027f78', 'Sri', '', '', '', 'operator-tes', '2023-02-01 14:50:11'),
(16, 'doni_fmipa', 'a805768b11dbfe32547b90be7242ff10772d0d4a', 'Doni Anshar Nuari', '', '', '', 'admin', '2023-02-05 22:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_akses`
--

CREATE TABLE `user_akses` (
  `id` int(11) NOT NULL,
  `level` varchar(75) NOT NULL,
  `kode_menu` varchar(50) NOT NULL,
  `add` int(2) NOT NULL DEFAULT 1 COMMENT '0=false, 1=true',
  `edit` int(2) NOT NULL DEFAULT 1 COMMENT '0=false, 1=true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_akses`
--

INSERT INTO `user_akses` (`id`, `level`, `kode_menu`, `add`, `edit`) VALUES
(254, 'operator-soal', 'modul-daftar', 1, 1),
(255, 'operator-soal', 'modul-filemanager', 1, 1),
(256, 'operator-soal', 'modul-import', 1, 1),
(257, 'operator-soal', 'modul-soal', 1, 1),
(258, 'operator-soal', 'modul-topik', 1, 1),
(259, 'operator-tes', 'tes-hasil-operator', 1, 1),
(260, 'operator-tes', 'tes-token', 1, 1),
(481, 'admin', 'laporan-analisis-butir-soal', 1, 1),
(482, 'admin', 'peserta-kartu', 1, 1),
(483, 'admin', 'peserta-group', 1, 1),
(484, 'admin', 'peserta-daftar', 1, 1),
(485, 'admin', 'modul-daftar', 1, 1),
(486, 'admin', 'tes-daftar', 1, 1),
(487, 'admin', 'tool-backup', 1, 1),
(488, 'admin', 'tes-evaluasi', 1, 1),
(489, 'admin', 'tool-exportimport-soal', 1, 1),
(490, 'admin', 'modul-filemanager', 1, 1),
(491, 'admin', 'tes-hasil', 1, 1),
(492, 'admin', 'peserta-import', 1, 1),
(493, 'admin', 'modul-import', 1, 1),
(494, 'admin', 'modul-import-word', 1, 1),
(496, 'admin', 'user_level', 1, 1),
(497, 'admin', 'user_menu', 1, 1),
(498, 'admin', 'user_atur', 1, 1),
(499, 'admin', 'user-zyacbt', 1, 1),
(500, 'admin', 'laporan-rekap', 1, 1),
(501, 'admin', 'modul-soal', 1, 1),
(502, 'admin', 'tes-tambah', 1, 1),
(503, 'admin', 'tes-token', 1, 1),
(504, 'admin', 'modul-topik', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `level`, `keterangan`) VALUES
(1, 'admin', 'Administrator'),
(7, 'operator-soal', 'Operator Soal'),
(8, 'operator-tes', 'Operator Tes');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `log` varchar(250) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `tipe` int(11) NOT NULL DEFAULT 1 COMMENT '0=parent, 1=child',
  `parent` varchar(50) DEFAULT NULL,
  `kode_menu` varchar(50) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL DEFAULT '#',
  `icon` varchar(75) NOT NULL DEFAULT 'fa fa-circle-o',
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `tipe`, `parent`, `kode_menu`, `nama_menu`, `url`, `icon`, `urutan`) VALUES
(1, 0, '', 'user', 'Pengaturan', '#', 'fa fa-user', 20),
(3, 1, 'user', 'user_atur', 'Pengaturan User', 'manager/useratur', 'fa fa-circle-o', 5),
(4, 1, 'user', 'user_level', 'Pengaturan Level', 'manager/userlevel', 'fa fa-circle-o', 6),
(5, 1, 'user', 'user_menu', 'Pengaturan Menu', 'manager/usermenu', 'fa fa-circle-o', 7),
(6, 0, '', 'modul', 'Data Modul', '#', 'fa fa-book', 2),
(7, 1, 'modul', 'modul-daftar', 'Daftar Soal', 'manager/modul_daftar', 'fa fa-circle-o', 5),
(8, 1, 'modul', 'modul-topik', 'Topik', 'manager/modul_topik', 'fa fa-circle-o', 2),
(10, 0, '', 'peserta', 'Data Peserta', '#', 'fa fa-users', 3),
(11, 1, 'peserta', 'peserta-daftar', 'Daftar Peserta', 'manager/peserta_daftar', 'fa fa-circle-o', 2),
(12, 1, 'peserta', 'peserta-group', 'Daftar Group', 'manager/peserta_group', 'fa fa-circle-o', 1),
(13, 1, 'peserta', 'peserta-import', 'Import Data Peserta', 'manager/peserta_import', 'fa fa-circle-o', 3),
(14, 0, '', 'tes', 'Data Tes', '#', 'fa fa-tasks', 4),
(15, 1, 'tes', 'tes-tambah', 'Tambah Tes', 'manager/tes_tambah', 'fa fa-circle-o', 1),
(16, 1, 'tes', 'tes-daftar', 'Daftar Tes', 'manager/tes_daftar', 'fa fa-circle-o', 2),
(17, 1, 'tes', 'tes-hasil', 'Hasil Tes', 'manager/tes_hasil', 'fa fa-circle-o', 6),
(18, 1, 'modul', 'modul-soal', 'Soal', 'manager/modul_soal', 'fa fa-circle-o', 3),
(19, 1, 'tes', 'tes-token', 'Token', 'manager/tes_token', 'fa fa-circle-o', 8),
(22, 1, 'modul', 'modul-filemanager', 'File Manager', 'manager/modul_filemanager', 'fa fa-circle-o', 6),
(24, 1, 'modul', 'modul-import', 'Import Soal Spreadsheet', 'manager/modul_import', 'fa fa-circle-o', 4),
(25, 1, 'tes', 'tes-evaluasi', 'Evaluasi Tes', 'manager/tes_evaluasi', 'fa fa-circle-o', 5),
(28, 1, 'tes', 'tes-hasil-operator', 'Hasil Tes Operator', 'manager/tes_hasil_operator', 'fa fa-circle-o', 10),
(30, 0, '', 'tool', 'Tool', '#', 'fa fa-wrench', 6),
(31, 1, 'tool', 'tool-backup', 'Database', 'manager/tool_backup', 'fa fa-database', 1),
(32, 1, 'tes-laporan', 'laporan-rekap', 'Rekap Hasil Tes', 'manager/laporan_rekap_hasil', 'fa fa-circle-o', 7),
(33, 1, 'tool', 'tool-exportimport-soal', 'Export / Import Soal', 'manager/tool_exportimport_soal', 'fa fa-circle-o', 2),
(34, 1, 'user', 'user-zyacbt', 'Pengaturan ZYACBT', 'manager/pengaturan_zyacbt', 'fa fa-circle-o', 1),
(37, 1, 'peserta', 'peserta-kartu', 'Cetak Kartu', 'manager/peserta_kartu', 'fa fa-circle-o', 5),
(38, 0, '', 'tes-laporan', 'Laporan', '#', 'fa fa-print', 5),
(41, 1, 'tes-laporan', 'laporan-analisis-butir-soal', 'Analisis Butir Soal', 'manager/laporan_analisis_butir_soal', 'fa fa-circle-o', 1),
(42, 1, 'tes-laporan', 'laporan-analisis-soal', 'Analisis Soal', 'manager/laporan_analisis_soal', 'fa fa-circle-o', 2),
(43, 1, 'modul', 'modul-import-word', 'Import Soal Word', 'manager/modul_import_word', 'fa fa-circle-o', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agen_pengajuan`
--
ALTER TABLE `agen_pengajuan`
  ADD PRIMARY KEY (`id_komisi`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `berkas_masuk`
--
ALTER TABLE `berkas_masuk`
  ADD PRIMARY KEY (`id_berkas_masuk`);

--
-- Indexes for table `biaya`
--
ALTER TABLE `biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cbt_jawaban`
--
ALTER TABLE `cbt_jawaban`
  ADD PRIMARY KEY (`jawaban_id`),
  ADD KEY `p_answer_question_id` (`jawaban_soal_id`);

--
-- Indexes for table `cbt_konfigurasi`
--
ALTER TABLE `cbt_konfigurasi`
  ADD PRIMARY KEY (`konfigurasi_id`),
  ADD UNIQUE KEY `konfigurasi_kode` (`konfigurasi_kode`);

--
-- Indexes for table `cbt_modul`
--
ALTER TABLE `cbt_modul`
  ADD PRIMARY KEY (`modul_id`),
  ADD UNIQUE KEY `ak_module_name` (`modul_nama`);

--
-- Indexes for table `cbt_sessions`
--
ALTER TABLE `cbt_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `cbt_soal`
--
ALTER TABLE `cbt_soal`
  ADD PRIMARY KEY (`soal_id`),
  ADD KEY `p_question_subject_id` (`soal_topik_id`);

--
-- Indexes for table `cbt_tes`
--
ALTER TABLE `cbt_tes`
  ADD PRIMARY KEY (`tes_id`),
  ADD UNIQUE KEY `ak_test_name` (`tes_nama`);

--
-- Indexes for table `cbt_tesgrup`
--
ALTER TABLE `cbt_tesgrup`
  ADD PRIMARY KEY (`tstgrp_tes_id`,`tstgrp_grup_id`),
  ADD KEY `p_tstgrp_test_id` (`tstgrp_tes_id`),
  ADD KEY `p_tstgrp_group_id` (`tstgrp_grup_id`);

--
-- Indexes for table `cbt_tes_soal`
--
ALTER TABLE `cbt_tes_soal`
  ADD PRIMARY KEY (`tessoal_id`),
  ADD UNIQUE KEY `ak_testuser_question` (`tessoal_tesuser_id`,`tessoal_soal_id`),
  ADD KEY `p_testlog_question_id` (`tessoal_soal_id`),
  ADD KEY `p_testlog_testuser_id` (`tessoal_tesuser_id`);

--
-- Indexes for table `cbt_tes_soal_jawaban`
--
ALTER TABLE `cbt_tes_soal_jawaban`
  ADD PRIMARY KEY (`soaljawaban_tessoal_id`,`soaljawaban_jawaban_id`),
  ADD KEY `p_logansw_answer_id` (`soaljawaban_jawaban_id`),
  ADD KEY `p_logansw_testlog_id` (`soaljawaban_tessoal_id`);

--
-- Indexes for table `cbt_tes_token`
--
ALTER TABLE `cbt_tes_token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `token_user_id` (`token_user_id`);

--
-- Indexes for table `cbt_tes_topik_set`
--
ALTER TABLE `cbt_tes_topik_set`
  ADD PRIMARY KEY (`tset_id`),
  ADD KEY `p_tsubset_test_id` (`tset_tes_id`),
  ADD KEY `tsubset_subject_id` (`tset_topik_id`);

--
-- Indexes for table `cbt_tes_user`
--
ALTER TABLE `cbt_tes_user`
  ADD PRIMARY KEY (`tesuser_id`),
  ADD UNIQUE KEY `ak_testuser` (`tesuser_tes_id`,`tesuser_user_id`,`tesuser_status`),
  ADD KEY `p_testuser_user_id` (`tesuser_user_id`),
  ADD KEY `p_testuser_test_id` (`tesuser_tes_id`);

--
-- Indexes for table `cbt_topik`
--
ALTER TABLE `cbt_topik`
  ADD PRIMARY KEY (`topik_id`),
  ADD UNIQUE KEY `ak_subject_name` (`topik_modul_id`,`topik_nama`);

--
-- Indexes for table `cbt_user`
--
ALTER TABLE `cbt_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ak_user_name` (`user_name`),
  ADD KEY `user_groups_id` (`user_grup_id`),
  ADD KEY `user_detail` (`user_detail`);

--
-- Indexes for table `cbt_user_grup`
--
ALTER TABLE `cbt_user_grup`
  ADD PRIMARY KEY (`grup_id`),
  ADD UNIQUE KEY `group_name` (`grup_nama`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `gelombang`
--
ALTER TABLE `gelombang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jadwalusm`
--
ALTER TABLE `jadwalusm`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jalur`
--
ALTER TABLE `jalur`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenisusm`
--
ALTER TABLE `jenisusm`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komisi`
--
ALTER TABLE `komisi`
  ADD PRIMARY KEY (`id_komisi`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `maba_konfirmasi_bayar`
--
ALTER TABLE `maba_konfirmasi_bayar`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `penghasilan`
--
ALTER TABLE `penghasilan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sumber_informasi`
--
ALTER TABLE `sumber_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id_thn_akademik`),
  ADD UNIQUE KEY `nama_thn_akademik` (`nama_thn_akademik`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `user_akses`
--
ALTER TABLE `user_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_kode_menu` (`kode_menu`),
  ADD KEY `akses_level` (`level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_menu` (`kode_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agen_pengajuan`
--
ALTER TABLE `agen_pengajuan`
  MODIFY `id_komisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `berkas_masuk`
--
ALTER TABLE `berkas_masuk`
  MODIFY `id_berkas_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `biaya`
--
ALTER TABLE `biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cbt_jawaban`
--
ALTER TABLE `cbt_jawaban`
  MODIFY `jawaban_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=626;

--
-- AUTO_INCREMENT for table `cbt_konfigurasi`
--
ALTER TABLE `cbt_konfigurasi`
  MODIFY `konfigurasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cbt_modul`
--
ALTER TABLE `cbt_modul`
  MODIFY `modul_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cbt_soal`
--
ALTER TABLE `cbt_soal`
  MODIFY `soal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `cbt_tes`
--
ALTER TABLE `cbt_tes`
  MODIFY `tes_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cbt_tes_soal`
--
ALTER TABLE `cbt_tes_soal`
  MODIFY `tessoal_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cbt_tes_token`
--
ALTER TABLE `cbt_tes_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cbt_tes_topik_set`
--
ALTER TABLE `cbt_tes_topik_set`
  MODIFY `tset_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cbt_tes_user`
--
ALTER TABLE `cbt_tes_user`
  MODIFY `tesuser_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cbt_topik`
--
ALTER TABLE `cbt_topik`
  MODIFY `topik_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cbt_user`
--
ALTER TABLE `cbt_user`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cbt_user_grup`
--
ALTER TABLE `cbt_user_grup`
  MODIFY `grup_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gelombang`
--
ALTER TABLE `gelombang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwalusm`
--
ALTER TABLE `jadwalusm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jalur`
--
ALTER TABLE `jalur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `jenisusm`
--
ALTER TABLE `jenisusm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `komisi`
--
ALTER TABLE `komisi`
  MODIFY `id_komisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maba_konfirmasi_bayar`
--
ALTER TABLE `maba_konfirmasi_bayar`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2087;

--
-- AUTO_INCREMENT for table `penghasilan`
--
ALTER TABLE `penghasilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sumber_informasi`
--
ALTER TABLE `sumber_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id_thn_akademik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_akses`
--
ALTER TABLE `user_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cbt_jawaban`
--
ALTER TABLE `cbt_jawaban`
  ADD CONSTRAINT `cbt_jawaban_ibfk_1` FOREIGN KEY (`jawaban_soal_id`) REFERENCES `cbt_soal` (`soal_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_soal`
--
ALTER TABLE `cbt_soal`
  ADD CONSTRAINT `cbt_soal_ibfk_1` FOREIGN KEY (`soal_topik_id`) REFERENCES `cbt_topik` (`topik_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_tesgrup`
--
ALTER TABLE `cbt_tesgrup`
  ADD CONSTRAINT `cbt_tesgrup_ibfk_1` FOREIGN KEY (`tstgrp_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tesgrup_ibfk_2` FOREIGN KEY (`tstgrp_grup_id`) REFERENCES `cbt_user_grup` (`grup_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_tes_soal`
--
ALTER TABLE `cbt_tes_soal`
  ADD CONSTRAINT `cbt_tes_soal_ibfk_1` FOREIGN KEY (`tessoal_tesuser_id`) REFERENCES `cbt_tes_user` (`tesuser_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tes_soal_ibfk_2` FOREIGN KEY (`tessoal_soal_id`) REFERENCES `cbt_soal` (`soal_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_tes_soal_jawaban`
--
ALTER TABLE `cbt_tes_soal_jawaban`
  ADD CONSTRAINT `cbt_tes_soal_jawaban_ibfk_1` FOREIGN KEY (`soaljawaban_tessoal_id`) REFERENCES `cbt_tes_soal` (`tessoal_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tes_soal_jawaban_ibfk_2` FOREIGN KEY (`soaljawaban_jawaban_id`) REFERENCES `cbt_jawaban` (`jawaban_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_tes_token`
--
ALTER TABLE `cbt_tes_token`
  ADD CONSTRAINT `cbt_tes_token_ibfk_1` FOREIGN KEY (`token_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cbt_tes_topik_set`
--
ALTER TABLE `cbt_tes_topik_set`
  ADD CONSTRAINT `cbt_tes_topik_set_ibfk_1` FOREIGN KEY (`tset_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cbt_tes_topik_set_ibfk_2` FOREIGN KEY (`tset_topik_id`) REFERENCES `cbt_topik` (`topik_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_tes_user`
--
ALTER TABLE `cbt_tes_user`
  ADD CONSTRAINT `cbt_tes_user_ibfk_1` FOREIGN KEY (`tesuser_tes_id`) REFERENCES `cbt_tes` (`tes_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cbt_tes_user_ibfk_2` FOREIGN KEY (`tesuser_user_id`) REFERENCES `cbt_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_topik`
--
ALTER TABLE `cbt_topik`
  ADD CONSTRAINT `cbt_topik_ibfk_1` FOREIGN KEY (`topik_modul_id`) REFERENCES `cbt_modul` (`modul_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cbt_user`
--
ALTER TABLE `cbt_user`
  ADD CONSTRAINT `cbt_user_ibfk_1` FOREIGN KEY (`user_grup_id`) REFERENCES `cbt_user_grup` (`grup_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `user_level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_akses`
--
ALTER TABLE `user_akses`
  ADD CONSTRAINT `user_akses_ibfk_2` FOREIGN KEY (`kode_menu`) REFERENCES `user_menu` (`kode_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_akses_ibfk_3` FOREIGN KEY (`level`) REFERENCES `user_level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
