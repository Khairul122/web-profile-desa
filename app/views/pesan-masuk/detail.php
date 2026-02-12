<?php
function formatTanggalIndonesia($tanggal) {
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
}
?>

<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/pesan/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Detail Pesan</h4>
</div>

<?php
require_once __DIR__ . '/../../core/Flasher.php';
use User\WebDesa\Core\Flasher;
echo Flasher::getMessage();
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title fw-bold"><?= htmlspecialchars($data['pesan']['judul']) ?></h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Nama Pengirim:</strong></p>
                        <p><?= htmlspecialchars($data['pesan']['nama_pengirim']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p><?= htmlspecialchars($data['pesan']['no_hp']) ?></p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Status:</strong></p>
                        <?php 
                        $statusClass = $data['pesan']['status_baca'] === 'belum' ? 'badge bg-warning text-dark' : 'badge bg-success';
                        $statusText = $data['pesan']['status_baca'] === 'belum' ? 'Belum Dibaca' : 'Sudah Dibaca';
                        ?>
                        <p><span class="<?= $statusClass ?>"><?= htmlspecialchars($statusText) ?></span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>IP Address:</strong></p>
                        <p><?= htmlspecialchars($data['pesan']['ip_address']) ?></p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <p class="mb-1"><strong>Isi Pesan:</strong></p>
                    <div class="border p-3 bg-light rounded">
                        <?= nl2br(htmlspecialchars($data['pesan']['isi_pesan'])) ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <p class="mb-1"><strong>Dikirim pada:</strong></p>
                    <p><?= formatTanggalIndonesia($data['pesan']['created_at']) ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tindakan</h5>
                <div class="d-grid gap-2">
                    <?php if ($data['pesan']['status_baca'] === 'belum'): ?>
                        <a href="<?= BASE_URL ?>/pesan/markAsRead/<?= $data['pesan']['id_pesan'] ?>" class="btn btn-success">
                            <i class="fas fa-check me-2"></i>Tandai Sudah Dibaca
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/pesan/markAsUnread/<?= $data['pesan']['id_pesan'] ?>" class="btn btn-warning">
                            <i class="fas fa-envelope me-2"></i>Tandai Belum Dibaca
                        </a>
                    <?php endif; ?>
                    
                    <a href="<?= BASE_URL ?>/pesan/delete/<?= $data['pesan']['id_pesan'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                        <i class="fas fa-trash me-2"></i>Hapus Pesan
                    </a>
                    
                    <a href="<?= BASE_URL ?>/pesan/index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>