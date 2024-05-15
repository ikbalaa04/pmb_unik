<?php 

echo validation_errors('<div class="alert alert-warning">','</div>'); 

echo form_open(base_url('admin/home/tambah_fakultas'),'class="form-horizontal"');

?>

<div class="form-group">
  <label class="col-md-2 control-label">Perguruan Tinggi</label>
  <div class="col-md-10">
    <?php foreach($detail_institusi as $detail_institusi) { ?>
          <input class="form-control" type="text" readonly="" name="id_institusi" value="<?php echo $detail_institusi->nama ?>">
    <?php } ?>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Kode</label>
  <div class="col-md-10">
    <input type="text" name="kode" class="form-control" value="<?php echo set_value('kode')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Fakultas</label>
  <div class="col-md-10">
    <input type="text" name="nama_fakultas" class="form-control" value="<?php echo set_value('nama_fakultas')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Singkatan</label>
  <div class="col-md-10">
    <input type="text" name="singkatan" class="form-control" value="<?php echo set_value('singkatan')?>" required>
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