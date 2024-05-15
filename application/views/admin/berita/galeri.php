<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr align="center">
            <th width="15">No</th>
            <th width="400">Gambar</th>
            <th width="400">Judul</th>
            <th >Status</th>
            <th width="100"><small><a href="<?php echo base_url('admin/home/tambah_galeri')?>" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Tambah</a></th></small>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach($galeri as $galeri) { ?>

        <tr><td align="center"><?php echo $no?></td>
            <td><?php if($galeri->foto == '') { ?>
                <img src="<?php echo base_url('assets/upload/berita/default.png')?>" class="img img-responsive img-thumbnail" width="50">
                <?php }else{?>
                <img src="<?php echo base_url('assets/upload/berita/thumbs/'.$galeri->foto)?>" width="100%">
                <?php }?>
            </td>
            <td><?php echo $galeri->judul?></td>
            <td align="center">
                <?php if($galeri->status != 'Draft') { ?>
                <span class="badge badge-success">Publish</span>
            <?php }else{ ?>
                <span class="badge badge-danger">Draft</span>
            <?php } ?>
            </td>
            <td align="center"><small>
                    <a href="<?php echo base_url('admin/home/edit_galeri/'.$galeri->id_berita)?>"  class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i></a>
                    <a href="<?php echo base_url('admin/home/hapus_galeri/'.$galeri->id_berita)?>" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></a></small>
            </td>
        </tr>
        <?php $no++;} ?>
    </tbody>
    </table>

</div>
</div>
</div>
</div>