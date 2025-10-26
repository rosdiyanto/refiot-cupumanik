<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register - Sistem Pegawai</title>
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/auth.css?v=<?= time() ?>" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon.png" />
</head>

<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="login-card text-center">
            <!-- Logo Refiot -->
            <img src="<?= base_url() ?>assets/img/logo-refiot.svg" alt="Logo Refiot" class="login-logo">
            <p>Isi data untuk registrasi pegawai</p>

            <form id="registerForm" method="POST" action="<?= site_url('auth/register') ?>">
                <!-- NIP -->
                <div class="mb-3 text-start">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP..." required>
                </div>

                <!-- Email -->
                <div class="mb-3 text-start">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email..." required>
                </div>

                <!-- Username -->
                <div class="mb-3 text-start">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Buat username..." required>
                </div>

                <!-- Password -->
                <div class="mb-3 text-start">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
                </div>

                <!-- Re-Password -->
                <div class="mb-3 text-start">
                    <label>Ulangi Password</label>
                    <input type="password" name="repassword" class="form-control" placeholder="Ketik ulang password..." required>
                </div>

                <button class="btn btn-primary w-100">Daftar</button>
            </form>

            <hr class="my-3" />
            <div class="small">
                Sudah punya akun? <a href="<?= site_url('auth/login') ?>">Login sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>