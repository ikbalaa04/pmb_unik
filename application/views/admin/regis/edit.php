

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
<?php echo form_open_multipart(base_url('admin/home/edit_verifikasi/'.$detail->id),'class="form-horizontal"'); ?>

<div class="col-md-5"></div>
<div class="col-md-6"><h2><b>Data Profil</b></h2></div>
<div class="col-md-12"><hr></div>
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">Fakultas</label>
	<div class="col-md-9">
	<select name="fakultas" class="form-control">
        <option selected disabled>-Pilih-</option>
            <?php foreach($select_fakultas as $select_fakultas) {?>
        	<option value="<?php echo $select_fakultas->id?>" <?php if($detail->fakultas ==$select_fakultas->id){echo "selected";} ?>><?php echo $select_fakultas->nama_fakultas?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Nisn</label>
	<div class="col-md-9">
		<input type="text" name="nisn" class="form-control" value="<?php echo $detail->nisn ?>" >
	</div>
</div>


<div class="form-group">
	<label class="col-md-3 control-label">Gelombang</label>
	<div class="col-md-9">
		<select name="gelombang" class="form-control">
	        <option selected disabled>-Pilih-</option>
	            <?php foreach($pilih_gelombang as $pilih_gelombang) {?>
	        	<option value="<?php echo $pilih_gelombang->id?>" <?php if($detail->gelombang ==$pilih_gelombang->id){echo "selected";} ?>><?php echo $pilih_gelombang->singkatan?> - <?php echo $pilih_gelombang->nama?> (<?php echo $pilih_gelombang->tahun?>)</option>
	            <?php } ?>
	        </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tahun <small>(Jika mengganti gelombang, samakan tahun dengan tahun gelombang)</small></label>
	<div class="col-md-9">
        <select name="tahun" class="form-control">
        <option selected disabled>-Pilih-</option>
            <?php foreach($detail_tahun as $detail_tahun) {?>
        	<option value="<?php echo $detail_tahun->tahun?>" <?php if($detail->tahun ==$detail_tahun->tahun){echo "selected";} ?>><?php echo $detail_tahun->tahun?></option>
            <?php } ?>
        </select>
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
	<label class="col-md-3 control-label">Jenis Kuliah</label>
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
	<label class="col-md-3 control-label">Pilihan 1</label>
	<div class="col-md-9">
	<?php $Pecah = explode(",", $detail->jurusan_pilihan ); ?>
	<select name="prodi[0]" class="form-control">
        <option value="0">-Pilih-</option>
            <?php foreach($prodi as $prodi) {?>
        	<option value="<?php echo $prodi->kode?>" <?php if($Pecah[0] == $prodi->kode){echo "selected";} ?>><?php echo $prodi->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pilihan 2</label>
	<div class="col-md-9">
	<select name="prodi[1]" class="form-control">
        <option value="0">-Pilih-</option>
            <?php foreach($prodi1 as $prodi) {?>
        	<option value="<?php echo $prodi->kode?>" <?php if($Pecah[1] == $prodi->kode){echo "selected";} ?>><?php echo $prodi->nama?></option>
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
		<input type="date" name="tanggal_lahir" class="form-control"  value="<?php echo $detail->tanggal_lahir ?>" >
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
	<label class="col-md-3 control-label">Hp</label>
	<div class="col-md-9">
		<input type="number" name="hp" class="form-control"  value="<?php echo $detail->hp?>" >
	</div>
</div>

<?php if($detail->jenis=='MB') { ?>

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

<div class="form-group">
	<label class="col-md-3 control-label">Nilai Ijazah</label>
	<div class="col-md-9">
		<input type="text" name="nilai_ijazah" class="form-control"  value="<?php echo $detail->nilai_ijazah ?>">
	</div>
</div>

<?php }else{ ?>

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
	<label class="col-md-3 control-label">Asal Faultas <small>(Jika tidak ada isi dengan '-')</small></label>
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
		<?php $ttl_ortu = explode(",", $detail->ortu_ttl ); ?>
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
        	<option value="<?php echo $list_penghasilan->kode?>" <?php if($penghasilan[0] == $list_penghasilan->kode){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
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
        	<option value="<?php echo $list_penghasilan->kode?>" <?php if($penghasilan[1] == $list_penghasilan->kode){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
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


<div class="col-md-12"><hr></div>
<div class="col-md-12"><center><h2><b>Upload Berkas <?php if($detail->jenis=='MB'){echo "Mahasiswa Baru";}else{echo "Mahasiswa Pindahan";}?><br><small>(Maks. Ukuran Gambar 2 mb)</small></b></h2></center></div>
<div class="col-md-12"><hr></div>

<div class="col-md-4"></div>
<div class="col-md-8">

<?php if($detail->jenis=='MB') { ?>

<?php echo form_open_multipart(base_url('admin/home/berkas_mb/'.$detail->id),'class="form-horizontal"'); ?>
<?php for ($i=0; $i <=6 ; $i++) :?>

<?php if($i==0) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan KTP/KK *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[2]" required="" class="form-control">
	</div>
	<!-- <div class="col-md-2">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-upload"></i> Upload</button>
	</div> -->

	<!-- <?php if($detail->ktp !='') { ?>
	<div class="col-md-2">
		<a href="<?php echo base_url('admin/home/unduh_ktp/'.$detail->id)?>" class="btn btn-success"><i class="fa fa-download"></i> Download Berkas</a>
	</div>
	<?php } ?> -->

</div><br>
<?php } ?>


<?php if($i==1) { ?>
<div class="form-group">
	<label class="col-md-2 control-label">Scan Ijazah SMA/SMK *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[1]" required="" class="form-control"  >
	</div>


</div><br>
<?php } ?>


<?php if($i==2) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan SKHU *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[0]" required=""  class="form-control" >
	</div>


</div><br>
<?php } ?>


<?php if($i==3) { ?>
<div class="form-group">
	<label class="col-md-2 control-label">Scan Surat Keterangan Kerja <br><small>(Jika kerja)</small></label>
	<div class="col-md-4">
		<input type="file" name="userfile[3]"  class="form-control"  >
	</div>


</div><br>
<?php } ?>


<?php endfor;?>

<div class="form-group">
	<label class="col-md-2 control-label"> </label>
	<div class="col-md-2">
		<input type="hidden" name="id" value="<?php echo $detail->id ?>">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-upload"></i> Upload</button>
</div></div><br>

<?php echo form_close(); ?>

<?php }else{ ?>

<?php echo form_open_multipart(base_url('admin/home/berkas_pd/'.$detail->id),'class="form-horizontal"'); ?>
<?php for ($i=0; $i <=6 ; $i++) :?>

<?php if($i==0) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan KTP/KK *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[2]" required="" class="form-control" value="<?php echo $detail->ktp ?>">
	</div>
	<!-- <div class="col-md-2">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-upload"></i> Upload</button>
	</div> -->

	<!-- <?php if($detail->ktp !='') { ?>
	<div class="col-md-2">
		<a href="<?php echo base_url('admin/home/unduh_ktp/'.$detail->id)?>" class="btn btn-success"><i class="fa fa-download"></i> Download Berkas</a>
	</div>
	<?php } ?> -->

</div><br>
<?php } ?>


<?php if($i==1) { ?>
<div class="form-group">
	<label class="col-md-2 control-label">Scan Ijazah SMA/SMK *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[1]" required="" class="form-control"  >
	</div>


</div><br>
<?php } ?>

<?php if($i==2) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan SKHU *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[0]" required=""  class="form-control" >
	</div>


</div><br>
<?php } ?>

<?php if($i==6) { ?>
<div class="form-group">
	<label class="col-md-2 control-label">Scan Surat Keterangan Kerja <br><small>(Jika kerja)</small></label>
	<div class="col-md-4">
		<input type="file" name="userfile[5]"  class="form-control"  >
	</div>


</div><br>
<?php } ?>


<?php if($i==3) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan Surat Rekomendasi Kopertis </label>
	<div class="col-md-4">
		<input type="file" name="userfile[3]"  class="form-control" >
	</div>

</div><br>

<?php } ?>

<?php if($i==4) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan Transkip Nilai *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[4]" required=""  class="form-control" >
	</div>


</div><br>

<?php } ?>

<?php if($i==5) { ?>

<div class="form-group">
	<label class="col-md-2 control-label">Scan Surat Keterangan Pindah *</label>
	<div class="col-md-4">
		<input type="file" name="userfile[6]" required=""  class="form-control" >
	</div>

</div><br>

<?php } ?>


<?php endfor;?>

<div class="form-group">
	<label class="col-md-2 control-label"> </label>
	<div class="col-md-2">
		<input type="hidden" name="id" value="<?php echo $detail->id ?>">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-upload"></i> Upload</button>
</div><br>

<?php echo form_close(); ?>

<?php } ?>

</div>
</div>

<?php if($detail->jenis=='MB') { ?>

<div class="col-md-12"><hr></div>
<div class="col-md-12"><center><h2><b>Data Hasil Upload Berkas Mahasiswa Baru</b></h2></center></div>

<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th><a href="<?php echo base_url('admin/home/detail_berkas/'.$detail->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Lihat Semua Berkas</a></th>
            <th>Status Berkas</th>
            
        </tr>
    </thead>
    <tbody>
        <tr> 
            <td width="20">1</td>
            <td>Scan KTP/KK</td>
            <?php if ($detail->ktp != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td width="20">2</td>
            <td>Scan Ijazah SMA/SMK</td>
            <?php if ($detail->ijazah != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td width="20">3</td>
            <td>Scan SKHU</td>
            <?php if ($detail->skhu != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
 		<tr> 
            <td width="20">4</td>
            <td>Scan Surat Keterangan Kerja</td>
            <?php if ($detail->suket_kerja != '') { ?>
            <td><b>Ada</b></td>
            <?php }else{ ?>
            <td><b>Belum Ada</b></td>
            <?php }?>
        <tr>


    </tbody>
	</table>

</div>
</div>
</div>

<?php }else{ ?>

<div class="col-md-12"><hr></div>
<div class="col-md-12"><center><h2><b>Data Hasil Upload Berkas Mahasiswa Pindahan</b></h2></center></div>

<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="pane panel-default">  
<div class="panel-body"> 
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th><a href="<?php echo base_url('admin/home/detail_berkas/'.$detail->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Lihat Semua Berkas</a></th>
            <th>Status Berkas</th>
            
        </tr>
    </thead>
    <tbody>
        <tr> 
            <td width="20">1</td>
            <td>Scan KTP/KK</td>
            <?php if ($detail->ktp != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td width="20">2</td>
            <td>Scan Ijazah SMA/SMK</td>
            <?php if ($detail->ijazah != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td width="20">3</td>
            <td>Scan SKHU</td>
            <?php if ($detail->skhu != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
 		<tr> 
            <td width="20">4</td>
            <td>Scan Surat Keterangan Kerja</td>
            <?php if ($detail->suket_kerja != '') { ?>
            <td><b>Ada</b></td>
            <?php }else{ ?>
            <td><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td width="20">5</td>
            <td>Scan Surat Rekomendasi Kopertis</td>
            <?php if ($detail->kopertis != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
        <tr> 
            <td width="20">6</td>
            <td>Scan Transkip Nilai</td>
            <?php if ($detail->transkip != '') { ?>
            <td ><b>Ada</b></td>
            <?php }else{ ?>
            <td ><b>Belum Ada</b></td>
            <?php }?>
        <tr>
 		<tr> 
            <td width="20">6</td>
            <td>Scan Surat Keterangan Pindah</td>
            <?php if ($detail->suket_pindah != '') { ?>
            <td><b>Ada</b></td>
            <?php }else{ ?>
            <td><b>Belum Ada</b></td>
            <?php }?>
        <tr>


    </tbody>
	</table>

</div>
</div>
</div>

<?php } ?>

</div>







