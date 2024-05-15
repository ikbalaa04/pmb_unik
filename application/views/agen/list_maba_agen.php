

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h4><a href="<?php echo base_url('agen/komisi_jumlah_agen')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<center><b>Pendaftaran Mahasiswa oleh (<?php echo $agen->nama?>)</b></center><br>
          	</center></h4><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">
         <center>
            <div class="box">
            <?php
		      echo validation_errors('<div class="alert alert-danger">','</div>');
		      //notif logout
		      if($this->session->flashdata('success')){
		        echo '<div class="alert alert-success">';
		        echo $this->session->flashdata('success');
		        echo '</div>';
		      }   
			?>
              <div class="table-responsive">
              <table width="100%"  class="table">
              	<thead>
	                <tr>
	                    <th>No</th>
	                    <th>Tanggal Pengajuan</th>
	                    <th>Nama</th>
	                    <th>Jenis Daftar</th>
	                    <th>Gelombang</th>
	                    <th>Kampus</th>
	                    <th>Pilihan 1</th>
	                    <th>Pilihan 2</th>
	                    <th>Bayar</th>
	                    <th>Diterima</th>
	                </tr>
	            </thead>

	            <tbody>
	            	<?php $i=1; foreach($list_mahasiswa as $list_mahasiswa) {?>
	                <tr>
	                    <th scope="row"><?php echo $i?></th>
	                    <td><?php echo $list_mahasiswa->nisn?></td>
	                    <td><?php echo $list_mahasiswa->nama_lengkap?></td>
	                    <td><?php echo $list_mahasiswa->jenis_daftar?></td>
	                    <td><?php echo $list_mahasiswa->gelombang?></td>
	                    <td><?php echo $list_mahasiswa->nama_institusi?></td>
	                    <td><?php echo $list_mahasiswa->jurusan?></td>
	                    <td><?php echo $list_mahasiswa->pilihan2?></td>
	                    <td align="center">
	                    	<?php if($list_mahasiswa->bayar == 1){?>
	                    		<button class="btn-sm btn-success disabled">Sudah</button>
	                    	<?php }else{ ?>
	                    		<button class="btn-sm btn-warning disabled">Belum</button>
	                    	<?php } ?>
	                    </td>
	                    <td align="center">
	                    	<?php if($list_mahasiswa->approve == 1){?>
	                    		<button class="btn-sm btn-success disabled">Ya</button>
	                    	<?php }else{ ?>
	                    		<small><button class="btn-sm btn-warning disabled">Belum</button></small>
	                    	<?php } ?></td>
	                </tr>
	            	<?php $i++; } ?>
	            </tbody>
              </table>
          	  </div>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->
