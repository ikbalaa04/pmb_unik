<?php
$detail_institusi = $this->admin_model->detail_institusi();
$hero_image = base_url('assets/upload/bg/'.$detail_institusi->bg_beranda);
$logo_image = base_url('assets/logounik.png');
$news_items = isset($informasi) ? $informasi : array();
$gallery_items = isset($galeri) ? $galeri : array();
$statistik_items = isset($statistik_pendaftar) ? $statistik_pendaftar : array();
$default_news_image = file_exists(FCPATH.'assets/upload/berita/default.png') ? base_url('assets/upload/berita/default.png') : base_url('assets/bg.jpg');
$program_count = is_array($list_prodi) ? count($list_prodi) : 0;
$total_pendaftar = 0;
if (!empty($statistik_items)) {
  foreach ($statistik_items as $statistik) {
    if (isset($statistik->jumlah)) {
      $total_pendaftar += (int) $statistik->jumlah;
    } elseif (isset($statistik->total)) {
      $total_pendaftar += (int) $statistik->total;
    }
  }
}
if ($total_pendaftar == 0 && !empty($pendaftar_tes)) {
  $total_pendaftar = is_array($pendaftar_tes) ? count($pendaftar_tes) : 0;
}
?>

<style>
  body {
    color: #1f2933;
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

  #header .navbar a {
    font-weight: 600;
  }

  .home-modern {
    overflow: hidden;
  }

  .home-modern a {
    text-decoration: none;
  }

  .pmh-hero {
    min-height: 92vh;
    display: flex;
    align-items: center;
    position: relative;
    padding: 136px 0 72px;
    color: #fff;
    background-image: linear-gradient(90deg, rgba(4, 25, 17, 0.86), rgba(4, 25, 17, 0.58), rgba(4, 25, 17, 0.25)), url("<?php echo $hero_image; ?>");
    background-position: center;
    background-size: cover;
  }

  .pmh-hero:after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 96px;
    background: linear-gradient(180deg, rgba(247, 250, 248, 0), #f7faf8);
  }

  .pmh-hero .container {
    position: relative;
    z-index: 2;
  }

  .pmh-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    margin-bottom: 22px;
    border: 1px solid rgba(255, 255, 255, 0.32);
    border-radius: 999px;
    color: #e6fff2;
    background: rgba(255, 255, 255, 0.08);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0;
  }

  .pmh-hero h1 {
    max-width: 820px;
    margin: 0;
    color: #fff;
    font-size: 58px;
    line-height: 1.06;
    font-weight: 800;
    letter-spacing: 0;
  }

  .pmh-hero-lead {
    max-width: 720px;
    margin: 22px 0 0;
    color: rgba(255, 255, 255, 0.92);
    font-size: 19px;
    line-height: 1.7;
  }

  .pmh-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 30px;
  }

  .pmh-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 48px;
    padding: 0 20px;
    border-radius: 8px;
    font-weight: 700;
    transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
  }

  .pmh-btn:hover {
    transform: translateY(-1px);
  }

  .pmh-btn-primary {
    color: #12321f;
    background: #f4c542;
    box-shadow: 0 16px 34px rgba(244, 197, 66, 0.24);
  }

  .pmh-btn-primary:hover {
    color: #12321f;
    background: #ffd965;
  }

  .pmh-btn-light {
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.36);
    background: rgba(255, 255, 255, 0.08);
  }

  .pmh-btn-light:hover {
    color: #fff;
    background: rgba(255, 255, 255, 0.16);
  }

  .pmh-quick-panel {
    margin-top: 44px;
    padding: 16px;
    max-width: 760px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
  }

  .pmh-quick-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
  }

  .pmh-quick-item {
    padding: 14px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.12);
  }

  .pmh-quick-item span {
    display: block;
    color: rgba(255, 255, 255, 0.72);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0;
  }

  .pmh-quick-item strong {
    display: block;
    margin-top: 5px;
    color: #fff;
    font-size: 22px;
    line-height: 1.2;
  }

  .pmh-section {
    padding: 82px 0;
  }

  .pmh-section-title {
    max-width: 780px;
    margin-bottom: 32px;
  }

  .pmh-section-title h2 {
    margin: 0;
    color: #183527;
    font-size: 36px;
    line-height: 1.2;
    font-weight: 800;
    letter-spacing: 0;
  }

  .pmh-section-title p {
    margin: 12px 0 0;
    color: #667085;
    font-size: 16px;
    line-height: 1.7;
  }

  .pmh-process {
    background: #fff;
  }

  .pmh-process-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
  }

  .pmh-step,
  .pmh-news-card,
  .pmh-contact-box {
    border: 1px solid #e5ece8;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 14px 38px rgba(15, 23, 42, 0.06);
  }

  .pmh-step {
    padding: 24px;
    min-height: 184px;
  }

  .pmh-step .pmh-step-no {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
    border-radius: 8px;
    color: #12321f;
    background: #f4c542;
    font-weight: 800;
  }

  .pmh-step h3 {
    margin: 0 0 8px;
    color: #183527;
    font-size: 18px;
    font-weight: 800;
  }

  .pmh-step p {
    margin: 0;
    color: #667085;
    line-height: 1.65;
  }

  .pmh-main-info {
    color: #fff;
    background: #173b2a;
  }

  .pmh-main-info .row {
    align-items: stretch !important;
  }

  .pmh-main-info .pmh-section-title h2,
  .pmh-main-info .pmh-section-title p {
    color: #fff;
  }

  .pmh-info-copy {
    max-width: 760px;
    padding: 26px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: rgba(255, 255, 255, 0.88);
    background: rgba(255, 255, 255, 0.055);
    line-height: 1.8;
  }

  .pmh-info-copy,
  .pmh-info-copy * {
    text-align: left !important;
  }

  .pmh-info-copy p {
    margin-bottom: 12px;
  }

  .pmh-info-copy br {
    content: "";
  }

  .pmh-info-copy p:last-child {
    margin-bottom: 0;
  }

  .pmh-program-strip {
    display: grid;
    grid-template-columns: 1fr;
    gap: 14px;
    height: 100%;
  }

  .pmh-strip-item {
    display: grid;
    grid-template-columns: 44px 1fr;
    gap: 14px;
    align-items: center;
    min-height: 94px;
    padding: 20px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.09);
  }

  .pmh-strip-item i {
    color: #f4c542;
    font-size: 28px;
  }

  .pmh-strip-item strong {
    display: block;
    color: #fff;
  }

  .pmh-news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }

  .pmh-news-card {
    overflow: hidden;
  }

  .pmh-news-card img {
    width: 100%;
    aspect-ratio: 16 / 10;
    object-fit: cover;
  }

  .pmh-news-body {
    padding: 22px;
  }

  .pmh-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 12px;
    color: #74817a;
    font-size: 13px;
  }

  .pmh-meta i {
    color: #1f7a4d;
  }

  .pmh-news-body h3 {
    margin: 0 0 10px;
    color: #183527;
    font-size: 19px;
    line-height: 1.35;
    font-weight: 800;
  }

  .pmh-news-body p {
    color: #667085;
    line-height: 1.65;
  }

  .pmh-link {
    color: #1f7a4d;
    font-weight: 800;
  }

  .pmh-gallery {
    background: #eef5f1;
  }

  .pmh-gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
  }

  .pmh-gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    background: #dfe8e3;
  }

  .pmh-gallery-item img {
    width: 100%;
    aspect-ratio: 4 / 3;
    object-fit: cover;
    transition: transform .25s ease;
  }

  .pmh-gallery-item:hover img {
    transform: scale(1.04);
  }

  .pmh-gallery-title {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 18px;
    color: #fff;
    background: linear-gradient(180deg, rgba(10, 25, 18, 0), rgba(10, 25, 18, 0.82));
    font-weight: 800;
  }

  .pmh-contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .pmh-contact-box {
    padding: 26px;
  }

  .pmh-contact-row {
    display: grid;
    grid-template-columns: 42px 1fr;
    gap: 14px;
    padding: 16px 0;
    border-bottom: 1px solid #e5ece8;
  }

  .pmh-contact-row:last-child {
    border-bottom: 0;
  }

  .pmh-contact-row i {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #1f7a4d;
    background: #e9f5ee;
    font-size: 20px;
  }

  .pmh-contact-row h3 {
    margin: 0 0 4px;
    color: #183527;
    font-size: 16px;
    font-weight: 800;
  }

  .pmh-contact-row p {
    margin: 0;
    color: #667085;
    line-height: 1.6;
  }

  .pmh-map {
    min-height: 390px;
    overflow: hidden;
    border-radius: 8px;
    background: #dfe8e3;
  }

  .pmh-map iframe {
    width: 100% !important;
    min-height: 390px;
    border: 0;
  }

  @media (max-width: 991px) {
    .pmh-hero {
      min-height: auto;
      padding: 126px 0 70px;
    }

    .pmh-hero h1 {
      font-size: 42px;
    }

    .pmh-process-grid,
    .pmh-news-grid,
    .pmh-gallery-grid,
    .pmh-program-strip,
    .pmh-contact-grid {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media (max-width: 767px) {
    .pmh-hero {
      padding: 112px 0 58px;
      background-image: linear-gradient(90deg, rgba(4, 25, 17, 0.88), rgba(4, 25, 17, 0.66)), url("<?php echo $hero_image; ?>");
    }

    .pmh-hero h1 {
      font-size: 34px;
    }

    .pmh-hero-lead {
      font-size: 16px;
    }

    .pmh-quick-grid,
    .pmh-process-grid,
    .pmh-news-grid,
    .pmh-gallery-grid,
    .pmh-program-strip,
    .pmh-contact-grid {
      grid-template-columns: 1fr;
    }

    .pmh-section {
      padding: 58px 0;
    }

    .pmh-section-title h2 {
      font-size: 28px;
    }
  }
</style>

<div class="home-modern">
  <section class="pmh-hero">
    <div class="container">
      <span class="pmh-eyebrow"><i class="bi bi-mortarboard"></i> Penerimaan Mahasiswa Baru</span>
      <h1><?php echo $detail_institusi->nama; ?></h1>
      <div class="pmh-hero-lead">
        <?php echo $detail_institusi->deskripsi_beranda; ?>
      </div>
      <div class="pmh-actions">
        <a href="<?php echo base_url('home/pendaftaran'); ?>" class="pmh-btn pmh-btn-primary">
          <i class="bi bi-pencil-square"></i> Daftar Sekarang
        </a>
        <a href="<?php echo base_url('login'); ?>" class="pmh-btn pmh-btn-light">
          <i class="bi bi-box-arrow-in-right"></i> Login Pendaftar
        </a>
      </div>

      <div class="pmh-quick-panel">
        <div class="pmh-quick-grid">
          <div class="pmh-quick-item">
            <span>Program Studi</span>
            <strong><?php echo $program_count; ?>+</strong>
          </div>
          <div class="pmh-quick-item">
            <span>Pendaftar</span>
            <strong><?php echo number_format($total_pendaftar, 0, ',', '.'); ?></strong>
          </div>
          <div class="pmh-quick-item">
            <span>Layanan</span>
            <strong>Online</strong>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main id="main">
    <section class="pmh-section pmh-process">
      <div class="container">
        <div class="pmh-section-title">
          <h2>Alur Pendaftaran yang Lebih Mudah</h2>
          <p>Mulai dari pembuatan akun, pembayaran, verifikasi, hingga tes seleksi dapat dipantau langsung melalui dashboard pendaftar.</p>
        </div>
        <div class="pmh-process-grid">
          <div class="pmh-step">
            <div class="pmh-step-no">1</div>
            <h3>Isi Formulir</h3>
            <p>Buat akun pendaftar dan lengkapi pilihan program studi.</p>
          </div>
          <div class="pmh-step">
            <div class="pmh-step-no">2</div>
            <h3>Registrasi</h3>
            <p>Upload bukti pembayaran pendaftaran untuk diverifikasi admin.</p>
          </div>
          <div class="pmh-step">
            <div class="pmh-step-no">3</div>
            <h3>Ikuti Seleksi</h3>
            <p>Cek jadwal, kartu ujian, dan akses CBT dari dashboard.</p>
          </div>
          <div class="pmh-step">
            <div class="pmh-step-no">4</div>
            <h3>Daftar Ulang</h3>
            <p>Jika lulus, lanjutkan registrasi ulang sesuai instruksi kampus.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="pmh-section pmh-main-info">
      <div class="container">
        <div class="row align-items-center g-4">
          <div class="col-lg-7">
            <div class="pmh-section-title">
              <h2>Informasi Utama PMB</h2>
              <p>Pastikan membaca informasi resmi sebelum mengisi formulir pendaftaran.</p>
            </div>
            <div class="pmh-info-copy">
              <?php echo $detail_institusi->informasi_utama; ?>
            </div>
            <div class="pmh-actions">
              <a class="pmh-btn pmh-btn-primary" href="<?php echo base_url('home/pendaftaran'); ?>">
                <i class="bi bi-arrow-right-circle"></i> Mulai Pendaftaran
              </a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="pmh-program-strip">
              <div class="pmh-strip-item">
                <i class="bi bi-journal-check"></i>
                <strong>Formulir Online</strong>
              </div>
              <div class="pmh-strip-item">
                <i class="bi bi-credit-card"></i>
                <strong>Verifikasi Pembayaran</strong>
              </div>
              <div class="pmh-strip-item">
                <i class="bi bi-display"></i>
                <strong>CBT Terintegrasi</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="pmh-section">
      <div class="container">
        <div class="pmh-section-title">
          <h2>Informasi Terbaru</h2>
          <p>Pengumuman, agenda, dan kabar penting seputar penerimaan mahasiswa baru.</p>
        </div>
        <div class="pmh-news-grid">
          <?php foreach ($news_items as $item) { ?>
            <article class="pmh-news-card">
              <?php if($item->foto == '') { ?>
                <img src="<?php echo $default_news_image; ?>" alt="<?php echo $item->judul; ?>">
              <?php }else{ ?>
                <img src="<?php echo base_url('assets/upload/berita/thumbs/'.$item->foto); ?>" alt="<?php echo $item->judul; ?>">
              <?php } ?>
              <div class="pmh-news-body">
                <div class="pmh-meta">
                  <?php
                  $tanggal = date('D', strtotime($item->tanggal));
                  $hariList = array('Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu');
                  ?>
                  <span><i class="bi bi-calendar3"></i> <?php echo $hariList[$tanggal]; ?>, <?php echo date('d M Y', strtotime($item->tanggal)); ?></span>
                  <span><i class="bi bi-person-circle"></i> <?php echo $item->username; ?></span>
                </div>
                <h3><?php echo $item->judul; ?></h3>
                <p><?php echo character_limiter(strip_tags($item->isi_berita), 120); ?></p>
                <a href="<?php echo base_url('home/berita/'.$item->judul_seo); ?>" class="pmh-link">Baca detail <i class="bi bi-arrow-right"></i></a>
              </div>
            </article>
          <?php } ?>
        </div>
      </div>
    </section>

    <section class="pmh-section pmh-gallery">
      <div class="container">
        <div class="pmh-section-title">
          <h2>Galeri Kampus</h2>
          <p>Lihat suasana kegiatan dan lingkungan kampus.</p>
        </div>
        <div class="pmh-gallery-grid">
          <?php foreach($gallery_items as $item){ ?>
            <a href="<?php echo base_url('assets/upload/berita/'.$item->foto); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox pmh-gallery-item" title="<?php echo $item->judul; ?>">
              <img src="<?php echo base_url('assets/upload/berita/'.$item->foto); ?>" alt="<?php echo $item->judul; ?>">
              <span class="pmh-gallery-title"><?php echo $item->judul; ?></span>
            </a>
          <?php } ?>
        </div>
        <div class="text-center mt-4">
          <a href="<?php echo base_url('home/lebih_galeri'); ?>" class="pmh-btn pmh-btn-primary">
            <i class="bi bi-images"></i> Lihat Semua Galeri
          </a>
        </div>
      </div>
    </section>

    <section class="pmh-section">
      <div class="container">
        <div class="pmh-section-title">
          <h2>Kontak Panitia PMB</h2>
          <p>Hubungi panitia jika membutuhkan bantuan terkait alur pendaftaran.</p>
        </div>
        <div class="pmh-contact-grid">
          <div class="pmh-contact-box">
            <div class="pmh-contact-row">
              <i class="bi bi-geo-alt"></i>
              <div>
                <h3>Alamat</h3>
                <p><?php echo $detail_institusi->alamat; ?></p>
              </div>
            </div>
            <div class="pmh-contact-row">
              <i class="bi bi-envelope"></i>
              <div>
                <h3>Email</h3>
                <p><?php echo $detail_institusi->email; ?></p>
              </div>
            </div>
            <div class="pmh-contact-row">
              <i class="bi bi-phone"></i>
              <div>
                <h3>Telepon</h3>
                <p><?php echo $detail_institusi->telp; ?></p>
              </div>
            </div>
          </div>
          <div class="pmh-map">
            <?php echo $detail_institusi->maps; ?>
          </div>
        </div>
      </div>
    </section>
  </main>
</div>
