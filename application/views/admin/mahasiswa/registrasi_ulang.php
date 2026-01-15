

<div class="row">
<?php $detail_institusi      = $this->admin_model->detail_institusi(); ?>
<div class="col-md-12">
	<b>Status Pembayaran : 
	 <?php if($detail->verifikasi_regis == '0'){ ?>
			<?php if($detail->registrasi_ulang == '0'){ ?>
      <span class="label label-danger"><i class="fa fa-money"></i> Belum Registrasi Ulang</span>
      <?php }else{ ?>
      <span class="label label-warning"><i class="fa fa-check"></i> Registasi Ulang Belum Dicek Admin</span>
		<?php }}else{ ?>
			<span class="label label-success"><i class="fa fa-check"></i> Registasi Ulang Sudah Terverifikasi</span>
		<?php } ?>
  </b><hr>

	<p>1. Silahkan melakukan registrasi pembayaran ke nomor rekening berikut : <br>
	   Nama Bank / AN : <b><?php echo $prodi->namabank ?></b> <br>
	   No. Rekening : <b><?php echo $prodi->norek ?></b> <br>
	   Rincian Registrasi Ulang : <b><?php echo $prodi->rincian_regis ?></b>
	   
	</p>
	<p><span style="color:red;">**</span> Catatan:</p>
	<ul>
	    <li>
	        Ini adalah jumlah pembayaran setelah dikurangi biaya pendaftaran, jika anda belum melakukan registrasi pendaftaran silahkan selesaikan di menu <b>Registrasi Pembayaran</b>
	    </li>
	    <li>
	        Pembayaran minimal adalah <b>Rp1.000.000</b> dengan masa pelunasan sampai dengan priode Ujian Tengah Semester 1
	    </li>
	</ul>
</div>

<div class="col-md-6"><hr>
	<p>2. Silahkan upload bukti registrasi ulang disni :
	<?php echo form_open_multipart(base_url('admin/home/registrasi_ulang_user/'),'class="form-horizontal"'); ?>
            <div class="box" style="text-align: left;"> 

            <?php
  
              if (isset($error)) : ?>
                      <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif;

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

              //notif logout
              if($this->session->flashdata('error')){
                echo '<div class="alert alert-danger">';
                echo $this->session->flashdata('error');
                echo '</div>';
              }  

            ?>    
			                       
              <table width="100%" cellspacing="20px" cellpadding="5px">
              	<tbody >

                    <label>Atas Nama / Nama pengirim transfer</label>
                    <input type="text" class="form-control" name="atas_nama" required value="<?php echo $detail->atas_regis?>" >
                    <label>Nama Bank / Metode pembayaran</label>
                    <input type="text" class="form-control" name="bank" placeholder="Trf/Dana/GoPay/Dll" required value="<?php echo $detail->bank_regis?>" >

                    <label>Tanggal Bayar</label>
                    <input type="text" id="tanggal" class="form-control" id="tanggal" name="tgl_bayar" required value="<?php echo $detail->tgl_regis?>" >

                    <?php if($detail->bukti_regis != "") { ?>
                    <br><label>Bukti Registasi Ulang</label>
											<center><img src="<?php echo base_url('assets/upload/bukti/thumbs/'.$detail->bukti_regis)?>" class="img" width="70%"></center><br>
										<?php } ?>

                    <label>Bukti Registasi Ulang (Maks. 200kb JPG/JPEG/PNG)</label>
                    <input type="file" name="bukti_regis" class="form-control" <?php if($detail->bukti_regis == ''){echo "required";}?> value="<?php echo $detail->bukti_regis ?>" >
                                                 
                </tbody>
              </table>
              <hr>
              <button class="btn btn-primary" name="submit"> <i class="fa fa-upload"></i> Upload</button>
            </div>
   <?php echo form_close(); ?>
	</p>
</div>

<div class="col-md-12">
	<p>3. Selanjutnya silahkan melakukan konfirmasi pembayaran ke nomor whatsapp berikut supaya registrasi ulang segera diverifikasi admin <a class="btn btn-sm btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $detail_institusi->wa_konfirmasi ?>"> <i class="fa fa-whatsapp"></i> <b>ADMIN KEUANGAN</b> </a></p>

</div>

