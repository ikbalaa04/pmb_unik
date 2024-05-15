<div class="row" align="text-center"> 
    <form method="post" action="<?php echo base_url('admin/home/karantina_filter')?>">

        <?php if($this->session->userdata('id_level')=='1'){?>
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
                <a class="btn btn-success btn-md" style="margin-top: 5px; border-radius: 5px" href="<?php echo base_url('admin/home/karantina')?>" > Tanpa Filter</a>
    </form>
</div><br>

<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<form method="post" action="<?php echo base_url('admin/home/delete_pilihan_karantina') ?>" id="form-delete">
<button type="submit" id="btn-delete" onclick="return confirm('Anda yakin ingin menghapus data terpilih ini!!!')" class="btn btn-xs btn-danger">Hapus Data Terpilih</button><br><br>
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><input type="checkbox" id="check-all"></th>
            <th width="10">No</th>
            <th>Sumber</th>
            <th>Daftar</th>
            <th width="20">WA</th>
            <th>Hp</th>
            <th width="20">Fakultas</th>
            <th>Gelombang</th>
            <th width="20">Jenis</th>
            <th width="20">Program</th>
            <th>Pilihan 1</th>
            <th>Pilihan 2</th>
            <th>Nama</th>
            <th>Asal</th>
            <th>Jurusan</th>
            <th width="30">karantina Data</th>
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
            
            <td><input type="checkbox" class="check-item" name="username[]" value="<?php echo $karantina->username ?>" /></td>
            <td width="20"><?php echo $j ?></td>
            <td><?php echo $karantina->sumber ?> <?php echo $karantina->keterangan_sumber ?></td>
            <td><?php echo date("d M Y H:i", strtotime($karantina->tanggal_daftar )) ?></td>
            <td align="center"><a class="btn btn-xs btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $karantina->hp?>&text=Halo%20<?php echo $karantina->nama_lengkap ?>,%20Kami%20dari%20panitia%20PMB...."> <i class="fa fa-whatsapp"></i> <?php echo $karantina->hp?></a></td>
            <td width="20"><?php echo $karantina->hp?></td>
            <td><?php echo $karantina->singkatan ?></td>
            <td><?php echo $karantina->nama_gelombang ?> - <?php echo $karantina->tahun_gelombang ?></td>

            <td width="20"><?php if($karantina->jenis == ''){echo "Belum diisi";}else{echo $karantina->jenis;} ?></td>
            <td width="20"><?php if($karantina->program == ''){echo "Belum diisi";}else{echo $karantina->nama_program;} ?></td>

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
            <td><?php echo $karantina->sekolah_jurusan; ?></td>
            <?php }else{ ?>
            <td ><?php if($karantina->kampus_asal == ''){echo "Belum diisi";}else{echo $karantina->kampus_asal;} ?></td>
            <td ><?php if($karantina->ipk == ''){echo "Belum diisi";}else{echo $karantina->ipk;} ?></td>
            <?php } ?>

   
            

            <td ><center>
                <span class="label label-warning">Menunggu Verifikasi</span><br>
                <a onclick="return confirm('Anda yakin ingin verifikasi data ini !!!')" href="<?php echo base_url('admin/home/tandai_karantina/'.$karantina->id) ?>" class="btn btn-xs btn-info"><small>Verifikasi Data</small></a> <br>
            </center></td>

            <td><a target="_blank"  href="<?php echo base_url('admin/home/edit_verifikasi/'.$karantina->id) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a>

                <a href="<?php echo base_url('admin/home/delete_karantina/'.$karantina->id) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus data ini!!!')"><i class="fa fa-trash-o"></i> Hapus</a></td>
    </tr>
     <?php $j++; } ?>
    </tbody>
    </table>
    </div><br><br>
    <button type="submit" id="btn-delete" onclick="return confirm('Anda yakin ingin menghapus data terpilih ini!!!')" class="btn btn-xs btn-danger">Hapus Data Terpilih</button>
    </form>

     <?php if($this->input->post('prodi')!='' && $this->input->post('gelombang')!='') { ?> 
            <center>
            <form action="<?php echo base_url('admin/home/excel_karantina/') ?>" target="_blank" method="post">
                <input type="hidden" name="gelombang" value="<?php echo $this->input->post('gelombang')?>">
                <input type="hidden" name="prodi" value="<?php echo $this->input->post('prodi')?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i> Export Excel Belum Bayar</button>
            </form><br>
            </center><br><hr>
      <?php } ?>

</div>
</div>
</div>
</div>