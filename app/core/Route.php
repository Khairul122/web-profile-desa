<?php
// File route.php - Definisi route untuk aplikasi

// Contoh definisi route
$routes = [
    // Route untuk halaman utama
    '' => ['controller' => 'HomeController', 'method' => 'index'],
    'home' => ['controller' => 'HomeController', 'method' => 'index'],
    
    // Route untuk autentikasi
    'auth/login' => ['controller' => 'AuthController', 'method' => 'login'],
    'auth/prosesLogin' => ['controller' => 'AuthController', 'method' => 'prosesLogin'],
    'auth/logout' => ['controller' => 'AuthController', 'method' => 'logout'],
    
    
    // Route untuk dashboard
    'dashboard/admin' => ['controller' => 'DashboardController', 'method' => 'admin'],
    'dashboard/kepaladesa' => ['controller' => 'DashboardController', 'method' => 'kepaladesa'],
    'dashboard/sekretaris' => ['controller' => 'DashboardController', 'method' => 'sekretaris'],

    // Route untuk berita
    'berita' => ['controller' => 'BeritaController', 'method' => 'index'],
    'berita/index' => ['controller' => 'BeritaController', 'method' => 'index'],
    'berita/create' => ['controller' => 'BeritaController', 'method' => 'create'],
    'berita/store' => ['controller' => 'BeritaController', 'method' => 'store'],
    'berita/edit/([0-9]+)' => ['controller' => 'BeritaController', 'method' => 'edit'],
    'berita/update/([0-9]+)' => ['controller' => 'BeritaController', 'method' => 'update'],
    'berita/delete/([0-9]+)' => ['controller' => 'BeritaController', 'method' => 'delete'],

    // Route untuk galeri
    'galeri' => ['controller' => 'GaleriController', 'method' => 'index'],
    'galeri/index' => ['controller' => 'GaleriController', 'method' => 'index'],
    'galeri/create' => ['controller' => 'GaleriController', 'method' => 'create'],
    'galeri/store' => ['controller' => 'GaleriController', 'method' => 'store'],
    'galeri/edit/([0-9]+)' => ['controller' => 'GaleriController', 'method' => 'edit'],
    'galeri/update/([0-9]+)' => ['controller' => 'GaleriController', 'method' => 'update'],
    'galeri/delete/([0-9]+)' => ['controller' => 'GaleriController', 'method' => 'delete'],

    // Route untuk pengurus
    'pengurus' => ['controller' => 'PengurusController', 'method' => 'index'],
    'pengurus/index' => ['controller' => 'PengurusController', 'method' => 'index'],
    'pengurus/create' => ['controller' => 'PengurusController', 'method' => 'create'],
    'pengurus/store' => ['controller' => 'PengurusController', 'method' => 'store'],
    'pengurus/edit/([0-9]+)' => ['controller' => 'PengurusController', 'method' => 'edit'],
    'pengurus/update/([0-9]+)' => ['controller' => 'PengurusController', 'method' => 'update'],
    'pengurus/toggleStatus/([0-9]+)' => ['controller' => 'PengurusController', 'method' => 'toggleStatus'],
    'pengurus/delete/([0-9]+)' => ['controller' => 'PengurusController', 'method' => 'delete'],

    // Route untuk profile
    'profile' => ['controller' => 'ProfileController', 'method' => 'index'],
    'profile/index' => ['controller' => 'ProfileController', 'method' => 'index'],
    'profile/create' => ['controller' => 'ProfileController', 'method' => 'create'],
    'profile/store' => ['controller' => 'ProfileController', 'method' => 'store'],
    'profile/edit/([0-9]+)' => ['controller' => 'ProfileController', 'method' => 'edit'],
    'profile/update/([0-9]+)' => ['controller' => 'ProfileController', 'method' => 'update'],
    'profile/delete/([0-9]+)' => ['controller' => 'ProfileController', 'method' => 'delete'],
    'profile/uploadImage' => ['controller' => 'ProfileController', 'method' => 'uploadImage'],
    'p/([a-z0-9-]+)' => ['controller' => 'ProfileController', 'method' => 'show'],

    // Route untuk pengaduan
    'pengaduan' => ['controller' => 'PengaduanController', 'method' => 'index'],
    'pengaduan/index' => ['controller' => 'PengaduanController', 'method' => 'index'],
    'pengaduan/detail/([0-9]+)' => ['controller' => 'PengaduanController', 'method' => 'detail'],
    'pengaduan/delete/([0-9]+)' => ['controller' => 'PengaduanController', 'method' => 'delete'],
    'pengaduan/updateStatus/([0-9]+)' => ['controller' => 'PengaduanController', 'method' => 'updateStatus'],
];

return $routes;