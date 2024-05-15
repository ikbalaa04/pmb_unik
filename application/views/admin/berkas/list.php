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
          <th>Program</th>
          <th>Nama Berkas</th>
          <th>Besar Berkas</th>
          <th>Type File</th>
          <th>Urutan</th>
          <th>Status</th>
          <th><center><a href="<?php echo base_url('admin/home/tambah_custom_berkas') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> </center></th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($list_berkas as $list_berkas) { ?>
          <tr> 
              <td width="20"><?php echo $i ?></td>
              <td><?php echo $list_berkas->nama_program ?></td>
              <td><?php echo $list_berkas->nama_berkas ?></td>
              <td><?php echo $list_berkas->besar_berkas ?> kb</td>
              <td><?php echo $list_berkas->type_file ?></td>
              <td><?php echo $list_berkas->urutan ?></td>
              <?php if ($list_berkas->status == '0') { ?>
                      <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
              <?php }else{?>
                       <td align="center"><span class="label label-info">Aktif</span></td>  
               <?php } ?>
              <td><center>
              <a href="<?php echo base_url('admin/home/edit_custom_berkas/'.$list_berkas->id_berkas) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center>
          </tr>
       <?php $i++; } ?>
    </tbody>
  </table>

</div>
</div>
</div>
</div>
<div class="col-lg-12">
  <b>Catatan : <br> Besar Berkas : harus menggunakan satuan kb, 1024 kb = 1 mb <br>
  Type File : harus menggunakan | dan huruf kecil jika ingin menambahkan format file contoh : pdf|doc|jpg|png <br><br>
  <b style="color: red">Catatan penting : Pastikan cara penulisan dalam penambahan dan edit custom berkas untuk Besar Berkas dan Type File sesuai dengan catatan, jika tidak akan terjadi error</b>
</b>
</div>
</div>

