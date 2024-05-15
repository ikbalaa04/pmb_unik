<div class="row">
<div class="pane panel-default">  
<div class="panel-body"> 
		<div class="col-lg-12">
            <center><h3>Manual Book Aplikasi PMB </h3></center>
            <?php $detail_institusi  = $this->admin_model->detail_institusi();?>
            <?php if($this->session->userdata('id_level')!='3'){?>
            <?php echo $detail_institusi->panduan_website?>
            <?php }else{ ?>
            <?php echo $detail_institusi->panduan_mahasiswa?>
            <?php } ?>
        
        </div>

</div>
</div>
</div>
