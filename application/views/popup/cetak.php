

<html>
<head>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Registrasi</title>
</head>
</heead>
<BODY onLoad="javascript:window.print()">
<?php
if (isset($_REQUEST['print']))
{
$print = $_REQUEST['print']; include "$print";
}


?>

<br>
<center>
<table style=" border: 2px solid black;" cellpadding="5">
	<thead>
    <tr>
        <th align="center" colspan="2"><img src="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="125"><br><b style="font-size: 25px"><?php echo strtoupper($detail_institusi->nama)?></b><br>
        <small><?php echo $detail_institusi->alamat?>, Telp : <?php echo $detail_institusi->telp?>  <br> Website : <?php echo $detail_institusi->website?> Email : <?php echo $detail_institusi->email?></small></th></tr>

    <tr><th>
          <hr style=" border: 1px solid black;">
        </th></tr>

</thead>
<tbody>
  <tr>	
  <td>	
  <center>
  <div>
  	<table  cellspacing="3" >
  		<thead>
  			<tr>
          <th colspan="4" align="justify" width="100%"> <center>Akun Registrasi Pendaftaran PMB <?php echo $detail_institusi->nama?> </center></th>

        </tr>
  		</thead>
  		<tbody>

  			<tr>
          <td width="300"> </td>
          <td width="150">Email </td>
          <td width="10">:</td>
          <td width="470"> <?php echo $detail_pendaftar->email?></td>
        </tr>
        
        <tr>
          <td > </td>
          <td >NAMA LENGKAP </td>
          <td>:</td>
          <td> <?php echo $detail_pendaftar->nama_lengkap?></td>
        </tr>

        <tr>
          <td > </td>
          <td >Username </td>
  			  <td>:</td>
  				<td> <?php echo $detail_pendaftar->username?></td>
        </tr>
 			
        <tr>
          <td > </td>
          <td >Password </td>
 			    <td>:</td>
  				<td> <?php echo $detail_pendaftar->password?></td>
        </tr>


  		</tbody>
  	</table>
  </div><br>
  </center>
  </td>
  </tr>
</tbody>
</table>	
</center>

		

