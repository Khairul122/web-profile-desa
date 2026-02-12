<?php
namespace User\WebDesa\Controllers;

// Load kelas Controller, Model, dan Flasher secara manual
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/Flasher.php';

class AuthController extends \User\WebDesa\Core\Controller
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
        $data['judul'] = 'Login - Website Profil Desa';
        $this->view('auth/login', $data);
    }
    
    /**
     * Method untuk memproses login
     */
    public function prosesLogin()
    {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        
        // Validasi input
        if (empty($username) || empty($password)) {
            echo "<script>alert('Username dan password harus diisi!'); window.location.href='" . BASE_URL . "/auth/login';</script>";
            exit;
        }
        
        // Ambil data user dari database
        $user = $this->userModel->getUserByUsername($username);

        // Cek apakah user ditemukan
        if ($user) {
            // Cek apakah akun aktif
            if ($user['is_active'] == 0) {
                echo "<script>alert('Akun Anda telah dinonaktifkan!'); window.location.href='" . BASE_URL . "/auth/login';</script>";
                exit;
            }
            
            // Verifikasi password SHA256
            if (hash('sha256', $password) === $user['password']) {
                // Simpan informasi user ke session
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

                // Redirect berdasarkan role dengan alert
                switch ($user['role']) {
                    case 'admin':
                        echo "<script>alert('Login berhasil! Selamat datang, Admin.'); window.location.href='" . BASE_URL . "/dashboard/admin';</script>";
                        break;
                    case 'kepdes':
                        echo "<script>alert('Login berhasil! Selamat datang, Kepala Desa.'); window.location.href='" . BASE_URL . "/dashboard/kepaladesa';</script>";
                        break;
                    case 'sekdes':
                        echo "<script>alert('Login berhasil! Selamat datang, Sekretaris.'); window.location.href='" . BASE_URL . "/dashboard/sekretaris';</script>";
                        break;
                    default:
                        echo "<script>alert('Role tidak dikenali!'); window.location.href='" . BASE_URL . "/auth/login';</script>";
                        break;
                }
                exit;
            } else {
                echo "<script>alert('Username atau password salah!'); window.location.href='" . BASE_URL . "/auth/login';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Username atau password salah!'); window.location.href='" . BASE_URL . "/auth/login';</script>";
            exit;
        }
    }
    
    /**
     * Method untuk logout
     */
    public function logout()
    {
        session_destroy();
        echo "<script>alert('Anda telah berhasil logout.'); window.location.href='" . BASE_URL . "/auth/login';</script>";
        exit;
    }
}