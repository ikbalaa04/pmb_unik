<?php

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open(base_url('admin/usm/edit_jenis_usm/'.$detail_jenis_usm->id),'class="form-horizontal"');

?>


<div class="form-group">
	<label class="col-md-2 control-label">Nama Jenis USM</label>
	<div class="col-md-5">
		<input type="text" name="nama" class="form-control" value="<?php echo $detail_jenis_usm->nama ?>" required>
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
