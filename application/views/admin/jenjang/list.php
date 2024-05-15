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

<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
    <div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Nama</th>
            <th>Status</th>
            <th width="100">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_jenjang as $list_jenjang) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td><?php echo $list_jenjang->nama ?></td>
                <?php if ($list_jenjang->status == '0') { ?>
                
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                   
                  <?php }else{?>

                     <td align="center"><span class="label label-info">Aktif</span></td>  

                <?php } ?>

                <?php if ($list_jenjang->status == '0') { ?>
                
                    <td><center>
                    <a href="<?php echo base_url('admin/home/edit_aktif_jenjang/'.$list_jenjang->id) ?>" class="btn btn-md btn-success"><i class="fa fa-check"></i> Aktifkan</a></center></td>
                   
                  <?php }else{?>

                     <td align="center"><center>
                    <a href="<?php echo base_url('admin/home/edit_nonaktif_jenjang/'.$list_jenjang->id) ?>" class="btn btn-md btn-danger"><i class="fa fa-times-circle"></i> Non-aktifkan</a></center></td>  

                <?php } ?>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>

