<?php

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open(base_url('admin/usm/edit_jadwal_usm/'.$detail_jadwal_usm->id),'class="form-horizontal"');

?>

<div class="form-group">
<?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?> 
  <label class="col-md-2 control-label">Program Kuliah</label>
  <div class="col-md-5">
          <select class="form-control" name="program" required="">
          <option value="">-Pilih-</option>
          <?php foreach($list_program_aktif as $list_program_aktif){ ?>
            <option value="<?php echo $list_program_aktif->id ?>" <?php if($detail_jadwal_usm->program== $list_program_aktif->id ){echo "selected";}?>><?php echo $list_program_aktif->nama ?></option>
          <?php } ?>
        </select>
  </div>
  </div>


<div class="form-group">
<label class="col-md-2 control-label">Tempat</label>
<div class="col-md-5">
<select name="gedung" class="form-control" required>
		<option value="">-Pilih-</option>
        <?php foreach ($gedung as $gedung) { ?>
        <option value="<?php echo $gedung->id?>" <?php if($detail_jadwal_usm->ruang== $gedung->id) {echo "selected"; }?> ><?php echo $gedung->nama?></option>
        <?php } ?>
        </select><!--  -->
    </div>
    </div>


<div class="form-group">
<label class="col-md-2 control-label">Jenis Ujian</label>
<div class="col-md-5">
<select name="jenis_ujin" class="form-control" required>
		<option value="">-Pilih-</option>
        <?php foreach ($jenis as $jenis) { ?>
        <option value="<?php echo $jenis->id?>" <?php if($detail_jadwal_usm->jenis_ujin== $jenis->id) {echo "selected"; }?> ><?php echo $jenis->nama?></option>
        <?php } ?>
        </select>
    </div>
    </div>



<div class="form-group">
	<label class="col-md-2 control-label">Tanggal Ujian</label>
	<div class="col-md-5">
		<input type="text" id="tanggal"  name="tgl_ujian" class="form-control" value="<?php echo $detail_jadwal_usm->tgl_ujian?>" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Jam Mulai</label>
	<div class="col-md-5">
		<input type="time" name="jam_mulai" class="form-control" value="<?php echo $detail_jadwal_usm->jam_mulai?>" required>
	</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Jam Selesai</label>
	<div class="col-md-5">
		<input type="text" name="jam_selesai" class="form-control" value="<?php echo $detail_jadwal_usm->jam_selesai?>" required>
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
