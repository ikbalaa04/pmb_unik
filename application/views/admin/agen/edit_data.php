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

echo form_open(base_url('admin/home/edit_data_agen/'.$detail_agen->id),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Agen</label>
  <div class="col-md-10">
    <input type="text" name="nama" class="form-control" value="<?php echo $detail_agen->nama ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kode Agen</label>
  <div class="col-md-10">
    <input type="text" readonly="" name="nama" class="form-control" value="<?php echo $detail_agen->nama ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">NIK</label>
  <div class="col-md-10">
    <input type="text" name="nik" class="form-control" value="<?php echo $detail_agen->nik ?>" required>
  </div>
</div>               

<div class="form-group">
  <label class="col-md-2 control-label">Email</label>
  <div class="col-md-10">
    <input type="email"  name="email" class="form-control" value="<?php echo $detail_agen->email ?>" required>
  </div>
</div> 

<div class="form-group">
  <label class="col-md-2 control-label">Nomor WA</label>
  <div class="col-md-10">
    <input type="text" name="hp" class="form-control" value="<?php echo $detail_agen->hp ?>" required>
  </div>
</div> 

<div class="form-group">
  <label class="col-md-2 control-label">Kota Asal</label>
  <div class="col-md-10">
    <input type="text" name="kabupaten" class="form-control" value="<?php echo $detail_agen->kabupaten ?>" required>
  </div>
</div> 

<div class="form-group">
  <label class="col-md-2 control-label">Nama Bank</label>
  <div class="col-md-10">
    <input type="text" name="namabank" class="form-control" value="<?php echo $detail_agen->namabank ?>" required>
  </div>
</div> 

<div class="form-group">
  <label class="col-md-2 control-label">Atas Nama </label>
  <div class="col-md-10">
    <input type="text" name="atas_nama" class="form-control" value="<?php echo $detail_agen->atas_nama ?>" required>
  </div>
</div> 

<div class="form-group">
  <label class="col-md-2 control-label">Nomor Rekening</label>
  <div class="col-md-10">
    <input type="text" name="norek" class="form-control" value="<?php echo $detail_agen->norek ?>" required>
  </div>
</div> 

<div class="form-group">
  <label class="col-md-2 control-label">Alamat</label>
  <div class="col-md-10">
    <textarea class="form-control" name="alamat"><?php echo $detail_agen->alamat ?></textarea>
  </div>
</div>                 

<?php echo form_close(); ?>
