
 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
        </header>

        
        <div class="row">      
          <div class="col-md-2"></div>
          <div class="col-md-8 col-lg-8 wow bounceInUp" data-wow-duration="1.4s">
            <form method="post" action="<?php echo base_url('agen/data_profil/'.$detail_agen->id)?>">
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
            <h3>Profil Utama</h3>
              <table width="100%">
                <tbody >
                    <label> Nama Pengguna </label>
                    <input readonly="" type="text" class="form-control" name="username" value="<?php echo $detail_agen->username ?>">

                    <label> Password </label>
                    <input readonly="" type="text" class="form-control" value="<?php echo $detail_agen->passwordasli ?>">
                      
                    <label> Kode Agen </label>
                     <input readonly="" type="text" class="form-control" name="kode_agen" value="<?php echo $detail_agen->kode_agen ?>">
                    
                    <label> Nama Lengkap </label>
                    <input  type="text" class="form-control" name="nama" value="<?php echo $detail_agen->nama ?>">

                    <label> NIK </label>
                    <input type="text" class="form-control" name="nik" value="<?php echo $detail_agen->nik ?>">

                    <label> Email </label>
                     <input type="text" class="form-control" name="email" value="<?php echo $detail_agen->email ?>">

                    <label> Nomor WA </label>
                    <input type="text" class="form-control" name="hp" value="<?php echo $detail_agen->hp ?>">

                    <label> Kota Asal </label>
                    <input type="text" class="form-control" name="kabupaten" value="<?php echo $detail_agen->kabupaten ?>">

                    <label> Alamat </label>
                    <textarea class="form-control" name="alamat"><?php echo $detail_agen->alamat ?></textarea>                     
                </tbody>
              </table>
              <hr><button class="btn btn-primary" name="submit"> <i class="fa fa-save"></i> Perbaharui Data</button>

            </div>
            </form>
          </div>
      

        </div>



        </div>

    </section><!-- #services -->

