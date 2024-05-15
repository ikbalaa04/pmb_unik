

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h4><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<center><b>Riwayat Pencairan</b></center></h4><br><br>
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
              	<thead style="text-align: center;">
	                <tr>
	                    <th>No</th>
	                    <th>Tanggal Pencairan</th>
	                    <th><center>Status Pencairan</center></th>
	                    <th>Tanggal Sukses</th>
	                    <th>Pencairan</th>
	                    <!-- a style="border-radius: 3px" href="<?php echo base_url(''.$komisi_agen->id_pendaftaran)?>"  class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a> -->
	                </tr>
	            </thead>

	            <tbody>
	            	<?php if($komisi_agen){?>
	            	<?php $i=1; foreach($komisi_agen as $komisi_agen) {?>
	                <tr>
	                    <th scope="row"><?php echo $i?></th>
	                    <td align="center"> <?php echo date('d M Y H:i',strtotime($komisi_agen->tgl_pengajuan))?></td>
	                    <td align="center">
	                    	<?php if($komisi_agen->status_pengajuan == 1){?>
	                    		<span class="badge badge-success">Sukses</span>
	                    	<?php }else{ ?>
	                    		<span class="badge badge-warning">Menunggu Konfirmasi</span>
	                    	<?php } ?>
	                    </td>
	                    <td><?php echo $komisi_agen->tgl_sukses?></td>
	                    <td align="left">Rp. <?php echo number_format($komisi_agen->pengajuan,'0',',','.') ?></td>    
	                </tr>
	            	<?php $i++; } ?>

	            	<tr>
	            		<td colspan="2" align="left"><b>Menunggu Konfirmasi</b></td>
	            		<td colspan="2" align="left"></td>
	            		<td align="left"><b>Rp. <?php echo number_format($menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan,'0',',','.') ?></b></td>
	            	</tr>
	            	<!-- <tr>
	            		<td colspan="2" align="left">Total Komisi (dari <?php echo $jumlah_komisi_agen->total_maba?> Mahasiswa Terverivikasi)</td>
	            		<td colspan="2" align="left"></td>
	            		<td align="left">Rp. <?php echo number_format($jumlah_komisi_agen->jumlah_komisi,'0',',','.') ?></td>
	            	</tr> -->
	            	<tr>
	            		<td colspan="2" align="left"><b>Penarikan Sukses</b></td>
	            		<td colspan="2"></td>
	            		<td align="left"><b>Rp. <?php echo number_format($jumlah_agen_pengajuan->jumlah_pengajuan,'0',',','.') ?></b></td>

	            	</tr>
	            	<!-- <tr>
	            		<td colspan="2" align="left">Saldo Sementara</td>
	            		<td colspan="2" align="left"></td> -->
	            		<!-- <?php 
	            		$saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_agen_pengajuan->jumlah_pengajuan;
						$menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;

						$menunggu_sementara = $saldo-$menunggu; 
	            		?> -->
	            		<!-- <td align="left">Rp. <?php echo number_format($menunggu_sementara,'0',',','.') ?></td>
	            	</tr> -->
	            	<tr>
	            		<td colspan="2" align="left"><b>Total Komisi</b></td>
	            		<td colspan="2" align="left"></td>
	            		<!-- <?php $saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_agen_pengajuan->jumlah_pengajuan ?> -->
	            		<td align="left"><b>Rp. <?php echo number_format($jumlah_komisi_agen->jumlah_komisi,'0',',','.') ?></b></td>
	            	</tr>
	            <?php }else{ ?>
	            	<tr>
	            		<td colspan="5" align="center">Belum ada riwayat pencairan</td>
	            	</tr>
	            <?php } ?>

	            </tbody>
              </table>
          	  </div>
			  <div class="row">
				<?php if(isset($paginasi)) { ?>
					<div class="paginasi col-sm-12 text-center">
					<?php echo $paginasi;?>
					<div class="clearfix"></div>
					</div>
				<?php }?>
			</div><br>
            </div>

          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->

