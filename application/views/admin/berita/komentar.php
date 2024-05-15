<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dasbor')?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?php echo $title?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
<div class="row"><!-- 
<div class="form-group">
<textarea id="Description-editor" class="form-control"> -->
    <!-- <div class="col-lg-1"></div> -->

            <div class="col-lg-12 col-md-12">
                <div class="card chat-card">
                    <div class="card-header">
                        <h5>Percakapan tentang berita : <u><?php echo $detail_berita->judul?></u></h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="<?php echo base_url('admin/berita/comment/'.$detail_berita->id_berita)?>"><i class="feather icon-refresh-cw"></i> reload</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php foreach($detail_komentar as $detail_komentar) { ?>
                        <?php if($detail_komentar->level == 'netizen') { ?>
                        <div class="row m-b-20 received-chat">
                            <div class="col-auto p-r-0">
                                <img src="<?php echo base_url('assets/upload/image/agen/default.png')?>" alt="user image" class="img-radius wid-40">
                            </div>
                            <div class="col">
                                <div class="msg">
                                    <p class="m-b-0"><?php echo $detail_komentar->isi_komentar?></p>
                                </div>
                                <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i><?php echo date('d M Y H:i',strtotime($detail_komentar->tanggal))?></p><i>- <?php echo $detail_komentar->nama?></i>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row m-b-20 send-chat">
                            
                            <div class="col">
                                <div class="msg">
                                   <p class="m-b-0"><?php echo $detail_komentar->isi_komentar?></p>
                                </div>
                                <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i><?php echo date(' H:i',strtotime($detail_komentar->tanggal)) ?></p>- <?php echo $detail_komentar->nama?>
                            </div>
                            <div class="col-auto p-l-0">
                                <img src="<?php echo base_url('assets/upload/image/agen/default.png')?>" alt="user image" class="img-radius wid-40">
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <form method="post" action="<?php echo base_url('admin/berita/komen_berita')?>">
                        <div class="form-group m-t-15">
                            <input type="hidden" name="id_berita" value="<?php echo $detail_berita->id_berita?>">
                            <?php $nama = $this->session->userdata('nama'); ?>
                            <input type="hidden" name="nama" value="<?php echo $nama . ' *'?>">
                            <input type="hidden" name="level" value="admin">
                            <input type="text" name="isi_komentar" required placeholder="Tulis sesuatu" class="form-control" id="Project" >
                            <div class="form-icon">
                                <button type="submit" class="btn btn-primary btn-icon">
                                    <i class="feather icon-message-circle"></i>
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


             <!-- <div class="col-lg-1"></div> -->

   <!--  </textarea>
</div> -->
</div>
</section>
