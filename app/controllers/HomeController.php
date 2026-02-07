<?php
namespace User\WebDesa\Controllers;

use User\WebDesa\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['judul'] = 'Beranda';
        
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }
}