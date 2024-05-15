<div class="row"> 
    <div class="col-lg-12">
      <a href="<?php echo base_url('admin/home/agen')?>" class="btn btn-success btn-md"><i class="fa fa-backward"></i> Kembali ke Data Agen </a>
  </div>
</div><br>

<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Sumber</th>
            <th width="20">WA</th>
            <th width="120">No. Ujian</th>
            <th width="20">Jenis</th>
            <th width="20">Program</th>
            <th width="20">Fakultas</th>
            <th>Gelombang</th>
            <th>Pilihan 1</th>
            <th>Pilihan 2</th>
            <th>Nama Lengkap</th>
            <!-- <th>Email</th>
            <th>Password</th> -->
            <th>Asal</th>
            <th>Jurusan / IPK</th>
            <th>Status</th>
            <th>Bukti Bayar</th>
            <th width="20">Berkas</th>
            <th width="20">Kartu</th>
            <th>Formulir</th>
            <th>Aksi</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $q=1; $e=1; foreach ($accept as $accept) { ?>
        <tr> 

            <td width="20"><?php echo $q ?></td>
            <td><?php echo $accept->sumber ?> <?php echo $accept->keterangan_sumber ?></td>
            <td align="center"><a class="btn btn-xs btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $accept->hp?>&text=Halo%20<?php echo $accept->nama_lengkap ?>,%20Kami%20dari%20panitia%20PMB..."> <i class="fa fa-whatsapp"></i> <?php echo $accept->hp?></a></td>

            <td width="20"><?php if($accept->noujian == ''){echo "Belum Ada";}else{echo $accept->noujian;} ?></td>
            <td width="20"><?php if($accept->jenis == ''){echo "Belum diisi";}else{echo $accept->jenis;} ?></td>
            <td width="20"><?php if($accept->nama_program == ''){echo "Belum diisi";}else{echo $accept->nama_program;} ?></td>
            <td><?php echo $accept->singkatan ?></td>
            <td><?php echo $accept->nama_gelombang ?></td>
            <?php
            $kode1     = $accept->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $accept->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>
            <?php
            if($accept->jurusan_pilihan !='0'){ ?>
              <td><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> </td>
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <?php
            if($accept->jurusan_pilihan2 !='0'){ ?>
              <td><?php echo $pilihan2->jenjang ?> <?php echo $pilihan2->nama ?> </td> 
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <td><?php echo $accept->nama_lengkap ?></td>
            <!-- <td><?php echo $accept->email?></td>
            <td><?php echo $accept->password?></td> -->

            

            <?php if($accept->jenjang == 'S1') { ?>
            <td><?php if($accept->sekolah_nama == ''){echo "Belum diisi";}else{echo $accept->sekolah_nama;} ?></td>
            <?php if($accept->sekolah_jurusan == 'Lainnya'){?> 
            <td><?php if($accept->sekolah_nama_jurusan == ''){echo "Belum diisi";}else{echo $accept->sekolah_nama_jurusan;} ?></td>
            <?php }else{ ?>
            <td><?php if($accept->sekolah_jurusan == ''){echo "Belum diisi";}else{echo $accept->sekolah_jurusan;} ?></td>
            <?php }}else{ ?>
            <td ><?php if($accept->kampus_asal == ''){echo "Belum diisi";}else{echo $accept->kampus_asal;} ?></td>
            <td ><?php if($accept->ipk == ''){echo "Belum diisi";}else{echo $accept->ipk;} ?></td>
            <?php } ?>

            <td>
                <?php if($accept->approve == '0'){?>
                <span class="label label-danger">Belum Diverifikasi</span>
                <?php }else{ ?>
                <span class="label label-success">Sudah Diverifikasi</span>
                <?php } ?>
            </td>

            <td align="center"><center>
                <?php $program = $accept->program;
                $detail_program  = $this->admin_model->kartu_program($program);  ?>
                <?php if($detail_program->tipe_program !='Berbayar'){ ?>
                <span class="label label-default">Tidak Perlu</span>
                <?php }else{ ?>
                <?php if($accept->bukti_bayar == ''){ ?>
                <span class="label label-danger"> Belum Ada</span>
                <?php }else{ ?>
                <?php include('detail.php') ?>
                <?php } ?>
                <?php } ?>
                </center>
            </td>

            
            <?php $detail_institusi      = $this->admin_model->detail_institusi(); ?>
            <td>
            <center>
                <?php 
                $id_pendaftar = $accept->id;
                $berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);
                 if($berkas_terupload){ ?>
                <?php if($accept->verifikasi_berkas == 0) { ?>
                    <span class="label label-default">Belum Dicek</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }elseif($accept->verifikasi_berkas == 1){ ?>
                    <span class="label label-danger">Berkas Ditolak</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }else{ ?>
                    <span class="label label-success">Sudah Diverifikasi</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }}else{ ?>
                    <span class="label label-danger">Belum Ada</span>
                <?php } ?>
            </center></td>

            <td>
            <a target="_blank" href="<?php echo base_url('admin/home/cetak_kartu_admin/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Cetak</a>
            </td> 

            <td>
            <a target="_blank" href="<?php echo base_url('admin/home/cetak_formulir/'.$accept->id) ?>" class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i> Cetak</a> 
            </td>  
            <!-- <td align="center">
                <a target="_blank" href="<?php echo base_url('admin/home/detail_berkas/'.$accept->id) ?>" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i> Berkas</a>
                </form>
            </td> -->

            <td align="center"><a target="_blank"  href="<?php echo base_url('admin/home/edit_verifikasi/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> detail</a>
            </td>  	

    </tr>
     <?php $q++; } ?>
    </tbody>
	</table>
    </div>



    <!-- </form> -->
        <br><br>
        <?php if($this->input->post('gelombang')!='') { ?> 
            <center>
            <form action="<?php echo base_url('admin/home/excel') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel Terverifikasi</button>
            </form><br>

            <form action="<?php echo base_url('admin/home/no_urut') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="fakultas" value="<?php echo $this->input->post('fakultas')?>">
                <button type="submit" class="btn btn-warning"><i class="fa fa-sort-numeric-asc" ></i> Cetak Nomer Urut</button>
            </form>
            </center><br><hr>

            <?php $g     = $this->input->post('gelombang');
                  $p     = $this->input->post('fakultas');
                  $awal  = $this->admin_model->sesi_dari($g,$p);
                  $akhir = $this->admin_model->sesi_dari($g,$p);  
            ?>

            <div class="col-lg-5"></div>
            <form action="<?php echo base_url('admin/home/daftar_hadir/') ?>" target="_blank" method="post">
            <div class="col-lg-1">
                <label>Dari</label><br>
                <select name="awal" class="form-control">
                <option selected disabled>-Pilih-</option>
                    <?php $a=1; foreach($awal as $awal) {?>
                <option value="<?php echo $awal->id?>"><?php echo $a++; ?></option>
                    <?php } ?>
                </select><br>
            </div>
            
             <div class="col-lg-1">
               <label>Sampai Ke-</label><br>
                <select name="akhir" class="form-control">
                <option selected disabled>-Pilih-</option>
                    <?php $b=1; foreach($akhir as $akhir) {?>
                <option value="<?php echo $akhir->id?>"><?php echo $b++;?></option>
                    <?php } ?>
                </select><br>
            </div>

            <div class="col-lg-2"><br>
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="fakultas" value="<?php echo $this->input->post('fakultas')?>">
                <button type="submit" class="btn btn-success"><i class="fa fa-list" ></i> Daftar Hadir</button>
            </div>
            </form>

        <?php } ?>
</div>
</div>
</div>
</div>

