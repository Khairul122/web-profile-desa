<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class SosmedModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM sosial_media ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getActive()
    {
        $this->db->query('SELECT * FROM sosial_media WHERE is_active = 1 ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM sosial_media WHERE id_sosmed = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function search($keyword)
    {
        $this->db->query('SELECT * FROM sosial_media WHERE nama LIKE :keyword OR url LIKE :keyword ORDER BY created_at DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO sosial_media (nama, url, icon, is_active, created_at, updated_at) VALUES (:nama, :url, :icon, :is_active, NOW(), NOW())";

        $this->db->query($query);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':url', $data['url']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':is_active', $data['is_active']);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function update($data)
    {
        $query = "UPDATE sosial_media SET nama=:nama, url=:url, icon=:icon, is_active=:is_active, updated_at=NOW() WHERE id_sosmed=:id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id_sosmed']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':url', $data['url']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':is_active', $data['is_active']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM sosial_media WHERE id_sosmed = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateStatus($id, $status)
    {
        $query = "UPDATE sosial_media SET is_active=:is_active, updated_at=NOW() WHERE id_sosmed=:id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':is_active', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function toggleStatus($id)
    {
        $current = $this->getById($id);
        $newStatus = $current['is_active'] == 1 ? 0 : 1;
        return $this->updateStatus($id, $newStatus);
    }

    public function getTotal()
    {
        $this->db->query('SELECT COUNT(*) as total FROM sosial_media');
        $result = $this->db->single();
        return $result['total'];
    }

    public function getTotalActive()
    {
        $this->db->query('SELECT COUNT(*) as total FROM sosial_media WHERE is_active = 1');
        $result = $this->db->single();
        return $result['total'];
    }
}