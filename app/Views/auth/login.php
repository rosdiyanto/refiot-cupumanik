<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - Sistem Pegawai</title>
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

            <p>Silakan login ke akun Anda</p>

            <form>
                <div class="mb-3 text-start">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Masukkan email..." />
                </div>

                <div class="mb-3 text-start">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan password..." />
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" />
                        <label class="form-check-label small" for="remember">Ingat saya</label>
                    </div>
                    <a class="small" href="#">Lupa password?</a>
                </div>

                <button class="btn btn-primary w-100">Masuk</button>
            </form>

            <hr class="my-4" />
            <div class="small">
                Belum punya akun? <a href="#">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>