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

echo form_open_multipart(base_url('admin/home/tambah_berita'),'class="form-horizontal"');

?>


<div class="form-group">
	<label class="col-md-2 control-label">Judul Berita</label>
	<div class="col-md-10">
		<input type="text" name="judul" class="form-control" value="<?php echo set_value('judul')?>" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Kategori</label>
	<div class="col-md-5">
		<select name="kategori" class="form-control">
			<option value="">-Pilih-</option>
			<option value="Pengumuman" <?php if($this->input->post('kategori')=='Pengumuman'){echo "selected";}?>>Pengumuman</option>
			<option value="Informasi" <?php if($this->input->post('kategori')=='Informasi'){echo "selected";}?>>Informasi</option>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Gambar <small>(Maks. 3 mb)</small></label>
	<div class="col-md-5">
		<input type="file" name="foto" class="form-control" value="<?php echo set_value('foto')?>" required>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label">Status</label>
	<div class="col-md-5">
		<select name="status" required="" class="form-control">
			<option value="">-Pilih-</option>
			<option value="Publish" <?php if($this->input->post('status')=='Publish'){echo "selected";}?>>Publish</option>
			<option value="Draft" <?php if($this->input->post('status')=='Draft'){echo "selected";}?>>Draft</option>
	</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Isi Berita</label>
	<div class="col-md-10">
		<textarea class="ckeditor" id="ckedtor" name="isi_berita" required><?php echo set_value('isi_berita')?></textarea>
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
