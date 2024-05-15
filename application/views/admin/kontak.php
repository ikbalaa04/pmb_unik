
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example2" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Status Admin</th>
            <th>Fakultas</th>
            <th>Whattsapp</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach ($pengguna as $pengguna) { ?>
        <?php if($detail->fakultas == $pengguna->fakultas){ ?>
        <tr> 
            <td><?php echo $no++ ?></td>
            <td><?php echo $pengguna->nama ?></td>
            <td><?php if($pengguna->id_level=='2'){echo "Admin PMB"; }elseif($pengguna->id_level=='1'){echo "SUPERADMIN";} ?></td>
            <td><?php if($pengguna->fakultas=='0') { ?>
            -
            <?php }else{ ?>
            <?php echo $pengguna->nama_fakultas ?>
            <?php }?>
            </td>
            <td><a class="btn btn-xs btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $pengguna->hp?>&text=Halo%20Admin,%20(sebutkan%20nama%20dan%20pertanyaan%20anda)"> <i class="fa fa-whatsapp"></i> <b> Hub. <?php echo $pengguna->nama ?></b></a></td>
        </tr>
     <?php }} ?>
    </tbody>
    </table><br>
</div>
</div>
</div>
</div>
</div>