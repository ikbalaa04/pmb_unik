<!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>UNIVERSITAS ISLAM KH RUHIAT CIPASUNG</span></strong>. All Rights Reserved
        </div>
        <!--<div class="credits">-->
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
        <!--  Designed by <a href="https://api.whatsapp.com/send?phone=628978966588&text=Halo%20saya%20ingin%20bertanya%20mengenai%20website%20PMB.">PROZENWEB</a><br><br>-->
        <!--</div>-->
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="<?php echo $detail_institusi->twitter ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="<?php echo $detail_institusi->fb ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="<?php echo $detail_institusi->ig ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
        
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/aos/aos.js"></script>
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/bethany/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url()?>assets/bethany/assets/js/main.js"></script>

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

</body>

</html>





