<?php

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open(base_url('admin/usm/edit_ruang/'.$detail_ruang->id),'class="form-horizontal"');

?>


<div class="form-group">
	<label class="col-md-2 control-label">Gedung</label>
	<div class="col-md-5">
		<select class="form-control" name="kode_gedung">
			<option value="">-Pilih-</option>
			<?php foreach($gedung as $gedung) { ?>
				<option value="<?php echo $gedung->id?>" <?php if($detail_ruang->kode_gedung==$gedung->id){echo "selected";}?>><?php echo $gedung->nama?></option>
			<?php }?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Jenis USM</label>
	<div class="col-md-5">
		<select class="form-control" name="idjenis">
			<option value="">-Pilih-</option>
			<?php foreach($jenis_usm as $jenis_usm) { ?>
				<option value="<?php echo $jenis_usm->id?>" <?php if($detail_ruang->idjenis==$jenis_usm->id){echo "selected";}?>><?php echo $jenis_usm->nama?></option>
			<?php }?>
		</select>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label">Nama Ruang</label>
	<div class="col-md-5">
		<input type="text" name="nama" class="form-control" value="<?php echo $detail_ruang->nama ?>" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Lantai</label>
	<div class="col-md-5">
		<input type="number" name="lantai" class="form-control" value="<?php echo $detail_ruang->lantai?>" required>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label"></label>
	<div class="col-md-5">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
	</div>
</div>


<?php echo form_close(); ?>
