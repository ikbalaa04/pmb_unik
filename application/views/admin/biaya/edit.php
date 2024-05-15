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

echo form_open(base_url('admin/home/edit_biaya/'.$detail_biaya->id),'class="form-horizontal"');

?>
<b id="reload">
<div class="form-group">
  <label for="sel1" class="col-md-2 control-label">Fakultas </label>
  <div class="col-md-6">
    <input type="hidden" name="fakultas" class="form-control" value="<?php echo $detail_biaya->fakultas ?>" required>
    <input type="text" readonly="" class="form-control" value="<?php echo $detail_biaya->nama_fakultas ?>">
    </div>
</div>

<div class="form-group">
  <label for="sel1" class="col-md-2 control-label">Prodi </label>
  <div class="col-md-6">
  <select required=""  class="form-control" name="prodi" id="prodi">
          <option value="">-Pilih-</option>
            <?php foreach ($prodi as $prodi) { ?>
                <option  value="<?php echo $prodi->kode ?>" <?php if($detail_biaya->prodi== $prodi->kode){echo "selected";}?>><?php echo $prodi->nama ?></option>";
            <?php } ?>
        </select>
    </div>
</div>
</b>

<div class="form-group">
  <label class="col-md-2 control-label">Program Kuliah</label>
  <div class="col-md-6">
    <input type="text" name="program" class="form-control" value="<?php echo $detail_biaya->program ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Biaya</label>
  <div class="col-md-6">
    <input type="text" name="biaya" class="form-control" value="<?php echo $detail_biaya->biaya ?>" required>
  </div>
</div>

<!-- <div class="form-group">
  <label class="col-md-2 control-label">Status Menu</label>
  <div class="col-md-10">
    <select name="id_keluarga" class="form-control">
        <option selected disabled>-Pilih-</option>
        <option value="0" <?php if($this->input->post('id_keluarga')=='0'){echo "selected";} ?>>Menu Utama</option>
        <?php foreach($list_pilih_menu as $list_pilih_menu) {?>
        <option value="<?php echo $list_pilih_menu->id?>" <?php if($this->input->post('id')==$list_pilih_menu->id){echo "selected";} ?>><?php echo $list_pilih_menu->nama_menu?> </option>
            <?php } ?>
        </select>
  </div>
</div> -->

<div class="form-group">
  <label class="col-md-2 control-label">Rincian Biaya</label>
  <div class="col-md-10">
    <textarea class="ckeditor" id="ckedtor" name="isi" required><?php echo $detail_biaya->isi?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Beranda Utama</label>
  <div class="col-md-10">
    <select name="utama" class="form-control">
        <option selected disabled>-Pilih-</option>
        <option value="1" <?php if($detail_biaya->status=='1'){echo "selected";} ?>>Yes </option>
        <option value="0" <?php if($detail_biaya->status=='0'){echo "selected";} ?>>No </option>
        </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Biaya</label>
  <div class="col-md-10">
    <select name="status" class="form-control">
        <option selected disabled>-Pilih-</option>
        <option value="1" <?php if($detail_biaya->status=='1'){echo "selected";} ?>>Aktif </option>
        <option value="0" <?php if($detail_biaya->status=='0'){echo "selected";} ?>>Tidak Aktif </option>
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
