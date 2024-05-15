<html>
<head>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo  $title?></title>
  <style type="text/css">
    .table1 {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
    }
 
    .table1, th, td {
    border: 1px solid #999;
    padding: 8px 20px;
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
<div >
   <table class="table1" cellpadding="3" >
      <thead>
        <tr>
          <th width="95"><img style="padding-top: 10px; margin-right: 2px" src="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="90"></th>
          <th colspan="6" align="left"><b style="font-size: 20px"><?php echo strtoupper($detail_institusi->nama)?></b><br>
          <b style="font-size: 16px"><?php echo strtoupper($detail_fakultas->nama_fakultas)?></b> <br>
           <small style="font-size: 11px"><?php echo $detail_institusi->alamat?> <br>Telp : <?php echo $detail_institusi->telp?> &nbsp; Email : <?php echo $detail_institusi->email?> <br> Website : <?php echo $detail_institusi->website?> </small></th></tr>            

      </thead>
      <tbody style="font-size: 12px">

      <tr style="background-color: rgb(19, 110, 170);
            color: white;">
        <td><center>FOTO PROFIL</center></td>
        <td colspan="3"><center>KARTU PESERTA UJIAN SARINGAN MASUK </center></td>
        <td colspan="2"><center>JADWAL UJIAN</center></td>
      </tr>

      <tr>
        <td rowspan="4">
          <center>
            <?php if ($detail_pendaftaran->foto == '') { ?>
                <img src="<?php echo base_url('assets/noavatarn.png')?>" width="120" class="img-fluid">
                <?php }else{ ?>
                <img src="<?php echo base_url('assets/upload/profil/'.$detail_pendaftaran->foto)?>" width="120" class="img-fluid">
                <?php }?>
            </center>
        </td>
        <td width="">Nama Lengkap</td>
        <td width="2">:</td>
        <td ><?php echo strtoupper($detail_pendaftaran->nama_lengkap) ?></td>
        <td width="230" colspan="2" rowspan="4">
          <center>
          <?php foreach ($jadwal_usm as $jadwal_usm) {?>
                <?php echo $jadwal_usm->J?> <br> 
                <?php $tanggal = date('D',strtotime($jadwal_usm->tgl_ujian));
                $hariList = array('Sun' => 'Minggu',
                                  'Mon' => 'Senin',
                                  'Tue' => 'Selasa',
                                  'Wed' => 'Rabu',
                                  'Thu' => 'Kamis',
                                  'Fri' => 'Jumat',
                                  'Sat' => 'Sabtu');
                 echo $hariList[$tanggal];?>, <?php echo date('d M Y',strtotime($jadwal_usm->tgl_ujian))?> (<?php echo date('H:i',strtotime($jadwal_usm->jam_mulai))?> - <?php echo $jadwal_usm->jam_selesai?> ) WIB  <br> Tempat : <?php echo $jadwal_usm->GD?><br><br>
              <?php } ?></center>
        </td>
      </tr>

      <tr>
        <td>No. Peserta Ujian</td>  
        <td>:</td>
        <td><?php echo $detail_pendaftaran->noujian?></td> 
      </tr>

            <?php
            $kode1     = $detail_pendaftaran->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $detail_pendaftaran->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>

      <tr>
        <td>Pilihan 1</td>  
        <td>:</td>
        <td><?php if($detail_pendaftaran->jurusan_pilihan ==''){echo " -";}else{ ?>
              <?php echo $pilihan1->jenjang; ?> <?php echo $pilihan1->nama;} ?></td> 
      </tr>

      <tr>
        <td>Pilihan 2</td>  
        <td>:</td>
        <td><?php if($detail_pendaftaran->jurusan_pilihan2 =='0'){echo " -";}else{ ?>
                <?php echo $pilihan2->jenjang; ?>   <?php echo $pilihan2->nama;} ?> </td> 
      </tr>


  
      </tbody>
    </table>
  </div>
</center>

</BODY>
</html>
    