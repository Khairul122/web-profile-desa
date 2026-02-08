<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/profile/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0"><?= $data['action'] === 'edit' ? 'Edit Profile' : 'Tambah Profile' ?></h4>
</div>

<form method="POST" action="<?= $data['action'] === 'edit' ? BASE_URL . '/profile/update/' . $data['profile']['id_profile'] : BASE_URL . '/profile/store' ?>" id="profileForm">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><?= BASE_URL ?>/p/</span>
                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Contoh: sejarah-desa" value="<?= htmlspecialchars($data['profile']['slug'] ?? '') ?>" required>
                </div>
                <small class="text-muted">Slug untuk URL profile</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Keterangan <span class="text-danger">*</span></label>
                <textarea name="keterangan" class="form-control" id="keterangan" rows="15" placeholder="Tuliskan profile desa di sini..." required><?= isset($data['profile']['keterangan']) ? html_entity_decode($data['profile']['keterangan']) : '' ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    <?= $data['action'] === 'edit' ? 'Perbarui' : 'Simpan' ?>
                </button>
                <a href="<?= BASE_URL ?>/profile/index" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    $('#keterangan').summernote({
        height: 400,
        placeholder: 'Tuliskan profile desa di sini...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                uploadImage(files[0]);
            }
        }
    });

    function uploadImage(file) {
        var formData = new FormData();
        formData.append('gambar', file);

        $.ajax({
            url: '<?= BASE_URL ?>/profile/uploadImage',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(url) {
                $('#keterangan').summernote('insertImage', url);
            },
            error: function() {
                alert('Gagal mengupload gambar');
            }
        });
    }
});
</script>
