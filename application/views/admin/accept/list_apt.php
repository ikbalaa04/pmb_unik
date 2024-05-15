<div class="row" align="text-center"> 
    <form method="post" action="<?php echo base_url('admin/home/accept_filter_apt')?>">

        <div class="col-lg-3">
                <label>Gelombang</label><br>
                <select name="gelombang" class="form-control">
                <option selected disabled>-Pilih-</option>
                    <?php foreach($pilih_gelombang as $pilih_gelombang) {?>
                <option value="<?php echo $pilih_gelombang->id?>" <?php if($this->input->post('gelombang')==$pilih_gelombang->id){echo "selected";} ?>><?php echo $pilih_gelombang->singkatan?> - <?php echo $pilih_gelombang->nama?> - <?php echo $pilih_gelombang->tahun?> - <?php echo $pilih_gelombang->keterangan?></option>
                    <?php } ?>
                </select>
        </div>

                <br>
                <input type="submit" value="Filter" class="btn btn-info btn-md">
    </form>
</div><br>

<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th width="120">No. Ujian</th>
            <th width="20">Jenis</th>
            <th>Gelombang</th>
            <th>Prodi</th>
            <th>Nama Lengkap</th>
            <th>Hp</th>
            <th>Asal Universitas</th>
            <th>IPK</th>
            <th width="20">Berkas</th>
            <th width="30">No Ujian</th>
            <th width="20">Kartu</th>
            <!-- <th>File</th> -->
            <th width="20">Approve</th>
            <th>Status</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $q=1; $e=1; foreach ($accept as $accept) { ?>
        <tr> 
            <td width="20"><?php echo $q ?></td>
            <td width="20"><?php echo $accept->noujian ?></td>
            <td width="20"><?php echo $accept->jenis ?></td>
            <td><?php echo $accept->nama_gelombang ?></td>
            <?php
            $Pecah = explode(",", $accept->jurusan_pilihan );
            for ( $i = 0; $i < count( $Pecah ); $i++ ) {
                $Pecah[$i] . "<br />";
                }
            $kode1     = $Pecah[0];
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            ?>

            <td><?php if($Pecah[0] == 0){echo "-";}else{ echo $pilihan1->nama;} ?> </td>
            <td><?php echo $accept->nama_lengkap ?></td>
            <!-- <td><?php echo $accept->email?></td>
            <td><?php echo $accept->password?></td> -->
            <td width="20"><?php echo $accept->hp?></td>
            <td><?php echo $accept->kampus_asal?></td>
            <td><?php echo $accept->ipk?></td>

            <?php if($accept->berkas != ''){ ?> 
            <td>
            <center><a target="_blank" href="<?php echo base_url('assets/upload/berkas/'.$accept->berkas)?>" class="btn btn-sm btn-primary"><i class="fa fa-folder-open"></i> </a></center>
            <?php }else{ ?>
            <td><center><a href="#" class="btn btn-xs btn-danger">Belum Ada</a></center></td>
            <?php } ?>

            <td align="center"><?php if($accept->noujian == '') { ?>        
                <form method="post" target="_blank" action="<?php echo base_url('admin/home/ujian_apt/'.$accept->id)?>">
                <input type="hidden" name="noujian" value="<?php echo $accept->KG ?>-<?php echo $Pecah[0]; ?>-<?php echo $accept->jenis ?>-000<?php echo $e++?>">
                <input type="submit" value="Generate" class="btn btn-xs btn-info">
                </form>
            <?php  }else{?>
                <form method="post" target="_blank" action="<?php echo base_url('admin/home/ujian_apt/'.$accept->id)?>">
                <input type="hidden" name="noujian" value="<?php echo $accept->KG ?>-<?php echo $Pecah[0]; ?>-<?php echo $accept->jenis ?>-000<?php echo $e++?>">
                <input type="submit" value="Ganti" class="btn btn-xs btn-success">
                </form>
            <?php } ?></td>

            <td>
            <a target="_blank" href="<?php echo base_url('admin/home/cetak_kartu_admin/'.$accept->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Cetak</a>
            </td> 
            <!-- <td align="center">
                <a target="_blank" href="<?php echo base_url('admin/home/detail_berkas/'.$accept->id) ?>" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i> Berkas</a>
                </form>
            </td> -->

            <td align="center">
                <a target="_blank" href="<?php echo base_url('admin/home/balik_accept_apt/'.$accept->id) ?>" class="btn btn-xs btn-danger">Tolak</a>
            </td> 

            <?php if($accept->fix == 0 ){?> 
            <td align="center">
                <a target="_blank" href="<?php echo base_url('admin/home/lulus_accept_apt/'.$accept->id) ?>" class="btn btn-xs btn-info">Luluskan</a>
            </td>
            <?php }else{ ?>
            <td align="center">
                <a target="_blank" href="<?php echo base_url('admin/home/gagal_accept_apt/'.$accept->id) ?>" class="btn btn-xs btn-danger">Gagalkan</a>
            </td>  
            <?php } ?>

                  	

    </tr>
     <?php $q++; } ?>
    </tbody>
	</table>

        <?php if(!empty($this->input->post('gelombang'))) { ?> 
            <center>
            <form action="<?php echo base_url('admin/home/excel/') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel</button>
            </form><br>

            <form action="<?php echo base_url('admin/home/no_urut/') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <button type="submit" class="btn btn-warning"><i class="fa fa-sort-numeric-asc" ></i> Cetak Nomer Urut</button>
            </form>
            </center><br><hr>

            <?php $g     = $this->input->post('gelombang');
                  $awal  = $this->admin_model->sesi_dari_apt($g);
                  $akhir = $this->admin_model->sesi_dari_apt($g);  
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
                <button type="submit" class="btn btn-success"><i class="fa fa-list" ></i> Daftar Hadir</button>
            </div>
            </form>

        <?php } ?>
</div>
</div>
</div>
</div>

<div class="row">
<!-- <div class="col-lg-12">   <left><hr>
       <h3>Note : Untuk memberikan nomer ujian coba filter terlebih dahulu data gelombang dan prodinya supaya nomer ujian berurutan</h3></left> </div> -->
<div class="col-lg-6">
   <left><hr>
       <h3>Keterangan :</h3></left> 
       <table class="table table-bordered table-striped">
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
               <td width="50"><a href="#" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i> Berkas</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Melihat Berkas yang Sudah dilengkapi Pendaftar</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-danger">Tolak</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Mengembalikan Status Pembayaran Menjadi Belum di Verifikasi</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-info">Luluskan</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Merubah Status Peserta Menjadi Lulus Tes</td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-sm btn-danger">Gagalkan</a></td>
               <td width="10">:</td>
               <td>Tombol Untuk Merubah Status Peserta Menjadi Gagal Tes</td>
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
               <tr>
               <td width="50"><a href="#" class="btn btn-success"><i class="fa fa-folder-open"></i> </a></td>
               <td width="10">:</td>
               <td>Tombol untuk download / membuka berkas </td>
               </tr>
               <tr>
               <td width="50"><a href="#" class="btn btn-danger">Belum Ada</a></td>
               <td width="10">:</td>
               <td>Berkas Belum ada</td>
               </tr>
           </tbody>
       </table>
       <b></b>
</div>
</div>
