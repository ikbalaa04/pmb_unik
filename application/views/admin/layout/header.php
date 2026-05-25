<header class="main-header">
    <?php
      $konfigurasi_header = $this->admin_model->detail_institusi();
      $link_wa_group = isset($konfigurasi_header->wa_group) ? trim($konfigurasi_header->wa_group) : '';
    ?>
    <!-- Logo -->
    <?php if($this->session->userdata('id_level') == '3') { ?>
    <a href="<?php echo base_url('admin/home/form_utama')?>" class="logo">
    <?php }else{ ?>
    <a href="<?php echo base_url('admin/home/kalkulasi_pendaftar')?>" class="logo">
    <?php } ?>
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
          <img src="<?php echo base_url('assets/logosm.png')?>" alt="Logo" height="50px" >
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg ">
        <img src="<?php echo base_url('assets/logounik.png')?>" alt="Logo" height="50px" >
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <?php if($link_wa_group != '') { ?>
                <li class="dropdown user user-menu">
                     <a href="<?php echo $link_wa_group; ?>" target="_blank" class="btn btn-success btn-flat"><i class="fa fa-whatsapp"></i> Gabung WA Group</a>
                  </li>
                <?php } ?>
                 <li class="dropdown user user-menu">
                     <a  href="<?php echo base_url('login/logout')?>" class="btn btn-success btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                  </li>
                </ul>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
