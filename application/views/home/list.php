<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
      <h1><?php echo $detail_institusi->nama ?></h1>
      <h2><?php echo $detail_institusi->deskripsi_beranda ?></h2>
      <a href="<?php echo base_url('home/pendaftaran')?>" class="btn-get-started scrollto">Daftar</a>
      <a href="<?php echo base_url('login')?>" class="btn-get-started scrollto">Login</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
        <div class="col-lg-12">
            <div class="section-title" data-aos="fade-right">
              <h2><br><br>Informasi</h2>
            </div>
          </div>

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
                <a href="<?php echo base_url('home/berita/'.$informasi->judul_seo)?>" class="btn btn-rouded btn-success">Baca Detail <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="text-center" data-aos="zoom-in">
          <h3>INFORMASI UTAMA</h3>
          <p><?php echo $detail_institusi->informasi_utama ?></p>
          <a class="cta-btn" href="<?php echo base_url('home/pendaftaran')?>">Daftar Disini</a>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-left">
          <h2>Galeri</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <?php foreach($galeri as $galeri){ ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="<?php echo base_url('assets/upload/berita/'.$galeri->foto)?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?php echo $galeri->judul?></h4>
                <div class="portfolio-links">
                  <a href="<?php echo base_url('assets/upload/berita/'.$galeri->foto)?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $galeri->judul?>"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>

        <div class="col-md-12" data-aos="fade-left"><br>
         <center><a href="<?php echo base_url('home/lebih_galeri')?>" class="btn btn-success btn-rouded">Lihat Semua Galeri</a></center><br><br>
        </div>

      </div>
    </section><!-- End Portfolio Section -->


    

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg" >
      <div class="container">
        <div class="row">

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
           <div class="col-lg-4" data-aos="fade-right">
            <div class="section-title">
              <h2>Contact Us</h2>
            </div>
           </div>
            
            <div class="row">
              <div class="col-lg-12 mt-4">
              <div class="info">
              <i class="bi bi-geo-alt"></i>
              <h4>Alamat lengkap:</h4>
              <p><?php echo $detail_institusi->alamat ?></p>
              </div>
            </div>

              <div class="col-lg-6 mt-4">
                <div class="info">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p><?php echo $detail_institusi->email ?></p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="info w-100 mt-4">
                  <i class="bi bi-phone"></i>
                  <h4>Telp:</h4>
                  <p><?php echo $detail_institusi->telp ?></p>
                </div>
              </div>
            </div>

            <div class="col-lg-4" data-aos="fade-right">
            <div class="section-title">
              <h2><br><br>Maps</h2>
            </div>
          </div>

          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
            <?php echo $detail_institusi->maps ?> 
           </div>

          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->