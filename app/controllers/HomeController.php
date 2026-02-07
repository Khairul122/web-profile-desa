<?php
namespace User\WebDesa\Controllers;

// Load kelas Controller secara manual
require_once __DIR__ . '/../core/Controller.php';

class HomeController extends \User\WebDesa\Core\Controller
{
    public function index()
    {
        $data['judul'] = 'Beranda - Website Profil Desa';

        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }
}