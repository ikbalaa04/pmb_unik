
<!-- Example row of columns -->
<div class="row">
<div class="col-lg-12"><center>
<h2>Jadwal Tes</h2><br>

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
			<th>Nama Tes</th>
			<th>Waktu</th>
			<th>Tempat</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach ($jadwal_usm as $jadwal_usm) {?>
               <tr>
               	<td><?php echo $no?></td>
               	<td> <b><?php echo $jadwal_usm->J?></b> </td><br> 
                <?php $tanggal = date('D',strtotime($jadwal_usm->tgl_ujian));
                $hariList = array('Sun' => 'Minggu',
                                  'Mon' => 'Senin',
                                  'Tue' => 'Selasa',
                                  'Wed' => 'Rabu',
                                  'Thu' => 'Kamis',
                                  'Fri' => 'Jumat',
                                  'Sat' => 'Sabtu');
                ?>
                <td><?php
                 echo $hariList[$tanggal];?>, <?php echo date('d M Y',strtotime($jadwal_usm->tgl_ujian))?> (<?php echo date('H:i',strtotime($jadwal_usm->jam_mulai))?> - <?php echo $jadwal_usm->jam_selesai ?> ) WIB </td>
                  <td> <?php echo $jadwal_usm->GD?></td>
                 </tr>
              <?php $no++; } ?>
    </tbody>
    </table>

</center>
</div>
</div>