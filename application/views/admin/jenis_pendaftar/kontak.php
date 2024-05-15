
<div class="row">
<div class="col-lg-12">
<div class="pane panel-default">  
<div class="panel-body"> 
<div class="rspv-tabel">
<table id="example2" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Status Admin</th>
            <th>Fakultas</th>
            <th>Whattsapp</th>
        </tr>
    </thead>
    <tbody>
        <?php if($detail->fakultas == 1){ ?>
        <tr> 
            <td>1</td>
            <td>Mimah Rohimah</td>
            <td>Bagian Keuangan</td>
            <td>FMIPA(Sarjana)</td>
            <td><a class="btn btn-xs btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=6281380970449&text=Halo%20Admin,%20(sebutkan%20nama%20dan%20pertanyaan%20anda)"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"><b> Hub. Ibu Mimah</b></a></td> 
        </tr>
        <tr> 
            <td>2</td>
            <td>Sri</td>
            <td>Bagian Akademik</td>
            <td>FMIPA(Sarjana)</td>
            <td><a class="btn btn-xs btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=6285158138966&text=Halo%20Admin,%20(sebutkan%20nama%20dan%20pertanyaan%20anda)"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"><b> Hub. Ibu Sri</b></a></td> 
        </tr>
        <?php }elseif($detail->fakultas == 2) { ?>
            <tr> 
            <td>1</td>
            <td>Fitri</td>
            <td>Bagian Keuangan</td>
            <td>FMIPA(Profesi)</td>
            <td><a class="btn btn-xs btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=6283825574072&text=Halo%20Admin,%20(sebutkan%20nama%20dan%20pertanyaan%20anda)"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"><b> Hub. Ibu Fitri</b></a></td> 
        </tr>
        <tr> 
            <td>2</td>
            <td>Tia Rahayu</td>
            <td>Bagian Akademik</td>
            <td>FMIPA(Profesi)</td>
            <td><a class="btn btn-xs btn-success" target="_blank" href="https://api.whatsapp.com/send?phone=6285322964215&text=Halo%20Admin,%20(sebutkan%20nama%20dan%20pertanyaan%20anda)"> <img width="30" src="<?php echo base_url('assets/wa.png')?>"><b> Hub. Ibu Tia</b></a></td> 
        </tr>
        <?php } ?>
    </tbody>
    </table><br>
</div>
</div>
</div>
</div>
</div>