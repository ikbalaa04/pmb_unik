<div class="row"> 
    <form method="post" action="<?php echo base_url('admin/home/kelulusan_login')?>">
    	<?php $pilih_fakultas = $this->admin_model->pilih_fakultas();?>
        <div class="col-md-3">
            <label>Fakultas</label>
            <select name="fakultas" class="form-control" id="fakultas" >
            <option value="" >-Pilih-</option>
                <?php foreach($pilih_fakultas as $pilih_fakultas) {?>
            <option value="<?php echo $pilih_fakultas->id?>" <?php if($this->input->post('fakultas')==$pilih_fakultas->id){echo "selected";} ?>><?php echo $pilih_fakultas->nama_fakultas?> </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-2">
                <label>Gelombang</label>
                <select required="" class="form-control" name="gelombang" id="gelombang_admin"></select>
        </div>

        <div class="col-md-4">
        	<input type="submit" value="Filter Kelulusan" class="btn btn-info btn-md" style="margin-top: 25px; border-radius: 5px;">
        </div>
      
    </form>
</div><br>
<?php $detail_institusi = $this->admin_model->detail_institusi(); ?>
<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Profil</th>
            <th>Status Kelulusan</th>
            <?php if($detail_institusi->status_batas_lulus == '1'){ ?>
            <th>Status CBT</th>
            <?php } ?>
            <th width="120">No. Ujian</th>
            <th width="20">Program</th>
            <th>Fakultas</th>
            <th>Gelombang</th>
            <th>Jurusan</th>
            <th>Nama Lengkap</th>
            <th>Asal</th>
            
        </tr>
    </thead>
    <tbody>
    <?php $q=1; foreach ($lulus as $lulus) { ?>
        <tr> 

            <td width="20"><?php echo $q ?></td>
            <td><center><?php if ($lulus->foto == '') { ?>
                <img src="<?php echo base_url('assets/noavatarn.png')?>" width="100%" class="img-fluid">
                <?php }else{ ?>
                <img src="<?php echo base_url('assets/upload/profil/thumbs/'.$lulus->foto)?>" width="80%" class="img-fluid">
                <?php }?></center>
            </td>
            <td><?php
	              if($lulus->fix =='0' && $lulus->non_fix =='0'){ ?>
	                <b style="color: black">Tes Belum Lengkap</b>  
	              <?php }elseif($lulus->fix =='0' && $lulus->non_fix =='1'){ ?>
	                <b style="color: red">Tidak Lulus</b>
	              <?php }elseif($lulus->fix =='1' && $lulus->non_fix =='0'){ ?>
	                <b style="color: green">Lulus</b>
	              <?php } ?>
            </td>
            <?php if($detail_institusi->status_batas_lulus == '1'){ ?>
            <td width="250">
                <?php   
                    $user_name  = $lulus->username;
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
                 <?php }} ?> 
            </td>
            <?php } ?> 

            <td width="20"><?php if($lulus->noujian == ''){echo "Belum Ada";}else{echo $lulus->noujian;} ?></td>
            <td width="20"><?php if($lulus->nama_program == ''){echo "Belum diisi";}else{echo $lulus->nama_program;} ?></td>
            <td><?php echo $lulus->singkatan ?></td>
            <td><?php echo $lulus->nama_gelombang ?></td>
            <?php
            $kode1     = $lulus->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $lulus->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>
            <?php
            if($lulus->jurusan_pilihan !='0'){ ?>
              <td><?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> </td>
            <?php }else{ ?>
              <td>-</td>
            <?php }?>

            <td><?php echo $lulus->nama_lengkap ?></td>
            <td><?php if($lulus->sekolah_nama == ''){echo "Belum diisi";}else{echo $lulus->sekolah_nama;} ?></td>
   	

    </tr>
     <?php $q++; } ?>
    </tbody>
	</table>

</div>
</div>
</div>
</div>

