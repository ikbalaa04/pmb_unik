<div class="row"> 
    <div class="col-lg-12">
      <a href="<?php echo base_url('admin/home/agen')?>" class="btn btn-success btn-md"><i class="fa fa-backward"></i> Kembali ke Data Agen </a>
  </div>
</div><br>

<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="10">No</th>
            <th>Sumber</th>
            <th>Daftar</th>
            <th width="20">WA</th>
            <th>Hp</th>
            <th width="20">Fakultas</th>
            <th>Gelombang</th>
            <th>Pilihan 1</th>
            <th>Pilihan 2</th>
            <th>Nama</th>
            <th>Asal</th>
            <th>Jurusan/IPK</th>
            <th width="50">Bukti Bayar</th>
            <th width="30">Verifikasi Pembayaran</th>
            <th width="20">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $j=1; foreach ($karantina as $karantina) { 
        ?>                               
        <tr> 
            <?php
            $kode1     = $karantina->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $karantina->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>
            
            <td width="20"><?php echo $j ?></td>
            <td><?php echo $karantina->sumber ?> <?php echo $karantina->keterangan_sumber ?></td>
            <td><?php echo date("d M Y H:i", strtotime($karantina->tanggal_daftar )) ?></td>
            <td align="center"><a class="btn btn-xs btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $karantina->hp?>&text=Halo%20<?php echo $karantina->nama_lengkap ?>,%20Kami%20dari%20panitia%20PMB...."> <img width="30" src="<?php echo base_url('assets/wa.png')?>"></a></td>
            <td width="20"><?php echo $karantina->hp?></td>
            <td><?php echo $karantina->singkatan ?></td>
            <td><?php echo $karantina->nama_gelombang ?></td>
            <?php
            if($karantina->jurusan_pilihan !='0'){ ?>
              <td><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> </td>
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <?php
            if($karantina->jurusan_pilihan2 !='0'){ ?>
              <td><?php echo $pilihan2->jenjang ?> <?php echo $pilihan2->nama ?> </td> 
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <td><?php echo $karantina->nama_lengkap ?></td>

            
            <?php if($karantina->jenjang == 'S1' ) { ?>
            <td><?php if($karantina->sekolah_nama == ''){echo "Belum diisi";}else{echo $karantina->sekolah_nama;} ?></td>
            <?php if($karantina->sekolah_jurusan == 'Lainnya'){?> 
            <td><?php if($karantina->sekolah_nama_jurusan == ''){echo "Belum diisi";}else{echo $karantina->sekolah_nama_jurusan;} ?></td>
            <?php }else{ ?>
            <td><?php if($karantina->sekolah_jurusan == ''){echo "Belum diisi";}else{echo $karantina->sekolah_jurusan;} ?></td>
            <?php }}else{ ?>
            <td ><?php if($karantina->kampus_asal == ''){echo "Belum diisi";}else{echo $karantina->kampus_asal;} ?></td>
            <td ><?php if($karantina->ipk == ''){echo "Belum diisi";}else{echo $karantina->ipk;} ?></td>
            <?php } ?>

            <?php if ($karantina->atas_nama != '' && $karantina->bank != '') { ?>
              <td align="center"><?php include('detail_karantina.php') ?></td>
            <?php }else{ ?>
              <td><center><span class="label label-danger">Belum ada</span></center></td>
            <?php } ?> 
            <td ><center><a href="<?php echo base_url('admin/home/tandai_karantina_agen/'.$karantina->id) ?>" class="btn btn-xs btn-info"><small>Verifikasi Pembayaran</small></a></center></td>
            <td><a href="<?php echo base_url('admin/home/delete_karantina_agen/'.$karantina->id) ?>" class="btn btn-xs btn-warning" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')"><i class="fa fa-trash-o"></i></a></td>
    </tr>
     <?php $j++; } ?>
    </tbody>
    </table>
    </div>

</div>
</div>
</div>
</div>