

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h3>REGISTER</h3><br><br>
        </header>

        <div class="row">
          <div class="col-md-1" ></div>
          <div class="col-md-9 col-lg-10 wow bounceInUp" data-wow-duration="1.4s">
         <center>
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
              <table width="100%">
              	<tbody>
              		<form method="post" action="<?php echo base_url('agen/register')?>" >

                  <label style="text-align: left;">Nama Pengguna </label>
                  <input type="text" class="form-control" name="username" value="<?php echo set_value('username')?>" required>

              		<label>Password </label>
                  <input type="password" class="form-control" name="password" value="<?php echo set_value('password')?>" required>

              		<label>Nama Lengkap *</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama')?>" required>
              		
              		<label>Email </label>
              		<input type="email" class="form-control" name="email" value="<?php echo set_value('email')?>" required >

              		<label>Nomor WA </label>
              		<input type="number" class="form-control" name="hp" value="<?php echo set_value('hp')?>" required>

                  <label>Daftar Sebagai *</label>
                  <?php $list_peran = $this->admin_model->list_peran(); ?>
                  <select class="form-control" name="jenis_agen" required="">
                    <option value="">-Pilih-</option>
                    <?php foreach($list_peran as $list_peran){ ?>
                      <option value="<?php echo $list_peran->jenis_komisi ?>" <?php if($this->input->post('jenis_agen') == $list_peran->jenis_komisi ){echo "selected";}?>><?php echo $list_peran->nama_komisi ?></option>
                    <?php }?>
                  </select>

              		<tr>
              			<td colspan="3"><br><center><button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Daftar</button></center> <br></td>
              		</tr>
              		</form>
									<tr>
                    <td colspan="3"> <p style="text-align: center;">Sudah punya akun ?<a href="<?php echo base_url('agen')?>"> Klik disini </a></p></td>
                  </tr>           
              	</tbody>
              </table>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->




