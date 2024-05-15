<!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">
        <br><br>
        <div class="row">
        <?php foreach ($informasi as $informasi) { ?>
          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content" style="color: black">
                <?php if($informasi->foto == '') { ?>
                <img src="<?php echo base_url('assets/upload/berita/default.png')?>" class="img-fluid">
                <?php }else{?>
                <img src="<?php echo base_url('assets/upload/berita/thumbs/'.$informasi->foto)?>" class="img-fluid">
              <?php }?>
              <br>

              <div class="post-date">
                <?php $tanggal = date('D',strtotime($informasi->tanggal));
                $hariList = array('Sun' => 'Minggu',
                                  'Mon' => 'Senin',
                                  'Tue' => 'Selasa',
                                  'Wed' => 'Rabu',
                                  'Thu' => 'Kamis',
                                  'Fri' => 'Jumat',
                                  'Sat' => 'Sabtu');
                 ?>
                <br><i class="bi bi-calendar"></i> <?php echo $hariList[$tanggal];?>, <?php echo date('d M Y',strtotime($informasi->tanggal))?>
              </div>
              
              <div class="post-author">
                  <i class="bi bi-person-circle"></i> <?php echo $informasi->username?>
              </div>

              <h3 style="font-size: 20px"><br><?php echo $informasi->judul?></h3>
              <p>
                <?php echo character_limiter($informasi->isi_berita,110)?>
              </p>
              <div class="text-center">
                <a href="<?php echo base_url('home/berita/'.$informasi->judul_seo)?>" class="btn btn-rouded btn-success">>Baca Detail <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <?php } ?>

          <div class="col-md-12" ><br><br></div>
                    <?php if(isset($paginasi)) { ?>
                        <div class="paginasi col-sm-12 text-center">
                        <?php echo $paginasi;?>
                        <div class="clearfix"></div>
                        </div>
                    <?php }?>

        </div>

      </div>
    </section><!-- End Why Us Section -->

