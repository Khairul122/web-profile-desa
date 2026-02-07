<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> - Website Profil Desa</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php 
    // Tampilkan pesan flash jika ada
    use User\WebDesa\Core\Flasher;
    echo Flasher::getMessage();
    ?>

    <!-- Navbar -->
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="<?= BASE_URL ?>" class="text-xl font-bold">Website Profil Desa</a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="<?= BASE_URL ?>" class="hover:text-blue-200">Beranda</a>
                    <a href="#" class="hover:text-blue-200">Profil Desa</a>
                    <a href="#" class="hover:text-blue-200">Berita</a>
                    <a href="#" class="hover:text-blue-200">Layanan</a>
                    <a href="#" class="hover:text-blue-200">Galeri</a>
                    <a href="#" class="hover:text-blue-200">Kontak</a>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="relative group">
                            <button class="flex items-center space-x-1 hover:text-blue-200">
                                <span>Hi, <?= $_SESSION['username'] ?></span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg py-2 hidden group-hover:block z-10">
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <a href="<?= BASE_URL ?>/dashboard/admin" class="block px-4 py-2 hover:bg-gray-100">Dashboard Admin</a>
                                <?php elseif ($_SESSION['role'] === 'kepala_desa'): ?>
                                    <a href="<?= BASE_URL ?>/dashboard/kepaladesa" class="block px-4 py-2 hover:bg-gray-100">Dashboard Kepala Desa</a>
                                <?php elseif ($_SESSION['role'] === 'sekretaris'): ?>
                                    <a href="<?= BASE_URL ?>/dashboard/sekretaris" class="block px-4 py-2 hover:bg-gray-100">Dashboard Sekretaris</a>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>/auth/logout" class="block px-4 py-2 hover:bg-gray-100 text-red-500">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/auth/login" class="hover:text-blue-200">Login</a>
                    <?php endif; ?>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="hidden md:hidden py-4 border-t border-blue-700">
                <a href="<?= BASE_URL ?>" class="block py-2 hover:text-blue-200">Beranda</a>
                <a href="#" class="block py-2 hover:text-blue-200">Profil Desa</a>
                <a href="#" class="block py-2 hover:text-blue-200">Berita</a>
                <a href="#" class="block py-2 hover:text-blue-200">Layanan</a>
                <a href="#" class="block py-2 hover:text-blue-200">Galeri</a>
                <a href="#" class="block py-2 hover:text-blue-200">Kontak</a>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a href="<?= BASE_URL ?>/dashboard/admin" class="block py-2 hover:text-blue-200">Dashboard Admin</a>
                    <?php elseif ($_SESSION['role'] === 'kepala_desa'): ?>
                        <a href="<?= BASE_URL ?>/dashboard/kepaladesa" class="block py-2 hover:text-blue-200">Dashboard Kepala Desa</a>
                    <?php elseif ($_SESSION['role'] === 'sekretaris'): ?>
                        <a href="<?= BASE_URL ?>/dashboard/sekretaris" class="block py-2 hover:text-blue-200">Dashboard Sekretaris</a>
                    <?php endif; ?>
                    <a href="<?= BASE_URL ?>/auth/logout" class="block py-2 hover:text-blue-200 text-red-500">Logout</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>/auth/login" class="block py-2 hover:text-blue-200">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Mobile menu script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>