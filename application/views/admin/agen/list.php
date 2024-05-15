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

<div class="row" align="text-center"> 
    <form method="post" action="<?php echo base_url('admin/home/filter_agen')?>">

        <div class="col-lg-3">
            <?php $list_jenis_agen = $this->admin_model->list_jenis_agen();?>
            <select name="jenis_agen" class="form-control" required="">
            <option value="">-Pilih-</option>
            <?php foreach($list_jenis_agen as $list_jenis_agen) {?>
            <option value="<?php echo $list_jenis_agen->jenis_komisi ?>" <?php if($this->input->post('jenis_agen')==$list_jenis_agen->jenis_komisi){echo "selected";} ?>><?php echo $list_jenis_agen->nama_komisi ?> </option>
                <?php } ?>
            </select>
        </div>

      <input type="submit" value="Filter" class="btn btn-info btn-md" style=" border-radius: 5px;">
      <a href="<?php echo base_url('admin/home/agen')?>" class="btn btn-success btn-md"><i class="fa fa-backward"></i> Tanpa Filter</a>
    </form>
</div><br>

<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Nama Agen</th>
            <th>Kode Agen</th>
            <th>Jenis Agen</th>
            <th>Data Mahasiswa</th>
            <th>Pengajuan</th>
            <th>Status Akun</th>
            <th width="100">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php  
          $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
          $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

          $i=1; foreach ($list_agen as $list_agen) { 

          $kode_agen = $list_agen->kode_agen;
          $belum_bayar = $this->admin_model->karantina_agen($id_thn_akademik,$kode_agen);
          $sudah_bayar = $this->admin_model->verifikasi_agen($id_thn_akademik,$kode_agen);
          $terverifikasi = $this->admin_model->accept_agen($id_thn_akademik,$kode_agen);
          $mahasiswa_agen = $this->admin_model->mahasiswa_agen($id_thn_akademik,$kode_agen);
          $total_pengajuan_agen = $this->agen_model->total_pengajuan_agen($id_thn_akademik,$kode_agen);
          ?>
            <tr> 
                <td width="20"><?php echo $i ?></td>
                <td><?php echo $list_agen->nama ?></td>
                <td><?php echo $list_agen->kode_agen ?></td>
                <td><?php echo $list_agen->nama_komisi ?></td>
                <!-- <td><a style="border-radius: 10px" href="<?php echo base_url('admin/home/karantina_agen/'.$list_agen->kode_agen)?>" class="btn btn-xs btn-danger"> <?php echo count($belum_bayar)?> Orang </a></td>
                <td><a style="border-radius: 10px" href="<?php echo base_url('admin/home/verifikasi_agen/'.$list_agen->kode_agen)?>" class="btn btn-xs btn-warning"> <?php echo count($sudah_bayar)?> Orang </a></td> -->
                <td><a style="border-radius: 10px" href="<?php echo base_url('admin/home/accept_agen/'.$list_agen->kode_agen)?>" class="btn btn-xs btn-success"> <?php echo count($mahasiswa_agen)?> Orang </a></td>
                <td><a style="border-radius: 10px" href="<?php echo base_url('admin/home/riwayat_pencairan/'.$list_agen->kode_agen)?>" class="btn btn-xs btn-primary"> <?php echo count($total_pengajuan_agen)?> Pengajuan </a></td>
                <td><center>
                    <?php if($list_agen->status_agen == "1"){ ?>
                    <span class="label label-success">Aktif</span><br>
                    <a href="<?php echo base_url('admin/home/nonaktifkan_agen/'.$list_agen->id) ?>" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> Nonaktifkan</a>
                    <?php }else{ ?>
                    <span class="label label-danger">Tidak Aktif</span><br>
                    <a href="<?php echo base_url('admin/home/aktifkan_agen/'.$list_agen->id) ?>" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Aktifkan</a>
                    <?php } ?>
                    </center>
                </td>
                <td><center>
                <a href="<?php echo base_url('admin/home/edit_data_agen/'.$list_agen->id) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Detail</a></center></td>
            </tr>
         <?php $i++; } ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>

