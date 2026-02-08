<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PengurusModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class PengurusController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\PengurusModel();
    }

    public function index()
    {
        $data['judul'] = 'Kelola Pengurus';
        $data['page'] = 'pengurus';

        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $pengurusList = $this->model->search($search);
        } elseif ($status === 'aktif') {
            $pengurusList = $this->model->getActive();
        } elseif ($status === 'nonaktif') {
            $pengurusList = $this->model->getByStatus(0);
        } else {
            $pengurusList = $this->model->getAll();
        }

        $data['pengurusList'] = $pengurusList;
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pengurus/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah Pengurus';
        $data['page'] = 'pengurus';
        $data['action'] = 'create';
        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pengurus/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $foto = null;

            if (!empty($_FILES['foto_pengurus']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/pengurus/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['foto_pengurus']['name']);
                $uploadFile = $uploadDir . $fileName;
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['foto_pengurus']['tmp_name'], $uploadFile)) {
                        $foto = $fileName;
                    }
                }
            }

            $data = [
                'nama_lengkap' => $_POST['nama_lengkap'] ?? '',
                'jabatan' => $_POST['jabatan'] ?? '',
                'jenis_kelamin' => $_POST['jenis_kelamin'] ?? 'L',
                'foto_pengurus' => $foto,
                'status_aktif' => $_POST['status_aktif'] ?? 1
            ];

            if ($this->model->insert($data)) {
                Flasher::setMessage('success', 'Pengurus berhasil ditambahkan!');
            } else {
                Flasher::setMessage('danger', 'Gagal menambahkan pengurus!');
            }

            header('Location: ' . BASE_URL . '/pengurus/index');
            exit;
        }
    }

    public function edit($id)
    {
        $data['judul'] = 'Edit Pengurus';
        $data['page'] = 'pengurus';
        $data['action'] = 'edit';
        $data['pengurus'] = $this->model->getById($id);

        if (!$data['pengurus']) {
            Flasher::setMessage('danger', 'Pengurus tidak ditemukan!');
            header('Location: ' . BASE_URL . '/pengurus/index');
            exit;
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pengurus/form', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pengurusLama = $this->model->getById($id);
            $foto = $pengurusLama['foto_pengurus'];

            if (!empty($_FILES['foto_pengurus']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/pengurus/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = time() . '_' . basename($_FILES['foto_pengurus']['name']);
                $uploadFile = $uploadDir . $fileName;
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if (!empty($pengurusLama['foto_pengurus'])) {
                        $oldFile = $uploadDir . $pengurusLama['foto_pengurus'];
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }

                    if (move_uploaded_file($_FILES['foto_pengurus']['tmp_name'], $uploadFile)) {
                        $foto = $fileName;
                    }
                }
            }

            $data = [
                'id_pengurus' => $id,
                'nama_lengkap' => $_POST['nama_lengkap'] ?? '',
                'jabatan' => $_POST['jabatan'] ?? '',
                'jenis_kelamin' => $_POST['jenis_kelamin'] ?? 'L',
                'foto_pengurus' => $foto,
                'status_aktif' => $_POST['status_aktif'] ?? 1
            ];

            if ($this->model->update($data)) {
                Flasher::setMessage('success', 'Pengurus berhasil diperbarui!');
            } else {
                Flasher::setMessage('danger', 'Gagal memperbarui pengurus!');
            }

            header('Location: ' . BASE_URL . '/pengurus/index');
            exit;
        }
    }

    public function toggleStatus($id)
    {
        $pengurus = $this->model->getById($id);
        if ($pengurus) {
            $newStatus = $pengurus['status_aktif'] == 1 ? 0 : 1;
            $this->model->updateStatus($id, $newStatus);
            Flasher::setMessage('success', 'Status pengurus berhasil diubah!');
        } else {
            Flasher::setMessage('danger', 'Pengurus tidak ditemukan!');
        }

        header('Location: ' . BASE_URL . '/pengurus/index');
        exit;
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Pengurus berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus pengurus!');
        }

        header('Location: ' . BASE_URL . '/pengurus/index');
        exit;
    }
}
