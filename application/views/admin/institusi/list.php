<?php

echo validation_errors('<div class="alert alert-warning">','</div>');
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

echo form_open(base_url('admin/home/edit_konfigurasi'),'class="form-horizontal"');

?>
<div class="row">
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">Nama</label>
	<div class="col-md-9">
		<input type="text" name="nama" class="form-control" value="<?php echo $detail_institusi->nama ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Singkatan</label>
	<div class="col-md-9">
		<input type="text" name="singkatan" class="form-control" value="<?php echo $detail_institusi->singkatan ?>" >
	</div>
</div>


<div class="form-group">
	<label class="col-md-3 control-label">Kode Perguruan Tinggi</label>
	<div class="col-md-9">
		<input type="number" name="kodept" class="form-control" value="<?php echo $detail_institusi->kodept ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Nosk</label>
	<div class="col-md-9">
		<input type="text" name="nosk" class="form-control"  value="<?php echo $detail_institusi->nosk ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tanggal SK</label>
	<div class="col-md-9">
		<input type="date" name="tanggalsk" class="form-control"  value="<?php echo $detail_institusi->tanggalsk ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tanggal Didirikan</label>
	<div class="col-md-9">
		<input type="date" name="tanggaldidirikan" class="form-control"  value="<?php echo $detail_institusi->tanggaldidirikan ?>" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Alamat</label>
	<div class="col-md-9">
		<input type="text" name="alamat" class="form-control"  value="<?php echo $detail_institusi->alamat ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Alamat 2</label>
	<div class="col-md-9">
		<input type="text" name="alamat2" class="form-control"  value="<?php echo $detail_institusi->alamat2 ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Kode Pos</label>
	<div class="col-md-9">
		<input type="number" name="kodepos" class="form-control"  value="<?php echo $detail_institusi->kodepos?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Email</label>
	<div class="col-md-9">
		<input type="email" name="email" class="form-control"  value="<?php echo $detail_institusi->email?>" >
	</div>
</div>


</div>

<div class="col-md-6">

<div class="form-group">
	<label class="col-md-3 control-label">Telepon</label>
	<div class="col-md-9">
		<input type="text" name="telp" class="form-control"  value="<?php echo $detail_institusi->telp?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">About</label>
	<div class="col-md-9">
		<textarea name="about" class="form-control"><?php echo $detail_institusi->about?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">facebook</label>
	<div class="col-md-9">
		<input type="text" name="facebook" class="form-control"  value="<?php echo $detail_institusi->facebook?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Twitter</label>
	<div class="col-md-9">
		<input type="text" name="twitter" class="form-control"  value="<?php echo $detail_institusi->twitter?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Google Plus</label>
	<div class="col-md-9">
		<input type="text" name="googleplus" class="form-control"  value="<?php echo $detail_institusi->googleplus?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Fax</label>
	<div class="col-md-9">
		<input type="text" name="fax" class="form-control"  value="<?php echo $detail_institusi->fax?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Kota</label>
	<div class="col-md-9">
		<input type="text" name="kota" class="form-control"  value="<?php echo $detail_institusi->kota?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Website</label>
	<div class="col-md-9">
		<input type="text" name="website" class="form-control"  value="<?php echo $detail_institusi->website?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Info PMB</label>
	<div class="col-md-9">
		<textarea name="info_pmb" class="form-control"><?php echo $detail_institusi->info_pmb ?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label"></label>
	<div class="col-md-9">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
		
	</div>
	<div class="col-md-2"></div>

</div>
</div>
</div>




<?php echo form_close(); ?>
