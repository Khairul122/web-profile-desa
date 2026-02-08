<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/berita/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0"><?= $data['action'] === 'edit' ? 'Edit Berita' : 'Tambah Berita' ?></h4>
</div>

<form method="POST" action="<?= $data['action'] === 'edit' ? BASE_URL . '/berita/update/' . $data['berita']['id_berita'] : BASE_URL . '/berita/store' ?>" enctype="multipart/form-data" id="beritaForm">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul berita" value="<?= htmlspecialchars($data['berita']['judul'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konten <span class="text-danger">*</span></label>
                        <textarea name="konten" class="form-control" id="editor" rows="10" placeholder="Tuliskan konten berita di sini..." required><?= htmlspecialchars($data['berita']['konten'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keyword SEO</label>
                        <input type="text" name="keyword" class="form-control" placeholder="keyword1, keyword2, keyword3" value="<?= htmlspecialchars($data['berita']['keyword'] ?? '') ?>">
                        <small class="text-muted">Pisahkan keyword dengan koma</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Utama</label>
                        <div class="upload-area border rounded p-4 text-center cursor-pointer" id="uploadArea" onclick="document.getElementById('gambar_berita').click()">
                            <?php if (!empty($data['berita']['gambar_berita'])): ?>
                                <img id="previewImage" src="../<?= BASE_URL_GAMBAR_BERITA ?>/<?= $data['berita']['gambar_berita'] ?>" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                <p class="text-muted mt-2 mb-0 small">Klik untuk ganti gambar</p>
                            <?php else: ?>
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-1 text-muted">Klik untuk upload gambar</p>
                                    <small class="text-muted">JPG, PNG, GIF (Max 5MB)</small>
                                </div>
                                <img id="previewImage" src="" alt="Preview" class="img-fluid rounded d-none" style="max-height: 200px;">
                            <?php endif; ?>
                        </div>
                        <input type="file" name="gambar_berita" id="gambar_berita" class="d-none" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Profil Desa" <?= ($data['berita']['kategori'] ?? '') === 'Profil Desa' ? 'selected' : '' ?>>Profil Desa</option>
                            <option value="Berita Desa" <?= ($data['berita']['kategori'] ?? '') === 'Berita Desa' ? 'selected' : '' ?>>Berita Desa</option>
                            <option value="Pengumuman" <?= ($data['berita']['kategori'] ?? '') === 'Pengumuman' ? 'selected' : '' ?>>Pengumuman</option>
                            <option value="Agenda" <?= ($data['berita']['kategori'] ?? '') === 'Agenda' ? 'selected' : '' ?>>Agenda</option>
                            <option value="Prestasi" <?= ($data['berita']['kategori'] ?? '') === 'Prestasi' ? 'selected' : '' ?>>Prestasi</option>
                            <option value="Layanan" <?= ($data['berita']['kategori'] ?? '') === 'Layanan' ? 'selected' : '' ?>>Layanan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="draft" <?= ($data['berita']['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="publish" <?= ($data['berita']['status'] ?? '') === 'publish' ? 'selected' : '' ?>>Publish</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            <?= $data['action'] === 'edit' ? 'Perbarui Berita' : 'Simpan Berita' ?>
                        </button>
                        <a href="<?= BASE_URL ?>/berita/index" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

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
    $('#editor').summernote({
        height: 300,
        placeholder: 'Tuliskan konten berita di sini...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

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
            $('#gambar_berita')[0].files = e.originalEvent.dataTransfer.files;
            previewFile(file);
        }
    });

    $('#gambar_berita').change(function() {
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

    <?php if (!empty($data['berita']['gambar_berita'])): ?>
        $('.upload-placeholder').addClass('d-none');
    <?php endif; ?>
});
</script>
