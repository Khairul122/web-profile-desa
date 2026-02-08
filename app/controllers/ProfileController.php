<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/ProfileModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class ProfileController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\ProfileModel();
    }

    public function index()
    {
        $data['judul'] = 'Kelola Profile';
        $data['page'] = 'profile';
        $data['profile'] = $this->model->getAll();
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('profile/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah Profile';
        $data['page'] = 'profile';
        $data['action'] = 'create';
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('profile/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug = $_POST['slug'] ?? '';
            if (empty($slug)) {
                $slug = $this->createSlug($_POST['keterangan'] ?? '');
            }

            if ($this->model->slugExists($slug)) {
                Flasher::setMessage('danger', 'Slug sudah digunakan!');
                header('Location: ' . BASE_URL . '/profile/create');
                exit;
            }

            $data = [
                'keterangan' => $_POST['keterangan'] ?? '',
                'slug' => $slug
            ];

            if ($this->model->insert($data)) {
                Flasher::setMessage('success', 'Profile berhasil ditambahkan!');
            } else {
                Flasher::setMessage('danger', 'Gagal menambahkan profile!');
            }

            header('Location: ' . BASE_URL . '/profile/index');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Profile';
        $data['page'] = 'profile';
        $data['action'] = 'edit';
        $data['profile'] = $this->model->getById($id);

        if (!$data['profile']) {
            Flasher::setMessage('danger', 'Profile tidak ditemukan!');
            header('Location: ' . BASE_URL . '/profile/index');
            exit;
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('profile/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug = $_POST['slug'] ?? '';
            if (empty($slug)) {
                $slug = $this->createSlug($_POST['keterangan'] ?? '');
            }

            if ($this->model->slugExists($slug, $id)) {
                Flasher::setMessage('danger', 'Slug sudah digunakan!');
                header('Location: ' . BASE_URL . '/profile/edit/' . $id);
                exit;
            }

            $data = [
                'id_profile' => $id,
                'keterangan' => $_POST['keterangan'] ?? '',
                'slug' => $slug
            ];

            if ($this->model->update($data)) {
                Flasher::setMessage('success', 'Profile berhasil diperbarui!');
            } else {
                Flasher::setMessage('danger', 'Gagal memperbarui profile!');
            }

            header('Location: ' . BASE_URL . '/profile/index');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Profile berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus profile!');
        }

        header('Location: ' . BASE_URL . '/profile/index');
        exit;
    }

    public function show($slug)
    {
        return $this->model->getBySlug($slug);
    }

    public function uploadImage()
    {
        if (!empty($_FILES['gambar']['name'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/profile/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = time() . '_' . basename($_FILES['gambar']['name']);
            $uploadFile = $uploadDir . $fileName;
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadFile)) {
                    echo BASE_URL . '/uploads/profile/' . $fileName;
                    exit;
                }
            }
        }
        echo '';
    }

    private function createSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        return $text;
    }
}
