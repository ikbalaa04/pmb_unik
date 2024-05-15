
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
<form method="post" action="<?php echo base_url('admin/home/delete_aktivitas') ?>" id="form-delete">
  <div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <?php if($this->session->userdata('id_level')=='1'){?>
            <th><input type="checkbox" id="check-all"></th>
            <?php } ?>
            <th>Waktu</th>
            <th>IP Address</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($aktitas as $aktitas) { ?>
        <tr> 
            <?php if($this->session->userdata('id_level')=='1'){?>
            <td><input type="checkbox" class="check-item" name="id[]" value="<?php echo $aktitas->id ?>" /></td>
            <?php } ?>
            <td><?php echo date('d-M-Y H:i',strtotime($aktitas->waktu)) ?></td>
            <td><?php echo $aktitas->ip?></td>
            <td><?php echo $aktitas->username?></td>
            <td><?php echo $aktitas->nama?></td>
            <td><?php echo $aktitas->keterangan?></td>
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

