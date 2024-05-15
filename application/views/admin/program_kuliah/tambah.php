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

echo form_open(base_url('admin/home/tambah_program_kuliah'),'class="form-horizontal"');

?>


<div class="form-group">
  <label class="col-md-2 control-label">Kode Program</label>
  <div class="col-md-10">
    <input type="text" name="kode" class="form-control" value="<?php echo set_value('kode')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Jenis Program</label>
  <div class="col-md-10">
    <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status</label>
  <div class="col-md-10">
    <select name="status" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($this->input->post('status')=='1'){echo "selected";}?>>Aktif</option>
      <option value="0" <?php if($this->input->post('status')=='0'){echo "selected";}?>>Tidak Aktif</option>
  </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Jenis Program</label>
  <div class="col-md-10">
    <select name="tipe_program" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="Berbayar" <?php if($this->input->post('tipe_program')=='Berbayar'){echo "selected";}?>>Berbayar</option>
      <option value="Gratis" <?php if($this->input->post('tipe_program')=='Gratis'){echo "selected";}?>>Gratis</option>
  </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Keterangan</label>
  <div class="col-md-10">
    <input type="text" name="keterangan" class="form-control" value="<?php echo set_value('keterangan')?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label"></label>
  <div class="col-md-10">
    <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
    <button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
  </div>
</div>

<?php echo form_close(); ?>