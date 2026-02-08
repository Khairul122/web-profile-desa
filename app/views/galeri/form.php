<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/galeri/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0"><?= $data['action'] === 'edit' ? 'Edit Galeri' : 'Tambah Galeri' ?></h4>
</div>

<form method="POST" action="<?= $data['action'] === 'edit' ? BASE_URL . '/galeri/update/' . $data['galeri']['id_galeri'] : BASE_URL . '/galeri/store' ?>" enctype="multipart/form-data" id="galeriForm">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul galeri" value="<?= htmlspecialchars($data['galeri']['judul'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi galeri..."><?= htmlspecialchars($data['galeri']['deskripsi'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar <span class="text-danger">*</span></label>
                        <div class="upload-area border rounded p-4 text-center cursor-pointer" id="uploadArea" onclick="document.getElementById('gambar').click()">
                            <?php if (!empty($data['galeri']['gambar'])): ?>
                                <img id="previewImage" src="<?= BASE_URL_GAMBAR_GALERI ?>/<?= $data['galeri']['gambar'] ?>" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                <p class="text-muted mt-2 mb-0 small">Klik untuk ganti gambar</p>
                            <?php else: ?>
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-1 text-muted">Klik untuk upload gambar</p>
                                    <small class="text-muted">JPG, PNG, GIF, WebP (Max 5MB)</small>
                                </div>
                                <img id="previewImage" src="" alt="Preview" class="img-fluid rounded d-none" style="max-height: 200px;">
                            <?php endif; ?>
                        </div>
                        <input type="file" name="gambar" id="gambar" class="d-none" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pembangunan" <?= ($data['galeri']['kategori'] ?? '') === 'Pembangunan' ? 'selected' : '' ?>>Pembangunan</option>
                            <option value="Pemerintahan" <?= ($data['galeri']['kategori'] ?? '') === 'Pemerintahan' ? 'selected' : '' ?>>Pemerintahan</option>
                            <option value="Sosial" <?= ($data['galeri']['kategori'] ?? '') === 'Sosial' ? 'selected' : '' ?>>Sosial</option>
                            <option value="Budaya" <?= ($data['galeri']['kategori'] ?? '') === 'Budaya' ? 'selected' : '' ?>>Budaya</option>
                            <option value="Ekonomi" <?= ($data['galeri']['kategori'] ?? '') === 'Ekonomi' ? 'selected' : '' ?>>Ekonomi</option>
                            <option value="Pemuda" <?= ($data['galeri']['kategori'] ?? '') === 'Pemuda' ? 'selected' : '' ?>>Pemuda</option>
                            <option value="Keagamaan" <?= ($data['galeri']['kategori'] ?? '') === 'Keagamaan' ? 'selected' : '' ?>>Keagamaan</option>
                            <option value="Pertanian" <?= ($data['galeri']['kategori'] ?? '') === 'Pertanian' ? 'selected' : '' ?>>Pertanian</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            <?= $data['action'] === 'edit' ? 'Perbarui' : 'Simpan' ?>
                        </button>
                        <a href="<?= BASE_URL ?>/galeri/index" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<style>
.upload-area {
    background: #f8f9fa;
    border: 2px dashed #dee2e6 !important;
    transition: all 0.3s ease;
    cursor: pointer;
}
.upload-area:hover {
    border-color: #4361ee !important;
    background: #eef1ff;
}
.upload-area.dragover {
    border-color: #4361ee !important;
    background: #eef1ff;
}
</style>

<script>
$(document).ready(function() {
    $('#uploadArea').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('dragover');
    }).on('dragleave', function() {
        $(this).removeClass('dragover');
    }).on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        const file = e.originalEvent.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            $('#gambar')[0].files = e.originalEvent.dataTransfer.files;
            previewFile(file);
        }
    });

    $('#gambar').change(function() {
        const file = this.files[0];
        if (file) {
            previewFile(file);
        }
    });

    function previewFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#previewImage').attr('src', e.target.result).removeClass('d-none');
            $('.upload-placeholder').addClass('d-none');
        };
        reader.readAsDataURL(file);
    }

    <?php if (!empty($data['galeri']['gambar'])): ?>
        $('.upload-placeholder').addClass('d-none');
    <?php endif; ?>
});
</script>
