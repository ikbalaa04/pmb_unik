



  <!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url()?>assets/depan/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/easing/easing.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="<?php echo base_url()?>assets/depan/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?php echo base_url()?>assets/depan/js/main.js"></script>

  <script src="<?php echo base_url()?>assets/front/js/script.js"></script>

  <script src="<?php echo base_url()?>assets/front/js/comobox/jquery-3.3.1.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/comobox/jquery.min.js"></script>
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
                        html += '<option value='+data[i].id+'>'+data[i].nama+' - '+data[i].tahun+' ('+data[i].keterangan+') </option>';
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

  <script src="<?php echo base_url()?>assets/depan/js/datepicker/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/depan/js/datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
          $(document).ready(function () {
              $('#tanggal').datepicker({
                  format: "yyyy-mm-dd",
                  autoclose:true
              });
          });
      </script>

<script src="<?php echo base_url()?>assets/depan/js/jquery.flexslider.js"></script>
<script>
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: 'fade',
            controlsContainer: '.flexslider'
        });
    });
</script>


</body>
</html>