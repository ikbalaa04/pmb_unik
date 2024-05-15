    <section class="portfolio-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center"><br>
          	<a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a>
            <h3 class="title-a"><br>
              Formulir Pendaftaran Mahasiswa Baru
            </h3>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <form action="<?php echo base_url('agen/register_maba')?>" method="post" >
      <div class="row">
        <div class="col-md-12">
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
        <div class="card text-black"> 
        <div class="card-header bg-default">
        <div class="table-container">
          <div class="table-responsive" >
            <div class="row">
            <div class="col-md-6">
              <?php if($this->input->post('fakultas')==''){?>
              <label><b>Fakultas  </b></label>
              <select required="" class="form-control" name="fakultas" id="fakultas"  onchange="ubah_fak()">
                      <option value="">-Pilih-</option>
                        <?php foreach ($fakultas as $fakultas) { ?>
                            <option  value="<?php echo $fakultas->id ?>" <?php if($this->input->post('fakultas')== $fakultas->id){echo "selected";}?>><?php echo $fakultas->nama_fakultas ?></option>
                        <?php } ?>
                    </select>
              <?php }else{?>
              <label><b>Fakultas  </b></label>

                  <?php 
                  $id = $this->input->post('fakultas');
                  $detail_fakultas = $this->admin_model->detail_fakultas($id); 
                  ?>
                  <input type="hidden" class="form-control" required name="fakultas" id="fakultas" value="<?php echo $detail_fakultas->id ?>"/>
                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_fakultas->nama_fakultas ?>"/>
                
              <?php }?>

              <?php if($this->input->post('gelombang')==''){?>
              <label><b>Gelombang </b></label>
                <select required="" class="form-control" name="gelombang" id="gelombang">
                </select>
              <?php }else{?>
              <label><b>Gelombang </b></label>
                <?php 
                  $id = $this->input->post('gelombang');
                  $detail_gelombang = $this->admin_model->detail_gelombang($id); 
                  ?>
                  <input type="hidden" class="form-control" required name="gelombang" id="gelombang" value="<?php echo $detail_gelombang->id ?>"/>
                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_gelombang->nama ?> - <?php echo $detail_gelombang->tahun ?>"/>
              <?php }?>

              <?php if($this->input->post('prodi')==''){?>
               <label><b>Piliahan Pertama  </b></label>
                <select required=""  class="form-control" name="prodi" id="prodi">
                </select>
              <?php }else{?>
              <label><b>Piliahan Pertama  </b></label>
                  <?php 
                  $kode = $this->input->post('prodi');
                  $detail_prodi = $this->admin_model->detail_prodi_kode($kode); 
                  ?>
                  <input type="hidden" class="form-control" required name="prodi" id="prodi" value="<?php echo $detail_prodi->kode ?>"/>
                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_prodi->jenjang ?> <?php echo $detail_prodi->nama ?>"/>
              <?php }?>


              <?php if($this->input->post('fakultas2')==''){?>
              <label><b>Fakultas  </b></label>
              <select required="" class="form-control" name="fakultas2" id="fakultas2"  onchange="ubah_fak()">
                      <option value="">-Pilih-</option>
                        <?php foreach ($fakultas2 as $fakultas) { ?>
                            <option  value="<?php echo $fakultas->id ?>" <?php if($this->input->post('fakultas2')== $fakultas->id){echo "selected";}?>><?php echo $fakultas->nama_fakultas ?></option>
                        <?php } ?>
                    </select>
              <?php }else{?>
              <label><b>Fakultas  </b></label>

                  <?php 
                  $id = $this->input->post('fakultas2');
                  $detail_fakultas2 = $this->admin_model->detail_fakultas($id); 
                  ?>
                  <input type="hidden" class="form-control" required name="fakultas2" id="fakultas" value="<?php echo $detail_fakultas2->id ?>"/>
                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_fakultas2->nama_fakultas ?>"/>
                
              <?php }?>

              <?php if($this->input->post('gelombang_2')==''){?>
              <label><b>Gelombang </b></label>
                <select required="" class="form-control" name="gelombang_2" id="gelombang_2">
                </select>
              <?php }else{?>
              <label><b>Gelombang </b></label>
                <?php 
                  $id = $this->input->post('gelombang_2');
                  $detail_gelombang = $this->admin_model->detail_gelombang($id); 
                  ?>
                  <input type="hidden" class="form-control" required name="gelombang_2" id="gelombang_2" value="<?php echo $detail_gelombang->id ?>"/>
                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_gelombang->nama ?> - <?php echo $detail_gelombang->tahun ?>"/>
              <?php }?>

              <?php if($this->input->post('prodi2')==''){?>
              <label><b>Piliahan Kedua   </b></label>
              <select required=""  class="form-control" name="prodi2" id="prodi2">
                </select>
              <?php }else{?>
              <label><b>Piliahan Kedua   </b></label>
                  <?php 
                  $kode = $this->input->post('prodi2');
                  $detail_prodi2 = $this->admin_model->detail_prodi_kode($kode); 
                  ?>
                  <input type="hidden" class="form-control" required name="prodi2" id="prodi2" value="<?php echo $detail_prodi2->kode ?>"/>
                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_prodi2->jenjang ?> <?php echo $detail_prodi2->nama ?>"/>
              
              <?php }?>

              <label><b>Jenis Pendafataran  </b></label>
                      <select class="form-control" name="jenis" id="jenis" required="" onchange="ubah_jenis()">
                      <option value="">-Pilih-</option>
                      <option value="MB" <?php if($this->input->post('jenis')=='MB'){echo "selected";}?>>Mahasiswa Baru</option>
                      <option value="PD" <?php if($this->input->post('jenis')=='PD'){echo "selected";}?>>Mahasiswa Pindahan</option>
                    </select>

              <label><b>Jalur Pendafataran  </b></label>
              <select class="form-control" name="program" required="">
                <?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?> 
                <option value="">-Pilih-</option>
                <?php foreach($list_program_aktif as $list_program_aktif){ ?>
                  <option value="<?php echo $list_program_aktif->id ?>" <?php if($this->input->post('program')== $list_program_aktif->id ){echo "selected";}?>><?php echo $list_program_aktif->nama ?></option>
                <?php }?>
              </select>
             
              </div>

              <div class="col-md-6">


              <label><b>Asal Sekolah</b></label>
              <input type="text" style="text-transform: uppercase;" class="form-control" required name="sekolah_nama" placeholder="Sekolah / Kampus asal anda" value="<?php echo set_value('sekolah_nama') ?>"/>

              <label><b>Jurusan</b></label>
              <input type="text" class="form-control" required name="sekolah_jurusan" placeholder="Masukan jurusan sekolah" value="<?php echo set_value('sekolah_jurusan') ?>"/>

              <label><b>NISN </b></label>
              <input type="number" class="form-control" name="nisn" placeholder="Masukan NISN, Kosongkan jika mhs pindahan" value="<?php echo set_value('nisn') ?>"/>

              
              <label><b>Nama Lengkap </b></label>
              <input style="text-transform: capitalize;" type="text" class="form-control" required name="nama_lengkap" placeholder="Masukan nama lengkap" value="<?php echo set_value('nama_lengkap') ?>"/>

              <label><b>
              Nama Pengguna</b></label>
              <input type="text" class="form-control" required name="username" placeholder="Buat nama pengguna / username" value="<?php echo set_value('username') ?>"/>

              <label><b>Kata Sandi</b></label>
               <input type="password" class="form-control" required name="password" placeholder="Buat kata sandi" value="<?php echo set_value('password') ?>"/>

              <label><b>Email </b></label>  
                <input type="email" class="form-control" required name="email" placeholder="Masukan email aktif" value="<?php echo set_value('email') ?>"/>

              <label><b>Nomor WA </b></label>   
                <input type="number" class="form-control" required name="hp" placeholder="Contoh : 628213597XX" value="<?php echo set_value('hp') ?>"/>

              
              </div>
              
        </div>
        	<div class="col-md-12">
            <br><br><b style="text-align: right;"><button type="submit" class="btn btn-rouded btn-primary"><i class="fa fa-save"></i> Save Data</button></b><br><br>
        	</div>
          </div>
        </div>
        </div>
        </div>
        
      </div>
    </form>
    </div>
  </section>



 