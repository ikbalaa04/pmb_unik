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

echo form_open(base_url('admin/home/ganti_password'),'class="form-horizontal"');

?>
<div class="row">
<div class="col-md-12">
<div class="form-group">
  <label class="col-md-2 control-label">Password Lama</label>
  <div class="col-md-10">
    <input type="text" name="password" class="form-control" value="<?php echo $detail->password ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Password Baru</label>
  <div class="col-md-10">
    <input type="password" name="password_baru" placeholder="Buat password baru" class="form-control" value="<?php echo set_value('password_baru') ?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label"></label>
  <div class="col-md-10">
    <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
    <button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
    
  </div>

</div>

</div>

</div>

<?php echo form_close(); ?>


