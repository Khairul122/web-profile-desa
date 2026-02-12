<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class PengaduanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM pengaduan ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM pengaduan WHERE id_pengaduan = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByStatus($status)
    {
        $this->db->query('SELECT * FROM pengaduan WHERE status = :status ORDER BY created_at DESC');
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function search($keyword)
    {
        $this->db->query('SELECT * FROM pengaduan WHERE judul_laporan LIKE :keyword OR isi LIKE :keyword OR nama_pelapor LIKE :keyword ORDER BY created_at DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO pengaduan (nama_pelapor, no_hp, judul_laporan, isi, foto_bukti, lokasi, status, catatan, created_at, updated_at) VALUES (:nama_pelapor, :no_hp, :judul_laporan, :isi, :foto_bukti, :lokasi, :status, :catatan, NOW(), NOW())";

        $this->db->query($query);
        $this->db->bind(':nama_pelapor', $data['nama_pelapor']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':judul_laporan', $data['judul_laporan']);
        $this->db->bind(':isi', $data['isi']);
        $this->db->bind(':foto_bukti', $data['foto_bukti'] ?? null);
        $this->db->bind(':lokasi', $data['lokasi']);
        $this->db->bind(':status', $data['status'] ?? 'Pending');
        $this->db->bind(':catatan', $data['catatan'] ?? null);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function update($data)
    {
        $query = "UPDATE pengaduan SET nama_pelapor=:nama_pelapor, no_hp=:no_hp, judul_laporan=:judul_laporan, isi=:isi, foto_bukti=:foto_bukti, lokasi=:lokasi, status=:status, catatan=:catatan, updated_at=NOW() WHERE id_pengaduan=:id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id_pengaduan']);
        $this->db->bind(':nama_pelapor', $data['nama_pelapor']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':judul_laporan', $data['judul_laporan']);
        $this->db->bind(':isi', $data['isi']);
        $this->db->bind(':foto_bukti', $data['foto_bukti'] ?? null);
        $this->db->bind(':lokasi', $data['lokasi']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':catatan', $data['catatan'] ?? null);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $pengaduan = $this->getById($id);
        if ($pengaduan && !empty($pengaduan['foto_bukti'])) {
            $filePath = __DIR__ . '/../../public/uploads/pengaduan/' . $pengaduan['foto_bukti'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $query = "DELETE FROM pengaduan WHERE id_pengaduan = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateStatus($id, $status, $catatan = null)
    {
        if ($catatan !== null) {
            $query = "UPDATE pengaduan SET status=:status, catatan=:catatan, updated_at=NOW() WHERE id_pengaduan=:id";
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->bind(':status', $status);
            $this->db->bind(':catatan', $catatan);
        } else {
            $query = "UPDATE pengaduan SET status=:status, updated_at=NOW() WHERE id_pengaduan=:id";
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->bind(':status', $status);
        }
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getCountByStatus($status)
    {
        $this->db->query('SELECT COUNT(*) as total FROM pengaduan WHERE status = :status');
        $this->db->bind(':status', $status);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getTotal()
    {
        $this->db->query('SELECT COUNT(*) as total FROM pengaduan');
        $result = $this->db->single();
        return $result['total'];
    }
}