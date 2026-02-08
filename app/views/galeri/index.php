<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Galeri</h4>
    <a href="<?= BASE_URL ?>/galeri/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Galeri
    </a>
</div>

<?php
require_once __DIR__ . '/../../core/Flasher.php';
use User\WebDesa\Core\Flasher;
echo Flasher::getMessage();
?>

<form method="GET" action="<?= BASE_URL ?>/galeri/index" class="mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Filter Kategori</label>
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                <option value="Pembangunan" <?= ($_GET['kategori'] ?? '') === 'Pembangunan' ? 'selected' : '' ?>>Pembangunan</option>
                <option value="Pemerintah" <?= ($_GET['kategori'] ?? '') === 'Pemerintah' ? 'selected' : '' ?>>Pemerintah</option>
                <option value="Sosial" <?= ($_GET['kategori'] ?? '') === 'Sosial' ? 'selected' : '' ?>>Sosial</option>
                <option value="Budaya" <?= ($_GET['kategori'] ?? '') === 'Budaya' ? 'selected' : '' ?>>Budaya</option>
                <option value="Ekonomi" <?= ($_GET['kategori'] ?? '') === 'Ekonomi' ? 'selected' : '' ?>>Ekonomi</option>
                <option value="Pemuda" <?= ($_GET['kategori'] ?? '') === 'Pemuda' ? 'selected' : '' ?>>Pemuda</option>
                <option value="Keagamaan" <?= ($_GET['kategori'] ?? '') === 'Keagamaan' ? 'selected' : '' ?>>Keagamaan</option>
                <option value="Pertanian" <?= ($_GET['kategori'] ?? '') === 'Pertanian' ? 'selected' : '' ?>>Pertanian</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Cari</label>
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari galeri..." value="<?= $_GET['search'] ?? '' ?>">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-4">
            <?php if (!empty($_GET['kategori']) || !empty($_GET['search'])): ?>
                <a href="<?= BASE_URL ?>/galeri/index" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Reset Filter
                </a>
            <?php endif; ?>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body">
        <?php if (empty($data['galeri'])): ?>
            <div class="text-center py-5 text-muted">
                <i class="fas fa-images fa-3x mb-3 text-secondary"></i>
                <p class="mb-0"><?= (!empty($_GET['kategori']) || !empty($_GET['search'])) ? 'Galeri tidak ditemukan' : 'Belum ada galeri' ?></p>
            </div>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($data['galeri'] as $galeri): ?>
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="card h-100 border-0 shadow-sm cursor-pointer" onclick="showGaleriModal(<?= $galeri['id_galeri'] ?>, '<?= htmlspecialchars(addslashes($galeri['judul'])) ?>', '<?= htmlspecialchars(addslashes($galeri['deskripsi'] ?? '')) ?>', '<?= htmlspecialchars($galeri['kategori'] ?? '-') ?>', '<?= !empty($galeri['gambar']) ? BASE_URL_GAMBAR_GALERI . '/' . $galeri['gambar'] : '' ?>')">
                            <div class="position-relative">
                                <?php if (!empty($galeri['gambar'])): ?>
                                    <img src="<?= BASE_URL_GAMBAR_GALERI ?>/<?= $galeri['gambar'] ?>" alt="<?= htmlspecialchars($galeri['judul']) ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                        <i class="fas fa-image text-muted fa-2x"></i>
                                    </div>
                                <?php endif; ?>
                                <span class="position-absolute top-0 end-0 badge bg-dark m-2"><?= htmlspecialchars($galeri['kategori'] ?? '-') ?></span>
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title mb-1 text-truncate" title="<?= htmlspecialchars($galeri['judul']) ?>"><?= htmlspecialchars($galeri['judul']) ?></h6>
                                <small class="text-muted"><?= date('d M Y', strtotime($galeri['created_at'])) ?></small>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 p-2">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= BASE_URL ?>/galeri/edit/<?= $galeri['id_galeri'] ?>" class="btn btn-sm btn-outline-primary" title="Edit" onclick="event.stopPropagation();">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="event.stopPropagation(); confirmDelete(<?= $galeri['id_galeri'] ?>, '<?= htmlspecialchars($galeri['judul']) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="galeriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalTitle">Detail Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalImage" src="" alt="Gambar" class="img-fluid rounded w-100" style="max-height: 400px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <h4 id="modalJudul" class="fw-bold mb-3"></h4>
                        <p class="mb-2">
                            <span class="badge bg-primary" id="modalKategori"></span>
                        </p>
                        <p class="text-muted" id="modalDeskripsi"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function showGaleriModal(id, judul, deskripsi, kategori, gambar) {
    document.getElementById('modalTitle').textContent = 'Detail Galeri';
    document.getElementById('modalJudul').textContent = judul;
    document.getElementById('modalKategori').textContent = kategori;
    document.getElementById('modalDeskripsi').textContent = deskripsi || 'Tidak ada deskripsi';
    
    if (gambar) {
        document.getElementById('modalImage').src = gambar;
        document.getElementById('modalImage').style.display = 'block';
    } else {
        document.getElementById('modalImage').style.display = 'none';
    }
    
    var modal = new bootstrap.Modal(document.getElementById('galeriModal'));
    modal.show();
}

function confirmDelete(id, judul) {
    if (confirm('Yakin ingin menghapus galeri "' + judul + '"?')) {
        window.location.href = '<?= BASE_URL ?>/galeri/delete/' + id;
    }
}
</script>

<style>
.cursor-pointer {
    cursor: pointer;
}
</style>
