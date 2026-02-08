<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 40%, #1e3c72 100%);
            overflow: hidden;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .login-container {
            height: 100vh;
        }
        
        .login-left {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-right {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-form {
            width: 100%;
            max-width: 400px;
        }
        
        .info-box {
            max-width: 500px;
            text-align: center;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 15px;
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
            <!-- Bagian Kiri - Form Login -->
            <div class="col-md-6 login-left d-flex align-items-center justify-content-center">
                <div class="login-form p-4">
                    <div class="text-center mb-4">
                        <div class="mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-shield-lock text-primary" viewBox="0 0 16 16">
                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.159.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.185.652.38.893.6.11.106.19.285.133.497-.004.01-.017.01-.026.004C5.76 14.434 3.738 12.336 2.5 9.878c2.207-2.771 4.922-5.266 7.5-6.763V3.04c-2.586 1.51-5.086 3.992-6.662 6.826z"/>
                                <path d="M8 9.023c.902.414 1.825.744 2.75 1v-1.5A2.5 2.5 0 0 0 8 6.5c-1.359 0-2.5 1.14-2.5 2.5v1.5c.925-.256 1.848-.586 2.75-1z"/>
                            </svg>
                        </div>
                        <h2 class="fw-bold text-dark">Selamat Datang</h2>
                        <p class="text-muted">Silakan masuk ke akun Anda</p>
                    </div>
                    
                    <?php 
                    // Tampilkan pesan flash jika ada
                    require_once '../app/core/Flasher.php';
                    $flashMessage = \User\WebDesa\Core\Flasher::getMessage();
                    if (!empty($flashMessage)) {
                        echo $flashMessage;
                    }
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
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
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
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                            </div>
                        </div>
                        
                        <div class="mb-3 form-check d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
                                <label class="form-check-label text-dark" for="remember-me">Ingat saya</label>
                            </div>
                            <a href="#" class="text-decoration-none text-primary">Lupa kata sandi?</a>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-medium">Masuk ke Akun</button>
                        </div>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <p class="text-muted small mb-0">© 2026 Website Profil Desa. Ditenagai oleh Teknologi Informasi Desa.</p>
                    </div>
                </div>
            </div>
            
            <!-- Bagian Kanan - Informasi Desa -->
            <div class="col-md-6 login-right d-flex align-items-center justify-content-center">
                <div class="info-box p-4">
                    <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-building text-white" viewBox="0 0 16 16">
                            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0v-1zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0V5zM4 8.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0v-1zm1.5 1a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3.5-.5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0v-1z"/>
                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1z"/>
                        </svg>
                    </div>
                    
                    <h1 class="display-6 fw-bold mb-3">Website Profil Desa</h1>
                    <p class="lead mb-4">Platform resmi pelayanan dan informasi pemerintahan desa berbasis digital</p>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h3 class="fw-bold mb-1">1,250+</h3>
                                <p class="mb-0 small opacity-75">Penduduk</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h3 class="fw-bold mb-1">45</h3>
                                <p class="mb-0 small opacity-75">RT</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h3 class="fw-bold mb-1">12</h3>
                                <p class="mb-0 small opacity-75">RW</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        // Animasi menggunakan GSAP
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi form login
            gsap.from(".login-form", {
                duration: 0.8,
                opacity: 0,
                x: -50,
                ease: "power3.out"
            });
            
            // Animasi elemen-elemen form
            gsap.from("input, button, .text-center", {
                duration: 0.5,
                opacity: 0,
                y: 20,
                stagger: 0.1,
                delay: 0.3,
                ease: "power2.out"
            });
            
            // Animasi bagian kanan (jika tampil)
            if(window.innerWidth > 768) {
                gsap.from(".info-box", {
                    duration: 1,
                    opacity: 0,
                    x: 50,
                    delay: 0.5,
                    ease: "power3.out"
                });
            }
            
            // Efek interaktif pada input fields
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    gsap.to(input, {duration: 0.3, boxShadow: '0 0 0 0.25rem rgba(13, 110, 253, 0.25)', scale: 1.02});
                });
                
                input.addEventListener('blur', () => {
                    gsap.to(input, {duration: 0.3, boxShadow: 'none', scale: 1});
                });
            });
        });
        
        // Animasi tambahan menggunakan Anime.js
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk card-card informasi
            anime({
                targets: '.stat-card',
                translateY: [-20, 0],
                opacity: [0, 1],
                delay: anime.stagger(200),
                duration: 1000,
                easing: 'easeOutQuart'
            });
        });
    </script>
</body>
</html>