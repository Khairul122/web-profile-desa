<?php
namespace User\WebDesa\Controllers;

// Load kelas Controller secara manual
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends \User\WebDesa\Core\Controller
{
    /**
     * Method untuk dashboard admin
     */
    public function admin()
    {
        $data['judul'] = 'Dashboard Admin';
        $this->view('dashboard/admin', $data);
    }
    
    /**
     * Method untuk dashboard kepala desa
     */
    public function kepaladesa()
    {
        $data['judul'] = 'Dashboard Kepala Desa';
        $this->view('dashboard/kepaladesa', $data);
    }
    
    /**
     * Method untuk dashboard sekretaris
     */
    public function sekretaris()
    {
        $data['judul'] = 'Dashboard Sekretaris';
        $this->view('dashboard/sekretaris', $data);
    }
}