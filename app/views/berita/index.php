<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Berita</h4>
    <a href="<?= BASE_URL ?>/berita/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Berita
    </a>
</div>

<?php
require_once __DIR__ . '/../../core/Flasher.php';
use User\WebDesa\Core\Flasher;
echo Flasher::getMessage();
?>

<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex gap-2" style="overflow-x: auto; white-space: nowrap; padding-bottom: 5px;">
                    <a class="btn btn-sm <?= (!isset($_GET['status']) || $_GET['status'] == '') ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/berita/index">Semua</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'publish' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/berita/index?status=publish">Publish</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'draft' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/berita/index?status=draft">Draft</a>
                </div>
            </div>
            <div class="col-md-4">
                <form class="d-flex" method="GET" action="<?= BASE_URL ?>/berita/index">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari berita..." value="<?= $_GET['search'] ?? '' ?>">
                    <input type="hidden" name="status" value="<?= $_GET['status'] ?? '' ?>">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php if (!empty($_GET['status']) || !empty($_GET['search'])): ?>
        <div class="px-3 pt-3">
            <div class="d-flex gap-2 flex-wrap">
                <?php if (!empty($_GET['status'])): ?>
                    <a href="<?= BASE_URL ?>/berita/index<?= !empty($_GET['search']) ? '?search=' . $_GET['search'] : '' ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> <?= htmlspecialchars($_GET['status']) ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($_GET['search'])): ?>
                    <a href="<?= BASE_URL ?>/berita/index<?= !empty($_GET['status']) ? '?status=' . $_GET['status'] : '' ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> <?= htmlspecialchars($_GET['search']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 60px;">No</th>
                        <th style="width: 150px;">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 80px;">Views</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['berita'])): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-newspaper fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Belum ada berita</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['berita'] as $index => $berita): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td>
                                    <?php if (!empty($berita['gambar_berita'])): ?>
                                        <img src="<?= BASE_URL_GAMBAR_BERITA ?>/<?= $berita['gambar_berita'] ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-truncate" style="max-width: 250px;"><?= htmlspecialchars($berita['judul']) ?></div>
                                    <small class="text-muted"><?= date('d M Y', strtotime($berita['created_at'])) ?></small>
                                </td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($berita['kategori']) ?></span></td>
                                <td><?= htmlspecialchars($berita['penulis'] ?? 'Unknown') ?></td>
                                <td class="text-center">
                                    <?php if ($berita['status'] === 'publish'): ?>
                                        <span class="badge bg-success">Publish</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><span class="badge bg-light text-dark"><?= $berita['views'] ?></span></td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/berita/edit/<?= $berita['id_berita'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete(<?= $berita['id_berita'] ?>, '<?= htmlspecialchars($berita['judul']) ?>')">
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
function confirmDelete(id, judul) {
    if (confirm('Yakin ingin menghapus berita "' + judul + '"?')) {
        window.location.href = '<?= BASE_URL ?>/berita/delete/' + id;
    }
}
</script>
