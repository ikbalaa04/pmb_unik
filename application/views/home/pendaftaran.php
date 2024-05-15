      <section class="section" id="pricing">
        <!-- Content -->
        <div class="container">
            <div class="row justify-content">
                <div class="col-lg-12 col-sm-6 col-md-6">
                       <h3><center><br><br>FORMULIR PENDAFTARAN</center><br></h3>
                      <form action="<?php echo base_url('home/pendaftaran')?>" method="post" >
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

                          <div class="table-responsive" >
                            <div class="row">
                            <div class="col-md-3"></div>

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
                               <label><b>Pilihan Pertama  </b></label>
                                <select required=""  class="form-control" name="prodi" id="prodi">
                                </select>
                              <?php }else{?>
                              <label><b>Pilihan Pertama  </b></label>
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
                              <label><b>Pilihan Kedua   </b></label>
                              <select required=""  class="form-control" name="prodi2" id="prodi2">
                                </select>
                              <?php }else{?>
                              <label><b>Pilihan Kedua   </b></label>
                                  <?php 
                                  $kode = $this->input->post('prodi2');
                                  $detail_prodi2 = $this->admin_model->detail_prodi_kode($kode); 
                                  ?>
                                  <input type="hidden" class="form-control" required name="prodi2" id="prodi2" value="<?php echo $detail_prodi2->kode ?>"/>
                                  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_prodi2->jenjang ?> <?php echo $detail_prodi2->nama ?>"/>
                              
                              <?php }?>

                              <label><b>Jalur Pendaftaran </b></label>
                              <select class="form-control" name="program" required="">
                                <?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?> 
                                <option value="">-Pilih-</option>
                                <?php foreach($list_program_aktif as $list_program_aktif){ ?>
                                  <option value="<?php echo $list_program_aktif->id ?>" <?php if($this->input->post('program')== $list_program_aktif->id ){echo "selected";}?>><?php echo $list_program_aktif->nama ?></option>
                                <?php }?>
                              </select>


                              <label><b>Jenis Pendaftaran </b></label>
                              <select name="jenis" class="form-control" required="">
                                <?php $list_jenis     = $this->admin_model->list_jenis(); ?>
                                <option value="">-Pilih-</option>
                                    <?php foreach($list_jenis as $list_jenis) {?>
                                    <option value="<?php echo $list_jenis->kode?>" <?php if($this->input->post('jenis')==$list_jenis->kode){echo "selected";} ?>><?php echo $list_jenis->nama?></option>
                                    <?php } ?>
                                </select>

                              <label><b>Asal Sekolah</b></label>
                              <input style="text-transform: uppercase;" type="text" class="form-control" required name="sekolah_nama" placeholder="Sekolah / Kampus asal anda" value="<?php echo set_value('sekolah_nama') ?>"/>

                              <label><b>Jurusan</b></label>
                              <input type="text" class="form-control" required name="sekolah_jurusan" placeholder="Masukan jurusan sekolah" value="<?php echo set_value('sekolah_jurusan') ?>"/>

                              <label><b>Nama Lengkap</b></label>
                              <input style="text-transform: capitalize;" type="text" class="form-control" required name="nama_lengkap" placeholder="Masukan nama lengkap" value="<?php echo set_value('nama_lengkap') ?>"/>

                              <label><b>Username</b></label>
                              <input type="text" class="form-control" required name="username" placeholder="Buat nama pengguna" value="<?php echo set_value('username') ?>"/>

                              <label><b>Kata Sandi </b></label>
                               <input type="password" class="form-control" required name="password" placeholder="Buat kata sandi" value="<?php echo set_value('password') ?>"/>

                              <label><b>Email  </b></label>  
                                <input type="email" class="form-control" required name="email" placeholder="Daftarkan email aktif" value="<?php echo set_value('email') ?>"/>

                              <label><b>Nomor WA </b></label>   
                              <input type="number" class="form-control" required name="hp" placeholder="Contoh : 628213597XXX" value="<?php echo set_value('hp') ?>"/>

                              <label><b>Sumber Referensi </b></label>   
                                <select name="sumber" class="form-control" required="">
                                  <option value="">-Pilih Sumber Referensi-</option>
                                  <?php foreach($sumber as $sumber) { ?>
                                  <option value="<?php echo $sumber->nama ?>" <?php if($this->input->post('sumber')==$sumber->nama){echo "selected";}?>><?php echo $sumber->nama ?></option>
                                  <?php } ?>
                                </select>

                              </div>
                              <div class="col-md-12"><br><br></div>
                          </div>
                              
                        </div>
                          <div class="col-md-12">
                            <center><button type="submit" class="btn btn-rounded btn-success"><b>Daftar</b></button></center>
                          </div>
                    </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
                <?php $detail_institusi      = $this->admin_model->detail_institusi(); ?>
             <div class="container">
            <div class="row justify-content">
                <div class="col-lg-12 col-sm-6 col-md-6">
                  <h3><br><br><hr>Alur Pendaftaran</h3>
                  <?php echo $detail_institusi->alur_pendaftaran ?>
                </div>
            </div>
          </div>
        </div>
    </section>

    

 