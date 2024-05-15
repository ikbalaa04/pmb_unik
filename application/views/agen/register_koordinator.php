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


echo validation_errors('<div class="alert alert-warning alert-sm">','</div>');  

?>

<div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="content">
                    <div class="row">
                    	<form method="post" action="<?php echo base_url('agen/tambah_koordinator')?>"  enctype="multipart/form-data">
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        <div class="page-title">
			            	<h1 align="center">Pendaftaran Koordinator Agen</h1>
					    </div><!-- /.page-title -->

					        				<div class="col-md-6">
					        					<div class="form-group">
								                	<label for="login-form-email">Nama Lengkap *</label>
								                	<input type="text" class="form-control" name="nama" value="<?php echo set_value('nama')?>" required placeholder="Masukan nama lengkap">
									            </div>

									            <div class="form-group">
								                	<label for="login-form-email">Username * <small><strong>(Contoh : Steven20)</strong></small></label>
								                	<input type="text" class="form-control"  value="<?php echo set_value('username')?>" name="username" required placeholder="Masukan username untuk login agen">
									            </div><!-- /.form-group -->

					        					<div class="form-group">
								                	<label for="login-form-email">Password *</label>
								                	<input type="password" class="form-control" name="password" value="<?php echo set_value('password')?>" required placeholder="Masukan password untuk login agen">
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">NIK *</label>
									                <input type="number" class="form-control" name="nik" value="<?php echo set_value('nik')?>" required placeholder="Masukan nik ktp">
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tempat Lahir *</label>
									                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo set_value('tempat_lahir')?>" required placeholder="Masukan tempat lahir">
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tanggal Lahir *</label>
									                <input type="text" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo set_value('tanggal_lahir')?>" class="institusi form-control" required/ placeholder="Tanggal lahir">
									            </div><!-- /.form-group -->

									          

									            <div class="form-group">
									                <label for="login-form-password">Email *</label>
									                <input type="email" class="form-control" name="email" value="<?php echo set_value('email')?>" required placeholder="Masukan alamat email aktif">
									            </div><!-- /.form-group -->

									               <div class="form-group">
									                <label for="login-form-password">Pekerjaan *</label>
									                <select name="pekerjaan" required class="form-control" >
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($select_pekerjaan as $select_pekerjaan) { ?>
									                		<option value="<?php echo $select_pekerjaan->nama?>" <?php if($this->input->post('pekerjaan')==$select_pekerjaan->nama){echo "selected";} ?> ><?php echo $select_pekerjaan->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									              

									            
					        				</div>

					        				<div class="col-md-6">
								                	<!-- <label for="login-form-email">Kode Agen</label> -->
								                	<input type="hidden" class="form-control" name="kode_agen" value="<?php echo 'HK-'?><?php echo $pass?>" readonly>

					        					<div class="form-group">
								                	<label for="login-form-email">No. HP/WA Aktif *</label> (<small>Contoh : 6281234567890</small>)
								                	<input type="number" class="form-control" name="hp" value="62<?php echo set_value('hp')?>" required>
									            </div>

									            <div class="form-group">
									                <label for="login-form-password">Alamat *</label>
									                <textarea class="form-control" name="alamat" placeholder="Masukan Alamat, Blok, RT, RW, Desa/Kel" required><?php echo set_value('alamat')?></textarea>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									            <label>Provinsi *</label>
						                        <select class="form-control" name="provinsi" id="provinsi" required>
						                            <option value="">-Pilih-</option>
						                            <?php
						                            foreach ($provinsi as $prov) {
						                                ?>
						                                <option <?php echo $provinsi_selected == $prov->id_prov ? 'selected="selected"' : '' ?>
						                                    value="<?php echo $prov->id_prov ?>"><?php echo $prov->nama ?></option>
						                                <?php
						                            }
						                            ?>
						                        </select>
						                    	</div>

						                    	<div class="form-group">
							                        <label>Kota *</label>
							                        <select class="form-control" name="kota" id="kota" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($kota as $kot) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option <?php echo $kota_selected == $kot->id_prov ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $kot->id_prov ?>" value="<?php echo $kot->id_kab ?>" <?php if($this->input->post('kota')==$kot->id_kab){echo "selected";} ?>><?php echo $kot->kab ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>
							                    <div class="form-group">
							                        <label>Kecamatan *</label>
							                        <select class="form-control" name="kecamatan" id="kecamatan" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($kecamatan as $kec) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id kota-->
							                                <option <?php echo $kecamatan_selected == $kec->id_kec ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $kec->id_kab ?>" value="<?php echo $kec->id_kec ?>" <?php if($this->input->post('kecamatan')==$kec->id_kec){echo "selected";} ?>><?php echo $kec->nama ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>


									            <div class="form-group">
									                <label for="login-form-password">Kode Pos</label>
									                <input type="number" class="form-control" name="kode_Pos" value="<?php echo set_value('kode_Pos')?>">
									            </div>

									            <!-- <div class="form-group">
								                	<label for="login-form-email">Facebook</label>
								                	<input type="text" class="form-control" name="facebook" value="<?php echo set_value('facebook')?>">
									            </div>

									            <div class="form-group">
									                <label for="login-form-password">Instagram</label>
									                <input type="text" class="form-control" name="instagram" value="<?php echo set_value('instagram')?>">
									            </div> -->

									            <div class="form-group">
									                <label for="login-form-password">Tempat Kerja</label>
									                <input type="text" class="form-control" name="tempat_kerja" value="<?php echo set_value('tempat_kerja')?>" placeholder="Masukan tempat kerja">
					        					</div>

							                    <div class="form-group">
							                        <label for="exampleInputFile">Scan KTP * <small>(Max ukuran 3 MB)</small> </label>
							                        <input type="file" id="exampleInputFile" name="foto_ktp" value="<?php echo set_value('foto_ktp')?>" required>
							                    </div>

							                     <!-- <div class="form-group">
							                        <label for="exampleInputFile">Scan KK</label>
							                        <input type="file" id="exampleInputFile" name="foto_kk" value="<?php echo set_value('foto_kk')?>" required>
							                    </div> -->

							                    
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



