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

echo form_open_multipart(base_url('admin/home/konfigurasi_logo/'),'class="form-horizontal"');

?>
<div class="row">
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Logo</label>
  <div class="col-md-9">
    <?php if($detail_institusi->logo == "") { ?>
      <br><br><br><?php echo "(Belum ada logo)";?>
    <?php }else{ ?>
    <img src="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" class="img img-responsive img-thumbnail" width="200">
  <?php } ?>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Upload</label>
  <div class="col-md-9">
    <input type="hidden" name="id" value="<?php echo $detail_institusi->id?>">
    <input type="file" name="logo" class="form-control" value="<?php echo $detail_institusi->logo ?>" >
  </div><br><br><br>
  <div class="col-md-12"><center>
    <label class="col-md-3 control-label"></label>
    <button class="btn btn-primary"  type="submit"><i class="fa fa-save"></i> Simpan</button>
    <button class="btn btn-danger" type="reset" name="reset"><i class="fa fa-times"></i> Reset</button>
    </center>
  </div>
</div>
</div>
</div>



<?php echo form_close(); ?>
