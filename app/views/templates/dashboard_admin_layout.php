<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?? 'Dashboard Admin'; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-width-collapsed: 70px;
            --navbar-height: 60px;
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --sidebar-bg: #ffffff;
            --navbar-bg: #ffffff;
            --body-bg: #f4f6f9;
            --border-color: #e9ecef;
            --text-color: #333333;
            --transition-speed: 0.3s;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            padding-top: var(--navbar-height);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar-admin {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            background: var(--navbar-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            z-index: 1050;
            padding: 0 1rem;
        }

        .navbar-brand-admin {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.25rem;
        }

        /* Sidebar - Desktop */
        .sidebar-admin {
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--navbar-height));
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            transition: transform var(--transition-speed) ease;
            z-index: 1000;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .sidebar-admin.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 0.5rem;
        }

        .sidebar-header h6 {
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-admin.collapsed .sidebar-header h6 {
            display: none;
        }

        .nav-admin .nav-link {
            color: var(--text-color);
            padding: 0.75rem 1.25rem;
            margin: 0.25rem 0.75rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .nav-admin .nav-link:hover,
        .nav-admin .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .nav-admin .nav-link i {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-admin.collapsed .nav-link span {
            display: none;
        }

        .sidebar-admin.collapsed .nav-link {
            justify-content: center;
            padding: 0.75rem;
            margin: 0.25rem 0.5rem;
        }

        /* Mobile Sidebar - Offcanvas */
        .sidebar-offcanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1100;
            transform: translateX(-100%);
            transition: transform var(--transition-speed) ease;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
        }

        .sidebar-offcanvas.show {
            transform: translateX(0);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed) ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .mobile-nav-header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mobile-nav-header h6 {
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .btn-close-sidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-color);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            transition: margin-left var(--transition-speed) ease;
            min-height: calc(100vh - var(--navbar-height));
        }

        .sidebar-admin.collapsed ~ .main-content {
            margin-left: var(--sidebar-width-collapsed);
        }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .stat-card .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .stat-card .stat-number {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-card .stat-label {
            color: #6c757d;
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 1199.98px) {
            .sidebar-admin {
                width: var(--sidebar-width-collapsed);
            }

            .sidebar-admin .sidebar-header h6,
            .sidebar-admin .nav-link span {
                display: none;
            }

            .sidebar-admin .nav-link {
                justify-content: center;
                padding: 0.75rem;
            }

            .main-content {
                margin-left: var(--sidebar-width-collapsed);
            }
        }

        @media (max-width: 767.98px) {
            .sidebar-admin {
                display: none !important;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .navbar-brand-admin span {
                display: none;
            }

            .user-info .user-text {
                display: none;
            }

            .stat-card {
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .stat-card .stat-number {
                font-size: 1.5rem;
            }
        }

        /* Dropdown */
        .user-dropdown .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 10px;
            padding: 0.5rem;
        }

        .user-dropdown .dropdown-item {
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }

        .user-dropdown .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-admin">
        <div class="container-fluid px-0">
            <div class="d-flex align-items-center">
                <button class="btn btn-link text-dark p-0 me-2" id="toggleSidebarBtn" aria-label="Toggle sidebar">
                    <i class="fas fa-bars fs-5"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="dropdown user-dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle user-info" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['nama_lengkap'] ?? 'Admin'); ?>&background=4361ee&color=fff" alt="User" class="user-avatar me-2">
                        <div class="user-text">
                            <div class="fw-semibold small"><?= htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Admin'); ?></div>
                            <small class="text-muted"><?= ucfirst($_SESSION['role'] ?? 'Administrator'); ?></small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>/auth/logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Desktop Sidebar -->
    <aside class="sidebar-admin" id="desktopSidebar">
        <div class="sidebar-header">
            <h6>Menu Navigasi</h6>
        </div>
        <ul class="nav nav-admin flex-column">
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'beranda' ? 'active' : '' ?>" href="<?= BASE_URL ?>/dashboard/admin">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'penduduk' ? 'active' : '' ?>" href="#">
                    <i class="fas fa-users"></i>
                    <span>Data Penduduk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'berita' ? 'active' : '' ?>" href="<?= BASE_URL ?>/berita/index">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'galeri' ? 'active' : '' ?>" href="<?= BASE_URL ?>/galeri/index">
                    <i class="fas fa-images"></i>
                    <span>Kelola Galeri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'profile' ? 'active' : '' ?>" href="<?= BASE_URL ?>/profile/index">
                    <i class="fas fa-file-alt"></i>
                    <span>Kelola Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'pengurus' ? 'active' : '' ?>" href="<?= BASE_URL ?>/pengurus/index">
                    <i class="fas fa-users"></i>
                    <span>Kelola Pengurus</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= isset($data['page']) && $data['page'] == 'pengaturan' ? 'active' : '' ?>" href="#">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link text-danger" href="<?= BASE_URL ?>/auth/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
