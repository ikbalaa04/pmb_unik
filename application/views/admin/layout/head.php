<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
  <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

   <!-- Morris charts -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/morris.js/morris.css">

  <!-- Morris charts -->
  <!-- <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/bower_components/morris.js/morris.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/admin/dist/css/skins/_all-skins.min.css">

   <!-- datepicker -->
  <link href="<?php echo base_url()?>assets/admin/css/tanggal/bootstrap-datepicker.min.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link href="<?php echo base_url()?>/assets/admin/gf.css" rel="stylesheet" /> -->
  <!-- jQuery 3 -->
	<script src="<?php echo base_url()?>/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- ckeditor -->
  <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/ckeditor/ckeditor.js"></script>


	
 <!-- <link href="<?php echo base_url()?>/assets/select2/dist/css/select2.min.css" rel="stylesheet" />
 <script src="<?php echo base_url()?>/assets/select2/dist/js/select2.min.js"></script> -->
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}

</script>

 <style>

    body,
    .wrapper,
    .main-header,
    .main-sidebar,
    .content-wrapper,
    .app-content,
    .box,
    .table,
    .dataTables_wrapper,
    input,
    select,
    textarea,
    button {
      font-family: "Trebuchet MS", "Segoe UI", Arial, Helvetica, sans-serif !important;
    }

    #nav li.active a{
      background-color: white  !important;
      border-radius: 250px;
      width: 90%;
      padding: 8px;
      color: black;
    }

    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }

    .required-star {
      color: #dd4b39;
      font-weight: bold;
      margin-left: 3px;
    }

    .required-note {
      color: #777;
      margin: 8px 0 16px;
    }

    .form-group.has-required-error .form-control {
      border-color: #dd4b39;
      box-shadow: none;
    }

    .required-error-message {
      color: #dd4b39;
      display: block;
      font-size: 12px;
      margin-top: 5px;
    }
  </style>

  <style type="text/css">
    .rspv-tabel{
  overflow-x:auto;
}
.rspv-tabel thead tr,table tr:nth-child(2n){
  background:#ecf0f1;
}
.rspv-tabel table{
  width:100%;
  background:#f7f9fa;
  border-spacing:0;
  border-collapse:collapse;
  overflow:hidden;
}
.rspv-tabel table caption{
  font-size:18px;
  font-weight:bold;
  text-transform:uppercase;
  padding:10px 0;
}
.rspv-tabel table td,table th{
  padding:8px 10px;
  text-align:left;
  border:1px solid #dedede;
  font-family:sans-serif;
}
.rspv-tabel table tr:hover{
  background:#fff;
}
@media screen and (max-width:800px){
.rspv-tabel{
  overflow-y:hidden;
  -ms-overflow-style:-ms-autohiding-scrollbar;
}
.rspv-tabel table td,table th{
  white-space:nowrap;
}
}
  </style>

  <script>
  $(function(){
    $('.form-horizontal').each(function(){
      $(this).find(':input[required]').each(function(){
        var group = $(this).closest('.form-group');
        var label = group.find('label.control-label').first();
        if (label.length && label.find('.required-star').length === 0) {
          label.append('<span class="required-star">*</span>');
        }
      });
    });

    function fieldLabel(field) {
      var label = $(field).closest('.form-group').find('label.control-label').first().clone();
      label.find('.required-star').remove();
      return $.trim(label.text()) || 'Field ini';
    }

    function showRequiredError(field) {
      var group = $(field).closest('.form-group');
      group.addClass('has-required-error');
      group.find('.required-error-message').remove();
      $(field).after('<span class="required-error-message">'+fieldLabel(field)+' harus diisi.</span>');
    }

    function clearRequiredError(field) {
      var group = $(field).closest('.form-group');
      group.removeClass('has-required-error');
      group.find('.required-error-message').remove();
    }

    $(document).on('invalid', ':input[required]', function(e){
      e.preventDefault();
      showRequiredError(this);
    });

    $(document).on('input change', ':input[required]', function(){
      if (this.value) {
        clearRequiredError(this);
      }
    });

    $(document).on('submit', '.form-horizontal', function(e){
      var firstError = null;
      $(this).find(':input[required]').each(function(){
        if (!this.value) {
          showRequiredError(this);
          if (firstError === null) {
            firstError = this;
          }
        }
      });

      if (firstError !== null) {
        e.preventDefault();
        firstError.focus();
      }
    });
  });
  </script>
  
</head>
<body class="hold-transition skin-green sidebar-mini" >
<div class="wrapper">
