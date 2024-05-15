<div class="row">
<div class="col-lg-12">
		      <a href="<?php echo base_url('admin/home/agen')?>" class="btn btn-success btn-md"><i class="fa fa-backward"></i> Kembali ke Data Agen </a>
		  </div>
<div class="col-lg-12">

<h4><b><center><?php echo strtoupper($detail_agen->jenis_agen)?> <br><br>
	       NAMA : <?php echo strtoupper($detail_agen->nama) ?></center></b><br></h4>
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead style="text-align: center;">
        <tr style="background-color: lightblue; color: black;">
            <th colspan="6"><center>RIWAYAT PENCAIRAN</center></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal Pencairan</th>
            <th><center>Status Pencairan</center></th>
            <th>Tanggal Sukses</th>
            <th>Pencairan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
		<?php if($komisi_agen){?>
		<?php $i=1; foreach($komisi_agen as $komisi_agen) {?>
	    <tr>
	        <td scope="row"><?php echo $i?></td>
	        <td align="center"> <?php echo date('d M Y H:i',strtotime($komisi_agen->tgl_pengajuan))?></td>
	        <td align="center">
	        	<?php if($komisi_agen->status_pengajuan == 1){?>
	        		<span class="label label-success">Sukses</span>
	        	<?php }else{ ?>
	        		<span class="label label-warning">Menunggu Konfirmasi</span>
	        	<?php } ?>
	        </td>
	        <td><?php echo date('d M Y H:i',strtotime($komisi_agen->tgl_sukses))?></td>
	        <td align="left">Rp. <?php echo number_format($komisi_agen->pengajuan,'0',',','.') ?></td>  
	        <?php if($komisi_agen->status_pengajuan != 1) { ?> 
	                <td align="center">
	                 <div class="overlay-edit">
	                    <a onclick="return confirm('Anda yakin ingin konfirmasi !!!')" href="<?php echo base_url('admin/home/konfirmasi_pengajuan/'.$komisi_agen->id_komisi) ?>" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Konfirmasi</a>
	                </div>
	                </td>
	            <?php }else{ ?>
	            <td align="center">
	                 <div class="overlay-edit">
	                    <a onclick="return confirm('Anda yakin ingin membatalkan konfirmasi !!!')" href="<?php echo base_url('admin/home/batalkan_pengajuan/'.$komisi_agen->id_komisi) ?>" class="btn btn-xs btn-danger"><i class="fa fa-close"></i>  Batalkan Konfirmasi</a>
	                </div>
	            </td>
	        <?php } ?>   
	    </tr>
		<?php $i++; } ?>

		<tr>
			<td colspan="2" align="left"><b>Menunggu Konfirmasi</b></td>
			<td colspan="3" align="left"></td>
			<td align="left"><b>Rp. <?php echo number_format($menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan,'0',',','.') ?></b></td>
		</tr>
		<tr>
			<td colspan="2" align="left"><b>Penarikan Sukses</b></td>
			<td colspan="3"></td>
			<td align="left"><b>Rp. <?php echo number_format($jumlah_agen_pengajuan->jumlah_pengajuan,'0',',','.') ?></b></td>

		</tr>
		<!-- <tr>
			<td colspan="2" align="left">Saldo Sementara</td>
			<td colspan="2" align="left"></td> -->
			<!-- <?php 
			$saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_agen_pengajuan->jumlah_pengajuan;
			$menunggu = $menunggu_jumlah_pengajuan->menunggu_jumlah_pengajuan;

			$menunggu_sementara = $saldo-$menunggu; 
			?> -->
			<!-- <td align="left">Rp. <?php echo number_format($menunggu_sementara,'0',',','.') ?></td>
		</tr> -->
		<tr>
			<td colspan="2" align="left"><b>Total Komisi</b></td>
			<td colspan="3" align="left"></td>
			<!-- <?php $saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_agen_pengajuan->jumlah_pengajuan ?> -->
			<td align="left"><b>Rp. <?php echo number_format($jumlah_komisi_agen->jumlah_komisi,'0',',','.') ?></b></td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td colspan="6" align="center">Belum ada riwayat pencairan</td>
		</tr>
	<?php } ?>

	</tbody>
	</table>
    </div>

</div>
</div>
</div>
</div>

<div class="row">
	<?php if(isset($paginasi)) { ?>
		<div class="paginasi col-sm-12 text-center">
		<?php echo $paginasi;?>
		<div class="clearfix"></div>
		</div>
	<?php }?>
</div><br>

<div class="row"> 
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
       <div class="table-responsive">
              <table width="100%"  class="table">
              	<thead style="text-align: center;">
	                <tr style="background-color: lightblue; color: black;">
	                    <th colspan="3"><center>DATA AKUN REKENING BANK</center></th>
	                </tr>
	                <tr style="background-color: lightgreen; color: black;">
	                    <th>Nama Bank</th>
	                    <th>Atas Nama</th>
	                    <th>Nomor Rekening</th>
	                </tr>
	            </thead>
	            <tbody>
	            	<tr>
	            		<td><?php echo $detail_agen->namabank ?></td>
	            		<td><?php echo $detail_agen->atas_nama ?></td>
	            		<td><?php echo $detail_agen->norek ?></td>
	            	</tr>
	            </tbody>
	        </table>
	    	</div>
		  </div>
		</div>

 