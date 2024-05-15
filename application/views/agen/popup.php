

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h3>POPUP REGISTER</h3><br><br>
        </header>

        <div class="row">
          <div class="col-md-1" ></div>
          <div class="col-md-9 col-lg-10 wow bounceInUp" data-wow-duration="1.4s">
         <center>
            <div class="box">
            <?php
		      echo validation_errors('<div class="alert alert-danger">','</div>');
		      //notif logout
		      if($this->session->flashdata('success')){
		        echo '<div class="alert alert-success">';
		        echo $this->session->flashdata('success');
		        echo '</div>';
		      }   
			?>
			  <h3>Silahkan Simpan Data Anda</h3>
              <table width="100%">
              	<tbody >
              		<tr><td align="left"><label>Username </label></td>
              			<td>:</td>
              			<td align="left"><?php echo $detail_agen->username?></td>
              		</tr>

              		<tr><td align="left"><label>Password </label></td>
              			<td>:</td>
              			<td align="left"><?php echo $detail_agen->passwordasli?></td>
              		</tr>

              		<tr><td align="left" width="200"><label>Nama Lengkap </label></td>
              			<td>:</td>
              			<td align="left"><?php echo $detail_agen->nama?></td>
              		</tr>

              		<tr><td align="left"><label>Email </label></td>
              			<td>:</td>
              			<td align="left"><?php echo $detail_agen->email?></td>
              		</tr>

              		<tr><td align="left"><label>Nomor WA * </label></td>
              			<td>:</td>
              			<td align="left"><?php echo $detail_agen->hp?></td>
              		</tr>

              		<tr><td align="left"><label>Kode Anda </label></td>
              			<td>:</td>
              			<td align="left"><?php echo $detail_agen->kode_agen?></td>
              		</tr>
									                
              	</tbody>
              </table>
              <b style="text-align: right;"><hr><a class="btn btn-primary" href="<?php echo base_url('agen')?>"><i class="fa fa-sign-in"></i> Klik disini untuk Login</a></b>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->




