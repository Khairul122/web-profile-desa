<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Profile</h4>
    <a href="<?= BASE_URL ?>/profile/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Profile
    </a>
</div>

<?php
require_once __DIR__ . '/../../core/Flasher.php';
use User\WebDesa\Core\Flasher;
echo Flasher::getMessage();
?>

<div class="card">
    <div class="card-body">
        <?php if (empty($data['profile'])): ?>
            <div class="text-center py-5 text-muted">
                <i class="fas fa-file-alt fa-3x mb-3 text-secondary"></i>
                <p class="mb-0">Belum ada profile</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Keterangan</th>
                            <th>Slug</th>
                            <th class="text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['profile'] as $index => $profile): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= htmlspecialchars(substr($profile['keterangan'], 0, 100)) ?><?= strlen($profile['keterangan']) > 100 ? '...' : '' ?></div>
                                    <small class="text-muted"><?= date('d M Y', strtotime($profile['created_at'])) ?></small>
                                </td>
                                <td><code class="bg-light px-2 py-1 rounded"><?= htmlspecialchars($profile['slug']) ?></code></td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/profile/edit/<?= $profile['id_profile'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete(<?= $profile['id_profile'] ?>, '<?= htmlspecialchars(substr($profile['slug'], 0, 30)) ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function confirmDelete(id, slug) {
    if (confirm('Yakin ingin menghapus profile "' + slug + '"?')) {
        window.location.href = '<?= BASE_URL ?>/profile/delete/' + id;
    }
}
</script>
