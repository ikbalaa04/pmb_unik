
<!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-left">
          <h2><br><br>Galeri</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <?php foreach($galeri as $galeri){ ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="<?php echo base_url('assets/upload/berita/thumbs/'.$galeri->foto)?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4><?php echo $galeri->judul?></h4>
                <div class="portfolio-links">
                  <a href="<?php echo base_url('assets/upload/berita/thumbs/'.$galeri->foto)?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $galeri->judul?>"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>

          <?php if(isset($paginasi)) { ?>
              <div class="paginasi col-sm-12 text-center">
              <?php echo $paginasi;?>
              <div class="clearfix"></div>
              </div>
          <?php }?>
          <div class="col-md-12" ><br><br></div>

      </div>
    </section><!-- End Portfolio Section -->
