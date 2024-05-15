

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


<div class="row" id="reload">
<?php echo form_open(base_url('admin/home/tambah_mahasiswa'),'class="form-horizontal"'); ?>

<div class="col-md-12"><h3><b><center>Form Pendaftaran Mahasiswa Baru Via Admin</center></b></h3></div>
<div class="col-md-12"><hr></div>
<div class="col-md-6">
	<?php if($this->input->post('fakultas')==''){?>
	<label><b>Fakultas  </b></label>
	<select required="" class="form-control" name="fakultas" id="fakultas"  onchange="ubah_fak()">
	      <option value="">-Pilih-</option>
	        <?php foreach ($fakultas as $fakultas) { ?>
	            <option  value="<?php echo $fakultas->id ?>" <?php if($this->input->post('fakultas')== $fakultas->id){echo "selected";}?>><?php echo $fakultas->nama_fakultas ?></option>
	        <?php } ?>
	    </select>
	<?php }else{?>
	<label><b>Fakultas  </b></label>

	  <?php 
	  $id = $this->input->post('fakultas');
	  $detail_fakultas = $this->admin_model->detail_fakultas($id); 
	  ?>
	  <input type="hidden" class="form-control" required name="fakultas" id="fakultas" value="<?php echo $detail_fakultas->id ?>"/>
	  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_fakultas->nama_fakultas ?>"/>

	<?php }?>

	<?php if($this->input->post('gelombang')==''){?>
	<label><b>Gelombang </b></label>
	<select required="" class="form-control" name="gelombang" id="gelombang">
	</select>
	<?php }else{?>
	<label><b>Gelombang </b></label>
	<?php 
	  $id = $this->input->post('gelombang');
	  $detail_gelombang = $this->admin_model->detail_gelombang($id); 
	  ?>
	  <input type="hidden" class="form-control" required name="gelombang" id="gelombang" value="<?php echo $detail_gelombang->id ?>"/>
	  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_gelombang->nama ?> - <?php echo $detail_gelombang->tahun ?>"/>
	<?php }?>

	<?php if($this->input->post('prodi')==''){?>
	<label><b>Piliahan Pertama  </b></label>
	<select required=""  class="form-control" name="prodi" id="prodi">
	</select>
	<?php }else{?>
	<label><b>Piliahan Pertama  </b></label>
	  <?php 
	  $kode = $this->input->post('prodi');
	  $detail_prodi = $this->admin_model->detail_prodi_kode($kode); 
	  ?>
	  <input type="hidden" class="form-control" required name="prodi" id="prodi" value="<?php echo $detail_prodi->kode ?>"/>
	  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_prodi->jenjang ?> <?php echo $detail_prodi->nama ?>"/>
	<?php }?>


	<?php if($this->input->post('fakultas2')==''){?>
	<label><b>Fakultas  </b></label>
	<select required="" class="form-control" name="fakultas2" id="fakultas2"  onchange="ubah_fak()">
	      <option value="">-Pilih-</option>
	        <?php foreach ($fakultas2 as $fakultas) { ?>
	            <option  value="<?php echo $fakultas->id ?>" <?php if($this->input->post('fakultas2')== $fakultas->id){echo "selected";}?>><?php echo $fakultas->nama_fakultas ?></option>
	        <?php } ?>
	    </select>
	<?php }else{?>
	<label><b>Fakultas  </b></label>

	  <?php 
	  $id = $this->input->post('fakultas2');
	  $detail_fakultas2 = $this->admin_model->detail_fakultas($id); 
	  ?>
	  <input type="hidden" class="form-control" required name="fakultas2" id="fakultas" value="<?php echo $detail_fakultas2->id ?>"/>
	  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_fakultas2->nama_fakultas ?>"/>

	<?php }?>

	<?php if($this->input->post('gelombang_2')==''){?>
	<label><b>Gelombang </b></label>
	<select required="" class="form-control" name="gelombang_2" id="gelombang_2">
	</select>
	<?php }else{?>
	<label><b>Gelombang </b></label>
	<?php 
	  $id = $this->input->post('gelombang_2');
	  $detail_gelombang = $this->admin_model->detail_gelombang($id); 
	  ?>
	  <input type="hidden" class="form-control" required name="gelombang_2" id="gelombang_2" value="<?php echo $detail_gelombang->id ?>"/>
	  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_gelombang->nama ?> - <?php echo $detail_gelombang->tahun ?>"/>
	<?php }?>

	<?php if($this->input->post('prodi2')==''){?>
	<label><b>Piliahan Kedua   </b></label>
	<select required=""  class="form-control" name="prodi2" id="prodi2">
	</select>
	<?php }else{?>
	<label><b>Piliahan Kedua   </b></label>
	  <?php 
	  $kode = $this->input->post('prodi2');
	  $detail_prodi2 = $this->admin_model->detail_prodi_kode($kode); 
	  ?>
	  <input type="hidden" class="form-control" required name="prodi2" id="prodi2" value="<?php echo $detail_prodi2->kode ?>"/>
	  <input type="text" class="form-control" required readonly="" value="<?php echo $detail_prodi2->jenjang ?> <?php echo $detail_prodi2->nama ?>"/>

	<?php }?>

	<label><b>Jenis Pendafataran  </b></label>
	      <select class="form-control" name="jenis" id="jenis" required="" onchange="ubah_jenis()">
	      <option value="">-Pilih-</option>
	      <option value="MB" <?php if($this->input->post('jenis')=='MB'){echo "selected";}?>>Mahasiswa Baru</option>
	      <option value="PD" <?php if($this->input->post('jenis')=='PD'){echo "selected";}?>>Mahasiswa Pindahan</option>
	    </select>
	</div>

	<div class="col-md-6">

	<label><b>Jalur Pendafataran  </b></label>
	<?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?> 
	      <select class="form-control" name="program" required="">
	      <option value="">-Pilih-</option>
	      <?php foreach($list_program_aktif as $list_program_aktif){ ?>
	        <option value="<?php echo $list_program_aktif->id ?>" <?php if($this->input->post('program')== $list_program_aktif->id ){echo "selected";}?>><?php echo $list_program_aktif->nama ?></option>
	      <?php }?>
	    </select>

	<label><b>NISN </b></label>
	<input type="number" class="form-control" required name="nisn" placeholder="Masukan NISN" value="<?php echo set_value('nisn') ?>"/>


	<label><b>Nama Lengkap </b></label>
	<input type="text" class="form-control" required name="nama_lengkap" placeholder="Masukan nama lengkap" value="<?php echo set_value('nama_lengkap') ?>"/>

	<label><b>
	Nama Pengguna</b></label>
	<input type="text" class="form-control" required name="username" placeholder="Buat nama pengguna / username" value="<?php echo set_value('username') ?>"/>

	<label><b>Kata Sandi</b></label>
	<input type="password" class="form-control" required name="password" placeholder="Buat kata sandi" value="<?php echo set_value('password') ?>"/>

	<label><b>Email </b></label>  
	<input type="email" class="form-control" required name="email" placeholder="Masukan email aktif" value="<?php echo set_value('email') ?>"/>

	<label><b>Nomor WA </b></label>   
	<input type="number" class="form-control" required name="hp" placeholder="Masukan nomor wa" value="<?php echo set_value('hp') ?>"/>

	<label><b>Sumber Referensi </b></label>   
    <select name="sumber" class="form-control" required="">
    <?php $sumber         = $this->admin_model->list_sumber_aktif();?>
      <option value="">-Pilih Sumber Referensi-</option>
      <?php foreach($sumber as $sumber) { ?>
      <option value="<?php echo $sumber->nama ?>" <?php if($this->input->post('sumber')==$sumber->nama){echo "selected";}?>><?php echo $sumber->nama ?></option>
      <?php } ?>
    </select>


	</div>

<div class="col-md-12"><hr>
	
<div class="form-group">
	<div class="col-md-9">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Tambah</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button><br><br>
	</div>
</div>


</div>

<?php echo form_close(); ?>

</div>







