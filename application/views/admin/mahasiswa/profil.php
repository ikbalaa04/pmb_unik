<?php

if (isset($error)) {
	echo '<div class="alert alert-danger">';
	echo $error;
	echo '</div>';
	}
  //notif gagal login
  if($this->session->flashdata('warning')){
    echo '<div class="alert alert-warning">';
    echo $this->session->flashdata('warning');
    echo '</div>';
  } 
  //notif logout
  if($this->session->flashdata('success')){
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('success');
    echo '</div>';
  }   

echo form_open_multipart(base_url('admin/home/profil_mahasiswa/'),'class="form-horizontal"');

?>
<section class="content">
<div class="row">
<div class="col-md-4">
<div class="form-group">
	<label class="col-md-12">Foto Profil Anda</label>
	<!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
               <?php if($detail->foto == "") { ?>
					<br><center><?php echo "(Belum ada foto profil)";?></center><br>
				<?php }else{ ?>
				<center><img src="<?php echo base_url('assets/upload/profil/thumbs/'.$detail->foto)?>"></center>
				<?php } ?>

              <h3 class="profile-username text-center"><?php echo $detail->nama_lengkap ?></h3>

             <?php $id_gelombang = $detail->gelombang;
             $detail_gelombang = $this->admin_model->detail_gelombang_id($id_gelombang); 

             $kode1     = $detail->jurusan_pilihan;
             $pilihan1  = $this->admin_model->pilihan1($kode1);
              ?> 
              <p class="text-muted text-center"><?php echo $detail_gelombang->nama ?></p>
              <p class="text-muted text-center"><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?></p>

              <a href="#" class="btn btn-primary btn-block"><b>
              	<?php if($detail->noujian != ""){ ?>
              	Nomor Ujian : <?php echo $detail->noujian ?> 
                <?php }else{ ?>
                Nomor Ujian : Belum Ada
                <?php } ?>
              </b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>
</div>
<div class="col-md-8">
	<div class="form-group">
	<div class="col-md-12">
		<?php if($detail->noujian == '') { ?>
			<span class="label label-primary">Kartu ujian akan muncul setelah pembayaran biaya pendaftaran terverifikasi</span>
		<?php }else{ ?>
			<a target="_blank" href="<?php echo base_url('admin/home/cetak_kartu_ujian')?>" class="btn btn-primary"><i class="fa fa-print"></i><b> Cetak Kartu Ujian</b></a>
		<?php } ?>
	</div><br><hr>
</div>

</div>

<div class="col-md-8">
<div class="form-group">
	<label class="col-md-12"><b>Upload Foto Profil <b style="color: red">(Maks. ukuran file gambar 300kb)</b></b></label>
	<br><br><div class="col-md-12">
		<input type="hidden" name="id" value="<?php echo $detail->id?>">
		<input type="file" name="foto" class="form-control" <?php if($detail->foto == ''){echo "required";}?> value="<?php echo $detail->foto ?>" >
	</div>
</div><br>
	<div class="col-md-4"><center>
		<button class="btn btn-primary"  type="submit"><i class="fa fa-save"></i> Simpan</button>
		<button class="btn btn-danger" type="reset" name="reset"><i class="fa fa-times"></i> Reset</button>
		</center>
	</div>

</div>

</div>
</section>



<?php echo form_close(); ?>
