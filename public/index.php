<?php
// Public folder - Entry point utama aplikasi

// Mulai session
session_start();

// Load konfigurasi
require_once __DIR__ . '/../app/config/config.php';

// Load kelas App secara manual
require_once __DIR__ . '/../app/core/App.php';

// Inisialisasi aplikasi
$app = new \User\WebDesa\Core\App();