
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
            <form method="post" action="<?php echo base_url('agen/data_bank/'.$detail_agen->id)?>">
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
            
            <h3>Akun Bank <hr>	</h3>
              <table width="100%">
                <tbody >
                    <label> Nama Bank </label>
                     <input type="text" class="form-control" name="namabank" value="<?php echo $detail_agen->namabank ?>">

                    <label> Atas Nama </label>
                    <input type="text" class="form-control" name="atas_nama" value="<?php echo $detail_agen->atas_nama ?>">
                    
                    <label> Nomor Rekening </label>
                     <input type="text" class="form-control" name="norek" value="<?php echo $detail_agen->norek ?>">
                                                  
                </tbody>
              </table>
              <hr><button class="btn btn-primary" name="submit"> <i class="fa fa-save"></i> Perbaharui Data</button>

            </div>
            </form>
          </div>
      

        </div>



        </div>

      </div>
    </section><!-- #services -->

