<?php
namespace User\WebDesa\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PengaduanModel.php';
require_once __DIR__ . '/../core/Flasher.php';

use User\WebDesa\Core\Flasher;

class PengaduanController extends \User\WebDesa\Core\Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new \User\WebDesa\Models\PengaduanModel();
    }

    public function index()
    {
        $data['judul'] = 'Kelola Pengaduan';
        $data['page'] = 'pengaduan';

        $status = $_GET['status'] ?? '';
        $search = $_GET['search'] ?? '';

        if (!empty($search)) {
            $data['pengaduan'] = $this->model->search($search);
        } elseif (!empty($status) && in_array($status, ['Pending', 'Proses', 'Selesai', 'Tolak'])) {
            $data['pengaduan'] = $this->model->getByStatus($status);
        } else {
            $data['pengaduan'] = $this->model->getAll();
        }

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pengaduan/index', $data);
        $this->view('templates/dashboard_admin_footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Pengaduan';
        $data['page'] = 'pengaduan';
        $data['pengaduan'] = $this->model->getById($id);

        if (!$data['pengaduan']) {
            \User\WebDesa\Core\Flasher::setMessage('danger', 'Pengaduan tidak ditemukan!');
            header('Location: ' . BASE_URL . '/pengaduan/index');
            exit;
        }

        // Format tanggal Indonesia
        $data['formatTanggalIndonesia'] = function($tanggal) {
            $bulan = [
                'January' => 'Januari',
                'February' => 'Februari',
                'March' => 'Maret',
                'April' => 'April',
                'May' => 'Mei',
                'June' => 'Juni',
                'July' => 'Juli',
                'August' => 'Agustus',
                'September' => 'September',
                'October' => 'Oktober',
                'November' => 'November',
                'December' => 'Desember'
            ];
            
            $timestamp = strtotime($tanggal);
            $hari = date('j', $timestamp);
            $namaBulan = $bulan[date('F', $timestamp)];
            $tahun = date('Y', $timestamp);
            $jam = date('H:i', $timestamp); // Format 24-hour with colon
            
            return "$hari $namaBulan $tahun Pukul $jam";
        };

        $this->view('templates/dashboard_admin_layout', $data);
        $this->view('pengaduan/detail', $data);
        $this->view('templates/dashboard_admin_footer');
    }


    public function delete($id)
    {
        if ($this->model->delete($id)) {
            Flasher::setMessage('success', 'Pengaduan berhasil dihapus!');
        } else {
            Flasher::setMessage('danger', 'Gagal menghapus pengaduan!');
        }

        header('Location: ' . BASE_URL . '/pengaduan/index');
        exit;
    }

    public function updateStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            $catatan = $_POST['catatan'] ?? null;
            if (in_array($status, ['Pending', 'Proses', 'Selesai', 'Tolak'])) {
                if ($this->model->updateStatus($id, $status, $catatan)) {
                    Flasher::setMessage('success', 'Status pengaduan berhasil diperbarui!');
                } else {
                    Flasher::setMessage('danger', 'Gagal memperbarui status pengaduan!');
                }
            } else {
                Flasher::setMessage('danger', 'Status tidak valid!');
            }
        }

        header('Location: ' . BASE_URL . '/pengaduan/index');
        exit;
    }
}