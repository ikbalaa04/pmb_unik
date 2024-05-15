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

echo form_open(base_url('admin/home/tambah_jenis_agen'),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Jenis Agen di Database</label>
  <div class="col-md-10">
    <input type="text" name="jenis_komisi" class="form-control" placeholder="nama jenis agen huruf kecil dan tanpa spasi" value="<?php echo set_value('jenis_komisi')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Jenis Agen</label>
  <div class="col-md-10">
    <input type="text" name="nama_komisi" class="form-control" value="<?php echo set_value('nama_komisi')?>" required>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Status Agen</label>
  <div class="col-md-10">
    <select name="status_komisi" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($this->input->post('status_komisi')=='1'){echo "selected";}?>>Aktif</option>
      <option value="0" <?php if($this->input->post('status_komisi')=='0'){echo "selected";}?>>Tidak Aktif</option>
  </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Jumlah Komisi</label>
  <div class="col-md-10">
    <input type="number" name="jumlah_komisi" class="form-control" value="<?php echo set_value('jumlah_komisi')?>" required>
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

