<?php
namespace User\WebDesa\Controllers;

// Load kelas Controller, Model, dan Flasher secara manual
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../core/Flasher.php';

class RegisterController extends \User\WebDesa\Core\Controller
{
    private $userModel;
    
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    
    /**
     * Method untuk menampilkan halaman register
     */
    public function index()
    {
        $data['judul'] = 'Daftar Akun - Website Profil Desa';
        $this->view('auth/register', $data);
    }
    
    /**
     * Method untuk memproses registrasi
     */
    public function prosesRegister()
    {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $no_hp = htmlspecialchars($_POST['no_hp']);
        $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validasi input
        if (empty($username) || empty($email) || empty($no_hp) || empty($nama_lengkap) || empty($password) || empty($confirm_password)) {
            echo "<script>alert('Semua field harus diisi!'); window.location.href='" . BASE_URL . "/register';</script>";
            exit;
        }
        
        // Validasi konfirmasi password
        if ($password !== $confirm_password) {
            echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href='" . BASE_URL . "/register';</script>";
            exit;
        }
        
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Format email tidak valid!'); window.location.href='" . BASE_URL . "/register';</script>";
            exit;
        }
        
        // Cek apakah username sudah digunakan
        $existingUser = $this->userModel->getUserByUsername($username);
        if ($existingUser) {
            echo "<script>alert('Username sudah digunakan!'); window.location.href='" . BASE_URL . "/register';</script>";
            exit;
        }
        
        // Cek apakah email sudah digunakan dengan menggunakan model
        $existingEmail = $this->userModel->getUserByEmail($email);
        if ($existingEmail) {
            echo "<script>alert('Email sudah digunakan!'); window.location.href='" . BASE_URL . "/register';</script>";
            exit;
        }
        
        // Data untuk disimpan
        $data = [
            'username' => $username,
            'password' => $password, // Password akan di-hash di model
            'email' => $email,
            'no_hp' => $no_hp,
            'nama_lengkap' => $nama_lengkap,
            'role' => 'user', // Default role untuk pendaftaran
            'is_active' => 0 // Nonaktif sampai diverifikasi (opsional)
        ];
        
        // Simpan ke database
        $result = $this->userModel->tambahUser($data);
        
        if ($result > 0) {
            echo "<script>alert('Registrasi berhasil! Silakan hubungi admin untuk aktivasi akun.'); window.location.href='" . BASE_URL . "/auth/login';</script>";
            exit;
        } else {
            echo "<script>alert('Registrasi gagal!'); window.location.href='" . BASE_URL . "/register';</script>";
            exit;
        }
    }
}