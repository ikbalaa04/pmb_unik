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
            <th>nama database</th>
            <th>Nama jenis</th>
            <th>Status</th>
            <th>Jumlah Komisi</th>
            <th width="100"><center><a href="<?php echo base_url('admin/home/tambah_jenis_agen') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a></center></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_jenis_agen as $list_jenis_agen) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td><?php echo $list_jenis_agen->jenis_komisi ?></td>
                <td><?php echo $list_jenis_agen->nama_komisi ?></td>
                <?php if ($list_jenis_agen->status_komisi == '0') { ?>
                
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                   
                  <?php }else{?>

                     <td align="center"><span class="label label-info">Aktif</span></td>  

                  <?php } ?>
                <td >Rp. <?php echo number_format($list_jenis_agen->jumlah_komisi,'0',',','.') ?></td>
                <td><center>
                <a href="<?php echo base_url('admin/home/edit_jenis_agen/'.$list_jenis_agen->id_komisi) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>

</div>
</div>
</div>
</div>

