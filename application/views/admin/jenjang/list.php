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

<style>
  #example1 .master-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    white-space: nowrap;
  }
  #example1 .master-actions .btn {
    min-width: 34px;
    height: 30px;
    padding: 5px 9px;
  }
</style>

<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
    <div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Nama</th>
            <th>Status</th>
            <th width="100">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_jenjang as $list_jenjang) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td><?php echo html_escape($list_jenjang->nama) ?></td>
                <?php if ($list_jenjang->status == '0') { ?>
                
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                   
                  <?php }else{?>

                     <td align="center"><span class="label label-info">Aktif</span></td>  

                <?php } ?>

                <?php if ($list_jenjang->status == '0') { ?>
                
                    <td><div class="master-actions">
                    <a href="<?php echo base_url('admin/home/edit_aktif_jenjang/'.$list_jenjang->id) ?>" title="Aktifkan jenjang" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                    <?php if($this->session->userdata('id_level')=='1'){ ?>
                    <a href="<?php echo base_url('admin/home/delete_jenjang/'.$list_jenjang->id) ?>" title="Hapus jenjang" onclick="return confirm('Jenjang ini akan dihapus permanen. Lanjutkan?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    <?php } ?></div></td>
                   
                  <?php }else{?>

                    <td align="center"><div class="master-actions">
                    <a href="<?php echo base_url('admin/home/edit_nonaktif_jenjang/'.$list_jenjang->id) ?>" title="Nonaktifkan jenjang" class="btn btn-sm btn-warning"><i class="fa fa-times-circle"></i></a>
                    <?php if($this->session->userdata('id_level')=='1'){ ?>
                    <a href="<?php echo base_url('admin/home/delete_jenjang/'.$list_jenjang->id) ?>" title="Hapus jenjang" onclick="return confirm('Jenjang ini akan dihapus permanen. Lanjutkan?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                    <?php } ?></div></td>

                <?php } ?>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>
