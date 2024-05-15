<?php

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open(base_url('admin/home/tambah_custom_berkas'),'class="form-horizontal"');

?>

<div class="form-group">
<?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?> 
  <label class="col-md-2 control-label">Program Kuliah</label>
  <div class="col-md-10">
          <select class="form-control" name="program" required="">
          <option value="">-Pilih-</option>
          <?php foreach($list_program_aktif as $list_program_aktif){ ?>
            <option value="<?php echo $list_program_aktif->id ?>" <?php if($this->input->post('program')== $list_program_aktif->id ){echo "selected";}?>><?php echo $list_program_aktif->nama ?></option>
          <?php } ?>
        </select>
  </div>
  </div>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Berkas</label>
  <div class="col-md-10">
    <input type="text" name="nama_berkas" class="form-control" value="<?php echo set_value('nama_berkas')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Besar Berkas <br>(dalam satuan kb)</label>
  <div class="col-md-10">
    <input type="number" name="besar_berkas" class="form-control"  value="<?php echo set_value('besar_berkas')?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Type File</label>
  <div class="col-md-10">
    <input type="text" name="type_file" class="form-control"  value="<?php echo set_value('type_file')?>" >
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
  <label class="col-md-2 control-label">Urutan</label>
  <div class="col-md-10">
    <input type="number" required="" name="urutan" class="form-control"  value="<?php echo set_value('urutan')?>" >
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

