
<?php  


    $kode1     = $prodi = $this->input->post('prodi');
    $pilihan1  = $this->admin_model->pilihan1($kode1);

    $filename = "Daftar Peserta Lulus $fakultas_hadir->nama_fakultas $fakultas_hadir->nama_gelombang $pilihan1->jenjang $pilihan1->nama Tahun Angkatan $fakultas_hadir->angkatan .xls";

    header("content-disposition: attachment; filename=$filename");
    header("content-type: application/vdn.ms-exel");

?>

<style type="text/css">
    .table{border-collapse: collapse;}
    .table th{padding: 20px 15px; background-color: #cccccc;}
    .table td{padding: 20px 15px;}
</style>

<h3>Laporan PMB Diterima <?php echo $fakultas_hadir->nama_fakultas ?> <?php echo $pilihan1->jenjang ?> <?php echo $pilihan1->nama ?> <?php echo $fakultas_hadir->nama_gelombang ?></h3>

<table id="example1" class="table table-bordered table-striped" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Registrasi Ulang</th>
            <th>Username</th>
            <th>No. Ujian</th>
            <th>Sumber</th>
            <th>NIK</th>
            <th>NISN</th>
            <th>NPSN</th>
            <th>Baju</th>
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
            <th>Kecamatan</th>
            <th>Kab/Kota</th>
            <th>Provinsi</th>
            <th>No HP</th>

            <th>Asal</th>
            <th>Jurusan</th>
            <th>IPK</th>
            <th>Tahun Lulus</th>
            <th>Nilai Ijazah</th>
            <th>No. Ijazah</th>

            <th>Asal Pindahan</th>
            <th>Asal Fakultas</th>
            <th>Asal Prodi</th>
            <th>Asal nim</th>
            <th>Jumlah SKS </th>

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

            <th>Nama Wali</th>
            <th>TTL Wali</th>
            <th>Agama Wali</th>
            <th>Pendidikan Terakhir Wali</th>
            <th>No. HP Wali</th>
            <th>Pekerjaan Wali</th>
            <th>Penghasilan Wali</th>

            <th>Alamat Wali</th>
        </tr>
    </thead>
    <tbody>
    <?php $z=1; foreach ($excel_pmb as $excel_pmb) { ?>
        <tr> 
            <td ><?php echo $z ?></td>
            <?php
            if($excel_pmb->verifikasi_regis =='0'){ ?>
              <td>Belum Registrasi</td> 
            <?php }else{ ?>
              <td>Sudah Registrasi</td>
            <?php }?>
            <td ><?php echo $excel_pmb->username ?></td>
            <td ><?php echo $excel_pmb->noujian ?></td>
            <td ><?php echo $excel_pmb->sumber ?> <?php echo $excel_pmb->keterangan_sumber ?>
            </td>
            <td ><?php echo $excel_pmb->nik ?></td>
            <td ><?php echo $excel_pmb->nisn ?></td>
            <td ><?php echo $excel_pmb->npsn ?></td>
            <td ><?php echo $excel_pmb->baju ?></td>
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
            <td ><?php echo $excel_pmb->kecamatan ?></td>
            <td ><?php echo $excel_pmb->kota ?></td>
            <td ><?php echo $excel_pmb->prov ?></td>
            <td ><?php echo $excel_pmb->hp ?></td>

            <td ><?php echo $excel_pmb->sekolah_nama ?></td>
            <td><?php echo $excel_pmb->sekolah_jurusan?></td>
            <td ><?php echo $excel_pmb->ipk ?></td>
            
            <td ><?php echo $excel_pmb->tahun_lulus ?></td>
            <td ><?php echo $excel_pmb->nilai_ijazah ?></td>
            <td ><?php echo $excel_pmb->no_ijazah ?></td>

            <td ><?php echo $excel_pmb->pindahan_namapt ?></td>
            <td ><?php echo $excel_pmb->pindahan_fakultas ?></td>
            <td ><?php echo $excel_pmb->pindahan_prodi ?></td>
            <td ><?php echo $excel_pmb->pindahan_nim ?></td>
            <td ><?php echo $excel_pmb->pindahan_jumlahsks ?></td>

            <?php
            $Nama = explode(",", $excel_pmb->ortu_nama );
            for ( $a = 0; $a < count( $Nama ); $a++ ) {
                $Nama[$a] . "<br />";
                }

            $TEMPAT = explode("|", $excel_pmb->ortu_tempat_lahir );
            for ( $b = 0; $b < count( $TEMPAT ); $b++ ) {
                $TEMPAT[$b] . "<br />";
                }

            $TGL = explode("|", $excel_pmb->ortu_tgl_lahir );
            for ( $h = 0; $h < count( $TGL ); $h++ ) {
                $TGL[$h] . "<br />";
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

            $Alamat = explode("|", $excel_pmb->ortu_alamat );
            for ( $i = 0; $i < count( $Alamat ); $i++ ) {
                $Alamat[$i] . "<br />";
                }    

            ?>

            <td ><?php echo $Nama[0] ?></td>
            <td ><?php echo $TEMPAT[0] ?>, <?php echo $TGL[0] ?></td>
            <td ><?php echo $Agama[0] ?></td>
            <td ><?php echo $Pendidikan[0] ?></td>
            <td ><?php echo $Hp[0] ?></td>
            <td ><?php echo $Pekerjaan[0] ?></td>
            <td ><?php echo $Penghasilan[0] ?></td>

            <td ><?php echo $Nama[1] ?></td>
            <td ><?php echo $TEMPAT[1] ?>, <?php echo $TGL[1] ?></td>
            <td ><?php echo $Agama[1] ?></td>
            <td ><?php echo $Pendidikan[1] ?></td>
            <td ><?php echo $Hp[1] ?></td>
            <td ><?php echo $Pekerjaan[1] ?></td>
            <td ><?php echo $Penghasilan[1] ?></td>
            <td ><?php echo $Alamat[0] ?></td>

            <td ><?php echo $Nama[2] ?></td>
            <td ><?php echo $TEMPAT[2] ?>, <?php echo $TGL[2] ?></td>
            <td ><?php echo $Agama[2] ?></td>
            <td ><?php echo $Pendidikan[2] ?></td>
            <td ><?php echo $Hp[2] ?></td>
            <td ><?php echo $Pekerjaan[2] ?></td>
            <td ><?php echo $Penghasilan[2] ?></td>
            <td ><?php echo $Alamat[1] ?></td>


        </center>
    </tr>
     
     <?php $z++; } ?>
    </tbody>
    </table>