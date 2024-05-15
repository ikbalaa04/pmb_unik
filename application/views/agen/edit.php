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
                    	<form method="post" action="<?php echo base_url('agen/edit_proses/'.$detail_agen->id)?>"  enctype="multipart/form-data">
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        <div class="page-title">
			            	<h1 align="center"><b>Edit Profil Agen</b></h1>
			            	<a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-backward"></i> Kembali</a>
					    </div><!-- /.page-title -->

					        				<div class="col-md-6">
					        					<div class="form-group">
								                	<label for="login-form-email">Nama Lengkap</label>
								                	<input type="text" class="form-control" name="nama" value="<?php echo $detail_agen->nama?>" required>
									            </div>

									            <div class="form-group">
									                <label for="login-form-password">NIK</label>
									                <input type="number" class="form-control" name="nik" value="<?php echo $detail_agen->nik?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tempat Lahir</label>
									                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $detail_agen->tempat_lahir?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tanggal Lahir</label>
									                <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $detail_agen->tanggal_lahir?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
								                	<label for="login-form-email">No. Handphone</label>
								                	<input type="number" class="form-control" name="hp" value="<?php echo $detail_agen->hp?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Email</label>
									                <input type="email" class="form-control" name="email" value="<?php echo $detail_agen->email?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Nama Bank</label>
									                <input type="text" class="form-control" name="namabank" value="<?php echo $detail_agen->namabank?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Atas Nama</label>
									                <input type="text" class="form-control" name="atas_nama" value="<?php echo $detail_agen->atas_nama?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">No. Rekening</label>
									                <input type="number" class="form-control" name="norek" value="<?php echo $detail_agen->norek?>" required>
									            </div ><!-- /.form-group -->
   
					        				</div>

					        				<div class="col-md-6">

					        					  <div class="form-group">
									                <label for="login-form-password">Pekerjaan</label>
									                <select name="pekerjaan" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($select_pekerjaan as $select_pekerjaan) { ?>
									                		<option value="<?php echo $select_pekerjaan->nama?>" <?php if($detail_agen->pekerjaan ==$select_pekerjaan->nama){echo "selected";} ?> ><?php echo $select_pekerjaan->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									              <div class="form-group">
									                <label for="login-form-password">Tempat Kerja</label>
									                <input type="text" class="form-control" name="tempat_kerja" value="<?php echo $detail_agen->tempat_kerja?>">
					        					</div>

									            <div class="form-group">
									                <label for="login-form-password">Alamat</label>
									                <textarea class="form-control" name="alamat" placeholder="Masukan Alamat, Blok, RT, RW, Desa/Kel" required><?php echo $detail_agen->alamat?></textarea>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									            <label>Provinsi</label>
						                        <select class="form-control" name="provinsi" id="provinsi" required>
						                            <option value="">-Pilih-</option>
						                            <?php
						                            foreach ($provinsi as $prov) {
						                                ?>
						                                <option <?php echo $provinsi_selected == $prov->id_prov ? 'selected="selected"' : '' ?>
						                                    value="<?php echo $prov->id_prov ?>" <?php if($detail_agen->provinsi == $prov->id_prov ){ echo "selected";}?>><?php echo $prov->nama ?></option>
						                                <?php
						                            }
						                            ?>
						                        </select>
						                    	</div>

						                    	<div class="form-group">
							                        <label>Kota</label>
							                        <select class="form-control" name="kota" id="kota" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($kota as $kot) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option <?php echo $kota_selected == $kot->id_prov ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $kot->id_prov ?>" value="<?php echo $kot->id_kab ?>" <?php if($detail_agen->kabupaten == $kot->id_kab ){ echo "selected";}?>><?php echo $kot->kab ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>
							                    <div class="form-group">
							                        <label>Kecamatan</label>
							                        <select class="form-control" name="kecamatan" id="kecamatan" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($kecamatan as $kec) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id kota-->
							                                <option <?php echo $kecamatan_selected == $kec->id_kec ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $kec->id_kab ?>" value="<?php echo $kec->id_kec ?>" <?php if($detail_agen->kecamatan == $kec->id_kec ){ echo "selected";}?>><?php echo $kec->nama ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>


									            <div class="form-group">
									                <label for="login-form-password">Kode Pos</label>
									                <input type="number" class="form-control" name="kode_pos" value="<?php echo $detail_agen->kode_pos?>">
									            </div>

									            <div class="form-group">
								                	<label for="login-form-email">Facebook</label>
								                	<input type="text" class="form-control" name="facebook" value="<?php echo $detail_agen->facebook?>">
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Instagram</label>
									                <input type="text" class="form-control" name="instagram" value="<?php echo $detail_agen->instagram?>">
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



