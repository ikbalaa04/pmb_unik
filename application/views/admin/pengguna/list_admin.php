<a href="<?php echo base_url('admin/home/tambah_pengguna') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> 

<?php
  echo validation_errors('<div class="alert alert-success">','</div>');
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
<form method="post" action="<?php echo base_url('admin/home/delete_user') ?>" id="form-delete">
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" id="check-all"></th>
            <th width="50">No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Fakultas</th>
            <th>Nomor HP</th>
            <th>Tanggal Submit / Update</th>
            <th>Akun</th>
            <th width="50"> Action</a></th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($pengguna as $pengguna) { ?>
        <tr> 
            <td><input type="checkbox" class="check-item" name="id[]" value="<?php echo $pengguna->id ?>" /></td>
            <td><?php echo $i?></td>
            <td><?php echo $pengguna->username?></td>
            <td><?php echo $pengguna->nama?></td>
            <td><?php echo $pengguna->level?></td>
            <td><?php echo $pengguna->singkatan?></td>
            <th><?php echo $pengguna->hp?></th>
            <td><?php echo $pengguna->tgl_submit?></td>
            <td align="center"><?php if($pengguna->status == '1') { ?>
                <center><span class="label label-success">Aktif </span><br> <a class="btn btn-danger btn-xs" href="<?php echo base_url('admin/home/nonaktif_user_admin/'.$pengguna->id)?>" > <i class="fa fa-power-off"></i> Nonaktifkan</a></center>
                <?php }else{ ?>
                <center><span class="label label-danger">Tidak Aktif</span><br> <a class="btn btn-success btn-xs" href="<?php echo base_url('admin/home/aktifkan_admin/'.$pengguna->id)?>" > <i class="fa fa-check"></i> Aktifkan</a></center>
                <?php } ?>
            </td>
            <td align="center">
              <a class="btn btn-info btn-xs" href="<?php echo base_url('admin/home/edit_pengguna/'.$pengguna->id)?>" > <i class="fa fa-edit"></i> Edit</a> 
              <!-- <a href="<?php echo base_url('admin/home/delete_pengguna/'.$pengguna->id)?>" onclick="return confirm('Anda yakin ingin menghapus data ini!!!')" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Hapus</a>  --></td>
        </tr>
     <?php $i++; } ?>
    </tbody>
  </table>
</div>
   <button type="button" id="btn-delete" class="btn btn-danger">Hapus Data Terpilih</button>
    </form>

</div>
</div>
</div>
</div>

