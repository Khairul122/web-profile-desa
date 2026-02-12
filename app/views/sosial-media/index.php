<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Sosial Media</h4>
    <a href="<?= BASE_URL ?>/sosmed/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Sosial Media
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
                    <a class="btn btn-sm <?= (!isset($_GET['status']) || $_GET['status'] == '') ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/sosmed/index">Semua</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'aktif' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/sosmed/index?status=aktif">Aktif</a>
                </div>
            </div>
            <div class="col-md-4">
                <form class="d-flex" method="GET" action="<?= BASE_URL ?>/sosmed/index">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari sosial media..." value="<?= $_GET['search'] ?? '' ?>">
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
                    <a href="<?= BASE_URL ?>/sosmed/index<?= !empty($_GET['search']) ? '?search=' . $_GET['search'] : '' ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> <?= htmlspecialchars($_GET['status'] == 'aktif' ? 'Aktif' : 'Semua') ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($_GET['search'])): ?>
                    <a href="<?= BASE_URL ?>/sosmed/index<?= !empty($_GET['status']) ? '?status=' . $_GET['status'] : '' ?>" class="btn btn-sm btn-outline-secondary">
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
                        <th>Nama</th>
                        <th>URL</th>
                        <th class="text-center">Icon</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['sosmed'])): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-share-alt fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Belum ada sosial media</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['sosmed'] as $index => $item): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= htmlspecialchars($item['nama']) ?></div>
                                    <small class="text-muted"><?= date('d M Y', strtotime($item['created_at'])) ?></small>
                                </td>
                                <td>
                                    <a href="<?= htmlspecialchars($item['url']) ?>" target="_blank" class="text-decoration-none">
                                        <?= htmlspecialchars($item['url']) ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($item['icon'])): ?>
                                        <i class="<?= htmlspecialchars($item['icon']) ?>" style="font-size: 1.5rem;"></i>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    $statusClass = $item['is_active'] == 1 ? 'bg-success' : 'bg-secondary';
                                    $statusText = $item['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif';
                                    ?>
                                    <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($statusText) ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/sosmed/edit/<?= $item['id_sosmed'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= BASE_URL ?>/sosmed/toggleStatus/<?= $item['id_sosmed'] ?>" class="btn btn-sm <?= $item['is_active'] == 1 ? 'btn-outline-warning' : 'btn-outline-success' ?>" title="<?= $item['is_active'] == 1 ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                        <i class="fas <?= $item['is_active'] == 1 ? 'fa-eye-slash' : 'fa-eye' ?>"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete(<?= $item['id_sosmed'] ?>, '<?= htmlspecialchars($item['nama']) ?>')">
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
    if (confirm('Yakin ingin menghapus sosial media "' + nama + '"?')) {
        window.location.href = '<?= BASE_URL ?>/sosmed/delete/' + id;
    }
}
</script>