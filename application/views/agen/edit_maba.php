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
                    	<form method="post" action="<?php echo base_url('agen/edit_proses_maba/'.$detail_maba->id_pendaftaran)?>"  enctype="multipart/form-data">
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        <h2>
			            <b>Edit Data Calon Mahasiswa Baru</b>
			            <a href="<?php echo base_url('agen/profil_maba/'.$detail_maba->id_pendaftaran)?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-backward"></i> Kembali</a><hr></h2>

					        				<div class="col-md-6">
					        					<div class="form-group">
								                	<label for="login-form-email">Nama Lengkap *</label>
								                	<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $detail_maba->nama_lengkap?>" required>
									            </div>

									            <div class="form-group">
									                <label for="login-form-password">Agama *</label>
									                <select name="agama" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($select_agama as $select_agama) { ?>
									                		<option value="<?php echo $select_agama->nama?>" <?php if($detail_maba->agama ==$select_agama->nama){echo "selected";} ?> ><?php echo $select_agama->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									             <div class="form-group">
									                <label for="login-form-password">Jenis Kelamin *</label>
									                <select name="jk" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                		<option value="L" <?php if($detail_maba->jk =='L'){echo "selected";} ?> >Laki-Laki</option>
									                		<option value="P" <?php if($detail_maba->jk =='P'){echo "selected";} ?> >Perempuan</option>
									                </select>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tempat Lahir *</label>
									                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $detail_maba->tempat_lahir?>">
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tanggal Lahir *</label>
									                <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $detail_maba->tanggal_lahir?>" required>
									            </div><!-- /.form-group -->

									            <div class="form-group">
								                	<label for="login-form-email">No. Handphone *</label>
								                	<input type="number" class="form-control" name="hp" value="<?php echo $detail_maba->hp?>" required>
									            </div><!-- /.form-group -->  

									            <div class="form-group">
								                	<label for="login-form-email">Tinggi Badan (cm)</label>
								                	<input type="text" class="form-control" name="tinggi" value="<?php echo $detail_maba->tinggi?>">
									            </div>
					        				</div>

					        				<div class="col-md-6">

					        					 <div class="form-group">
									                <label for="login-form-password">Status *</label>
									                <select name="status_sipil" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($select_sipil as $select_sipil) { ?>
									                		<option value="<?php echo $select_sipil->nama?>" <?php if($detail_maba->status_sipil ==$select_sipil->nama){echo "selected";} ?> ><?php echo $select_sipil->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Alamat *</label>
									                <textarea class="form-control" name="alamat" placeholder="Masukan Alamat, Blok, RT, RW, Desa/Kel" required><?php echo $detail_maba->alamat?></textarea>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									            <label>Provinsi *</label>
						                        <select class="form-control" name="provinsi" id="provinsi" required>
						                            <option value="">-Pilih-</option>
						                            <?php
						                            foreach ($provinsi as $prov) {
						                                ?>
						                                <option <?php echo $provinsi_selected == $prov->id_prov ? 'selected="selected"' : '' ?>
						                                    value="<?php echo $prov->id_prov ?>" <?php if($detail_maba->provinsi == $prov->id_prov ){ echo "selected";}?>><?php echo $prov->nama ?></option>
						                                <?php
						                            }
						                            ?>
						                        </select>
						                    	</div>

						                    	<div class="form-group">
							                        <label>Kota/Kabupaten *</label>
							                        <select class="form-control" name="kota" id="kota" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($kota as $kot) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option <?php echo $kota_selected == $kot->id_prov ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $kot->id_prov ?>" value="<?php echo $kot->id_kab ?>" <?php if($detail_maba->kabupaten == $kot->id_kab ){ echo "selected";}?>><?php echo $kot->kab ?></option>
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
							                                    class="<?php echo $kec->id_kab ?>" value="<?php echo $kec->id_kec ?>" <?php if($detail_maba->kecamatan == $kec->id_kec ){ echo "selected";}?>><?php echo $kec->nama ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>


									            <div class="form-group">
									                <label for="login-form-password">Kode Pos</label>
									                <input type="number" class="form-control" name="kodepos" value="<?php echo $detail_maba->kodepos?>">
									            </div>

									            <div class="form-group">
								                	<label for="login-form-email">Berat Badan (kg)</label>
								                	<input type="text" class="form-control" name="berat" value="<?php echo $detail_maba->berat?>">
									            </div>
					        				</div>

								</div>
							</div>
						</div><!-- /.col-sm-4 -->
						<div class="col-md-1"></div>

						<!-- profil orang tua -->


					</div><!-- /.row -->

					<div class="row">
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        <h2>
			            <b>Edit Data Orang Tua</b><hr></h2>

					        				<div class="col-md-6">
					        					<div class="form-group">
								                	<label for="login-form-email">Nama Ayah *</label>
								                	<input type="text" class="form-control" name="ortu_nama" value="<?php echo $detail_maba->ortu_nama?>" required>
									            </div>

									            <div class="form-group">
								                	<label for="login-form-email">KTP ayah</label>
								                	<input type="number" class="form-control" name="ortu_ktp" value="<?php echo $detail_maba->ortu_ktp?>">
									            </div>

									            <div class="form-group">
									                <label for="login-form-password">Agama Ayah</label>
									                <select name="ortu_agama" class="form-control" >
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($select_agama2 as $select_agama2) { ?>
									                		<option value="<?php echo $select_agama2->nama?>" <?php if($detail_maba->ortu_agama ==$select_agama2->nama){echo "selected";} ?> ><?php echo $select_agama2->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->


									            <div class="form-group">
									                <label for="login-form-password">Umur Ayah (Thn) *</label>
									                <input type="number" class="form-control" name="tempat_lahir" value="<?php echo $detail_maba->tempat_lahir?>" required>
									            </div><!-- /.form-group -->

									             <div class="form-group">
									                <label for="login-form-password">Pendidikan Terakhir Ayah</label>
									                <select name="ortu_pendidikan" class="form-control">
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($pendidikan2 as $pendidikan2) { ?>
									                		<option value="<?php echo $pendidikan2->nama?>" <?php if($detail_maba->ortu_pendidikan ==$pendidikan2->nama){echo "selected";} ?> ><?php echo $pendidikan2->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									             <div class="form-group">
									                <label for="login-form-password">Pekerjaan Ayah *</label>
									                <select name="ortu_pekerjaan" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($pekerjaan2 as $pekerjaan2) { ?>
									                		<option value="<?php echo $pekerjaan2->nama?>" <?php if($detail_maba->ortu_pekerjaan ==$pekerjaan2->nama){echo "selected";} ?> ><?php echo $pekerjaan2->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									             <div class="form-group">
									                <label for="login-form-password">Alamat Tempat Kerja Ayah</label>
									                <textarea class="form-control" name="ortu_alamat_instansi" placeholder="Masukan Alamat Tempat bekerja ayah"><?php echo $detail_maba->ortu_alamat_instansi?></textarea>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Penghasilan Ayah *</label>
									                <select name="ortu_penghasilan" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($penghasilan2 as $penghasilan2) { ?>
									                		<option value="<?php echo $penghasilan2->nama?>" <?php if($detail_maba->ortu_penghasilan ==$penghasilan2->nama){echo "selected";} ?> ><?php echo $penghasilan2->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->
									            

									            <div class="form-group">
								                	<label for="login-form-email">No. Telp Ayah *</label>
								                	<input type="number" class="form-control" name="ortu_hp" value="<?php echo $detail_maba->ortu_hp?>" required>
									            </div><!-- /.form-group --> 


									        </div>
					        				<div class="col-md-6">
					        					<div class="form-group">
								                	<label for="login-form-email">Nama Ibu *</label>
								                	<input type="text" class="form-control" name="ortu_ibu" value="<?php echo $detail_maba->ortu_ibu?>" required>
									            </div>

									            <div class="form-group">
								                	<label for="login-form-email">KTP Ibu</label>
								                	<input type="number" class="form-control" name="ortu_ibu_ktp" value="<?php echo $detail_maba->ortu_ibu_ktp?>" >
									            </div>

									            <div class="form-group">
									                <label for="login-form-password">Agama Ibu *</label>
									                <select name="ortu_ibu_agama" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($select_agama3 as $select_agama3) { ?>
									                		<option value="<?php echo $select_agama3->nama?>" <?php if($detail_maba->ortu_ibu_agama ==$select_agama3->nama){echo "selected";} ?> ><?php echo $select_agama3->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->


									            <div class="form-group">
									                <label for="login-form-password">Umur Ibu (Thn) *</label>
									                <input type="number" class="form-control" name="ortu_ibu_umur" value="<?php echo $detail_maba->ortu_ibu_umur?>" required>
									            </div><!-- /.form-group -->

									             <div class="form-group">
									                <label for="login-form-password">Pendidikan Terakhir Ibu </label>
									                <select name="ortu_ibu_pendidikan" class="form-control">
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($pendidikan as $pendidikan) { ?>
									                		<option value="<?php echo $pendidikan->nama?>" <?php if($detail_maba->ortu_ibu_pendidikan ==$pendidikan->nama){echo "selected";} ?> ><?php echo $pendidikan->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									             <div class="form-group">
									                <label for="login-form-password">Pekerjaan Ibu *</label>
									                <select name="ortu_ibu_pekerjaan" class="form-control" required>
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($pekerjaan as $pekerjaan) { ?>
									                		<option value="<?php echo $pekerjaan->nama?>" <?php if($detail_maba->ortu_ibu_pekerjaan ==$pekerjaan->nama){echo "selected";} ?> ><?php echo $pekerjaan->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Penghasilan Ibu</label>
									                <select name="ortu_ibu_penghasilan" class="form-control">
									                	<option selected disabled>-Pilih-</option>
									                	<?php foreach($penghasilan as $penghasilan) { ?>
									                		<option value="<?php echo $penghasilan->nama?>" <?php if($detail_maba->ortu_ibu_penghasilan ==$penghasilan->nama){echo "selected";} ?> ><?php echo $penghasilan->nama?></option>
									                	<?php }?>
									                </select>
									            </div><!-- /.form-group -->
									            

									            <div class="form-group">
								                	<label for="login-form-email">No. Telp Ibu</label>
								                	<input type="number" class="form-control" name="ortu_ibu_hp" value="<?php echo $detail_maba->ortu_ibu_hp?>" required>
									            </div><!-- /.form-group --> 

									            <div class="form-group">
									                <label for="login-form-password">Alamat Orang Tua</label>
									                <textarea class="form-control" name="ortu_alamat" placeholder="Masukan Alamat, Blok, RT, RW, Desa/Kel, Kec, Kab, Prov, Kode Pos" required><?php echo $detail_maba->ortu_alamat?></textarea>
									            </div><!-- /.form-group -->
					        				</div>

								</div>
							</div>
						</div><!-- /.col-sm-4 -->
						<div class="col-md-1"></div>

						<!-- profil orang tua -->
						
					</div><!-- /.row -->

					<div class="row">
                    	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
				        <h2>
			            <b>Edit Data Sekolah</b><hr></h2>

		        				<div class="col-md-6">
		        					<div class="form-group">
					                	<label for="login-form-email">Nama Sekolah *</label>
					                	<input type="text" class="form-control" name="sekolah_nama" value="<?php echo $detail_maba->sekolah_nama?>" required>
						            </div>

						            <?php if($detail_maba->sekolah_jurusan == 'Lainnya' ) {?>
						            <div class="form-group">
					                	<label for="login-form-email">Jurusan Sekolah</label>
					                	<input type="text" class="form-control" name="sekolah_nama_jurusan" value="<?php echo $detail_maba->sekolah_nama_jurusan?>" required>
					                	<input type="hidden" class="form-control" name="sekolah_jurusan" value="Lainnya" required>
						            </div>
						            <?php }else{ ?>
						            	<div class="form-group">
					                	<label for="login-form-email">Jurusan</label>
					                	<select class="form-control"  name="sekolah_jurusan" required>
					                		<option selected disabled>-Pilih-</option>
					                		<option value="IPA" <?php if($detail_maba->sekolah_jurusan == 'IPA'){echo "selected";} ?>>IPA</option>
					                		<option value="IPS" <?php if($detail_maba->sekolah_jurusan == 'IPS'){echo "selected";} ?>>IPS</option>
					                		<option value="Lainnya" <?php if($detail_maba->sekolah_jurusan == 'Lainnya'){echo "selected";} ?>>Lainnya</option>
					                	</select>
						            </div>
						            <?php }?>

						            
						             <div class="form-group">
						                <label for="login-form-password">Alamat Sekolah</label>
						                <textarea class="form-control" name="sekolah_alamat" placeholder="Masukan Alamat sekolah" required><?php echo $detail_maba->sekolah_alamat?></textarea>
						            </div><!-- /.form-group -->
						        </div>
		        				<div class="col-md-6">
		        					<div class="form-group">
					                	<label for="login-form-email">Tahun Lulus *</label>
					                	<input type="text" class="form-control" name="tahun_lulus" value="<?php echo $detail_maba->tahun_lulus?>" required>
						            </div>

						            <div class="form-group">
					                	<label for="login-form-email">No Ijazah *</label>
					                	<input type="text" class="form-control" name="no_ijazah" value="<?php echo $detail_maba->no_ijazah?>" required>
						            </div>
						            
						              <div class="form-group">
					                	<label for="login-form-email">Nilai Ijazah *</label>
					                	<input type="text" class="form-control" name="nilai_ijazah" value="<?php echo $detail_maba->nilai_ijazah?>" required>
						            </div>
								</div>
							</div>
							
						</div><!-- /.col-sm-4 -->
						</div>
						<div class="col-md-1"></div>

						<!-- profil orang tua -->
						<div class="col-md-12"><center><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan Perubahan</button></center></div>

					</form>
					</div><!-- /.row -->

                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->


<?php echo form_close()?>



