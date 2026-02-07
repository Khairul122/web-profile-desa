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
    
    // Route untuk registrasi
    'register' => ['controller' => 'RegisterController', 'method' => 'index'],
    'register/prosesRegister' => ['controller' => 'RegisterController', 'method' => 'prosesRegister'],
    
    // Route untuk dashboard
    'dashboard/admin' => ['controller' => 'DashboardController', 'method' => 'admin'],
    'dashboard/kepaladesa' => ['controller' => 'DashboardController', 'method' => 'kepaladesa'],
    'dashboard/sekretaris' => ['controller' => 'DashboardController', 'method' => 'sekretaris'],
];

return $routes;