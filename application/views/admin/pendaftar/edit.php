<?php

if (isset($error)) {
	echo '<p class="alert alert-success">';
	echo $error;
	echo '</p>';
}

echo validation_errors('<div class="alert alert-warning">','</div>');  

echo form_open_multipart(base_url('admin/pendaftar/edit/'.$detail->id_pendaftaran),'class="form-horizontal"');

?>

<!-- general form elements disabled -->
<div class="panel-body">
    <div class="col-md-12">
            <div class="form-group">
                <label>Alamat Lokasi Akad Nikah </label>
                    <textarea class="form-control" type="text" name="alamat2" <?php if ($detail->alamat2=='Jalan Otto Iskandar Dinata No. 63') { echo "readonly"; }?> required="required"><?php echo $detail->alamat2 ?></textarea>
            </div>
        </div>
        </div>

<div class="row">
<div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Calon Suami</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
                
                <!-- textarea -->
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Warganegara</label>
                    <select name="warganegara_suami" class="form-control" required="required">
                        <option <?php if ($detail->warganegara_suami =='INDONESIA') { echo "selected"; }?> value="INDONESIA">INDONESIA</option>
                        <option <?php if ($detail->warganegara_suami =='WNA') { echo "selected"; }?> value="WNA">WNA</option>
                    </select>
                </div>
                    
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> NIK Calon Suami</label>
                        <input type="number" name="nik_suami" class="form-control" value="<?php echo $detail->nik_suami?>" required="required"/>
                </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Nama Calon Suami</label>
                        <input type="text" name="nama_suami" class="form-control" value="<?php echo $detail->nama_suami?>" required="required"/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Tempat Calon Suami</label>
                        <input type="text" name="tempat_lahir_suami" class="form-control" value="<?php echo $detail->tempat_lahir_suami?>" required="required"/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Tanggal Lahir Calon Suami</label>
                        <input type="date" name="tgl_lahir_suami" class="form-control" value="<?php echo $detail->tgl_lahir_suami?>" required="required"/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Umur Calon Suami</label>
                        <input type="number" name="umur_suami" class="form-control" value="<?php echo $detail->umur_suami?>" required="required"/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Status</label>
                    <select name="status_suami" class="form-control" required="required">
                        <option <?php if ($detail->status_suami =='Beristri') { echo "selected"; }?> value="Beristri">Beristri</option>
                        <option <?php if ($detail->status_suami =='Jejaka') { echo "selected"; }?> value="Jejaka">Jejaka</option>
                        <option <?php if ($detail->status_suami =='Cerai Mati') { echo "selected"; }?> value="Cerai Mati">Cerai Mati</option>
                        <option <?php if ($detail->status_suami =='Cerai Hidup') { echo "selected"; }?> value="Cerai Hidup">Cerai Hidup</option>
                    </select>
                    </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Agama Calon Suami</label>
                        <input type="text" name="agama_suami" class="form-control" value="<?php echo $detail->agama_suami?>" readonly/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Alamat Calon Suami</label>
                        <textarea type="text" name="alamat_suami" class="form-control" required="required"><?php echo $detail->alamat_suami?></textarea>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Pekerjaan Calon Suami</label>
                        <input type="text" name="pekerjaan_suami" class="form-control" value="<?php echo $detail->pekerjaan_suami?>"/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> Nomer Handphone</label>   
                        <input type="number" name="hp" class="form-control" value="<?php echo $detail->hp?>"/>
                        </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"></i> * Masukan Foto Suami Ukuran 2x3 dengan latar belakang berwarna biru</i></label>    
                   <br><br>
                    <center>
                        <div class="col-md-6"><img src="<?php echo base_url('assets/upload/image/'.$detail->foto_suami)?>" width="100"></div>
                        <div class="col-md-6">
                        <input type="file" multiple="multiple" name="foto_suami" class="form-control" value="<?php echo $detail->foto_suami?>"/>
                        <input type="text" name="foto_suami2" class="form-control" value="<?php echo $detail->foto_suami ?>" />
                        </div>
                        </center>
                </div>
                
                </div>
            </div>
        </div>

        <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Data Calon Istri</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form">
                <!-- text input -->
                
                <!-- textarea -->
                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Warganegara</label>
                    <select name="warganegara_istri" class="form-control" required="required">
                        <option <?php if ($detail->warganegara_istri =='INDONESIA') { echo "selected"; }?> value="INDONESIA">INDONESIA</option>
                        <option <?php if ($detail->warganegara_istri =='WNA') { echo "selected"; }?> value="WNA">WNA</option>
                    </select>
                </div>
                    
                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> NIK Calon Istri</label>
                        <input type="number" name="nik_istri" class="form-control" value="<?php echo $detail->nik_istri?>" required="required"/>
                </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Nama Calon Istri</label>
                        <input type="text" name="nama_istri" class="form-control" value="<?php echo $detail->nama_istri?>" required="required"/>
                        </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Tempat Calon Istri</label>
                        <input type="text" name="tempat_lahir_istri" class="form-control" value="<?php echo $detail->tempat_lahir_istri?>" required="required"/>
                        </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Tanggal Lahir Calon Istri</label>
                        <input type="date" name="tgl_lahir_istri" class="form-control" value="<?php echo $detail->tgl_lahir_istri?>" required="required"/>
                        </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Umur Calon Istri</label>
                        <input type="number" name="umur_istri" class="form-control" value="<?php echo $detail->umur_istri?>" required="required"/>
                        </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Status</label>
                    <select name="status_istri" class="form-control" required="required">
                        <option <?php if ($detail->status_istri =='Perawan') { echo "selected"; }?> value="Beristri">Perawan</option>
                        
                        <option <?php if ($detail->status_istri =='Cerai Mati') { echo "selected"; }?> value="Cerai Mati">Cerai Mati</option>
                        <option <?php if ($detail->status_istri =='Cerai Hidup') { echo "selected"; }?> value="Cerai Hidup">Cerai Hidup</option>
                    </select>
                    </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Agama Calon Istri</label>
                        <input type="text" name="agama_istri" class="form-control" value="<?php echo $detail->agama_istri?>" readonly/>
                        </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Alamat Calon Istri</label>
                        <textarea type="text" name="alamat_istri" class="form-control" required="required"><?php echo $detail->alamat_istri?></textarea>
                        </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> Pekerjaan Calon Istri</label>
                        <input type="text" name="pekerjaan_istri" class="form-control" value="<?php echo $detail->pekerjaan_istri?>"/>
                        </div>

                        <div class="form-group">
                          <input type="hidden" name="bukti" class="form-control" value="<?php echo $detail->bukti ?>" />
                      </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning"></i> * Masukan Foto Istri Ukuran 2x3 dengan latar belakang berwarna biru</i></label>    
                   <br><br>
                    <center>
                        <div class="col-md-6"><img src="<?php echo base_url('assets/upload/image/'.$detail->foto_istri)?>" width="100"></div>
                        <div class="col-md-6">
                        <input type="file" multiple="multiple" name="foto_istri" class="form-control" value="<?php echo $detail->foto_istri?>"/>
                        <input type="text" name="foto_istri2" class="form-control" value="<?php echo $detail->foto_istri ?>" />
                        </div>
                        </center>
                </div>
                
                </div>
            </div>
        </div>

                
                                                             
<div class="form-group">
    <div class="col-md-6"></div>
	<div class="col-md-6"><center><br><br>
		<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
		<button class="btn btn-danger" name="reset" type="reset"><i class="fa fa-times"></i> Reset</button>
        </center>
	</div>
</div>

<?php echo form_close(); ?>
