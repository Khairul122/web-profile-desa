<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class ProfileModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM `profile` ORDER BY id_profile ASC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM `profile` WHERE id_profile = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByJudul($judul)
    {
        $this->db->query('SELECT * FROM `profile` WHERE judul = :judul');
        $this->db->bind(':judul', $judul);
        return $this->db->single();
    }

    public function insert($data)
    {
        $query = "INSERT INTO `profile` (judul, keterangan, created_at, updated_at) VALUES (:judul, :keterangan, NOW(), NOW())";

        $this->db->query($query);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':keterangan', $data['keterangan']);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function update($data)
    {
        $query = "UPDATE `profile` SET judul=:judul, keterangan=:keterangan, updated_at=NOW() WHERE id_profile=:id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id_profile']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':keterangan', $data['keterangan']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM `profile` WHERE id_profile = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function judulExists($judul, $excludeId = null)
    {
        $query = "SELECT COUNT(*) as total FROM `profile` WHERE judul = :judul";
        if ($excludeId) {
            $query .= " AND id_profile != :exclude_id";
        }
        $this->db->query($query);
        $this->db->bind(':judul', $judul);
        if ($excludeId) {
            $this->db->bind(':exclude_id', $excludeId);
        }
        $result = $this->db->single();
        return $result['total'] > 0;
    }

    public function getTotal()
    {
        $this->db->query('SELECT COUNT(*) as total FROM `profile`');
        $result = $this->db->single();
        return $result['total'];
    }
}
