<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/GaleriModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class GaleriController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\GaleriModel();
    }

    public function index()
    {
        $data['judul'] = 'Kelola Galeri';
        $data['page'] = 'galeri';

        $kategori = $_GET['kategori'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $data['galeri'] = $this->model->search($search);
        } elseif (!empty($kategori)) {
            $data['galeri'] = $this->model->getByKategori($kategori);
        } else {
            $data['galeri'] = $this->model->getAll();
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('galeri/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah Galeri';
        $data['page'] = 'galeri';
        $data['action'] = 'create';
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('galeri/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gambar = null;

            if (!empty($_FILES['gambar']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/galeri/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['gambar']['name']);
                $uploadFile = $uploadDir . $fileName;
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadFile)) {
                        $gambar = $fileName;
                    }
                }
            }

            $data = [
                'judul' => $_POST['judul'] ?? '',
                'deskripsi' => $_POST['deskripsi'] ?? '',
                'gambar' => $gambar,
                'kategori' => $_POST['kategori'] ?? ''
            ];

            if ($this->model->insert($data)) {
                Flasher::setMessage('success', 'Galeri berhasil ditambahkan!');
            } else {
                Flasher::setMessage('danger', 'Gagal menambahkan galeri!');
            }

            header('Location: ' . BASE_URL . '/galeri/index');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Galeri';
        $data['page'] = 'galeri';
        $data['action'] = 'edit';
        $data['galeri'] = $this->model->getById($id);

        if (!$data['galeri']) {
            Flasher::setMessage('danger', 'Galeri tidak ditemukan!');
            header('Location: ' . BASE_URL . '/galeri/index');
            exit;
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('galeri/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $galeriLama = $this->model->getById($id);
            $gambar = $galeriLama['gambar'];

            if (!empty($_FILES['gambar']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/galeri/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['gambar']['name']);
                $uploadFile = $uploadDir . $fileName;
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if (!empty($galeriLama['gambar'])) {
                        $oldFile = $uploadDir . $galeriLama['gambar'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }

                    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadFile)) {
                        $gambar = $fileName;
                    }
                }
            }

            $data = [
                'id_galeri' => $id,
                'judul' => $_POST['judul'] ?? '',
                'deskripsi' => $_POST['deskripsi'] ?? '',
                'gambar' => $gambar,
                'kategori' => $_POST['kategori'] ?? ''
            ];

            if ($this->model->update($data)) {
                Flasher::setMessage('success', 'Galeri berhasil diperbarui!');
            } else {
                Flasher::setMessage('danger', 'Gagal memperbarui galeri!');
            }

            header('Location: ' . BASE_URL . '/galeri/index');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Galeri berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus galeri!');
        }

        header('Location: ' . BASE_URL . '/galeri/index');
        exit;
    }
}
