<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Jenis</th>
            <th>Masuk</th>
            <th>Pengeluaran</th>
            <th>Sisa</th>

        </tr>
      </thead>
      <tbody>
      <?php  $i=1; foreach ($kalkulasi as $kalkulasi) { ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td><?php echo $kalkulasi->jenis_agen ?></td>
                <td>Rp. <?php echo number_format($kalkulasi->saldo,'0',',','.') ?></td>
                <td>Rp. <?php echo number_format($kalkulasi->komisi,'0',',','.') ?></td>
                <td></td>
            </tr>
         <?php $i++; } ?>

         <?php
         $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
         $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
         $total_kalkulasi = $this->admin_model->total_kalkulasi($id_thn_akademik);
         ?>
         <?php  $i=1; foreach ($total_kalkulasi as $total_kalkulasi) { ?>
            <tr>
                <td colspan="2"><b>Total Keseluruhan</b></td>
                <td><b>Rp. <?php echo number_format($total_kalkulasi->saldo_total,'0',',','.') ?></b></td>
                <td><b>Rp. <?php echo number_format($total_kalkulasi->komisi_total,'0',',','.') ?></b></td>
                <?php $total_sisa = $total_kalkulasi->saldo_total-$total_kalkulasi->komisi_total; ?>
                <td><b>Rp. <?php echo number_format($total_sisa,'0',',','.') ?></b></td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>

