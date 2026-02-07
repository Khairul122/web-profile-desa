<?php
// File konfigurasi database

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Sesuaikan dengan username database Anda
define('DB_PASS', '');      // Sesuaikan dengan password database Anda
define('DB_NAME', 'db_desa'); // Sesuaikan dengan nama database Anda

// Konfigurasi aplikasi
define('BASE_URL', 'http://localhost/web-desa');

// Konfigurasi folder
define('BASE_PATH', dirname(dirname(__DIR__)));

// Konfigurasi session
session_start();