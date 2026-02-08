<?php
// File konfigurasi database

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_desa');

// Konfigurasi aplikasi
define('BASE_URL', 'http://localhost/web-desa');
define('BASE_URL_GAMBAR_BERITA', '../public/uploads/berita');
define('BASE_URL_GAMBAR_GALERI', '../public/uploads/galeri');
define('BASE_URL_GAMBAR_PENGURUS', '../public/uploads/pengurus');
define('BASE_URL_GAMBAR_PROFILE', '../public/uploads/profile');
// Konfigurasi folder
define('BASE_PATH', dirname(dirname(__DIR__)));

// Konfigurasi session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}