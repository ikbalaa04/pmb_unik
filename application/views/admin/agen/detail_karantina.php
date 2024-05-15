<button type="button" class="btn btn-sm btn-xs btn-info" data-toggle="modal" data-target="#Detail-<?php echo $karantina->id?>">
      <i class="fa fa-eye"> Lihat</i>
  </button>

  <div class="modal fade" id="Detail-<?php echo $karantina->id?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center" id="myModalLabel"><b>Detail Bukti Bayar</b></h3>
              </div>
              <div class="modal-body">
              	<table id="example1" class="table table-bordered table-striped">
              		<tbody>
              			<tr>
              				<td><b>Nama Lengkap Mahasiswa </b></td>
              				<td>:</td>
              				<td><b><?php echo $karantina->nama_lengkap?></b></td>
              			</tr>
                    <tr>
                      <td><b>Nama Pengirim </b></td>
                      <td>:</td>
                      <td><b><?php echo $karantina->atas_nama?></b></td>
                    </tr>
                    <tr>
                      <td><b>Nama Bank / Metode Pembayaran </b></td>
                      <td>:</td>
                      <td><b><?php echo $karantina->bank?></b></td>
                    </tr>
              			<tr>
              				<td><b>Tanggal Bayar  </b></td>
              				<td>:</td>
              				<td><b><?php echo date("d M Y", strtotime($karantina->tgl_bayar )) ?></b></td>
              			</tr>
                    <tr>
                      <td><b>Bukti Bayar  </b></td>
                      <td>:</td>
                      <td><center><img src="<?php echo base_url('assets/upload/bukti/thumbs/'.$karantina->bukti_bayar)?>" class="img img-responsive img-thumbnail" width="100%"><br><br>
                      <a href="<?php echo base_url('admin/home/unduh/'.$karantina->id)?>" class="btn btn-primary"><i class="fa fa-download"></i> Download Bukti</a></center></td>
                    </tr>
              		</tbody>
              	</table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

