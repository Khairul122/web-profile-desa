<?php
namespace User\WebDesa\Models;

use User\WebDesa\Core\Database;

/**
 * Model untuk manajemen user
 */
class UserModel
{
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    
    /**
     * Method untuk mendapatkan user berdasarkan username
     */
    public function getUserByUsername($username)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }
    
    /**
     * Method untuk cek login
     */
    public function cekLogin($username, $password)
    {
        $user = $this->getUserByUsername($username);
        
        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Simpan informasi user ke session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Method untuk cek apakah user sudah login
     */
    public function isLoggedin()
    {
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Method untuk mendapatkan role user yang sedang login
     */
    public function getUserRole()
    {
        return $_SESSION['role'] ?? null;
    }
    
    /**
     * Method untuk logout
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        
        session_destroy();
        return true;
    }
}