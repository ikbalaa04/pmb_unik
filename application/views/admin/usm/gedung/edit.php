<?php

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open(base_url('admin/usm/edit/'.$detail_gedung->id),'class="form-horizontal"');

?>

<div class="form-group">
	<div class="col-md-5">
		<input type="hidden" name="kode" class="form-control" value="#" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Nama Gedung</label>
	<div class="col-md-5">
		<input type="text" name="nama" class="form-control" value="<?php echo $detail_gedung->nama ?>" required>
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
