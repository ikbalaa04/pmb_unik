<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title?></title>
  <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
  <meta name="description" content="<?php echo $detail_institusi->deskripsi ?>">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="icon">
  <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/bethany/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url()?>assets/bethany/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bethany - v4.8.1
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style type="text/css">

    .paginasi{

            padding: 10px 20px;
            background-color: #fff;
            border-radius: 20px;
            min-height: 40px;

        }

    .paginasi a{

        padding: 3px 10px;
        background-color: #000;
        color: #fff;
        border-radius: 3px;
        margin: 3px 2px;
        min-width: 20px;

    }

    .paginasi strong{
        padding: 3px 10px;
        background-color: #00ff99;
        color: #fff;
        border-radius: 3px;
        margin: 3px 2px;
        min-width: 20px;

    }

    .paginasi a:hover{

        background-color: #ff0000;

    }

    /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
    #hero {
      width: 100%;
      height: 80vh;
      background: url("<?php echo base_url('assets/upload/bg/'.$detail_institusi->bg_beranda)?>") center center;
      background-size: cover;
      position: relative;
    }

    .cta {
      background: linear-gradient(rgba(2, 2, 2, 0.7), rgba(0, 0, 0, 0.7)), url("<?php echo base_url('assets/upload/bg/'.$detail_institusi->bg_beranda)?>") fixed center center;
      background-size: cover;
      padding: 60px 0;
    }

    #header {
      padding: 0;
      background: rgba(255, 255, 255, 0.94);
      box-shadow: 0 12px 34px rgba(15, 23, 42, 0.08);
      backdrop-filter: blur(14px);
    }

    #header .header-container {
      min-height: 76px;
      padding: 0;
      background: transparent;
      box-shadow: none;
    }

    #header .logo {
      display: flex;
      align-items: center;
      margin: 0;
      padding: 0;
      background: transparent;
    }

    #header .logo img {
      display: block;
      max-height: 48px;
      width: auto;
      object-fit: contain;
    }

    #header .navbar ul {
      align-items: center;
      gap: 4px;
    }

    #header .navbar a,
    #header .navbar a:focus {
      padding: 12px 14px;
      color: #2f3d37;
      font-size: 14px;
      font-weight: 800;
      letter-spacing: 0;
    }

    #header .navbar .getstarted,
    #header .navbar .getstarted:focus {
      margin-left: 10px;
      padding: 13px 24px;
      border-radius: 999px;
      color: #fff;
      background: #009f73;
    }

    #header .navbar .getstarted:hover,
    #header .navbar .getstarted:focus:hover {
      color: #fff;
      background: #087f5f;
    }

    @media (max-width: 991px) {
      #header .header-container {
        min-height: 68px;
      }

      #header .logo img {
        max-height: 42px;
      }
    }
  </style>
</head>

<body>

