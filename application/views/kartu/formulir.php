
<html>
<head>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo  $title?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/form/css/style3.css">
  <style type="text/css">
    .box{
        width:710px;
        height:440px;
        background:#FFFAF0);
        display: inline-block;
        margin-left: 0px;
        padding-left: 0px;
      }
      h4{
        text-align: left;
      }

      th{
        font-family: Cambria,"Times New Roman",serif;
        padding-bottom: 12px;
      }
      td{
        font-family: Cambria,"Times New Roman",serif;
      }
      img{
        padding-bottom: 8px;
      }
	      b{
	        font-size: 25px;
	      }
	      .form-table{
	        width: 900px;
	        border-collapse: collapse;
	      }
	      .section-title td{
	        font-size: 18px;
	        font-weight: bold;
	        padding-top: 10px;
	        padding-bottom: 5px;
	      }
	      .field-label{
	        width: 145px;
	        vertical-align: top;
	        padding: 2px 4px;
	      }
	      .field-separator{
	        width: 10px;
	        vertical-align: top;
	        padding: 2px 2px;
	      }
	      .field-value{
	        width: 290px;
	        vertical-align: top;
	        padding: 2px 8px 2px 2px;
	      }
	      .field-value-full{
	        vertical-align: top;
	        padding: 2px 8px 2px 2px;
	      }

	  </style>
</head>
</heead>
<BODY onLoad="javascript: window.print()">
<?php
if (isset($_REQUEST['print']))
{
$print = $_REQUEST['print']; include "$print";
}

// 'Zapf-Chancery', cursive; 
// linear-gradient(to bottom, #33ccff 0%, #ffff99 100%
?>

<center>
<div class="box">
	    <table class="form-table">
	      <thead>
        <tr>
          <th width="110"><img style="padding-top: 10px; margin-right: 10px" src="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="125"></th>
          <th colspan="2" align="left"><b style="font-size: 25px"><?php echo strtoupper($detail_institusi->nama)?></b><br>
          <b style="font-size: 20px"><?php echo strtoupper($detail_fakultas->nama_fakultas)?></b> <br>
           <small><?php echo $detail_institusi->alamat?><br> Telp : <?php echo $detail_institusi->telp?>, Email : <?php echo $detail_institusi->email?><br> Website : <?php echo $detail_institusi->website?> </small></th></tr>
        <tr><th colspan="6"><b style="box-sizing: 30px"><hr></b></th>
        </tr>
      </thead>
    </table>

    <table class="form-table">
      <thead>

         <tr><th width="900" colspan="6" style="font-size: 18px;"><center>FORMULIR ISIAN DATA CALON MAHASISWA <br> Tahun Akademik <?php echo $gelombang->angkatan?><br><br></center></th>
        </tr>

      </thead>
      <tbody>

      <?php
            $kode1     = $detail_pendaftaran->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $detail_pendaftaran->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>

	      <?php
	        $jk = '-';
	        if($detail_pendaftaran->jk == 'L'){
	          $jk = 'Laki-laki';
	        }elseif($detail_pendaftaran->jk == 'P'){
	          $jk = 'Perempuan';
	        }

	        $jenis_pendaftaran = '-';
	        if($detail_pendaftaran->jenis == 'MB') {
	          $jenis_pendaftaran = 'Mahasiswa Baru';
	        }elseif($detail_pendaftaran->jenis == 'PD') {
	          $jenis_pendaftaran = 'Mahasiswa Pindahan';
	        }

	        $asal_sekolah = $detail_pendaftaran->sekolah_nama == '' ? $detail_pendaftaran->kampus_asal : $detail_pendaftaran->sekolah_nama;
	        $jurusan_sekolah = $detail_pendaftaran->jenjang == 'Profesi' ? $detail_pendaftaran->kampus_asal : $detail_pendaftaran->sekolah_jurusan;
	        $tanggal_lahir = '-';
	        if ($detail_pendaftaran->tanggal_lahir != '' && $detail_pendaftaran->tanggal_lahir != '0000-00-00') {
	          $tanggal_lahir = date('d-m-Y',strtotime($detail_pendaftaran->tanggal_lahir));
	        }
	        $ttl = trim($detail_pendaftaran->tempat_lahir) == '' && $tanggal_lahir == '-' ? '-' : trim($detail_pendaftaran->tempat_lahir).', '.$tanggal_lahir;
	        $pilihan_1 = $detail_pendaftaran->jurusan_pilihan == '0' || !$pilihan1 ? '-' : $pilihan1->jenjang.' '.$pilihan1->nama;
	        $pilihan_2 = $detail_pendaftaran->jurusan_pilihan2 == '0' || !$pilihan2 ? '-' : $pilihan2->jenjang.' '.$pilihan2->nama;
	        $gelombang_id = $detail_pendaftaran->gelombang;
	        $detail_gelombang = $this->admin_model->popup_gelombang($gelombang_id);
	        $nama_gelombang = $detail_gelombang ? $detail_gelombang->nama : '-';
	        $jalur = $detail_pendaftaran->program == '' ? '-' : $kartu_program->nama;

	        $nama_ortu = explode(",", $detail_pendaftaran->ortu_nama);
	        $pekerjaan_ortu = explode(",", $detail_pendaftaran->ortu_pekerjaan);
	        $penghasilan = explode(",", $detail_pendaftaran->ortu_penghasilan);
	        $hp_ortu = explode(",", $detail_pendaftaran->ortu_hp);
	        $ortu_alamat = explode("|", $detail_pendaftaran->ortu_alamat);

	        $val = function($value) {
	          return trim($value) == '' ? '-' : $value;
	        };
	        $arr = function($array, $index) use ($val) {
	          return isset($array[$index]) ? $val($array[$index]) : '-';
	        };
	        $parent = function($column, $array, $index) use ($detail_pendaftaran, $arr, $val) {
	          if (isset($detail_pendaftaran->$column) && trim((string) $detail_pendaftaran->$column) !== '') {
	            return $val($detail_pendaftaran->$column);
	          }

	          return $arr($array, $index);
	        };
	        $section = function($title) {
	          echo '<tr class="section-title"><td colspan="6">'.$title.'</td></tr>';
	        };
	        $grid = function($rows) {
	          foreach ($rows as $row) {
	            echo '<tr>';
	            echo '<td class="field-label">'.$row[0][0].'</td><td class="field-separator">:</td><td class="field-value">'.$row[0][1].'</td>';
	            if (isset($row[1])) {
	              echo '<td class="field-label">'.$row[1][0].'</td><td class="field-separator">:</td><td class="field-value">'.$row[1][1].'</td>';
	            } else {
	              echo '<td class="field-label"></td><td class="field-separator"></td><td class="field-value"></td>';
	            }
	            echo '</tr>';
	          }
	        };
	      ?>

	      <?php $section('I. DATA PRIBADI'); ?>
	      <?php $grid(array(
	        array(array('Nama Lengkap', $val($detail_pendaftaran->nama_lengkap)), array('TTL', $val($ttl))),
	        array(array('Agama', $val($detail_pendaftaran->agama)), array('Jenis Kelamin', $jk)),
	        array(array('Email', $val($detail_pendaftaran->email)), array('No. Telp', $val($detail_pendaftaran->hp))),
	        array(array('Alamat', $val($detail_pendaftaran->alamat)))
	      )); ?>

	      <?php $section('II. DATA SEKOLAH'); ?>
	      <?php if($detail_pendaftaran->jenis == 'MB') { ?>
	        <?php
	          $sekolah_rows = array(
	            array(array('NISN', $val($detail_pendaftaran->nisn)), array('Asal Sekolah', $val($asal_sekolah))),
	            array(array('Jurusan', $val($jurusan_sekolah)), array('Tahun Lulus', $val($detail_pendaftaran->tahun_lulus)))
	          );
	          if($detail_pendaftaran->jenjang == 'Profesi') {
	            $sekolah_rows[] = array(array('IPK', $val($detail_pendaftaran->ipk)));
	          }
	          $grid($sekolah_rows);
	        ?>
	      <?php }elseif($detail_pendaftaran->jenis == 'PD') { ?>
	        <?php $grid(array(
	          array(array('Asal Kampus', $val($detail_pendaftaran->pindahan_namapt)), array('Asal Fakultas', $val($detail_pendaftaran->pindahan_fakultas))),
	          array(array('Asal Program Studi', $val($detail_pendaftaran->pindahan_prodi)), array('NIM', $val($detail_pendaftaran->pindahan_nim)))
	        )); ?>
	      <?php } ?>

	      <?php $section('III. DATA ORANG TUA / WALI'); ?>
	      <?php $grid(array(
	        array(array('Nama Ayah', $parent('nama_ayah', $nama_ortu, 0)), array('Nama Ibu', $parent('nama_ibu', $nama_ortu, 1))),
	        array(array('Pekerjaan Ayah', $parent('pekerjaan_ayah', $pekerjaan_ortu, 0)), array('Pekerjaan Ibu', $parent('pekerjaan_ibu', $pekerjaan_ortu, 1))),
	        array(array('Penghasilan Ayah', $parent('penghasilan_ayah', $penghasilan, 0)), array('Penghasilan Ibu', $parent('penghasilan_ibu', $penghasilan, 1))),
	        array(array('No. Telp Ayah', $parent('hp_ayah', $hp_ortu, 0)), array('No. Telp Ibu', $parent('hp_ibu', $hp_ortu, 1))),
	        array(array('Alamat Orang Tua', $parent('alamat_orang_tua', $ortu_alamat, 0))),
	        array(array('Nama Wali', $parent('nama_wali', $nama_ortu, 2)), array('Pekerjaan Wali', $parent('pekerjaan_wali', $pekerjaan_ortu, 2))),
	        array(array('Penghasilan Wali', $parent('penghasilan_wali', $penghasilan, 2)), array('No. Telp Wali', $parent('hp_wali', $hp_ortu, 2))),
	        array(array('Alamat Wali', $parent('alamat_wali', $ortu_alamat, 1)))
	      )); ?>

	      <tr><td colspan="6"><br><br><br><br><br><br></td></tr>

	      <?php $section('IV. DATA UTAMA CALON MAHASISWA'); ?>
	      <?php $grid(array(
	        array(array('Nomor Ujian', $val($detail_pendaftaran->noujian)), array('Gelombang', $val($nama_gelombang))),
	        array(array('Jenis Pendaftaran', $jenis_pendaftaran), array('Jalur Pendaftaran', $val($jalur))),
	        array(array('Pilihan 1', $val($pilihan_1)), array('Pilihan 2', $val($pilihan_2)))
	      )); ?>

      </tbody>
    </table>

      
    <table>
    <body>


      <?php   

      error_reporting(0);

      $id_pendaftar = $detail_pendaftaran->id;
      $berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);

      $program = $detail_pendaftaran->program;
      $list_berkas_aktif = $this->admin_model->list_berkas_aktif($program); 
      ?>

      <?php if($berkas_terupload){ ?>
      <tr>
        <td colspan="4" style="font-size: 18px;"><strong>V. PERSYARATAN</td>
      </tr> 
      <?php } ?>

      <?php foreach ($list_berkas_aktif as $list_berkas_aktif) { ?>
      <tr>
      <?php
      $berkas_file = $list_berkas_aktif->id_berkas;
      $cek_detail_berkas_masuk = $this->admin_model->cek_detail_berkas_masuk($berkas_file,$id_pendaftar,$program);
      $berkas_masuk = $cek_detail_berkas_masuk->id_berkas;

      if($berkas_file != $berkas_masuk){ ?>
        <td colspan="2">
          <?php echo $list_berkas_aktif->nama_berkas ?></b>
        </td>
        <td>:</td>
        <td width="100">
          Belum Upload
        </td>

      <?php }else{ ?>

      <?php 
      $id_berkas = $list_berkas_aktif->id_berkas;
      $id_pendaftar = $detail_pendaftaran->id;
      $detail_berkas_masuk_full = $this->admin_model->detail_berkas_masuk_pendaftar($id_berkas,$id_pendaftar,$program);
      // print_r($detail_berkas_masuk_full->id_berkas);
      ?>

      <td colspan="2">
      <?php echo $detail_berkas_masuk_full->nama_berkas ?></b>  
      </td>
      <td>:</td>
      <td width="100">Sudah Upload
      </td>     

      <?php } ?>
      </tr>
      <?php } ?>

      <tr><td colspan="4" style="text-align: left"><br>Dan saya bertanggung jawab atas kebenaran data yang saya tulis / saya lampirkan.</td></tr>

      <tr><td><br><br><br><br><br><br><br><br><br><br><br></td></tr>
       
      </tbody>
    </table>


    <table>
      <tbody>

         <tr><td colspan="3" width="600"></td><td></td><td align="center" width="300"><?php echo $detail_institusi->kota?>,.........................<?php echo date('Y')?></td>
        </tr>
        <tr align="center"><td colspan="3"><strong>Menyetujui</strong> <br>Orang Tua / Wali,</td><td></td><td >Calon Mahasiswa,</td>
        </tr>

        <tr align="center"><td colspan="3">(................................)</td><td align="center">
          <?php if($detail_pendaftaran->foto!=''){ ?><img style="margin-bottom: 70px; margin-left: 60px" src="<?php echo base_url('assets/upload/profil/thumbs/'.$detail_pendaftaran->foto)?>" class="img img-responsive img-thumbnail" width="125">
          <?php }else{ ?>
            <img style="margin-bottom: 70px; margin-left: 60px" src="<?php echo base_url('assets/pasfoto4x6.png')?>" class="img img-responsive img-thumbnail" width="125">
          <?php } ?></td><td >(................................)</td>
        </tr>
      </tbody>
    </table>
  </div>
</center>
