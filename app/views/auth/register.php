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

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #0d6efd 40%, #1e3c72 100%);
            overflow: hidden;
            height: 100vh;
        }
        
        .register-container {
            height: 100vh;
        }
        
        .register-left {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .register-right {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .register-card {
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
            .register-container {
                flex-direction: column;
            }
            
            .register-left, .register-right {
                min-height: 50vh;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid register-container">
        <div class="row h-100">
            <!-- Bagian Kiri - Informasi Registrasi -->
            <div class="col-md-6 register-left d-flex align-items-center justify-content-center">
                <div class="info-box p-4">
                    <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-person-plus text-white" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </div>
                    
                    <h1 class="display-6 fw-bold mb-3">Daftar Akun Baru</h1>
                    <p class="lead mb-4">Bergabunglah dengan platform pelayanan dan informasi pemerintahan desa berbasis digital</p>
                    
                    <div class="feature-list">
                        <h5 class="fw-bold mb-3">Keuntungan Bergabung:</h5>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Akses informasi desa secara cepat dan akurat
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Pengajuan surat secara online
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Partisipasi dalam pembangunan desa
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Bagian Kanan - Form Registrasi -->
            <div class="col-md-6 register-right d-flex align-items-center justify-content-center">
                <div class="register-card p-4">
                    <div class="text-center mb-4">
                        <div class="mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill-add text-primary" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5a.5.5 0 0 1 .5.5V12h.5a.5.5 0 0 1 0 1h-1a.5.5 0 0 1 0-1H13v-.5a.5.5 0 0 1 .5-.5Zm-6 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1Zm-4-4a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm0 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm.5-5a.5.5 0 0 0-1 0v3a.5.5 0 0 0 1 0V5Zm2 0a.5.5 0 0 0-1 0v3a.5.5 0 0 0 1 0V5Z"/>
                            </svg>
                        </div>
                        <h2 class="fw-bold text-dark">Buat Akun</h2>
                        <p class="text-muted">Silakan isi formulir berikut untuk mendaftar</p>
                    </div>
                    
                    <?php 
                    // Tampilkan pesan flash jika ada
                    require_once '../../../app/core/Flasher.php';
                    echo \User\WebDesa\Core\Flasher::getMessage();
                    ?>
                    
                    <form action="<?= BASE_URL ?>/register/prosesRegister" method="post">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-medium text-dark">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap Anda" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label fw-medium text-dark">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.404v-2.206h-.835c-.582 0-.851-.669-.679-1.289l1.518-3.049c.135-.27.472-.27.607 0l1.519 3.049c.176.341.034.752-.332.752h-.86l-1.08.358c-.18.598-.598.862-1.127.862-.64 0-1.058-.418-1.058-1.157 0-.642.39-1.157 1.034-1.157.567 0 .875.402.982.771l1.569 3.148c.117.232.02.514-.22.595l-1.71.562c-.24.079-.48.079-.72 0a.5.5 0 0 1-.22-.595l1.568-3.148c.107-.37.01-.752-.333-.752z"/>
                                        <path d="M13 12.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                    </svg>
                                </span>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username unik" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium text-dark">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                    </svg>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="alamat@email.com" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="no_hp" class="form-label fw-medium text-dark">No. Handphone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                </span>
                                <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" required>
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
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi minimal 6 karakter" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label fw-medium text-dark">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                                        <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.159.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.185.652.38.893.6.11.106.19.285.133.497-.004.01-.017.01-.026.004C5.76 14.434 3.738 12.336 2.5 9.878c2.207-2.771 4.922-5.266 7.5-6.763V3.04c-2.586 1.51-5.086 3.992-6.662 6.826z"/>
                                        <path d="M8 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2z"/>
                                        <path d="M7.5 7.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1z"/>
                                    </svg>
                                </span>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi kata sandi" required>
                            </div>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-medium">Daftar Akun</button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <p class="text-muted small">
                            Sudah punya akun? 
                            <a href="<?= BASE_URL ?>/auth/login" class="text-decoration-none text-primary fw-medium">
                                Masuk di sini
                            </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        // Animasi menggunakan GSAP
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi form registrasi
            gsap.from(".register-card", {
                duration: 0.8,
                opacity: 0,
                x: 50,
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
            
            // Animasi bagian kiri (jika tampil)
            if(window.innerWidth > 768) {
                gsap.from(".info-box", {
                    duration: 1,
                    opacity: 0,
                    x: -50,
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
                targets: '.feature-list',
                translateY: [-20, 0],
                opacity: [0, 1],
                delay: anime.stagger(200),
                duration: 1000,
                easing: 'easeOutQuart'
            });
            
            // Animasi untuk ikon di bagian informasi
            anime({
                targets: '.bg-white\\.bg-opacity-20',
                scale: [{value: 1}, {value: 1.05}, {value: 1}],
                duration: 2000,
                easing: 'easeInOutSine',
                loop: true,
                direction: 'alternate'
            });
            
            // Animasi untuk teks judul
            anime({
                targets: '.display-6, .fw-bold',
                rotateY: {value: [0, 10, 0], duration: 1000},
                delay: anime.stagger(200, {start: 500}),
                duration: 1000,
                easing: 'easeOutElastic'
            });
            
            // Animasi untuk elemen-elemen di bagian register
            anime({
                targets: '.register-card .form-control',
                translateX: [10, 0],
                opacity: [0, 1],
                delay: anime.stagger(100),
                duration: 800,
                easing: 'easeOutCubic'
            });
        });
    </script>
</body>
</html>