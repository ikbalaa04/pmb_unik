<?php
$filename = 'Data PMB '.$label.' '.date('Ymd_His').'.xls';
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Type: application/vnd.ms-excel; charset=utf-8');

function export_cell($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function export_status($value, $true_label, $false_label)
{
    return ((string) $value === '1') ? $true_label : $false_label;
}
?>
<meta charset="utf-8">
<style type="text/css">
    table { border-collapse: collapse; }
    th { background-color: #cccccc; font-weight: bold; }
    th, td { border: 1px solid #999999; padding: 6px 8px; vertical-align: top; }
    .text { mso-number-format: "\@"; }
</style>

<h3>Data PMB <?php echo export_cell($label); ?></h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Status Data</th>
            <th>Tanggal Daftar</th>
            <th>Tanggal Update</th>
            <th>Username</th>
            <th>No. Ujian</th>
            <th>Sumber</th>
            <th>NIK</th>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Jenis</th>
            <th>Program</th>
            <th>Fakultas</th>
            <th>Gelombang</th>
            <th>Pilihan 1</th>
            <th>Pilihan 2</th>
            <th>Email</th>
            <th>No WA</th>
            <th>Asal Sekolah</th>
            <th>Jurusan Sekolah</th>
            <th>Tahun Lulus</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Alamat</th>
            <th>Kecamatan</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Status Bayar</th>
            <th>Status Verifikasi</th>
            <th>Status Diterima</th>
            <th>Registrasi Ulang</th>
            <th>Verifikasi Registrasi</th>
            <th>Berkas</th>
            <th>Jumlah Bayar</th>
            <th>Bank Bayar</th>
            <th>Atas Nama Bayar</th>
            <th>Tanggal Bayar</th>
            <th>Bank Regis</th>
            <th>Atas Nama Regis</th>
            <th>Tanggal Regis</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($excel_pmb as $row) { ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo export_cell($label); ?></td>
            <td class="text"><?php echo export_cell($row->tanggal_daftar); ?></td>
            <td class="text"><?php echo export_cell($row->tanggal_update); ?></td>
            <td class="text"><?php echo export_cell($row->username); ?></td>
            <td class="text"><?php echo export_cell($row->noujian); ?></td>
            <td><?php echo export_cell(trim($row->sumber.' '.$row->keterangan_sumber)); ?></td>
            <td class="text"><?php echo export_cell($row->nik); ?></td>
            <td class="text"><?php echo export_cell($row->nisn); ?></td>
            <td><?php echo export_cell(strtoupper($row->nama_lengkap)); ?></td>
            <td><?php echo export_cell($row->jenis); ?></td>
            <td><?php echo export_cell($row->nama_program); ?></td>
            <td><?php echo export_cell($row->singkatan.' - '.$row->nama_fakultas); ?></td>
            <td><?php echo export_cell($row->nama_gelombang.' '.$row->tahun_gelombang); ?></td>
            <td><?php echo export_cell(trim($row->jenjang_prodi.' '.$row->nama_prodi)); ?></td>
            <td><?php echo export_cell(trim($row->jenjang_prodi2.' '.$row->nama_prodi2)); ?></td>
            <td class="text"><?php echo export_cell($row->email); ?></td>
            <td class="text"><?php echo export_cell($row->hp); ?></td>
            <td><?php echo export_cell($row->sekolah_nama); ?></td>
            <td><?php echo export_cell($row->sekolah_jurusan ?: $row->sekolah_nama_jurusan); ?></td>
            <td class="text"><?php echo export_cell($row->tahun_lulus); ?></td>
            <td><?php echo export_cell($row->tempat_lahir); ?></td>
            <td class="text"><?php echo export_cell($row->tanggal_lahir); ?></td>
            <td><?php echo export_cell($row->jk); ?></td>
            <td><?php echo export_cell($row->agama); ?></td>
            <td><?php echo export_cell($row->alamat); ?></td>
            <td><?php echo export_cell($row->kecamatan); ?></td>
            <td><?php echo export_cell($row->kota); ?></td>
            <td><?php echo export_cell($row->prov); ?></td>
            <td><?php echo export_cell(export_status($row->bayar, 'Sudah Bayar', 'Belum Bayar')); ?></td>
            <td><?php echo export_cell(export_status($row->approve, 'Terverifikasi', 'Belum Terverifikasi')); ?></td>
            <td><?php echo export_cell(export_status($row->fix, 'Diterima', 'Belum Diterima')); ?></td>
            <td><?php echo export_cell(export_status($row->registrasi_ulang, 'Sudah Registrasi', 'Belum Registrasi')); ?></td>
            <td><?php echo export_cell(export_status($row->verifikasi_regis, 'Terverifikasi', 'Belum Terverifikasi')); ?></td>
            <td><?php echo export_cell($row->verifikasi_berkas == '1' ? 'Sudah Dicek' : ($row->keterangan_berkas ?: 'Belum Dicek')); ?></td>
            <td class="text"><?php echo export_cell($row->jumlahbayar); ?></td>
            <td><?php echo export_cell($row->bank); ?></td>
            <td><?php echo export_cell($row->atas_nama); ?></td>
            <td class="text"><?php echo export_cell($row->tgl_bayar); ?></td>
            <td><?php echo export_cell($row->bank_regis); ?></td>
            <td><?php echo export_cell($row->atas_regis); ?></td>
            <td class="text"><?php echo export_cell($row->tgl_regis); ?></td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>
