
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
   <table>
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

    <table>
      <thead>

         <tr><th width="900" colspan="4" style="font-size: 18px;"><center>FORMULIR ISIAN DATA CALON MAHASISWA <br> Tahun Akademik <?php echo $gelombang->angkatan?><br><br></center></th>
        </tr>

      </thead>
      <tbody>

      <?php
            $kode1     = $detail_pendaftaran->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $detail_pendaftaran->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>

      <tr>
        <td colspan="4" style="font-size: 18px;"><strong>I. DATA PRIBADI</strong></td>
      </tr> 

      <tr>
        <td></td>
        <td width="150" style="text-align: top-left">Nama Lengkap </td>
        <td width="10">:</td>
        <td><?php echo $detail_pendaftaran->nama_lengkap?></td>
      </tr> 

      <tr>
        <td></td>
        <td>TTL </td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->tempat_lahir?>, <?php echo date('d-m-Y',strtotime($detail_pendaftaran->tanggal_lahir))?></td>
      </tr> 

      <tr>
        <td></td>
        <td>Agama </td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->agama?></td>
      </tr> 

       <tr>
        <td></td>
        <td>Email </td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->email?></td>
      </tr> 

       <tr>
        <td></td>
        <td>No. Telp </td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->hp?></td>
      </tr> 

      <tr>
        <td></td>
        <td>Jenis Kelamin </td>
        <td>:</td>
        <td><?php if($detail_pendaftaran->jk == 'L'){ ?>
          Laki-laki
        <?php }elseif($detail_pendaftaran->jk == 'P'){ ?>
          Perempuan
        <?php }else{ ?>
          -
        <?php } ?>
        </td>
      </tr>

      <tr>
        <td></td>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->alamat?></td>
      </tr>

      <tr>
        <td colspan="4" style="font-size: 18px;"><strong>II. DATA SEKOLAH</strong></td>
      </tr> 

      <?php if($detail_pendaftaran->jenis == 'MB') { ?>
      <tr>
        <td></td>
        <td>NISN</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->nisn?></td>
      </tr>

      <tr>
        <td></td>
        <td>Asal Sekolah</td>
        <td>:</td>
        <?php if($detail_pendaftaran->sekolah_nama == '') { ?>
        <td><?php echo $detail_pendaftaran->kampus_asal ?></td>
        <?php }else{ ?>
        <td><?php echo $detail_pendaftaran->sekolah_nama?></td>
        <?php } ?>
      </tr>

      <tr>
        <td></td>
        <td>Jurusan</td>
        <td>:</td>
        <?php if($detail_pendaftaran->jenjang == 'Profesi') { ?>
        <td><?php echo $detail_pendaftaran->kampus_asal ?></td>
        <?php }else{ ?>
        <td><?php echo $detail_pendaftaran->sekolah_jurusan; ?></td>
        <?php } ?>
      </tr>

      <?php if($detail_pendaftaran->jenjang == 'Profesi') { ?>
      <tr>
        <td></td>
        <td>IPK</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->ipk ?></td>
      </tr>
      <?php } ?>

      <tr>
        <td></td>
        <td>Tahun Lulus</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->tahun_lulus; ?></td>
      </tr>

      <?php }elseif($detail_pendaftaran->jenis == 'PD') { ?>

      <tr>
        <td></td>
        <td>Asal Kampus</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->pindahan_namapt ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Asal Faultas</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->pindahan_fakultas ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Asal Program Studi</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->pindahan_prodi ?></td>
      </tr>

      <tr>
        <td></td>
        <td>NIM</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->pindahan_nim ?></td>
      </tr>

      <?php } ?>


      <tr>
        <td colspan="4" style="font-size: 18px;"><strong>III. DATA ORANG TUA / WALI</strong></td>
      </tr> 

       <?php $nama_ortu = explode(",", $detail_pendaftaran->ortu_nama ); ?>
       <?php $pendidikan_ortu = explode(",", $detail_pendaftaran->ortu_pendidikan); ?>
       <?php $pekerjaan_ortu = explode(",", $detail_pendaftaran->ortu_pekerjaan); ?>
       <?php $penghasilan = explode(",", $detail_pendaftaran->ortu_penghasilan ); ?>
       <?php $hp_ortu = explode(",", $detail_pendaftaran->ortu_hp); ?>
       <?php $ortu_alamat = explode("|", $detail_pendaftaran->ortu_alamat ); ?>

       <tr>
        <td></td>
        <td>Nama Ayah</td>
        <td>:</td>
        <td><?php echo $nama_ortu[0] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Pekerjaan Ayah</td>
        <td>:</td>
        <td><?php echo $pekerjaan_ortu[0] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Penghasilan Ayah</td>
        <td>:</td>
        <td><?php echo $penghasilan[0] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>No. Telp Ayah</td>
        <td>:</td>
        <td><?php echo $hp_ortu[0] ?></td>
      </tr>


      <tr>
        <td></td>
        <td>Nama Ibu</td>
        <td>:</td>
        <td><?php echo $nama_ortu[1] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Pekerjaan Ibu</td>
        <td>:</td>
        <td><?php echo $pekerjaan_ortu[1] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Penghasilan Ibu</td>
        <td>:</td>
        <td><?php echo $penghasilan[1] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>No. Telp Ibu</td>
        <td>:</td>
        <td><?php echo $hp_ortu[1] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Alamat Orang Tua</td>
        <td>:</td>
        <td><?php echo $ortu_alamat[0]?></td>
      </tr>

      <tr>
        <td></td>
        <td>Nama Wali</td>
        <td>:</td>
        <td><?php echo $nama_ortu[2] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Pekerjaan Wali</td>
        <td>:</td>
        <td><?php echo $pekerjaan_ortu[2] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Penghasilan Wali</td>
        <td>:</td>
        <td><?php echo $penghasilan[2] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>No. Telp Wali</td>
        <td>:</td>
        <td><?php echo $hp_ortu[2] ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Alamat Wali</td>
        <td>:</td>
        <td><?php echo $ortu_alamat[1]?></td>
      </tr>

      <tr><td colspan="4"><br><br><br><br><br><br><br><br><br><br><br></td></tr>

      <tr>
        <td colspan="4" style="font-size: 18px;"><strong>IV. DATA UTAMA CALON MAHASISWA</td>
      </tr> 

      <tr>
        <td></td>
        <td>Nomor Ujian</td>
        <td>:</td>
        <td><?php echo $detail_pendaftaran->noujian?></td>
      </tr>

      <tr>
        <td></td>
        <td>Gelombang</td>
        <td>:</td>
        <?php $gelombang = $detail_pendaftaran->gelombang?>
        <?php $detail_gelombang     = $this->admin_model->popup_gelombang($gelombang)?>
        <td><?php echo $detail_gelombang->nama ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Jenis Pendaftaran</td>
        <td>:</td>
        <?php if($detail_pendaftaran->jenis == 'MB') { ?>
        <td>Mahasiswa Baru</td>
        <?php }elseif($detail_pendaftaran->jenis == 'PD') { ?>
        <td>Mahasiswa Pindahan</td>
        <?php } ?>
      </tr>

      <tr>
        <td></td>
        <td>Jalur Pendaftaran</td>
        <td>:</td>
        <td><?php if($detail_pendaftaran->program ==''){echo "-";}else{ echo $kartu_program->nama; } ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Pilihan 1</td>
        <td>:</td>
        <td><?php if($detail_pendaftaran->jurusan_pilihan =='0'){echo "-";}else{ ?>
          <?php echo $pilihan1->jenjang;?> <?php echo $pilihan1->nama; } ?></td>
      </tr>

      <tr>
        <td></td>
        <td>Pilihan 2</td>
        <td>:</td>
        <td><?php if($detail_pendaftaran->jurusan_pilihan2 =='0'){echo "-";}else{ ?>
          <?php echo $pilihan2->jenjang;?> <?php echo $pilihan2->nama; } ?></td>
      </tr>

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

    


    
 