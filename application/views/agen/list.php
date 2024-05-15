

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          
        </header>

        <div class="row">
          <div class="col-md-3" ></div>
          <div class="col-md-4 col-lg-6 wow bounceInUp" data-wow-duration="1.4s">
         <center>
            <div class="box" style="text-align: left;">
              <h3><b><center>LOGIN</center></b></h3><br>
            <?php
                  echo validation_errors('<div class="alert alert-warning">','</div>');
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
              ?>      

              <br>
              <table width="100%">
                <tbody >
                  <form method="post" action="<?php echo base_url('agen')?>" >
                  <label>USERNAME </label>
                    
                    <input type="text" class="form-control" name="username" value="<?php echo set_value('username')?>" required placeholder="Masukan username / nama pengguna"><br>

                  <label>PASSWORD </label>
                    
                    <input type="password" class="form-control" name="password" value="<?php echo set_value('password')?>" required placeholder="Masukan password">

                  <tr>
                    <td colspan="3" align="right"><center><br><button type="submit" class="btn btn-primary"> Masuk</button></center></td>
                  </tr>
                  </form>
                                  
                </tbody>
              </table><br>
              <p style="text-align: center;">Lupa password ?<a href="<?php echo base_url('agen/lupa_password')?>"> Klik disini </a> <br>
              Belum punya akun ?<a href="<?php echo base_url('agen/register')?>"> Klik disini </a></p>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->
