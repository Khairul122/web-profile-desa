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
                        <p class="text-muted mb-1">Total Surat Hari Ini</p>
                        <h3 class="fw-bold mb-0">24</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-envelope text-primary" style="font-size: 24px;"></i>
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
                    <i class="fas fa-envelope-open-text" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">128</h3>
                <p class="text-muted mb-0">Surat Masuk</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto p-3 mb-3">
                    <i class="fas fa-paper-plane" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">96</h3>
                <p class="text-muted mb-0">Surat Keluar</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle mx-auto p-3 mb-3">
                    <i class="fas fa-edit" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">24</h3>
                <p class="text-muted mb-0">Draft Surat</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle mx-auto p-3 mb-3">
                    <i class="fas fa-exclamation-triangle" style="font-size: 24px;"></i>
                </div>
                <h3 class="fw-bold">8</h3>
                <p class="text-muted mb-0">Perlu Ditindaklanjuti</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistik Surat</h5>
            </div>
            <div class="card-body">
                <canvas id="suratChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Jenis Surat Terbanyak</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Surat Keterangan</span>
                    <span class="badge bg-primary">35%</span>
                </div>
                <div class="progress mb-3" style="height: 10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 35%;"></div>
                </div>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Surat Pengantar</span>
                    <span class="badge bg-success">25%</span>
                </div>
                <div class="progress mb-3" style="height: 10px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%;"></div>
                </div>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Surat Rekomendasi</span>
                    <span class="badge bg-info">20%</span>
                </div>
                <div class="progress mb-3" style="height: 10px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%;"></div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <span>Lainnya</span>
                    <span class="badge bg-warning">20%</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Surat Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Surat</th>
                                <th>Jenis Surat</th>
                                <th>Pemohon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SDS-001</td>
                                <td>Surat Keterangan Usaha</td>
                                <td>PT Maju Jaya</td>
                                <td>Baru saja</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-print"></i></button>
                                    <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>SDS-002</td>
                                <td>Surat Keterangan Domisili</td>
                                <td>Bapak Suharto</td>
                                <td>30 menit yang lalu</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-print"></i></button>
                                    <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>SDS-003</td>
                                <td>Surat Pengantar Nikah</td>
                                <td>Ibu Siti</td>
                                <td>2 jam yang lalu</td>
                                <td><span class="badge bg-warning">Diproses</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-print"></i></button>
                                    <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>SDS-004</td>
                                <td>Surat Keterangan Tidak Mampu</td>
                                <td>Bapak Joko</td>
                                <td>3 jam yang lalu</td>
                                <td><span class="badge bg-danger">Perlu Validasi</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-1"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-print"></i></button>
                                    <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
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
    // Chart untuk statistik surat
    const ctx = document.getElementById('suratChart').getContext('2d');
    const suratChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            datasets: [{
                label: 'Jumlah Surat',
                data: [25, 30, 20, 35, 28, 22],
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