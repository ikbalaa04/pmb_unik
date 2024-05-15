

<html>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo  $title?></title>
</head>

<BODY onLoad="javascript:window.print()">
<?php
if (isset($_REQUEST['print']))
{
$print = $_REQUEST['print']; include "$print";
}


?>
<center>
<table>
      <thead>
        <tr>
          <th width="110"><img style="padding-top: 10px; padding-right:20px" src="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="125"></th>
          <th colspan="5" width="580" align="left">
              <b style="font-size: 23px"><?php echo strtoupper($detail_institusi->nama)?></b><br>
              <b style="font-size: 18px"><?php echo strtoupper($fakultas_hadir->nama_fakultas)?></b><br>
           <small><?php echo $detail_institusi->alamat?> <br>Telp : <?php echo $detail_institusi->telp?>. <br> Website : <?php echo $detail_institusi->website?> Email : <?php echo $detail_institusi->email?></small></th></tr>
        <tr><th colspan="6"><b style="box-sizing: 20px"><hr></b></th>
        </tr>
        <tr><th colspan="2"><center>Daftar Hadir Peserta Ujian Saringan Masuk <?php echo $fakultas_hadir->nama_gelombang ?> <br> Program Studi (<?php echo $nama_prodi->jenjang ?>) <?php echo $nama_prodi->nama ?></center></th></tr>
      </thead>
    </table>
    </center>
    
<br>
<center>
	<table border="2" cellspacing="4" cellpadding="10">
							<thead>
								<tr>
									<th width="50"><center>No</center></th>
									<th width="250">Nama</th>
									<th width="180">No. Peserta Ujian</th>
									<th width="250" colspan="2"><center>Tanda Tangan</center></th>
								</tr>
							</thead>
						<?php $no=1; foreach ($daftar_hadir as $daftar_hadir) { ?>
							<tbody>
								<tr>
									<td align="center"><?php echo $no ?></td>
									<td><?php echo $daftar_hadir->nama_lengkap?></td>
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

