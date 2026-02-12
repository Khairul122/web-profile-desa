<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Pengaduan</h4>
    <a href="<?= BASE_URL ?>/pengaduan/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Pengaduan
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
                    <a class="btn btn-sm <?= (!isset($_GET['status']) || $_GET['status'] == '') ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pengaduan/index">Semua</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'Pending' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pengaduan/index?status=Pending">Pending</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'Proses' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pengaduan/index?status=Proses">Proses</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'Selesai' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pengaduan/index?status=Selesai">Selesai</a>
                    <a class="btn btn-sm <?= ($_GET['status'] ?? '') == 'Tolak' ? 'btn-primary' : 'btn-outline-primary' ?>" href="<?= BASE_URL ?>/pengaduan/index?status=Tolak">Ditolak</a>
                </div>
            </div>
            <div class="col-md-4">
                <form class="d-flex" method="GET" action="<?= BASE_URL ?>/pengaduan/index">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari pengaduan..." value="<?= $_GET['search'] ?? '' ?>">
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
                    <a href="<?= BASE_URL ?>/pengaduan/index<?= !empty($_GET['search']) ? '?search=' . $_GET['search'] : '' ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> <?= htmlspecialchars($_GET['status']) ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($_GET['search'])): ?>
                    <a href="<?= BASE_URL ?>/pengaduan/index<?= !empty($_GET['status']) ? '?status=' . $_GET['status'] : '' ?>" class="btn btn-sm btn-outline-secondary">
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
                        <th style="width: 150px;">Foto Bukti</th>
                        <th>Judul Laporan</th>
                        <th>Pelapor</th>
                        <th>Lokasi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['pengaduan'])): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-comments fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Belum ada pengaduan</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['pengaduan'] as $index => $item): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td>
                                    <?php if (!empty($item['foto_bukti'])): ?>
                                        <img src="<?= BASE_URL_GAMBAR_PENGADUAN ?>/<?= $item['foto_bukti'] ?>" alt="Foto Bukti" class="rounded" style="width: 80px; height: 60px; object-fit: cover;" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setImageSrc('<?= BASE_URL_GAMBAR_PENGADUAN ?>/<?= $item['foto_bukti'] ?>')">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-truncate" style="max-width: 250px;"><?= htmlspecialchars($item['judul_laporan']) ?></div>
                                    <small class="text-muted"><?= date('d M Y H:i', strtotime($item['created_at'])) ?></small>
                                    <div class="text-truncate" style="max-width: 250px;"><?= htmlspecialchars(substr(strip_tags($item['isi']), 0, 50)) . (strlen(strip_tags($item['isi'])) > 50 ? '...' : '') ?></div>
                                </td>
                                <td>
                                    <div><?= htmlspecialchars($item['nama_pelapor']) ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($item['no_hp']) ?></small>
                                </td>
                                <td><?= htmlspecialchars($item['lokasi']) ?></td>
                                <td class="text-center">
                                    <?php 
                                    $statusClass = '';
                                    switch($item['status']) {
                                        case 'Pending': $statusClass = 'bg-warning text-dark'; break;
                                        case 'Proses': $statusClass = 'bg-info'; break;
                                        case 'Selesai': $statusClass = 'bg-success'; break;
                                        case 'Tolak': $statusClass = 'bg-danger'; break;
                                    }
                                    ?>
                                    <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($item['status']) ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/pengaduan/detail/<?= $item['id_pengaduan'] ?>" class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-primary" title="Ubah Status" onclick="openStatusModal(<?= $item['id_pengaduan'] ?>, '<?= htmlspecialchars($item['judul_laporan']) ?>', '<?= $item['status'] ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="confirmDelete(<?= $item['id_pengaduan'] ?>, '<?= htmlspecialchars($item['judul_laporan']) ?>')">
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

<!-- Modal untuk ubah status -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status Pengaduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" id="pengaduanId" name="id" value="">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Pengaduan</label>
                        <p class="form-control-plaintext" id="judulLaporan"></p>
                    </div>
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label fw-semibold">Status Baru</label>
                        <select class="form-select" id="statusSelect" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Tolak">Tolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatanInput" class="form-label fw-semibold">Catatan</label>
                        <textarea class="form-control" id="catatanInput" name="catatan" rows="3" placeholder="Tambahkan catatan atau tanggapan..."></textarea>
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
    if (confirm('Yakin ingin menghapus pengaduan "' + judul + '"?')) {
        window.location.href = '<?= BASE_URL ?>/pengaduan/delete/' + id;
    }
}

function setImageSrc(src) {
    document.getElementById('modalImage').src = src;
}

function openStatusModal(id, judul, currentStatus) {
    document.getElementById('pengaduanId').value = id;
    document.getElementById('judulLaporan').textContent = judul;
    document.getElementById('statusSelect').value = currentStatus;
    document.getElementById('statusForm').action = '<?= BASE_URL ?>/pengaduan/updateStatus/' + id;
    
    var modal = new bootstrap.Modal(document.getElementById('statusModal'));
    modal.show();
}
</script>