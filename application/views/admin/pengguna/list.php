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
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="50">No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Nomor HP</th>
            <th>Akun</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($pengguna as $pengguna) { ?>
        <tr> 
            <td><?php echo $i?></td>
            <td><?php echo $pengguna->username?></td>
            <td><?php echo $pengguna->nama?></td>
            <td><?php echo $pengguna->level?></td>
            <td><?php echo $pengguna->singkatan?></td>
            <?php
            $kode1     = $pengguna->prodi;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            ?>
            <td><?php if($pilihan1){ ?><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> <?php } ?></td>
            <th><?php echo $pengguna->nik?></th>
            <th><?php echo $pengguna->email?></th>
            <th><?php echo $pengguna->hp?></th>
            <td align="center"><?php if($pengguna->status == '1') { ?>
                <center><span class="label label-success">Aktif </span><br> <a class="btn btn-danger btn-xs" href="<?php echo base_url('admin/home/nonaktif_user/'.$pengguna->id)?>" > <i class="fa fa-power-off"></i> Nonaktifkan</a></center>
                <?php }else{ ?>
                <center><span class="label label-danger">Tidak Aktif</span><br> <a class="btn btn-success btn-xs" href="<?php echo base_url('admin/home/aktifkan/'.$pengguna->id)?>" > <i class="fa fa-check"></i> Aktifkan</a></center>
                <?php } ?>
            </td>
        </tr>
     <?php $i++; } ?>
    </tbody>
  </table>
</div>

</div>
</div>
</div>
</div>

