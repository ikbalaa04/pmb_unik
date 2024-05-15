

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h4><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<center><b>HALAMAN DAFTAR REKOMENDASI ANGGOTA</b></h4></center><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">

     	<div class="box">
          	<div class="table-responsive">
              <table width="100%"  class="table">
              	<thead>
	            	 <tr align="center">
	                    <th>#</th>
	                    <th><center>Nama Anggota</center></th>
	                    <th><center>Kode Anggota</center></th>
	                    <th><center>Jumlah Mahasiswa Diterima</center></th>
	                    <th><center>Aksi</center></th>
	                </tr>
	            </thead>

	            <tbody>
	            	<?php $no=1; foreach($jumlah_agen as $jumlah_agen) { 
                    		 // $kode_agen = $jumlah_agen->kode_agen;
                    		 // $jumlah_maba = $this->admin_model->jumlah_maba_koordinator($kode_agen);
                           
                    	?>
	                <tr>
	                    <th scope="row"><?php echo $no?></th>
                        <td align="center"><?php echo $jumlah_agen->nama?>
                        </td>
                        <td align="center"><?php echo $jumlah_agen->kode_agen?></td>
                        <td align="center"><b style="font-size: 20px"><?php echo $jumlah_agen->jumlah_maba ?></b></td>
                        <td align="center"><a style="border-radius: 5px" href="<?php echo base_url('agen/list_maba_agen/'.$jumlah_agen->kode_agen)?>" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat</a></td>
	                </tr>
	            	<?php $no++; } ?>
	            </tbody>
              </table>
          	  </div>
     	</div>
      </div>

    </div>

  </div>
</section><!-- #services -->


