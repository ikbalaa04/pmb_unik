  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <?php $id = $this->session->userdata('id');
      $user     = $this->admin_model->detail_pengguna($id); ?>

      <div class="user-panel">
        <div class="pull-left image">
          <?php if($user->foto != ''){ ?>
          <img src="<?php echo base_url('assets/upload/profil/thumbs/'.$user->foto)?>" class="img-circle" alt="User Image">
          <?php }else{ ?>
            <img src="<?php echo base_url('assets/noavatarn.png')?>" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $user->nama ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
   
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" id="nav">
        <li class="header">MAIN NAVIGATION</li>

        

        <?php if($this->session->userdata('id_level') == '1') { ?>

        
        
         <li ><a href="<?php echo base_url('admin/home/kalkulasi_pendaftar')?>"><i class="fa fa-bar-chart text-aqua"></i> <span>Statistik Pendaftar</span></a></li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench text-aqua"></i>
            <span>Konfigurasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="<?php echo base_url('admin/home/konfigurasi')?>"><i class="fa fa-get-pocket"></i>Konfigurasi Utama</a></li>
            <li ><a href="<?php echo base_url('admin/home/konfigurasi_logo')?>"><i class="fa fa-get-pocket"></i>Konfigurasi Logo</a></li>
            <li ><a href="<?php echo base_url('admin/home/konfigurasi_bg')?>"><i class="fa fa-get-pocket"></i>Background </a></li>
          </ul>
        </li>

        <li class="treeview" >
          <a href="#">
            <i class="fa fa-calendar-check-o text-aqua"></i>
            <span>Tahun Akademik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li ><a href="<?php echo base_url('admin/home/thn_akademik')?>"><i class="fa fa-get-pocket"></i> Tahun Akademik</a></li>
            <li ><a href="<?php echo base_url('admin/home/thn_akademik_utama')?>"><i class="fa fa-get-pocket"></i> Tahun Akademik Admin</a></li>
          </ul>
        </li>

        <li class="treeview" >
          <a href="#">
            <i class="fa fa-maxcdn text-aqua"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li ><a href="<?php echo base_url('admin/home/gelombang')?>"><i class="fa fa-get-pocket"></i> Gelombang</a></li>
            <li ><a href="<?php echo base_url('admin/home/program_kuliah')?>"><i class="fa fa-get-pocket"></i> Program Kuliah</a></li>
            <!-- <li><a href="<?php echo base_url('admin/home/jenis_daftar')?>"><i class="fa fa-get-pocket"></i> Jenis Pendaftaran </a></li> -->
            <li><a href="<?php echo base_url('admin/home/fakultas')?>"><i class="fa fa-get-pocket"></i> Fakultas </a></li>
            <li><a href="<?php echo base_url('admin/home/prodi')?>"><i class="fa fa-get-pocket"></i> Program Studi</a></li>
            <li><a href="<?php echo base_url('admin/home/jenjang')?>"><i class="fa fa-get-pocket"></i>  Jenjang</a></li>
            <li><a href="<?php echo base_url('admin/home/biaya')?>"><i class="fa fa-get-pocket"></i> List Biaya</a></li>
             <li><a href="<?php echo base_url('admin/home/custom_berkas')?>"><i class="fa fa-get-pocket"></i> Custom Berkas</a></li>
            <li><a href="<?php echo base_url('admin/home/sumber')?>"><i class="fa fa-get-pocket"></i> Sumber Referensi</a></li>
          </ul>
        </li>


        <!-- <li ><a href="<?php echo base_url('admin/home/karantina')?>"><i class="fa  fa-close text-aqua"></i> <span>Karantina</span><span class="pull-right-container"><span class="label label-success pull-right"></span></span></a></li> -->

        <li class="treeview" >
          <a href="#">
            <i class="fa fa-user-secret text-aqua"></i>
            <span>Agen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li ><a href="<?php echo base_url('admin/home/agen')?>"><i class="fa fa-get-pocket"></i> Data Agen</a></li>
            <li ><a href="<?php echo base_url('admin/home/jenis_agen')?>"><i class="fa fa-get-pocket"></i> Jenis Agen</a></li>
            <li ><a target="_blank" href="<?php echo base_url('agen')?>"><i class="fa fa-get-pocket"></i> Link Agen</a></li>
          </ul>
        </li>   

        <li ><a href="<?php echo base_url('admin/home/verifikasi')?>"><i class="fa fa-close text-aqua"></i> <span>Registrasi</span></a></li>


        <li ><a href="<?php echo base_url('admin/home/accept')?>"><i class="fa fa-check-square text-aqua"></i> <span>Terverifikasi</span></a></li>

        <!-- <li style="font-family: 'Zapf-Chancery', cursive;"><a href="<?php echo base_url('admin/home/accept_apt')?>"><i class="fa fa-thumbs-o-up text-aqua"></i> <span>Accept Test APT</span></a></li> -->

        <li><a href="<?php echo base_url('admin/home/diterima')?>"><i class="fa fa-mortar-board text-aqua"></i> <span>Diterima</span></a></li>

        <!-- <li><a href="<?php echo base_url('admin/home/registrasi_ulang')?>"><i class="fa fa-hourglass-end text-aqua"></i> <span>Registrasi Ulang</span></a></li> -->

        <li><a href="<?php echo base_url('admin/home/kelulusan_login')?>"><i class="fa fa-book text-aqua"></i> <span>Kelulusan</span></a></li>  

        <li ><a href="<?php echo base_url('admin/home/keuangan')?>"><i class="fa fa-money text-aqua"></i> <span>Lap. Keuangan</span></a></li>

        <li ><a href="<?php echo base_url('admin/home/kalkulasi')?>"><i class="fa fa-calculator text-aqua"></i> <span>Kalkulasi</span></a></li>

        <li><a target="_blank" href="<?php echo base_url('index.php/manager/')?>"><i class="fa  fa-pencil-square text-aqua"></i> <span>Admin CBT</span></a></li> 
        

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar text-aqua"></i>
            <span>USM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="<?php echo base_url('admin/usm/ruang')?>"><i class="fa fa-get-pocket"></i> Ruangan</a></li> -->
            <li><a href="<?php echo base_url('admin/usm/jenis_usm')?>"><i class="fa fa-get-pocket"></i> Jenis USM</a></li>
            <li><a href="<?php echo base_url('admin/usm/jadwal_usm')?>"><i class="fa fa-get-pocket"></i> jadwal USM </a></li>
            <li><a href="<?php echo base_url('admin/usm/gedung')?>"><i class="fa fa-get-pocket"></i> Tempat</a></li>>  
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o text-aqua"></i>
            <span>Informasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/home/berita')?>"><i class="fa fa-get-pocket"></i> Berita</a></li>
            <li><a href="<?php echo base_url('admin/home/galeri')?>"><i class="fa fa-get-pocket"></i> Galeri</a></li>
          </ul>
        </li>

         <!-- <li ><a href="<?php echo base_url('admin/home/berita')?>"><i class="fa fa-newspaper-o text-aqua"></i> <span>Berita</span></a></li> -->

         <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-aqua"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/home/pengguna')?>"><i class="fa fa-get-pocket"></i> Pengguna</a></li>
            <li><a href="<?php echo base_url('admin/home/user_admin')?>"><i class="fa fa-get-pocket"></i> Admin</a></li>
          </ul>
        </li>

         <li><a href="<?php echo base_url('admin/home/backup')?>"><i class="fa fa-database text-aqua"></i> <span>Backup</span></a></li>


        <?php }elseif($this->session->userdata('id_level')=="2") { ?>

        <li ><a href="<?php echo base_url('admin/home/kalkulasi_pendaftar')?>"><i class="fa fa-bar-chart text-aqua"></i> <span>Statistik Pendaftar</span></a></li>

        <!-- <li ><a href="<?php echo base_url('admin/home/karantina')?>"><i class="fa  fa-close text-aqua"></i> <span>Karantina</span><span class="pull-right-container"><span class="label label-success pull-right"></span></span></a></li> -->

        <li ><a href="<?php echo base_url('admin/home/verifikasi')?>"><i class="fa fa-close text-aqua"></i> <span>Registrasi</span></a></li>
        
        <li ><a href="<?php echo base_url('admin/home/accept')?>"><i class="fa fa-check-square text-aqua"></i> <span>Terverifikasi</span></a></li>
        
        <li><a href="<?php echo base_url('admin/home/diterima')?>"><i class="fa fa-mortar-board text-aqua"></i> <span>Diterima</span></a></li>

        <!-- <li><a href="<?php echo base_url('admin/home/registrasi_ulang')?>"><i class="fa fa-hourglass-end text-aqua"></i> <span>Registrasi Ulang</span></a></li> -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar text-aqua"></i>
            <span>USM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="<?php echo base_url('admin/usm/ruang')?>"><i class="fa fa-get-pocket"></i> Ruangan</a></li> -->
            <li><a href="<?php echo base_url('admin/usm/jenis_usm')?>"><i class="fa fa-get-pocket"></i> Jenis USM</a></li>
            <li><a href="<?php echo base_url('admin/usm/jadwal_usm')?>"><i class="fa fa-get-pocket"></i> jadwal USM </a></li>
            <li><a href="<?php echo base_url('admin/usm/gedung')?>"><i class="fa fa-get-pocket"></i> Tempat</a></li>>  
          </ul>
        </li>

        <li><a href="<?php echo base_url('admin/home/backup')?>"><i class="fa fa-database text-aqua"></i> <span>Backup</span></a></li>
        
        <li><a href="<?php echo base_url('index.php/manager/')?>"><i class="fa  fa-pencil-square text-aqua"></i> <span>Admin CBT</span></a></li> 
         


        
        <?php }elseif($this->session->userdata('id_level')=="3") { ?>

          <?php $detail_pendaftaran = $this->admin_model->detail_pendaftaran_mahasiswa();?>

           <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-aqua"></i>
            <span>Data Calon Mahasiswa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/home/form_utama')?>"><i class="fa fa-get-pocket"></i> Form Utama</a></li>
            <?php if($detail_pendaftaran->valid_lanjutan =='1'){?>
            <li><a href="<?php echo base_url('admin/home/form_lanjutan')?>"><i class="fa fa-get-pocket"></i> Form Lanjutan </a></li>
            <?php } ?>
          </ul>
        </li>

          <?php if($detail_pendaftaran->bayar !='0'){ ?>

          <?php $program = $detail_pendaftaran->program;
          $detail_program  = $this->admin_model->kartu_program($program);  ?>
          <?php if($detail_program->tipe_program =='Berbayar'){ ?>
          <li><a href="<?php echo base_url('admin/home/konfirmasi_bayar')?>"><i class="fa fa-money text-aqua"></i> <span>Registrasi Pendaftaran</span></a></li>  
          <?php } ?>

          <?php if($detail_pendaftaran->fix=='1' && $detail_pendaftaran->non_fix=='0'){ ?>

          <li><a href="<?php echo base_url('admin/home/registrasi_ulang_user')?>"><i class="fa fa-hourglass-end text-aqua"></i> <span>Registrasi Ulang</span></a></li>  

          <?php } ?>

          <li ><a href="<?php echo base_url('admin/home/detail_berkas_mhs')?>"><i class="fa fa-upload text-aqua"></i> <span>Upload Berkas</span></a></li>     

         

        <li ><a href="<?php echo base_url('admin/home/profil_mahasiswa')?>"><i class="fa fa-user text-aqua"></i> <span>Cetak Kartu Ujian</span></a></li>

        <li><a href="<?php echo base_url('admin/home/jadwal_usm')?>"><i class="fa fa-calendar-check-o text-aqua"></i> <span>Jadwal Tes</span></a></li>

          <!-- <li><a href="<?php echo base_url('admin/home/mahasiswa')?>"><i class="fa fa-users text-aqua"></i> <span>Data Profil</span></a></li> -->

          <!-- <li style="font-family: 'Zapf-Chancery', cursive;"><a href="<?php echo base_url('admin/home/kelulusan')?>"><i class="fa fa-check-square text-aqua"></i> <span>Cek Hasil Kelulusan</span></a></li> -->

          

          <li ><a target="_blank" href="<?php echo base_url('admin/home/cetak_formulir/'.$detail_pendaftaran->id)?>"><i class="fa fa-file-text-o text-aqua"></i> <span>Cetak Formulir</span></a></li>  

          <?php if($detail_pendaftaran->approve=='1'){ ?>

          <li><a href="<?php echo base_url('tes/')?>"><i class="fa  fa-pencil-square text-aqua"></i> <span>Link CBT</span></a></li> 


          <li><a href="<?php echo base_url('admin/home/kelulusan_peserta')?>"><i class="fa fa-get-pocket text-aqua"></i> <span>Kelulusan</span></a></li> 
          

          <?php }else{ ?>
          <li><a href="#"><i class="fa fa-pencil-square text-aqua"></i> <span>Link CBT</span></a></li> 
          <li><a href="#"><i class="fa fa-book text-aqua"></i> <span>Kelulusan</span></a></li> 

          <?php }} ?>

          <li><a href="<?php echo base_url('admin/home/kontak')?>"><i class="fa fa-phone text-aqua"></i><span>Kontak Admin</span></a></li>

          <li><a href="<?php echo base_url('admin/home/ganti_password')?>"><i class="fa fa-key text-aqua"></i> <span>Ganti Password</span></a></li>
                  
         <?php } ?>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title;?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">

