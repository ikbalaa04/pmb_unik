
 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br><br>&emsp;
        <center><h4><b>HALAMAN PENDAFTARAN MEMBER KOORDINATOR</b></h4></center><br>
        </header>

        
        <div class="row">      
          <div class="col-md-2"></div>
          <div class="col-md-8 col-lg-8 wow bounceInUp" data-wow-duration="1.4s">
            <form method="post" action="<?php echo base_url('agen/member_koordinator')?>">
            <div class="box" style="text-align: left;">
            <?php
              echo validation_errors('<div class="alert alert-danger">','</div>');
              //notif logout
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success">';
                echo $this->session->flashdata('success');
                echo '</div>';
              }   
            ?><br>

            <?php $detail_konfigurasi = $this->admin_model->detail_institusi(); ?>
            
            <?php if($detail_member){?>
              <table width="100%">
                <tbody>
                    <label> Nama Lengkap </label>
                     <p><?php echo $detail_member->nama ?></p>
                     <label> Status Member </label>
                     <?php if($detail_member->status_pendaftaran=='1'){?> 
                     <p style="color: green">Sudah Jadi Member Koordinator</p>
                     <?php }else{ ?>
                     <p style="color: red">Belum Jadi Member Koordinator</p>
                     <?php } ?>                              
                </tbody>
              </table>
              <hr><button class="btn btn-primary" name="submit"> <i class="fa fa-send"></i> Kirim</button>
          <?php }else{ ?>
          	   <h4>Silahkan kirim konfirmasi setelah anda melakukan transfer ke nomor rekening berikut </h4>
          	   <table width="100%">
                <tbody>
                	<label>Nama Bank</label>
                	<input type="text" class="form-control"  readonly="" name="" value="<?php echo $detail_konfigurasi->namabank ?>">
                	<label>Jumlah Registrasi Member</label>
                	<input type="text" class="form-control"  readonly="" name="" value="Rp. <?php echo number_format($detail_konfigurasi->jumlah_member,'0',',','.') ?>">
                	<label>Nomor Rekening</label>
                	<input type="text" class="form-control"  readonly="" name="" value="<?php echo $detail_konfigurasi->norekening ?>"><hr>
                    <label> Nama Lengkap </label>
                     <input type="text" class="form-control" required="" placeholder="Masukan nama lengkap anda" name="nama" value="<?php echo set_value('nama') ?>">                              
                </tbody>
              </table>
              <hr><button class="btn btn-primary" name="submit"> <i class="fa fa-send"></i> Konfirmasi</button>
          <?php } ?>
          	  <hr>
          	  <p><b>FYI : Semua dana pendaftaran member koordinator 100% akan disalurkan untuk pembangunan sekolah atau pesantren</b></p>
            </div>
            </form>
          </div>
      

        </div>



        </div>

      </div>
    </section><!-- #services -->

