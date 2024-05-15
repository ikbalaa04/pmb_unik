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

echo form_open(base_url('admin/home/tambah_thn_akademik'),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Tahun Akademik</label>
  <div class="col-md-10">
    <input type="text" name="nama_thn_akademik" class="form-control" value="<?php echo set_value('nama_thn_akademik')?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Berlaku s/d</label>
  <div class="col-md-10">
    <input type="text" id="tanggal" name="berlaku" class="form-control"  value="<?php echo set_value('berlaku')?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Status</label>
  <div class="col-md-10">
    <select name="status_thn_akademik" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($this->input->post('status_thn_akademik')=='1'){echo "selected";}?>>Aktif</option>
      <option value="0" <?php if($this->input->post('status_thn_akademik')=='0'){echo "selected";}?>>Tidak Aktif</option>
  </select>
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

