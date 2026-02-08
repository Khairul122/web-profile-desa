<?php
namespace User\WebDesa\Models;

require_once __DIR__ . '/../core/Database.php';

class BeritaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \User\WebDesa\Core\Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT b.*, u.nama_lengkap as penulis FROM berita b LEFT JOIN users u ON b.penulis_id = u.id_user ORDER BY b.created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT b.*, u.nama_lengkap as penulis FROM berita b LEFT JOIN users u ON b.penulis_id = u.id_user WHERE b.id_berita = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getPublished()
    {
        $this->db->query('SELECT b.*, u.nama_lengkap as penulis FROM berita b LEFT JOIN users u ON b.penulis_id = u.id_user WHERE b.status = :status ORDER BY b.created_at DESC');
        $this->db->bind(':status', 'publish');
        return $this->db->resultSet();
    }

    public function getByStatus($status)
    {
        $this->db->query('SELECT b.*, u.nama_lengkap as penulis FROM berita b LEFT JOIN users u ON b.penulis_id = u.id_user WHERE b.status = :status ORDER BY b.created_at DESC');
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function getByKategori($kategori)
    {
        $this->db->query('SELECT b.*, u.nama_lengkap as penulis FROM berita b LEFT JOIN users u ON b.penulis_id = u.id_user WHERE b.kategori = :kategori ORDER BY b.created_at DESC');
        $this->db->bind(':kategori', $kategori);
        return $this->db->resultSet();
    }

    public function search($keyword)
    {
        $this->db->query('SELECT b.*, u.nama_lengkap as penulis FROM berita b LEFT JOIN users u ON b.penulis_id = u.id_user WHERE b.judul LIKE :keyword OR b.konten LIKE :keyword OR b.keyword LIKE :keyword ORDER BY b.created_at DESC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $slug = $this->createSlug($data['judul']);
        $query = "INSERT INTO berita (judul, slug, konten, gambar_berita, penulis_id, kategori, status, keyword, views, created_at, updated_at) VALUES (:judul, :slug, :konten, :gambar_berita, :penulis_id, :kategori, :status, :keyword, 0, NOW(), NOW())";

        $this->db->query($query);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':konten', $data['konten']);
        $this->db->bind(':gambar_berita', $data['gambar_berita'] ?? null);
        $this->db->bind(':penulis_id', $data['penulis_id']);
        $this->db->bind(':kategori', $data['kategori']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':keyword', $data['keyword']);

        $this->db->execute();
        return $this->db->insertId();
    }

    public function update($data)
    {
        $slug = $this->createSlug($data['judul']);
        $query = "UPDATE berita SET judul=:judul, slug=:slug, konten=:konten, gambar_berita=:gambar_berita, kategori=:kategori, status=:status, keyword=:keyword, updated_at=NOW() WHERE id_berita=:id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id_berita']);
        $this->db->bind(':judul', $data['judul']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':konten', $data['konten']);
        $this->db->bind(':gambar_berita', $data['gambar_berita'] ?? null);
        $this->db->bind(':kategori', $data['kategori']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':keyword', $data['keyword']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    private function createSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        return $text;
    }

    public function updateViews($id)
    {
        $query = "UPDATE berita SET views = views + 1 WHERE id_berita = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function delete($id)
    {
        $berita = $this->getById($id);
        if ($berita && !empty($berita['gambar_berita'])) {
            $filePath = __DIR__ . '/../../public/uploads/berita/' . $berita['gambar_berita'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $query = "DELETE FROM berita WHERE id_berita = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getCountByStatus($status)
    {
        $this->db->query('SELECT COUNT(*) as total FROM berita WHERE status = :status');
        $this->db->bind(':status', $status);
        $result = $this->db->single();
        return $result['total'];
    }

    public function getTotalViews()
    {
        $this->db->query('SELECT SUM(views) as total FROM berita');
        $result = $this->db->single();
        return $result['total'] ?? 0;
    }
}
