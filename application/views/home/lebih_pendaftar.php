 <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="row">
          <div class="col-lg-4">
            <div class="section-title" data-aos="fade-right">
              <h2><br><br>Semua Pendaftar</h2>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="row">

              <?php foreach ($pendaftar_terbaru as $pendaftar_terbaru) { ?>
              <div class="col-lg-4">
                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                  <div class="pic">
                    <?php if ($pendaftar_terbaru->foto == '') { ?>
                    <img width="100%" src="<?php echo base_url('assets/default-user-image.png')?>" class="img-fluid">
                    <?php }else{ ?>
                    <img width="100%" src="<?php echo base_url('assets/upload/profil/thumbs/'.$pendaftar_terbaru->foto)?>" class="img-fluid">
                    <?php }?>
                    </div>
                  <div class="member-info">
                    <h4><?php echo strtoupper($pendaftar_terbaru->nama_lengkap)?></h4>
                    <p>
                        <?php echo $pendaftar_terbaru->nama_fakultas ?><br><?php echo $pendaftar_terbaru->nama_gelombang ?><br>
                      <?php
                      $kode1     = $pendaftar_terbaru->jurusan_pilihan;
                      $pilihan1  = $this->admin_model->pilihan1($kode1);
                      $kode2     = $pendaftar_terbaru->jurusan_pilihan2;
                      $pilihan2  = $this->admin_model->pilihan2($kode2);
                      ?>
                      <?php
                      if($pendaftar_terbaru->jurusan_pilihan !='0'){ ?>
                        <?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> 
                      <?php }else{ ?>
                        -
                      <?php }?>
                      <br>
                      <?php
                      if($pendaftar_terbaru->jurusan_pilihan2 !='0'){ ?>
                        <?php echo $pilihan2->jenjang ?> <?php echo $pilihan2->nama ?>  
                      <?php }else{ ?>
                        -
                      <?php }?>
                  </p>
                  </div>
                </div>
              </div>
              <?php } ?>

          <?php if(isset($paginasi)) { ?>
              <div class="paginasi col-sm-12 text-center">
              <?php echo $paginasi;?>
              <div class="clearfix"></div>
              </div>
          <?php }?>
          <div class="col-md-12" ><br><br></div>

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Team Section -->