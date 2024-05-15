<a href="<?php echo base_url('admin/home/tambah_mahasiswa') ?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah Mahasiswa</a> <br>
<?php
              echo validation_errors('<div class="alert alert-warning">','</div>');

              if($this->session->flashdata('warning')){
                echo '<div class="alert alert-warning">';
                echo $this->session->flashdata('warning');
                echo '</div>';
              } 
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success">';
                echo $this->session->flashdata('success');
                echo '</div>';
              }  

            ?>
<br>
<div class="row" align="text-center"> 
    <form method="post" action="<?php echo base_url('admin/home/verifikasi_filter')?>">    

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
                <a class="btn btn-success btn-md" style="margin-top: 5px; border-radius: 5px" href="<?php echo base_url('admin/home/verifikasi')?>" > Tanpa Filter</a>
    </form>
</div><br>

<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<form method="post" action="<?php echo base_url('admin/home/delete_pilihan') ?>" id="form-delete">
<button type="button" id="btn-delete" onclick="return confirm('Anda yakin ingin menghapus data terpilih ini!!!')" class="btn btn-xs btn-danger">Hapus Data Terpilih</button><br><br>
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" id="check-all"></th>
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
            <th>Asal</th>
            <th>Jurusan</th>
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
            
            <td><input type="checkbox" class="check-item" name="username[]" value="<?php echo $verifikasi->username ?>" /></td>
            <td width="20"><?php echo $q ?></td>
            <td><?php echo $verifikasi->sumber ?> <?php echo $verifikasi->keterangan_sumber ?></td>
            <td><?php echo date("d M Y H:i", strtotime($verifikasi->tanggal_daftar )) ?></td>
            <td align="center"><a class="btn btn-xs btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $verifikasi->hp?>&text=Halo%20<?php echo $verifikasi->nama_lengkap ?>,%20Kami%20dari%20panitia%20PMB%20UNIK Cipasung.%20Terimakasih%20Telah%20melalukan%20pendaftaran.%20Mohon%20segera%20melakukan%20registrasi%20dan%20konfirmasi%20Pemabayaran%20Terimakasih%20:)"> <i class="fa fa-whatsapp"></i> <?php echo $verifikasi->hp?></a></td>
            <td width="20"><?php if($verifikasi->jenis == ''){echo "Belum diisi";}else{echo $verifikasi->jenis;} ?></td>
            <td width="20"><?php if($verifikasi->program == ''){echo "Belum diisi";}else{echo $verifikasi->nama_program;} ?></td>
            <td><?php echo $verifikasi->singkatan ?></td>
            <td><?php echo $verifikasi->nama_gelombang ?> - <?php echo $verifikasi->tahun_gelombang ?></td>
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
            
            <td><?php echo $verifikasi->sekolah_nama; ?></td>
            <td><?php echo $verifikasi->sekolah_jurusan; ?></td>
    
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


            <td align="center"><center>
                <?php $program = $verifikasi->program;
                $detail_program  = $this->admin_model->kartu_program($program);  ?>
                <?php if($detail_program->tipe_program !='Berbayar'){ ?>
                <span class="label label-default">Tidak Perlu</span>
                <?php }else{ ?>
                <?php if($verifikasi->bukti_bayar == ''){ ?>
                <span class="label label-danger"> Belum Ada</span>
                <?php }else{ ?>
                <?php include('detail.php') ?>
                <?php } ?>
                <?php } ?>
                </center>
            </td>


            <td align="center"><center><span class="label label-default">Belum Diverifikasi</span><br>
            <?php if($verifikasi->kode_agen == 'Mandiri') {?>
            <a href="<?php echo base_url('admin/home/tandai_verifikasi/'.$verifikasi->id) ?>" class="btn btn-xs btn-success">Verifikasi Data</a>
            <?php }else{ ?>
            <a href="<?php echo base_url('admin/home/tandai_verifikasi/'.$verifikasi->id) ?>" class="btn btn-xs btn-success" onclick="return confirm('Anda yakin ingin verifikasi data ini !!!')">Verifikasi Data</a>
            <?php } ?>
            </center>
            </td>

             <td align="center"><a target="_blank"  href="<?php echo base_url('admin/home/edit_verifikasi/'.$verifikasi->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a>
               <?php if($this->session->userdata('id_level')=='1'){ ?>
               <a href="<?php echo base_url('admin/home/delete_verifikasi/'.$verifikasi->id) ?>" class="btn btn-xs btn-warning" onclick="return confirm('Anda yakin ingin menghapus data ini!!!')"><i class="fa fa-trash-o"></i> delete</a> 
               <?php } ?>
           </td>
        	

    </tr>
     <?php $q++; } ?>
    </tbody>
	</table>
    </div>
    <br><br><button type="button" id="btn-delete" onclick="return confirm('Anda yakin ingin menghapus data terpilih ini!!!')" class="btn btn-xs btn-danger">Hapus Data Terpilih</button>
    </form>

  <?php if($this->input->post('gelombang')!='' && $this->input->post('prodi')!='') { ?> 
            <center>
            <form action="<?php echo base_url('admin/home/excel_verifikasi/') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel Sudah Bayar Belum Terverifikasi </button>
            </form><br>

           </center>

        <?php } ?>

</div>
</div>
</div>
</div>