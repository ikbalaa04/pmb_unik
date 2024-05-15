<?php 
$konfigurasi           = $this->admin_model->detail_konfigurasi();
?>
			<div class="wrap_header">
				<!-- Logo -->
				<a href="<?php echo base_url()?>" class="logo">
					<img src="<?php echo base_url('assets/upload/logo/thumbs/'.$konfigurasi->logo)?>" alt="<?php echo $konfigurasi->nama_web ?> | <?php echo $konfigurasi->tagline?>">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="<?php echo base_url()?>">Beranda</a>
							</li>

							<li>
								<a href="<?php echo base_url('home/kontak')?>">Kontak</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<?php if($this->session->userdata('email')) { ?>
					<a href="<?php echo base_url('home/dasbor')?>" class="header-wrapicon1 dis-block">
						<img src="<?php echo base_url()?>assets/edubin/images/icons/icon-header-01.png" class="header-icon1" alt="ICON"> <?php echo $this->session->userdata('nama_pelanggan')?> 
					</a>&nbsp;&nbsp;
					<a onclick="return confirm('Anda yakin ingin logout ?')" href="<?php echo base_url('home/logout')?>" class="header-wrapicon1 dis-block btn btn-danger btn-sm">
						<i class="fa fa-sign-out"></i> logout
					</a>
					<?php }else{ ?>
					<a href="<?php echo base_url('home/registrasi')?>" class="header-wrapicon1 dis-block">
						<img src="<?php echo base_url()?>assets/edubin/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>
					<?php } ?>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="http://localhost/ecmart/assets/edubin/images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<?php if($this->session->userdata('email')) { ?>
					<a href="<?php echo base_url('home/dasbor')?>" class="header-wrapicon1 dis-block">
						<img src="<?php echo base_url()?>assets/edubin/images/icons/icon-header-01.png" class="header-icon1" alt="ICON"> <?php echo $this->session->userdata('nama_pelanggan')?> 
					</a>&nbsp;&nbsp;
					<a onclick="return confirm('Anda yakin ingin logout ?')" href="<?php echo base_url('home/logout')?>" class="header-wrapicon1 dis-block btn btn-danger btn-sm">
						<i class="fa fa-sign-out"></i> logout
					</a>
					<?php }else{ ?>
					<a href="<?php echo base_url('home/registrasi')?>" class="header-wrapicon1 dis-block">
						<img src="<?php echo base_url()?>assets/edubin/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>
					<?php } ?>

				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-menu-mobile">
						<a href="<?php echo base_url()?>">Beranda</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url('home/kontak')?>">Kontak</a>
					</li>
				</ul>

			</nav>
		</div>
</header>
