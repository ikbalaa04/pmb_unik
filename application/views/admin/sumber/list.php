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
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Nama</th>
            <th>Urutan</th>
            <th>Status</th>
            <th width="100"><center><!-- <a href="<?php echo base_url('admin/home/tambah_sumber') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>  -->Aksi</center></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_sumber as $list_sumber) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td width="900"><?php echo $list_sumber->nama ?></td>
                <td width="900"><?php echo $list_sumber->urutan ?></td>
                <?php if ($list_sumber->status == '0') { ?>
                
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                   
                  <?php }else{?>

                     <td align="center"><span class="label label-info">Aktif</span></td>  

                  <?php } ?>
                <td><center>
                <a href="<?php echo base_url('admin/home/edit_sumber/'.$list_sumber->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>

</div>
</div>
</div>
</div>

