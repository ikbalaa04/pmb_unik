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

echo form_open_multipart(base_url('admin/home/konfigurasi_bg/'),'class="form-horizontal"');

?>
<div class="row">
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Background Login Yang Digunakan</label>
  <div class="col-md-9">
    <?php if($detail_institusi->bg == "") { ?>
      <br><br><br><?php echo "(Belum ada background)";?>
    <?php }else{ ?>
    Tampak Jelas <br>
    <img src="<?php echo base_url('assets/upload/bg/thumbs/'.$detail_institusi->bg)?>" class="img img-responsive img-thumbnail" width="200"><br><br>
    Tampak Buram <br>  
    <img src="<?php echo base_url('assets/upload/bg/'.$detail_institusi->bg)?>" class="img img-responsive img-thumbnail" width="200">
  <?php } ?>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Upload <small>(Maks. 3 mb)</small></label>
  <div class="col-md-9">
    <input type="hidden" name="id" value="<?php echo $detail_institusi->id?>">
    <input type="file" name="bg" class="form-control" value="<?php echo $detail_institusi->bg ?>" >
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


<?php echo form_open_multipart(base_url('admin/home/konfigurasi_bg_beranda'),'class="form-horizontal"');

?>
<div class="row">
<div class="col-md-12"><hr></div>
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Background Beranda Yang Digunakan</label>
  <div class="col-md-9">
    <?php if($detail_institusi->bg_beranda == "") { ?>
      <br><br><br><?php echo "(Belum ada background)";?>
    <?php }else{ ?>
    Tampak Jelas <br>
    <img src="<?php echo base_url('assets/upload/bg/thumbs/'.$detail_institusi->bg_beranda)?>" class="img img-responsive img-thumbnail" width="200"><br><br>
    Tampak Buram <br>  
    <img src="<?php echo base_url('assets/upload/bg/'.$detail_institusi->bg_beranda)?>" class="img img-responsive img-thumbnail" width="200">
  <?php } ?>
  </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Upload <small>(Maks. 3 mb)</small></label>
  <div class="col-md-9">
    <input type="hidden" name="id" value="<?php echo $detail_institusi->id?>">
    <input type="file" name="bg_beranda" class="form-control" value="<?php echo $detail_institusi->bg_beranda ?>" >
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
