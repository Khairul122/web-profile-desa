<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/pengurus/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0"><?= $data['action'] === 'edit' ? 'Edit Pengurus' : 'Tambah Pengurus' ?></h4>
</div>

<form method="POST" action="<?= $data['action'] === 'edit' ? BASE_URL . '/pengurus/update/' . $data['pengurus']['id_pengurus'] : BASE_URL . '/pengurus/store' ?>" enctype="multipart/form-data" id="pengurusForm">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="<?= htmlspecialchars($data['pengurus']['nama_lengkap'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Kepala Desa, Sekretaris, dll" value="<?= htmlspecialchars($data['pengurus']['jabatan'] ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="L" <?= ($data['pengurus']['jenis_kelamin'] ?? 'L') === 'L' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="jkL">
                                    <i class="fas fa-mars text-info me-1"></i> Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="P" <?= ($data['pengurus']['jenis_kelamin'] ?? '') === 'P' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="jkP">
                                    <i class="fas fa-venus text-pink me-1"></i> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto</label>
                        <div class="upload-area border rounded p-4 text-center cursor-pointer" id="uploadArea" onclick="document.getElementById('foto_pengurus').click()">
                            <?php if (!empty($data['pengurus']['foto_pengurus'])): ?>
                                <img id="previewImage" src="../<?= BASE_URL_GAMBAR_PENGURUS ?>/<?= $data['pengurus']['foto_pengurus'] ?>" alt="Preview" class="img-fluid rounded mb-2" style="max-height: 200px;">
                                <p class="text-muted mb-0 small">Klik untuk ganti foto</p>
                            <?php else: ?>
                                <div class="upload-placeholder">
                                    <i class="fas fa-user fa-3x text-muted mb-3"></i>
                                    <p class="mb-1 text-muted">Klik untuk upload foto</p>
                                    <small class="text-muted">JPG, PNG, GIF (Max 2MB)</small>
                                </div>
                                <img id="previewImage" src="" alt="Preview" class="img-fluid rounded d-none mb-2" style="max-height: 200px;">
                            <?php endif; ?>
                        </div>
                        <input type="file" name="foto_pengurus" id="foto_pengurus" class="d-none" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status_aktif" class="form-select">
                            <option value="1" <?= ($data['pengurus']['status_aktif'] ?? 1) == 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= ($data['pengurus']['status_aktif'] ?? '') == 0 ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            <?= $data['action'] === 'edit' ? 'Perbarui' : 'Simpan' ?>
                        </button>
                        <a href="<?= BASE_URL ?>/pengurus/index" class="btn btn-outline-secondary">
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
.text-pink {
    color: #e91e63 !important;
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
            $('#foto_pengurus')[0].files = e.originalEvent.dataTransfer.files;
            previewFile(file);
        }
    });

    $('#foto_pengurus').change(function() {
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

    <?php if (!empty($data['pengurus']['foto_pengurus'])): ?>
        $('.upload-placeholder').addClass('d-none');
    <?php endif; ?>
});
</script>
