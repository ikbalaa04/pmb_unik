<?php $detail_konfigurasi = $this->admin_model->detail_institusi(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="<?php echo $detail_konfigurasi->keywords ?>">
  <meta content="" name="<?php echo $detail_konfigurasi->deskripsi ?>">

  <!-- Favicons -->
  <link href="<?php echo base_url('assets/upload/logo/'.$detail_konfigurasi->logo)?>" rel="icon">
  <link href="<?php echo base_url('assets/upload/logo/'.$detail_konfigurasi->logo)?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url()?>assets/depan/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url()?>assets/depan/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/depan/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/depan/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/depan/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/depan/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url()?>assets/depan/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Rapid
    Theme URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>