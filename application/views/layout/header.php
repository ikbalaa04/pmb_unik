 <!-- ======= Header ======= -->
  <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
  
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center justify-content-between">
        <div class="logo">
          <!--<img class="text-light"><a href="<?php echo base_url() ?>"><span><?php echo $detail_institusi->judul ?></span></a></h1>-->
          <!-- Uncomment below if you prefer to use an image logo -->
           <a href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/logounik.png')?>" alt="Logo" height="70px" ></a>
        </div>

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="<?php echo base_url() ?>">Home</a></li>
            <li><a class="nav-link scrollto" href="<?php echo base_url('home/pendaftaran')?>">Daftar</a></li>
            <li><a class="getstarted scrollto" href="<?php echo base_url('login')?>"><i class="fa fa-sign-in"></i>Login</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->
