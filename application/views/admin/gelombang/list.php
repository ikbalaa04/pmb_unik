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
<form method="post" action="<?php echo base_url('admin/home/delete_gelombang_banyak') ?>" id="form-delete">
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <?php if($this->session->userdata('id_level')=='1'){?>
            <th><input type="checkbox" id="check-all"></th>
            <?php } ?>
            <th>ID</th>
            <th>Fakultas</th>
            <th>Nama Gelombang</th>
            <th>Tanggal Berakhir</th>
            <th>Tahun Angkatan</th>
            <th>Angkatan</th>
            <th>Status</th>
            <th>Keterangan</th>
          <th><a href="<?php echo base_url('admin/home/tambah_gelombang') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list_gelombang as $list_gelombang) { ?>
        <tr> 
            <?php if($this->session->userdata('id_level')=='1'){?>
            <td><input type="checkbox" class="check-item" name="id[]" value="<?php echo $list_gelombang->id ?>" /></td>
            <?php } ?>
            <td width="20"><?php echo $list_gelombang->id ?></td>
            <td><?php echo $list_gelombang->nama_fakultas ?></td>
            <td><?php echo $list_gelombang->nama ?></td>
            <!-- <td><?php echo date('d-M-Y',strtotime($list_gelombang->date_start))?></td> -->
            <td><?php echo date('d-M-Y',strtotime($list_gelombang->date_end))?></td>
            <td><?php echo $list_gelombang->tahun?></td>
            <td><?php echo $list_gelombang->angkatan?></td>
            <?php if ($list_gelombang->status == '0') { ?>
                
                    <td align="center"><span class="label label-warning">Tidak Aktif</span></td>
                   
            <?php }else{?>

                     <td align="center"><span class="label label-info">Aktif</span></td>  

             <?php } ?>
            <td><?php echo $list_gelombang->keterangan?></td>
            <td><center>
             <!-- <a href="<?php echo base_url('admin/home/delete_gelombang/'.$list_gelombang->id) ?>" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')"  class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a> -->
            <a href="<?php echo base_url('admin/home/edit_gelombang/'.$list_gelombang->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center>
            
            </td>
        </tr>
     <?php } ?>
      </tbody>
  </table>
</div><br>
  <button type="button" id="btn-delete" class="btn btn-danger">Hapus Data Terpilih</button>
    </form><br>

