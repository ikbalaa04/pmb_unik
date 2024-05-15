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

echo form_open(base_url('admin/home/tambah_gelombang'),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Fakultas</label>
  <div class="col-md-10">
    <select name="fakultas" required="" class="form-control">
      <option value="">-Pilih-</option>
    <?php foreach($pilih_fakultas as $pilih_fakultas) { ?>
      <option value="<?php echo $pilih_fakultas->id ?>" <?php if($this->input->post('fakultas')==$pilih_fakultas->id)?>><?php echo $pilih_fakultas->nama_fakultas?></option>
    <?php } ?> 
  </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Gelombang</label>
  <div class="col-md-10">
    <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama')?>" required>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Kode Gelombang</label>
  <div class="col-md-10">
    <input type="text" name="kode" class="form-control" value="<?php echo set_value('kode')?>" required>
  </div>
</div>


<!-- <div class="form-group">
  <label class="col-md-2 control-label">Tanggal Awal</label>
  <div class="col-md-10">
    <input type="date" name="date_start" class="form-control"  value="<?php echo set_value('date_start')?>" required>
  </div>
</div> -->

<div class="form-group">
  <label class="col-md-2 control-label">Tanggal Berakhir</label>
  <div class="col-md-10">
    <input type="text" id="tanggal" name="date_end" class="form-control"  value="<?php echo set_value('date_end')?>" required>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Tahun Angkatan</label>
  <div class="col-md-10">
    <input type="number" name="tahun" class="form-control"  value="<?php echo set_value('tahun')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Angkatan</label>
  <div class="col-md-10">
    <input type="text" name="angkatan" class="form-control"  value="<?php echo set_value('angkatan')?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Keterangan</label>
  <div class="col-md-10">
    <input type="text" name="keterangan" class="form-control"  value="<?php echo set_value('keterangan')?>" >
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
  <label class="col-md-2 control-label"></label>
  <div class="col-md-10">
    <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
    <button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
  </div>
</div>

<?php echo form_close(); ?>

