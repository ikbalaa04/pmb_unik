

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h4><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<center><b>Halaman Pencairan</b></center></h4><br><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">
         <center>
            <div class="box">
            <?php
              echo validation_errors('<div class="alert alert-warning">','</div>');

              if($this->session->flashdata('warning')){
                echo '<div class="alert alert-warning">';
                echo $this->session->flashdata('warning');
                echo '</div>';
              } 
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success">';
                echo $this->session->flashdata('success');
                echo '</div>';
              }  

            ?>
              <div class="table-responsive">
              <table width="100%"  class="table">
              	<a class="btn btn-success" href="<?php echo base_url('agen/data_bank/'.$detail_agen->id)?>"><i class="fa fa-bank"></i> Edit Akun Bank</a>
              	<br><br>
              	<label>Akun Bank Anda</label>
              	<hr>
              	<label> Nama Bank </label>
                 <input type="text" class="form-control" readonly="" name="namabank" value="<?php echo $detail_agen->namabank ?>">

                <label> Atas Nama </label>
                <input type="text" class="form-control" readonly="" name="atas_nama" value="<?php echo $detail_agen->atas_nama ?>">
                
                <label> Nomor Rekening </label>
                 <input type="text" class="form-control" readonly="" name="norek" value="<?php echo $detail_agen->norek ?>">
              </table>
          	  </div>
            </div>

            <?php 
    	$saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_pengajuan->total_pengajuan;
    		?>

      <div class="box">
      <?php $detail_institusi = $this->admin_model->detail_institusi(); 

      if($detail_institusi->status_pencairan=='0'){ ?>
      <h4 style="font-size: 15px;"><b style="color: red;">Pencairan belum bisa dilakukan karena admin belum membuka fitur pencairan, silahkan hubungi admin agar pencairan dibuka</b></h4>
      <?php }else{ ?>


			<?php $hari = date('D') ?>

			<?php if($hari != 'Sat' && $hari != 'Sun' ) { ?>
			<?php if($saldo > 0 ) { 

			?>



		    <form action="<?php echo base_url('agen/pencairan') ?>" method="post" class="form-inline text-left">
			<div class="row">

			 <input type="hidden" name="tgl_pengajuan" value="<?php echo date('Y/m/d H:i:s')?>">
			 <div class="col-md-6">
			 <select class="form-control" name="pengajuan" required id="" >
                    <center>
                    <option value="">-Masukan Nominal-</option>
                        <option value="<?php echo $saldo?>">Semua (Rp. <?php echo number_format($saldo,'0',',','.') ?>)</option>
                       </center>
			</select>
			</div>

			<div class="col-md-12"><br></div>
			<div class="col-md-6">
			
		      <button  type="submit" name="submit" style="border-radius: 5px" class="btn btn-primary"><b>Cairkan</b></button>
		     </div>

		    </div>
		    </form><br>
			<!-- <label><i><b style="color: red">* Masukan Jumlah Pengajuan dengan Kelipatan 100000 (Seratus Ribu)</b></i></label> -->
			<?php }else{ ?>

			<b style="color: red"><i>* Maaf saat ini anda belum bisa melakukan pencairan karena anda sedang melakukan proses pencairan atau saldo anda belum mencukupi untuk melakukan pencairan</i></b>

			<?php }}else{ ?>

			<b style="color: red"><i>* Hari ini anda tidak bisa melakukan pencairan karena telah memasuki hari libur kerja (Sabtu & Minggu)</i></b>
				
			<?php }} ?>	<br>



            </div>

          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->

