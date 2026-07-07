<!doctype html>
<html lang="en">
  <head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
      $detail_institusi = $this->admin_model->detail_institusi();
      $login_bg = !empty($detail_institusi->bg) ? base_url('assets/upload/bg/'.$detail_institusi->bg) : base_url('assets/bg.jpg');
      $logo = base_url('assets/logounik.png');
    ?>
    <link href="<?php echo base_url('assets/upload/logo/thumbs/'.$detail_institusi->logo)?>" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/login/css/style.css">

    <style>
      * {
        box-sizing: border-box;
      }

      body {
        min-height: 100vh;
        margin: 0;
        color: #1f2933;
        background: #f6faf7;
        font-family: "Open Sans", Arial, sans-serif;
      }

      .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
        background:
          linear-gradient(180deg, rgba(246, 250, 247, 0.86), rgba(246, 250, 247, 0.98)),
          url("<?php echo $login_bg; ?>") center / cover no-repeat;
      }

      .login-shell {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 430px;
        min-height: 640px;
        overflow: hidden;
        border: 1px solid #e2ebe6;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 26px 70px rgba(15, 23, 42, 0.16);
      }

      .login-visual {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 42px;
        color: #fff;
        background:
          linear-gradient(120deg, rgba(6, 38, 25, 0.9), rgba(6, 82, 52, 0.62)),
          url("<?php echo $login_bg; ?>") center / cover no-repeat;
      }

      .login-logo img {
        width: 220px;
        max-width: 100%;
        height: auto;
        filter: drop-shadow(0 10px 24px rgba(0, 0, 0, 0.2));
      }

      .login-copy {
        max-width: 620px;
      }

      .login-copy span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        margin-bottom: 18px;
        border: 1px solid rgba(255, 255, 255, 0.28);
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        font-size: 13px;
        font-weight: 700;
      }

      .login-copy h1 {
        margin: 0;
        color: #fff;
        font-family: "Raleway", sans-serif;
        font-size: 46px;
        line-height: 1.14;
        font-weight: 800;
        letter-spacing: 0;
      }

      .login-copy p {
        margin: 18px 0 0;
        color: rgba(255, 255, 255, 0.86);
        font-size: 16px;
        line-height: 1.75;
      }

      .login-points {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 30px;
      }

      .login-point {
        min-height: 92px;
        padding: 16px;
        border: 1px solid rgba(255, 255, 255, 0.13);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.09);
      }

      .login-point i {
        color: #f4c542;
        font-size: 22px;
      }

      .login-point strong {
        display: block;
        margin-top: 10px;
        color: #fff;
        font-size: 13px;
        line-height: 1.35;
      }

      .login-panel {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 42px;
      }

      .login-panel h2 {
        margin: 0;
        color: #173b2a;
        font-family: "Raleway", sans-serif;
        font-size: 30px;
        line-height: 1.25;
        font-weight: 800;
      }

      .login-panel > p {
        margin: 10px 0 26px;
        color: #667085;
        line-height: 1.65;
      }

      .login-alert {
        border-radius: 8px;
        font-size: 14px;
      }

      .login-form label {
        margin-bottom: 8px;
        color: #344054;
        font-family: "Poppins", sans-serif;
        font-size: 13px;
        font-weight: 800;
      }

      .login-form .form-control {
        height: 48px;
        border: 1px solid #d8e2dd;
        border-radius: 8px;
        color: #1f2933;
        background: #fbfdfc;
        box-shadow: none;
      }

      .login-form .form-control:focus {
        border-color: #159464;
        box-shadow: 0 0 0 3px rgba(21, 148, 100, 0.12);
      }

      .login-password-field {
        position: relative;
      }

      .login-password-field .form-control {
        padding-right: 48px;
      }

      .login-password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 8px;
        color: #667085;
        background: transparent;
        transform: translateY(-50%);
        cursor: pointer;
      }

      .login-password-toggle:hover,
      .login-password-toggle:focus {
        color: #087f5f;
        background: #eef6f2;
        outline: none;
      }

      .login-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-height: 50px;
        border: 0;
        border-radius: 8px;
        color: #fff;
        background: #009f73;
        font-family: "Poppins", sans-serif;
        font-weight: 800;
        box-shadow: 0 16px 36px rgba(0, 159, 115, 0.22);
      }

      .login-submit:hover,
      .login-submit:focus {
        color: #fff;
        background: #087f5f;
      }

      .login-links {
        display: grid;
        gap: 10px;
        margin-top: 22px;
        text-align: center;
        color: #667085;
        font-family: "Open Sans", Arial, sans-serif;
        font-size: 14px;
      }

      .login-links a {
        color: #087f5f;
        font-weight: 800;
      }

      .login-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        margin-top: 12px;
        border: 1px solid #d8e2dd;
        border-radius: 8px;
        color: #173b2a !important;
        background: #fff;
      }

      @media (max-width: 991px) {
        .login-page {
          padding: 24px 0;
        }

        .login-shell {
          grid-template-columns: 1fr;
        }

        .login-visual {
          min-height: 360px;
        }

        .login-copy h1 {
          font-size: 36px;
        }
      }

      @media (max-width: 575px) {
        .login-visual,
        .login-panel {
          padding: 26px;
        }

        .login-points {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>
  <body>
    <main class="login-page">
      <div class="container">
        <div class="login-shell">
          <section class="login-visual">
            <a class="login-logo" href="<?php echo base_url(); ?>">
              <img src="<?php echo $logo; ?>" alt="<?php echo $detail_institusi->nama; ?>">
            </a>

            <div class="login-copy">
              <span><i class="fa fa-lock"></i> Portal PMB</span>
              <h1>Masuk ke dashboard pendaftar</h1>
              <p>Pantau status pendaftaran, pembayaran, berkas, dan akses ujian dari satu portal resmi PMB.</p>
              <div class="login-points">
                <div class="login-point">
                  <i class="fa fa-file-text-o"></i>
                  <strong>Formulir dan data pendaftar</strong>
                </div>
                <div class="login-point">
                  <i class="fa fa-credit-card"></i>
                  <strong>Verifikasi pembayaran</strong>
                </div>
                <div class="login-point">
                  <i class="fa fa-desktop"></i>
                  <strong>Informasi CBT</strong>
                </div>
              </div>
            </div>
          </section>

          <section class="login-panel">
            <h2>Login Pendaftar</h2>
            <p>Gunakan username dan kata sandi yang dibuat saat pendaftaran.</p>

            <?php
              echo validation_errors('<div class="alert alert-warning login-alert">','</div>');
              if($this->session->flashdata('warning')){
                echo '<div class="alert alert-warning login-alert">'.$this->session->flashdata('warning').'</div>';
              }
              if($this->session->flashdata('success')){
                echo '<div class="alert alert-success login-alert">'.$this->session->flashdata('success').'</div>';
              }
            ?>

            <form method="post" action="<?php echo base_url('login')?>" class="login-form">
              <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <div class="login-password-field">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" required>
                  <button type="button" class="login-password-toggle" id="toggle-password" aria-label="Lihat password">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
              <button type="submit" class="login-submit"><i class="fa fa-sign-in"></i> Login</button>
            </form>

            <div class="login-links">
              <span>Lupa password? <a href="<?php echo base_url('home/lupa_password')?>">Klik disini</a></span>
              <span>Belum punya akun? <a href="<?php echo base_url('home/pendaftaran')?>">Daftar disini</a></span>
              <a class="login-home" href="<?php echo base_url()?>"><i class="fa fa-home"></i> Kembali ke Home</a>
            </div>
          </section>
        </div>
      </div>
    </main>

    <script src="<?php echo base_url()?>assets/login/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/login/js/popper.js"></script>
    <script src="<?php echo base_url()?>assets/login/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/login/js/main.js"></script>
    <script>
      (function() {
        var password = document.getElementById('password');
        var toggle = document.getElementById('toggle-password');

        if (!password || !toggle) {
          return;
        }

        toggle.addEventListener('click', function() {
          var isHidden = password.getAttribute('type') === 'password';
          password.setAttribute('type', isHidden ? 'text' : 'password');
          toggle.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Lihat password');
          toggle.querySelector('i').className = isHidden ? 'fa fa-eye-slash' : 'fa fa-eye';
        });
      })();
    </script>
  </body>
</html>
