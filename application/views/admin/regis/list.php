<div class="row" align="text-center"> 
    <form method="post" action="<?php echo base_url('admin/home/registrasi_ulang_filter')?>">

        <?php if($this->session->userdata('id_level')=='1'){?>
        <div class="col-lg-4">
            <?php $list_prodi_aktif = $this->admin_model->list_prodi_aktif();?>
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

        <div class="col-lg-3">
            <label>Registrasi</label><br>
            <select required="" class="form-control" name="registrasi_ulang">
                <option value="">-Status-</option>
                <option value="1" <?php if($this->input->post('registrasi_ulang')=="1"){echo "selected";} ?>>Sudah Registrasi</option>
                <option value="0" <?php if($this->input->post('registrasi_ulang')=="0"){echo "selected";} ?>>Belum Registasi</option>
            </select>
        </div>



                <br>
                <input style="margin-top: 5px; border-radius: 5px" type="submit" value="Filter" class="btn btn-info btn-md">
                <a class="btn btn-success btn-md" style="margin-top: 5px; border-radius: 5px" href="<?php echo base_url('admin/home/registrasi_ulang')?>" > Tanpa Filter</a>
    </form>
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
            <th width="20">No</th>
            <th>Registrasi Ulang</th>
            <th>Sumber</th>
            <th width="120">No. Ujian</th>
            <th width="20">Jenis</th>
            <th width="20">Program</th>
            <th width="20">Fakultas</th>
            <th>Gelombang</th>
            <th>Pilihan 1</th>
            <th>Pilihan 2</th>
            <th>Nama Lengkap</th>
            <th>Hp</th>
            <th>Asal</th>
            <th>Jurusan</th>
            <!-- <th width="20">Kartu</th> -->
            <th>Berkas</th>
            <th width="20">Aksi</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $q=1; $e=1; foreach ($diterima as $diterima) { ?>
        <tr>
            <td width="20"><?php echo $q ?></td>

            <?php if($diterima->verifikasi_regis == '1') { ?>
            <td align="center">
                <center><span class="label label-primary">Sudah Registrasi</span><br>
                <?php if ($diterima->bukti_regis != '') { ?>
                <?php include('detail.php') ?>
                <?php } ?>
                <span class="label label-success">Sudah Diverifikasi</span><br>
                <a href="<?php echo base_url('admin/home/balik_regis/'.$diterima->id) ?>" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Kembalikan</a></center>
            </td>  
            <?php }else{ ?>
            <td align="center">
                <?php if ($diterima->registrasi_ulang == '1') { ?>
                  <center><span class="label label-primary">Sudah Registrasi</span><br>
                  <?php include('detail.php') ?>
                  <span class="label label-warning">Belum Diverifikasi</span><br></center>
                  <a href="<?php echo base_url('admin/home/sudah_regis/'.$diterima->id) ?>" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Klik Verifikasi Registrasi</a>
                <?php }else{ ?>
                  <center><span class="label label-danger">Belum Registrasi</span></center>
                <a href="<?php echo base_url('admin/home/sudah_regis/'.$diterima->id) ?>" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Klik Sudah Registrasi</a>
                <?php } ?> 
            </td>  
            <?php } ?>

            <td><?php echo $diterima->sumber ?> <?php echo $diterima->keterangan_sumber ?></td>
            <td width="20"><?php if($diterima->noujian == ''){echo "Belum Ada";}else{echo $diterima->noujian;} ?></td>
            <td width="20"><?php if($diterima->jenis == ''){echo "Belum diisi";}else{echo $diterima->jenis;} ?></td>
            <td width="20"><?php if($diterima->nama_program == ''){echo "Belum diisi";}else{echo $diterima->nama_program;} ?></td>
            <td><?php echo $diterima->singkatan ?></td>
            <td><?php echo $diterima->nama_gelombang ?> - <?php echo $diterima->tahun_gelombang ?></td>
            <?php
            $kode1     = $diterima->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $diterima->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>
            <?php
            if($diterima->jurusan_pilihan !='0'){ ?>
              <td><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> </td>
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <?php
            if($diterima->jurusan_pilihan2 !='0'){ ?>
              <td><?php echo $pilihan2->jenjang ?> <?php echo $pilihan2->nama ?> </td> 
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <td><?php echo $diterima->nama_lengkap ?></td>
            <td width="20"><?php echo $diterima->hp?></td>
            
            <td><?php if($diterima->sekolah_nama == ''){echo "Belum diisi";}else{echo $diterima->sekolah_nama;} ?></td>
            <td><?php echo $diterima->sekolah_jurusan; ?></td>


            <!-- <td>
            <a target="_blank" href="<?php echo base_url('admin/home/cetak_kartu_admin/'.$diterima->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Cetak</a>
            </td>  -->
             
            <td>
            <center>
                <?php 
                $id_pendaftar = $diterima->id;
                $berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);
                 if($berkas_terupload){ ?>
                <?php if($diterima->verifikasi_berkas == 0) { ?>
                    <span class="label label-default">Belum Dicek</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$diterima->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }elseif($diterima->verifikasi_berkas == 1){ ?>
                    <span class="label label-danger">Berkas Ditolak</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$diterima->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }else{ ?>
                    <span class="label label-success">Sudah Diverifikasi</span>
                    <a href="<?php echo base_url('admin/home/buka_berkas/'.$diterima->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-folder-open"></i> Lihat Berkas</a>
                <?php }}else{ ?>
                    <span class="label label-danger">Belum Ada</span>
                <?php } ?>
            </center></td>

            

             <td align="center"><a target="_blank"  href="<?php echo base_url('admin/home/edit_tanpa_prodi/'.$diterima->id) ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a></td>  
        	

    </tr>
     <?php $q++; } ?>
    </tbody>
	</table>
    </div>

        <?php if($this->input->post('gelombang')!='' ) { ?> 
            <center><br><br>    
            <?php if($this->input->post('registrasi_ulang')=='1' ) { ?> 
            <form action="<?php echo base_url('admin/home/excel_regis/') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <input type="hidden" name="registrasi_ulang" value="<?php echo $this->input->post('registrasi_ulang')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel Sudah Registrasi Ulang</button>
            </form><br>
            <?php }else{ ?>
            <form action="<?php echo base_url('admin/home/excel_regis_belum/') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <input type="hidden" name="registrasi_ulang" value="<?php echo $this->input->post('registrasi_ulang')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel Belum Registrasi Ulang</button>
            </form><br>

            <?php  } ?>

           </center>

        <?php } ?>

</div>
</div>
</div>
</div>