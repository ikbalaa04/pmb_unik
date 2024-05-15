     <?php $detail_institusi = $this->admin_model->detail_institusi(); ?>
     <div class="row">
      <div class="col-lg-12">
      <div class="panel panel-primary">  
      <div class="panel-body"> 

      <h3 align="center" >Laporan Keuangan <?php $detail_institusi = $this->admin_model->detail_institusi(); echo $detail_institusi->nama ?> 
      <?php $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); ?>
        <?php echo $ambil_detail_thn_akademik->nama_thn_akademik ?>
      </h3><hr>
      <center>
      <div class="rspv-tabel">
      <table id="example1" class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th width="20">No</th>
                  <!-- <th width="300">Fakultas</th> -->
                  <th width="250">Program Studi</th>
                  <th>Registrasi Terverifikasi</th>
                  <th>Biaya Registrasi</th>
                  <th>Total</th>
              </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach($keuangan as $keuangan) { ?>
              <?php $kode = $keuangan->jurusan_pilihan;
                    $total = $this->admin_model->ambil_approve($kode);

              ?>
              <tr> 
                  <td><?php echo $i++ ?></td>
                  <!-- <td><?php echo $keuangan->nama_fakultas ?></td> -->
                  <td><?php echo $keuangan->jenjang ?> <?php echo $keuangan->nama_prodi ?> </td>
                  <td><?php echo count($total) ?> Orang</td>
                  <td><?php echo "Rp. " . number_format($keuangan->jumlah_biaya,2,',','.');  ?></td>
                  <?php $jum_orang = count($total);
                   $total_keseluruhan = $jum_orang*$keuangan->jumlah_biaya; ?>
                  <td><?php echo "Rp. " . number_format($total_keseluruhan,2,',','.');  ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
        </center>

      </div>
      </div>
      </div>
      </div> 	  
      <hr>