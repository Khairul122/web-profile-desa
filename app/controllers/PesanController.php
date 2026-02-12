<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PesanModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class PesanController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\PesanModel();
    }

    public function index()
    {
        $data['judul'] = 'Pesan Masuk';
        $data['page'] = 'pesan';

        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $data['pesan'] = $this->model->search($search);
        } elseif (!empty($status) && in_array($status, ['belum', 'sudah'])) {
            $data['pesan'] = $this->model->getByStatus($status);
        } else {
            $data['pesan'] = $this->model->getAll();
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pesan-masuk/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Pesan';
        $data['page'] = 'pesan';
        $data['pesan'] = $this->model->getById($id);

        if (!$data['pesan']) {
            Flasher::setMessage('danger', 'Pesan tidak ditemukan!');
            header('Location: ' . BASE_URL . '/pesan/index');
            exit;
        }

        // Mark as read when viewing detail
        if ($data['pesan']['status_baca'] === 'belum') {
            $this->model->markAsRead($id);
            $data['pesan']['status_baca'] = 'sudah'; // Update status in the data
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pesan-masuk/detail', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Pesan berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus pesan!');
        }

        header('Location: ' . BASE_URL . '/pesan/index');
        exit;
    }

    public function updateStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            if (in_array($status, ['belum', 'sudah'])) {
                if ($this->model->updateStatus($id, $status)) {
                    Flasher::setMessage('success', 'Status pesan berhasil diperbarui!');
                } else {
                    Flasher::setMessage('danger', 'Gagal memperbarui status pesan!');
                }
            } else {
                Flasher::setMessage('danger', 'Status tidak valid!');
            }
        }

        header('Location: ' . BASE_URL . '/pesan/index');
        exit;
    }

    public function markAsRead($id)
    {
        if ($this->model->markAsRead($id)) {
            Flasher::setMessage('success', 'Pesan berhasil ditandai sebagai sudah dibaca!');
        } else {
            Flasher::setMessage('danger', 'Gagal memperbarui status pesan!');
        }

        header('Location: ' . BASE_URL . '/pesan/index');
        exit;
    }

    public function markAsUnread($id)
    {
        if ($this->model->markAsUnread($id)) {
            Flasher::setMessage('success', 'Pesan berhasil ditandai sebagai belum dibaca!');
        } else {
            Flasher::setMessage('danger', 'Gagal memperbarui status pesan!');
        }

        header('Location: ' . BASE_URL . '/pesan/index');
        exit;
    }
}