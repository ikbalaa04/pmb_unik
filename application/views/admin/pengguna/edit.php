<?php
  echo validation_errors('<div class="alert alert-success">','</div>');
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

echo form_open_multipart(base_url('admin/home/edit_pengguna/'.$pengguna->id),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Username</label>
  <div class="col-md-5">
    <input type="text" name="username" class="form-control" value="<?php echo $pengguna->username ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama</label>
  <div class="col-md-5">
    <input type="text" name="nama" class="form-control" value="<?php echo $pengguna->nama?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Email</label>
  <div class="col-md-5">
    <input type="email" name="email" class="form-control" value="<?php echo $pengguna->email?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Level</label>
  <div class="col-md-5">
    <select name="id_level" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($level as $level) { ?>
        <?php if($level->id != '3'){?>
          <option value="<?php echo $level->id?>" <?php if($pengguna->id_level == $level->id){ echo "selected"; }?>><?php echo $level->level?></option>
      <?php }} ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Level CBT</label>
  <div class="col-md-5">
    <?php $level_cbt      = $this->admin_model->level_cbt(); 
    $username   = $pengguna->username;
    $detail_user = $this->admin_model->detail_user($username); 
    ?>
    <select name="level" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($level_cbt as $level_cbt) { ?>
          <option value="<?php echo $level_cbt->level?>" <?php if($detail_user->level == $level_cbt->level){ echo "selected"; }?>><?php echo $level_cbt->keterangan ?></option>
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
          <option value="<?php echo $fakultas->id?>" <?php if($pengguna->fakultas == $fakultas->id){ echo "selected"; }?>><?php echo $fakultas->nama_fakultas?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nomor WA</label>
  <div class="col-md-5">
    <input type="number" name="hp" class="form-control" value="<?php echo $pengguna->hp?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Akun</label>
  <div class="col-md-5">
    <select name="status" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($pengguna->status == '1'){ echo "selected"; }?>>Aktif</option>
      <option value="0" <?php if($pengguna->status == '0'){ echo "selected"; }?>>Tidak Aktif</option>
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Foto Sebelumnya</label>
  <div class="col-md-5">
    <?php if($pengguna->foto != "") { ?>
    <img src="<?php echo base_url('assets/upload/profil/thumbs/'.$pengguna->foto)?>" class="img img-responsive img-thumbnail" width="200">
    <?php }else{ ?>
    <img src="<?php echo base_url('assets/noavatarn.png')?>" class="img img-responsive img-thumbnail" width="200">
    <?php }?>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Ganti Foto <br><small>(Mak. ukuran gambar 1 MB)</small></label>
  <div class="col-md-5">
    <input type="file" name="foto" class="form-control" value="<?php echo $pengguna->foto?>">
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

echo form_open(base_url('admin/home/ePass/'.$pengguna->id),'class="form-horizontal"');

?>


<div class="form-group">
  <label class="col-md-2 control-label">Ganti Password</label>
  <div class="col-md-5">
    <input type="hidden" name="username" value="<?php echo $pengguna->username ?>">
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