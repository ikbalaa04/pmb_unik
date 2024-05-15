

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
   <table border="4" cellpadding="4">
      <thead>
        <tr>
          <th width="130"><img style="padding-top: 10px" src="<?php echo base_url('assets/upload/image/kampus/logo/'.$detail_profil->logo)?>" class="img img-responsive img-thumbnail" width="80"></th>
          <th colspan="2" width="580" align="left"><b style="font-size: 30px"><?php echo strtoupper($detail_profil->nama)?></b><br>
           <small><?php echo $detail_profil->alamat?>, <?php echo $detail_profil->kec?>, <?php echo $detail_profil->kab?> <br>Telp : <?php echo $detail_profil->telp?>. Fax : <?php echo $detail_profil->fax?> Kode Pos : <?php echo $detail_profil->kodepos?> <br>Email : <?php echo $detail_profil->email?> Website : <?php echo $detail_profil->website?></small></th></tr>
        <!-- <tr><th colspan="3"><hr></th></tr> -->
        <tr>
          <th > 
            <?php if (empty($detail_mahasiswa->foto)){?>
                <center><img width="80"  src="<?php echo base_url('assets/upload/image/default.png')?>" class="img img-responsive img-thumbnail"></center>
                <?php }else{?>
                <center><img width="80" src="<?php echo base_url('assets/upload/image/maba/profil/'.$detail_mahasiswa->foto)?>" class="img img-responsive img-thumbnail" ></center> 
                <?php }?></th>
                <th colspan="2">KARTU PESERTA UJIAN PMB <br><br><?php echo $detail_mahasiswa->nama_lengkap?> <br><br>Program <?php echo $detail_mahasiswa->program?><br>Nomer Peserta : <?php echo $detail_mahasiswa->noujian?></th>
        </tr>
      </thead>
      <tbody>

      <tr><td align="center">Jurusan Pilihan </td><td align="center" colspan="2"> 1. <?php echo $detail_mahasiswa->jurusan?><br>2. <?php echo $detail_mahasiswa->pilihan2?> </td></tr>

      	<tr><td align="center">Jadwal Ujian </td><?php foreach ($cetak_jadwal_usm as $cetak_jadwal_usm) {?>
      		<td align="center">
                <?php echo $cetak_jadwal_usm->J?> <br> <?php echo date('d-M-Y',strtotime($cetak_jadwal_usm->tgl_ujian))?> <br> (<?php echo $cetak_jadwal_usm->jam_mulai?> - <?php echo $cetak_jadwal_usm->jam_selesai?>)  <br> Tempat : <?php echo $cetak_jadwal_usm->R?><br><br>
             </td>
              <?php } ?></tr>
        

    
  
      </tbody>
    </table>
  </div>
</center>

    
 