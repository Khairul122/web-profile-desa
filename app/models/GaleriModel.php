<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class GaleriModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM galeri ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM galeri WHERE id_galeri = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByKategori($kategori)
    {
        $this->db->query('SELECT * FROM galeri WHERE kategori = :kategori ORDER BY created_at DESC');
        $this->db->bind(':kategori', $kategori);
        return $this->db->resultSet();
    }

    public function search($keyword)
    {
        $this->db->query('SELECT * FROM galeri WHERE judul LIKE :keyword OR deskripsi LIKE :keyword ORDER BY created_at DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO galeri (judul, deskripsi, gambar, kategori, created_at, updated_at) VALUES (:judul, :deskripsi, :gambar, :kategori, NOW(), NOW())";

        $this->db->query($query);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':deskripsi', $data['deskripsi'] ?? null);
        $this->db->bind(':gambar', $data['gambar']);
        $this->db->bind(':kategori', $data['kategori'] ?? null);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function update($data)
    {
        $query = "UPDATE galeri SET judul=:judul, deskripsi=:deskripsi, gambar=:gambar, kategori=:kategori, updated_at=NOW() WHERE id_galeri=:id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id_galeri']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':deskripsi', $data['deskripsi'] ?? null);
        $this->db->bind(':gambar', $data['gambar']);
        $this->db->bind(':kategori', $data['kategori'] ?? null);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $galeri = $this->getById($id);
        if ($galeri && !empty($galeri['gambar'])) {
            $filePath = __DIR__ . '/../../public/uploads/galeri/' . $galeri['gambar'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $query = "DELETE FROM galeri WHERE id_galeri = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getCountByKategori($kategori)
    {
        $this->db->query('SELECT COUNT(*) as total FROM galeri WHERE kategori = :kategori');
        $this->db->bind(':kategori', $kategori);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getTotal()
    {
        $this->db->query('SELECT COUNT(*) as total FROM galeri');
        $result = $this->db->single();
        return $result['total'];
    }
}
