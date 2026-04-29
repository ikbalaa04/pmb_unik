<?php
$chart_year_labels = array();
$chart_year_totals = array();
$chart_year_index = array();

if (!empty($chart_pendaftar_tahunan_umum)) {
    foreach ($chart_pendaftar_tahunan_umum as $row) {
        $chart_year_labels[] = $row->nama_thn_akademik;
        $chart_year_totals[] = (int) $row->jumlah_pendaftar;
        $chart_year_index[$row->id_thn_akademik] = count($chart_year_labels) - 1;
    }
}

$chart_prodi_datasets_map = array();
if (!empty($chart_pendaftar_tahunan_per_prodi) && !empty($chart_year_labels)) {
    foreach ($chart_pendaftar_tahunan_per_prodi as $row) {
        $prodi_key = (string) $row->kode;
        if (!isset($chart_prodi_datasets_map[$prodi_key])) {
            $chart_prodi_datasets_map[$prodi_key] = array(
                'label' => $row->jenjang . ' - ' . $row->nama_prodi,
                'data'  => array_fill(0, count($chart_year_labels), 0),
            );
        }

        if (isset($chart_year_index[$row->id_thn_akademik])) {
            $chart_prodi_datasets_map[$prodi_key]['data'][$chart_year_index[$row->id_thn_akademik]] = (int) $row->jumlah_pendaftar;
        }
    }
}

$chart_status_umum_data = array(
    isset($chart_status_umum->registrasi) ? (int) $chart_status_umum->registrasi : 0,
    isset($chart_status_umum->diverifikasi) ? (int) $chart_status_umum->diverifikasi : 0,
    isset($chart_status_umum->diterima) ? (int) $chart_status_umum->diterima : 0,
);

$chart_status_prodi_labels = array();
$chart_status_prodi_registrasi = array();
$chart_status_prodi_diverifikasi = array();
$chart_status_prodi_diterima = array();
$chart_status_prodi_legend = array();

if (!empty($chart_status_per_prodi)) {
    foreach ($chart_status_per_prodi as $row) {
        $short_label = $row->kode;
        if (preg_match('/\(([^)]+)\)/', $row->nama_prodi, $matches)) {
            $short_label = $matches[1];
        }

        $chart_status_prodi_labels[] = $short_label;
        $chart_status_prodi_registrasi[] = (int) $row->registrasi;
        $chart_status_prodi_diverifikasi[] = (int) $row->diverifikasi;
        $chart_status_prodi_diterima[] = (int) $row->diterima;
        $chart_status_prodi_legend[] = $short_label . ' = ' . $row->jenjang . ' - ' . $row->nama_prodi;
    }
}
?>

<style type="text/css">
    .chart-panel {
        min-height: 430px;
    }

    .chart-panel .panel-heading {
        font-weight: bold;
    }

    .chart-panel .panel-subtitle {
        display: block;
        margin-top: 4px;
        color: #666;
        font-size: 12px;
        font-weight: normal;
    }

    .chart-panel .chart-wrap {
        position: relative;
        height: 320px;
    }

    .chart-panel canvas {
        width: 100% !important;
        height: 320px !important;
    }

    .chart-panel.chart-panel-tall {
        min-height: 620px;
    }

    .chart-panel.chart-panel-tall .chart-wrap {
        height: 420px;
    }

    .chart-panel.chart-panel-tall canvas {
        height: 420px !important;
    }

    .chart-legend-note {
        margin-top: 15px;
        font-size: 12px;
        line-height: 1.7;
        color: #555;
        column-count: 2;
        column-gap: 24px;
    }

    @media screen and (max-width: 991px) {
        .chart-legend-note {
            column-count: 1;
        }
    }
</style>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style="background-color: lightgreen; color: black;">
            <!-- <th width="20">No</th> -->
            <th>#</th>
            <th width="320">FAKULTAS</th>
            <!-- <th><center>Karantina</center></th> -->
            <th><center>REGISTRASI</center></th>
            <th><center>TERVERIFIKASI</center></th>
            <th><center>GAGAL</center></th>
            <th><center>DITERIMA</center></th>
            <!-- <th><center>Registrasi</center></th> -->
            <th><center>REGISTRASI ULANG</center></th>

        </tr>
      </thead>
      <tbody>
      <?php  $i=1; foreach ($tampil_fakultas as $tampil_fakultas) { 
            $fakultas = $tampil_fakultas->id;

            $ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
            $id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;

            $list_kalkulasi_gelombang = $this->admin_model->list_kalkulasi_gelombang($fakultas,$id_thn_akademik);

            $tampil_prodi_aktif = $this->admin_model->tampil_prodi_aktif($fakultas);

            $total_belum_bayar = $this->admin_model->total_kalkulasi_belum_bayar($id_thn_akademik,$fakultas); 
            $total_sudah_bayar = $this->admin_model->total_kalkulasi_sudah_bayar($id_thn_akademik,$fakultas); 
            $total_terverifikasi = $this->admin_model->total_kalkulasi_terverifikasi($id_thn_akademik,$fakultas); 
            $total_diterima = $this->admin_model->total_kalkulasi_diterima($id_thn_akademik,$fakultas);
            $total_gagal = $this->admin_model->total_kalkulasi_gagal($id_thn_akademik,$fakultas);
            $total_registrasi = $this->admin_model->total_kalkulasi_registrasi($id_thn_akademik,$fakultas);
            $total_fix_registrasi = $this->admin_model->total_kalkulasi_fix_registrasi($id_thn_akademik,$fakultas); 

        ?>
            <tr> 
                <td colspan="9" style="background-color: #E0FFFF; color: black;"><b><?php echo $tampil_fakultas->nama_fakultas ?></b></td>
                <?php foreach ($list_kalkulasi_gelombang as $list_kalkulasi_gelombang) {

                    $gelombang = $list_kalkulasi_gelombang->id;
                    $prodi_pendaftar = $this->admin_model->prodi_pendaftar($id_thn_akademik,$gelombang);

                    $total_belum_bayar_gelombang = $this->admin_model->total_kalkulasi_belum_bayar_gelombang($id_thn_akademik,$gelombang); 
                    $total_sudah_bayar_gelombang = $this->admin_model->total_kalkulasi_sudah_bayar_gelombang($id_thn_akademik,$gelombang); 
                    $total_terverifikasi_gelombang = $this->admin_model->total_kalkulasi_terverifikasi_gelombang($id_thn_akademik,$gelombang); 
                    $total_diterima_gelombang = $this->admin_model->total_kalkulasi_diterima_gelombang($id_thn_akademik,$gelombang);
                    $total_gagal_gelombang = $this->admin_model->total_kalkulasi_gagal_gelombang($id_thn_akademik,$gelombang);
                    $total_registrasi_gelombang = $this->admin_model->total_kalkulasi_registrasi_gelombang($id_thn_akademik,$gelombang);
                    $total_fix_registrasi_gelombang = $this->admin_model->total_kalkulasi_fix_registrasi_gelombang($id_thn_akademik,$gelombang); 
                    
                ?>
                    <tr>
                    <td colspan="9" style="background-color: #F5FFFA; color: black;"><b><?php echo $list_kalkulasi_gelombang->nama ?> - <?php echo $list_kalkulasi_gelombang->tahun ?></b></td>
                        <?php foreach ($prodi_pendaftar as $prodi_pendaftar) { 
                            $prodi = $prodi_pendaftar->kode;
                            //belum bayar
                            $belum_bayar = $this->admin_model->kalkulasi_prodi_belum_bayar($id_thn_akademik,$prodi,$gelombang);
                            //sudah bayar
                            $sudah_bayar = $this->admin_model->kalkulasi_prodi_sudah_bayar($id_thn_akademik,$prodi,$gelombang);
                            //terverifikasi
                            $terverifikasi = $this->admin_model->kalkulasi_prodi_terverifikasi($id_thn_akademik,$prodi,$gelombang);
                            //diterima
                            $diterima = $this->admin_model->kalkulasi_prodi_diterima($id_thn_akademik,$prodi,$gelombang);
                             //gagal
                            $gagal = $this->admin_model->kalkulasi_prodi_gagal($id_thn_akademik,$prodi,$gelombang);
                            //regitrasi
                            $registrasi = $this->admin_model->kalkulasi_prodi_registrasi($id_thn_akademik,$prodi,$gelombang);
                            //fixregitrasi
                            $fix_registrasi = $this->admin_model->kalkulasi_prodi_fix_registrasi($id_thn_akademik,$prodi,$gelombang);
                            ?>

                            <tr style="background-color: white; color: black;">
                                <td></td>
                                <td><?php echo $prodi_pendaftar->jenjang ?> - <?php echo $prodi_pendaftar->nama_prodi ?></td>
                                    <!-- 
                                    <?php //belum bayar
                                    if($belum_bayar){ 
                                    foreach ($belum_bayar as $belum_bayar) { ?>
                                    <td><center><b><?php echo $belum_bayar->belum_bayar ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?> -->

                                    <?php //sudah bayar
                                    if($sudah_bayar){ 
                                    foreach ($sudah_bayar as $sudah_bayar) { ?>
                                    <td><center><b><?php echo $sudah_bayar->sudah_bayar ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                    <?php //sudah terverifikasi
                                    if($terverifikasi){ 
                                    foreach ($terverifikasi as $terverifikasi) { ?>
                                    <td><center><b><?php echo $terverifikasi->terverifikasi ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                    <?php //gagal
                                    if($gagal){ 
                                    foreach ($gagal as $gagal) { ?>
                                    <td><center><b><?php echo $gagal->gagal ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                     <?php //sudah diterima
                                    if($diterima){ 
                                    foreach ($diterima as $diterima) { ?>
                                    <td><center><b><?php echo $diterima->diterima ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                    

                                    <!--  <?php //sudah registrasi
                                    if($registrasi){ 
                                    foreach ($registrasi as $registrasi) { ?>
                                    <td><center><b><?php echo $registrasi->registrasi ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?> -->

                                    <?php //fix registrasi
                                    if($fix_registrasi){ 
                                    foreach ($fix_registrasi as $fix_registrasi) { ?>
                                    <td><center><b><?php echo $fix_registrasi->fix_registrasi ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>
                            </tr>
                        <?php } ?>
                        
                    </tr>

                    <tr style="background-color: white; color: black;">
                                <td></td>
                                <td>Total Gelombang</td>
                                    <!-- <?php //belum bayar
                                    if($total_belum_bayar_gelombang){ 
                                    foreach ($total_belum_bayar_gelombang as $total_belum_bayar_gelombang) { ?>
                                    <td><center><b><?php echo $total_belum_bayar_gelombang->belum_bayar ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?> -->

                                    <?php //sudah bayar
                                    if($total_sudah_bayar_gelombang){ 
                                    foreach ($total_sudah_bayar_gelombang as $total_sudah_bayar_gelombang) { ?>
                                    <td><center><b><?php echo $total_sudah_bayar_gelombang->sudah_bayar ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                    <?php //sudah terverifikasi
                                    if($total_terverifikasi_gelombang){ 
                                    foreach ($total_terverifikasi_gelombang as $total_terverifikasi_gelombang) { ?>
                                    <td><center><b><?php echo $total_terverifikasi_gelombang->terverifikasi ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                    <?php //gagal
                                    if($total_gagal_gelombang){ 
                                    foreach ($total_gagal_gelombang as $total_gagal_gelombang) { ?>
                                    <td><center><b><?php echo $total_gagal_gelombang->gagal ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                     <?php //sudah diterima
                                    if($total_diterima_gelombang){ 
                                    foreach ($total_diterima_gelombang as $total_diterima_gelombang) { ?>
                                    <td><center><b><?php echo $total_diterima_gelombang->diterima ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>

                                    

                                    <!--  <?php //sudah registrasi
                                    if($total_registrasi_gelombang){ 
                                    foreach ($total_registrasi_gelombang as $total_registrasi_gelombang) { ?>
                                    <td><center><b><?php echo $total_registrasi_gelombang->registrasi ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?> -->

                                    <?php //fix registrasi
                                    if($total_fix_registrasi_gelombang){ 
                                    foreach ($total_fix_registrasi_gelombang as $total_fix_registrasi_gelombang) { ?>
                                    <td><center><b><?php echo $total_fix_registrasi_gelombang->fix_registrasi ?></b></center></td>
                                    <?php }}else{ ?>
                                    <td><center><b>0</b></center></td>
                                    <?php } ?>
                            </tr>


                <?php } ?>  
            </tr>

            <tr style="background-color: white; color: black;">
                <td colspan="2" ><b>Total Fakultas</b></td>

                <!-- <?php  //total belum bayar
                if($total_belum_bayar){ 
                $i=1; foreach ($total_belum_bayar as $total_belum_bayar) { ?>
                <td><center><b><?php echo $total_belum_bayar->belum_bayar ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>
                <?php } ?>  -->

                <?php  $i=1; foreach ($total_sudah_bayar as $total_sudah_bayar) { ?>
                <td><center><b>
                    <?php //total sudah bayar
                    if($total_sudah_bayar){ ?>
                    <?php echo $total_sudah_bayar->sudah_bayar ?>
                    <?php }else{ ?>
                    0
                    <?php } ?> 
                </b></center></td>
                <?php } ?>

                <?php  $i=1; foreach ($total_terverifikasi as $total_terverifikasi) { ?>
                <td><center><b>
                    <?php //total terverifikasi
                    if($total_terverifikasi){ ?>
                    <?php echo $total_terverifikasi->terverifikasi ?>
                    <?php }else{ ?>
                    0
                    <?php } ?> 
                </b></center></td>
                <?php } ?>

                <?php  $i=1; foreach ($total_gagal as $total_gagal) { ?>
                <td><center><b>
                    <?php //total gagal
                    if($total_gagal){ ?>
                    <?php echo $total_gagal->gagal ?>
                    <?php }else{ ?>
                    0
                    <?php } ?> 
                </b></center></td>
                <?php } ?>

                <?php  $i=1; foreach ($total_diterima as $total_diterima) { ?>
                <td><center><b>
                    <?php //total diterima
                    if($total_diterima){ ?>
                    <?php echo $total_diterima->diterima ?>
                    <?php }else{ ?>
                    0
                    <?php } ?> 
                </b></center></td>
                <?php } ?>

                
                <!-- <?php  $i=1; foreach ($total_registrasi as $total_registrasi) { ?>
                <td><center><b>
                    <?php //total registrasi
                    if($total_registrasi){ ?>
                    <?php echo $total_registrasi->registrasi ?>
                    <?php }else{ ?>
                    0
                    <?php } ?> 
                </b></center></td>
                <?php } ?> -->

                <?php  $i=1; foreach ($total_fix_registrasi as $total_fix_registrasi) { ?>
                <td><center><b>
                    <?php //total registrasi
                    if($total_fix_registrasi){ ?>
                    <?php echo $total_fix_registrasi->fix_registrasi ?>
                    <?php }else{ ?>
                    0
                    <?php } ?> 
                </b></center></td>
                <?php } ?>
            </tr>
         <?php $i++; } ?>

            <?php
            $total_seluruh_belum_bayar = $this->admin_model->total_seluruh_kalkulasi_belum_bayar($id_thn_akademik);
            $total_seluruh_sudah_bayar = $this->admin_model->total_seluruh_kalkulasi_sudah_bayar($id_thn_akademik);
            $total_seluruh_terverifikasi = $this->admin_model->total_seluruh_kalkulasi_terverifikasi($id_thn_akademik);
            $total_seluruh_diterima = $this->admin_model->total_seluruh_kalkulasi_diterima($id_thn_akademik);
            $total_seluruh_gagal = $this->admin_model->total_seluruh_kalkulasi_gagal($id_thn_akademik);
            $total_seluruh_registrasi = $this->admin_model->total_seluruh_kalkulasi_registrasi($id_thn_akademik);
            $total_seluruh_fix_registrasi = $this->admin_model->total_seluruh_kalkulasi_fix_registrasi($id_thn_akademik);
            ?>
            
            <tr style="background-color: black; color: white;">
                <td colspan="2"><b>Total Keseluruhan</b></td>
                <!-- <?php if($total_seluruh_belum_bayar){ ?>
                <?php $i=1; foreach ($total_seluruh_belum_bayar as $total_seluruh_belum_bayar) { ?>
                <td><center><b><?php echo $total_seluruh_belum_bayar->belum_bayar ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?>  -->

                <?php if($total_seluruh_sudah_bayar){ ?>
                <?php $i=1; foreach ($total_seluruh_sudah_bayar as $total_seluruh_sudah_bayar) { ?>
                <td><center><b><?php echo $total_seluruh_sudah_bayar->sudah_bayar ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?> 

                <?php if($total_seluruh_terverifikasi){ ?>
                <?php $i=1; foreach ($total_seluruh_terverifikasi as $total_seluruh_terverifikasi) { ?>
                <td><center><b><?php echo $total_seluruh_terverifikasi->terverifikasi ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?> 

                 <?php if($total_seluruh_gagal){ ?>
                <?php $i=1; foreach ($total_seluruh_gagal as $total_seluruh_gagal) { ?>
                <td><center><b><?php echo $total_seluruh_gagal->gagal ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?>

                 <?php if($total_seluruh_diterima){ ?>
                <?php $i=1; foreach ($total_seluruh_diterima as $total_seluruh_diterima) { ?>
                <td><center><b><?php echo $total_seluruh_diterima->diterima ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?>


                <!--  <?php if($total_seluruh_registrasi){ ?>
                <?php $i=1; foreach ($total_seluruh_registrasi as $total_seluruh_registrasi) { ?>
                <td><center><b><?php echo $total_seluruh_registrasi->registrasi ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?>  -->

                <?php if($total_seluruh_fix_registrasi){ ?>
                <?php $i=1; foreach ($total_seluruh_fix_registrasi as $total_seluruh_fix_registrasi) { ?>
                <td><center><b><?php echo $total_seluruh_fix_registrasi->fix_registrasi ?></b></center></td>
                <?php }}else{ ?>
                <td><center><b>0</b></center></td>   
                <?php } ?> 
            </tr>
      </tbody>
  </table>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="panel panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example1" class="table table-bordered table-striped">
<thead>
    <tr style="background-color: #FF6347; color: white;">
        <th colspan="3"><b>Keterangan</b></th>
    </tr>
</thead>
<tbody>
    <!-- <tr>
        <td>Karantina</td>
        <td>:</td>
        <td>Pendaftar yang baru melakukan pendaftaran, hanya bisa melengkapi data, belum bisa upload bukti bayar dan berkas sebelum diverifikasi</td>
    </tr> -->

    <tr>
        <td>Registrasi</td>
        <td>:</td>
        <td>Pendaftar yang belum diverifikasi oleh admin bukti bayar, berkas dan kelengkapan data-datanya</td>
    </tr>

    <tr>
        <td>Terverifikasi</td>
        <td>:</td>
        <td>Pendaftar siap tes yang sudah diverifikasi pembayaran, berkas dan kelengkapan data-datanya</td>
    </tr>

    <tr>
        <td>Gagal </td>
        <td>:</td>
        <td>Pendaftar yang dinyatakan tidak lulus</td>
    </tr>

    <tr>
        <td>Diterima</td>
        <td>:</td>
        <td>Pendaftar yang sudah dinyatakan lulus</td>
    </tr>
<!-- 
    <tr>
        <td>Registrasi</td>
        <td>:</td>
        <td>Pendaftar yang sudah melakukan registrasi ulang atau sudah upload bukti registrasi ulang</td>
    </tr> -->

    <tr>
        <td>Registrasi Ulang </td>
        <td>:</td>
        <td>pendaftar yang sudah registrasi ulang</td>
    </tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6 col-md-6">
<div class="panel panel-default chart-panel">
<div class="panel-heading">
    Perkembangan dan Komparasi Pendaftaran Umum
    <span class="panel-subtitle">Perbandingan jumlah pendaftar pada tiap tahun akademik.</span>
</div>
<div class="panel-body">
    <div class="chart-wrap">
        <canvas id="chartPendaftarUmum"></canvas>
    </div>
</div>
</div>
</div>

<div class="col-lg-6 col-md-6">
<div class="panel panel-default chart-panel">
<div class="panel-heading">
    Perkembangan dan Komparasi Pendaftaran per Prodi
    <span class="panel-subtitle">Setiap garis mewakili satu program studi pada seluruh tahun akademik.</span>
</div>
<div class="panel-body">
    <div class="chart-wrap">
        <canvas id="chartPendaftarPerProdi"></canvas>
    </div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6 col-md-6">
<div class="panel panel-default chart-panel">
<div class="panel-heading">
    Perbandingan Status Pendaftar Umum
    <span class="panel-subtitle">Tahun akademik aktif: <?php echo $tahun_akademik_aktif->nama_thn_akademik; ?></span>
</div>
<div class="panel-body">
    <div class="chart-wrap">
        <canvas id="chartStatusUmum"></canvas>
    </div>
</div>
</div>
</div>

<div class="col-lg-6 col-md-6">
<div class="panel panel-default chart-panel">
<div class="panel-heading">
    Ringkasan Label Prodi
    <span class="panel-subtitle">Singkatan yang dipakai pada chart status per prodi.</span>
</div>
<div class="panel-body">
    <div class="chart-legend-note">
        <?php foreach ($chart_status_prodi_legend as $legend_item) { ?>
            <div><?php echo $legend_item; ?></div>
        <?php } ?>
    </div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default chart-panel chart-panel-tall">
<div class="panel-heading">
    Perbandingan Status Pendaftar per Prodi
    <span class="panel-subtitle">Tahun akademik aktif: <?php echo $tahun_akademik_aktif->nama_thn_akademik; ?></span>
</div>
<div class="panel-body">
    <div class="chart-wrap">
        <canvas id="chartStatusPerProdi"></canvas>
    </div>
</div>
</div>
</div>
</div>

<script src="<?php echo base_url('assets/admin/bower_components/chart.js/Chart.min.js'); ?>"></script>
<script type="text/javascript">
(function () {
    var palette = [
        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b',
        '#e377c2', '#7f7f7f', '#bcbd22', '#17becf', '#3366cc', '#dc3912',
        '#ff9900', '#109618', '#990099', '#0099c6', '#dd4477', '#66aa00'
    ];

    function colorAt(index) {
        return palette[index % palette.length];
    }

    function hexToRgba(hex, alpha) {
        var clean = hex.replace('#', '');
        var bigint = parseInt(clean, 16);
        var r = (bigint >> 16) & 255;
        var g = (bigint >> 8) & 255;
        var b = bigint & 255;
        return 'rgba(' + r + ',' + g + ',' + b + ',' + alpha + ')';
    }

    var yearLabels = <?php echo json_encode($chart_year_labels); ?>;
    var yearTotals = <?php echo json_encode($chart_year_totals); ?>;
    var prodiSeries = <?php echo json_encode(array_values($chart_prodi_datasets_map)); ?>;
    var statusUmumLabels = ['Registrasi', 'Diverifikasi', 'Diterima'];
    var statusUmumData = <?php echo json_encode($chart_status_umum_data); ?>;
    var statusProdiLabels = <?php echo json_encode($chart_status_prodi_labels); ?>;
    var statusProdiRegistrasi = <?php echo json_encode($chart_status_prodi_registrasi); ?>;
    var statusProdiDiverifikasi = <?php echo json_encode($chart_status_prodi_diverifikasi); ?>;
    var statusProdiDiterima = <?php echo json_encode($chart_status_prodi_diterima); ?>;

    if (document.getElementById('chartPendaftarUmum') && yearLabels.length) {
        new Chart(document.getElementById('chartPendaftarUmum').getContext('2d')).Line({
            labels: yearLabels,
            datasets: [{
                label: 'Jumlah Pendaftar',
                fillColor: 'rgba(60,141,188,0.15)',
                strokeColor: '#3c8dbc',
                pointColor: '#3c8dbc',
                pointStrokeColor: '#ffffff',
                pointHighlightFill: '#ffffff',
                pointHighlightStroke: '#3c8dbc',
                data: yearTotals
            }]
        }, {
            responsive: true,
            maintainAspectRatio: false,
            bezierCurve: false,
            datasetFill: true,
            multiTooltipTemplate: '<%= datasetLabel %>: <%= value %>'
        });
    }

    if (document.getElementById('chartPendaftarPerProdi') && yearLabels.length && prodiSeries.length) {
        var prodiDatasets = prodiSeries.map(function (series, index) {
            var color = colorAt(index);
            return {
                label: series.label,
                fillColor: hexToRgba(color, 0.04),
                strokeColor: color,
                pointColor: color,
                pointStrokeColor: '#ffffff',
                pointHighlightFill: '#ffffff',
                pointHighlightStroke: color,
                data: series.data
            };
        });

        new Chart(document.getElementById('chartPendaftarPerProdi').getContext('2d')).Line({
            labels: yearLabels,
            datasets: prodiDatasets
        }, {
            responsive: true,
            maintainAspectRatio: false,
            bezierCurve: false,
            datasetFill: false,
            multiTooltipTemplate: '<%= datasetLabel %>: <%= value %>'
        });
    }

    if (document.getElementById('chartStatusUmum')) {
        new Chart(document.getElementById('chartStatusUmum').getContext('2d')).Bar({
            labels: statusUmumLabels,
            datasets: [{
                label: 'Jumlah Pendaftar',
                fillColor: 'rgba(0,166,90,0.75)',
                strokeColor: '#00a65a',
                highlightFill: 'rgba(0,166,90,0.9)',
                highlightStroke: '#008d4c',
                data: statusUmumData
            }]
        }, {
            responsive: true,
            maintainAspectRatio: false,
            scaleBeginAtZero: true,
            multiTooltipTemplate: '<%= datasetLabel %>: <%= value %>'
        });
    }

    if (document.getElementById('chartStatusPerProdi') && statusProdiLabels.length) {
        new Chart(document.getElementById('chartStatusPerProdi').getContext('2d')).Bar({
            labels: statusProdiLabels,
            datasets: [
                {
                    label: 'Registrasi',
                    fillColor: 'rgba(243,156,18,0.75)',
                    strokeColor: '#f39c12',
                    highlightFill: 'rgba(243,156,18,0.9)',
                    highlightStroke: '#d58512',
                    data: statusProdiRegistrasi
                },
                {
                    label: 'Diverifikasi',
                    fillColor: 'rgba(60,141,188,0.75)',
                    strokeColor: '#3c8dbc',
                    highlightFill: 'rgba(60,141,188,0.9)',
                    highlightStroke: '#367fa9',
                    data: statusProdiDiverifikasi
                },
                {
                    label: 'Diterima',
                    fillColor: 'rgba(0,166,90,0.75)',
                    strokeColor: '#00a65a',
                    highlightFill: 'rgba(0,166,90,0.9)',
                    highlightStroke: '#008d4c',
                    data: statusProdiDiterima
                }
            ]
        }, {
            responsive: true,
            maintainAspectRatio: false,
            scaleBeginAtZero: true,
            multiTooltipTemplate: '<%= datasetLabel %>: <%= value %>'
        });
    }
})();
</script>

