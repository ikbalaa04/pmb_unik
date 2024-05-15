    <section id="team" class="team">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="section-title" data-aos="fade-right">
              <h2><br><br>Halaman Kelulusan</h2>
            </div>
          </div>
        </div>

      <div class="row">
        <div class="col-md-12">  
        <form action="<?php echo base_url('home/kelulusan') ?>" method="post" >

            <div class="col-md-4"> 
            <input type="text" required="" class="form-control" name="noujian" placeholder="Silahkan masukan nomor ujian anda"><br>

            <button type="submit" name="submit" style="border-radius: 5px" class="btn btn-primary"><b>Cari No. Ujian</b></button>

            </div>

            <div class="col-md-4"> 
            
            </div>
        
        </form>
        <hr>
        </div>

        <?php if($kelulusan) {?>
        <?php foreach ($kelulusan as $kelulusan) { ?>
        <div class="col-lg-4">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic">
                <center><?php if ($kelulusan->foto == '') { ?>
                <img width="100%" src="<?php echo base_url('assets/noavatarn.png')?>" class="img-fluid">
                <?php }else{ ?>
                <img width="100%" src="<?php echo base_url('assets/upload/profil/thumbs/'.$kelulusan->foto)?>" class="img-fluid">
                <?php }?></center>
              </div>
              <div class="member-info">
                    <h4><?php echo strtoupper($kelulusan->nama_lengkap)?></h4>
                    <p>
                      <?php echo $kelulusan->nama_fakultas ?><br><?php echo $kelulusan->nama_gelombang ?><br>
                      <?php
                      $kode1     = $kelulusan->jurusan_pilihan;
                      $pilihan1  = $this->admin_model->pilihan1($kode1);
                      $kode2     = $kelulusan->jurusan_pilihan2;
                      $pilihan2  = $this->admin_model->pilihan2($kode2);
                      ?>
                      <?php
                      if($kelulusan->jurusan_pilihan !='0'){ ?>
                        Prodi Penerima : <?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> 
                      <?php }else{ ?>
                        -
                      <?php }?>
                     
                      <br>
                      <?php $detail_institusi = $this->admin_model->detail_institusi(); ?>
                      <?php if($detail_institusi->status_batas_lulus == '1'){ ?>
                      <?php   
                      $user_name  = $kelulusan->username;
                      $detail_cbt_user   = $this->admin_model->detail_cbt_user($user_name); 
                      if($detail_cbt_user){
                      $user_id = $detail_cbt_user->user_id;
                      $list_tes_cbt   = $this->admin_model->list_tes_cbt($user_id);
                      }
                      ?>
                      <?php if($detail_cbt_user){ ?>
                            <b>Batas Nilai Lulus : <?php echo $detail_institusi->batas_lulus ?> </b><br>
                            Riwayat Tes : <br>
                      <?php foreach ($list_tes_cbt as $list_tes_cbt) { 
                             $tesuser_id = $list_tes_cbt->tesuser_id;
                             $skor_jawaban_tes   = $this->admin_model->skor_jawaban_tes($tesuser_id);
                      ?>
                             <?php echo $list_tes_cbt->tes_nama ?> (Nilai : <?php echo $skor_jawaban_tes->jumlah_skor ?> )
                             <?php if($skor_jawaban_tes->jumlah_skor >= $detail_institusi->batas_lulus) { ?>
                             <span class="label label-success">CBT : Anda Dinyatakan Lulus</span><br>
                             <?php }else{ ?>
                             <span class="label label-danger">CBT : Anda Belum Lulus</span><br>
                             <?php } ?>
                       <?php }} ?> 
                      <?php } ?>
                      <br>
                      Status : 
                      <?php
                      if($kelulusan->fix =='0' && $kelulusan->non_fix =='0'){ ?>
                        <b style="color: black">Tes Belum Lengkap</b>  
                      <?php }elseif($kelulusan->fix =='0' && $kelulusan->non_fix =='1'){ ?>
                        <b style="color: red">Tidak Lulus</b>
                      <?php }elseif($kelulusan->fix =='1' && $kelulusan->non_fix =='0'){ ?>
                        <b style="color: green">Lulus</b>
                      <?php }?>
                      </p>
                    </div>
          </div>
        </div>  
        <?php }}else{ ?>  
          <div class="col-md-12">
          <center>Belum Ada Data Kelulusan Silahkan Filter Kelulusan</center>
          </div>
        <?php } ?>
      </div>
       <div class="row">
          <?php if(isset($paginasi)) { ?>
              <div class="paginasi col-sm-12 text-center">
              <?php echo $paginasi;?>
              <div class="clearfix"></div>
              </div>
          <?php }?>
          <div class="col-md-12" ><br><br></div>
      </div>
    </div>
  </section>