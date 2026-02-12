<div class="d-flex align-items-center mb-4">
    <a href="<?= BASE_URL ?>/sosmed/index" class="btn btn-outline-secondary me-3">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0"><?= $data['action'] === 'edit' ? 'Edit Sosial Media' : 'Tambah Sosial Media' ?></h4>
</div>

<form method="POST" action="<?= $data['action'] === 'edit' ? BASE_URL . '/sosmed/update/' . $data['sosmed']['id_sosmed'] : BASE_URL . '/sosmed/store' ?>" id="sosmedForm">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Sosial Media <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Facebook, Instagram, Twitter" value="<?= htmlspecialchars($data['sosmed']['nama'] ?? '') ?>" required>
                        <small class="text-muted">Nama sosial media yang akan ditampilkan</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">URL <span class="text-danger">*</span></label>
                        <input type="url" name="url" class="form-control" placeholder="https://facebook.com/namapage" value="<?= htmlspecialchars($data['sosmed']['url'] ?? '') ?>" required>
                        <small class="text-muted">URL lengkap ke halaman sosial media</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Icon</label>
                        <select name="icon" class="form-select">
                            <option value="">-- Pilih Icon --</option>
                            <option value="bi bi-facebook" <?= ($data['sosmed']['icon'] ?? '') === 'bi bi-facebook' ? 'selected' : '' ?>>Facebook (Bootstrap)</option>
                            <option value="bi bi-instagram" <?= ($data['sosmed']['icon'] ?? '') === 'bi bi-instagram' ? 'selected' : '' ?>>Instagram (Bootstrap)</option>
                            <option value="bi bi-twitter" <?= ($data['sosmed']['icon'] ?? '') === 'bi bi-twitter' ? 'selected' : '' ?>>Twitter (Bootstrap)</option>
                            <option value="bi bi-youtube" <?= ($data['sosmed']['icon'] ?? '') === 'bi bi-youtube' ? 'selected' : '' ?>>YouTube (Bootstrap)</option>
                            <option value="bi bi-tiktok" <?= ($data['sosmed']['icon'] ?? '') === 'bi bi-tiktok' ? 'selected' : '' ?>>TikTok (Bootstrap)</option>
                            <option value="fa-brands fa-facebook" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-facebook' ? 'selected' : '' ?>>Facebook (Font Awesome)</option>
                            <option value="fa-brands fa-instagram" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-instagram' ? 'selected' : '' ?>>Instagram (Font Awesome)</option>
                            <option value="fa-brands fa-twitter" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-twitter' ? 'selected' : '' ?>>Twitter (Font Awesome)</option>
                            <option value="fa-brands fa-youtube" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-youtube' ? 'selected' : '' ?>>YouTube (Font Awesome)</option>
                            <option value="fa-brands fa-tiktok" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-tiktok' ? 'selected' : '' ?>>TikTok (Font Awesome)</option>
                            <option value="fa-brands fa-whatsapp" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-whatsapp' ? 'selected' : '' ?>>WhatsApp (Font Awesome)</option>
                            <option value="fa-brands fa-telegram" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-telegram' ? 'selected' : '' ?>>Telegram (Font Awesome)</option>
                            <option value="fa-brands fa-linkedin" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-linkedin' ? 'selected' : '' ?>>LinkedIn (Font Awesome)</option>
                            <option value="fa-brands fa-github" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-github' ? 'selected' : '' ?>>GitHub (Font Awesome)</option>
                            <option value="fa-brands fa-discord" <?= ($data['sosmed']['icon'] ?? '') === 'fa-brands fa-discord' ? 'selected' : '' ?>>Discord (Font Awesome)</option>
                        </select>
                        <small class="text-muted">Pilih icon dari daftar yang tersedia</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" <?= (isset($data['sosmed']['is_active']) && $data['sosmed']['is_active'] == 1) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="isActive">
                                Aktif (Tampil di halaman depan)
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            <?= $data['action'] === 'edit' ? 'Perbarui' : 'Simpan' ?>
                        </button>
                        <a href="<?= BASE_URL ?>/sosmed/index" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>