<?php 
include('application/views/admin/layout/head.php');
include('application/views/admin/layout/header.php');
include('application/views/admin/layout/nav.php');
?>


 <main class="app-content">
      <div class="app-title">
      </div>
      <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <canvas id="Fakultas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <canvas id="Gelombang"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <canvas id="semuaPendaftar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- BAR CHART -->
          <!-- <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
          </div> -->

            

    </main>

    </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

 
  <div class="control-sidebar-bg"></div>
</div>

<script>
    $(".theSelect").select2();
  </script>


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>/assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url()?>/assets/admin/dist/js/demo.js"></script> -->
<!-- page script -->

<!-- Morris.js charts -->
<script src="<?php echo base_url()?>/assets/admin/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>/assets/admin/bower_components/morris.js/morris.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/google-palette@1.1.0/palette.js"></script>
<?php
$ambil_detail_thn_akademik = $this->admin_model->ambil_detail_thn_akademik(); 
$id_thn_akademik = $ambil_detail_thn_akademik->id_thn_akademik;
?>
<?php $grafik_bar = $this->admin_model->grafik_bar_pendaftar($id_thn_akademik); ?>
<?php $grafik_bar_prodi = $this->admin_model->grafik_bar_pendaftar($id_thn_akademik); ?>

<script type="text/javascript">
var ctx = document.getElementById("semuaPendaftar");
var pendaftar = [ 0,<?php foreach($grafik_bar as $grafik_bar) { echo "'$grafik_bar->jumlah_pendaftar',"; } ?>  ];
var prodi = [ "Belum Isi",<?php foreach($grafik_bar_prodi as $grafik_bar_prodi) { echo "'$grafik_bar_prodi->jenjang $grafik_bar_prodi->nama',"; } ?> ];
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: prodi,
        datasets: [{
            label: 'Statistik Semua Pendaftar Berdasarkan Program Studi (Orang)',
            // hasil : alumni.toFixed(4);
            data: pendaftar,
            backgroundColor: palette(['tol', 'qualitative'], pendaftar.length).map(function(hex) {
                return '#' + hex;
            })
        }],
    },
});
</script>


<?php $jumlah_pendaftar_gelombang = $this->admin_model->grafik_bar_gelombang($id_thn_akademik); ?>
<?php $nama_gelombang_pendaftar = $this->admin_model->grafik_bar_gelombang($id_thn_akademik); ?>

<script type="text/javascript">
var ctx = document.getElementById("Gelombang");
var pendaftar = [ 0,<?php foreach($jumlah_pendaftar_gelombang as $jumlah_pendaftar_gelombang) { echo "'$jumlah_pendaftar_gelombang->jumlah_pendaftar',"; } ?>  ];
var gelombang = [ "Belum Isi",<?php foreach($nama_gelombang_pendaftar as $nama_gelombang_pendaftar) { echo "'$nama_gelombang_pendaftar->singkatan - $nama_gelombang_pendaftar->nama_gelombang',"; } ?> ];
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: gelombang,
        datasets: [{
            label: 'Statistik Pendaftar Berdasarkan Gelombang (Orang)',
            // hasil : alumni.toFixed(4);
            data: pendaftar,
            backgroundColor: palette(['tol', 'qualitative'], pendaftar.length).map(function(hex) {
                return '#' + hex;
            })
        }],
    },
});
</script>

<?php $jumlah_pendaftar_fakultas = $this->admin_model->grafik_bar_fakultas($id_thn_akademik); ?>
<?php $nama_fakultas_pendaftar = $this->admin_model->grafik_bar_fakultas($id_thn_akademik); ?>

<script type="text/javascript">
var ctx = document.getElementById("Fakultas");
var pendaftar = [ 0,<?php foreach($jumlah_pendaftar_fakultas as $jumlah_pendaftar_fakultas) { echo "'$jumlah_pendaftar_fakultas->jumlah_pendaftar',"; } ?>  ];
var fakultas = [ "Belum Isi",<?php foreach($nama_fakultas_pendaftar as $nama_fakultas_pendaftar) { echo "'$nama_fakultas_pendaftar->nama_fakultas',"; } ?> ];
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: fakultas,
        datasets: [{
            label: 'Statistik Pendaftar Berdasarkan Fakultas (Orang)',
            // hasil : alumni.toFixed(4);
            data: pendaftar,
            backgroundColor: palette(['tol', 'qualitative'], pendaftar.length).map(function(hex) {
                return '#' + hex;
            })
        }],
    },
});
</script>

<?php $grafik_baru = $this->admin_model->grafik_bar_pendaftar_baru($id_thn_akademik); ?>
<?php $grafik_bar_prodi = $this->admin_model->grafik_bar_pendaftar($id_thn_akademik); ?>

<script>
  $(function () {
    "use strict";
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
      <?php foreach($grafik_baru as $grafik_baru) { 
        $kode = $grafik_baru->jurusan_pilihan;
        $gelombang = $this->admin_model->grafik_bar_pendaftar_baru_gelombang($id_thn_akademik,$kode);
      ?>
        {y: <?php echo $grafik_baru->nama ?>, a: 100, b: 90, c: 300 },
      <?php } ?>
      ],
      barColors: palette(['tol', 'qualitative'], pendaftar.length).map(function(hex) {
                return '#' + hex;
            }),
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['CPU', 'DISK', 'RAM'],
      hideHover: 'auto'
    });
  });
</script>



</body>
</html>
