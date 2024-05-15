    <section class="portfolio-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h4 class="title-a" style="color: red"><br><br>
                <b>Registrasi Akun Anda Berhasil !</b>
            </h4>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <p align="left">
 		</p>
        <div class="card text-black"> 
        <div class="card-header bg-default">
        <div class="table-container">
          <table class="demo-table responsive" >
            <thead>
            		<tr>
            		<!-- <th>Berikut Data Akun Anda :</th> -->
            		<th colspan="3" >
                  <?php $detail_institusi      = $this->admin_model->detail_institusi(); ?>
                  Silahkan pahami alur pendaftaran berikut :
                  <?php echo $detail_institusi->alur_pendaftaran ?>
                <center><form style="text-align: right;" method="post" target="_blank" action="<?php echo base_url('home/cetak_popup/'.$detail_pendaftar->popup)?>"> 
  					     <button style="text-align: left;" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak Registrasi</button>
                 </center>
  					</form> 
  					</th>
  					</tr>
            </thead>
            </table>

            <table class="demo-table responsive">
            <tbody >	
              <tr>
                <td width="350"> </td>
                <td width="150"><b>EMAIL</b></td>
                <td width="10">:</td>
                <td >
                <?php echo $detail_pendaftar->email?></td>
              </tr>

              <tr>
                <td> </td>
                <td ><b>NAMA LENGKAP</b></td>
                <td>:</td>
                <td >
                <?php echo $detail_pendaftar->nama_lengkap?></td>
              </tr>

              <tr>
                <td> </td>
                <td ><b>USERNAME</b></td>
                <td>:</td>
                <td >
                <?php echo $detail_pendaftar->username?></td>
              </tr>

              <tr>
                <td > </td>
                <td><b>PASSWORD </b></td>
                <td>:</td>
                <td><?php echo $detail_pendaftar->password?>
                </td>
              </tr>
              
            </tbody>
          </table>
        </div>

      <div class="col-md-12"><br><br>
			<center><b><a href="<?php echo base_url('login')?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-sign-in"></i><b> Klik disini untuk login</b></a> 
			</b><br><br></center>
          </div>
        </div>
        </div>
        </div>
        
      </div>
    </div>
  </section>
