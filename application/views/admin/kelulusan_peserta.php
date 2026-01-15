<?php $detail_institusi = $this->admin_model->detail_institusi(); ?>
<section class="content">
 <div class="row">
      <div class="col-lg-12">
      <div class="panel panel-success">  
      <div class="panel-body"> 
      <div class="rspv-tabel">
      <table  class="table table-bordered table-striped">
          <thead>
              <tr><?php $program = $detail->program;
                  $detail_program  = $this->admin_model->kartu_program($program);  ?>
                  <?php if($detail_program->tipe_program =='Berbayar'){ ?>
                  <th><center>Status Registrasi Pendaftaran</center></th>
                  <th><center>Status Registrasi Ulang</center></th>
                  <?php } ?>
                  <th><center>Status Berkas</center></th>
                  <th><center>Status Kelulusan</center></th>
                  <?php if($detail_institusi->status_batas_lulus == '1'){ ?>
                  <th><center>Status CBT</center></th>
                  <?php } ?>
              </tr>
          </thead>
          <tbody align="center">
              <tr > 
                  <?php $program = $detail->program;
                  $detail_program  = $this->admin_model->kartu_program($program);  ?>
                  <?php if($detail_program->tipe_program =='Berbayar'){ ?>
                  <td align="center"><center>
                    <?php if($detail->approve == 0){ ?>
                      <?php if($detail->bukti_bayar == ''){ ?>
                      <span class="label label-danger"><i class="fa fa-money"></i> Belum upload pembayaran</span>
                    <?php }else{ ?>
                      <span class="label label-warning"><i class="fa fa-eye"></i> Pembayaran Belum Diverifikasi</span>
                    <?php }}else{ ?>
                      <span class="label label-success"><i class="fa fa-check"></i> Pembayaran Telah Terverifikasi</span>
                    <?php } ?>
                  </center></td>
                  <td align="center"><center>
                    <?php if($detail->verifikasi_regis == '0'){ ?>
        			<?php if($detail->registrasi_ulang == '0'){ ?>
                      <span class="label label-danger"><i class="fa fa-money"></i> Belum Registrasi Ulang</span>
                      <?php }else{ ?>
                      <span class="label label-warning"><i class="fa fa-eye"></i> Registasi Ulang Belum Dicek Admin</span>
                		<?php }}else{ ?>
        			<span class="label label-success"><i class="fa fa-check"></i> Registasi Ulang Sudah Terverifikasi</span>
        		<?php } ?>
                  </center></td>
                  <?php } ?>

                  <td align="center"><center>
                    <?php $id_pendaftar = $detail->id;
                    $berkas_terupload = $this->admin_model->berkas_terupload($id_pendaftar);
                    if($berkas_terupload){ ?>
                    <?php if($detail->verifikasi_berkas == 0) { ?>
                        <span class="label label-default">Belum Dicek</span>
                    <?php }elseif($detail->verifikasi_berkas == 1){ ?>
                        <span class="label label-danger">Berkas Ditolak</span>
                        <?php if($detail->keterangan_berkas){ ?>
                        <br>
                         Keterangan Berkas :
                         <textarea class="form-control" readonly="" name="keterangan_berkas"><?php echo $detail->keterangan_berkas?></textarea>  
                         <?php } ?>
                    <?php }else{ ?>
                        <span class="label label-success">Sudah Diverifikasi</span>
                        <?php if($detail->keterangan_berkas){ ?>
                        <br>
                         Keterangan Berkas :
                         <textarea class="form-control" readonly="" name="keterangan_berkas"><?php echo $detail->keterangan_berkas?></textarea>  
                         <?php } ?>   
                    <?php }}else{ ?>
                        <span class="label label-danger">Belum Upload Berkas</span>
                    <?php } ?>
                  </center></td>

                  <td align="center"><center><?php
                  if($detail->fix =='0' && $detail->non_fix =='0'){ ?>
                    <span class="label label-warning"><b>Tes Belum Lengkap</b></span> 
                  <?php }elseif($detail->fix =='0' && $detail->non_fix =='1'){ ?>
                    <span class="label label-danger"><b>Tidak Lulus</b></span>
                  <?php }elseif($detail->fix =='1' && $detail->non_fix =='0'){ ?>
                    <span class="label label-success"><b>Lulus</b></span>
                  <?php } ?></center>
                    </td>


                  <?php if($detail_institusi->status_batas_lulus == '1'){ ?>
                    <td align="center"><center>
                        <?php   
                            $user_name  = $detail->username;
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
                               <span class="label label-success">Anda Dinyatakan Lulus</span><br>
                               <?php }else{ ?>
                               <span class="label label-danger">Anda Belum Lulus</span><br>
                               <?php } ?>
                         <?php }} ?> </center>
                    </td>
                    <?php } ?> 

                    
              </tr>
          </tbody>
        </table>
      </div>

      </div>
      </div>
      </div>

      </div>

</section>
