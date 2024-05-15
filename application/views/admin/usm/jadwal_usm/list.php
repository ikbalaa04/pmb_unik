<a href="<?php echo base_url('admin/usm/tambah_jadwal_usm/') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a> 

<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<form method="post" action="<?php echo base_url('admin/home/delete_jadwal') ?>" id="form-delete">
<button type="submit" id="btn-delete" onclick="return confirm('Anda yakin ingin menghapus data terpilih ini!!!')" class="btn btn-xs btn-danger">Hapus Data Terpilih</button><br><br>
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" id="check-all"></th>
            <th>No</th>
            <th>Program</th>
            <th>Jenis Ujian</th>
            <th>Tanggal Ujian</th>
            <th>Tempat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($jadwal_usm as $jadwal_usm) { ?>
        <tr> 
            <td><input type="checkbox" class="check-item" name="id[]" value="<?php echo $jadwal_usm->id ?>" /></td>
            <td width="20"><?php echo $i ?></td>
             <td><?php echo $jadwal_usm->nama_program ?></td>
            <td><?php echo $jadwal_usm->J ?></td>
            <td> <?php $tanggal = date('D',strtotime($jadwal_usm->tgl_ujian));
                $hariList = array('Sun' => 'Minggu',
                                  'Mon' => 'Senin',
                                  'Tue' => 'Selasa',
                                  'Wed' => 'Rabu',
                                  'Thu' => 'Kamis',
                                  'Fri' => 'Jumat',
                                  'Sat' => 'Sabtu');
                 echo $hariList[$tanggal];?>,<?php echo date('d M Y', strtotime($jadwal_usm->tgl_ujian))?> <br> Waktu : (
                <?php echo $jadwal_usm->jam_mulai?> -
                <?php echo $jadwal_usm->jam_selesai?> )
            </td>
             <td><?php echo $jadwal_usm->GD ?></td>
            <td><center>
             <a href="<?php echo base_url('admin/usm/delete_jadwal_usm/'.$jadwal_usm->id) ?>" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')" class="btn btn-md btn-danger"><i class="fa fa-trash-o"></i></a>
            <a href="<?php echo base_url('admin/usm/edit_jadwal_usm/'.$jadwal_usm->id) ?>" class="btn btn-md btn-info"><i class="fa fa-edit"></i></a></center>
        </tr>
     <?php $i++; } ?>
    </tbody>
    </table>
</div>
<br><br>
    <button type="submit" id="btn-delete" onclick="return confirm('Anda yakin ingin menghapus data terpilih ini!!!')" class="btn btn-xs btn-danger">Hapus Data Terpilih</button>
    </form>

</div>
</div>
</div>
</div>