<?php
// Tampilkan header dashboard
require_once __DIR__ . '/../templates/dashboard_admin_layout.php';
?>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Jumlah Penduduk</p>
                        <h3 class="fw-bold mb-0">1,250</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-users text-primary" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto d-flex align-items-center justify-content-center"
                    style="width: 64px; height: 64px;">
                    <i class="fas fa-users" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">450</h3>
                <p class="text-muted mb-0">Kepala Keluarga</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                 <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto d-flex align-items-center justify-content-center"
                    style="width: 64px; height: 64px;">
                    <i class="fas fa-home" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">45</h3>
                <p class="text-muted mb-0">RT</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
              <div class="bg-warning bg-opacity-10 text-warning rounded-circle mx-auto d-flex align-items-center justify-content-center"
                    style="width: 64px; height: 64px;">
                    <i class="fas fa-building" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">12</h3>
                <p class="text-muted mb-0">RW</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                 <div class="bg-danger bg-opacity-10 text-danger rounded-circle mx-auto d-flex align-items-center justify-content-center"
                    style="width: 64px; height: 64px;">
                    <i class="fas fa-envelope" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">8</h3>
                <p class="text-muted mb-0">Surat Menunggu</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik Penduduk</h5>
            </div>
            <div class="card-body">
                <canvas id="populationChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-alt text-primary me-2"></i>
                            <span>Pengajuan Surat Keterangan Usaha</span>
                        </div>
                        <span class="badge bg-primary">Baru</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-alt text-success me-2"></i>
                            <span>Pengajuan Surat Keterangan Domisili</span>
                        </div>
                        <span class="badge bg-success">2 jam</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-alt text-info me-2"></i>
                            <span>Pengajuan Surat Pengantar Nikah</span>
                        </div>
                        <span class="badge bg-info">1 hari</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-alt text-warning me-2"></i>
                            <span>Pengajuan Surat Keterangan Tidak Mampu</span>
                        </div>
                        <span class="badge bg-warning">2 hari</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-alt text-secondary me-2"></i>
                            <span>Pengajuan Surat Keterangan Beda Nama</span>
                        </div>
                        <span class="badge bg-secondary">3 hari</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Manajemen Konten</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="p-3 rounded bg-light">
                                <i class="fas fa-newspaper text-primary mb-2" style="font-size: 24px;"></i>
                                <p class="mb-0">Berita Desa</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="p-3 rounded bg-light">
                                <i class="fas fa-users text-success mb-2" style="font-size: 24px;"></i>
                                <p class="mb-0">Data Penduduk</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="p-3 rounded bg-light">
                                <i class="fas fa-file-alt text-info mb-2" style="font-size: 24px;"></i>
                                <p class="mb-0">Surat Menyurat</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="p-3 rounded bg-light">
                                <i class="fas fa-cog text-warning mb-2" style="font-size: 24px;"></i>
                                <p class="mb-0">Pengaturan</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart untuk statistik penduduk
    const ctx = document.getElementById('populationChart').getContext('2d');
    const populationChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [1200, 1220, 1230, 1240, 1245, 1250],
                backgroundColor: [
                    'rgba(67, 97, 238, 0.7)',
                    'rgba(58, 12, 163, 0.7)',
                    'rgba(67, 97, 238, 0.7)',
                    'rgba(58, 12, 163, 0.7)',
                    'rgba(67, 97, 238, 0.7)',
                    'rgba(58, 12, 163, 0.7)'
                ],
                borderColor: [
                    'rgba(67, 97, 238, 1)',
                    'rgba(58, 12, 163, 1)',
                    'rgba(67, 97, 238, 1)',
                    'rgba(58, 12, 163, 1)',
                    'rgba(67, 97, 238, 1)',
                    'rgba(58, 12, 163, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php
// Tampilkan footer dashboard
require_once __DIR__ . '/../templates/dashboard_admin_footer.php';
?>