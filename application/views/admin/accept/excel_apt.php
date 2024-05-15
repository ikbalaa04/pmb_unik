
<?php  


    $filename = "LaporanPMB $fakultas_hadir->nama_gelombang Program Studi Profesi Apoteker Tahun Angkatan $fakultas_hadir->angkatan .xls";

    header("content-disposition: attachment; filename=$filename");
    header("content-type: application/vdn.ms-exel");

?>

<style type="text/css">
    .table{border-collapse: collapse;}
    .table th{padding: 20px 15px; background-color: #cccccc;}
    .table td{padding: 20px 15px;}
</style>

<h3>Laporan Daftar Pendaftar Mahasiswa Baru <?php echo $fakultas_hadir->nama_fakultas ?> <br><?php echo $fakultas_hadir->nama_gelombang ?> Program Studi Profesi Apoteker Tahun Angkatan <?php echo $fakultas_hadir->angkatan ?></h3>

<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Ujian</th>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Jenis</th>
            <th>Program</th>
            <th>Pilihan Pertama</th>
            <th>Pilihan Kedua</th>
            <th>Jumlah Bayar</th>
            <th>Email</th>
            <th>Password</th>
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Kewarganegaraan</th>
            <th>Status</th>
            <th>Alamat</th>
            <th>No HP</th>

            <th>Asal</th>
            <th>Jurusan/IPK</th>
            <th>Tahun Lulus</th>
            <th>No. Ijazah</th>

            <th>Nama Ayah</th>
            <th>TTL Ayah</th>
            <th>Agama Ayah</th>
            <th>Pendidikan Terakhir Ayah</th>
            <th>No. HP Ayah</th>
            <th>Pekerjaan Ayah</th>
            <th>Penghasilan Ayah</th>

            <th>Nama Ibu</th>
            <th>TTL Ibu</th>
            <th>Agama Ibu</th>
            <th>Pendidikan Terakhir Ibu</th>
            <th>No. HP Ibu</th>
            <th>Pekerjaan Ibu</th>
            <th>Penghasilan Ibu</th>

            <th>Alamat Ortu</th>
        </tr>
    </thead>
    <tbody>
    <?php $z=1; foreach ($excel_pmb as $excel_pmb) { ?>
        <tr> 
            <td ><?php echo $z ?></td>
            <td ><?php echo $excel_pmb->noujian ?></td>
            <td ><?php echo $excel_pmb->nisn ?></td>
            <td ><?php echo strtoupper($excel_pmb->nama_lengkap) ?></td>
            <td ><?php echo $excel_pmb->jenis ?></td>
            <td ><?php echo $excel_pmb->nama_program ?></td>
            <?php
            $kode1     = $excel_pmb->jurusan_pilihan;
            $pilihan1  = $this->admin_model->pilihan1($kode1);
            $kode2     = $excel_pmb->jurusan_pilihan2;
            $pilihan2  = $this->admin_model->pilihan2($kode2);
            ?>
            <?php
            if($excel_pmb->jurusan_pilihan !='0'){ ?>
              <td><?php echo $pilihan1->nama ?> </td>
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <?php
            if($excel_pmb->jurusan_pilihan2 !='0'){ ?>
              <td><?php echo $pilihan2->nama ?> </td> 
            <?php }else{ ?>
              <td>-</td>
            <?php }?>
            <td ><?php echo $excel_pmb->jumlahbayar ?></td>
            <td ><?php echo $excel_pmb->email ?></td>
            <td ><?php echo $excel_pmb->password ?></td>
            <td ><?php echo $excel_pmb->tempat_lahir ?>, <?php echo $excel_pmb->tanggal_lahir ?></td>
            <td ><?php echo $excel_pmb->jk ?></td>
            <td ><?php echo $excel_pmb->agama ?></td>
            <td ><?php echo $excel_pmb->kewarganegaraan ?></td>
            <td ><?php echo $excel_pmb->status_sipil ?></td>
            <td ><?php echo $excel_pmb->alamat ?></td>
            <td ><?php echo $excel_pmb->hp ?></td>

            <?php if($excel_pmb->jurusan_pilihan != '30') { ?>
            <td ><?php echo $excel_pmb->sekolah_nama ?></td>
            <?php if($excel_pmb->sekolah_jurusan == 'Lainnya'){?> 
            <td><?php echo $excel_pmb->sekolah_nama_jurusan?></td>
            <?php }else{ ?>
            <td><?php echo $excel_pmb->sekolah_jurusan?></td>
            <?php }}else{ ?>
            <td ><?php echo $excel_pmb->kampus_asal ?></td>
            <td ><?php echo $excel_pmb->ipk ?></td>
            <?php } ?>
            <td><?php echo $excel_pmb->tahun_lulus ?></td>
            <td><?php echo $excel_pmb->no_ijazah ?></td>

            <?php
            $Nama = explode(",", $excel_pmb->ortu_nama );
            for ( $a = 0; $a < count( $Nama ); $a++ ) {
                $Nama[$a] . "<br />";
                }

            $TTL = explode("|", $excel_pmb->ortu_ttl );
            for ( $b = 0; $b < count( $TTL ); $b++ ) {
                $TTL[$b] . "<br />";
                }

            $Agama = explode(",", $excel_pmb->ortu_agama );
            for ( $c = 0; $c < count( $Agama ); $c++ ) {
                $Agama[$c] . "<br />";
                }

            $Pendidikan = explode(",", $excel_pmb->ortu_pendidikan );
            for ( $d = 0; $d < count( $Pendidikan ); $d++ ) {
                $Pendidikan[$d] . "<br />";
                }

            $Hp = explode(",", $excel_pmb->ortu_hp );
            for ( $e = 0; $e < count( $Hp ); $e++ ) {
                $Hp[$e] . "<br />";
                }

            $Pekerjaan = explode(",", $excel_pmb->ortu_pekerjaan );
            for ( $f = 0; $f < count( $Pekerjaan ); $f++ ) {
                $Pekerjaan[$f] . "<br />";
                }
            
            $Penghasilan = explode(",", $excel_pmb->ortu_penghasilan );
            for ( $g = 0; $g < count( $Penghasilan ); $g++ ) {
                $Penghasilan[$g] . "<br />";
                }    

            ?>

            <td ><?php echo $Nama[0] ?></td>
            <td ><?php echo $TTL[0] ?></td>
            <td ><?php echo $Agama[0] ?></td>
            <td ><?php echo $Pendidikan[0] ?></td>
            <td ><?php echo $Hp[0] ?></td>
            <td ><?php echo $Pekerjaan[0] ?></td>
            <td ><?php echo $Penghasilan[0] ?></td>

            <td ><?php echo $Nama[1] ?></td>
            <td ><?php echo $TTL[1] ?></td>
            <td ><?php echo $Agama[1] ?></td>
            <td ><?php echo $Pendidikan[1] ?></td>
            <td ><?php echo $Hp[1] ?></td>
            <td ><?php echo $Pekerjaan[1] ?></td>
            <td ><?php echo $Penghasilan[1] ?></td>

            <td ><?php echo $excel_pmb->ortu_alamat ?></td>

        </center>
    </tr>
     
     <?php $z++; } ?>
    </tbody>
    </table>