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
            <th>Status Admin</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_thn_akademik as $list_thn_akademik) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td width=""><?php echo $list_thn_akademik->nama_thn_akademik ?></td>
                <?php if ($list_thn_akademik->utama_thn_akademik == '0') { ?>    
                    <td><span class="label label-danger">TIDAK AKTIF</span> <br>
                      <a href="<?php echo base_url('admin/home/aktif_thn_akademik/'.$list_thn_akademik->id_thn_akademik) ?>" class="btn btn-xs btn-info"><i class="fa fa-check-circle"></i> Aktifkan</a></td>   
                  <?php }else{?>
                     <td><span class="label label-lg label-success">AKTIF</span></td>  
                  <?php } ?>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>

</div>
</div>
</div>
<div class="col-lg-12">
<h4><center><b>Tahun akademik admin merupakan tahun akademik yang akan menampilkan data pendaftar sesuai tahun akademik admin yang status adminya AKTIF</b></center></h4>
</div>
</div>

