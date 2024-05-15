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
            <th>Nama Tahun Akademik</th>
            <th>Status</th>
            <th>Berlaku Sampai</th>
            <th width="100"><center><a href="<?php echo base_url('admin/home/tambah_thn_akademik') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a></center></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_thn_akademik as $list_thn_akademik) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td width=""><?php echo $list_thn_akademik->nama_thn_akademik ?></td>
                <?php if ($list_thn_akademik->status_thn_akademik == '0') { ?>    
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>   
                  <?php }else{?>
                     <td align="center"><span class="label label-info">Aktif</span></td>  
                  <?php } ?>
                <td><?php echo date('d-M-Y',strtotime($list_thn_akademik->berlaku))?></td>
                <td><center>
                <a href="<?php echo base_url('admin/home/edit_thn_akademik/'.$list_thn_akademik->id_thn_akademik) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center></td>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>

</div>
</div>
</div>
<div class="col-lg-12">
<h4><center><b>Tahun akademik yang diambil saat pendaftaran mahasiswa baru adalah tahun akademik paling baru, statusnya aktif dan masih berlaku</b></center></h4>
</div>
</div>

