<?php
namespace User\WebDesa\Models;

// Load kelas Database secara manual
require_once __DIR__ . '/../core/Database.php';

/**
 * Model untuk manajemen user
 */
class UserModel
{
    private $db;
    
    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
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
     * Method untuk mendapatkan semua user
     */
    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }
    
    /**
     * Method untuk menambah user baru
     */
    public function tambahUser($data)
    {
        $query = "INSERT INTO users (username, password, email, no_hp, nama_lengkap, role, is_active) VALUES (:username, :password, :email, :no_hp, :nama_lengkap, :role, :is_active)";

        $this->db->query($query);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT)); // Hash password dengan password_hash
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':is_active', $data['is_active']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    
    /**
     * Method untuk update data user
     */
    public function updateUser($data)
    {
        $query = "UPDATE users SET username=:username, email=:email, no_hp=:no_hp, nama_lengkap=:nama_lengkap, role=:role, is_active=:is_active WHERE id_user=:id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id_user']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':is_active', $data['is_active']);
        
        $this->db->execute();
        
        return $this->db->rowCount();
    }
    
    /**
     * Method untuk update password
     */
    public function updatePassword($id, $password)
    {
        $query = "UPDATE users SET password=:password WHERE id_user=:id";

        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT)); // Hash password dengan password_hash

        $this->db->execute();

        return $this->db->rowCount();
    }
    
    /**
     * Method untuk mendapatkan user berdasarkan email
     */
    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    /**
     * Method untuk hapus user
     */
    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id_user = :id";

        $this->db->query($query);
        $this->db->bind(':id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}