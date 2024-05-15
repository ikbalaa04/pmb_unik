

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
            <?php
		      echo validation_errors('<div class="alert alert-danger">','</div>');
		      //notif logout
		      if($this->session->flashdata('success')){
		        echo '<div class="alert alert-success">';
		        echo $this->session->flashdata('success');
		        echo '</div>';
		      }   
			?><br>
          <h4><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<center><b>HALAMAN KOMISI KOORDINATOR</b></h4></center><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">
         <div class="box">
              <table width="100%" style="font-size: 12px">
                <tbody >
                    <tr><td width="230" align="left"> Total Mahasiswa Diterima Melalui Agen</td>
                        <td width="2">:&emsp;</td>
                        <td align="left"><b><?php echo $jumlahkan->total.' Mahasiswa'; ?></b></td>
                    </tr> 
                    <tr><td width="230" align="left"> Total Komisi</td>
                        <td width="2">:&emsp;</td>
                        <td align="left"><b><?php echo $jumlahkan->total?> x Rp. 5000 = Rp. <?php echo number_format($jumlahkan->total*5000,'0',',','.') ?></b></td>
                    </tr>                             
                </tbody>
              </table>
            </div>

         <div class="box">
         	<?php 
        	$menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;
        	$saldo = $jumlahkan->total*5000;
        	$hari = date('D')
        	?>
        	<?php if($hari != 'Sat' && $hari != 'Sun' ) { ?>
        	<?php if($saldo > $menunggu) { ?>
        	<?php if($saldo < 10000) { 

        	?>

        	<b style="color: red"><i>* Maaf saat ini anda belum bisa melakukan pengajuan karena saldo kurang dari Rp. 20.000,.</i></b>
			 
        	<?php }else{ 

        	$saldo_akhir = $saldo-$jumlah_agen_pengajuan->jumlah_pengajuan;
			$menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;

			$menunggu_sementara = $saldo_akhir-$menunggu; 

        	?>

			<form action="<?php echo base_url('agen/pencairan_koordinator') ?>" method="post" class="form-inline text-left">
			 <input type="hidden" name="tgl_pengajuan" class="form-control" value="<?php echo date('Y/m/d H:i:s')?>">
			 
			 <select class="form-control" name="pengajuan" required id="" >
             <center>
             <option value="">-Masukan Nominal-</option>
             <option value="<?php echo $menunggu_sementara?>">Rp. <?php echo number_format($menunggu_sementara,'0',',','.') ?></option>
             </center>
			</select>
		      <button  type="submit" name="submit" style="border-radius: 5px" class="btn btn-primary"><b>Kirim Pengajuan</b></button>
		    </form>

        	<?php }}else{ ?>

			<b style="color: red"><i>* Maaf saat ini anda belum bisa melakukan pengajuan karena sedang menunggu konfirmasi pencairan atau saldo tidak mencukupi untuk pengajuan</i></b>

			<?php }}else{ ?>

			<b style="color: red"><i>* Hari ini anda tidak bisa melakukan pengajuan karena telah memasuki hari libur kerja (Sabtu & Minggu)</i></b>
				
			<?php } ?>	
         </div>
         <center>
            <div class="box">
              <div class="table-responsive">
              <h3>Riwayat Pencairan Komisi</h3>
              <table width="100%"  class="table">
              	<thead >
	                <tr>
	                    <th>#</th>
	                    <th>Tanggal Pengajuan</th>
	                    <th><center>Status Pengajuan</center></th>
	                    <th>Tanggal Sukses</th>
	                    <th>Pengajuan</th>
	                    <!-- a style="border-radius: 3px" href="<?php echo base_url(''.$komisi_agen->id_pendaftaran)?>"  class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a> -->
	                </tr>
	            </thead>

	            <tbody>
	            	<?php $i=1; foreach($komisi_agen as $komisi_agen) {?>
	                <tr>
	                    <th scope="row"><?php echo $i?></th>
	                    <td> <?php echo date('d M Y H:i',strtotime($komisi_agen->tgl_pengajuan))?></td>
	                    <td align="center">
	                    	<?php if($komisi_agen->status_pengajuan == 1){?>
	                    		<button class="btn-sm btn-success disabled">Sukses</button>
	                    	<?php }else{ ?>
	                    		<button class="btn-sm btn-warning disabled">Menunggu Konfirmasi</button>
	                    	<?php } ?>
	                    </td>
	                    <td><?php echo $komisi_agen->tgl_sukses?></td>
	                    <td>Rp. <?php echo number_format($komisi_agen->pengajuan,'0',',','.') ?></td>    
	                </tr>
	            	<?php $i++; } ?>

	            	<!-- <tr>
	            		<td colspan="2" align="left">Belum Tercairkan</td>
	            		<td colspan="2"></td>
	            		<td align="left">Rp. <?php echo number_format($menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan,'0',',','.') ?></td>
	            	</tr> -->
	            	<!-- <tr>
	            		<td colspan="2">Total Komisi (dari <?php echo $jumlah_komisi_agen->total_maba?> Mahasiswa Terverivikasi)</td>
	            		<td colspan="2"></td>
	            		<td><?php echo $jumlah_komisi_agen->jumlah_komisi?></td>
	            	</tr> -->
	            	<!-- <tr>
	            		<td colspan="2" align="left">Sudah Tercairkan</td>
	            		<td colspan="2"></td>
	            		<td align="left"> Rp. <?php echo number_format($jumlah_agen_pengajuan->jumlah_pengajuan,'0',',','.') ?></td>

	            	</tr> -->
	            	<!-- <tr>
	            		<td colspan="2" align="left">Saldo Sementara</td>
	            		<td colspan="2"></td> -->
	            		<?php 
	            		$saldo = $jumlahkan->total*5000;
						$menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;

						$menunggu_sementara = $saldo-$menunggu; 
	            		?>
	            		<!-- <td align="left">Rp. <?php echo number_format($menunggu_sementara,'0',',','.') ?></td>
	            	</tr> -->
	            	<tr>
	            		<td colspan="2" align="left"><b>SALDO</b></td>
	            		<td colspan="2"></td>
	            		<?php $saldo_akhir = $saldo-$jumlah_agen_pengajuan->jumlah_pengajuan ?>
	            		<td align="left"><b>Rp. <?php echo number_format($saldo_akhir,'0',',','.') ?></b></td>
	            	</tr>
	            </tbody>
              </table>
          	  </div>
              
            </div>
          </center>

     	<div class="box">
          	<div class="table-responsive">
              <h3>Daftar Anggota</h3>
              <table width="100%"  class="table">
              	<thead>
	            	 <tr align="center">
	                    <th>#</th>
	                    <th><center>Nama Agen</center></th>
	                    <th><center>Kode Agen</center></th>
	                    <th><center>Jumlah Mahasiswa Diterima</center></th>
	                    <th><center>Aksi</center></th>
	                </tr>
	            </thead>

	            <tbody>
	            	<?php $no=1; foreach($jumlah_agen as $jumlah_agen) { 
                    		 // $kode_agen = $jumlah_agen->kode_agen;
                    		 // $jumlah_maba = $this->admin_model->jumlah_maba_koordinator($kode_agen);
                           
                    	?>
	                <tr>
	                    <th scope="row"><?php echo $no?></th>
                        <td align="center"><?php echo $jumlah_agen->nama?>
                        </td>
                        <td align="center"><?php echo $jumlah_agen->kode_agen?></td>
                        <td align="center"><b style="font-size: 20px"><?php echo $jumlah_agen->jumlah_maba ?></b></td>
                        <td align="center"><a style="border-radius: 5px" href="<?php echo base_url('agen/list_maba_agen/'.$jumlah_agen->kode_agen)?>" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat</a></td>
	                </tr>
	            	<?php $no++; } ?>
	            </tbody>
              </table>
          	  </div>
     	</div>
      </div>

    </div>

  </div>
</section><!-- #services -->


