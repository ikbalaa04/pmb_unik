
<div class="row">
<div class="col-md-12"><hr>

	<div class="form-group">
	<h4 ><center><b>STATUS KELULUSAN <?php echo strtoupper($detail->nama_lengkap)?></b></center></h4><br><hr>
	<div class="col-md-12"><CENTER>
		<?php if($detail->fix == 0) { ?>
			<a href="#" class="btn btn-warning btn-disable"><b>Silahkan cek secara berkala disini setelah anda menyelesaikan tes ujian saringan masuk dan cek juga pada laman berita di http://pmb.mipa.uniga.ac.id untuk informasi hasil kelulusan</b></a>
		<?php }else{ ?>
			<a href="#" class="btn btn-success btn-disable"><b>Selamat anda telah dinyatakan lulus tes seleksi ujian saringan masuk, silahkan lakukan registrasi ulang ke kampus FMIPA UNIGA</b></a>
		<?php } ?></CENTER>
	</div><br><hr>
</div>

</div>
</div>

