<?php
$detail_institusi = $this->admin_model->detail_institusi();
$hero_bg = !empty($detail_institusi->bg_beranda) ? base_url('assets/upload/bg/'.$detail_institusi->bg_beranda) : base_url('assets/bg.jpg');

if (!function_exists('pendaftaran_alerts')) {
  function pendaftaran_alerts($CI)
  {
    echo validation_errors('<div class="alert alert-warning pmf-alert">','</div>');
    if ($CI->session->flashdata('warning')) {
      echo '<div class="alert alert-warning pmf-alert">'.$CI->session->flashdata('warning').'</div>';
    }
    if ($CI->session->flashdata('success')) {
      echo '<div class="alert alert-success pmf-alert">'.$CI->session->flashdata('success').'</div>';
    }
  }
}
?>

<style>
  body {
    background: #f7faf8;
  }

  #header {
    background: rgba(255, 255, 255, 0.96);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
  }

  #header .header-container {
    min-height: 72px;
  }

  #header .logo img {
    max-height: 48px;
    width: auto;
  }

  .pmf-page {
    padding: 130px 0 80px;
    background:
      linear-gradient(180deg, rgba(247, 250, 248, 0.92), #f7faf8 42%),
      url("<?php echo $hero_bg; ?>") center top / cover no-repeat;
  }

  .pmf-heading {
    max-width: 760px;
    margin: 0 auto 34px;
    text-align: center;
  }

  .pmf-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 14px;
    margin-bottom: 16px;
    border: 1px solid #d7e8df;
    border-radius: 999px;
    color: #17613d;
    background: #fff;
    font-size: 13px;
    font-weight: 800;
  }

  .pmf-heading h1 {
    margin: 0;
    color: #173b2a;
    font-size: 44px;
    line-height: 1.16;
    font-weight: 800;
    letter-spacing: 0;
  }

  .pmf-heading p {
    margin: 14px 0 0;
    color: #667085;
    font-size: 16px;
    line-height: 1.7;
  }

  .pmf-shell {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 360px;
    gap: 24px;
    align-items: start;
  }

  .pmf-card,
  .pmf-side-card {
    border: 1px solid #e5ece8;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 18px 44px rgba(15, 23, 42, 0.07);
  }

  .pmf-card {
    padding: 28px;
  }

  .pmf-section {
    padding-bottom: 24px;
    margin-bottom: 24px;
    border-bottom: 1px solid #edf2ef;
  }

  .pmf-section:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border-bottom: 0;
  }

  .pmf-section h2 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 18px;
    color: #183527;
    font-size: 19px;
    line-height: 1.3;
    font-weight: 800;
  }

  .pmf-section h2 span {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #12321f;
    background: #f4c542;
    font-size: 14px;
    font-weight: 800;
  }

  .pmf-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
  }

  .pmf-field {
    min-width: 0;
  }

  .pmf-field label {
    display: block;
    margin: 0 0 7px;
    color: #344054;
    font-size: 13px;
    font-weight: 800;
  }

  .pmf-card .form-control {
    height: 46px;
    border: 1px solid #d7e0dc;
    border-radius: 8px;
    box-shadow: none;
    color: #1f2933;
  }

  .pmf-card .form-control:focus {
    border-color: #1f8a55;
    box-shadow: 0 0 0 3px rgba(31, 138, 85, 0.12);
  }

  .pmf-actions {
    display: flex;
    justify-content: flex-end;
    padding-top: 24px;
  }

  .pmf-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 48px;
    padding: 0 22px;
    border: 0;
    border-radius: 8px;
    color: #12321f;
    background: #f4c542;
    font-weight: 800;
    box-shadow: 0 14px 30px rgba(244, 197, 66, 0.22);
  }

  .pmf-submit:hover,
  .pmf-submit:focus {
    color: #12321f;
    background: #ffd965;
  }

  .pmf-side {
    position: sticky;
    top: 104px;
  }

  .pmf-side-card {
    padding: 24px;
    margin-bottom: 18px;
  }

  .pmf-side-card h3 {
    margin: 0 0 12px;
    color: #183527;
    font-size: 20px;
    font-weight: 800;
  }

  .pmf-side-card p,
  .pmf-side-card li {
    color: #667085;
    line-height: 1.65;
  }

  .pmf-steps {
    padding: 0;
    margin: 0;
    list-style: none;
  }

  .pmf-steps li {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #edf2ef;
  }

  .pmf-steps li:last-child {
    border-bottom: 0;
  }

  .pmf-steps strong {
    width: 30px;
    height: 30px;
    flex: 0 0 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #fff;
    background: #1f8a55;
    font-size: 13px;
  }

  .pmf-alur {
    overflow-wrap: anywhere;
  }

  .pmf-alur img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
  }

  .pmf-alert {
    border-radius: 8px;
  }

  @media (max-width: 991px) {
    .pmf-page {
      padding-top: 112px;
    }

    .pmf-shell {
      grid-template-columns: 1fr;
    }

    .pmf-side {
      position: static;
    }
  }

  @media (max-width: 767px) {
    .pmf-heading h1 {
      font-size: 34px;
    }

    .pmf-card {
      padding: 20px;
    }

    .pmf-grid {
      grid-template-columns: 1fr;
    }

    .pmf-actions {
      justify-content: stretch;
    }

    .pmf-submit {
      width: 100%;
    }
  }
</style>

<main class="pmf-page">
  <div class="container">
    <div class="pmf-heading">
      <div class="pmf-kicker"><i class="bi bi-pencil-square"></i> Pendaftaran Online</div>
      <h1>Formulir Pendaftaran Mahasiswa Baru</h1>
      <p>Isi data awal dengan benar. Username dan kata sandi akan digunakan untuk masuk ke portal pendaftaran setelah formulir dikirim.</p>
    </div>

    <?php pendaftaran_alerts($this); ?>

    <div class="pmf-shell">
      <form method="post" action="<?php echo base_url('home/pendaftaran') ?>" class="pmf-card">
        <div class="pmf-section">
          <h2><span>1</span> Pilihan Program Studi</h2>
          <div class="pmf-grid">
            <div class="pmf-field">
              <label for="fakultas">Fakultas Pilihan Pertama</label>
              <?php if($this->input->post('fakultas')==''){ ?>
                <select required class="form-control" name="fakultas" id="fakultas">
                  <option value="">-Pilih-</option>
                  <?php foreach ($fakultas as $row_fakultas) { ?>
                    <option value="<?php echo $row_fakultas->id ?>" <?php if($this->input->post('fakultas') == $row_fakultas->id){echo "selected";}?>><?php echo $row_fakultas->nama_fakultas ?></option>
                  <?php } ?>
                </select>
              <?php }else{ ?>
                <?php $detail_fakultas = $this->admin_model->detail_fakultas($this->input->post('fakultas')); ?>
                <input type="hidden" class="form-control" required name="fakultas" id="fakultas" value="<?php echo $detail_fakultas->id ?>"/>
                <input type="text" class="form-control" required readonly value="<?php echo $detail_fakultas->nama_fakultas ?>"/>
              <?php } ?>
            </div>

            <div class="pmf-field">
              <label for="gelombang">Gelombang Pilihan Pertama</label>
              <?php if($this->input->post('gelombang')==''){ ?>
                <select required class="form-control" name="gelombang" id="gelombang"></select>
              <?php }else{ ?>
                <?php $detail_gelombang = $this->admin_model->detail_gelombang($this->input->post('gelombang')); ?>
                <input type="hidden" class="form-control" required name="gelombang" id="gelombang" value="<?php echo $detail_gelombang->id ?>"/>
                <input type="text" class="form-control" required readonly value="<?php echo $detail_gelombang->nama ?> - <?php echo $detail_gelombang->tahun ?>"/>
              <?php } ?>
            </div>

            <div class="pmf-field">
              <label for="prodi">Pilihan Pertama</label>
              <?php if($this->input->post('prodi')==''){ ?>
                <select required class="form-control" name="prodi" id="prodi"></select>
              <?php }else{ ?>
                <?php $detail_prodi = $this->admin_model->detail_prodi_kode($this->input->post('prodi')); ?>
                <input type="hidden" class="form-control" required name="prodi" id="prodi" value="<?php echo $detail_prodi->kode ?>"/>
                <input type="text" class="form-control" required readonly value="<?php echo $detail_prodi->jenjang ?> <?php echo $detail_prodi->nama ?>"/>
              <?php } ?>
            </div>

            <div class="pmf-field">
              <label for="program">Jalur Pendaftaran</label>
              <select class="form-control" name="program" id="program" required>
                <?php $list_program_aktif = $this->admin_model->list_program_aktif(); ?>
                <option value="">-Pilih-</option>
                <?php foreach($list_program_aktif as $row_program){ ?>
                  <option value="<?php echo $row_program->id ?>" <?php if($this->input->post('program') == $row_program->id ){echo "selected";}?>><?php echo $row_program->nama ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="pmf-field">
              <label for="fakultas2">Fakultas Pilihan Kedua</label>
              <?php if($this->input->post('fakultas2')==''){ ?>
                <select required class="form-control" name="fakultas2" id="fakultas2">
                  <option value="">-Pilih-</option>
                  <?php foreach ($fakultas2 as $row_fakultas2) { ?>
                    <option value="<?php echo $row_fakultas2->id ?>" <?php if($this->input->post('fakultas2') == $row_fakultas2->id){echo "selected";}?>><?php echo $row_fakultas2->nama_fakultas ?></option>
                  <?php } ?>
                </select>
              <?php }else{ ?>
                <?php $detail_fakultas2 = $this->admin_model->detail_fakultas($this->input->post('fakultas2')); ?>
                <input type="hidden" class="form-control" required name="fakultas2" id="fakultas2" value="<?php echo $detail_fakultas2->id ?>"/>
                <input type="text" class="form-control" required readonly value="<?php echo $detail_fakultas2->nama_fakultas ?>"/>
              <?php } ?>
            </div>

            <div class="pmf-field">
              <label for="gelombang_2">Gelombang Pilihan Kedua</label>
              <?php if($this->input->post('gelombang_2')==''){ ?>
                <select required class="form-control" name="gelombang_2" id="gelombang_2"></select>
              <?php }else{ ?>
                <?php $detail_gelombang2 = $this->admin_model->detail_gelombang($this->input->post('gelombang_2')); ?>
                <input type="hidden" class="form-control" required name="gelombang_2" id="gelombang_2" value="<?php echo $detail_gelombang2->id ?>"/>
                <input type="text" class="form-control" required readonly value="<?php echo $detail_gelombang2->nama ?> - <?php echo $detail_gelombang2->tahun ?>"/>
              <?php } ?>
            </div>

            <div class="pmf-field">
              <label for="prodi2">Pilihan Kedua</label>
              <?php if($this->input->post('prodi2')==''){ ?>
                <select required class="form-control" name="prodi2" id="prodi2"></select>
              <?php }else{ ?>
                <?php $detail_prodi2 = $this->admin_model->detail_prodi_kode($this->input->post('prodi2')); ?>
                <input type="hidden" class="form-control" required name="prodi2" id="prodi2" value="<?php echo $detail_prodi2->kode ?>"/>
                <input type="text" class="form-control" required readonly value="<?php echo $detail_prodi2->jenjang ?> <?php echo $detail_prodi2->nama ?>"/>
              <?php } ?>
            </div>

            <div class="pmf-field">
              <label for="jenis">Jenis Pendaftaran</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <?php $list_jenis = $this->admin_model->list_jenis(); ?>
                <option value="">-Pilih-</option>
                <?php foreach($list_jenis as $row_jenis) { ?>
                  <option value="<?php echo $row_jenis->kode?>" <?php if($this->input->post('jenis') == $row_jenis->kode){echo "selected";} ?>><?php echo $row_jenis->nama?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="pmf-section">
          <h2><span>2</span> Data Pendaftar</h2>
          <div class="pmf-grid">
            <div class="pmf-field">
              <label for="sekolah_nama">Asal Sekolah</label>
              <input type="text" class="form-control" required name="sekolah_nama" id="sekolah_nama" placeholder="Sekolah asal anda" value="<?php echo set_value('sekolah_nama') ?>"/>
            </div>

            <div class="pmf-field">
              <label for="sekolah_jurusan">Jurusan</label>
              <input type="text" class="form-control" required name="sekolah_jurusan" id="sekolah_jurusan" placeholder="Masukan jurusan sekolah" value="<?php echo set_value('sekolah_jurusan') ?>"/>
            </div>

            <div class="pmf-field">
              <label for="nama_lengkap">Nama Lengkap</label>
              <input type="text" class="form-control" required name="nama_lengkap" id="nama_lengkap" placeholder="Masukan nama lengkap" value="<?php echo set_value('nama_lengkap') ?>" style="text-transform: capitalize;"/>
            </div>

            <div class="pmf-field">
              <label for="hp">Nomor WA</label>
              <input type="number" class="form-control" required name="hp" id="hp" placeholder="Contoh: 628213597XXX" value="<?php echo set_value('hp') ?>"/>
            </div>

            <div class="pmf-field">
              <label for="email">Email Aktif</label>
              <input type="email" class="form-control" required name="email" id="email" placeholder="Daftarkan email aktif" value="<?php echo set_value('email') ?>"/>
            </div>

            <div class="pmf-field">
              <label for="sumber">Sumber Referensi</label>
              <select name="sumber" id="sumber" class="form-control" required>
                <option value="">-Pilih Sumber Referensi-</option>
                <?php foreach($sumber as $row_sumber) { ?>
                  <option value="<?php echo $row_sumber->nama ?>" <?php if($this->input->post('sumber') == $row_sumber->nama){echo "selected";}?>><?php echo $row_sumber->nama ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="pmf-section">
          <h2><span>3</span> Akun Login</h2>
          <div class="pmf-grid">
            <div class="pmf-field">
              <label for="username">Username</label>
              <input type="text" class="form-control" required name="username" id="username" placeholder="Buat nama pengguna" value="<?php echo set_value('username') ?>"/>
            </div>

            <div class="pmf-field">
              <label for="password">Kata Sandi</label>
              <input type="password" class="form-control" required name="password" id="password" placeholder="Buat kata sandi" value="<?php echo set_value('password') ?>"/>
            </div>
          </div>
        </div>

        <div class="pmf-actions">
          <button type="submit" class="pmf-submit"><i class="bi bi-send"></i> Daftar Sekarang</button>
        </div>
      </form>

      <aside class="pmf-side">
        <div class="pmf-side-card">
          <h3>Langkah Pendaftaran</h3>
          <ul class="pmf-steps">
            <li><strong>1</strong><span>Pilih program studi dan jalur pendaftaran yang tersedia.</span></li>
            <li><strong>2</strong><span>Lengkapi data pendaftar dan kontak aktif.</span></li>
            <li><strong>3</strong><span>Buat akun untuk masuk ke portal PMB.</span></li>
            <li><strong>4</strong><span>Ikuti instruksi pembayaran dan verifikasi setelah akun dibuat.</span></li>
          </ul>
        </div>

        <div class="pmf-side-card pmf-alur">
          <h3>Alur Pendaftaran</h3>
          <?php echo $detail_institusi->alur_pendaftaran; ?>
        </div>
      </aside>
    </div>
  </div>
</main>
