<?php
namespace User\WebDesa\Controllers;

use User\WebDesa\Core\Controller;
use User\WebDesa\Models\UserModel;
use User\WebDesa\Core\Flasher;

class AuthController extends Controller
{
    private $userModel;
    
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    
    /**
     * Method untuk menampilkan halaman login
     */
    public function login()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer');
    }
    
    /**
     * Method untuk memproses login
     */
    public function prosesLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Validasi input
        if (empty($username) || empty($password)) {
            Flasher::setMessage('error', 'Username dan password harus diisi!');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        
        // Cek login
        if ($this->userModel->cekLogin($username, $password)) {
            // Redirect berdasarkan role
            $role = $this->userModel->getUserRole();
            
            switch ($role) {
                case 'admin':
                    header('Location: ' . BASE_URL . '/dashboard/admin');
                    break;
                case 'kepala_desa':
                    header('Location: ' . BASE_URL . '/dashboard/kepaladesa');
                    break;
                case 'sekretaris':
                    header('Location: ' . BASE_URL . '/dashboard/sekretaris');
                    break;
                default:
                    Flasher::setMessage('error', 'Role tidak dikenali!');
                    header('Location: ' . BASE_URL . '/auth/login');
                    break;
            }
            exit;
        } else {
            Flasher::setMessage('error', 'Username atau password salah!');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
    
    /**
     * Method untuk logout
     */
    public function logout()
    {
        $this->userModel->logout();
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}