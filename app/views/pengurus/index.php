<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Pengurus</h4>
    <a href="<?= BASE_URL ?>/pengurus/create" class="btn btn-primary">
        <i class="fas fa-user-plus me-2"></i>Tambah Pengurus
    </a>
</div>

<?php
require_once __DIR__ . '/../../core/Flasher.php';
use User\WebDesa\Core\Flasher;
echo Flasher::getMessage();
?>

<form method="GET" action="<?= BASE_URL ?>/pengurus/index" class="mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label fw-semibold">Filter Status</label>
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua --</option>
                <option value="aktif" <?= ($_GET['status'] ?? '') === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="nonaktif" <?= ($_GET['status'] ?? '') === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Cari</label>
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau jabatan..." value="<?= $_GET['search'] ?? '' ?>">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-5">
            <?php if (!empty($_GET['status']) || !empty($_GET['search'])): ?>
                <a href="<?= BASE_URL ?>/pengurus/index" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Reset Filter
                </a>
            <?php endif; ?>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th style="width: 80px;">Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th class="text-center" style="width: 100px;">Jenis Kelamin</th>
                        <th class="text-center" style="width: 90px;">Status</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['pengurusList'])): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-users fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Belum ada pengurus</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['pengurusList'] as $index => $item): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td>
                                    <?php if (!empty($item['foto_pengurus'])): ?>
                                        <img src="<?= BASE_URL_GAMBAR_PENGURUS ?>/<?= $item['foto_pengurus'] ?>" alt="<?= htmlspecialchars($item['nama_lengkap']) ?>" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold"><?= htmlspecialchars($item['nama_lengkap']) ?></div>
                                    <small class="text-muted"><?= date('d M Y', strtotime($item['created_at'])) ?></small>
                                </td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($item['jabatan']) ?></span></td>
                                <td class="text-center">
                                    <?php if ($item['jenis_kelamin'] === 'L'): ?>
                                        <span class="badge bg-info text-dark"><i class="fas fa-mars me-1"></i>Laki-laki</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #f8bbd0; color: #880e4f;"><i class="fas fa-venus me-1"></i>Perempuan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($item['status_aktif'] == 1): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/pengurus/edit/<?= $item['id_pengurus'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= BASE_URL ?>/pengurus/toggleStatus/<?= $item['id_pengurus'] ?>" class="btn btn-sm <?= $item['status_aktif'] == 1 ? 'btn-outline-warning' : 'btn-outline-success' ?>" title="<?= $item['status_aktif'] == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                        <i class="fas <?= $item['status_aktif'] == 1 ? 'fa-times' : 'fa-check' ?>"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete(<?= $item['id_pengurus'] ?>, '<?= htmlspecialchars($item['nama_lengkap']) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, nama) {
    if (confirm('Yakin ingin menghapus "' + nama + '"?')) {
        window.location.href = '<?= BASE_URL ?>/pengurus/delete/' + id;
    }
}
</script>
