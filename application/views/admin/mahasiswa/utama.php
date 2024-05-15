

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
<?php echo form_open_multipart(base_url('admin/home/form_utama/'),'class="form-horizontal"'); ?>

<?php if($detail->bayar == 0){?>
<?php $program = $detail->program;
$detail_program  = $this->admin_model->kartu_program($program);  ?>
<?php if($detail_program->tipe_program =='Gratis'){ ?>
<div class="col-md-12"><center><b style="color:green"> Untuk pendaftaran jalur PMDK dan Prestasi gratis, Cukup upload berkas raport sesuai form yang kami sediakan, menu lain dan menu upload berkas akan muncul setelah data anda diverifikasi, silahkan lengkapi semua data dan tunggu veririfikasi admin, silahkan hubungi admin jika dalam 1x24 jam data anda belum diverifikasi</b></center><hr></div>
<?php }else{ ?>
<div class="col-md-12"><center><b style="color:blue">Menu lain akan muncul jika semua data yang telah anda lengkapi sudah terverifikasi, silahkan lengkapi semua data dan tunggu veririfikasi admin, silahkan hubungi admin jika dalam 1x24 jam data anda belum diverifikasi, jika sudah terverifikasi silahkan melakukan registrasi pendaftaran di menu Registrasi Pendaftaran</b></center><hr></div>

<?php }}elseif($detail->bayar == 1){ ?>

    <?php if($detail->program !='19'){ ?>
    <div class="col-md-12"><b style="color:green"><marquee>Data kelengkapan anda sudah terverifikasi, Silahkan segera lakukan registrasi pendaftaran di menu Registrasi Pendaftaran, dan upload berkas-berkas di menu Upload berkas, nanti akan ada verifikasi lanjutan dari admin, jika sudah ada verifikasi lanjutan maka nomor ujian anda akan otomatis tergenerate. terimakasih !!! </marquee></b><hr></div>
    <?php }else{ ?>
    <div class="col-md-12"><b style="color:green"><marquee>Data kelengkapan anda sudah terverifikasi, Silahkan segera lakukan upload berkas-berkas di menu Upload berkas, nanti akan ada verifikasi lanjutan dari admin, untuk pendaftar jalur PMDK atau Prestasi hanya mengikuti wawancara saja tidak ikut ujian seleksi masuk metode CBT. terimakasih !!! </marquee></b><hr></div>
    <?php } ?>
<?php }?>

<div class="col-md-12"><center><h2><b>Profil Utama</b></h2></center></div>
<div class="col-md-12"><hr></div>
<div class="col-md-1"></div>
<div class="col-md-9">


<div class="form-group">
    <label class="col-md-3 control-label">Username</label>
    <div class="col-md-9">
        <input required="" type="text" readonly="" class="form-control" value="<?php echo $detail->username ?>">
    </div>
</div>


<div class="form-group">
	<label class="col-md-3 control-label">Gelombang Pilihan 1</label>
	<div class="col-md-9">
		<select disabled="" name="gelombang" class="form-control">
	        <option selected disabled>-Pilih-</option>
	            <?php foreach($pilih_gelombang as $pilih_gelombang) {?>
	        	<option value="<?php echo $pilih_gelombang->id?>" <?php if($detail->gelombang ==$pilih_gelombang->id){echo "selected";} ?>><?php echo $pilih_gelombang->nama_fakultas ?> - <?php echo $pilih_gelombang->nama?></option>
	            <?php } ?>
	        </select>
	</div>
</div>


<div class="form-group">
	<label class="col-md-3 control-label">Pilihan 1</label>
	<div class="col-md-9">
	<select name="jurusan_pilihan" disabled="" class="form-control">
        <option value="">-Pilih-</option>
            <?php foreach($prodi as $prodi) {?>
        	<option value="<?php echo $prodi->kode?>" <?php if($detail->jurusan_pilihan == $prodi->kode){echo "selected";}elseif($this->input->post('jurusan_pilihan')==$prodi->kode){echo "selected";} ?>><?php echo $prodi->jenjang?> <?php echo $prodi->nama?></option>
            <?php } ?>
        </select>
	</div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Gelombang Pilihan 2</label>
    <div class="col-md-9">
        <select disabled="" class="form-control">
            <option selected disabled>-Pilih-</option>
                <?php foreach($pilih_gelombang_2 as $pilih_gelombang_2) {?>
                <option value="<?php echo $pilih_gelombang_2->id?>" <?php if($detail->gelombang_2 ==$pilih_gelombang_2->id){echo "selected";} ?>><?php echo $pilih_gelombang_2->nama_fakultas ?> - <?php echo $pilih_gelombang_2->nama?></option>
                <?php } ?>
            </select>
    </div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pilihan 2</label>
	<div class="col-md-9">
	<select name="jurusan_pilihan2" disabled="" class="form-control">
        <option value="">-Pilih-</option>
            <?php   
            foreach($prodi1 as $prodi1) {?>
        	<option value="<?php echo $prodi1->kode?>" <?php if($detail->jurusan_pilihan2 == $prodi1->kode){echo "selected";}elseif($this->input->post('jurusan_pilihan2')==$prodi1->kode){echo "selected";} ?>><?php echo $prodi1->jenjang?> <?php echo $prodi1->nama?></option>
            <?php } ?>
        </select>
	</div>	
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Jalur Pendaftaran</label>
    <div class="col-md-9">
    <?php if($detail->program!=''){
    $id = $detail->program;
    $program = $this->admin_model->detail_program($id); ?>
    <input type="hidden" name="program"  class="form-control" value="<?php echo $detail->program ?>">
    <input type="text" readonly="" class="form-control" value="<?php echo $program->nama ?>">
    <?php }else{?>
    <?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?> 
          <select class="form-control" name="program" required="">
          <option value="">-Pilih-</option>
          <?php foreach($list_program_aktif as $list_program_aktif){ ?>
            <option value="<?php echo $list_program_aktif->id ?>" <?php if($this->input->post('program')== $list_program_aktif->id ){echo "selected";}?>><?php echo $list_program_aktif->nama ?></option>
          <?php }?>
        </select>
    <?php }?>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Jenis Pendaftaran</label>
    <div class="col-md-9">
        <select name="jenis" class="form-control" required="">
        <option value="">-Pilih-</option>
            <?php foreach($list_jenis as $list_jenis) {?>
            <option value="<?php echo $list_jenis->kode?>" <?php if($detail->jenis==$list_jenis->kode){echo "selected";} ?>><?php echo $list_jenis->nama?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Sumber Referensi</label>
    <div class="col-md-9">
        <select disabled="" name="fakultas" class="form-control">
        <option selected disabled>-Pilih-</option>
            <?php foreach($sumber as $list_sumber) {?>
            <option value="<?php echo $list_sumber->nama?>" <?php if($detail->sumber == $list_sumber->nama){echo "selected";} ?>><?php echo $list_sumber->nama ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<?php if($detail->sumber=='Lainnya' || $detail->sumber=='Sosial Media' ) { ?>
<div class="form-group">
    <label class="col-md-3 control-label">Keterangan Sumber <?php echo $detail->sumber ?> apa?</label>
    <div class="col-md-9">
        <?php if($detail->keterangan_sumber !=''){?>
        <input required="" type="text" name="keterangan_sumber" class="form-control" value="<?php echo $detail->keterangan_sumber ?>">
        <?php }else{?>
        <input required="" type="text" name="keterangan_sumber" class="form-control" value="<?php echo set_value('keterangan_sumber') ?>">
    <?php }?>
    </div>
</div>
<?php }elseif($detail->sumber=='Dosen UNIGA' || $detail->sumber=='Dosen Luar UNIGA' || $detail->sumber=='Mahasiswa UNIGA' || $detail->sumber=='Mahasiswa Non-UNIGA' || $detail->sumber=='Mahasiswa FKWU' || $detail->sumber=='Alumni' || $detail->sumber=='Staf / Karyawan UNIGA') { ?>
<div class="form-group">
    <label class="col-md-3 control-label">Tulis Nama <?php echo $detail->sumber ?> beserta Nomor telponya. contoh : Bpk/Ibu/Sdr/i Fulan (087459458345)</label>
    <div class="col-md-9">
        <?php if($detail->keterangan_sumber !=''){?>
        <input required="" type="text" name="keterangan_sumber" class="form-control" value="<?php echo $detail->keterangan_sumber ?>">
        <?php }else{?>
        <input required="" type="text" name="keterangan_sumber" class="form-control" value="<?php echo set_value('keterangan_sumber') ?>">
    <?php }?>
    </div>
</div>    
<?php } ?>

<hr>
<b style="color: red">Catatan : formulir pada form utama ini wajib diisi semuanya</b>

</div>

<div class="col-md-12"><hr>
<div class="form-group">
	<div class="col-md-11" style="text-align: right;">
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-forward"></i> Selanjutnya</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
		
	</div>
</div>
</div>


<?php echo form_close(); ?>

