<?php
// Public folder - Entry point utama aplikasi

// Mulai session
session_start();

// Load composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load konfigurasi
require_once __DIR__ . '/../app/config/config.php';

// Inisialisasi aplikasi
$app = new \User\WebDesa\Core\App();