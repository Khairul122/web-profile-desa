<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?? $_SESSION['role'] . ' Dashboard' ?? 'Dashboard'; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <style>
        :root {
            --sidebar-width: 260px;
            --navbar-height: 70px;
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border-color: #dee2e6;
            --sidebar-bg: #ffffff;
            --navbar-bg: #ffffff;
            --body-bg: #f5f7fb;
            --card-bg: #ffffff;
            --text-color: #333333;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            padding-top: var(--navbar-height);
            transition: var(--transition);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--navbar-height));
            background: var(--sidebar-bg);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            z-index: 100;
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: var(--dark);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 10px;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-header h5 {
            font-weight: 600;
            color: var(--primary);
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: var(--navbar-height);
            background: var(--navbar-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 1050;
            padding: 0 20px;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            font-size: 24px;
        }

        .navbar-nav .nav-link {
            color: var(--dark);
            padding: 10px 15px;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: var(--transition);
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            background: var(--card-bg);
            transition: var(--transition);
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 20px;
        }

        .card-body {
            padding: 25px;
        }

        /* Stats Cards */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card .icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card .number {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card .label {
            color: var(--gray);
            font-size: 14px;
        }

        /* Toggle Button */
        .toggle-sidebar {
            margin-right: 20px;
            cursor: pointer;
            font-size: 20px;
            color: var(--dark);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
            }
            
            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: var(--navbar-height);
            }
            
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 99;
                display: none;
            }
            
            .overlay.active {
                display: block;
            }
        }

        /* Web 3.0 Elements */
        .web3-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <span class="toggle-sidebar me-3" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </span>
                <a class="navbar-brand" href="#">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['nama_lengkap'] ?? 'User'); ?>&background=random" alt="User">
                    <div>
                        <div class="fw-bold"><?= $_SESSION['nama_lengkap'] ?? 'User'; ?></div>
                        <small class="text-muted"><?= ucfirst(str_replace('_', ' ', $_SESSION['role'] ?? 'user')); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5>Menu Navigasi</h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?= BASE_URL ?>/dashboard/admin">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i>
                    <span>Data Penduduk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita Desa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-file-alt"></i>
                    <span>Surat Menyurat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>/auth/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Content will be loaded here -->
            <?php if (isset($data['content'])) { echo $data['content']; } else { ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Selamat Datang di Dashboard</h5>
                        </div>
                        <div class="card-body">
                            <p>Halo, <strong><?= $_SESSION['nama_lengkap'] ?? 'Admin'; ?></strong>! Selamat datang di dashboard.</p>
                            <p>Pilih menu di sidebar untuk mengelola konten website desa.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('collapsed');
            
            // For mobile view
            if (window.innerWidth <= 768) {
                const overlay = document.getElementById('overlay');
                overlay.classList.toggle('active');
            }
        });
        
        // Close sidebar when clicking on overlay (mobile)
        document.getElementById('overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
        
        // For mobile view, toggle sidebar open/close
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('collapsed');
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
                document.getElementById('overlay').classList.remove('active');
            } else {
                sidebar.classList.add('collapsed');
            }
        });
        
        // GSAP Animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            gsap.from(".card", {
                duration: 0.8,
                opacity: 0,
                y: 30,
                stagger: 0.1,
                ease: "power2.out"
            });
            
            // Animate sidebar items
            gsap.from(".nav-link", {
                duration: 0.5,
                opacity: 0,
                x: -20,
                stagger: 0.05,
                delay: 0.3,
                ease: "power2.out"
            });
        });
        
        // Anime.js animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stat numbers
            anime({
                targets: '.number',
                innerHTML: [0, el => parseInt(el.textContent)],
                duration: 2000,
                round: 1,
                easing: 'easeInOutQuad'
            });
            
            // Floating effect for cards
            anime({
                targets: '.card',
                translateY: [
                    { value: -5, duration: 1000, delay: 0 },
                    { value: 5, duration: 1000, delay: 0 }
                ],
                direction: 'alternate',
                loop: true,
                easing: 'easeInOutSine'
            });
        });
    </script>
</body>
</html>