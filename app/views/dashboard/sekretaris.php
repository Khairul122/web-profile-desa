<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Sekretaris</h1>
        <div class="ms-auto">
            <span class="badge bg-primary">Halo, <?= $_SESSION['username'] ?? 'Sekretaris' ?></span>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Card untuk surat-menyurat -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-envelope-open-text text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Manajemen Surat</h5>
                            <p class="card-text text-muted">Buat, cetak, dan kelola surat-surat resmi desa.</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary mt-2">Kelola Surat</a>
                </div>
            </div>
        </div>
        
        <!-- Card untuk arsip desa -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-archive text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="card-title">Arsip Desa</h5>
                            <p class="card-text text-muted">Simpan dan cari dokumen arsip penting desa.</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-success mt-2">Lihat Arsip</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 font-weight-bold text-primary">Statistik Surat</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-6 mb-3 mb-md-0">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Surat Masuk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">128</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Surat Keluar</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">96</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Surat Draft</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-edit fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Perlu Ditindaklanjuti</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
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
            <h5 class="m-0 font-weight-bold text-primary">Surat Terbaru</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Surat</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Surat Keterangan Usaha - PT Maju Jaya</td>
                            <td>Baru saja</td>
                        </tr>
                        <tr>
                            <td>Surat Keterangan Domisili - Bapak Suharto</td>
                            <td>30 menit yang lalu</td>
                        </tr>
                        <tr>
                            <td>Surat Pengantar Nikah - Ibu Siti</td>
                            <td>2 jam yang lalu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk animasi dashboard sekretaris -->
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