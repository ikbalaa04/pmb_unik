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
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="https://unik-cipasung.ac.id/">Universitas Islam KH Ruhiat Cipasung</a>.</strong> All rights
    reserved.
  </footer>

 
  <div class="control-sidebar-bg"></div>
</div>
<script>
    $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
        $("#check-all").click(function(){ // Ketika user men-cek checkbox all
            if($(this).is(":checked")) // Jika checkbox all diceklis
                $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
            else // Jika checkbox all tidak diceklis
                $(".check-item").prop("checked", false); // un-ceklis semua checkbox dengan class "check-item"
        });
 
        $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
            var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
            if(confirm) // Jika user mengklik tombol "Ok"
                $("#form-delete").submit(); // Submit form
        });
    });
</script>

<script src="<?php echo base_url()?>assets/admin/js/comobox/jquery.min.js"></script>
<script>

         $("#fakultas").change(function(){

            // variabel dari nilai combo box kendaraan
            var fakultas = $("#fakultas").val();

            $.ajax({
                url : "<?php echo base_url();?>home/get_gelombang",
                method : "POST",
                data : {fakultas:fakultas},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                        html += '<option value="">-Pilih-</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].nama+' - '+data[i].tahun+' </option>';
                    }

                    $('#gelombang').html(html);

                }
            });

            $.ajax({
                url : "<?php echo base_url()?>home/get_list_prodi",
                method : "POST",
                data : {fakultas:fakultas},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;

                        html += '<option value="">-Pilih-</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kode+'>'+data[i].jenjang+' '+data[i].nama+'</option>';
                    }
                    
                      $('#prodi').html(html);
                   
                }
            });

            $.ajax({
                url : "<?php echo base_url();?>/home/get_gelombang_admin",
                method : "POST",
                data : {fakultas:fakultas},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                        html += '<option value="">-Pilih-</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].nama+' - '+data[i].tahun+' </option>';
                    }

                    $('#gelombang_admin').html(html);

                }
            });


        });

         $("#fakultas2").change(function(){

            // variabel dari nilai combo box kendaraan
            var fakultas = $("#fakultas2").val();

            $.ajax({
                url : "<?php echo base_url()?>home/get_list_prodi",
                method : "POST",
                data : {fakultas:fakultas},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;

                        html += '<option value="">-Pilih-</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kode+'>'+data[i].jenjang+' '+data[i].nama+'</option>';
                    }
                    
                      $('#prodi2').html(html);
                   
                }
            });

            $.ajax({
                url : "<?php echo base_url();?>home/get_gelombang",
                method : "POST",
                data : {fakultas:fakultas},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                        html += '<option value="">-Pilih-</option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].nama+' - '+data[i].tahun+' </option>';
                    }

                    $('#gelombang_2').html(html);

                }
            });

        });
  </script>

    <script src="<?php echo base_url()?>assets/admin/js/datepicker/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
            $(document).ready(function () {
                $('#tanggal').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
                $('#tanggal2').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
                $('#tanggal3').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
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
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#nav a[href~="'+location.href+'"]').parent('li').addClass('active');
  })
</script>

<script type="text/javascript">
        $(function () {
                CKEDITOR.replace('ckeditor',{
                    filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browse.php');?>',
                    height: '400px'             
                });
            });
    </script>


</body>
</html>
