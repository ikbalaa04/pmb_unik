<div class="row">
<?php if($detail->jenis=='MB') { ?>

<div class="col-md-12"><center><h2><b>Data Hasil Upload Berkas Mahasiswa Baru <br>(<?php echo $detail->nama_lengkap?>)</b></h2></center></div>

<div class="col-md-12">
	<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="200">Nama Berkas</th>
            <th>Berkas</th>
            
        </tr>
    </thead>
    <tbody>
        <tr> 
            <td>Scan KTP/KK</td>
            <?php if ($detail->ktp != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/mb/'.$detail->ktp)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_ktp_mb/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td>Scan Ijazah SMA/SMK</td>
            <?php if ($detail->ijazah != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/mb/'.$detail->ijazah)?>" alt="Photo">
            	<br><center><a href="<?php echo base_url('admin/home/unduh_ijazah_mb/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td>Scan SKHU</td>
            <?php if ($detail->skhu != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/mb/'.$detail->skhu)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_skhu_mb/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br>
            </td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
 		<tr> 
            <td>Scan Surat Keterangan Kerja</td>
            <?php if ($detail->suket_kerja != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/mb/'.$detail->suket_kerja)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_suket_kerja_mb/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br>
            </td>
            <?php }else{ ?>
            <td><b>Belum Ada</b></td>
            <?php }?>
        <tr>


    </tbody>
	</table>

</div>
</div>
</div>

<?php }else{ ?>

<div class="col-md-12"><hr></div>
<div class="col-md-12"><center><h2><b>Data Hasil Upload Berkas Mahasiswa Pindahan <br>(<?php echo $detail->nama_lengkap?>)</b></h2></center></div>

<div class="col-md-12">
	<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="200">Nama Berkas</th>
            <th>Berkas</th>
            
        </tr>
    </thead>
    <tbody>
        <tr> 
            <td>Scan KTP/KK</td>
            <?php if ($detail->ktp != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->ktp)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_ktp_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td>Scan Ijazah SMA/SMK</td>
            <?php if ($detail->ijazah != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->ijazah)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_ijazah_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td>Scan SKHU</td>
            <?php if ($detail->skhu != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->skhu)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_skhu_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
 		<tr> 
            <td>Scan Surat Keterangan Kerja</td>
            <?php if ($detail->suket_kerja != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->suket_kerja)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_suket_kerja_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td>Scan Surat Rekomendasi Kopertis</td>
            <?php if ($detail->kopertis != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->kopertis)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_kopertis_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td>Scan Transkip Nilai</td>
            <?php if ($detail->transkip != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->transkip)?>" alt="Photo">
            <br><center><a href="<?php echo base_url('admin/home/unduh_transkip_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
 		<tr> 
            <td>Scan Surat Keterangan Pindah</td>
            <?php if ($detail->suket_pindah != '') { ?>
            <td align="center"><img class="img-responsive pad" src="<?php echo base_url('assets/upload/berkas/pd/'.$detail->suket_pindah)?>" alt="Photo">
            	<br><center><a href="<?php echo base_url('admin/home/unduh_suket_pindah_pd/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Berkas</a></center><br><br></td>
            <?php }else{ ?>
            <td><b>Belum Ada</b></td>
            <?php }?>
        <tr>


    </tbody>
	</table>

</div>
</div>
</div>

<?php } ?>
</div>