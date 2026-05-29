

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
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Ayah</label>
					<div class="col-md-9">
						<?php $ortu_nama = explode(",", $detail->ortu_nama ); ?>
						<input type="text" name="ortu_nama[0]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_nama', 0, isset($ortu_nama[0]) ? $ortu_nama[0] : '') ?>" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">NIK Ayah</label>
					<div class="col-md-9">
						<?php $ortu_nik = explode(",", isset($detail->ortu_nik) ? $detail->ortu_nik : ',,'); ?>
						<input type="text" inputmode="numeric" pattern="[0-9]{16}" name="ortu_nik[0]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_nik', 0, isset($ortu_nik[0]) ? $ortu_nik[0] : '') ?>" required="" minlength="16" maxlength="16">
					</div>
				</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir Ayah</label>
				<div class="col-md-9">
					<?php $ortu_tempat_lahir = explode("|", $detail->ortu_tempat_lahir ); ?>
						<input type="text" name="ortu_tempat_lahir[0]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_tempat_lahir', 0, isset($ortu_tempat_lahir[0]) ? $ortu_tempat_lahir[0] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Ayah</label>
				<div class="col-md-9">
					<?php $ortu_tgl_lahir = explode("|", $detail->ortu_tgl_lahir ); ?>
						<input type="text" id="tanggal" name="ortu_tgl_lahir[0]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_tgl_lahir', 0, isset($ortu_tgl_lahir[0]) ? $ortu_tgl_lahir[0] : '') ?>">
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
							<input type="number" name="ortu_hp[0]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_hp', 0, isset($hp_ortu[0]) ? $hp_ortu[0] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pekerjaan Ayah</label>
				<div class="col-md-9">
					<?php $pekerjaan_ortu = explode(",", $detail->ortu_pekerjaan); ?>
							<input type="text" name="ortu_pekerjaan[0]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_pekerjaan', 0, isset($pekerjaan_ortu[0]) ? $pekerjaan_ortu[0] : '') ?>">
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
				<?php $ortu_alamat = explode("|", $detail->ortu_alamat ); ?>
				<div class="col-md-9">
							<textarea class="form-control" name="ortu_alamat[0]"><?php echo mahasiswa_old_array_value($this, 'ortu_alamat', 0, isset($ortu_alamat[0]) ? $ortu_alamat[0] : '') ?></textarea>
				</div>
			</div>

			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-3 control-label">Nama Ibu</label>
					<div class="col-md-9">
						<input type="text" name="ortu_nama[1]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_nama', 1, isset($ortu_nama[1]) ? $ortu_nama[1] : '') ?>" required="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">NIK Ibu</label>
					<div class="col-md-9">
						<input type="text" inputmode="numeric" pattern="[0-9]{16}" name="ortu_nik[1]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_nik', 1, isset($ortu_nik[1]) ? $ortu_nik[1] : '') ?>" required="" minlength="16" maxlength="16">
						<input type="hidden" name="ortu_nik[2]" value="<?php echo isset($ortu_nik[2]) ? $ortu_nik[2] : '' ?>">
					</div>
				</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir Ibu</label>
				<div class="col-md-9">
							<input type="text" name="ortu_tempat_lahir[1]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_tempat_lahir', 1, isset($ortu_tempat_lahir[1]) ? $ortu_tempat_lahir[1] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Lahir Ibu</label>
				<div class="col-md-9">
							<input type="text" id="tanggal2"  name="ortu_tgl_lahir[1]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_tgl_lahir', 1, isset($ortu_tgl_lahir[1]) ? $ortu_tgl_lahir[1] : '') ?>">
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
							<input type="number" name="ortu_hp[1]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_hp', 1, isset($hp_ortu[1]) ? $hp_ortu[1] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pekerjaan Ibu</label>
				<div class="col-md-9">
							<input type="text" name="ortu_pekerjaan[1]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_pekerjaan', 1, isset($pekerjaan_ortu[1]) ? $pekerjaan_ortu[1] : '') ?>">
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
			</div>

			<div class="col-md-12"><hr></div>
			<div class="col-md-12"><center><h2><b>Data Wali</b></h2></center></div>
			<div class="col-md-12"><hr></div>
			<div class="col-md-6">
			<div class="form-group">
				<label class="col-md-3 control-label">Nama Wali</label>
				<div class="col-md-9">
						<input type="text" name="ortu_nama[2]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_nama', 2, isset($ortu_nama[2]) ? $ortu_nama[2] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tempat Lahir Wali</label>
				<div class="col-md-9">
						<input type="text" name="ortu_tempat_lahir[2]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_tempat_lahir', 2, isset($ortu_tempat_lahir[2]) ? $ortu_tempat_lahir[2] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Tanggal Lahir Wali</label>
				<div class="col-md-9">
						<input type="text" id="tanggal3" name="ortu_tgl_lahir[2]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_tgl_lahir', 2, isset($ortu_tgl_lahir[2]) ? $ortu_tgl_lahir[2] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Agama Wali</label>
				<div class="col-md-9">
						<select name="ortu_agama[2]" class="form-control">
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
				<label class="col-md-3 control-label">Pendidikan Terakhir Wali</label>
				<div class="col-md-9">
						<select name="ortu_pendidikan[2]" class="form-control">
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
				<label class="col-md-3 control-label">No. HP Wali</label>
				<div class="col-md-9">
						<input type="number" name="ortu_hp[2]" class="form-control" value="<?php echo mahasiswa_old_array_value($this, 'ortu_hp', 2, isset($hp_ortu[2]) ? $hp_ortu[2] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Pekerjaan Wali</label>
				<div class="col-md-9">
						<input type="text" name="ortu_pekerjaan[2]" class="form-control title-case-input" value="<?php echo mahasiswa_old_array_value($this, 'ortu_pekerjaan', 2, isset($pekerjaan_ortu[2]) ? $pekerjaan_ortu[2] : '') ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Penghasilan Wali</label>
				<div class="col-md-9">
				<select name="ortu_penghasilan[2]" class="form-control">
			        <option value="-">-Pilih-</option>
			            <?php foreach($list_penghasilan2 as $list_penghasilan) {?>
			        	<option value="<?php echo $list_penghasilan->nama?>" <?php if($penghasilan[2] == $list_penghasilan->nama){echo "selected";} ?>><?php echo $list_penghasilan->nama?></option>
			            <?php } ?>
			        </select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Alamat Wali</label>
				<div class="col-md-9">
						<textarea class="form-control" name="ortu_alamat[1]"><?php echo mahasiswa_old_array_value($this, 'ortu_alamat', 1, isset($ortu_alamat[1]) ? $ortu_alamat[1] : '') ?></textarea>
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
