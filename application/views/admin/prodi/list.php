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
          <th>No</th>
          <th>Nama Fakultas</th>
          <th>Jenjang</th>
          <th>Kode</th>
          <th>Nama Prodi</th>
          <th>Nama Bank</th>
          <th>Nomer Rekening</th>
          <th>Biaya Pendaftaran</th>
          <th>Status</th>
          <th><center><a href="<?php echo base_url('admin/home/tambah_prodi') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> </center></th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($list_prodi as $list_prodi) { ?>
          <tr> 
              <td width="20"><?php echo $i ?></td>
              <td><?php echo $list_prodi->nama_fakultas ?></td>
              <td><?php echo $list_prodi->jenjang ?></td>
              <td><?php echo $list_prodi->kode?></td>
              <td><?php echo $list_prodi->nama ?></td>
              <td><?php echo $list_prodi->namabank?></td>
              <td><?php echo $list_prodi->norek?></td>
              <td><?php echo $list_prodi->biaya ?></td>
              <?php if ($list_prodi->status == '0') { ?>
                  
                      <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                     
              <?php }else{?>

                       <td align="center"><span class="label label-info">Aktif</span></td>  

               <?php } ?>
              <td><center>
               <!-- <a href="<?php echo base_url('admin/home/delete_prodi/'.$list_prodi->id) ?>"  onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a> -->
              <a href="<?php echo base_url('admin/home/edit_prodi/'.$list_prodi->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center>
          </tr>
       <?php $i++; } ?>
    </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>

