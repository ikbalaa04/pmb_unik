

<html>
<head>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo  $title?></title>
	<style type="text/css">
		.box{
				width:100%;
				height:100px;
				display: inline-block;
				text-align: justify;
				text-align: center;
			}

		.box2{
				width:180px;
				height:50px;
				background:white;
				display: inline-block;
				text-align: center;
				border-radius: 20px;
				border: 5px solid #000000;
				padding: 10px 10px 10px 10px;
				font-family: Cambria,"Times New Roman",serif;
				margin-top : 10px;
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

$kode1     = $prodi = $this->input->post('prodi');
$pilihan1  = $this->admin_model->pilihan1($kode1);


?>
<h3 align="center">Nomer Urut Peserta Ujian Saringan Masuk <?php echo $no_gelombang->nama?> <br> <?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?></h3><hr>
<div class="box">
	<?php foreach ($no_urut as $no_urut) { ?>
		<div class="box2"><?php echo $no_urut->nama_lengkap?><br>
		<?php echo $no_urut->noujian?>
		</div>
	<?php } ?>
</div>