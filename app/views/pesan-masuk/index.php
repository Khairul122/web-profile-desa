<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Pesan Masuk</h4>
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
                    <a class="btn btn-sm <?= (!isset($_GET['status']) || $_GET['status'] == '') ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pesan/index">Semua</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'belum' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pesan/index?status=belum">Belum Dibaca</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'sudah' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pesan/index?status=sudah">Sudah Dibaca</a>
                </div>
            </div>
            <div class="col-md-4">
                <form class="d-flex" method="GET" action="<?= BASE_URL ?>/pesan/index">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari pesan..." value="<?= $_GET['search'] ?? '' ?>">
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
                    <a href="<?= BASE_URL ?>/pesan/index<?= !empty($_GET['search']) ? '?search=' . $_GET['search'] : '' ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> <?= htmlspecialchars($_GET['status'] == 'belum' ? 'Belum Dibaca' : 'Sudah Dibaca') ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($_GET['search'])): ?>
                    <a href="<?= BASE_URL ?>/pesan/index<?= !empty($_GET['status']) ? '?status=' . $_GET['status'] : '' ?>" class="btn btn-sm btn-outline-secondary">
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
                        <th>Pengirim</th>
                        <th>Judul Pesan</th>
                        <th>Isi Singkat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['pesan'])): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-envelope fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Tidak ada pesan masuk</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['pesan'] as $index => $item): ?>
                            <tr class="<?= $item['status_baca'] === 'belum' ? 'table-primary' : '' ?>">
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= htmlspecialchars($item['nama_pengirim']) ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($item['no_hp']) ?></small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-truncate" style="max-width: 200px;"><?= htmlspecialchars($item['judul']) ?></div>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;"><?= htmlspecialchars(substr(strip_tags($item['isi_pesan']), 0, 50)) . (strlen(strip_tags($item['isi_pesan'])) > 50 ? '...' : '') ?></div>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    $statusClass = $item['status_baca'] === 'belum' ? 'bg-warning text-dark' : 'bg-success';
                                    $statusText = $item['status_baca'] === 'belum' ? 'Belum' : 'Sudah';
                                    ?>
                                    <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($statusText) ?></span>
                                </td>
                                <td class="text-center">
                                    <small><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></small>
                                </td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/pesan/detail/<?= $item['id_pesan'] ?>" class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-primary" title="Ubah Status" onclick="openStatusModal(<?= $item['id_pesan'] ?>, '<?= htmlspecialchars($item['judul']) ?>', '<?= $item['status_baca'] ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete(<?= $item['id_pesan'] ?>, '<?= htmlspecialchars($item['judul']) ?>')">
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

<!-- Modal untuk ubah status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" id="pesanId" name="id" value="">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Pesan</label>
                        <p class="form-control-plaintext" id="judulPesan"></p>
                    </div>
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label fw-semibold">Status Baru</label>
                        <select class="form-select" id="statusSelect" name="status" required>
                            <option value="belum">Belum Dibaca</option>
                            <option value="sudah">Sudah Dibaca</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, judul) {
    if (confirm('Yakin ingin menghapus pesan "' + judul + '"?')) {
        window.location.href = '<?= BASE_URL ?>/pesan/delete/' + id;
    }
}

function openStatusModal(id, judul, currentStatus) {
    document.getElementById('pesanId').value = id;
    document.getElementById('judulPesan').textContent = judul;
    document.getElementById('statusSelect').value = currentStatus;
    document.getElementById('statusForm').action = '<?= BASE_URL ?>/pesan/updateStatus/' + id;
    
    var modal = new bootstrap.Modal(document.getElementById('statusModal'));
    modal.show();
}
</script>