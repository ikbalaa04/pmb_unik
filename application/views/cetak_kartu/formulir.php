

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
          <th width="110"><img style="padding-top: 10px" src="<?php echo base_url('assets/upload/image/kampus/logo/thumbs/'.$detail_profil->logo)?>" class="img img-responsive img-thumbnail" width="125"></th>
          <th colspan="5" width="580" align="left"><b style="font-size: 30px"><?php echo strtoupper($detail_profil->nama)?></b><br>
           <small><?php echo $detail_profil->alamat?>, <?php echo $detail_profil->kec?>, <?php echo $detail_profil->kab?> <br>Telp : <?php echo $detail_profil->telp?>. Fax : <?php echo $detail_profil->fax?> Kode Pos : <?php echo $detail_profil->kodepos?> <br>Email : <?php echo $detail_profil->email?> Website : <?php echo $detail_profil->website?></small></th></tr>
        <tr><th colspan="6"><b style="box-sizing: 20px"><hr></b></th>
        </tr>
      </thead>
    </table>

    <table>
      <thead>

         <tr><th width="700" colspan="7"><center>FORMULIR ISIAN DATA CALON MAHASISWA <br> Tahun Akademik <?php echo $detail_mahasiswa->tahungelombang?></center></th>
        </tr>

      </thead>
      <tbody>

      <tr><td width="110">Pilihan 1 </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->jurusan?></td><td>|</td><td width="120">No. Ujian </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->noujian?></td></tr>  
      <tr><td width="110">Pilihan 2 </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->pilihan2?></td><td>|</td><td width="120">Nama Lengkap </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->nama_lengkap?></td></tr>  

      <tr><td width="110">Jenis Daftar </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->jalur?></td><td>|</td><td width="120">Program </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->program?></td></tr> 
      <tr><td width="110">Sumber Informasi </td><td>:</td><td width="220">HayuKuliah.com</td></tr>  

      <tr><td colspan="7"><br></td></tr>

      <tr><td width="120"><b style="font-size: 16px">BIODATA :</b></td></tr>  

      <tr><td width="110">TTL </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->tempat_lahir?>, <?php echo date('d M Y',strtotime($detail_mahasiswa->tanggal_lahir))?></td></tr>  
      <tr><td width="110">Agama </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->agama?></td><td>|</td><td width="120">Jenis Kelamin </td><td>:</td><td width="230">
      	<?php if($detail_mahasiswa->agama == 'L'){ ?>
      		Laki-laki
      	<?php }else{ ?>
      		Perempuan
      	<?php } ?>
      	</td>
      </tr>  

      <tr><td colspan="7"><br></td></tr>
       <tr><td width="120"><b style="font-size: 16px">ALAMAT :</b></td></tr>  

      <tr><td width="110">Alamat </td><td>:</td><td colspan="5"><?php echo $detail_mahasiswa->alamat?></td></tr>  
      <tr><td width="110">Kecamatan</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->Kec?></td><td>|</td><td colspan="3"><?php echo $detail_mahasiswa->Kab?> </td>
      </tr>  
      <tr><td width="110">Provinsi</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->Prov?></td><td>|</td><td width="120">Kode Pos </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->kodepos?></td>
      </tr>  
      <tr><td width="110">No. HP/WA</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->hp?></td><td>|</td><td width="120">Email </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->email?></td>
      </tr> 

       <tr><td colspan="7"><br></td></tr>
       <tr><td width="120"><b style="font-size: 16px">ASAL SEKOLAH :</b></td></tr>

       <tr><td width="110">Asal Sekolah </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->sekolah_nama?></td><td>|</td>
       <?php if($detail_mahasiswa->sekolah_jurusan != 'Lainnya') { ?>
       <td width="120">Jurusan </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->sekolah_jurusan?></td>
   	   <?php }else{ ?>
   	   <td width="120">Jurusan </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->sekolah_nama_jurusan?></td>
   	   <?php } ?>
   	   </tr>  

   	    <tr><td width="110">Tahun Lulus</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->tahun_lulus?></td><td>|</td><td width="120">No. Ijazah </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->no_ijazah?></td></tr>  

   	   <?php if($detail_mahasiswa->jalur == 'Pindahan / Transfer') { ?>
   	   <tr><td colspan="7"><br></td></tr>
       <tr><td colspan="7"><b style="font-size: 16px">CALON MAHASISWA PINDAHAN :</b></td></tr>

       <tr><td width="110">Perguruan Tinggi </td><td>:</td><td width="220"><?php echo $detail_mahasiswa->pindahan_namapt?></td>
   	   <tr><td width="110">Program Studi</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->pindahan_prodi?></td><td>|</td><td width="120">NIM </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->pindahan_nim?></td></tr>  
       <?php } ?>
      
  

       <tr><td colspan="7"><br></td></tr>
       <tr><td width="250"><b style="font-size: 16px">ORANG TUA/WALI :</b></td></tr>  

        <tr><td width="110">Nama Ayah</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->ortu_nama?></td><td>|</td><td width="150">Nama Ibu </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->ortu_ibu?></td>
      </tr> 

       <tr><td width="110">Pekerjaan Ayah</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->ortu_pekerjaan?></td><td>|</td><td width="150">Pekerjaan Ibu </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->ortu_ibu_pekerjaan?></td>
      </tr> 

      <tr><td width="110">No HP/WA Ayah</td><td>:</td><td width="220"><?php echo $detail_mahasiswa->ortu_hp?></td><td>|</td><td width="150">No HP/WA Ibu </td><td>:</td><td width="230"><?php echo $detail_mahasiswa->ortu_ibu_hp?></td>
      </tr> 

      <tr><td width="110">Alamat Lengkap </td><td>:</td><td colspan="5"><?php echo $detail_mahasiswa->ortu_alamat?></td></tr>  
      </tr>  
       
      </tbody>
    </table>

    <tr><br></tr>
    <tr><br></tr>
    <tr><br></tr>


    <table>
      <tbody>

         <tr><td colspan="3" width="400"></td><td align="center" width="400"><?php echo $detail_profil->kab?>,............................<?php echo date('Y')?></td>
        </tr>
        <tr align="center"><td colspan="3">Petugas,</td><td >Calon Mahasiswa,</td>
        </tr>

        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
    	<tr><td><br></td></tr>

        <tr align="center"><td colspan="3">(................................)</td><td >(................................)</td>
        </tr>
      </tbody>
    </table>
  </div>
</center>

    
 