

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br>
          <h4><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<b><center>HALAMAN RIWAYAT PENDAFTARAN</center></b></h4><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">
          <form action="<?php echo base_url('agen/list_mahasiswa') ?>" method="post" class="form-inline text-left">
			<div class="form-group">
		      <input type="text" name="cari" class="form-control" id="exampleInputName2" placeholder="Cari Mahasiswa" required="" value="<?php echo set_value('cari')?>">&emsp;
		      <button  type="submit" name="submit" style="border-radius: 5px" class="btn btn-primary"><b>Cari</b></button>
		    </div>
		    </form><hr>
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
	                    <th>Nama</th>
	                    <th>Pendaftaran</th>
	                    <th>Status Bayar</th>
	                    <th>Verifikasi Data</th>
	                    <th>Aksi</th>
	                </tr>
	            </thead>
              	<tbody>
	            	<?php $i=1; foreach($list_mahasiswa as $list_mahasiswa) {?>
	                <tr>
	                    <th scope="row"><?php echo $i?></th>
	                    <td><?php echo $list_mahasiswa->nama_lengkap?></td>
	                    <td><?php echo $list_mahasiswa->nama_fakultas ?> <br> <?php echo $list_mahasiswa->nama_gelombang ?> <br>
		                      <?php
		                      $kode1     = $list_mahasiswa->jurusan_pilihan;
		                      $pilihan1  = $this->admin_model->pilihan1($kode1);
		                      $kode2     = $list_mahasiswa->jurusan_pilihan2;
		                      $pilihan2  = $this->admin_model->pilihan2($kode2);
		                      ?>
		                      <?php
		                      if($list_mahasiswa->jurusan_pilihan !='0'){ ?>
		                        <?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> 
		                      <?php }else{ ?>
		                        -
		                      <?php }?>
		                      <br>
		                      <?php
		                      if($list_mahasiswa->jurusan_pilihan2 !='0'){ ?>
		                        <?php echo $pilihan2->jenjang ?> <?php echo $pilihan2->nama ?>  
		                      <?php }else{ ?>
		                        -
		                      <?php }?>
                  		</td>
	                    <td align="center">
	                    	<?php if($list_mahasiswa->bayar == 1){?>
	                    		<span class="badge badge-success">Sudah</span>
	                    	<?php }else{ ?>
	                    		<span class="badge badge-warning">Belum</span>
	                    	<?php } ?>
	                    </td>
	                    <td align="center">
	                    	<?php if($list_mahasiswa->approve == 1){?>
	                    		<span class="badge badge-success">Sudah Terverifikasi</span>
	                    	<?php }else{ ?>
	                    		<span class="badge badge-warning">Belum Terverifikasi</span>
	                    	<?php } ?></td>
	                    <td align="center"><small>
	                    		 <a style="border-radius: 3px" href="<?php echo base_url('agen/profil_maba/'.$list_mahasiswa->id)?>"  class="btn btn-sm btn-info"> <i class="fa fa-edit"></i></a>
                                  </small>
                                   </td>
	                </tr>
	            	<?php $i++; } ?>
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
			</div>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->
