<div class="row"> 
    <div class="col-lg-12">
      <a href="<?php echo base_url('admin/home/agen')?>" class="btn btn-success btn-md"><i class="fa fa-backward"></i> Kembali ke Data Agen </a>
  </div>
</div><br>

<!-- Example row of columns -->
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
            <th width="20">Jenis</th>
            <th width="20">Program</th>
            <th width="20">Fakultas</th>
            <th>Gelombang</th>
            <th>Pilihan 1</th>
            <th>Pilihan 2</th>
            <th>Nama Lengkap</th>
            <th>Hp</th>
            <th>Asal</th>
            <th>Jurusan/IPK</th>
            <th width="70">Berkas</th>
            <th width="50">Bukti Bayar</th>
            <th width="20">Verifikasi Data</th>
            <th width="20">Aksi</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $q=1; foreach ($verifikasi as $verifikasi) { ?> 
        <tr> 
            <?php
            $kode1     = $verifikasi->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $verifikasi->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>
            
            <td width="20"><?php echo $q ?></td>
            <td><?php echo $verifikasi->sumber ?> <?php echo $verifikasi->keterangan_sumber ?></td>
            <td><?php echo date("d M Y H:i", strtotime($verifikasi->tanggal_daftar )) ?></td>
            <td align="center"><a class="btn btn-xs btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $verifikasi->hp?>&text=Halo%20<?php echo $verifikasi->nama_lengkap ?>,%20Kami%20dari%20panitia%20PMB%20FMIPA%20UNIGA.%20Terimakasih%20Telah%20melalukan%20pendaftaran.%20Mohon%20segera%20melakukan%20registrasi%20dan%20konfirmasi%20Pemabayaran%20Terimakasih%20:)"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"></a></td>
            <td width="20"><?php if($verifikasi->jenis == ''){echo "Belum diisi";}else{echo $verifikasi->jenis;} ?></td>
            <td width="20"><?php if($verifikasi->nama_program == ''){echo "Belum diisi";}else{echo $verifikasi->nama_program;} ?></td>
            <td><?php echo $verifikasi->singkatan ?></td>
            <td><?php echo $verifikasi->nama_gelombang ?></td>
            <?php
            if($verifikasi->jurusan_pilihan !='0'){ ?>
              <td><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> </td>
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <?php
            if($verifikasi->jurusan_pilihan2 !='0'){ ?>
              <td><?php echo $pilihan2->jenjang ?> <?php echo $pilihan2->nama ?> </td> 
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <td><?php echo $verifikasi->nama_lengkap ?></td>

            <td width="20"><?php echo $verifikasi->hp?></td>
            <?php if($verifikasi->jenjang == 'S1' ) { ?>
            <td><?php if($verifikasi->sekolah_nama == ''){echo "Belum diisi";}else{echo $verifikasi->sekolah_nama;} ?></td>
            <?php if($verifikasi->sekolah_jurusan == 'Lainnya'){?> 
            <td><?php if($verifikasi->sekolah_nama_jurusan == ''){echo "Belum diisi";}else{echo $verifikasi->sekolah_nama_jurusan;} ?></td>
            <?php }else{ ?>
            <td><?php if($verifikasi->sekolah_jurusan == ''){echo "Belum diisi";}else{echo $verifikasi->sekolah_jurusan;} ?></td>
            <?php }}else{ ?>
            <td ><?php if($verifikasi->kampus_asal == ''){echo "Belum diisi";}else{echo $verifikasi->kampus_asal;} ?></td>
            <td ><?php if($verifikasi->ipk == ''){echo "Belum diisi";}else{echo $verifikasi->ipk;} ?></td>
            <?php } ?>
    
            <?php $detail_institusi      = $this->admin_model->detail_institusi(); ?>

            <td>
            <center>
                <?php 
                $id_pendaftar = $verifikasi->id;
                $berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);
                 if($berkas_terupload){ ?>
                <?php if($verifikasi->verifikasi_berkas == 0) { ?>
                    <span class="label label-default">Belum Dicek</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$verifikasi->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }elseif($verifikasi->verifikasi_berkas == 1){ ?>
                    <span class="label label-danger">Berkas Ditolak</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$verifikasi->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }else{ ?>
                    <span class="label label-success">Sudah Diverifikasi</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$verifikasi->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }}else{ ?>
                    <span class="label label-danger">Belum Ada</span>
                <?php } ?>

            </center></td>
            


            <td align="center"><center><?php include('detail.php') ?></center></td>


            <td align="center"><center><span class="label label-default">Belum Diverifikasi</span><br>
            <a target="_blank"  href="<?php echo base_url('admin/home/tandai_verifikasi_agen/'.$verifikasi->id) ?>" class="btn btn-xs btn-success" onclick="return confirm('Anda yakin ingin verifikasi data ini !!!')">Verifikasi Data</a>
            </center>
            </td>

             <td align="center"><a href="<?php echo base_url('admin/home/edit_verifikasi/'.$verifikasi->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a>
               <?php if($this->session->userdata('id_level')=='1'){ ?>
               <a href="<?php echo base_url('admin/home/delete_verifikasi_agen/'.$verifikasi->id) ?>" class="btn btn-xs btn-warning" onclick="return confirm('Anda yakin ingin menghapus data ini!!!')"><i class="fa fa-trash-o"></i> delete</a> 
               <?php } ?>
           </td>
        	

    </tr>
     <?php $q++; } ?>
    </tbody>
	</table>
    </div>
  

</div>
</div>
</div>
</div>