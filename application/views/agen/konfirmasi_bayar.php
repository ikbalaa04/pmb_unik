 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <a href="<?php echo base_url('agen/profil_maba/'.$detail->id)?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>
          <h3>Konfirmasi Bayar</h3><br><br>
        </header>

        <div class="row">
          <div class="col-md-1" ></div>
          <div class="col-md-9 col-lg-10 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box" style="text-align: left;">
            <?php
              echo validation_errors('<div class="alert alert-danger">','</div>');
              //notif logout
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
            ?>


            <?php $detail_institusi      = $this->admin_model->detail_institusi(); ?>
            <div class="col-md-12">
              <b>Status Pembayaran : 
              <?php if($detail->approve == 0){ ?>
                <?php if($detail->bukti_bayar == ''){ ?>
                <span class="badge badge-danger"><i class="fa fa-close"></i> Belum upload pembayaran</span>
              <?php }else{ ?>
                <span class="badge badge-warning"><i class="fa fa-money"></i> Pembayaran Belum Diverifikasi</span>
              <?php }}else{ ?>
                <span class="badge badge-success"><i class="fa fa-check"></i> Pembayaran Telah Terverifikasi</span>
              <?php } ?></b><hr>

                <p>1. Silahkan melakukan registrasi pembayaran ke nomor rekening berikut : <br>
                   Nama Bank / AN : <b><?php echo $prodi->namabank ?></b> <br>
                   No. Rekening : <b><?php echo $prodi->norek ?></b> <br>
                   Biaya Registrasi : <b>Rp. <?php echo number_format($prodi->biaya,'0',',','.') ?></b>
                </p>
            </div>

            <div class="col-md-12">
                <p>2. Jika sudah melakukan pembayaran silahkan isi form berikut :
                <?php echo form_open_multipart(base_url('agen/konfirmasi_pembayaran/'.$detail->id),'class="form-horizontal"'); ?>
                        <div class="box" style="text-align: left;">     
                                               
                          <table width="100%" cellspacing="20px" cellpadding="5px">
                            <tbody >

                                <label>Atas Nama / Nama pengirim transfer</label>
                                <input type="text" class="form-control" name="atas_nama" required value="<?php echo $detail->atas_nama?>" >
                                <label>Nama Bank / Metode pembayaran</label>
                                <input type="text" class="form-control" name="bank" placeholder="Trf/Dana/GoPay/Dll" required value="<?php echo $detail->bank?>" >

                                <label>Tanggal Bayar</label>
                                <input type="text" id="tanggal" class="form-control" id="tanggal" name="tgl_bayar" required value="<?php echo $detail->tgl_bayar?>" >

                                <?php if($detail->bukti_bayar != "") { ?>
                                <br><label>Bukti Pembayaran</label>
                                  <center><img src="<?php echo base_url('assets/upload/bukti/thumbs/'.$detail->bukti_bayar)?>" class="img" width="70%"></center><br>
                                <?php } ?>

                                <label>Bukti Pembayaran (Maks. 200kb JPG/JPEG/PNG)</label>
                                <input type="file" name="bukti_bayar" class="form-control" <?php if($detail->bukti_bayar == ''){echo "required";}?> value="<?php echo $detail->bukti_bayar ?>" >
                                                             
                            </tbody>
                          </table>
                          <hr>
                          <button class="btn btn-primary" name="submit"> <i class="fa fa-send"></i> Kirim</button>
                        </div>
                <?php echo form_close(); ?>
                </p>
            </div>

            <div class="col-md-12">
                <p>3. Selanjutnya silahkan melakukan konfirmasi pembayaran ke nomor whatsapp berikut supaya pembayaran segera diverifikasi admin <a class="btn btn-sm btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $detail_institusi->wa_konfirmasi ?>"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"> <b>ADMIN KEUANGAN</b> </a></p>


            </div>
            </div>
        </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->
