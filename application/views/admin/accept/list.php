<div class="row" align="text-center"> 
    <form method="post" action="<?php echo base_url('admin/home/accept_filter')?>">

        <?php if($this->session->userdata('id_level')=='1'||'2'){?>
        <div class="col-lg-5">
            <?php $list_prodi_aktif = $this->admin_model->list_prodi_aktif();?>
            <label>Program Studi</label><br>
            <select required="" name="prodi" class="form-control">
            <option value="">-Pilih Prodi-</option>
            <?php foreach($list_prodi_aktif as $list_prodi_aktif) {?>
            <option value="<?php echo $list_prodi_aktif->kode ?>" <?php if($this->input->post('prodi')==$list_prodi_aktif->kode){echo "selected";} ?>><?php echo $list_prodi_aktif->singkatan ?> - <?php echo $list_prodi_aktif->jenjang ?> <?php echo $list_prodi_aktif->nama ?> </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-lg-4">
            <label>Gelombang</label><br>
            <select required="" class="form-control" name="gelombang">
                <option value="">-Pilih Gelombang-</option>
                <?php foreach($pilih_gelombang as $pilih_gelombang) { ?>
                <option value="<?php echo $pilih_gelombang->id ?>" <?php if($this->input->post('gelombang')==$pilih_gelombang->id){echo "selected";} ?>><?php echo $pilih_gelombang->singkatan ?> - <?php echo $pilih_gelombang->nama ?> - <?php echo $pilih_gelombang->tahun ?></option>
                <?php } ?>
            </select>
        </div>

        <?php }else{ ?>

        <div class="col-lg-5">
            <?php $list_prodi_aktif = $this->admin_model->fakultas_prodi();?>
            <label>Program Studi</label><br>
            <select required="" name="prodi" class="form-control">
            <option value="">-Pilih Prodi-</option>
            <?php foreach($list_prodi_aktif as $list_prodi_aktif) {?>
            <option value="<?php echo $list_prodi_aktif->kode ?>" <?php if($this->input->post('prodi')==$list_prodi_aktif->kode){echo "selected";} ?>><?php echo $list_prodi_aktif->singkatan ?> - <?php echo $list_prodi_aktif->jenjang ?> <?php echo $list_prodi_aktif->nama ?> </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-lg-3">
            <label>Gelombang</label><br>
            <select required="" class="form-control" name="gelombang">
                <option value="">-Pilih Gelombang-</option>
                <?php foreach($pilih_gelombang as $pilih_gelombang) { ?>
                <option value="<?php echo $pilih_gelombang->id ?>" <?php if($this->input->post('gelombang')==$pilih_gelombang->id){echo "selected";} ?>><?php echo $pilih_gelombang->nama ?> - <?php echo $pilih_gelombang->tahun ?></option>
                <?php } ?>
            </select>
        </div>
        <?php } ?>

                <br>
                <input style="margin-top: 5px; border-radius: 5px" type="submit" value="Filter" class="btn btn-info btn-md">
                <a class="btn btn-success btn-md" style="margin-top: 5px; border-radius: 5px" href="<?php echo base_url('admin/home/accept')?>" > Tanpa Filter</a>
    </form>
</div><br>

<!-- Example row of columns -->
<div class="row">
<?php if($this->session->userdata('id_level')=='1'||"4"){?>
<div class="col-lg-12"><hr>
<h4><center>Note : Untuk memberikan nomer ujian coba filter terlebih dahulu sesuai fakultas dan gelombang supaya nomer ujian berurutan</center></h4><hr> </div>
<?php }else{ ?>
<div class="col-lg-12"><hr>
<h4><center>Note : Untuk memberikan nomer ujian coba filter terlebih dahulu sesuai gelombang supaya nomer ujian berurutan</center></h4><hr> </div>
<?php } ?>

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
            <!-- <th>Hp</th> -->
            <th>Asal</th>
            <th>Jurusan</th>
            <th width="20">Berkas</th>
            <th width="20">Bukti Bayar</th>
            <th width="30">No Ujian</th>
            <th width="20">Kartu</th>
            <th>Formulir</th>
            <th>Status Tes</th>
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
            <td><?php echo $accept->nama_gelombang ?> - <?php echo $accept->tahun_gelombang ?></td>
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

            <td><?php echo $accept->sekolah_nama; ?></td>
            <td><?php echo $accept->sekolah_jurusan; ?></td>

            
            <td>
            <center>
                <?php 
                $id_pendaftar = $accept ->id;
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
            

            <?php $urut = $e++;
            $batas = str_pad($urut, 3, "0", STR_PAD_LEFT); ?>

        
            
            <td align="center">
            <?php if($accept->noujian == '') { ?>        
                <form method="post" action="<?php echo base_url('admin/home/ujian/'.$accept->id)?>">
                <input type="hidden" name="noujian" value="USM<?php echo date('y') ?><?php echo $accept->fakultas ?><?php echo $batas ?>">
                <input type="submit" value="Generate" class="btn btn-xs btn-info">
                </form>
            <?php  }else{?>
                <form method="post" action="<?php echo base_url('admin/home/ujian/'.$accept->id)?>">
                <input type="hidden" name="noujian" value="USM<?php echo date('y') ?><?php echo $accept->fakultas ?><?php echo $batas ?>">
                <input type="submit" value="Ganti" class="btn btn-xs btn-success">
                </form>
            <?php } ?>
            </td>

            <td>
            <a  href="<?php echo base_url('admin/home/cetak_kartu_admin/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Cetak</a>
            </td> 

            <td>
            <a target="_blank" href="<?php echo base_url('admin/home/cetak_formulir/'.$accept->id) ?>" class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i> Cetak</a> 
            </td>  
            <!-- <td align="center">
                <a target="_blank" href="<?php echo base_url('admin/home/detail_berkas/'.$accept->id) ?>" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i> Berkas</a>
                </form>
            </td> -->


            <?php if($accept->non_fix == 0 && $accept->fix == 0){?> 
            <td align="center">
              <span class="label label-default">Belum Tes</span><br>
                <a  href="<?php echo base_url('admin/home/lulus_accept/'.$accept->id) ?>" class="btn btn-xs btn-success">Luluskan</a>
                <?php if($accept->jurusan_pilihan != $accept->jurusan_pilihan2){?>
                <a  href="<?php echo base_url('admin/home/lulus_pilihan/'.$accept->id) ?>" class="btn btn-xs btn-info">Lulus Ke Pilihan 2</a>
                <?php } ?>
                <a  href="<?php echo base_url('admin/home/gagal_accept/'.$accept->id) ?>" class="btn btn-xs btn-danger">Gagalkan</a>
            </td>
            <?php }elseif($accept->non_fix == 1 && $accept->fix == 0){ ?>
            <td align="center">
                <span class="label label-danger">Gagal</span><br>
                <a href="<?php echo base_url('admin/home/lulus_accept/'.$accept->id) ?>" class="btn btn-xs btn-success">Luluskan</a>
                <?php if($accept->jurusan_pilihan != $accept->jurusan_pilihan2){?>
                <a href="<?php echo base_url('admin/home/lulus_pilihan/'.$accept->id) ?>" class="btn btn-xs btn-info">Lulus Ke Pilihan 2</a>
                <?php } ?>
            </td>  
            <?php } ?>

            <td align="center"> <a target="_blank"  href="<?php echo base_url('admin/home/edit_tanpa_prodi/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> detail</a> 
              <?php if($this->session->userdata('id_level')=='1'){?>
              <?php if($accept->kode_agen == 'Mandiri') {?>
                <a href="<?php echo base_url('admin/home/delete_accept/'.$accept->id) ?>" class="btn btn-xs btn-warning" onclick="return confirm('Anda yakin ingin menghapus data ini!!!')"><i class="fa fa-trash-o"></i>delete</a>
                <?php if($accept->non_fix == '1' && $accept->fix == '0' || $accept->non_fix == '0' && $accept->fix == '0') { ?>
                <a href="<?php echo base_url('admin/home/balik_accept/'.$accept->id) ?>" class="btn btn-xs btn-danger"><i class="fa  fa-retweet"></i> Kembalikan</a>
                <?php } ?>
              <?php }} ?>
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
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel Terverifikasi</button>
            </form><br>

            <form action="<?php echo base_url('admin/home/no_urut') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <button type="submit" class="btn btn-warning"><i class="fa fa-sort-numeric-asc" ></i> Cetak Nomer Urut</button>
            </form>
            </center><br><hr>

            <?php $g     = $this->input->post('gelombang');
                  $p     = $this->input->post('prodi');
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
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <button type="submit" class="btn btn-success"><i class="fa fa-list" ></i> Daftar Hadir</button>
            </div>
            </form>

        <?php } ?>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
  <div class="rspv-tabel">
   <left><hr>
       <h3>Keterangan :</h3></left> 
        <table id="example1" class="table table-bordered table-striped">
           <tbody><tr>
               <td width="50"><a  class="btn btn-sm btn-info"> Generate</a> </td>
               <td width="10">:</td>
               <td>Untuk Memberikan Nomor Ujian Kepada Peserta yang Akan Mengikuti Tes</td> 
               </tr><br><br>
               <tr>
               <td width="50"><a  class="btn btn-sm btn-success"> Ganti</a></td>
               <td width="10">:</td>
               <td>Untuk Merubah / Mengganti Nomor Ujian Peserta yang Akan Mengikuti Tes</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Mencetak Kartu Ujian Peserta</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Mengexport Data Pendaftar</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-warning"><i class="fa fa-sort-numeric-asc" ></i>  Cetak Nomer Urut</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Mencetak Nomer Urut Ujian Tes</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-success"><i class="fa fa-list" ></i>  Daftar Hadir</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Mencetak Daftar Hadir Peserta Ujian </td>
               </tr>
           </tbody>
       </table>
       <b></b>
</div>
</div>
</div>
