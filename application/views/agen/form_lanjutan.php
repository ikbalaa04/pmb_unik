    <section class="portfolio-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center"><br>
          	<a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a>
            <h3 class="title-a"><br>
              Formulir Pengisian Data Lanjutan 
            </h3>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <form action="<?php echo base_url('agen/form_selanjutnya/'.$detail->popup)?>" method="post" >
      <div class="row">
        <div class="col-md-12">
            <?php
              echo validation_errors('<div class="alert alert-warning">','</div>');

              if($this->session->flashdata('warning')){
                echo '<div class="alert alert-warning">';
                echo $this->session->flashdata('warning');
                echo '</div>';
              } 
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success">';
                echo $this->session->flashdata('success');
                echo '</div>';
              }  

            ?>
        <div class="card text-black"> 
        <div class="card-header bg-default">
        <div class="table-container">
          <div class="table-responsive" >
            <div class="row">
            <div class="col-md-6">
              <?php if($detail->jenis=='MB') { ?>
				<?php if($detail->jenjang=='S2' || $detail->jenjang=='S3' || $detail->jenjang=='Profesi') { ?>
					<label class=" ">Asal Sekolah</label>
						<div class="">
						<?php if($detail->sekolah_nama!=''){?>
						<input type="text" name="sekolah_nama" class="form-control" value="<?php echo $detail->sekolah_nama ?>">
						<?php }else{?>
						<input type="text" name="sekolah_nama" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_nama') ?>">
						<?php }?>
					</div>

					<div class="form-group">
						<label class="control-label">Asal Jurusan</label>
						<div class="">
							<?php if($detail->sekolah_jurusan!=''){?>
							<input style="text-transform: capitalize;" type="text" name="sekolah_jurusan" class="form-control" value="<?php echo $detail->sekolah_jurusan ?>">
							<?php }else{?>
							<input style="text-transform: capitalize;" type="text" name="sekolah_jurusan" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_jurusan') ?>">
							<?php }?>
						</div>
					</div>

					<label class="  ">IPK</label>
					<div class=" ">
						<?php if($detail->ipk!=''){?>
						<input type="text" name="ipk" class="form-control" value="<?php echo $detail->ipk ?>">
						<?php }else{?>
						<input type="text" name="ipk" class="form-control"  value="<?php echo $this->input->post('ipk') ?>">
						<?php }?>
					</div>
				<?php }else{ ?>

				 
					<label class="  ">NISN</label>
					<div class=" ">
						<?php if($detail->nisn!=''){?>
						<input type="number" name="nisn" class="form-control"  value="<?php echo $detail->nisn ?>">
						<?php }else{?>
						<input type="number" name="nisn" class="form-control"  value="<?php echo $this->input->post('nisn') ?>">
						<?php }?>
						
					</div>

				 
					<label class="  ">Asal Sekolah</label>
					<div class=" ">
						<?php if($detail->sekolah_nama!=''){?>
						<input type="text" name="sekolah_nama" class="form-control" value="<?php echo $detail->sekolah_nama ?>">
						<?php }else{?>
						<input type="text" name="sekolah_nama" class="form-control"  value="<?php echo $this->input->post('sekolah_nama') ?>">
						<?php }?>
					</div>

				 
					<div class="form-group">
						<label class=" control-label">Asal Jurusan</label>
						<div class="">
							<?php if($detail->sekolah_jurusan!=''){?>
							<input style="text-transform: capitalize;" type="text" name="sekolah_jurusan" class="form-control" value="<?php echo $detail->sekolah_jurusan ?>">
							<?php }else{?>
							<input style="text-transform: capitalize;" type="text" name="sekolah_jurusan" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_jurusan') ?>">
							<?php }?>
						</div>
					</div>

				 
					<label class="  ">Nilai Ijazah</label>
					<div class=" ">
						<?php if($detail->nilai_ijazah!=''){?>
						<input type="text" name="nilai_ijazah" class="form-control"  value="<?php echo $detail->nilai_ijazah ?>">
						<?php }else{?>
						<input type="text" name="nilai_ijazah" class="form-control"  value="<?php echo $this->input->post('nilai_ijazah') ?>">
						<?php }?>
					</div>
				<?php } ?>

				 
					<label class="  ">Tahun Lulus</label>
					<div class=" ">
						<?php if($detail->tahun_lulus!=''){?>
						<input type="number" name="tahun_lulus" class="form-control"  value="<?php echo $detail->tahun_lulus ?>">
						<?php }else{?>
						<input type="number" name="tahun_lulus" class="form-control"  value="<?php echo $this->input->post('tahun_lulus') ?>">
						<?php }?>
						
					</div>
				 
					<label class="  ">Nomor Ijazah</label>
					<div class=" ">
						<?php if($detail->no_ijazah!=''){?>
						<input type="text" name="no_ijazah" class="form-control"  value="<?php echo $detail->no_ijazah ?>">
						<?php }else{?>
						<input type="text" name="no_ijazah" class="form-control"  value="<?php echo $this->input->post('no_ijazah') ?>">
						<?php }?>
						
					</div>

				<?php }else{ ?>

				 
					<label class="  ">Status Pindahan Dari Perguruan Tinggi Sebelumnya</label>
					<div class=" ">
						<select name="pindahan_status" class="form-control">
							<option value="">-Pilih-</option>
							<?php if($detail->pindahan_status!=''){?>
							<option value="1" <?php if($detail->pindahan_status == '1'){echo "selected";} ?>>Diperbolehkan</option>
							<option value="0" <?php if($detail->pindahan_status == '0'){echo "selected";} ?>>Ditolak</option>
							<?php }else{?>
							<option value="1" <?php if($this->input->post('pindahan_status') == '1'){echo "selected";} ?>>Diperbolehkan</option>
							<option value="0" <?php if($this->input->post('pindahan_status') == '0'){echo "selected";} ?>>Ditolak</option>
							<?php }?>
						</select>
					</div>

				 
					<label class="  ">Asal Kampus</label>
					<div class=" ">
						<?php if($detail->pindahan_namapt!=''){?>
						<input type="text" name="pindahan_namapt" class="form-control"  value="<?php echo $detail->pindahan_namapt ?>">
						<?php }else{?>
						<input type="text" name="pindahan_namapt" class="form-control"  value="<?php echo $this->input->post('pindahan_namapt') ?>">
						<?php }?>
						
					</div>

				 
					<label class="  ">Asal Fakultas <small>(Jika tidak ada isi dengan '-')</small></label>
					<div class=" ">
						<?php if($detail->pindahan_fakultas!=''){?>
						<input type="text" name="pindahan_fakultas" class="form-control"  value="<?php echo $detail->pindahan_fakultas ?>">
						<?php }else{?>
						<input type="text" name="pindahan_fakultas" class="form-control"  value="<?php echo $this->input->post('pindahan_fakultas') ?>">
						<?php }?>
						
					</div>
				 
					<label class="  ">Asal Program Studi</label>
					<div class=" ">
						<?php if($detail->pindahan_prodi!=''){?>
						<input type="text" name="pindahan_prodi" class="form-control"  value="<?php echo $detail->pindahan_prodi ?>">
						<?php }else{?>
						<input type="text" name="pindahan_prodi" class="form-control"  value="<?php echo $this->input->post('pindahan_prodi') ?>">
						<?php }?>
						
					</div>

				 
					<label class="  ">NIM</label>
					<div class=" ">
						<?php if($detail->pindahan_nim!=''){?>
						<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $detail->pindahan_nim ?>">
						<?php }else{?>
						<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $this->input->post('pindahan_nim') ?>">
						<?php }?>
						
					</div>
				 
					<label class="  ">Jumlah SKS</label>
					<div class=" ">
						<?php if($detail->pindahan_jumlahsks!=''){?>
						<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $detail->pindahan_jumlahsks ?>">
						<?php }else{?>
						<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $this->input->post('pindahan_jumlahsks') ?>">
						<?php }?>
						
					</div>

				<?php } ?>

					<label class="  ">Alamat</label>
					<div class=" ">
						<?php if($detail->alamat==''){?>
						<textarea name="alamat" class="form-control" ><?php echo set_value('alamat') ?></textarea>
						<?php }else{?>
						<textarea name="alamat" class="form-control" ><?php echo $detail->alamat?></textarea>
						<?php } ?>
					</div>

				 
					<label class="  ">Nomer Handphoe / WA</label>
					<div class=" ">
						<?php if($detail->hp==''){?>
						<input type="number" name="hp" class="form-control" value="<?php echo set_value('hp') ?>" >
						<?php }else{?>
						<input type="number" name="hp" class="form-control"  value="<?php echo $detail->hp ?>">
						<?php } ?>
					</div>

              </div>

              <div class="col-md-6">

              		<label class="">NIK</label>
					<div class=" ">
						<?php if($detail->nik==''){?>
						<input type="text" name="nik" class="form-control" value="<?php echo set_value('nik') ?>" >
						<?php }else{?>
						<input type="text" name="nik" class="form-control"  value="<?php echo $detail->nik ?>">
						<?php } ?>
					</div>

				  
					<label class="  ">Nama Lengkap</label>
					<div class=" ">
						<?php if($detail->nama_lengkap==''){?>
						<input type="text" name="nama_lengkap" class="form-control" value="<?php echo set_value('nama_lengkap') ?>" >
						<?php }else{?>
						<input type="text" name="nama_lengkap" class="form-control"  value="<?php echo $detail->nama_lengkap ?>">
						<?php } ?>
					</div>

				 
					<label class="  ">Tempat Lahir</label>
					<div class=" ">
						<?php if($detail->tempat_lahir==''){?>
						<input type="text" name="tempat_lahir" class="form-control" value="<?php echo set_value('tempat_lahir') ?>" >
						<?php }else{?>
						<input type="text" name="tempat_lahir" class="form-control"  value="<?php echo $detail->tempat_lahir ?>">
						<?php } ?>
					</div>

				 
					<label class="  ">Tanggal Lahir</label>
					<div class=" ">
						<?php if($detail->tanggal_lahir==''){?>
						<input type="text" id="tanggal" name="tanggal_lahir" class="form-control" value="<?php echo set_value('tanggal_lahir') ?>" >
						<?php }else{?>
						<input type="text" id="tanggal" name="tanggal_lahir" class="form-control"  value="<?php echo $detail->tanggal_lahir ?>">
						<?php } ?>
					</div>

				  
					<label class="  ">Email</label>
					<div class=" ">
						<?php if($detail->email==''){?>
						<input type="email" name="email" class="form-control" value="<?php echo set_value('email') ?>" >
						<?php }else{?>
						<input type="email" name="email" class="form-control"  value="<?php echo $detail->email ?>">
						<?php } ?>
					</div>

				 
					<label class="  ">Jenis Kelamin</label>
					<div class=" ">
						<select name="jk" class="form-control">
							<option value="">-Pilih-</option>
							<option value="L" <?php if($detail->jk == 'L'){echo "selected";}elseif($this->input->post('jk')=='L'){echo "selected";} ?>>Laki-laki</option>
							<option value="P" <?php if($detail->jk == 'P'){echo "selected";}elseif($this->input->post('jk')=='P'){echo "selected";} ?>>Perempuan</option>
						</select>
					</div>

				 
					<label class="  ">Agama</label>
					<div class=" ">
						<select name="agama" class="form-control">
							<option value="">-Pilih-</option>
							<option value="Islam" <?php if($detail->agama == 'Islam'){echo "selected";}elseif($this->input->post('agama')=='Islam'){echo "selected";} ?>>Islam</option>
							<option value="Hindu" <?php if($detail->agama == 'Hindu'){echo "selected";}elseif($this->input->post('agama')=='Hindu'){echo "selected";} ?>>Hindu</option>
							<option value="Budha" <?php if($detail->agama == 'Budha'){echo "selected";}elseif($this->input->post('agama')=='Budha'){echo "selected";} ?>>Budha</option>
							<option value="Katolik" <?php if($detail->agama == 'Katolik'){echo "selected";}elseif($this->input->post('agama')=='Katolik'){echo "selected";} ?>>Katolik</option>
							<option value="Kristen" <?php if($detail->agama == 'Kristen'){echo "selected";}elseif($this->input->post('agama')=='Kristen'){echo "selected";} ?>>Kristen</option>
							<option value="Lain-Lain" <?php if($detail->agama == 'Lain-Lain'){echo "selected";}elseif($this->input->post('agama')=='Lain-Lain'){echo "selected";} ?>>Lain-Lain</option>
						</select>
					</div>


				 
					<label class="  ">Kewarganegaraan</label>
					<div class=" ">
						<select name="kewarganegaraan" class="form-control">
							<option value="">-Pilih-</option>
							<option value="WNA" <?php if($detail->kewarganegaraan == 'WNA'){echo "selected";}elseif($this->input->post('kewarganegaraan')=='WNA'){echo "selected";} ?>>WNA</option>
							<option value="WNI" <?php if($detail->kewarganegaraan == 'WNI'){echo "selected";}elseif($this->input->post('kewarganegaraan')=='WNI'){echo "selected";} ?>>WNI</option>
						</select>
					</div>

				 
					<label class="  ">Status</label>
					<div class=" ">
						<select name="status_sipil" class="form-control">
							<option value="">-Pilih-</option>
							<option value="Belum Menikah" <?php if($detail->status_sipil == 'Belum Menikah'){echo "selected";}elseif($this->input->post('status_sipil')=='Belum Menikah'){echo "selected";} ?>>Belum Menikah</option>
							<option value="Menikah" <?php if($detail->status_sipil == 'Menikah'){echo "selected";}elseif($this->input->post('status_sipil')=='Menikah'){echo "selected";} ?>>Menikah</option>
							<option value="Duda" <?php if($detail->status_sipil == 'Duda'){echo "selected";}elseif($this->input->post('status_sipil')=='Duda'){echo "selected";} ?>>Duda</option>
							<option value="Janda" <?php if($detail->status_sipil == 'Janda'){echo "selected";}elseif($this->input->post('status_sipil')=='Janda'){echo "selected";} ?>>Janda</option>
						</select>
					</div>

              </div>

              <div class="col-md-12"><hr></div>
			<div class="col-md-12"><center><h2><b>Data Orang Tua</b></h2></center></div>
			<div class="col-md-12"><hr></div>
			<div class="col-md-6">
			<div class="form-group">
				<label class="  control-label">Nama Ayah</label>
				<div class="  ">
					<?php $ortu_nama = explode(",", $detail->ortu_nama ); ?>
					<input type="text" name="ortu_nama[0]" class="form-control" value="<?php echo $ortu_nama[0] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Tempat Lahir Ayah</label>
				<div class="  ">
					<?php $ortu_tempat_lahir = explode("|", $detail->ortu_tempat_lahir ); ?>
					<input type="text" name="ortu_tempat_lahir[0]" class="form-control" value="<?php echo $ortu_tempat_lahir[0] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Tanggal Ayah</label>
				<div class="  ">
					<?php $ortu_tgl_lahir = explode("|", $detail->ortu_tgl_lahir ); ?>
					<input type="date" id="tanggal" name="ortu_tgl_lahir[0]" class="form-control" value="<?php echo $ortu_tgl_lahir[0] ?>" >
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Agama Ayah</label>
				<div class="  ">
					<?php $agama_ortu = explode(",", $detail->ortu_agama); ?>
					<select name="ortu_agama[0]" class="form-control" required="">
						<option value="-">-Pilih-</option>
						<option value="Islam" <?php if($agama_ortu[0]=="Islam"){echo "selected";} ?>>Islam</option>
						<option value="Hindu" <?php if($agama_ortu[0]=="Hindu"){echo "selected";} ?>>Hindu</option>
						<option value="Budha" <?php if($agama_ortu[0]=="Budha"){echo "selected";} ?>>Budha</option>
						<option value="Katolik" <?php if($agama_ortu[0]=="Katolik"){echo "selected";} ?>>Katolik</option>
						<option value="Kristen" <?php if($agama_ortu[0]=="Kristen"){echo "selected";} ?>>Kristen</option>
						<option value="Lain-Lain" <?php if($agama_ortu[0]=="Lain-Lain"){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Pendidikan Terakhir Ayah</label>
				<div class="  ">
					<?php $pendidikan_ortu = explode(",", $detail->ortu_pendidikan); ?>
					<select name="ortu_pendidikan[0]" class="form-control" required="">
						<option value="-">-Pilih-</option>
						<option value="S3" <?php if($pendidikan_ortu[0] == "S3"){echo "selected";} ?>>S-3</option>
						<option value="S2" <?php if($pendidikan_ortu[0] == "S2"){echo "selected";} ?>>S-2</option>
						<option value="S1" <?php if($pendidikan_ortu[0] == "S1"){echo "selected";} ?>>S-1</option>
						<option value="D4" <?php if($pendidikan_ortu[0] == "D4"){echo "selected";} ?>>D-4</option>
						<option value="D3" <?php if($pendidikan_ortu[0] == "D3"){echo "selected";} ?>>D-3</option>
						<option value="D2" <?php if($pendidikan_ortu[0] == "D2"){echo "selected";} ?>>D-2</option>
						<option value="D1" <?php if($pendidikan_ortu[0] == "D1"){echo "selected";} ?>>D-1</option>
						<option value="Profesi" <?php if($pendidikan_ortu[0] == "Profesi"){echo "selected";} ?>>Profesi</option>
						<option value="SMA" <?php if($pendidikan_ortu[0] == "SMA"){echo "selected";} ?>>SMA/SMK Sederajat</option>
						<option value="SMP" <?php if($pendidikan_ortu[0] == "SMP"){echo "selected";} ?>>SMP</option>
						<option value="SD" <?php if($pendidikan_ortu[0] == "SD"){echo "selected";} ?>>SD</option>
						<option value="TTS" <?php if($pendidikan_ortu[0] == "TTS"){echo "selected";} ?>>Tidak Tamat SD</option>
						<option value="NA" <?php if($pendidikan_ortu[0] == "NA"){echo "selected";} ?>>Non Akademik</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">No. HP Ayah</label>
				<div class="  ">
					<?php $hp_ortu = explode(",", $detail->ortu_hp); ?>
					<input type="number" name="ortu_hp[0]" class="form-control" value="<?php echo $hp_ortu[0] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Pekerjaan Ayah</label>
				<div class="  ">
					<?php $pekerjaan_ortu = explode(",", $detail->ortu_pekerjaan); ?>
					<input type="text" name="ortu_pekerjaan[0]" class="form-control" value="<?php echo $pekerjaan_ortu[0]  ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Penghasilan Ayah</label>
				<div class="  ">
				<?php $penghasilan = explode(",", $detail->ortu_penghasilan ); ?>
				<select name="ortu_penghasilan[0]" class="form-control" required="">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan[0] == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
			            <?php } ?>
			        </select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Alamat Orang Tua</label>
				<?php $ortu_alamat = explode("|", $detail->ortu_alamat ); ?>
				<div class="  ">
					<textarea class="form-control" name="ortu_alamat[0]" required=""><?php echo $ortu_alamat[0]?></textarea>
				</div>
			</div>

			</div>

			<div class="col-md-6">
			<div class="form-group">
				<label class="  control-label">Nama Ibu</label>
				<div class="  ">
					<input type="text" name="ortu_nama[1]" class="form-control" value="<?php echo $ortu_nama[1] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Tempat Lahir Ibu</label>
				<div class="  ">
					<input type="text" name="ortu_tempat_lahir[1]" class="form-control" value="<?php echo $ortu_tempat_lahir[1] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Tanggal Lahir Ibu</label>
				<div class="  ">
					<input type="date" id="tanggal2"  name="ortu_tgl_lahir[1]" class="form-control" value="<?php echo $ortu_tgl_lahir[1] ?>" >
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Agama Ibu</label>
				<div class="  ">
					<select name="ortu_agama[1]" class="form-control" required="">
						<option value="-">-Pilih-</option>
						<option value="Islam" <?php if($agama_ortu[1]=="Islam"){echo "selected";} ?>>Islam</option>
						<option value="Hindu" <?php if($agama_ortu[1]=="Hindu"){echo "selected";} ?>>Hindu</option>
						<option value="Budha" <?php if($agama_ortu[1]=="Budha"){echo "selected";} ?>>Budha</option>
						<option value="Katolik" <?php if($agama_ortu[1]=="Katolik"){echo "selected";} ?>>Katolik</option>
						<option value="Kristen" <?php if($agama_ortu[1]=="Kristen"){echo "selected";} ?>>Kristen</option>
						<option value="Lain-Lain" <?php if($agama_ortu[1]=="Lain-Lain"){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Pendidikan Terakhir Ibu</label>
				<div class="  ">
					<select name="ortu_pendidikan[1]" class="form-control" required="">
						<option value="-">-Pilih-</option>
						<option value="S3" <?php if($pendidikan_ortu[1] == "S3"){echo "selected";} ?>>S-3</option>
						<option value="S2" <?php if($pendidikan_ortu[1] == "S2"){echo "selected";} ?>>S-2</option>
						<option value="S1" <?php if($pendidikan_ortu[1] == "S1"){echo "selected";} ?>>S-1</option>
						<option value="D4" <?php if($pendidikan_ortu[1] == "D4"){echo "selected";} ?>>D-4</option>
						<option value="D3" <?php if($pendidikan_ortu[1] == "D3"){echo "selected";} ?>>D-3</option>
						<option value="D2" <?php if($pendidikan_ortu[1] == "D2"){echo "selected";} ?>>D-2</option>
						<option value="D1" <?php if($pendidikan_ortu[1] == "D1"){echo "selected";} ?>>D-1</option>
						<option value="Profesi" <?php if($pendidikan_ortu[1] == "Profesi"){echo "selected";} ?>>Profesi</option>
						<option value="SMA" <?php if($pendidikan_ortu[1] == "SMA"){echo "selected";} ?>>SMA/SMK Sederajat</option>
						<option value="SMP" <?php if($pendidikan_ortu[1] == "SMP"){echo "selected";} ?>>SMP</option>
						<option value="SD" <?php if($pendidikan_ortu[1] == "SD"){echo "selected";} ?>>SD</option>
						<option value="TTS" <?php if($pendidikan_ortu[1] == "TTS"){echo "selected";} ?>>Tidak Tamat SD</option>
						<option value="NA" <?php if($pendidikan_ortu[1] == "NA"){echo "selected";} ?>>Non Akademik</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">No. HP Ibu</label>
				<div class="  ">
					<input type="number" name="ortu_hp[1]" class="form-control" value="<?php echo $hp_ortu[1] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Pekerjaan Ibu</label>
				<div class="  ">
					<input type="text" name="ortu_pekerjaan[1]" class="form-control" value="<?php echo $pekerjaan_ortu[1]  ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Penghasilan Ibu</label>
				<div class="  ">
				<select name="ortu_penghasilan[1]" class="form-control" required="">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan1 as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan[1] == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
			            <?php } ?>
			        </select>
				</div>
			</div>
			</div>

			<div class="col-md-12"><hr></div>
			<div class="col-md-12"><center><h2><b>Data Wali</b></h2></center></div>
			<div class="col-md-12"><hr></div>
			<div class="col-md-6">
			<div class="form-group">
				<label class="  control-label">Nama Wali</label>
				<div class="  ">
					<input type="text" name="ortu_nama[2]" class="form-control" value="<?php echo $ortu_nama[2] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Tempat Lahir Wali</label>
				<div class="  ">
					<input type="text" name="ortu_tempat_lahir[2]" class="form-control" value="<?php echo $ortu_tempat_lahir[2] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Tanggal Lahir Wali</label>
				<div class="  ">
					<input type="date" id="tanggal3" name="ortu_tgl_lahir[2]" class="form-control" value="<?php echo $ortu_tgl_lahir[2] ?>" >
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Agama Wali</label>
				<div class="  ">
					<select name="ortu_agama[2]" class="form-control" required="">
						<option value="-">-Pilih-</option>
						<option value="Islam" <?php if($agama_ortu[2]=="Islam"){echo "selected";} ?>>Islam</option>
						<option value="Hindu" <?php if($agama_ortu[2]=="Hindu"){echo "selected";} ?>>Hindu</option>
						<option value="Budha" <?php if($agama_ortu[2]=="Budha"){echo "selected";} ?>>Budha</option>
						<option value="Katolik" <?php if($agama_ortu[2]=="Katolik"){echo "selected";} ?>>Katolik</option>
						<option value="Kristen" <?php if($agama_ortu[2]=="Kristen"){echo "selected";} ?>>Kristen</option>
						<option value="Lain-Lain" <?php if($agama_ortu[2]=="Lain-Lain"){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Pendidikan Terakhir Wali</label>
				<div class="  ">
					<select name="ortu_pendidikan[2]" class="form-control" required="">
						<option value="-">-Pilih-</option>
						<option value="S3" <?php if($pendidikan_ortu[2] == "S3"){echo "selected";} ?>>S-3</option>
						<option value="S2" <?php if($pendidikan_ortu[2] == "S2"){echo "selected";} ?>>S-2</option>
						<option value="S1" <?php if($pendidikan_ortu[2] == "S1"){echo "selected";} ?>>S-1</option>
						<option value="D4" <?php if($pendidikan_ortu[2] == "D4"){echo "selected";} ?>>D-4</option>
						<option value="D3" <?php if($pendidikan_ortu[2] == "D3"){echo "selected";} ?>>D-3</option>
						<option value="D2" <?php if($pendidikan_ortu[2] == "D2"){echo "selected";} ?>>D-2</option>
						<option value="D1" <?php if($pendidikan_ortu[2] == "D1"){echo "selected";} ?>>D-1</option>
						<option value="Profesi" <?php if($pendidikan_ortu[2] == "Profesi"){echo "selected";} ?>>Profesi</option>
						<option value="SMA" <?php if($pendidikan_ortu[2] == "SMA"){echo "selected";} ?>>SMA/SMK Sederajat</option>
						<option value="SMP" <?php if($pendidikan_ortu[2] == "SMP"){echo "selected";} ?>>SMP</option>
						<option value="SD" <?php if($pendidikan_ortu[2] == "SD"){echo "selected";} ?>>SD</option>
						<option value="TTS" <?php if($pendidikan_ortu[2] == "TTS"){echo "selected";} ?>>Tidak Tamat SD</option>
						<option value="NA" <?php if($pendidikan_ortu[2] == "NA"){echo "selected";} ?>>Non Akademik</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">No. HP Wali</label>
				<div class="  ">
					<input type="number" name="ortu_hp[2]" class="form-control" value="<?php echo $hp_ortu[2] ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Pekerjaan Wali</label>
				<div class="  ">
					<input type="text" name="ortu_pekerjaan[2]" class="form-control" value="<?php echo $pekerjaan_ortu[2]  ?>" required="">
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Penghasilan Wali</label>
				<div class="  ">
				<select name="ortu_penghasilan[2]" class="form-control" required="">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan2 as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan[2] == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
			            <?php } ?>
			        </select>
				</div>
			</div>

			<div class="form-group">
				<label class="  control-label">Alamat Wali</label>
				<div class="  ">
					<textarea class="form-control" name="ortu_alamat[1]" required=""><?php echo $ortu_alamat[1]?></textarea>
				</div>
			</div>


			</div>
              
        </div>
        	<div class="col-md-12">
            <br><br><b style="text-align: right;"><button type="submit" class="btn btn-rouded btn-primary"><i class="fa fa-save"></i> Save Data</button></b><br><br>
        	</div>
          </div>
        </div>
        </div>
        </div>
        
      </div>
    </form>
    </div>
  </section>
