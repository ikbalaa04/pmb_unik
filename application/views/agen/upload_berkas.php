<?php
  
$id_pendaftar = $detail->id;
$berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);

error_reporting(0);

?>
<section id="services" class="section-bg">
<div class="container">
<div class="row">
<a href="<?php echo base_url('agen/profil_maba/'.$detail->id)?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>

<div class="col-md-12"><br>
    <b>Status Berkas : 
        <?php if($berkas_terupload){ ?>
        <?php if($detail->verifikasi_berkas == 0) { ?>
            <span class="label label-default">Belum Dicek</span>
        <?php }elseif($detail->verifikasi_berkas == 1){ ?>
            <span class="label label-danger">Berkas Ditolak</span>
            <br>
            <br>
             Keterangan Berkas :
             <textarea class="form-control" readonly="" name="keterangan_berkas"><?php echo $detail->keterangan_berkas?></textarea>  
        <?php }else{ ?>
            <span class="label label-success">Sudah Diverifikasi</span>
            <br>
            <br>
             Keterangan Berkas :
             <textarea class="form-control" readonly="" name="keterangan_berkas"><?php echo $detail->keterangan_berkas?></textarea>   
        <?php }}else{ ?>
            <span class="label label-danger">Belum Upload Berkas</span>
        <?php } ?>

        <br>
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
          ?>
    </b> 
    
    </div>

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

<?php echo form_open_multipart(base_url('agen/upload_berkas/'.$detail->id),'class="form-horizontal"'); ?>

  <td>
    <?php echo $list_berkas_aktif->nama_berkas ?><br><b style="color: red"> (Maks. <?php echo $list_berkas_aktif->besar_berkas ?> kb. Format <?php echo $list_berkas_aktif->type_file ?>)</b>
  </td>
  <td>
    <input type="hidden" name="id_berkas" value="<?php echo $list_berkas_aktif->id_berkas ?>">
    <input type="hidden" name="nama_lengkap" value="<?php echo $detail->nama_lengkap ?>">
    <input type="hidden" name="program" value="<?php echo $detail->program ?>">
    <input type="file" name="berkas" class="form-control" required="" >
  </td>
  <td colspan="2">
    <button class="btn btn-xs btn-primary" style="margin-top: 8px" type="submit"><i class="fa fa-upload"></i> Upload</button>
  </td>

<?php echo form_close(); ?>

<?php }else{ ?>

<?php 
$id_berkas = $list_berkas_aktif->id_berkas;
$id_pendaftar = $detail->id;
$detail_berkas_masuk_full = $this->admin_model->detail_berkas_masuk_pendaftar($id_berkas,$id_pendaftar,$program);
// print_r($detail_berkas_masuk_full->id_berkas);
?>
<?php echo form_open_multipart(base_url('agen/edit_upload_berkas/'.$detail_berkas_masuk_full->id_berkas_masuk),'class="form-horizontal"'); ?>

<td>
<?php echo $detail_berkas_masuk_full->nama_berkas ?><br><b style="color: red"> (Maks. <?php echo $detail_berkas_masuk_full->besar_berkas ?> kb. Format <?php echo $detail_berkas_masuk_full->type_file ?>)</b>  
</td>

<td>
  <input type="hidden" name="nama_lengkap" value="<?php echo $detail->nama_lengkap ?>">
  <input type="hidden" name="program" value="<?php echo $detail->program ?>">
  <input type="file" name="berkas" class="form-control" required="" >
</td>

<td>
<button class="btn btn-xs btn-success" style="margin-top: 8px" type="submit"><i class="fa fa-upload"></i> Upload Ulang</button>
</td>

<td>
    <a  style="margin-top: 8px" href="<?php echo base_url('admin/home/unduh_berkas/'.$detail_berkas_masuk_full->id_berkas_masuk)?>" class="btn btn-xs btn-info"><i class="fa fa-download"></i> Download</a> 
    <a  style="margin-top: 8px" target="_blank" href="<?php echo base_url('assets/upload/berkas/'.$detail_berkas_masuk_full->file_masuk)?>" class="btn btn-xs btn-warning"><i class="fa fa-folder-open"></i> Buka</a>
</td>       
    
<?php echo form_close(); ?>

<?php } ?>
</tr>
<?php } ?>

</table>


<div class="col-md-12"><hr></div>
<b>Catatan : 1 mb = 1024 kb</b>

</div>
</div>
</section>      

