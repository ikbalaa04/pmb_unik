<?php

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open(base_url('admin/home/edit_prodi/'.$detail_prodi->id),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Fakultas</label>
  <div class="col-md-10">
    <select class="form-control" name="fakultas">
      <option value="">-Pilih-</option>
      <?php foreach($pilih_fakultas as $pilih_fakultas) { ?>
        <option value="<?php echo $pilih_fakultas->id?>" <?php if($detail_prodi->fakultas==$pilih_fakultas->id){echo "selected";}?>><?php echo $pilih_fakultas->nama_fakultas?></option>
      <?php }?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Jenjang</label>
  <div class="col-md-10">
    <select name="jenjang" required="" class="form-control">
      <option value="">-Pilih-</option>
      <?php foreach($pilih_jenjang as $pilih_jenjang) { ?>
        <option value="<?php echo $pilih_jenjang->nama ?>" <?php if($detail_prodi->jenjang==$pilih_jenjang->nama){echo "selected";}?>><?php echo $pilih_jenjang->nama?></option>
      <?php } ?> 
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kode</label>
  <div class="col-md-10">
    <input type="text" name="kode" readonly="" class="form-control" value="<?php echo $detail_prodi->kode ?>" required>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Nama Prodi</label>
  <div class="col-md-10">
    <input type="text" name="nama" class="form-control"  value="<?php echo $detail_prodi->nama ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Bank</label>
  <div class="col-md-10">
    <input type="text" name="namabank" class="form-control"  value="<?php echo $detail_prodi->namabank ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">No. Rekening</label>
  <div class="col-md-10">
    <input type="text" name="norek" class="form-control"  value="<?php echo $detail_prodi->norek ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Biaya</label>
  <div class="col-md-10">
    <input type="text" name="biaya" class="form-control"  value="<?php echo $detail_prodi->biaya ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status</label>
  <div class="col-md-10">
    <select name="status" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($detail_prodi->status==1){echo "selected";}?>>Aktif</option>
      <option value="0" <?php if($detail_prodi->status==0){echo "selected";}?>>Tidak Aktif</option>
  </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Rincian Biaya Registrasi Ulang</label>
  <div class="col-md-10">
    <textarea class="ckeditor" name="rincian_regis" class="form-control"><?php echo $detail_prodi->rincian_regis ?></textarea>
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