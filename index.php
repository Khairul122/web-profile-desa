<?php
// Main entry point for the web desa application

// Define the base path
define('BASEPATH', __DIR__);

// Load the autoloader
require_once 'vendor/autoload.php';

// Initialize the application
$app = new \User\WebDesa\Core\App();
$app->run();