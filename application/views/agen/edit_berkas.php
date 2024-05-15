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
                    	<form method="post" action="<?php echo base_url('agen/edit_proses_berkas/'.$detail_agen->id)?>"  enctype="multipart/form-data">
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        <div class="page-title">
			            	<h1 align="center"><b>Edit Berkas Agen</b></h1>
			            	<a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-backward"></i> Kembali</a>
					    </div><!-- /.page-title -->

			        				<div class="col-md-12">
			        					<div class="form-group">
						                	<center><label for="login-form-email">Scan/Foto KK</label></center>
						                	<center><img src="<?php echo base_url('assets/upload/image/agen/kecil/'.$detail_agen->foto_kk)?>" class="img img-responsive" width="500"></center><small>(Max Ukuran 3 MB)</small><br>
						                	<input type="file" class="form-control" name="foto_kk" value="<?php echo $detail_agen->foto_kk?>" required>
							            </div>
			        				</div>

			        				<div class="col-md-12">

							            <div class="form-group">
							                <center><label for="login-form-password">Scan/Foto KTP</label></center>
						                	<center><img src="<?php echo base_url('assets/upload/image/agen/kecil/'.$detail_agen->foto_ktp)?>" class="img img-responsive" width="500"></center><small>(Max Ukuran 3 MB)</small><br>

							                <input type="file" class="form-control" name="foto_ktp" value="<?php echo $detail_agen->foto_ktp?>">
							            </div><!-- /.form-group -->
			        				</div>

								</div>
							</div>
							<div class="col-md-12"><center><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button></center></div>
						</div><!-- /.col-sm-4 -->
						<div class="col-md-1"></div>
					</form>
					</div><!-- /.row -->

                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->


<?php echo form_close()?>



