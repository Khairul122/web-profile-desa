<?php
namespace User\WebDesa\Controllers;

use User\WebDesa\Core\Controller;

class DashboardController extends Controller
{
    /**
     * Method untuk dashboard admin
     */
    public function admin()
    {
        $data['judul'] = 'Dashboard Admin';
        $data['role'] = 'Admin';
        
        $this->view('templates/header', $data);
        $this->view('dashboard/admin', $data);
        $this->view('templates/footer');
    }
    
    /**
     * Method untuk dashboard kepala desa
     */
    public function kepaladesa()
    {
        $data['judul'] = 'Dashboard Kepala Desa';
        $data['role'] = 'Kepala Desa';
        
        $this->view('templates/header', $data);
        $this->view('dashboard/kepaladesa', $data);
        $this->view('templates/footer');
    }
    
    /**
     * Method untuk dashboard sekretaris
     */
    public function sekretaris()
    {
        $data['judul'] = 'Dashboard Sekretaris';
        $data['role'] = 'Sekretaris';
        
        $this->view('templates/header', $data);
        $this->view('dashboard/sekretaris', $data);
        $this->view('templates/footer');
    }
}