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
			            	<a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-right"><i class="fa fa-backward"></i> Kembali</a><br>
			            	<h1 align="center"><b>Pernah Daftar di HayuKuliah</b></h1>
			            	<center><i><small class="text-center">Jika belum pernah daftar <b><a href="<?php echo base_url('maba/register')?>">klik disini</a></b></i></small></center>
					   </div>
					   </div>
					   </div>
					    <div class="col-md-1"></div>
					  </div>

					   <div class="row">
                	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
			            	<form action="<?php echo base_url('agen/pernah_daftar/') ?>" method="post" class="form-inline text-center">
							
							<div class="form-group">
							  <label><b>Cari data disini dengan memasukan nomer NISN</b></label><br>
						      <input type="text" name="nisn" class="form-control" id="exampleInputName2" placeholder="Masukan nomer NISN" required="">
						      <button  type="submit" name="submit" style="border-radius: 5px" class="btn btn-primary"><b>Cek</b></button>
						    </div>
						    </form>
					   </div>
					   </div>
					   </div>
					    <div class="col-md-1"></div>
					   </div>

					 <?php 
					 if($submit){?>
					 <?php if(!empty($nisn->nisn)){ ?>
			        <form action="<?php echo base_url('agen/tambah_pernah_daftar/') ?>" method="post" >
					<div class="row">
                	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
			            	<h3 align="center"><b>Silahkan lengkapi data untuk mendaftar</b></h3><hr>
			            	<div class="col-md-6">
					        					<div class="form-group">
									            <label>Perguruan Tinggi</label>
						                        <select class="form-control" name="institusi" id="institusi" required>
						                            <option value="">-Pilih-</option>
						                            <?php
						                            foreach ($institusi as $institusi) {
						                                ?>
						                                <option <?php echo $institusi_selected == $institusi->id_institusi ? 'selected="selected"' : '' ?>
						                                    value="<?php echo $institusi->id_institusi ?>" <?php if($this->input->post('institusi') == $institusi->id_institusi){echo "selected";} ?> ><b><?php echo $institusi->nama ?></b></option>
						                                <?php
						                            }
						                            ?>
						                        </select>
						                    	</div>

						                    	<div class="form-group">
							                        <label>Jenis Pendaftaran</label>
							                        <select class="form-control" name="jenis_daftar" required >
							                            <option selected disabled>-Pilih-</option>
							                            <?php
							                            foreach ($jenis_daftar as $jenis_daftar) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option  value="<?php echo $jenis_daftar->kode ?>" <?php if($nisn->jenis_daftar == $jenis_daftar->kode){echo "selected";} ?> ><?php echo $jenis_daftar->jenis_daftar ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>

							                    <div class="form-group">
							                        <label>Program Kuliah</label>
							                        <select class="form-control" name="program" id="program" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($program as $program) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option <?php echo $program_selected == $program->id_institusi ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $program->id_institusi ?>" value="<?php echo $program->program ?>" <?php if($this->input->post('program') == $program->program){echo "selected";} ?> ><?php echo $program->program ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>


						                    	<div class="form-group">
							                        <label>Pilihan Pertama</label>
							                        <select class="form-control" name="pilihan1" id="jurusan" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($jurusan as $jur) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option <?php echo $jurusan_selected == $jur->id_institusi ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $jur->id_institusi ?>" value="<?php echo $jur->id_jurusan ?>" <?php if($this->input->post('pilihan1') == $jur->id_jurusan){echo "selected";} ?>><?php echo $jur->jurusan ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>

							                    <div class="form-group">
							                        <label>Pilihan Kedua</label>
							                        <select class="form-control" name="pilihan2" id="jurusan2">
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($jurusan2 as $jur) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id provinsi-->
							                                <option <?php echo $jurusan2_selected == $jur->id_institusi ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $jur->id_institusi ?>" value="<?php echo $jur->jurusan ?>" <?php if($this->input->post('pilihan2') == $jur->jurusan){echo "selected";} ?> ><?php echo $jur->jurusan ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>


							                    <div class="form-group">
							                        <label>Gelombang</label>
							                        <select class="form-control" name="gelombang" id="gelombang" required>
							                            <option value="">-Pilih-</option>
							                            <?php
							                            foreach ($gelombang as $gel) {
							                                ?>
							                                <!--di sini kita tambahkan class berisi id kota-->
							                                <option <?php echo $gelombang_selected == $gel->id_gelombang ? 'selected="selected"' : '' ?>
							                                    class="<?php echo $gel->id_jurusan ?>" value="<?php echo $gel->id_gelombang ?>" <?php if($this->input->post('gelombang') == $gel->id_gelombang){echo "selected";} ?> ><?php echo $gel->gelombang ?></option>
							                                <?php
							                            }
							                            ?>
							                        </select>
							                    </div>

							                    <div class="form-group">
									                <label for="login-form-password">Tempat Lahir</label>
									                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $nisn->tempat_lahir ?>" placeholder="Masukan tempat lahir" readonly>
									            </div><!-- /.form-group -->

									            <div class="form-group">
									                <label for="login-form-password">Tanggal Lahir</label>
									                <input type="text" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $nisn->tanggal_lahir?>" class="institusi form-control" placeholder="Masukan tanggal lahir" readonly/>
									            </div><!-- /.form-group -->
									            
					        				</div>

					        				<div class="col-md-6">

									            <div class="form-group">
									                <label for="login-form-password">Email</label>
									                <input type="email" class="form-control" name="email" value="<?php echo set_value('email')?>" placeholder="Masukan alamat email baru yang aktif" required>
									            </div><!-- /.form-group -->

					        					<div class="form-group">
								                	<label for="login-form-email">Password</label>
								                	<input type="password" class="form-control" name="password" value="<?php echo set_value('password')?>" placeholder="Masukan password" required>
									            </div><!-- /.form-group -->

					        				<div class="form-group">
								                	<label for="login-form-email">Nama Lengkap</label>
								                	<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $nisn->nama_lengkap?>" placeholder="Masukan nama lengkap" readonly>
									            </div><!-- /.form-group -->

									            <div class="form-group">
								                	<label for="login-form-email">NISN</label>
								                	<input type="number" class="form-control" name="nisn" value="<?php echo $nisn->nisn?>" placeholder="Masukan nomer NISN" readonly>
									            </div><!-- /.form-group -->

									            <div class="form-group">
								                	<label for="login-form-email">Asal Sekolah</label>
								                	<input type="text" class="form-control" name="sekolah_nama" value="<?php echo $nisn->sekolah_nama?>" placeholder="Masukan Asal sekolah" readonly>
									            </div><!-- /.form-group -->

					        					<div class="form-group">
								                	<label for="login-form-email">Jurusan Sekolah</label>
								                	<select class="form-control"  name="sekolah_jurusan" id="sekolah_jurusan" readonly>
								                		<option value="<?php echo $nisn->sekolah_jurusan?>" ><?php echo $nisn->sekolah_jurusan?></option>
								                	</select>
									            </div><!-- /.form-group -->

									            <?php if($nisn->sekolah_jurusan == 'IPA' || $nisn->sekolah_jurusan == 'IPS') { ?>
									            <div class="form-group">
									             	<label for="login-form-email">Jurusan Lainya </label>
								                	<input type="text" class="form-control" name="sekolah_nama_jurusan" value="<?php $nisn->sekolah_nama_jurusan?>" readonly>
							                    </div>
							                	<?php }else{ ?>
									             <div class="form-group">
									             	<label for="login-form-email">Jurusan Lainya </label>
								                	<input type="text" class="form-control" name="sekolah_nama_jurusan" value="<?php echo $nisn->sekolah_nama_jurusan?>" readonly>
							                    </div>
							                	<?php } ?>

									            <div class="form-group">
								                	<label for="login-form-email">No. Handphone</label>
								                	<input type="number" class="form-control" name="hp" value="<?php echo $nisn->hp?>" placeholder="Masukan nomer telepon" readonly>
									            </div><!-- /.form-group -->
									            
									            <input type="hidden" name="jk" value="<?php echo $nisn->jk?>">
					        					<input type="hidden" name="agama" value="<?php echo $nisn->agama?>">
									            <input type="hidden" name="status_sipil" value="<?php echo $nisn->status_sipil?>">
									            <input type="hidden" name="alamat" value="<?php echo $nisn->alamat?>">
									            <input type="hidden" name="kecamatan" value="<?php echo $nisn->kecamatan?>">
					        					<input type="hidden" name="kabupaten" value="<?php echo $nisn->kabupaten?>">
									            <input type="hidden" name="provinsi" value="<?php echo $nisn->provinsi?>">
									            <input type="hidden" name="kodepos" value="<?php echo $nisn->kodepos?>">

									            <input type="hidden" name="ortu_nama" value="<?php echo $nisn->ortu_nama?>">
					        					<input type="hidden" name="ortu_umur" value="<?php echo $nisn->ortu_umur?>">
									            <input type="hidden" name="ortu_agama" value="<?php echo $nisn->ortu_agama?>">
									            <input type="hidden" name="ortu_ktp" value="<?php echo $nisn->ortu_ktp?>">
									            <input type="hidden" name="ortu_pendidikan" value="<?php echo $nisn->ortu_pendidikan?>">
					        					<input type="hidden" name="ortu_hp" value="<?php echo $nisn->ortu_hp?>">
					        					<input type="hidden" name="ortu_instansi" value="<?php echo $nisn->ortu_instansi?>">
									            <input type="hidden" name="ortu_pekerjaan" value="<?php echo $nisn->ortu_pekerjaan?>">
									            <input type="hidden" name="ortu_penghasilan" value="<?php echo $nisn->ortu_penghasilan?>">
									            <input type="hidden" name="ortu_alamat_instansi" value="<?php echo $nisn->ortu_alamat_instansi?>">

					        					<input type="hidden" name="ortu_ibu" value="<?php echo $nisn->ortu_ibu?>">
									            <input type="hidden" name="ortu_ibu_umur" value="<?php echo $nisn->ortu_ibu_umur?>">
									            <input type="hidden" name="ortu_ibu_agama" value="<?php echo $nisn->ortu_ibu_agama?>">
									            <input type="hidden" name="ortu_ibu_ktp" value="<?php echo $nisn->ortu_ibu_ktp?>">
					        					<input type="hidden" name="ortu_ibu_pendidikan" value="<?php echo $nisn->ortu_ibu_pendidikan?>">
									            <input type="hidden" name="ortu_ibu_pekerjaan" value="<?php echo $nisn->ortu_ibu_pekerjaan?>">
									            <input type="hidden" name="ortu_ibu_penghasilan" value="<?php echo $nisn->ortu_ibu_penghasilan?>">
									            <input type="hidden" name="ortu_ibu_hp" value="<?php echo $nisn->ortu_ibu_hp?>">

					        					<input type="hidden" name="ortu_alamat" value="<?php echo $nisn->ortu_alamat?>">
												<input type="hidden" name="sekolah_alamat" value="<?php echo $nisn->sekolah_alamat?>">
									             <input type="hidden" name="tahun_lulus" value="<?php echo $nisn->tahun_lulus?>">
									             <input type="hidden" name="no_ijazah" value="<?php echo $nisn->no_ijazah?>">
									            <input type="hidden" name="nilai_ijazah" value="<?php echo $nisn->nilai_ijazah?>">
					        					<input type="hidden" name="tinggi" value="<?php echo $nisn->tinggi?>">
									            <input type="hidden" name="berat" value="<?php echo $nisn->berat?>">
									            <input type="hidden" name="ktp" value="<?php echo $nisn->ktp?>">

									            <input type="hidden" name="pindahan_status" value="<?php echo $nisn->pindahan_status?>">
									             <input type="hidden" name="pindahan_namapt" value="<?php echo $nisn->pindahan_namapt?>">
									            <input type="hidden" name="pindahan_fakultas" value="<?php echo $nisn->pindahan_fakultas?>">
					        					<input type="hidden" name="pindahan_prodi" value="<?php echo $nisn->pindahan_prodi?>">
									            <input type="hidden" name="pindahan_nim" value="<?php echo $nisn->pindahan_nim?>">
									            <input type="hidden" name="pindahan_jumlahsks" value="<?php echo $nisn->pindahan_jumlahsks?>">

					        				</div>
									            
					        			
					   				</div>
					   		</div>
					   </div>
					    <div class="col-md-1"></div><hr>

					  <div class="col-md-12"><center><button style="border-radius: 5px;" type="submit" class="btn btn-primary">Daftar</button></center></div>
					  </div>
					  </form>
					 <?php }else{ ?>
					 	<div class="row">
                	<div class="col-md-1"></div>
					    <div class="col-md-10">
                		<div class="panel panel-info">
                		<div class="panel-body">
			            	<h3 align="center"><b>NISN Belum Terdaftar</b></h3>
					   </div>
					   </div>
					   </div>
					    <div class="col-md-1"></div>
					  </div>
					 <?php }} ?>

                    

                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->


<?php echo form_close()?>





