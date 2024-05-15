<?php if($this->session->userdata('id_level') == '3') {?>
      <div class="row">
<!--       <div class="col-lg-4">
      <div class="panel panel-primary">  
      <div class="panel-body"> 
      <table  class="table table-bordered table-striped">
          <thead>
             <tr>
               <th colspan="2" align="center" style="font-family: 'Zapf-Chancery', cursive;"><center>Kelengkapan Syarat</center></th>
             </tr>
              <tr>
                  <th width="200"><center>Upload Bukti Bayar</center></th>
                  <th><center>Upload Berkas</center></th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td align="center"><?php if($detail->file_konfirmasi == '') { ?>
                      <span class="label label-danger">Belum</span>
                      <?php }else{ ?>
                      <span class="label label-success">Sudah</span>
                      <?php } ?>
                  </td>
                  <td align="center"><?php if($detail->berkas == '') { ?>
                      <span class="label label-danger">Belum Ada</span>
                      <?php }else{ ?>
                      <span class="label label-success">Sudah</span>
                      <?php } ?>
                  </td>
              </tr>
          </tbody>
        </table>

      </div>
      </div>
      </div> -->

      <div class="col-lg-6">
      <div class="panel panel-primary">  
      <div class="panel-body"> 
      <table  class="table table-bordered table-striped">
          <thead>
             <tr>
               <th colspan="2" align="center" style="font-family: 'Zapf-Chancery', cursive;"><center>Status Verifikasi</center></th>
             </tr>
              <tr>
                  <th width="200"><center>Pembayaran Terverifikasi</center></th>
                  <th><center>Berkas Terverifikasi</center></th>
              </tr>
          </thead>
          <tbody>
              <tr> 
                  <td align="center"><?php if($detail->approve == '0') { ?>
                      <span class="label label-danger">Belum</span>
                      <?php }else{ ?>
                      <span class="label label-success">Sudah</span>
                      <?php } ?>
                  </td>
                  <td align="center"><?php if($detail->verifikasi_berkas == '0') { ?>
                      <span class="label label-warning">Belum Diverifikasi</span>
                      <?php }elseif($detail->verifikasi_berkas == '1'){ ?>
                      <span class="label label-danger">Berkas Ditolak</span>
                      <?php }elseif($detail->verifikasi_berkas == '2'){ ?>
                      <span class="label label-success">Terverifikasi</span>
                      <?php } ?>
                  </td>
              </tr>
          </tbody>
        </table>

      </div>
      </div>
      </div>

      <div class="col-lg-6">
      <div class="panel panel-primary">  
      <div class="panel-body"> 
      <table  class="table table-bordered table-striped">
          <thead>
             <tr>
               <th colspan="2" align="center" style="font-family: 'Zapf-Chancery', cursive;"><center>Status Test</center></th>
             </tr>
              <tr>
                  <th width="200"><center>Nomor Ujian</center></th>
                  <!-- <th><center>Status Kelulusan</center></th> -->
              </tr>
          </thead>
          <tbody>
              <tr> 
                  <td align="center"><?php if($detail->noujian == '') { ?>
                      <span class="label label-danger">Belum Ada</span>
                      <?php }else{ ?>
                        <span class="label label-success"><?php echo $detail->noujian?></span>
                      <?php } ?>
                  </td>
                  <!-- <td align="center"><?php if($detail->fix == '0' && $detail->non_fix == '0' ) { ?>
                      <span class="label label-warning">Belum Tes</span>
                      <?php }elseif($detail->fix == '1' && $detail->non_fix == '0' ){ ?>
                      <span class="label label-success">Lulus</span>
                      <?php }elseif($detail->fix == '0' && $detail->non_fix == '1' ){ ?>
                      <span class="label label-danger">Tidak Lulus</span>
                      <?php } ?>
                  </td> -->
              </tr>
          </tbody>
        </table>

      </div>
      </div>
      </div>
      </div><hr>
      
      <div class="row">
      <div class="col-lg-12">
      <div class="panel panel-default">  
      <div class="panel-body"> 
        <center><a target="_blank" href="<?php echo base_url('admin/home/cetak_popup/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-print"></i> Cek Detail Registrasi Pembayaran</a></center><hr>
        <?php $detail_institusi  = $this->admin_model->detail_institusi();?>

        <p style="text-align:center">&nbsp;</p>

        <h3 style="text-align:center"><strong>Link Group&nbsp;WA Tes CBT &amp; WAWANCARA akan otomatis ada pada bagian ini Setelah status pembayaran sudah diverifikasi</strong></h3>

        <?php if($detail->approve=='1'){?>
            <?php echo $detail_institusi->wa_group ?>
        <?php } ?>
         <p style="text-align:center">&nbsp;</p><hr>

        <?php echo $detail_institusi->tutorial_dasbor ?>
      </div>
      </div>
      </div>
      </div>

  <?php }elseif($this->session->userdata('id_level') == '1' || $this->session->userdata('id_level') == '2') { ?>

      <div class="row">
      <div class="col-lg-2"></div>
      <center>
      <div class="col-lg-8">
      <div class="panel panel-primary">  
      <div class="panel-body"> 
      <h3 align="center" >Statistik Pendaftar Farmasi</h3><hr>
      <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
          <thead>
              <tr>
                  <th width="20">No</th>
                  <th width="250">Gelombang</th>
                  <th>Pendafatar</th>
                  <th>Terverifikasi</th>
                  <th>Diterima</th>
                  <th>Gagal</th>
              </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach($total_pendaftar as $total_pendaftar) { 
              ?>
               
              <tr> 
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $total_pendaftar->nama_gelombang ?></td>
                  <td><?php echo $total_pendaftar->verifikasi ?></td>
                  <td><?php echo $total_pendaftar->terverifikasi ?></td>
                  <td><?php echo $total_pendaftar->fix ?></td>
                  <td><?php echo $total_pendaftar->non_fix ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      </div>
      </div>
      </div>
      </center>
      <div class="col-lg-2"></div>
      <div class="col-lg-12"><hr></div>
      <center>
      <div class="col-lg-6">
      <div class="panel panel-primary">  
      <div class="panel-body"> 
      <h3 align="center" >Statistik Pendaftar Kimia</h3><hr>
      <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
          <thead>
              <tr>
                  <th width="20">No</th>
                  <th width="250">Gelombang</th>
                  <th>Pendafatar</th>
                  <th>Terverifikasi</th>
                  <th>Diterima</th>
                  <th>Gagal</th>
              </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach($total_pendaftar_kimia as $total_pendaftar) { 
              ?>
               
              <tr> 
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $total_pendaftar->nama_gelombang ?></td>
                  <td><?php echo $total_pendaftar->verifikasi ?></td>
                  <td><?php echo $total_pendaftar->terverifikasi ?></td>
                  <td><?php echo $total_pendaftar->fix ?></td>
                  <td><?php echo $total_pendaftar->non_fix ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      </div>
      </div>
      </div>
      </center>
      <center>
      <div class="col-lg-6">
      <div class="panel panel-primary">  
      <div class="panel-body"> 
      <h3 align="center" >Statistik Pendaftar Apoteker</h3><hr>
      <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
          <thead>
              <tr>
                  <th width="20">No</th>
                  <th width="250">Gelombang</th>
                  <th>Pendafatar</th>
                  <th>Terverifikasi</th>
                  <th>Diterima</th>
                  <th>Gagal</th>
              </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach($total_pendaftar_apoteker as $total_pendaftar) { 
              ?>
               
              <tr> 
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $total_pendaftar->nama_gelombang ?></td>
                  <td><?php echo $total_pendaftar->verifikasi ?></td>
                  <td><?php echo $total_pendaftar->terverifikasi ?></td>
                  <td><?php echo $total_pendaftar->fix ?></td>
                  <td><?php echo $total_pendaftar->non_fix ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      </div>
      </div>
      </div>
      </center>
      </div> 
      <?php } ?>  	  
      <hr>