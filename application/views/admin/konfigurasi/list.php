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

echo form_open(base_url('admin/home/edit_konfigurasi'),'class="form-horizontal"');

?>
<div class="row">
<div class="col-md-6">
<div class="form-group">
  <label class="col-md-3 control-label">Nama</label>
  <div class="col-md-9">
    <input type="text" name="nama" class="form-control" value="<?php echo $detail_institusi->nama ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Singkatan</label>
  <div class="col-md-9">
    <input type="text" name="singkatan" class="form-control" value="<?php echo $detail_institusi->singkatan ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Judul</label>
  <div class="col-md-9">
    <input type="text" name="judul" class="form-control" value="<?php echo $detail_institusi->judul ?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-3 control-label">Alamat</label>
  <div class="col-md-9">
    <input type="text" name="alamat" class="form-control"  value="<?php echo $detail_institusi->alamat ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Kota</label>
  <div class="col-md-9">
    <input type="text" name="kota" class="form-control" value="<?php echo $detail_institusi->kota ?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-3 control-label">Email</label>
  <div class="col-md-9">
    <input type="email" name="email" class="form-control"  value="<?php echo $detail_institusi->email?>" >
  </div>
</div>


<div class="form-group">
  <label class="col-md-3 control-label">Batas Nilai Kelulusan CBT<br><small style="color: red;">Contoh : 50</small></label>
  <div class="col-md-9">
    <input type="text" name="batas_lulus" class="form-control"  value="<?php echo $detail_institusi->batas_lulus ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Status Batas Lulus CBT</label>
  <div class="col-md-9">
    <select name="status_batas_lulus" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($detail_institusi->status_batas_lulus=='1'){echo "selected";}?>>Aktif</option>
      <option value="0" <?php if($detail_institusi->status_batas_lulus=='0'){echo "selected";}?>>Tidak Aktif</option>
  </select>
  </div>
</div>

</div>

<div class="col-md-6">


<div class="form-group">
  <label class="col-md-3 control-label">Telepon</label>
  <div class="col-md-9">
    <input type="number" name="telp" class="form-control"  value="<?php echo $detail_institusi->telp?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">WA Konfirmasi Pembayaran</label>
  <div class="col-md-9">
    <input type="number" name="wa_konfirmasi" class="form-control"  value="<?php echo $detail_institusi->wa_konfirmasi ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">WA Konfirmasi Berkas</label>
  <div class="col-md-9">
    <input type="number" name="wa_konfirmasi_berkas" class="form-control"  value="<?php echo $detail_institusi->wa_konfirmasi_berkas ?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">facebook</label>
  <div class="col-md-9">
    <input type="text" name="fb" class="form-control"  value="<?php echo $detail_institusi->fb?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Instagram</label>
  <div class="col-md-9">
    <input type="text" name="ig" class="form-control"  value="<?php echo $detail_institusi->ig?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Twitter</label>
  <div class="col-md-9">
    <input type="text" name="twitter" class="form-control"  value="<?php echo $detail_institusi->twitter?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Website</label>
  <div class="col-md-9">
    <input type="text" name="website" class="form-control"  value="<?php echo $detail_institusi->website?>" >
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Status Pencairan Agen</label>
  <div class="col-md-9">
    <select name="status_pencairan" required="" class="form-control">
      <option value="">-Pilih-</option>
      <option value="1" <?php if($detail_institusi->status_pencairan=='1'){echo "selected";}?>>Buka</option>
      <option value="0" <?php if($detail_institusi->status_pencairan=='0'){echo "selected";}?>>Tutup</option>
  </select>
  </div>
</div>

</div>

<div class="col-md-12">


<div class="form-group">
  <label class="col-md-1 control-label">Deskripsi</label>
  <div class="col-md-11">
    <textarea name="deskripsi" class="form-control"><?php echo $detail_institusi->deskripsi ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">MAPS</label>
  <div class="col-md-11">
    <textarea name="maps" class="form-control"><?php echo $detail_institusi->maps ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">Persyaratan Upload Berkas</label>
  <div class="col-md-11">
    <textarea class="ckeditor" name="syarat_berkas" class="form-control"><?php echo $detail_institusi->syarat_berkas ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">Informasi Utama</label>
  <div class="col-md-11">
    <textarea class="ckeditor" name="informasi_utama" class="form-control"><?php echo $detail_institusi->informasi_utama ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">Deskripsi Beranda</label>
  <div class="col-md-11">
    <textarea class="ckeditor" name="deskripsi_beranda" class="form-control"><?php echo $detail_institusi->deskripsi_beranda ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">Alur Pendaftaran</label>
  <div class="col-md-11">
    <textarea class="ckeditor" id="ckedtor" name="alur_pendaftaran" class="form-control"><?php echo $detail_institusi->alur_pendaftaran ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">Manual Book Website Admin</label>
  <div class="col-md-11">
    <textarea class="ckeditor" id="ckedtor" name="panduan_website" class="form-control"><?php echo $detail_institusi->panduan_website ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label">Manual Book Website Mahasiswa</label>
  <div class="col-md-11">
    <textarea class="ckeditor" id="ckedtor" name="panduan_mahasiswa" class="form-control"><?php echo $detail_institusi->panduan_mahasiswa ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-1 control-label"></label>
  <div class="col-md-11">
    <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
    <button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
    
  </div>
  <div class="col-md-2"></div>

</div>

</div>
</div>

<?php echo form_close(); ?>


