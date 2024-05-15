<?php

   if (isset($error)) : ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif;
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

$id_pendaftar = $detail ->id;
$berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);

error_reporting(0);

?>
<section class="content">
<div class="row">
<div class="col-md-12">
    <b>Status Berkas : 
        <?php if($berkas_terupload){ ?>
        <?php if($detail->verifikasi_berkas == 0) { ?>
            <span class="label label-default">Belum Dicek</span>
        <?php }elseif($detail->verifikasi_berkas == 1){ ?>
            <span class="label label-danger">Berkas Ditolak</span>
        <?php }else{ ?>
            <span class="label label-success">Sudah Diverifikasi</span>
        <?php }}else{ ?>
            <span class="label label-danger">Belum Upload Berkas</span>
        <?php } ?>
    </b> 
    <hr>
    </div>

    <form action="<?php echo base_url('admin/home/verifikasi_berkas/'.$detail->id)?>" method="post" >
    <div class="col-md-3">
    <label>Pilih Status Verifikasi Berkas</label>
    <select name="verifikasi_berkas" class="form-control">
        <option value="">-Pilih-</option>
            <option value="2" <?php if($detail->verifikasi_berkas == "2"){echo "selected";} ?>>Verifikasi Berkas</option>
            <option value="1" <?php if($detail->verifikasi_berkas == "1"){echo "selected";} ?>>Tolak Berkas</option>
        </select>
    </div>
    <div class="col-md-9">
    <b>
     Keterangan Berkas Maks. 300 karakter (Isi jika berkas akan ditolak) : 
     <textarea class="form-control" name="keterangan_berkas"><?php echo $detail->keterangan_berkas?></textarea>   
    </b>
    </div>

    <div class="col-md-5">
    <button class="btn btn-sm btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan Perubahan</button>
    <button class="btn btn-sm btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
    </div>
    </form>

<div class="col-md-12"><hr></div>

<?php   
$program = $detail->program;
$list_berkas_aktif = $this->admin_model->list_berkas_aktif($program); 
?>

<table id="example1" class="table table-bordered table-striped">

<?php foreach ($list_berkas_aktif as $list_berkas_aktif) { ?>
<tr>
<?php
$berkas_file = $list_berkas_aktif->id_berkas;
$cek_detail_berkas_masuk = $this->admin_model->cek_detail_berkas_masuk($berkas_file,$id_pendaftar,$program);
$berkas_masuk = $cek_detail_berkas_masuk->id_berkas;

if($berkas_file != $berkas_masuk){ ?>

<?php echo form_open_multipart(base_url('admin/home/upload_berkas'),'class="form-horizontal"'); ?>

<td>
<b><?php echo $list_berkas_aktif->nama_berkas ?><br><b style="color: red"> (Maks. <?php echo $list_berkas_aktif->besar_berkas ?> kb. Format <?php echo $list_berkas_aktif->type_file ?>)</b></b>  
</td>

<td>
<a href="#" class="btn btn-danger"> Belum Upload Berkas</a>   
</td>
        

<?php echo form_close(); ?>

<?php }else{ ?>

<?php 
$id_berkas = $list_berkas_aktif->id_berkas;
$id_pendaftar = $detail->id;
$detail_berkas_masuk_full = $this->admin_model->detail_berkas_masuk_pendaftar($id_berkas,$id_pendaftar,$program);
// print_r($detail_berkas_masuk_full->id_berkas);
?>
<?php echo form_open_multipart(base_url('admin/home/edit_upload_berkas/'.$detail_berkas_masuk_full->id_berkas_masuk),'class="form-horizontal"'); ?>

<td>
<b><?php echo $detail_berkas_masuk_full->nama_berkas ?><br><b style="color: red"> (Maks. <?php echo $detail_berkas_masuk_full->besar_berkas ?> kb. Format <?php echo $detail_berkas_masuk_full->type_file ?>)</b></b>   
</td>

<td>
<a href="<?php echo base_url('admin/home/unduh_berkas/'.$detail_berkas_masuk_full->id_berkas_masuk)?>" class="btn btn-info"><i class="fa fa-download"></i> Download Berkas</a> 
<a target="_blank" href="<?php echo base_url('assets/upload/berkas/'.$detail_berkas_masuk_full->file_masuk)?>" class="btn btn-warning"><i class="fa fa-folder-open"></i> Buka Berkas</a>   
</td>

<?php echo form_close(); ?>

<?php } ?>
</tr>
<?php } ?>

</table>

</div>
</section>      

