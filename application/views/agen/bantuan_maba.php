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
                	
                    	<div class="col-md-2"></div>
					    <div class="col-md-8">

						<div class="page-title">
			            	<h2 align="center">Halaman Bantuan Agen</h2>
			            	<a href="<?php echo base_url('agen/profil_maba/'.$detail_maba->id_pendaftaran)?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-backward"></i> Kembali</a>
			            	<h4 id="reviews"><?php echo $total?></h4>
					    </div><!-- /.page-title -->

					    <div class="comments">
					    <div class="comment">

					    	<?php foreach($detail_keluh_maba as $detail_keluh_maba) {?>
					    	<?php if ($detail_keluh_maba->username == $detail_maba->nama_lengkap) { ?>

					    	<?php if ($detail_maba->foto == '') { ?>
					        <div class="comment-image">
					            <img src="<?php echo base_url('assets/upload/image/maba/'.$detail_maba->foto)?>"  >
					        </div><!-- /.comment-image -->
					        <?php }else{?>
					       <div class="comment-image">
					            	<img src="<?php echo base_url('assets/upload/image/default.png')?>"  >
					                
					            </div><!-- /.comment-image -->
					        <?php }?>

					        <div class="comment-inner">
					            <div class="comment-header">
					                <h2><?php echo strtoupper($detail_keluh_maba->username)?></h2>
					                <span class="separator">&#8226;</span>
					                <span class="comment-date"><?php echo date('d M Y, H:i',strtotime($detail_keluh_maba->tgl))?></span>
					               
					            </div><!-- /.comment-header -->

					            <div class="comment-content-wrapper">
					                <div class="comment-content">
					                    <p><?php echo $detail_keluh_maba->isi?></p>
					                </div><!-- /.comment-content -->
					            </div><!-- /.comment-content-wrapper -->
					        </div><!-- /.comment-inner -->
					    	<?php }else{?>
					        <div class="comment comment-children">
					            <div class="comment-image">
					            	<img src="<?php echo base_url('assets/upload/image/default.png')?>"  >
					                
					            </div><!-- /.comment-image -->

					            <div class="comment-inner">
					                <div class="comment-header">
					                    <h2><?php echo strtoupper($detail_keluh_maba->username)?></h2>
					                    <span class="separator">&#8226;</span>
					                    <span class="comment-date"><?php echo date('d M Y, H:i',strtotime($detail_keluh_maba->tgl))?></span>
					                    
					                </div><!-- /.comment-header -->

					                <div class="comment-content-wrapper">
					                    <div class="comment-content">
					                        <p><?php echo $detail_keluh_maba->isi?></p>
					                    </div><!-- /.comment-content -->
					                </div><!-- /.comment-content-wrapper -->
					            </div><!-- /.comment-inner -->


					        </div><!-- /.comment -->
					       <?php }} ?>
					       <hr>
					    			<form method="post" action="<?php echo base_url('agen/komen_maba/'.$detail_maba->id_pendaftaran)?>">
			        				<div class="col-md-12">
					                     <div class="form-group">
					                        <label for="exampleInputFile"><b> Komen Sebagai <i><?php echo $detail_maba->nama_lengkap?></i></b></label>
					                        <input type="hidden" class="form-control" name="nama_lengkap" value="<?php echo $detail_maba->nama_lengkap ?>" required>
					                        <input type="hidden" class="form-control" name="id_pendaftaran" value="<?php echo $detail_maba->id_pendaftaran ?>" required>
					                        <textarea name="isi" class="form-control" required><?php echo set_value('isi')?></textarea>
					                    </div>

					                    <div class="col-md-12"><center><button type="submit" class="btn btn-primary pull-right"><i class="fa fa-comment"></i> Kirim</button></center></div>
			        				</div>
			        				</form>

					    </div><!-- /.comment -->
					   </div>

						</div>

                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->


<?php echo form_close()?>



