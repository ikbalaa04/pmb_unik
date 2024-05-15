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
<?php echo form_open(base_url('admin/home/form_wali'),'class="form-horizontal"'); ?>
<input type="hidden" name="id" value="<?php echo $detail->id?>">
<div class="col-md-12"><hr></div>
<div class="col-md-12"><center><h2><b>Data Orang Tua</b></h2></center></div>
<div class="col-md-12"><hr></div>
<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">Nama Ayah</label>
	<div class="col-md-9">
		<?php $ortu_nama = explode(",", $detail->ortu_nama ); ?>
		<input type="text" name="ortu_nama[0]" class="form-control" value="<?php echo $ortu_nama[0] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tempat Lahir Ayah</label>
	<div class="col-md-9">
		<?php $ortu_tempat_lahir = explode("|", $detail->ortu_tempat_lahir ); ?>
		<input type="text" name="ortu_tempat_lahir[0]" class="form-control" value="<?php echo $ortu_tempat_lahir[0] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tanggal Ayah</label>
	<div class="col-md-9">
		<?php $ortu_tgl_lahir = explode("|", $detail->ortu_tgl_lahir ); ?>
		<input type="text" id="tanggal" name="ortu_tgl_lahir[0]" class="form-control" value="<?php echo $ortu_tgl_lahir[0] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Agama Ayah</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">Pendidikan Terakhir Ayah</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">No. HP Ayah</label>
	<div class="col-md-9">
		<?php $hp_ortu = explode(",", $detail->ortu_hp); ?>
		<input type="number" name="ortu_hp[0]" class="form-control" value="<?php echo $hp_ortu[0] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pekerjaan Ayah</label>
	<div class="col-md-9">
		<?php $pekerjaan_ortu = explode(",", $detail->ortu_pekerjaan); ?>
		<input type="text" name="ortu_pekerjaan[0]" class="form-control" value="<?php echo $pekerjaan_ortu[0]  ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Penghasilan Ayah</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">Alamat Orang Tua</label>
	<?php $ortu_alamat = explode("|", $detail->ortu_alamat ); ?>
	<div class="col-md-9">
		<textarea class="form-control" name="ortu_alamat[0]" required=""><?php echo $ortu_alamat[0]?></textarea>
	</div>
</div>

</div>

<div class="col-md-6">
<div class="form-group">
	<label class="col-md-3 control-label">Nama Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_nama[1]" class="form-control" value="<?php echo $ortu_nama[1] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tempat Lahir Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_tempat_lahir[1]" class="form-control" value="<?php echo $ortu_tempat_lahir[1] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tanggal Lahir Ibu</label>
	<div class="col-md-9">
		<input type="text" id="tanggal2"  name="ortu_tgl_lahir[1]" class="form-control" value="<?php echo $ortu_tgl_lahir[1] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Agama Ibu</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">Pendidikan Terakhir Ibu</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">No. HP Ibu</label>
	<div class="col-md-9">
		<input type="number" name="ortu_hp[1]" class="form-control" value="<?php echo $hp_ortu[1] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pekerjaan Ibu</label>
	<div class="col-md-9">
		<input type="text" name="ortu_pekerjaan[1]" class="form-control" value="<?php echo $pekerjaan_ortu[1]  ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Penghasilan Ibu</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">Nama Wali</label>
	<div class="col-md-9">
		<input type="text" name="ortu_nama[2]" class="form-control" value="<?php echo $ortu_nama[2] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tempat Lahir Wali</label>
	<div class="col-md-9">
		<input type="text" name="ortu_tempat_lahir[2]" class="form-control" value="<?php echo $ortu_tempat_lahir[2] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Tanggal Lahir Wali</label>
	<div class="col-md-9">
		<input type="text" id="tanggal3" name="ortu_tgl_lahir[2]" class="form-control" value="<?php echo $ortu_tgl_lahir[2] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Agama Wali</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">Pendidikan Terakhir Wali</label>
	<div class="col-md-9">
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
	<label class="col-md-3 control-label">No. HP Wali</label>
	<div class="col-md-9">
		<input type="number" name="ortu_hp[2]" class="form-control" value="<?php echo $hp_ortu[2] ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Pekerjaan Wali</label>
	<div class="col-md-9">
		<input type="text" name="ortu_pekerjaan[2]" class="form-control" value="<?php echo $pekerjaan_ortu[2]  ?>" required="">
	</div>
</div>

<div class="form-group">
	<label class="col-md-3 control-label">Penghasilan Wali</label>
	<div class="col-md-9">
	<select name="ortu_penghasilan[2]" class="form-control" required="">
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
		<textarea class="form-control" name="ortu_alamat[1]" required=""><?php echo $ortu_alamat[1]?></textarea>
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
