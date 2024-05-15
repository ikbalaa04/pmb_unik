

<?php

echo validation_errors('<div class="alert alert-warning">','</div>');
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

?>

<div class="row">
<?php echo form_open_multipart(base_url('admin/home/edit_terverifikasi/'.$detail->id),'class="form-horizontal"'); ?>

<div class="col-md-5"></div>
<div class="col-md-6"><h2><b>Data Profil</b></h2></div>
<div class="col-md-12"><hr></div>
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">NISN</label>
	<div class="col-md-9">
		<input type="text" name="nisn" class="form-control" value="<?php echo $detail->nisn ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Program Kuliah</label>
	<div class="col-md-9">
	<select name="program" class="form-control">
        <option selected disabled>-Pilih-</option>
            <?php foreach($list_program as $list_program) {?>
        	<option value="<?php echo $list_program->kode?>" <?php if($detail->program ==$list_program->kode){echo "selected";} ?>><?php echo $list_program->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Jenis Pendaftaran</label>
	<div class="col-md-9">
		<select name="jenis" class="form-control">
        <option selected disabled>-Pilih-</option>
            <?php foreach($list_jenis as $list_jenis) {?>
        	<option value="<?php echo $list_jenis->kode?>" <?php if($detail->jenis ==$list_jenis->kode){echo "selected";} ?>><?php echo $list_jenis->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Jenjang</label>
	<div class="col-md-9">
	<select name="jenjang" class="form-control">
        <option value="">-Pilih-</option>
            <?php foreach($jenjang as $jenjang) {?>
        	<option value="<?php echo $jenjang->nama ?>" <?php if($detail->jenjang == $jenjang->nama){echo "selected";} ?>><?php echo $jenjang->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>


<div class="form-group">
	<label class="col-md-3 control-label">Nama Lengkap</label>
	<div class="col-md-9">
		<input type="text" name="nama_lengkap" class="form-control"  value="<?php echo $detail->nama_lengkap ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tempat Lahir</label>
	<div class="col-md-9">
		<input type="text" name="tempat_lahir" class="form-control"  value="<?php echo $detail->tempat_lahir ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tanggal Lahir</label>
	<div class="col-md-9">
		<input type="text" id="tanggal" name="tanggal_lahir" class="form-control"  value="<?php echo $detail->tanggal_lahir ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Email</label>
	<div class="col-md-9">
		<input type="text" id="email" name="email" class="form-control"  value="<?php echo $detail->email ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Username</label>
	<div class="col-md-9">
		<input type="text" id="text" readonly="" class="form-control"  value="<?php echo $detail->username ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Password</label>
	<div class="col-md-9">
		<input type="text" id="text" readonly="" class="form-control"  value="<?php echo $detail->password ?>" >
	</div>
</div>


</div>

<div class="col-md-6">

<div class="form-group">
	<label class="col-md-3 control-label">Jenis Kelamin</label>
	<div class="col-md-9">
		<select name="jk" class="form-control">
			<option value="">-Pilih-</option>
			<option value="L" <?php if($detail->jk == 'L'){echo "selected";} ?>>Laki-laki</option>
			<option value="P" <?php if($detail->jk == 'P'){echo "selected";} ?>>Perempuan</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Agama</label>
	<div class="col-md-9">
		<select name="agama" class="form-control">
			<option value="">-Pilih-</option>
			<option value="Islam" <?php if($detail->agama == 'Islam'){echo "selected";} ?>>Islam</option>
			<option value="Hindu" <?php if($detail->agama == 'Hindu'){echo "selected";} ?>>Hindu</option>
			<option value="Budha" <?php if($detail->agama == 'Budha'){echo "selected";} ?>>Budha</option>
			<option value="Katolik" <?php if($detail->agama == 'Katolik'){echo "selected";} ?>>Katolik</option>
			<option value="Kristen" <?php if($detail->agama == 'Kristen'){echo "selected";} ?>>Kristen</option>
			<option value="Lain-Lain" <?php if($detail->agama == 'Lain-Lain'){echo "selected";} ?>>Lain-Lain</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Kewarganegaraan</label>
	<div class="col-md-9">
		<select name="kewarganegaraan" class="form-control">
			<option value="">-Pilih-</option>
			<option value="WNA" <?php if($detail->kewarganegaraan == 'WNA'){echo "selected";} ?>>WNA</option>
			<option value="WNI" <?php if($detail->kewarganegaraan == 'WNI'){echo "selected";} ?>>WNI</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Status</label>
	<div class="col-md-9">
		<select name="status_sipil" class="form-control">
			<option value="">-Pilih-</option>
			<option value="Belum Menikah" <?php if($detail->status_sipil == 'Belum Menikah'){echo "selected";} ?>>Belum Menikah</option>
			<option value="Menikah" <?php if($detail->status_sipil == 'Menikah'){echo "selected";} ?>>Menikah</option>
			<option value="Duda" <?php if($detail->status_sipil == 'Duda'){echo "selected";} ?>>Duda</option>
			<option value="Janda" <?php if($detail->status_sipil == 'Janda'){echo "selected";} ?>>Janda</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Alamat</label>
	<div class="col-md-9">
		<textarea name="alamat" class="form-control" ><?php echo $detail->alamat?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Hp (<small style="color: red">Format No. WA Harus berawalan 62. Contoh 628978674847</small>)</label>
	<div class="col-md-9">
		<input type="number" name="hp" class="form-control"  value="<?php echo $detail->hp?>" >
	</div>
</div>

<?php if($detail->jenis=='MB') { ?>

<?php if($detail->jenjang=='S2' || $detail->jenjang=='Profesi' || $detail->jenjang=='S3') { ?>
<div class="form-group">
	<label class="col-md-3 control-label">Asal Kampus</label>
	<div class="col-md-9">
		<input type="text" name="kampus_asal" class="form-control"  value="<?php echo $detail->kampus_asal ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">IPK</label>
	<div class="col-md-9">
		<input type="text" name="ipk" class="form-control"  value="<?php echo $detail->ipk ?>">
	</div>
</div>
<?php }else{ ?>

<div class="form-group">
	<label class="col-md-3 control-label">Asal Sekolah</label>
	<div class="col-md-9">
		<input type="text" name="sekolah_nama" class="form-control"  value="<?php echo $detail->sekolah_nama ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Asal Jurusan</label>
	<div class="col-md-9">
		<select name="sekolah_jurusan" class="form-control">
			<option value="">-Pilih-</option>
			<option value="IPA" <?php if($detail->sekolah_jurusan == 'IPA'){echo "selected";} ?>>IPA</option>
			<option value="IPS" <?php if($detail->sekolah_jurusan == 'IPS'){echo "selected";} ?>>IPS</option>
			<option value="Lainnya" <?php if($detail->sekolah_jurusan == 'Lainnya'){echo "selected";} ?>>Lainnya</option>
		</select>
	</div>
</div>

<?php if($detail->sekolah_jurusan=='Lainnya') { ?>
<div class="form-group">
	<label class="col-md-3 control-label">Nama Jurusan</label>
	<div class="col-md-9">
		<input type="text" name="sekolah_nama_jurusan" class="form-control"  value="<?php echo $detail->sekolah_nama_jurusan ?>">
	</div>
</div>
<?php } ?>

<div class="form-group">
	<label class="col-md-3 control-label">Nilai Ijazah</label>
	<div class="col-md-9">
		<input type="text" name="nilai_ijazah" class="form-control"  value="<?php echo $detail->nilai_ijazah ?>">
	</div>
</div>
<?php } ?>

<div class="form-group">
	<label class="col-md-3 control-label">Tahun Lulus</label>
	<div class="col-md-9">
		<input type="text" name="tahun_lulus" class="form-control"  value="<?php echo $detail->tahun_lulus ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Nomor Ijazah</label>
	<div class="col-md-9">
		<input type="text" name="no_ijazah" class="form-control"  value="<?php echo $detail->no_ijazah ?>">
	</div>
</div>

<?php }elseif($detail->jenis=='PD'){ ?>

<?php if($this->session->userdata('level')=='1') { ?>
	<div class="form-group">
		<label class="col-md-3 control-label">Status Pindahan</label>
		<div class="col-md-9">
			<select name="pindahan_status" class="form-control">
				<option value="">-Pilih-</option>
				<option value="1" <?php if($detail->pindahan_status == '1'){echo "selected";} ?>>Diterima</option>
				<option value="0" <?php if($detail->pindahan_status == '0'){echo "selected";} ?>>Ditolak</option>
			</select>
		</div>
	</div>
<?php } ?>

<div class="form-group">
	<label class="col-md-3 control-label">Asal Kampus</label>
	<div class="col-md-9">
		<input type="text" name="pindahan_namapt" class="form-control"  value="<?php echo $detail->pindahan_namapt ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Asal Fakultas <small>(Jika tidak ada isi dengan '-')</small></label>
	<div class="col-md-9">
		<input type="text" name="pindahan_fakultas" class="form-control"  value="<?php echo $detail->pindahan_fakultas ?>">
	</div>
</div>


<div class="form-group">
	<label class="col-md-3 control-label">Asal Program Studi</label>
	<div class="col-md-9">
		<input type="text" name="pindahan_prodi" class="form-control"  value="<?php echo $detail->pindahan_prodi ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">NIM</label>
	<div class="col-md-9">
		<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $detail->pindahan_nim ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Jumlah SKS</label>
	<div class="col-md-9">
		<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $detail->pindahan_jumlahsks ?>">
	</div>
</div>

<?php } ?>


</div>

<div class="col-md-12"><hr></div>
<div class="col-md-12"><center><h2><b>Data Orang Tua</b></h2></center></div>
<div class="col-md-12"><hr></div>
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">Nama Ayah</label>
	<div class="col-md-9">
		<?php $nama_ortu = explode(",", $detail->ortu_nama ); ?>
		<input type="text" name="ortu_nama[0]" class="form-control" value="<?php echo $nama_ortu[0] ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">TTL Ayah</label>
	<div class="col-md-9">
		<?php $ttl_ortu = explode("|", $detail->ortu_ttl ); ?>
		<input type="text" name="ortu_ttl[0]" class="form-control" value="<?php echo $ttl_ortu[0] ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Agama Ayah</label>
	<div class="col-md-9">
		<?php $agama_ortu = explode(",", $detail->ortu_agama); ?>
		<select name="ortu_agama[0]" class="form-control">
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
	<label class="col-md-3 control-label">Pendidikan Terakhir Ayah</label>
	<div class="col-md-9">
		<?php $pendidikan_ortu = explode(",", $detail->ortu_pendidikan); ?>
		<select name="ortu_pendidikan[0]" class="form-control">
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
	<label class="col-md-3 control-label">No. HP Ayah</label>
	<div class="col-md-9">
		<?php $hp_ortu = explode(",", $detail->ortu_hp); ?>
		<input type="text" name="ortu_hp[0]" class="form-control" value="<?php echo $hp_ortu[0] ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pekerjaan Ayah</label>
	<div class="col-md-9">
		<?php $pekerjaan_ortu = explode(",", $detail->ortu_pekerjaan); ?>
		<input type="text" name="ortu_pekerjaan[0]" class="form-control" value="<?php echo $pekerjaan_ortu[0]  ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Penghasilan Ayah</label>
	<div class="col-md-9">
	<?php $penghasilan = explode(",", $detail->ortu_penghasilan ); ?>
	<select name="ortu_penghasilan[0]" class="form-control">
        <option value="-">-Pilih-</option>
            <?php foreach($list_penghasilan as $list_penghasilan) {?>
        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan[0] == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Alamat Orang Tua</label>
	<div class="col-md-9">
		<textarea class="form-control" name="ortu_alamat"><?php echo $detail->ortu_alamat?></textarea>
	</div>
</div>

</div>

<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">Nama Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_nama[1]" class="form-control" value="<?php echo $nama_ortu[1] ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">TTL Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_ttl[1]" class="form-control" value="<?php echo $ttl_ortu[1] ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Agama Ibu</label>
	<div class="col-md-9">
		<select name="ortu_agama[1]" class="form-control">
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
	<label class="col-md-3 control-label">Pendidikan Terakhir Ibu</label>
	<div class="col-md-9">
		<select name="ortu_pendidikan[1]" class="form-control">
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
	<label class="col-md-3 control-label">No. HP Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_hp[1]" class="form-control" value="<?php echo $hp_ortu[1] ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pekerjaan Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_pekerjaan[1]" class="form-control" value="<?php echo $pekerjaan_ortu[1]  ?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Penghasilan Ibu</label>
	<div class="col-md-9">
	<select name="ortu_penghasilan[1]" class="form-control">
        <option value="-">-Pilih-</option>
            <?php foreach($list_penghasilan1 as $list_penghasilan) {?>
        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan[1] == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label"></label>
	<div class="col-md-9">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
		
	</div>
</div>
</div>

<?php echo form_close(); ?>

