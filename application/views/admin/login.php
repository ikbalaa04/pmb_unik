
<html lang="en">
  <head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
  <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="icon">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url()?>assets/login/css/style.css">

  </head>
  <body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <!--<h2 class="heading-section"><?php echo strtoupper($title) ?></h2>-->
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url(assets/upload/bg/<?php echo $detail_institusi->bg ?>);">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <?php

              echo validation_errors('<div class="alert alert-warning">','</div>');
                //notif gagal login
                if($this->session->flashdata('warning')){
                  echo '<div class="alert alert-warning">';
                  echo $this->session->flashdata('warning');
                  echo '</div>';
                } 
                //notif logout
                if($this->session->flashdata('success')){
                  echo '<div class="alert alert-success">';
                  echo $this->session->flashdata('success');
                  echo '</div>';
                }  

              ?><br>
              <form method="post" action="<?php echo base_url('login')?>">
                <div class="form-group mb-3">
                <label class="label" for="name">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Masukan username" required>
                </div>
                <div class="form-group mb-3">
                <label class="label" for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Masukan password" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-success rounded submit px-3"><i class="fa fa-sign-in"></i><b> Login</b></button>
                </div>
                </form>

                <center>Lupa password ? <a  href="<?php echo base_url('home/lupa_password')?>">Klik disini</a></center>

              <center>Belum punya akun? <a href="<?php echo base_url('home/pendaftaran')?>">Daftar disini</a></center>
              <p style="color: black" class="text-center"><a class="btn btn-sm btn-default" style="border-radius: 10px"  href="<?php echo base_url()?>"><i class="fa fa-home"></i> Back To Home</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="<?php echo base_url()?>assets/login/js/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/login/js/popper.js"></script>
  <script src="<?php echo base_url()?>assets/login/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url()?>assets/login/js/main.js"></script>

  </body>
</html>



