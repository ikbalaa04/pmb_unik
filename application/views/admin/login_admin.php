<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
  <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="icon">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/login_admin/css/main.css">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form method="post" action="<?php echo base_url('login/admin')?>" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
          <span class="login100-form-title">
            LOGIN OPERATOR
          </span>

          <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Please enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>

          <div class="text-right p-t-13 p-b-23">

          </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn"><br><br>
              Login
            </button>
          </div>

          <div class="flex-col-c p-t-50 p-b-40">
            <span class="txt1 p-b-9">
              Lupa password ? <a  href="<?php echo base_url('home/lupa_password')?>">Klik disini</a>
            </span>

            <a  class="txt3"style="border-radius: 10px"  href="<?php echo base_url()?>"><i class="fa fa-home"></i> Back To Home</a>

          </div>
        </form>
      </div>
    </div>
  </div>
  
  
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo base_url()?>assets/login_admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?php echo base_url()?>assets/login_admin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url()?>assets/login_admin/js/main.js"></script>

</body>
</html>



