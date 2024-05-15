

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

<?php if ($this->session->userdata('id_level')=='1') { ?>
<div class="row"> 
    <div class="col-lg-12">
      <a href="<?php echo base_url('admin/home/edit_verifikasi/'.$detail->id)?>" class="btn btn-success btn-md"><i class="fa fa-backward"></i> Back </a>
  </div>
</div><br>
<?php } ?>

<div class="row" id="reload">
<?php echo form_open(base_url('admin/home/edit_prodi_pendaftar/'.$detail->id),'class="form-horizontal"'); ?>

<?php 	$id = $detail->id;
		$detail_pendaftaran = $this->admin_model->detail_pendaftaran($id);
		$fakultas 			= $detail_pendaftaran->fakultas;
  		$select_fakultas	= $this->admin_model->select_fakultas($fakultas);
		$id_gelombang = $detail_pendaftaran->gelombang_2;
    	$detail_gelombang = $this->admin_model->detail_gelombang_id($id_gelombang);
    	$fakultas2 = $detail_gelombang->fakultas;
    	$select_fakultas2	= $this->admin_model->select_fakultas2($fakultas2);

  		$list_program 		= $this->admin_model->list_program_fakultas_pendaftar($fakultas);
  		$pilih_gelombang 	  = $this->admin_model->pilih_gelombang_user($fakultas);
  		$pilih_gelombang_2 	  = $this->admin_model->pilih_gelombang_user2($fakultas2);
        $prodi				  = $this->admin_model->admin_prodi($fakultas);
        $prodi1				  = $this->admin_model->admin_prodi2($fakultas2);

        //proses update
        $fakultas 			  = $this->admin_model->get_fakultas();
        $fakultas2 			  = $this->admin_model->get_fakultas();

      ?>

<div class="col-md-12"><h3><b><center>Form Ubah Pilihan Program Studi Via Admin</center></b></h3></div>
<div class="col-md-12"><hr></div>
<div class="col-md-12"><h4><b><center>Pilihan Program Studi saat ini</center></b></h4><br></div>
<div class="col-md-12">
	<div class="form-group">
	<label class="col-md-2 control-label">Gelombang Pilihan 1</label>
	<div class="col-md-10">
		<select disabled="" name="gelombang" class="form-control">
	        <option selected disabled>-Pilih-</option>
	            <?php foreach($pilih_gelombang as $pilih_gelombang) {?>
	        	<option value="<?php echo $pilih_gelombang->id?>" <?php if($detail->gelombang ==$pilih_gelombang->id){echo "selected";} ?>><?php echo $pilih_gelombang->nama_fakultas ?> - <?php echo $pilih_gelombang->nama?></option>
	            <?php } ?>
	        </select>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label">Pilihan 1</label>
	<div class="col-md-10">
	<select name="jurusan_pilihan" disabled="" class="form-control">
        <option value="">-Pilih-</option>
            <?php foreach($prodi as $prodi) {?>
        	<option value="<?php echo $prodi->kode?>" <?php if($detail->jurusan_pilihan == $prodi->kode){echo "selected";}elseif($this->input->post('jurusan_pilihan')==$prodi->kode){echo "selected";} ?>><?php echo $prodi->jenjang?> <?php echo $prodi->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Gelombang Pilihan 2</label>
    <div class="col-md-10">
        <select disabled="" class="form-control">
            <option selected disabled>-Pilih-</option>
                <?php foreach($pilih_gelombang_2 as $pilih_gelombang_2) {?>
                <option value="<?php echo $pilih_gelombang_2->id?>" <?php if($detail->gelombang_2 ==$pilih_gelombang_2->id){echo "selected";} ?>><?php echo $pilih_gelombang_2->nama_fakultas ?> - <?php echo $pilih_gelombang_2->nama?></option>
                <?php } ?>
            </select>
    </div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label">Pilihan 2</label>
	<div class="col-md-10">
	<select name="jurusan_pilihan2" disabled="" class="form-control">
        <option value="">-Pilih-</option>
            <?php   
            foreach($prodi1 as $prodi1) {?>
        	<option value="<?php echo $prodi1->kode?>" <?php if($detail->jurusan_pilihan2 == $prodi1->kode){echo "selected";}elseif($this->input->post('jurusan_pilihan2')==$prodi1->kode){echo "selected";} ?>><?php echo $prodi1->jenjang?> <?php echo $prodi1->nama?></option>
            <?php } ?>
        </select>
	</div>	
</div>
</div>

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

	</div>
	<div class="col-md-6">
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

	</div>


<div class="col-md-12"><hr>
	
<div class="form-group">
	<div class="col-md-10">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan Perubahan</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button><br><br>
	</div>
</div>


</div>

<?php echo form_close(); ?>

</div>







