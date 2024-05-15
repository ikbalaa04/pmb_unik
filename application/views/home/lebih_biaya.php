    <section class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="section-title" data-aos="fade-right">
              <h2><br><br>Daftar Biaya</h2>
            </div>
          </div>

        <?php foreach($list_biaya as $list_biaya) { ?>
          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-right">
            <div class="content" style="color: black">      
              <h3 style="font-size: 20px"><center><?php echo $list_biaya->nama_fakultas?></center></h3>
              <h3 style="font-size: 18px"><center><?php echo $list_biaya->jenjang?> <?php echo $list_biaya->nama_prodi?></center></h3>
              <h3 style="font-size: 18px"><center><sup>Rp. </sup><?php echo $list_biaya->biaya?></center></h3>
              <p>
                <center><?php echo $list_biaya->isi?></center>
              </p>
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
