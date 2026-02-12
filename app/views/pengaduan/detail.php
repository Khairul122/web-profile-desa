<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/pengaduan/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Detail Pengaduan</h4>
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
                <h5 class="card-title fw-bold"><?= htmlspecialchars($data['pengaduan']['judul_laporan']) ?></h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Nama Pelapor:</strong></p>
                        <p><?= htmlspecialchars($data['pengaduan']['nama_pelapor']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>No. HP:</strong></p>
                        <p><?= htmlspecialchars($data['pengaduan']['no_hp']) ?></p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Lokasi:</strong></p>
                        <p><?= htmlspecialchars($data['pengaduan']['lokasi']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Status:</strong></p>
                        <?php 
                        $statusClass = '';
                        switch($data['pengaduan']['status']) {
                            case 'Pending': $statusClass = 'badge bg-warning text-dark'; break;
                            case 'Proses': $statusClass = 'badge bg-info'; break;
                            case 'Selesai': $statusClass = 'badge bg-success'; break;
                            case 'Tolak': $statusClass = 'badge bg-danger'; break;
                        }
                        ?>
                        <p><span class="<?= $statusClass ?>"><?= htmlspecialchars($data['pengaduan']['status']) ?></span></p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <p class="mb-1"><strong>Isi Laporan:</strong></p>
                    <p><?= nl2br(htmlspecialchars($data['pengaduan']['isi'])) ?></p>
                </div>
                
                <?php if (!empty($data['pengaduan']['catatan'])): ?>
                <div class="mb-3">
                    <p class="mb-1"><strong>Catatan/Admin:</strong></p>
                    <p><?= nl2br(htmlspecialchars($data['pengaduan']['catatan'])) ?></p>
                </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <p class="mb-1"><strong>Dibuat pada:</strong></p>
                    <p><?= ($data['formatTanggalIndonesia'])($data['pengaduan']['created_at']) ?></p>
                </div>
                
                <div class="mb-3">
                    <p class="mb-1"><strong>Diupdate pada:</strong></p>
                    <p><?= ($data['formatTanggalIndonesia'])($data['pengaduan']['updated_at']) ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5 class="card-title">Foto Bukti</h5>
                <?php if (!empty($data['pengaduan']['foto_bukti'])): ?>
                    <img src="../<?= BASE_URL_GAMBAR_PENGADUAN ?>/<?= $data['pengaduan']['foto_bukti'] ?>" 
                         alt="Foto Bukti" 
                         class="img-fluid rounded mb-3" 
                         style="max-height: 300px; object-fit: cover;"
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal" 
                         onclick="setImageSrc('<?= BASE_URL_GAMBAR_PENGADUAN ?>/<?= $data['pengaduan']['foto_bukti'] ?>')">
                <?php else: ?>
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                        <div class="text-center">
                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                            <p class="text-muted">Tidak ada foto bukti</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ubah Status</h5>
                <form method="POST" action="<?= BASE_URL ?>/pengaduan/updateStatus/<?= $data['pengaduan']['id_pengaduan'] ?>">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Baru</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" <?= $data['pengaduan']['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Proses" <?= $data['pengaduan']['status'] === 'Proses' ? 'selected' : '' ?>>Proses</option>
                            <option value="Selesai" <?= $data['pengaduan']['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            <option value="Tolak" <?= $data['pengaduan']['status'] === 'Tolak' ? 'selected' : '' ?>>Tolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan atau tanggapan..."><?= htmlspecialchars($data['pengaduan']['catatan'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Bukti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Foto Bukti" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
function setImageSrc(src) {
    document.getElementById('modalImage').src = src;
}
</script>