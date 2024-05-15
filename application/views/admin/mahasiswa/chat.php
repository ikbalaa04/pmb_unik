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

if($this->session->userdata('id_level')=='3') {
  echo form_open(base_url('admin/home/tambah_chat/'),'class="form-horizontal"');
}else{
  echo form_open(base_url('admin/home/tambah_chat_admin/'.$detail->id),'class="form-horizontal"');
}


?>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
              <!-- DIRECT CHAT -->
              <div class="box box-success direct-chat direct-chat-success">
                <div class="box-header with-border">
                  <?php
                  if($this->session->userdata('id_level')=='3') { ?>
                      <h3 class="box-title">Live Chat</h3>
                  <?php }else{ ?>
                      <h3 class="box-title">Live Chat dengan <?php echo $detail->nama_lengkap?></h3>
                  <?php } ?>

                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" class="badge bg-blue"><?php echo count($list_chat)?> Chat</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                   <!--  <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                            data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button> -->
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->

                    <?php foreach($list_chat as $list_chat) { ?>

                    <?php if($list_chat->level=='3') {?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $list_chat->nama ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo date("d M H:i", strtotime($list_chat->tgl )) ?> WIB</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <?php if($this->session->userdata('foto') != '') { ?>
                        <img class="direct-chat-img" src="<?php echo base_url('assets/upload/profil/thumbs/'.$this->session->userdata('foto'))?>" alt="message user image">
                        <?php }else{ ?>
                        <img src="<?php echo base_url('assets/noavatarn.png')?>" class="direct-chat-img" alt="User Image">
                      <?php } ?>
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $list_chat->isi ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                  <?php }else{ ?>
                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <?php if($list_chat->level=='1') {?>
                        <span class="direct-chat-name pull-right"><?php echo $list_chat->nama ?> (Admin)</span>
                        <?php }elseif($list_chat->level=='2') { ?>
                        <span class="direct-chat-name pull-right"><?php echo $list_chat->nama ?> (Admin PMB)</span>
                        <?php } ?>
                        <span class="direct-chat-timestamp pull-left"><?php echo date("d M H:i", strtotime($list_chat->tgl )) ?> WIB</span>
                      </div>
                      <!-- /.direct-chat-info -->
                       <?php if($this->session->userdata('foto') != '') { ?>
                        <img class="direct-chat-img" src="<?php echo base_url('assets/upload/profil/thumbs/'.$this->session->userdata('foto'))?>" alt="message user image">
                        <?php }else{ ?>
                        <img src="<?php echo base_url('assets/noavatarn.png')?>" class="direct-chat-img" alt="User Image">
                      <?php } ?>
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $list_chat->isi ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                  <?php }} ?>
                  </div>
                  <!--/.direct-chat-messages-->

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="isi" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-flat">Send</button>
                          </span>
                    </div>
                  </form>
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->
            </div>

<?php echo form_close(); ?>