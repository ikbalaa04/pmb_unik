

</div><!-- /.page-wrapper -->

<script src="<?php echo base_url()?>assets/superlist/assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/js/map.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/collapse.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/carousel.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/transition.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/dropdown.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/tab.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-sass/javascripts/bootstrap/alert.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/superlist/assets/libraries/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/superlist/assets/libraries/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/libraries/flot/jquery.flot.spline.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/superlist/assets/js/gooleapis.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/superlist/assets/libraries/jquery-google-map/infobox.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/superlist/assets/libraries/jquery-google-map/markerclusterer.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/superlist/assets/libraries/jquery-google-map/jquery-google-map.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/superlist/assets/libraries/owl.carousel/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/superlist/assets/libraries/bootstrap-fileinput/fileinput.min.js"></script>

<script src="<?php echo base_url()?>assets/superlist/assets/js/superlist.js" type="text/javascript"></script>

</body>


<!-- Mirrored from preview.byaviators.com/template/superlist/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Aug 2019 09:20:35 GMT -->
<script src="<?php echo base_url()?>assets/superlist/assets/js/comobox/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/js/comobox/jquery.chained.min.js"></script>
        <script>
            $("#kota").chained("#provinsi"); // disini kita hubungkan kota dengan provinsi
            $("#kecamatan").chained("#kota"); // disini kita hubungkan kecamatan dengan kota

            $("#jenis").chained("#institusi"); // disini kita hubungkan program dengan institusi
            $("#program").chained("#institusi"); // disini kita hubungkan program dengan institusi
            $("#jurusan").chained("#institusi"); // disini kita hubungkan jurusan dengan institusi
            $("#jurusan2").chained("#institusi"); // disini kita hubungkan jurusan2 dengan institusi
            $("#gelombang").chained("#jurusan"); // disini kita hubungkan gelombang dengan jurusan
        </script>

<script src="<?php echo base_url()?>assets/superlist/assets/js/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url()?>assets/superlist/assets/js/select2/dist/js/select2.min.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
            $("#institusi").select2({
                    placeholder: "Masukan Jumlah"
                });
            });
        </script>


</html>