<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Kepala Desa</h1>
        <div class="ms-auto">
            <span class="badge bg-primary">Halo, <?= $_SESSION['username'] ?? 'Kepala Desa' ?></span>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Card untuk laporan statistik -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-chart-bar text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Laporan Statistik</h5>
                            <p class="card-text text-muted">Lihat laporan statistik penduduk dan perkembangan desa.</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary mt-2">Lihat Laporan</a>
                </div>
            </div>
        </div>
        
        <!-- Card untuk validasi surat -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-file-signature text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Validasi Surat</h5>
                            <p class="card-text text-muted">Verifikasi dan validasi surat-surat yang diajukan.</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-success mt-2">Validasi Surat</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 font-weight-bold text-primary">Statistik Desa</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-6 mb-3 mb-md-0">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Penduduk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">1,250</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-3 mb-md-0">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah KK</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">45</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Penduduk Muda</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">25%</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Penduduk Dewasa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">75%</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pengajuan Surat Keterangan Usaha</td>
                            <td>2 jam yang lalu</td>
                        </tr>
                        <tr>
                            <td>Laporan Pembangunan Jalan</td>
                            <td>1 hari yang lalu</td>
                        </tr>
                        <tr>
                            <td>Permohonan Surat Keterangan Domisili</td>
                            <td>2 hari yang lalu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk animasi dashboard kepala desa -->
<script>
    // Animasi tambahan menggunakan Anime.js
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi untuk kartu-kartu dashboard
        anime({
            targets: '.card',
            translateY: [-20, 0],
            opacity: [0, 1],
            scale: [0.95, 1],
            delay: anime.stagger(100),
            duration: 800,
            easing: 'easeOutCubic'
        });
        
        // Animasi untuk ikon dalam kartu
        anime({
            targets: '.bg-primary\\.bg-opacity-10, .bg-success\\.bg-opacity-10',
            scale: [{value: 0.8}, {value: 1.1}, {value: 1}],
            duration: 1000,
            easing: 'easeInOutQuad',
            delay: anime.stagger(200, {start: 500}),
            loop: false
        });
        
        // Animasi untuk statistik
        anime({
            targets: '.h5',
            innerHTML: [0, el => parseInt(el.textContent)],
            round: 1,
            duration: 2000,
            easing: 'easeOutQuad',
            delay: anime.stagger(300, {start: 1000})
        });
    });
</script>