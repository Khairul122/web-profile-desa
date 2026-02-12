<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/SosmedModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class SosmedController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\SosmedModel();
    }

    public function index()
    {
        $data['judul'] = 'Kelola Sosial Media';
        $data['page'] = 'sosmed';

        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $data['sosmed'] = $this->model->search($search);
        } elseif ($status === 'aktif') {
            $data['sosmed'] = $this->model->getActive();
        } else {
            $data['sosmed'] = $this->model->getAll();
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('sosial-media/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah Sosial Media';
        $data['page'] = 'sosmed';
        $data['action'] = 'create';
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('sosial-media/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' => $_POST['nama'] ?? '',
                'url' => $_POST['url'] ?? '',
                'icon' => $_POST['icon'] ?? '',
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if ($this->model->insert($data)) {
                Flasher::setMessage('success', 'Sosial media berhasil ditambahkan!');
            } else {
                Flasher::setMessage('danger', 'Gagal menambahkan sosial media!');
            }

            header('Location: ' . BASE_URL . '/sosmed/index');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Sosial Media';
        $data['page'] = 'sosmed';
        $data['action'] = 'edit';
        $data['sosmed'] = $this->model->getById($id);

        if (!$data['sosmed']) {
            Flasher::setMessage('danger', 'Sosial media tidak ditemukan!');
            header('Location: ' . BASE_URL . '/sosmed/index');
            exit;
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('sosial-media/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_sosmed' => $id,
                'nama' => $_POST['nama'] ?? '',
                'url' => $_POST['url'] ?? '',
                'icon' => $_POST['icon'] ?? '',
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if ($this->model->update($data)) {
                Flasher::setMessage('success', 'Sosial media berhasil diperbarui!');
            } else {
                Flasher::setMessage('danger', 'Gagal memperbarui sosial media!');
            }

            header('Location: ' . BASE_URL . '/sosmed/index');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Sosial media berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus sosial media!');
        }

        header('Location: ' . BASE_URL . '/sosmed/index');
        exit;
    }

    public function toggleStatus($id)
    {
        $sosmed = $this->model->getById($id);
        if ($sosmed) {
            $newStatus = $sosmed['is_active'] == 1 ? 0 : 1;
            $this->model->updateStatus($id, $newStatus);
            Flasher::setMessage('success', 'Status sosial media berhasil diubah!');
        } else {
            Flasher::setMessage('danger', 'Sosial media tidak ditemukan!');
        }

        header('Location: ' . BASE_URL . '/sosmed/index');
        exit;
    }
}