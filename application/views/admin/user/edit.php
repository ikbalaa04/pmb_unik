<?php
  
echo validation_errors('<div class="alert alert-warning">','</div>');

echo form_open_multipart(base_url('admin/home/edit_pengguna/'.$user->id),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Username</label>
  <div class="col-md-5">
    <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama</label>
  <div class="col-md-5">
    <input type="text" name="nama" class="form-control" value="<?php echo $user->nama?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Level</label>
  <div class="col-md-5">
    <select name="id_level" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($level as $level) { ?>
          <option value="<?php echo $level->id?>" <?php if($user->id_level == $level->id){ echo "selected"; }?>><?php echo $level->level?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Fakultas</label>
  <div class="col-md-5">
    <select name="fakultas" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($fakultas as $fakultas) { ?>
          <option value="<?php echo $fakultas->id?>" <?php if($user->fakultas == $fakultas->id){ echo "selected"; }?>><?php echo $fakultas->singkatan?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Akun</label>
  <div class="col-md-5">
    <select name="status" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($user->status == '1'){ echo "selected"; }?>>Aktif</option>
      <option value="0" <?php if($user->status == '0'){ echo "selected"; }?>>Tidak Aktif</option>
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Foto Sebelumnya</label>
  <div class="col-md-5">
    <?php if($user->foto != "") { ?>
    <img src="<?php echo base_url('assets/upload/user/thumbs/'.$user->foto)?>" class="img img-responsive img-thumbnail" width="200">
    <?php }else{ ?>
    <img src="<?php echo base_url('assets/noavatarn.png')?>" class="img img-responsive img-thumbnail" width="200">
    <?php }?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Ganti Foto</label>
  <div class="col-md-5">
    <input type="file" name="foto" class="form-control" value="<?php echo $user->foto?>">
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

<hr>

<?php

echo form_open(base_url('admin/home/ePass/'.$user->id),'class="form-horizontal"');

?>


<div class="form-group">
  <label class="col-md-2 control-label">Ganti Password</label>
  <div class="col-md-5">
    <input type="password" name="password" placeholder="Silahkan masukan password baru" class="form-control" value="<?php echo set_value('password')?>" required>
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