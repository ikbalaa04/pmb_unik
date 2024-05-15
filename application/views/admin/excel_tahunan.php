
<?php  


    $filename = "Backup_excel_Tahunan.xls";

    header("content-disposition: attachment; filename=$filename");
    header("content-type: application/vdn.ms-exel");

?>

<style type="text/css">
    .table{border-collapse: collapse;}
    .table th{padding: 20px 15px; background-color: #cccccc;}
    .table td{padding: 20px 15px;}
</style>

<h3>Backup Data Excel Pendaftar Tahun <?php echo date('Y') ?></h3>

<table id="example1" class="table table-bordered table-striped" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Sumber</th>
            <th>NIK</th>
            <th>Tanggal Daftar</th>
            <th>Status Kelulusan</th>
            <th>Fakultas</th>
            <th>No. Ujian</th>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Jenis</th>
            <th>Program</th>
            <th>Pilihan Pertama</th>
            <th>Pilihan Kedua</th>
            <th>Email</th>
            <th>Password</th>
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Kewarganegaraan</th>
            <th>Status</th>
            <th>Alamat</th>
            <th>No HP</th>

            <th>Nama Sekolah</th>
            <th>Tahun Lulus</th>
            <th>No. Ijazah</th>

            <th>Nama Ayah</th>
            <th>Pendidikan Terakhir Ayah</th>
            <th>No. HP Ayah</th>
            <th>Pekerjaan Ayah</th>
            <th>Penghasilan Ayah</th>

            <th>Nama Ibu</th>
            <th>Pendidikan Terakhir Ibu</th>
            <th>No. HP Ibu</th>
            <th>Pekerjaan Ibu</th>
            <th>Penghasilan Ibu</th>

            <th>Alamat Ortu</th>
        </tr>
    </thead>
    <tbody>
    <?php $z=1; foreach ($backup_excel as $excel_pmb) { ?>
        <tr> 
            <td ><?php echo $z ?></td>
            <td ><?php echo $excel_pmb->sumber ?> <?php echo $excel_pmb->keterangan_sumber ?>
            </td>
            <td ><?php echo $excel_pmb->nik ?></td>
            <td><?php echo date("d M Y", strtotime($excel_pmb->tanggal_daftar )) ?></td>
            <td><?php if($excel_pmb->fix== '1' && $excel_pmb->non_fix== '0') { ?>
                <b>Lulus</b>
                <?php }elseif($excel_pmb->fix== '0' && $excel_pmb->non_fix== '1'){?>
                <b>Tidak Lulus</b>
                <?php }elseif($excel_pmb->fix== '0' && $excel_pmb->non_fix== '0'){?>
                <b>Belum Tes</b>
                <?php }?>
            </td>
            <td><?php echo $excel_pmb->nama_fakultas ?></td>
            <td ><?php echo $excel_pmb->noujian ?></td>
            <td ><?php echo $excel_pmb->noujian ?></td>
            <td ><?php echo $excel_pmb->nisn ?></td>
            <td ><?php echo $excel_pmb->nama_lengkap ?></td>
             <td ><?php if($excel_pmb->jenis == ''){echo "Belum disisi";}else{ echo $excel_pmb->jenis;} ?></td>
            <td ><?php if($excel_pmb->nama_program == ''){echo "Belum disisi";}else{ echo $excel_pmb->nama_program;} ?></td>
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
              <td>Belum dipilih</td>
            <?php }?>
            <?php
            if($excel_pmb->jurusan_pilihan2 !='0'){ ?>
              <td><?php echo $pilihan2->nama ?> </td> 
            <?php }else{ ?>
              <td>Belum dipilih</td>
            <?php }?>

            <td ><?php echo $excel_pmb->email ?></td>
            <td ><?php echo $excel_pmb->password ?></td>
            <td ><?php echo $excel_pmb->tempat_lahir ?>, <?php echo $excel_pmb->tanggal_lahir ?></td>
            <td ><?php echo $excel_pmb->jk ?></td>
            <td ><?php echo $excel_pmb->agama ?></td>
            <td ><?php echo $excel_pmb->kewarganegaraan ?></td>
            <td ><?php echo $excel_pmb->status_sipil ?></td>
            <td ><?php echo $excel_pmb->alamat ?></td>
            <td ><?php echo $excel_pmb->hp ?></td>

            <td ><?php echo $excel_pmb->sekolah_nama ?></td>
            <td ><?php echo $excel_pmb->tahun_lulus ?></td>
            <td ><?php echo $excel_pmb->no_ijazah ?></td>

            <?php
            $Nama = explode(",", $excel_pmb->ortu_nama );
            for ( $a = 0; $a < count( $Nama ); $a++ ) {
                $Nama[$a] . "<br />";
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
            <td ><?php echo $Pendidikan[0] ?></td>
            <td ><?php echo $Hp[0] ?></td>
            <td ><?php echo $Pekerjaan[0] ?></td>
            <td ><?php echo $Penghasilan[0] ?></td>

            <td ><?php echo $Nama[1] ?></td>
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
