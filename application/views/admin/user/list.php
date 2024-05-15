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
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Fakultas</th>
            <th>Tanggal Submit / Update</th>
            <th>Akun</th>
            <th width="100"> Action</a></th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($user as $user) { ?>
        <tr> 
            <td><?php echo $i?></td>
            <td><?php echo $user->username?></td>
            <td><?php echo $user->nama?></td>
            <td><?php echo $user->level?></td>
            <td><?php echo $user->singkatan?></td>
            <td><?php echo $user->tgl_submit?></td>
            <td><?php if($user->status == '1') { ?>
                <span>Aktif</span>
                <?php }else{ ?>
                <span>Tidak Aktif</span>
                <?php } ?>
            </td>
            <td align="center">
              <a class="btn btn-info btn-sm" href="<?php echo base_url('admin/home/edit_pengguna/'.$user->id)?>" > <i class="fa fa-edit"></i></a> 
              <a href="<?php echo base_url('admin/home/delete_pengguna/'.$user->id)?>" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-danger btn-sm"> <i class="fa fa-trash-o"></i></a></td>
        </tr>
     <?php $i++; } ?>
    </tbody>
  </table>

</div>
</div>
</div>
</div>

