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
        
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Kode</th>
            <th>Fakultas</th>
            <th>Singkatan</th>
            <th>Status</th>
            <th width="100"><center><a href="<?php echo base_url('admin/home/tambah_fakultas') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> </center></th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach ($list_fakultas as $list_fakultas) { ?>
            <tr> 
                <td><?php echo $i ?></td>
                <td><?php echo $list_fakultas->kode ?></td>
                <td><?php echo $list_fakultas->nama_fakultas ?></td>
                <td><?php echo $list_fakultas->singkatan ?></td>
                <?php if ($list_fakultas->status == '0') { ?>
                    
                        <td align="center"><a href="#" class="btn btn-sm btn-warning"><b>Tidak Aktif</b></a></td>
                       
                <?php }else{?>

                         <td align="center"><a href="#" class="btn btn-sm btn-success"><b>Aktif</b></a></td>  

                 <?php } ?>
                <td><center>
                 <!-- <a href="<?php echo base_url('admin/home/delete_fakultas/'.$list_fakultas->id) ?>"  onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a> -->
                <a href="<?php echo base_url('admin/home/edit_fakultas/'.$list_fakultas->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>