

<html>
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
 
    .table1, td {
    border: 1px solid #999;
    padding: 8px 20px;
    padding-top: 12px;
    padding-bottom: 12px;
	}

  </style>
</head>

<BODY onLoad="javascript:window.print()">
<?php
if (isset($_REQUEST['print']))
{
$print = $_REQUEST['print']; include "$print";
}


?>
<center>
<table >
      <thead>
        <tr>
          <th width="110"><img style="padding-top: 10px; padding-right:20px" src="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="125"></th>
          <th colspan="5" width="580" align="left">
              <b style="font-size: 23px"><?php echo strtoupper($detail_institusi->nama)?></b><br>
              <b style="font-size: 18px"><?php echo strtoupper($fakultas_hadir->nama_fakultas)?></b><br>
           <small><?php echo $detail_institusi->alamat?> <br>Telp : <?php echo $detail_institusi->telp?>. <br> Website : <?php echo $detail_institusi->website?> Email : <?php echo $detail_institusi->email?></small></th></tr>
        <tr><th colspan="6"><hr style="color: black"><br></th>
        </tr>
        <tr><th colspan="2"><center>Daftar Hadir Peserta Ujian Saringan Masuk <br><?php echo $fakultas_hadir->nama_fakultas ?> <?php echo $fakultas_hadir->nama_gelombang ?> <br> <?php echo $nama_prodi->jenjang ?> <?php echo $nama_prodi->nama ?> </center></th></tr>
      </thead>
    </table>
    </center>
    
<br>
<center>
	<table class="table1" cellpadding="10" cellspacing="10">
							<thead>
								<tr style="font-size: 13px">
									<th style="border: 1px solid #999; padding: 8px 20px;" width="10"><center>No</center></th>
									<th width="250" style="border: 1px solid #999; padding: 8px 20px;">Nama</th>
									<th width="180" style="border: 1px solid #999; padding: 8px 20px;">No. Peserta Ujian</th>
									<th width="250" colspan="2" style="border: 1px solid #999; padding: 8px 20px;"><center>Tanda Tangan</center></th>
								</tr>
							</thead>
						<?php $no=1; foreach ($daftar_hadir as $daftar_hadir) { ?>
							<tbody >
								<tr style="font-size: 12px">
									<td align="center" ><?php echo $no ?></td>
									<td><?php echo strtoupper($daftar_hadir->nama_lengkap)?></td>
									<td><?php echo $daftar_hadir->noujian?></td>
									<td width="125"><?php if ($no%2 == 1){ ?>
														<?php echo $no."."?>
													<?php } ?>
									</td>
									<td width="125"><?php if ($no%2 != 1){ ?>
														<?php echo $no."."?>
													<?php } ?>
									</td>
								</tr>
							</tbody>
	<?php $no++; } ?>
	</table>
</center>
</BODY>
</html>

