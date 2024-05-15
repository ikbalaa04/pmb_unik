<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomer Pendaftaran</th>
            <th>Foto Suami</th>
            <th>Nama Calon Suami</th>
            <th>Foto Istri</th>
            <th>Nama Calon Istri</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($detail as $detail) { ?>
        <tr> 
            <td><?php echo $i ?></td>
            <td><?php echo $detail->bukti ?></td>
            <td align="center"><img src="<?php echo base_url('assets/upload/image/'.$detail->foto_suami)?>" class="img img-responsive img-thumbnail" width="50"></td>
            <td><?php echo $detail->nama_suami ?></td>
            <td align="center"><img src="<?php echo base_url('assets/upload/image/'.$detail->foto_istri)?>" class="img img-responsive img-thumbnail" width="50"></td>
            <td><?php echo $detail->nama_istri?></td>
            <td><center>
            <a href="<?php echo base_url('admin/pendaftar/detail/'.$detail->id_pendaftaran) ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>
            <a href="<?php echo base_url('admin/pendaftar/edit/'.$detail->id_pendaftaran) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
            </center></td>
        </tr>
     <?php $i++; } ?>
    </tbody>
	</table>

</div>
</div>
</div>
</div>