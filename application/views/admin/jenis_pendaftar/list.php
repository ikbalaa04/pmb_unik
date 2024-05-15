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
            <th>Kode</th>
            <th>Nama</th>
            <th>Status</th>
            <th width="100"><center><a href="<?php echo base_url('admin/home/tambah_jenis_daftar') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> </center></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_jenis as $list_jenis) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td><?php echo $list_jenis->kode ?></td>
                <td><?php echo $list_jenis->nama ?></td>
                <?php if ($list_jenis->status == '0') { ?>
                
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                   
                  <?php }else{?>

                     <td align="center"><span class="label label-info">Aktif</span></td>  

                  <?php } ?>
                <td><center>
                <a href="<?php echo base_url('admin/home/edit_jenis_daftar/'.$list_jenis->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>

</div>
</div>
</div>
</div>

