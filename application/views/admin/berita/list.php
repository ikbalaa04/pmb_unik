
<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr align="center">
            <th width="15">No</th>
            <th>Author</th>
            <th width="30">Gambar</th>
            <th>Judul</th>
            <th width="25">Kategori</th>
            <th width="15">Status</th>
            <th width="25"><small><a href="<?php echo base_url('admin/home/tambah_berita')?>" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Tambah</a></small></th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach($berita as $berita) { ?>

        <tr><td align="center"><?php echo $no?></td>
            <td><?php echo $berita->username?></td>
            <td><?php if($berita->foto == '') { ?>
                <img src="<?php echo base_url('assets/upload/berita/default.png')?>" class="img img-responsive img-thumbnail" width="50">
                <?php }else{?>
                <img src="<?php echo base_url('assets/upload/berita/thumbs/'.$berita->foto)?>" class="img img-responsive img-thumbnail" width="50">
                <?php }?>
            </td>
            <td><?php echo $berita->judul?></td>
            <td align="center">
                <?php if($berita->kategori != 'Pengumuman') { ?>
                <span class="badge badge-success">Informasi</span>
            <?php }else{ ?>
                <span class="badge badge-danger">Pengumuman</span>
            <?php } ?>
            </td>
            <td align="center">
                <?php if($berita->status != 'Draft') { ?>
                <span class="badge badge-success">Publish</span>
            <?php }else{ ?>
                <span class="badge badge-danger">Draft</span>
            <?php } ?>
            </td>
            <td align="center"><small>
                    <a href="<?php echo base_url('admin/home/edit_berita/'.$berita->id_berita)?>"  class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i></a>
                    <a href="<?php echo base_url('admin/home/hapus_berita/'.$berita->id_berita)?>" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></a></small>
            </td>
        </tr>
        <?php $no++;} ?>
    </tbody>
    </table>
</div>

</div>
</div>
</div>
</div>


