
 <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">
        <header class="section-header">
        </header>

        <div class="row">
        <div class="col-md-12"><br><br></div>
        </div>
        
        <div class="row">
        <div class="col-md-1"></div>
          <div class="col-md-9 col-lg-10 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
            <table width="100%">
                <tbody>
                    <tr>
                        <td colspan="2" align="left"><b style="font-size: 25px"><?php echo $detail_agen->nama?></b></td>
                        <td colspan="3" align="left"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left"><b style="font-size: 25px"><?php echo $detail_agen->kode_agen?></b></td>

                        <?php 
                        $jenis_komisi = $detail_agen->jenis_agen;
                        $detail_agen_jenis   = $this->admin_model->detail_agen_jenis($jenis_komisi);?>
                        <td colspan="2" align="left"></td>
                        <td align="right" style="color: blue;"><b style="font-size: 25px"><?php echo $detail_agen_jenis->nama_komisi ?></b></td>
 
                    </tr>
                    <tr>
                        <td colspan="5"><hr></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left"><b>SALDO</b></td>
                        <td colspan="2" align="left"></td>
                        <td align="left"><a style="text-align: center; border-radius: 5px" href="<?php echo base_url('agen/agen_pengajuan')?>" class="btn btn-success btn-sm pull-right"> Pencairan <i class="fa fa-money"></i></a></td>
                    </tr>
                    <?php $saldo = $jumlah_komisi_agen->jumlah_komisi-$jumlah_pengajuan->total_pengajuan ?>
                    <tr>
                        <td colspan="2" align="left"><b>Rp. <?php echo number_format($saldo,'0',',','.') ?></b></td>
                        <td colspan="2" align="left"></td>
                        <td align="left"></td>
                    </tr>


                </tbody>
            </table>
            <hr></p>
              <table width="100%" style="text-align: 2px">
                <tbody >

                    <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/register_maba')?>"><i class="fa fa-pencil-square"></i> Pendaftaran</a></td>
                    </tr> 
                    <!-- <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/member_koordinator')?>"><i class="fa fa-users"></i> Member</a></td>
                    </tr>  -->
                    <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/list_mahasiswa')?>"><i class="fa fa-history"></i> Riwayat Pendaftaran</a></td>
                    </tr> 
                    <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/riwayat_pencarian')?>"><i class="fa fa-money"></i> Riwayat Pencairan</a></td>
                    </tr> 
                    <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/komisi')?>"><i class="fa fa-bar-chart"></i> Riwayat Pendapatan</a></td>
                    </tr> 
                    <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/data_profil/'.$detail_agen->id)?>"><i class="fa fa-user"></i> Data Profil</a></td>
                    </tr> 
                    <tr><td align="left"><a class="btn btn-default" href="<?php echo base_url('agen/data_bank/'.$detail_agen->id)?>"><i class="fa fa-bank"></i> Akun Bank</a></td>
                    </tr> 

                    <tr>
                        <td><hr><a class="btn btn-danger" href="<?php echo base_url('agen/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></td>
                    </tr>                           
                </tbody>
              </table>
            </div>
          </div>
        </div>



        </div>

      </div>
    </section><!-- #services -->



