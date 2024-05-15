<?php
      //notif gagal login
      if($this->session->flashdata('warning')){
        echo '<div class="alert alert-warning">';
        echo $this->session->flashdata('warning');
        echo '</div>';
      } 
      //notif logout
      if($this->session->flashdata('success')){
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('success');
        echo '</div>';
      }   


      if (isset($error)) {
    echo '<p class="alert alert-success">';
    echo $error;
    echo '</p>';
	}


	echo validation_errors('<div class="alert alert-warning">','</div>');  
?>

<div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="content">
                    <div class="row">
                    	
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        	<h2 class="page-title">
			            <b>Edit Berkas Calon Mhasiswa Baru</b>
			            <a href="<?php echo base_url('agen/profil_maba/'.$detail_maba->id_pendaftaran)?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-backward"></i> Kembali</a>
			        		</h2>
					    	<?php if($detail_maba->jenis_daftar == 'PD') { ?>
					    		<form method="post" action="<?php echo base_url('agen/edit_proses_pd/'.$detail_maba->id_pendaftaran)?>"  enctype="multipart/form-data">
			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
			        					<div class="form-group">
						                	<center><label for="login-form-email"><b>Transkip Nilai Perguruan Tinggi Sebelumnya</b></label></center>
						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->pd_transkip)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
						                	<input type="file" class="form-control" name="pd_transkip" value="<?php echo $detail_maba->pd_transkip?>" required>
							            </div>
							        	</div>
							        	</div>
			        				</div>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
							            <div class="form-group">
							                <center><label for="login-form-password"><b>Ijazah SMA/SMK/MA</b></label></center>

						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->pd_ijazah_sma)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
							                <input type="file" class="form-control" name="pd_ijazah_sma" value="<?php echo $detail_maba->pd_ijazah_sma?>" required>
							            </div><!-- /.form-group -->
							        	</div>
							        	</div>
			        				</div><hr>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
			        					<div class="form-group">
						                	<center><label for="login-form-email"><b>Surat Keterangan Pindah dari Kampus</b></label></center>
						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->pd_surat_pindah)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
						                	<input type="file" class="form-control" name="pd_surat_pindah" value="<?php echo $detail_maba->pd_surat_pindah?>" required>
							            </div>
							        </div>
							    	</div>
			        				</div>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
							            <div class="form-group">
							                <center><label for="login-form-password"><b>Foto Resmi (Background Biru)</b></label></center>

						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->pd_foto)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
							                <input type="file" class="form-control" name="pd_foto" value="<?php echo $detail_maba->pd_foto?>" required>
							            </div><!-- /.form-group -->
							        </div>
							        </div>
			        				</div>
			        				<div class="col-md-12"><center><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button></center></div>
			        			</form>
			        		<?php }else{ ?>
			        			<form method="post" action="<?php echo base_url('agen/edit_proses_mb/'.$detail_maba->id_pendaftaran)?>"  enctype="multipart/form-data">
			        			<div class="col-md-6">
			        				<div class="panel panel-info">
                						<div class="panel-body">
			        					<div class="form-group">
						                	<center><label for="login-form-email"><b>Scan SKHU/NEM Asli</b></label></center>
						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->mb_skhu)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
						                	<input type="file" class="form-control" name="mb_skhu" value="<?php echo $detail_maba->mb_skhu?>" <?php if($detail_maba->mb_skhu == ''){echo "required";}?>>
							            </div>
							            </div>
							        </div>
			        				</div>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
							            <div class="form-group">
							                <center><label for="login-form-password"><b>Scan KTP atau KK Asli</b></label></center>

						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->mb_ktp_kk)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
							                <input type="file" class="form-control" name="mb_ktp_kk" value="<?php echo $detail_maba->mb_ktp_kk?>" <?php if($detail_maba->mb_ktp_kk == ''){echo "required";}?>>
							            </div><!-- /.form-group -->
							            </div>
							            </div>
			        				</div><hr>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
			        					<div class="form-group">
						                	<center><label for="login-form-email"><b>Scan Ijazah SMA/SMK/MA Terakhir (Asli)</b></label></center>
						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->mb_ijazah)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
						                	<input type="file" class="form-control" name="mb_ijazah" value="<?php echo $detail_maba->mb_ijazah?>" <?php if($detail_maba->mb_ijazah == ''){echo "required";}?>>
							            </div>
							            </div>
							            </div>
			        				</div>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
							            <div class="form-group">
							                <center><label for="login-form-password"><b>Foto Resmi (Background Biru)</b></label></center>

						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->mb_foto)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
							                <input type="file" class="form-control" name="mb_foto" value="<?php echo $detail_maba->mb_foto?>" <?php if($detail_maba->mb_foto == ''){echo "required";}?>>
							            </div><!-- /.form-group -->
							            </div>
							            </div>
			        				</div><hr>

			        				<div class="col-md-6">
			        					<div class="panel panel-info">
                						<div class="panel-body">
							            <div class="form-group">
							                <center><label for="login-form-password"><b>Scan Surat Keterangan Kerja (Bagi yang telah bekerja)</b> </label></center>

						                	<center><img src="<?php echo base_url('assets/upload/image/maba/berkas/'.$detail_maba->mb_kerja)?>" class="img img-responsive img-thumbnail" width="200"></center><small>(Max Ukuran 3 MB)</small><br>
							                <input type="file" class="form-control" name="mb_kerja" value="<?php echo $detail_maba->mb_kerja?>">
							            </div><!-- /.form-group -->
			        				</div>
			        				</div>
							        </div>

			        				<div class="col-md-12"><center><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button></center></div>
			        			</form>
			        		<?php } ?>

								</div>
							</div>
							
						</div><!-- /.col-sm-4 -->
						<div class="col-md-1"></div>
					</form>
					</div><!-- /.row -->

                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->


<?php echo form_close()?>



