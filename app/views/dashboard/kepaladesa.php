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
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto p-3 mb-3">
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
                <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto p-3 mb-3">
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
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle mx-auto p-3 mb-3">
                    <i class="fas fa-user-clock" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">25%</h3>
                <p class="text-muted mb-0">Penduduk Muda</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle mx-auto p-3 mb-3">
                    <i class="fas fa-user-check" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">75%</h3>
                <p class="text-muted mb-0">Penduduk Dewasa</p>
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
                <h5 class="mb-0">Validasi Surat</h5>
            </div>
            <div class="card-body">
                <div class="progress mb-3" style="height: 10px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Disetujui: <strong>60</strong></p>
                <p class="mb-1"><i class="fas fa-clock text-warning me-2"></i>Diproses: <strong>15</strong></p>
                <p class="mb-0"><i class="fas fa-times-circle text-danger me-2"></i>Ditolak: <strong>5</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Jenis Surat</th>
                                <th>Pemohon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Surat Keterangan Usaha</td>
                                <td>Budi Santoso</td>
                                <td>Baru saja</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Keterangan Domisili</td>
                                <td>Siti Nurhaliza</td>
                                <td>2 jam yang lalu</td>
                                <td><span class="badge bg-success">Disetujui</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Pengantar Nikah</td>
                                <td>Ahmad Fauzi</td>
                                <td>1 hari yang lalu</td>
                                <td><span class="badge bg-warning">Diproses</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Keterangan Tidak Mampu</td>
                                <td>Rina Kartika</td>
                                <td>2 hari yang lalu</td>
                                <td><span class="badge bg-warning">Diproses</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Lihat</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [1200, 1220, 1230, 1240, 1245, 1250],
                borderColor: 'rgb(67, 97, 238)',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                tension: 0.4,
                fill: true
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