<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class PesanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM pesan_masuk ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM pesan_masuk WHERE id_pesan = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByStatus($status)
    {
        $this->db->query('SELECT * FROM pesan_masuk WHERE status_baca = :status ORDER BY created_at DESC');
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function search($keyword)
    {
        $this->db->query('SELECT * FROM pesan_masuk WHERE judul LIKE :keyword OR isi_pesan LIKE :keyword OR nama_pengirim LIKE :keyword ORDER BY created_at DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO pesan_masuk (nama_pengirim, no_hp, judul, isi_pesan, status_baca, ip_address, created_at) VALUES (:nama_pengirim, :no_hp, :judul, :isi_pesan, :status_baca, :ip_address, NOW())";

        $this->db->query($query);
        $this->db->bind(':nama_pengirim', $data['nama_pengirim']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':isi_pesan', $data['isi_pesan']);
        $this->db->bind(':status_baca', $data['status_baca'] ?? 'belum');
        $this->db->bind(':ip_address', $data['ip_address']);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function updateStatus($id, $status)
    {
        $query = "UPDATE pesan_masuk SET status_baca=:status_baca WHERE id_pesan=:id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':status_baca', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM pesan_masuk WHERE id_pesan = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function markAsRead($id)
    {
        return $this->updateStatus($id, 'sudah');
    }

    public function markAsUnread($id)
    {
        return $this->updateStatus($id, 'belum');
    }

    public function getCountByStatus($status)
    {
        $this->db->query('SELECT COUNT(*) as total FROM pesan_masuk WHERE status_baca = :status');
        $this->db->bind(':status', $status);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getTotal()
    {
        $this->db->query('SELECT COUNT(*) as total FROM pesan_masuk');
        $result = $this->db->single();
        return $result['total'];
    }
}