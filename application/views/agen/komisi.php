

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h4><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<b><center>RIWAYAT PENDAPATAN</center></b><br>
          	</center></h4><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">
          <form action="<?php echo base_url('agen/komisi') ?>" method="post" class="form-inline text-left">
			<div class="form-group">
		      <input type="text" name="cari" class="form-control" id="exampleInputName2" placeholder="Cari Mahasiswa" required="" value="<?php echo set_value('cari')?>">
		      <button  type="submit" name="submit" style="border-radius: 5px" class="btn btn-primary"><b>Cari</b></button>
		    </div>
		    </form>
		    <br>
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
              	<thead >
	                <tr>
	                    <th width="150">No</th>
	                    <th>Mahasiswa Baru</th>
	                    <th>Tanggal Masuk</th>
	                    <th>Komisi</th>
	                </tr>
	            </thead>

	            <tbody>
	            	<?php $i=1; foreach($komisi_agen as $komisi_agen) {?>
	                <tr>
	                    <td scope="row"><?php echo $i?></td>
	                    <td><?php echo $komisi_agen->nama_lengkap ?></td>
	                    <td><?php echo date("d-m-Y", strtotime($komisi_agen->tanggal_konfirmasi)) ?></td>
	                    <td>Rp. <?php echo number_format($komisi_agen->komisi,'0',',','.') ?></td>
	                </tr>
	            	<?php $i++; } ?>
	            	<tr>
	            		<td><b>Total Komisi</b></td>
	            		<td></td>
	            		<td align="left" colspan=""></td>
	            		<td><b>Rp. <?php echo number_format($jumlah_komisi_agen->jumlah_komisi,'0',',','.') ?></b></td>
	            	</tr>
	            </tbody>
              </table>
          	  </div>
              <b style="color: red"><i>* Total komisi dihitung saat pendaftaran mahasiswa verifikasi datanya sudah terverifikasi</i></b><br>
			  <div class="row">
				<?php if(isset($paginasi)) { ?>
					<div class="paginasi col-sm-12 text-center">
					<?php echo $paginasi;?>
					<div class="clearfix"></div>
					</div>
				<?php }?>
			</div><br><hr>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->

