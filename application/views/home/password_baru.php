<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
  <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('login')?>"><b><?php echo $title ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="border-radius: 20px" >
    <p class="login-box-msg"><center><img width="40%" src="<?php echo base_url()?>assets/upload/logo/<?php echo $detail_institusi->logo?>" ></center><br>
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

          ?><br></p>

    <form action="<?php echo base_url('home/save_password/')?>" method="post" role="form" class="login-form">
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" required="" placeholder="Masukan Password Baru">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12"><center>
          <button style="border-radius: 10px" type="submit" class="btn btn-primary btn-block btn-flat"><b>Simpan Password Baru</b></button></center>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <center><a href="<?php echo base_url('login')?>" style="border-radius: 10px" class="btn btn-sm btn-default"><i class="fa fa-sign-in"></i> Kembali ke Halaman Login</a><br><br>
    <a class="btn btn-sm btn-default" style="border-radius: 10px" href="<?php echo base_url()?>"><i class="fa fa-home"></i> Kembali ke Halaman Utama</a><br></center>

  </div>
  <!-- /.login-box-body -->
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>/assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>