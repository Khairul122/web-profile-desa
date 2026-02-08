<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/BeritaModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class BeritaController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\BeritaModel();
    }

    public function index()
    {
        $data['judul'] = 'Kelola Berita';
        $data['page'] = 'berita';

        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $data['berita'] = $this->model->search($search);
        } elseif (!empty($status) && in_array($status, ['draft', 'publish'])) {
            $data['berita'] = $this->model->getByStatus($status);
        } else {
            $data['berita'] = $this->model->getAll();
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('berita/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah Berita';
        $data['page'] = 'berita';
        $data['action'] = 'create';
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('berita/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gambar = null;

            if (!empty($_FILES['gambar_berita']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/berita/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['gambar_berita']['name']);
                $uploadFile = $uploadDir . $fileName;
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['gambar_berita']['tmp_name'], $uploadFile)) {
                        $gambar = $fileName;
                    }
                }
            }

            $data = [
                'judul' => $_POST['judul'] ?? '',
                'konten' => $_POST['konten'] ?? '',
                'gambar_berita' => $gambar,
                'penulis_id' => $_SESSION['id_user'] ?? 1,
                'kategori' => $_POST['kategori'] ?? '',
                'status' => $_POST['status'] ?? 'draft',
                'keyword' => $_POST['keyword'] ?? ''
            ];

            if ($this->model->insert($data)) {
                Flasher::setMessage('success', 'Berita berhasil ditambahkan!');
            } else {
                Flasher::setMessage('danger', 'Gagal menambahkan berita!');
            }

            header('Location: ' . BASE_URL . '/berita/index');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Berita';
        $data['page'] = 'berita';
        $data['action'] = 'edit';
        $data['berita'] = $this->model->getById($id);

        if (!$data['berita']) {
            Flasher::setMessage('danger', 'Berita tidak ditemukan!');
            header('Location: ' . BASE_URL . '/berita/index');
            exit;
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('berita/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beritaLama = $this->model->getById($id);
            $gambar = $beritaLama['gambar_berita'];

            if (!empty($_FILES['gambar_berita']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/berita/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['gambar_berita']['name']);
                $uploadFile = $uploadDir . $fileName;
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if (!empty($beritaLama['gambar_berita'])) {
                        $oldFile = $uploadDir . $beritaLama['gambar_berita'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }

                    if (move_uploaded_file($_FILES['gambar_berita']['tmp_name'], $uploadFile)) {
                        $gambar = $fileName;
                    }
                }
            }

            $data = [
                'id_berita' => $id,
                'judul' => $_POST['judul'] ?? '',
                'konten' => $_POST['konten'] ?? '',
                'gambar_berita' => $gambar,
                'kategori' => $_POST['kategori'] ?? '',
                'status' => $_POST['status'] ?? 'draft',
                'keyword' => $_POST['keyword'] ?? ''
            ];

            if ($this->model->update($data)) {
                Flasher::setMessage('success', 'Berita berhasil diperbarui!');
            } else {
                Flasher::setMessage('danger', 'Gagal memperbarui berita!');
            }

            header('Location: ' . BASE_URL . '/berita/index');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Berita berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus berita!');
        }

        header('Location: ' . BASE_URL . '/berita/index');
        exit;
    }

    public function show($id)
    {
        $data['berita'] = $this->model->getById($id);
        if ($data['berita']) {
            $this->model->updateViews($id);
        }
        return $data['berita'];
    }
}
