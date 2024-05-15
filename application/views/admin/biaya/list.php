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
?>

<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th width="440">Fakultas</th>
            <th width="200">Prodi</th>
            <th>Program</th>
            <th>Biaya</th>
            <th width="50">Utama</th>
            <th width="50">Status</th>
            <th width="100"><center><a href="<?php echo base_url('admin/home/tambah_biaya') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a></center></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_biaya as $list_biaya) { ?>
        <tr> 
            <td width="20"><?php echo $i ?></td>
            <td><?php echo $list_biaya->nama_fakultas ?></td>
            <td><?php echo $list_biaya->jenjang ?> <?php echo $list_biaya->nama_prodi ?></td>
            <td><?php echo $list_biaya->program ?></td>
            <td><?php echo $list_biaya->biaya ?></td>
            <?php if($list_biaya->utama == '1'){ ?>
            <td><span class="label label-info">Yes</span></td>
            <?php }else{ ?>
            <td><span class="label label-warning">No</span></td>  
            <?php } ?>

            <?php if($list_biaya->status == '1'){ ?>
            <td><span class="label label-info">Aktif</span></td>
            <?php }else{ ?>
            <td><span class="label label-warning">Tidak Aktif</span></td>  
            <?php } ?>
            <td><center>
             <!-- <a href="<?php echo base_url('admin/home/delete_biaya/'.$list_biaya->id) ?>"  onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a> -->
            <a href="<?php echo base_url('admin/home/edit_biaya/'.$list_biaya->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center></td>
        </tr>
     <?php $i++; } ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>
