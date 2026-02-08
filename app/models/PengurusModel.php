<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class PengurusModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM pengurus ORDER BY id_pengurus ASC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM pengurus WHERE id_pengurus = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getActive()
    {
        $this->db->query('SELECT * FROM pengurus WHERE status_aktif = 1 ORDER BY id_pengurus ASC');
        return $this->db->resultSet();
    }

    public function getByStatus($status)
    {
        $this->db->query('SELECT * FROM pengurus WHERE status_aktif = :status ORDER BY id_pengurus ASC');
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function getByJabatan($jabatan)
    {
        $this->db->query('SELECT * FROM pengurus WHERE jabatan = :jabatan ORDER BY id_pengurus ASC');
        $this->db->bind(':jabatan', $jabatan);
        return $this->db->resultSet();
    }

    public function search($keyword)
    {
        $this->db->query('SELECT * FROM pengurus WHERE nama_lengkap LIKE :keyword OR jabatan LIKE :keyword ORDER BY id_pengurus ASC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO pengurus (nama_lengkap, jabatan, jenis_kelamin, foto_pengurus, status_aktif, created_at, updated_at) VALUES (:nama_lengkap, :jabatan, :jenis_kelamin, :foto_pengurus, :status_aktif, NOW(), NOW())";

        $this->db->query($query);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':jabatan', $data['jabatan']);
        $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind(':foto_pengurus', $data['foto_pengurus'] ?? null);
        $this->db->bind(':status_aktif', $data['status_aktif'] ?? 1);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function update($data)
    {
        $query = "UPDATE pengurus SET nama_lengkap=:nama_lengkap, jabatan=:jabatan, jenis_kelamin=:jenis_kelamin, foto_pengurus=:foto_pengurus, status_aktif=:status_aktif, updated_at=NOW() WHERE id_pengurus=:id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id_pengurus']);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':jabatan', $data['jabatan']);
        $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind(':foto_pengurus', $data['foto_pengurus'] ?? null);
        $this->db->bind(':status_aktif', $data['status_aktif'] ?? 1);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateStatus($id, $status)
    {
        $query = "UPDATE pengurus SET status_aktif=:status_aktif, updated_at=NOW() WHERE id_pengurus=:id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':status_aktif', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $pengurus = $this->getById($id);
        if ($pengurus && !empty($pengurus['foto_pengurus'])) {
            $filePath = __DIR__ . '/../../public/uploads/pengurus/' . $pengurus['foto_pengurus'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $query = "DELETE FROM pengurus WHERE id_pengurus = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getCountActive()
    {
        $this->db->query('SELECT COUNT(*) as total FROM pengurus WHERE status_aktif = 1');
        $result = $this->db->single();
        return $result['total'];
    }

    public function getTotal()
    {
        $this->db->query('SELECT COUNT(*) as total FROM pengurus');
        $result = $this->db->single();
        return $result['total'];
    }
}
