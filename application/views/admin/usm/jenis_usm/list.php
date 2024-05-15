<a href="<?php echo base_url('admin/usm/tambah_jenis_usm') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> 

<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Nama Jenis USM</th>
            <th width="100">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($jenis_usm as $jenis_usm) { ?>
        <tr> 
            <td width="20"><?php echo $i ?></td>
            <td><?php echo $jenis_usm->nama ?></td>
            <td><center>
             <a href="<?php echo base_url('admin/usm/delete_jenis_usm/'.$jenis_usm->id) ?>" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a>
            <a href="<?php echo base_url('admin/usm/edit_jenis_usm/'.$jenis_usm->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a>
        </tr>
     <?php $i++; } ?>
    </tbody>
	</table>

</div>
</div>
</div>
</div>