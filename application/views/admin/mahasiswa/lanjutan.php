

<?php

echo validation_errors('<div class="alert alert-warning">','</div>');
  if(isset($manual_validation_errors) && count($manual_validation_errors) > 0){
    echo '<div class="alert alert-warning">';
    echo implode('<br>', $manual_validation_errors);
    echo '</div>';
  }
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

<?php $this->load->view('admin/mahasiswa/required_alert'); ?>

<section class="content">
<div class="row">
<?php
if (!function_exists('mahasiswa_old_array_value')) {
	function mahasiswa_old_value($CI, $name, $fallback = '')
	{
		$posted = $CI->input->post($name);
		return $posted !== NULL ? $posted : $fallback;
	}

	function mahasiswa_old_array_value($CI, $name, $index, $fallback = '')
	{
		$posted = $CI->input->post($name);
		return is_array($posted) && array_key_exists($index, $posted) ? $posted[$index] : $fallback;
	}

	function mahasiswa_detail_value($detail, $column, $legacy_value = '')
	{
		return isset($detail->$column) && trim((string) $detail->$column) !== '' ? $detail->$column : $legacy_value;
	}
}
$initial_step = isset($form_lanjutan_step) ? $form_lanjutan_step : ($this->input->get('step') == 'ortu' ? 'ortu' : 'diri');
?>
<?php echo form_open(base_url('admin/home/formulir'),'class="form-horizontal form-lanjutan-wizard" novalidate="novalidate" data-initial-step="'.$initial_step.'"'); ?>
<input type="hidden" name="form_step" value="<?php echo $initial_step == 'ortu' ? 'orang_tua' : 'data_diri'; ?>">

 <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="form-step-indicator">
          <li data-step="utama">1. Data Utama</li>
          <li class="active" data-step="diri">2. Data Diri</li>
          <li data-step="ortu">3. Orang Tua / Wali</li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
			<div class="col-md-12"><br></div>
			<div class="col-md-1"></div>
			<div class="col-md-8">

			<?php if($detail->jenis=='MB') { ?>

			<?php if($detail->jenjang=='S2' || $detail->jenjang=='S3' || $detail->jenjang=='Profesi') { ?>
			<div class="form-group">
				<label class="col-md-3 control-label">Asal Sekolah</label>
				<div class="col-md-9">
					<?php if($detail->sekolah_nama!=''){?>
						<input type="text" name="sekolah_nama" required=""  class="form-control" value="<?php echo mahasiswa_old_value($this, 'sekolah_nama', $detail->sekolah_nama) ?>">
					<?php }else{?>
					<input type="text" name="sekolah_nama" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_nama') ?>">
					<?php }?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Jurusan</label>
				<div class="col-md-9">
					<?php if($detail->sekolah_nama!=''){?>
					<input required=""  type="text" name="sekolah_jurusan" class="form-control" value="<?php echo mahasiswa_old_value($this, 'sekolah_jurusan', $detail->sekolah_jurusan) ?>">
					<?php }else{?>
					<input type="text" name="sekolah_jurusan" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_jurusan') ?>">
					<?php }?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">IPK</label>
				<div class="col-md-9">
					<?php if($detail->ipk!=''){?>
					<input type="text" name="ipk" required="" class="form-control" value="<?php echo mahasiswa_old_value($this, 'ipk', $detail->ipk) ?>">
					<?php }else{?>
					<input type="text" name="ipk" required=""  class="form-control"  value="<?php echo $this->input->post('ipk') ?>">
					<?php }?>
				</div>
			</div>
			<?php }else{ ?>

			<div class="form-group">
				<label class="col-md-3 control-label">NISN</label>
				<div class="col-md-9">
					<?php if($detail->nisn!=''){?>
					<input type="number" name="nisn" required="" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'nisn', $detail->nisn) ?>">
					<?php }else{?>
					<input type="number" name="nisn" required=""  class="form-control"  value="<?php echo $this->input->post('nisn') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">NPSN</label>
				<div class="col-md-9">
					<?php if($detail->npsn!=''){?>
					<input type="number" name="npsn" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'npsn', $detail->npsn) ?>">
					<?php }else{?>
					<input type="number" name="npsn" class="form-control"  value="<?php echo $this->input->post('npsn') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Sekolah</label>
				<div class="col-md-9">
					<?php if($detail->sekolah_nama!=''){?>
					<input type="text" name="sekolah_nama" required=""  class="form-control" value="<?php echo mahasiswa_old_value($this, 'sekolah_nama', $detail->sekolah_nama) ?>">
					<?php }else{?>
					<input type="text" name="sekolah_nama" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_nama') ?>">
					<?php }?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Jurusan</label>
				<div class="col-md-9">
					<?php if($detail->sekolah_jurusan!=''){?>
					<input required=""  type="text" name="sekolah_jurusan" class="form-control" value="<?php echo mahasiswa_old_value($this, 'sekolah_jurusan', $detail->sekolah_jurusan) ?>">
					<?php }else{?>
					<input type="text" name="sekolah_jurusan" required="" class="form-control"  value="<?php echo $this->input->post('sekolah_jurusan') ?>">
					<?php }?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Nilai Ijazah</label>
				<div class="col-md-9">
					<?php if($detail->nilai_ijazah!=''){?>
					<input type="text" name="nilai_ijazah"  class="form-control"  value="<?php echo $detail->nilai_ijazah ?>">
					<?php }else{?>
					<input type="text" name="nilai_ijazah" class="form-control"  value="<?php echo $this->input->post('nilai_ijazah') ?>">
					<?php }?>
				</div>
			</div>
			<?php } ?>

			<div class="form-group">
				<label class="col-md-3 control-label">Tahun Lulus</label>
				<div class="col-md-9">
					<?php if($detail->tahun_lulus!=''){?>
					<input type="number" name="tahun_lulus" required=""  class="form-control"  value="<?php echo mahasiswa_old_value($this, 'tahun_lulus', $detail->tahun_lulus) ?>">
					<?php }else{?>
					<input type="number" name="tahun_lulus" required="" class="form-control"  value="<?php echo $this->input->post('tahun_lulus') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Nomor Ijazah</label>
				<div class="col-md-9">
					<?php if($detail->no_ijazah!=''){?>
					<input type="text" name="no_ijazah" class="form-control"  value="<?php echo $detail->no_ijazah ?>">
					<?php }else{?>
					<input type="text" name="no_ijazah" class="form-control"  value="<?php echo $this->input->post('no_ijazah') ?>">
					<?php }?>
					
				</div>
			</div>

			<?php }elseif($detail->jenis=='PD') { ?>

			<div class="form-group">
				<label class="col-md-3 control-label">Status Pindahan Dari Perguruan Tinggi Sebelumnya</label>
				<div class="col-md-9">
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
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Kampus</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_namapt!=''){?>
					<input type="text" name="pindahan_namapt" required=""  class="form-control title-case-input"  value="<?php echo $detail->pindahan_namapt ?>">
					<?php }else{?>
					<input type="text" name="pindahan_namapt" required="" class="form-control title-case-input"  value="<?php echo $this->input->post('pindahan_namapt') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Fakultas <small>(Jika tidak ada isi dengan '-')</small></label>
				<div class="col-md-9">
					<?php if($detail->pindahan_fakultas!=''){?>
					<input type="text" name="pindahan_fakultas" class="form-control title-case-input"  value="<?php echo $detail->pindahan_fakultas ?>">
					<?php }else{?>
					<input type="text" name="pindahan_fakultas" class="form-control title-case-input"  value="<?php echo $this->input->post('pindahan_fakultas') ?>">
					<?php }?>
					
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-3 control-label">Asal Program Studi</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_prodi!=''){?>
					<input type="text" name="pindahan_prodi" required=""  class="form-control title-case-input"  value="<?php echo $detail->pindahan_prodi ?>">
					<?php }else{?>
					<input type="text" name="pindahan_prodi" required="" class="form-control title-case-input"  value="<?php echo $this->input->post('pindahan_prodi') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">NIM</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_nim!=''){?>
					<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $detail->pindahan_nim ?>">
					<?php }else{?>
					<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $this->input->post('pindahan_nim') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Jumlah SKS</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_jumlahsks!=''){?>
					<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $detail->pindahan_jumlahsks ?>">
					<?php }else{?>
					<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $this->input->post('pindahan_jumlahsks') ?>">
					<?php }?>
					
				</div>
			</div>

			<?php }elseif($detail->jenis=='AJ' || $detail->jenis=='LJ') { ?>
			<div class="form-group">
				<label class="col-md-3 control-label">Status Pindahan Dari Perguruan Tinggi Sebelumnya</label>
				<div class="col-md-9">
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
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Kampus</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_namapt!=''){?>
					<input type="text" name="pindahan_namapt" required=""  class="form-control title-case-input"  value="<?php echo $detail->pindahan_namapt ?>">
					<?php }else{?>
					<input type="text" name="pindahan_namapt" required="" class="form-control title-case-input"  value="<?php echo $this->input->post('pindahan_namapt') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Asal Fakultas <small>(Jika tidak ada isi dengan '-')</small></label>
				<div class="col-md-9">
					<?php if($detail->pindahan_fakultas!=''){?>
					<input type="text" name="pindahan_fakultas" class="form-control title-case-input"  value="<?php echo $detail->pindahan_fakultas ?>">
					<?php }else{?>
					<input type="text" name="pindahan_fakultas" class="form-control title-case-input"  value="<?php echo $this->input->post('pindahan_fakultas') ?>">
					<?php }?>
					
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-3 control-label">Asal Program Studi</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_prodi!=''){?>
					<input type="text" name="pindahan_prodi" required=""  class="form-control title-case-input"  value="<?php echo $detail->pindahan_prodi ?>">
					<?php }else{?>
					<input type="text" name="pindahan_prodi" required="" class="form-control title-case-input"  value="<?php echo $this->input->post('pindahan_prodi') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">NIM</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_nim!=''){?>
					<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $detail->pindahan_nim ?>">
					<?php }else{?>
					<input type="text" name="pindahan_nim" class="form-control"  value="<?php echo $this->input->post('pindahan_nim') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Jumlah SKS</label>
				<div class="col-md-9">
					<?php if($detail->pindahan_jumlahsks!=''){?>
					<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $detail->pindahan_jumlahsks ?>">
					<?php }else{?>
					<input type="text" name="pindahan_jumlahsks" class="form-control"  value="<?php echo $this->input->post('pindahan_jumlahsks') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tahun Lulus</label>
				<div class="col-md-9">
					<?php if($detail->tahun_lulus!=''){?>
					<input type="number" name="tahun_lulus" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'tahun_lulus', $detail->tahun_lulus) ?>">
					<?php }else{?>
					<input type="number" name="tahun_lulus" class="form-control"  value="<?php echo $this->input->post('tahun_lulus') ?>">
					<?php }?>
					
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Nomor Ijazah</label>
				<div class="col-md-9">
					<?php if($detail->no_ijazah!=''){?>
					<input type="text" name="no_ijazah" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'no_ijazah', $detail->no_ijazah) ?>">
					<?php }else{?>
					<input type="text" name="no_ijazah" class="form-control"  value="<?php echo $this->input->post('no_ijazah') ?>">
					<?php }?>
					
				</div>
			</div>
			<?php } ?>

			</div>

			<div class="col-md-12"><hr></div>

			<div class="col-md-5"></div>
			<div class="col-md-6"><H3><b>Form Biodata</b></H3></div>
			<div class="col-md-12"><p class="required-note">Field dengan tanda <span class="required-star">*</span> wajib diisi.</p></div>
			<div class="col-md-12"><br></div>
			<div class="col-md-1"></div>
			<div class="col-md-8">



			 <div class="form-group">
				<label class="col-md-3 control-label">NIK</label>
				<div class="col-md-9">
					<?php if($detail->nik==''){?>
						<input type="text" inputmode="numeric" pattern="[0-9]{16}" minlength="16" maxlength="16" required="" name="nik" class="form-control" value="<?php echo mahasiswa_old_value($this, 'nik', '') ?>" >
					<?php }else{?>
							<input type="text" inputmode="numeric" pattern="[0-9]{16}" minlength="16" maxlength="16" required="" name="nik" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'nik', $detail->nik) ?>">
					<?php } ?>
				</div>
			</div>

			 <div class="form-group">
				<label class="col-md-3 control-label">Nama Lengkap</label>
				<div class="col-md-9">
					<?php if($detail->nama_lengkap==''){?>
							<input type="text" name="nama_lengkap" required="" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'nama_lengkap', '') ?>" >
						<?php }else{?>
							<input type="text" name="nama_lengkap" required="" class="form-control title-case-input"  value="<?php echo mahasiswa_old_value($this, 'nama_lengkap', $detail->nama_lengkap) ?>">
					<?php } ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir</label>
				<div class="col-md-9">
					<?php if($detail->tempat_lahir==''){?>
						<input type="text" name="tempat_lahir" required="" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'tempat_lahir', '') ?>" >
					<?php }else{?>
						<input type="text" name="tempat_lahir" required=""  class="form-control title-case-input"  value="<?php echo mahasiswa_old_value($this, 'tempat_lahir', $detail->tempat_lahir) ?>">
					<?php } ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Lahir</label>
				<div class="col-md-9">
					<?php if($detail->tanggal_lahir==''){?>
						<input type="text" id="tanggal" name="tanggal_lahir" required="" class="form-control" value="<?php echo mahasiswa_old_value($this, 'tanggal_lahir', '') ?>" >
					<?php }else{?>
						<input type="text" id="tanggal" name="tanggal_lahir" required=""  class="form-control"  value="<?php echo mahasiswa_old_value($this, 'tanggal_lahir', $detail->tanggal_lahir) ?>">
					<?php } ?>
				</div>
			</div>

			 <div class="form-group">
				<label class="col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<?php if($detail->email==''){?>
						<input type="email" name="email" class="form-control" required="" value="<?php echo mahasiswa_old_value($this, 'email', '') ?>" >
					<?php }else{?>
							<input type="email" name="email" required="" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'email', $detail->email) ?>">
					<?php } ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Jenis Kelamin</label>
				<div class="col-md-9">
					<select name="jk" class="form-control" required="">
						<option value="">-Pilih-</option>
							<option value="L" <?php if(mahasiswa_old_value($this, 'jk', $detail->jk) == 'L'){echo "selected";} ?>>Laki-laki</option>
							<option value="P" <?php if(mahasiswa_old_value($this, 'jk', $detail->jk) == 'P'){echo "selected";} ?>>Perempuan</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Ukuran Baju (Untuk baju PPKMB)</label>
				<div class="col-md-9">
					<select name="baju" class="form-control" required="">
						<option value="">-Pilih-</option>
							<option value="S" <?php if(mahasiswa_old_value($this, 'baju', $detail->baju) == 'S'){echo "selected";} ?>>S</option>
							<option value="M" <?php if(mahasiswa_old_value($this, 'baju', $detail->baju) == 'M'){echo "selected";} ?>>M</option>
							<option value="L" <?php if(mahasiswa_old_value($this, 'baju', $detail->baju) == 'L'){echo "selected";} ?>>L</option>
							<option value="XL" <?php if(mahasiswa_old_value($this, 'baju', $detail->baju) == 'XL'){echo "selected";} ?>>XL</option>
							<option value="XXL" <?php if(mahasiswa_old_value($this, 'baju', $detail->baju) == 'XXL'){echo "selected";} ?>>XXL</option>
							<option value="XXXL" <?php if(mahasiswa_old_value($this, 'baju', $detail->baju) == 'XXXL'){echo "selected";} ?>>XXXL</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Agama</label>
				<div class="col-md-9">
					<select name="agama" class="form-control" required="">
						<option value="">-Pilih-</option>
							<option value="Islam" <?php if(mahasiswa_old_value($this, 'agama', $detail->agama) == 'Islam'){echo "selected";} ?>>Islam</option>
							<option value="Hindu" <?php if(mahasiswa_old_value($this, 'agama', $detail->agama) == 'Hindu'){echo "selected";} ?>>Hindu</option>
							<option value="Budha" <?php if(mahasiswa_old_value($this, 'agama', $detail->agama) == 'Budha'){echo "selected";} ?>>Budha</option>
							<option value="Katolik" <?php if(mahasiswa_old_value($this, 'agama', $detail->agama) == 'Katolik'){echo "selected";} ?>>Katolik</option>
							<option value="Kristen" <?php if(mahasiswa_old_value($this, 'agama', $detail->agama) == 'Kristen'){echo "selected";} ?>>Kristen</option>
							<option value="Lain-Lain" <?php if(mahasiswa_old_value($this, 'agama', $detail->agama) == 'Lain-Lain'){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label class="col-md-3 control-label">Kewarganegaraan</label>
				<div class="col-md-9">
						<select name="kewarganegaraan" class="form-control" required="">
						<option value="">-Pilih-</option>
							<option value="WNA" <?php if(mahasiswa_old_value($this, 'kewarganegaraan', $detail->kewarganegaraan) == 'WNA'){echo "selected";} ?>>WNA</option>
							<option value="WNI" <?php if(mahasiswa_old_value($this, 'kewarganegaraan', $detail->kewarganegaraan) == 'WNI'){echo "selected";} ?>>WNI</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Status</label>
				<div class="col-md-9">
					<select name="status_sipil" class="form-control">
						<option value="">-Pilih-</option>
							<option value="Belum Menikah" <?php if(mahasiswa_old_value($this, 'status_sipil', $detail->status_sipil) == 'Belum Menikah'){echo "selected";} ?>>Belum Menikah</option>
							<option value="Menikah" <?php if(mahasiswa_old_value($this, 'status_sipil', $detail->status_sipil) == 'Menikah'){echo "selected";} ?>>Menikah</option>
							<option value="Duda" <?php if(mahasiswa_old_value($this, 'status_sipil', $detail->status_sipil) == 'Duda'){echo "selected";} ?>>Duda</option>
							<option value="Janda" <?php if(mahasiswa_old_value($this, 'status_sipil', $detail->status_sipil) == 'Janda'){echo "selected";} ?>>Janda</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Alamat</label>
				<div class="col-md-9">
					<?php if($detail->alamat==''){?>
						<textarea name="alamat" required="" class="form-control" ><?php echo mahasiswa_old_value($this, 'alamat', '') ?></textarea>
					<?php }else{?>
							<textarea name="alamat" required="" class="form-control" ><?php echo mahasiswa_old_value($this, 'alamat', $detail->alamat)?></textarea>
					<?php } ?>
				</div>
			</div>

			 <div class="form-group">
				<label class="col-md-3 control-label">Kecamatan</label>
				<div class="col-md-9">
					<?php if($detail->kecamatan==''){?>
						<input type="text" name="kecamatan" required="" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'kecamatan', '') ?>" >
					<?php }else{?>
							<input type="text" name="kecamatan" required="" class="form-control title-case-input"  value="<?php echo mahasiswa_old_value($this, 'kecamatan', $detail->kecamatan) ?>">
					<?php } ?>
				</div>
			</div>

			 <div class="form-group">
				<label class="col-md-3 control-label">Kabupaten/Kota</label>
				<div class="col-md-9">
					<?php if($detail->kota==''){?>
						<input type="text" name="kota" required="" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'kota', '') ?>" >
					<?php }else{?>
							<input type="text" name="kota" required="" class="form-control title-case-input"  value="<?php echo mahasiswa_old_value($this, 'kota', $detail->kota) ?>">
					<?php } ?>
				</div>
			</div>

			 <div class="form-group">
				<label class="col-md-3 control-label">Provinsi</label>
				<div class="col-md-9">
					<?php if($detail->prov==''){?>
						<input type="text" name="prov" required="" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'prov', '') ?>" >
					<?php }else{?>
							<input type="text" name="prov" required="" class="form-control title-case-input"  value="<?php echo mahasiswa_old_value($this, 'prov', $detail->prov) ?>">
					<?php } ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">No. HP / WA</label>
				<div class="col-md-9">
					<?php if($detail->hp==''){?>
						<input type="number" name="hp" required="" class="form-control" value="<?php echo mahasiswa_old_value($this, 'hp', '') ?>" >
					<?php }else{?>
							<input type="number" name="hp" required="" class="form-control"  value="<?php echo mahasiswa_old_value($this, 'hp', $detail->hp) ?>">
					<?php } ?>
				</div>
			</div>
          </div>
      </div>

          <div class="tab-pane" id="settings">
            <input type="hidden" name="id" value="<?php echo $detail->id?>">
			<div class="col-md-12"><hr></div>
			<div class="col-md-12"><center><h2><b>Data Orang Tua</b></h2></center></div>
			<div class="col-md-12"><hr></div>
			<div class="col-md-6">
				<?php
					$ortu_nama = explode(",", $detail->ortu_nama);
					$ortu_nik = explode(",", isset($detail->ortu_nik) ? $detail->ortu_nik : ',,');
					$ortu_tempat_lahir = explode("|", $detail->ortu_tempat_lahir);
					$ortu_tgl_lahir = explode("|", $detail->ortu_tgl_lahir);
					$agama_ortu = explode(",", $detail->ortu_agama);
					$pendidikan_ortu = explode(",", $detail->ortu_pendidikan);
					$hp_ortu = explode(",", $detail->ortu_hp);
					$pekerjaan_ortu = explode(",", $detail->ortu_pekerjaan);
					$penghasilan = explode(",", $detail->ortu_penghasilan);
					$ortu_alamat = explode("|", $detail->ortu_alamat);
				?>
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Ayah</label>
					<div class="col-md-9">
						<input type="text" name="nama_ayah" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'nama_ayah', mahasiswa_detail_value($detail, 'nama_ayah', isset($ortu_nama[0]) ? $ortu_nama[0] : '')) ?>" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">NIK Ayah</label>
					<div class="col-md-9">
						<input type="text" inputmode="numeric" pattern="[0-9]{16}" name="nik_ayah" class="form-control" value="<?php echo mahasiswa_old_value($this, 'nik_ayah', mahasiswa_detail_value($detail, 'nik_ayah', isset($ortu_nik[0]) ? $ortu_nik[0] : '')) ?>" required="" minlength="16" maxlength="16">
					</div>
				</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir Ayah</label>
				<div class="col-md-9">
						<input type="text" name="tempat_lahir_ayah" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'tempat_lahir_ayah', mahasiswa_detail_value($detail, 'tempat_lahir_ayah', isset($ortu_tempat_lahir[0]) ? $ortu_tempat_lahir[0] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Ayah</label>
				<div class="col-md-9">
						<input type="text" id="tanggal" name="tanggal_lahir_ayah" class="form-control" value="<?php echo mahasiswa_old_value($this, 'tanggal_lahir_ayah', mahasiswa_detail_value($detail, 'tanggal_lahir_ayah', isset($ortu_tgl_lahir[0]) ? $ortu_tgl_lahir[0] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Agama Ayah</label>
				<div class="col-md-9">
					<?php $agama_ayah = mahasiswa_old_value($this, 'agama_ayah', mahasiswa_detail_value($detail, 'agama_ayah', isset($agama_ortu[0]) ? $agama_ortu[0] : '')); ?>
						<select name="agama_ayah" class="form-control">
						<option value="-">-Pilih-</option>
						<option value="Islam" <?php if($agama_ayah=="Islam"){echo "selected";} ?>>Islam</option>
						<option value="Hindu" <?php if($agama_ayah=="Hindu"){echo "selected";} ?>>Hindu</option>
						<option value="Budha" <?php if($agama_ayah=="Budha"){echo "selected";} ?>>Budha</option>
						<option value="Katolik" <?php if($agama_ayah=="Katolik"){echo "selected";} ?>>Katolik</option>
						<option value="Kristen" <?php if($agama_ayah=="Kristen"){echo "selected";} ?>>Kristen</option>
						<option value="Lain-Lain" <?php if($agama_ayah=="Lain-Lain"){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pendidikan Terakhir Ayah</label>
				<div class="col-md-9">
					<?php $pendidikan_ayah = mahasiswa_old_value($this, 'pendidikan_ayah', mahasiswa_detail_value($detail, 'pendidikan_ayah', isset($pendidikan_ortu[0]) ? $pendidikan_ortu[0] : '')); ?>
						<select name="pendidikan_ayah" class="form-control">
						<option value="-">-Pilih-</option>
						<option value="S3" <?php if($pendidikan_ayah == "S3"){echo "selected";} ?>>S-3</option>
						<option value="S2" <?php if($pendidikan_ayah == "S2"){echo "selected";} ?>>S-2</option>
						<option value="S1" <?php if($pendidikan_ayah == "S1"){echo "selected";} ?>>S-1</option>
						<option value="D4" <?php if($pendidikan_ayah == "D4"){echo "selected";} ?>>D-4</option>
						<option value="D3" <?php if($pendidikan_ayah == "D3"){echo "selected";} ?>>D-3</option>
						<option value="D2" <?php if($pendidikan_ayah == "D2"){echo "selected";} ?>>D-2</option>
						<option value="D1" <?php if($pendidikan_ayah == "D1"){echo "selected";} ?>>D-1</option>
						<option value="Profesi" <?php if($pendidikan_ayah == "Profesi"){echo "selected";} ?>>Profesi</option>
						<option value="SMA" <?php if($pendidikan_ayah == "SMA"){echo "selected";} ?>>SMA/SMK Sederajat</option>
						<option value="SMP" <?php if($pendidikan_ayah == "SMP"){echo "selected";} ?>>SMP</option>
						<option value="SD" <?php if($pendidikan_ayah == "SD"){echo "selected";} ?>>SD</option>
						<option value="TTS" <?php if($pendidikan_ayah == "TTS"){echo "selected";} ?>>Tidak Tamat SD</option>
						<option value="NA" <?php if($pendidikan_ayah == "NA"){echo "selected";} ?>>Non Akademik</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">No. HP Ayah</label>
				<div class="col-md-9">
							<input type="number" name="hp_ayah" class="form-control" value="<?php echo mahasiswa_old_value($this, 'hp_ayah', mahasiswa_detail_value($detail, 'hp_ayah', isset($hp_ortu[0]) ? $hp_ortu[0] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pekerjaan Ayah</label>
				<div class="col-md-9">
							<input type="text" name="pekerjaan_ayah" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'pekerjaan_ayah', mahasiswa_detail_value($detail, 'pekerjaan_ayah', isset($pekerjaan_ortu[0]) ? $pekerjaan_ortu[0] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Penghasilan Ayah</label>
				<div class="col-md-9">
				<?php $penghasilan_ayah = mahasiswa_old_value($this, 'penghasilan_ayah', mahasiswa_detail_value($detail, 'penghasilan_ayah', isset($penghasilan[0]) ? $penghasilan[0] : '')); ?>
					<select name="penghasilan_ayah" class="form-control">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan_ayah == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
			            <?php } ?>
			        </select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Alamat Orang Tua</label>
				<div class="col-md-9">
							<textarea class="form-control" name="alamat_orang_tua"><?php echo mahasiswa_old_value($this, 'alamat_orang_tua', mahasiswa_detail_value($detail, 'alamat_orang_tua', isset($ortu_alamat[0]) ? $ortu_alamat[0] : '')) ?></textarea>
				</div>
			</div>

			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Ibu</label>
					<div class="col-md-9">
						<input type="text" name="nama_ibu" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'nama_ibu', mahasiswa_detail_value($detail, 'nama_ibu', isset($ortu_nama[1]) ? $ortu_nama[1] : '')) ?>" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">NIK Ibu</label>
					<div class="col-md-9">
						<input type="text" inputmode="numeric" pattern="[0-9]{16}" name="nik_ibu" class="form-control" value="<?php echo mahasiswa_old_value($this, 'nik_ibu', mahasiswa_detail_value($detail, 'nik_ibu', isset($ortu_nik[1]) ? $ortu_nik[1] : '')) ?>" required="" minlength="16" maxlength="16">
						<input type="hidden" name="nik_wali" value="<?php echo mahasiswa_old_value($this, 'nik_wali', mahasiswa_detail_value($detail, 'nik_wali', isset($ortu_nik[2]) ? $ortu_nik[2] : '')) ?>">
					</div>
				</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir Ibu</label>
				<div class="col-md-9">
							<input type="text" name="tempat_lahir_ibu" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'tempat_lahir_ibu', mahasiswa_detail_value($detail, 'tempat_lahir_ibu', isset($ortu_tempat_lahir[1]) ? $ortu_tempat_lahir[1] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Lahir Ibu</label>
				<div class="col-md-9">
							<input type="text" id="tanggal2"  name="tanggal_lahir_ibu" class="form-control" value="<?php echo mahasiswa_old_value($this, 'tanggal_lahir_ibu', mahasiswa_detail_value($detail, 'tanggal_lahir_ibu', isset($ortu_tgl_lahir[1]) ? $ortu_tgl_lahir[1] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Agama Ibu</label>
				<div class="col-md-9">
						<?php $agama_ibu = mahasiswa_old_value($this, 'agama_ibu', mahasiswa_detail_value($detail, 'agama_ibu', isset($agama_ortu[1]) ? $agama_ortu[1] : '')); ?>
						<select name="agama_ibu" class="form-control">
						<option value="-">-Pilih-</option>
						<option value="Islam" <?php if($agama_ibu=="Islam"){echo "selected";} ?>>Islam</option>
						<option value="Hindu" <?php if($agama_ibu=="Hindu"){echo "selected";} ?>>Hindu</option>
						<option value="Budha" <?php if($agama_ibu=="Budha"){echo "selected";} ?>>Budha</option>
						<option value="Katolik" <?php if($agama_ibu=="Katolik"){echo "selected";} ?>>Katolik</option>
						<option value="Kristen" <?php if($agama_ibu=="Kristen"){echo "selected";} ?>>Kristen</option>
						<option value="Lain-Lain" <?php if($agama_ibu=="Lain-Lain"){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pendidikan Terakhir Ibu</label>
				<div class="col-md-9">
						<?php $pendidikan_ibu = mahasiswa_old_value($this, 'pendidikan_ibu', mahasiswa_detail_value($detail, 'pendidikan_ibu', isset($pendidikan_ortu[1]) ? $pendidikan_ortu[1] : '')); ?>
						<select name="pendidikan_ibu" class="form-control">
						<option value="-">-Pilih-</option>
						<option value="S3" <?php if($pendidikan_ibu == "S3"){echo "selected";} ?>>S-3</option>
						<option value="S2" <?php if($pendidikan_ibu == "S2"){echo "selected";} ?>>S-2</option>
						<option value="S1" <?php if($pendidikan_ibu == "S1"){echo "selected";} ?>>S-1</option>
						<option value="D4" <?php if($pendidikan_ibu == "D4"){echo "selected";} ?>>D-4</option>
						<option value="D3" <?php if($pendidikan_ibu == "D3"){echo "selected";} ?>>D-3</option>
						<option value="D2" <?php if($pendidikan_ibu == "D2"){echo "selected";} ?>>D-2</option>
						<option value="D1" <?php if($pendidikan_ibu == "D1"){echo "selected";} ?>>D-1</option>
						<option value="Profesi" <?php if($pendidikan_ibu == "Profesi"){echo "selected";} ?>>Profesi</option>
						<option value="SMA" <?php if($pendidikan_ibu == "SMA"){echo "selected";} ?>>SMA/SMK Sederajat</option>
						<option value="SMP" <?php if($pendidikan_ibu == "SMP"){echo "selected";} ?>>SMP</option>
						<option value="SD" <?php if($pendidikan_ibu == "SD"){echo "selected";} ?>>SD</option>
						<option value="TTS" <?php if($pendidikan_ibu == "TTS"){echo "selected";} ?>>Tidak Tamat SD</option>
						<option value="NA" <?php if($pendidikan_ibu == "NA"){echo "selected";} ?>>Non Akademik</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">No. HP Ibu</label>
				<div class="col-md-9">
							<input type="number" name="hp_ibu" class="form-control" value="<?php echo mahasiswa_old_value($this, 'hp_ibu', mahasiswa_detail_value($detail, 'hp_ibu', isset($hp_ortu[1]) ? $hp_ortu[1] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pekerjaan Ibu</label>
				<div class="col-md-9">
							<input type="text" name="pekerjaan_ibu" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'pekerjaan_ibu', mahasiswa_detail_value($detail, 'pekerjaan_ibu', isset($pekerjaan_ortu[1]) ? $pekerjaan_ortu[1] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Penghasilan Ibu</label>
				<div class="col-md-9">
				<?php $penghasilan_ibu = mahasiswa_old_value($this, 'penghasilan_ibu', mahasiswa_detail_value($detail, 'penghasilan_ibu', isset($penghasilan[1]) ? $penghasilan[1] : '')); ?>
				<select name="penghasilan_ibu" class="form-control">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan1 as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan_ibu == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
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
				<label class="col-md-3 control-label">Nama Wali</label>
				<div class="col-md-9">
						<input type="text" name="nama_wali" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'nama_wali', mahasiswa_detail_value($detail, 'nama_wali', isset($ortu_nama[2]) ? $ortu_nama[2] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir Wali</label>
				<div class="col-md-9">
						<input type="text" name="tempat_lahir_wali" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'tempat_lahir_wali', mahasiswa_detail_value($detail, 'tempat_lahir_wali', isset($ortu_tempat_lahir[2]) ? $ortu_tempat_lahir[2] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Lahir Wali</label>
				<div class="col-md-9">
						<input type="text" id="tanggal3" name="tanggal_lahir_wali" class="form-control" value="<?php echo mahasiswa_old_value($this, 'tanggal_lahir_wali', mahasiswa_detail_value($detail, 'tanggal_lahir_wali', isset($ortu_tgl_lahir[2]) ? $ortu_tgl_lahir[2] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Agama Wali</label>
				<div class="col-md-9">
						<?php $agama_wali = mahasiswa_old_value($this, 'agama_wali', mahasiswa_detail_value($detail, 'agama_wali', isset($agama_ortu[2]) ? $agama_ortu[2] : '')); ?>
						<select name="agama_wali" class="form-control">
						<option value="-">-Pilih-</option>
						<option value="Islam" <?php if($agama_wali=="Islam"){echo "selected";} ?>>Islam</option>
						<option value="Hindu" <?php if($agama_wali=="Hindu"){echo "selected";} ?>>Hindu</option>
						<option value="Budha" <?php if($agama_wali=="Budha"){echo "selected";} ?>>Budha</option>
						<option value="Katolik" <?php if($agama_wali=="Katolik"){echo "selected";} ?>>Katolik</option>
						<option value="Kristen" <?php if($agama_wali=="Kristen"){echo "selected";} ?>>Kristen</option>
						<option value="Lain-Lain" <?php if($agama_wali=="Lain-Lain"){echo "selected";} ?>>Lain-Lain</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pendidikan Terakhir Wali</label>
				<div class="col-md-9">
						<?php $pendidikan_wali = mahasiswa_old_value($this, 'pendidikan_wali', mahasiswa_detail_value($detail, 'pendidikan_wali', isset($pendidikan_ortu[2]) ? $pendidikan_ortu[2] : '')); ?>
						<select name="pendidikan_wali" class="form-control">
						<option value="-">-Pilih-</option>
						<option value="S3" <?php if($pendidikan_wali == "S3"){echo "selected";} ?>>S-3</option>
						<option value="S2" <?php if($pendidikan_wali == "S2"){echo "selected";} ?>>S-2</option>
						<option value="S1" <?php if($pendidikan_wali == "S1"){echo "selected";} ?>>S-1</option>
						<option value="D4" <?php if($pendidikan_wali == "D4"){echo "selected";} ?>>D-4</option>
						<option value="D3" <?php if($pendidikan_wali == "D3"){echo "selected";} ?>>D-3</option>
						<option value="D2" <?php if($pendidikan_wali == "D2"){echo "selected";} ?>>D-2</option>
						<option value="D1" <?php if($pendidikan_wali == "D1"){echo "selected";} ?>>D-1</option>
						<option value="Profesi" <?php if($pendidikan_wali == "Profesi"){echo "selected";} ?>>Profesi</option>
						<option value="SMA" <?php if($pendidikan_wali == "SMA"){echo "selected";} ?>>SMA/SMK Sederajat</option>
						<option value="SMP" <?php if($pendidikan_wali == "SMP"){echo "selected";} ?>>SMP</option>
						<option value="SD" <?php if($pendidikan_wali == "SD"){echo "selected";} ?>>SD</option>
						<option value="TTS" <?php if($pendidikan_wali == "TTS"){echo "selected";} ?>>Tidak Tamat SD</option>
						<option value="NA" <?php if($pendidikan_wali == "NA"){echo "selected";} ?>>Non Akademik</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">No. HP Wali</label>
				<div class="col-md-9">
						<input type="number" name="hp_wali" class="form-control" value="<?php echo mahasiswa_old_value($this, 'hp_wali', mahasiswa_detail_value($detail, 'hp_wali', isset($hp_ortu[2]) ? $hp_ortu[2] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pekerjaan Wali</label>
				<div class="col-md-9">
						<input type="text" name="pekerjaan_wali" class="form-control title-case-input" value="<?php echo mahasiswa_old_value($this, 'pekerjaan_wali', mahasiswa_detail_value($detail, 'pekerjaan_wali', isset($pekerjaan_ortu[2]) ? $pekerjaan_ortu[2] : '')) ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Penghasilan Wali</label>
				<div class="col-md-9">
				<?php $penghasilan_wali = mahasiswa_old_value($this, 'penghasilan_wali', mahasiswa_detail_value($detail, 'penghasilan_wali', isset($penghasilan[2]) ? $penghasilan[2] : '')); ?>
				<select name="penghasilan_wali" class="form-control">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan2 as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan_wali == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
			            <?php } ?>
			        </select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Alamat Wali</label>
				<div class="col-md-9">
						<textarea class="form-control" name="alamat_wali"><?php echo mahasiswa_old_value($this, 'alamat_wali', mahasiswa_detail_value($detail, 'alamat_wali', isset($ortu_alamat[1]) ? $ortu_alamat[1] : '')) ?></textarea>
				</div>
			</div>


			</div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->



	<div class="col-md-12"><hr>
	<div class="form-group">
		<div class="col-md-12" style="text-align: right;">
			<a href="<?php echo base_url('admin/home/formulir?step=utama') ?>" class="btn btn-default btn-back-utama"><i class="fa fa-arrow-left"></i> Kembali ke Data Utama</a>
			<button class="btn btn-default btn-prev-step" type="button" style="display:none"><i class="fa fa-arrow-left"></i> Kembali ke Data Diri</button>
				<button class="btn btn-primary btn-next-step" name="simpan_data_diri" value="1" type="submit"><i class="fa fa-arrow-right"></i> Simpan Data Diri & Lanjutkan</button>
				<button class="btn btn-success btn-submit-step" name="simpan_orang_tua" value="1" type="submit" style="display:none"><i class="fa fa-save"></i> Simpan Data</button>
			<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
			
		</div>
</div>
</div>

<?php echo form_close(); ?>
</div>
</section>
