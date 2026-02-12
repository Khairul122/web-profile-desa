<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 40%, #1e3c72 100%);
            overflow: hidden;
            height: 100vh;
        }

        .login-container {
            height: 100vh;
        }

        .login-left {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-right {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
        }

        .info-box {
            max-width: 500px;
            text-align: center;
        }

        .feature-list {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left, .login-right {
                min-height: 50vh;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row h-100">
            <!-- Bagian Kiri - Informasi Login -->
            <div class="col-md-6 login-left d-flex align-items-center justify-content-center">
                <div class="info-box p-4">
                    <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-shield-lock text-white" viewBox="0 0 16 16">
                            <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.159.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.185.652.38.893.6.11.106.19.285.133.497-.004.01-.017.01-.026.004C5.76 14.434 3.738 12.336 2.5 9.878c2.207-2.771 4.922-5.266 7.5-6.763V3.04c-2.586 1.51-5.086 3.992-6.662 6.826z"/>
                            <path d="M7.468 11.977c-.825 0-1.497-.658-1.497-1.464 0-.162.025-.322.075-.47.24-.876 1.24-1.55 2.438-1.55.825 0 1.497.658 1.497 1.464 0 .162-.025.322-.075.47-.24.876-1.24 1.55-2.438 1.55z"/>
                            <path d="M10 9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                    </div>

                    <h1 class="display-6 fw-bold mb-3">Selamat Datang Kembali</h1>
                    <p class="lead mb-4">Silakan masuk ke akun Anda untuk mengakses dashboard</p>

                    <div class="feature-list">
                        <h5 class="fw-bold mb-3">Fitur Aplikasi:</h5>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Manajemen berita desa
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Galeri dokumentasi
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Data penduduk dan pengurus
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Laporan dan statistik
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan - Form Login -->
            <div class="col-md-6 login-right d-flex align-items-center justify-content-center">
                <div class="login-card p-4">
                    <div class="text-center mb-4">
                        <div class="mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill-lock text-primary" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4Zm-.854 1.352a.5.5 0 0 0-.11.883l.853.853a.5.5 0 0 0 .708 0l.853-.853a.5.5 0 0 0-.708-.708l-.147.146c-.4-.4-.866-.732-1.397-.986l.853-.853a.5.5 0 0 0-.708-.708l-.853.853c-.254-.531-.586-.997-.986-1.397l.853-.853a.5.5 0 0 0-.883-.11l-.853.853a.5.5 0 0 0 0 .708l.853.853a.5.5 0 0 0 .708 0Z"/>
                            </svg>
                        </div>
                        <h2 class="fw-bold text-dark">Masuk ke Akun</h2>
                        <p class="text-muted">Silakan masukkan username dan password Anda</p>
                    </div>

                    <?php
                    // Tampilkan pesan flash jika ada
                    require_once __DIR__ . '/../../core/Flasher.php';
                    echo \User\WebDesa\Core\Flasher::getMessage();
                    ?>

                    <form action="<?= BASE_URL ?>/auth/prosesLogin" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-medium text-dark">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username Anda" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium text-dark">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 0 0-6 0v2a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi Anda" required>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-medium">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="text-muted small">
                            Hubungi administrator untuk membuat akun baru
                        </p>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-muted small mb-0">© 2026 Website Profil Desa. Ditenagai oleh Teknologi Informasi Desa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>