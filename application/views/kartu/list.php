

<html>
<head>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo  $title?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/form/css/style3.css">
  <style type="text/css">
    .box{
        width:700px;
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
<BODY onLoad="javascript:window.print()">
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
    <table border="4" cellpadding="4">
      <thead>
        <tr>
          <th width="110"><img src="<?php echo base_url('assets/upload/image/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="65"></th>
          <th colspan="2" align="left"><b style="font-size: 25px"><?php echo strtoupper($detail_institusi->nama)?></b><br>
          <b style="font-size: 20px"><?php echo strtoupper($detail_institusi->singkatan)?></b> <br>
           <small><?php echo $detail_institusi->alamat?>, Telp : <?php echo $detail_institusi->telp?>  <br> Website : fmipa.uniga.ac.id Email : <?php echo $detail_institusi->email?></small></th></tr>
        <tr>
          <th width="100"> <br>
            <?php if (empty($pendaftar->foto)){?>
                <center><img src="<?php echo base_url('assets/upload/image/profil/default.png')?>" class="img img-responsive img-thumbnail" width="100"></center>
                <?php }else{?>
                <center><img src="<?php echo base_url('assets/upload/image/profil/thumbs/'.$pendaftar->foto)?>" class="img img-responsive img-thumbnail" width="100"></center> 
                <?php }?></th>
                <th>KARTU PESERTA UJIAN SARINGAN MASUK <br><br><?php echo strtoupper($pendaftar->nama_lengkap)?> <br><br>Nomer Peserta : <?php echo $pendaftar->noujian?></th>
        </tr>
      </thead>
      <tbody>

      <tr><td width="100" align="center">Program Studi : <?php echo $detail_pendaftar_profil4->P?></td>
        <td rowspan="2" align="center" ><?php foreach ($jadwal_usm_uhuy as $jadwal_usm_uhuy) {?>
                <?php echo $jadwal_usm_uhuy->J?> <br> 
                <?php $tanggal = date('D',strtotime($jadwal_usm_uhuy->tgl_ujian));
                $hariList = array('Sun' => 'Minggu',
                                  'Mon' => 'Senin',
                                  'Tue' => 'Selasa',
                                  'Wed' => 'Rabu',
                                  'Thu' => 'Kamis',
                                  'Fri' => 'Jumat',
                                  'Sat' => 'Sabtu');
                 echo $hariList[$tanggal];?>, <?php echo date('d M Y',strtotime($jadwal_usm_uhuy->tgl_ujian))?> (<?php echo date('H:i',strtotime($jadwal_usm_uhuy->jam_mulai))?> - <?php echo date('H:i',strtotime($jadwal_usm_uhuy->jam_selesai))?> WIB)  <br> Tempat : <?php echo $jadwal_usm_uhuy->GD?><br><br>
              <?php } ?></td></tr>

        <!--<tr><td width="100" align="center" colspan="2">Pilihan 2 : <?php echo $detail_pendaftar_profil5->P2?></td></tr>-->
  
      </tbody>
    </table>
  </div>
</center>

    
