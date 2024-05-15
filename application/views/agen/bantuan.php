

 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header"><br><br><br>
          <h3><a href="<?php echo base_url('agen/profil')?>" class="btn btn-primary btn-xs pull-left"><i class="fa fa-reply-all"></i> Kembali</a><br>&emsp;
          	<b>Halaman Customer Service</b></h3><br><br>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-duration="1.4s">
         <center>
            <div class="box">
              <div class="table-responsive">
              <table width="100%"  class="table">
              	<thead>
                    <tr align="center">
                      <th>No</th>
                      <th>Nama</th>
                      <th>WhatsApp</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach($user as $user) {  ?>
                    <?php if($user->id_level == '10'){?>
                    <tr>
                        <td align="center"><?php echo $no?></td>
                        <td><?php echo $user->nama?></td>
                        <td><a class="btn btn-xs btn-success" style="border-radius: 10px" target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $user->telp?>&text=Halo%20Kak%20<?php echo $user->nama ?>,%20Saya%20boleh%20minta%20Bantuan?"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"></a></td>
                    </tr>
                    <?php $no++;}} ?>
            </tbody>
              </table>
          	  </div>
            </div>
          </center>
          </div>

        </div>

      </div>
    </section><!-- #services -->
