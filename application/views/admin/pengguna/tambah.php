<?php
  
echo validation_errors('<div class="alert alert-warning">','</div>');

echo form_open(base_url('admin/home/tambah_pengguna'),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Username</label>
  <div class="col-md-5">
    <input type="text" name="username" class="form-control" value="<?php echo set_value('username')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Password</label>
  <div class="col-md-5">
    <input type="password" name="password" class="form-control" value="<?php echo set_value('password')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama</label>
  <div class="col-md-5">
    <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Email</label>
  <div class="col-md-5">
    <input type="email" name="email" class="form-control" value="<?php echo set_value('email')?>" required>
  </div>
</div>
 
<div class="form-group">
  <label class="col-md-2 control-label">Level</label>
  <div class="col-md-5">
    <select name="id_level" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($level as $level) { ?>
          <?php if($level->id != '3'){?>
          <option value="<?php echo $level->id?>" <?php if($this->input->post('id_level') == $level->id){ echo "selected"; }?>><?php echo $level->level?></option>
      <?php }} ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Level CBT</label>
  <div class="col-md-5">
    <?php $level_cbt      = $this->admin_model->level_cbt(); ?>
    <select name="level" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($level_cbt as $level_cbt) { ?>
          <option value="<?php echo $level_cbt->level?>" <?php if($this->input->post('level') == $level_cbt->level){ echo "selected"; }?>><?php echo $level_cbt->keterangan ?></option>
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
          <option value="<?php echo $fakultas->id?>" <?php if($this->input->post('fakultas') == $fakultas->id){ echo "selected"; }?>><?php echo $fakultas->nama_fakultas?></option>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nomor WA</label>
  <div class="col-md-5">
    <input type="number" name="hp" class="form-control" value="<?php echo set_value('hp')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Akun</label>
  <div class="col-md-5">
    <select name="status" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($this->input->post('status') == '1'){ echo "selected"; }?>>Aktif</option>
      <option value="0" <?php if($this->input->post('status') == '0'){ echo "selected"; }?>>Tidak Aktif</option>
    </select>
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
