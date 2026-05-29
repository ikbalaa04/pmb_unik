<div class="row">
  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Export Data SIAKAD</h3>
      </div>
      <form method="post" action="<?php echo base_url('admin/home/export_data_siakad'); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tahun Ajar PMB</label>
                <select name="id_thn_akademik" class="form-control">
                  <option value="all">Semua Tahun Ajar</option>
                  <?php foreach ($tahun_akademik as $ta) { ?>
                    <option value="<?php echo $ta->id_thn_akademik; ?>"><?php echo $ta->nama_thn_akademik; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Prodi Lulus</label>
                <select name="prodi" class="form-control">
                  <option value="all">Semua Prodi</option>
                  <?php foreach ($list_prodi as $prodi) { ?>
                    <option value="<?php echo $prodi->jenjang.'|'.$prodi->kode; ?>">
                      <?php echo $prodi->jenjang.' '.$prodi->nama.' (Kode: '.$prodi->kode.', ID PMB: '.$prodi->id.')'; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Tahun Ajar SIAKAD</label>
                <input type="text" name="tahun_ajar" class="form-control" value="<?php echo $default_tahun; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tahun Masuk SIAKAD</label>
                <input type="text" name="tahun_masuk" class="form-control" value="<?php echo $default_tahun; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control" placeholder="Opsional">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                  <option value="1">1 - Aktif</option>
                  <option value="2">2 - Cuti</option>
                  <option value="3">3 - DO</option>
                  <option value="0">0 - Lulus/Keluar</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
	                <label>Sumber NIM</label>
	                <select name="sumber_nim" class="form-control">
	                  <option value="nim">NIM PMB</option>
	                  <option value="noujian">No. Ujian</option>
	                  <option value="username">Username</option>
	                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-file-excel-o"></i> Export XLSX
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
