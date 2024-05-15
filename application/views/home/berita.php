

<section class="section" id="pricing">
<!-- Content -->
<div class="container">
    <div class="row justify-content">
        <div class="col-lg-12 ">
               <h3><center><br><br><?php echo $lihat->judul?></center></h3>

               <div class="col-md-12">
          <div class="post-box">
            <div class="post-thumb">
              <img src="img/post-1.jpg" class="img-fluid" alt="">
            </div>
                <?php $tanggal = date('D',strtotime($lihat->tanggal));
                    $hariList = array('Sun' => 'Minggu',
                                      'Mon' => 'Senin',
                                      'Tue' => 'Selasa',
                                      'Wed' => 'Rabu',
                                      'Thu' => 'Kamis',
                                      'Fri' => 'Jumat',
                                      'Sat' => 'Sabtu');
                     ?>

            <div class="post-meta">
                  <span class="bi bi-tag"></span>
                  <a href="#"><?php echo $lihat->kategori?></a><br>
                  <span class="bi bi-calendar"></span>
                  <a href="#"><?php echo $hariList[$tanggal];?>, <?php echo date('d F Y',strtotime($lihat->tanggal))?></a><br>
                  <span class="bi bi-person-circle"></span>
                  <a href="#"><?php echo $lihat->username?></a>
                <!-- <li>
                  <span class="ion-chatbox"></span>
                  <a href="#">14</a>
                </li> -->
              </ul>
            </div>
            <div><center><br><br>
                  <?php if($lihat->foto == '') { ?>
                  <img src="<?php echo base_url('assets/upload/berita/default.png')?>" class="img img-responsive img-thumbnail" width="200">
                  <?php }else{?>
                  <img src="<?php echo base_url('assets/upload/berita/'.$lihat->foto)?>" class="img img-responsive img-thumbnail" width="50%">
                  <?php }?></center><br><br>
                </div>
            <div class="article-content">
              <?php echo $lihat->isi_berita ?>
              
              
            </div>
          </div>
        </div>

            </div>
        </div>
    </div>
</div>
</section>

  <!--/ Section Blog-Single Star /-->
  <section class="blog-wrapper sect-pt4" id="blog">
    <div class="container">
      <div class="row">
        
        
      </div>
    </div>
  </section>