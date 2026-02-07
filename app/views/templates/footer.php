    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Website Profil Desa</h5>
                    <p class="text-secondary">Menyediakan informasi terkini tentang profil, berita, dan layanan desa.</p>
                </div>
                
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= BASE_URL ?>" class="text-secondary text-decoration-none footer-link">Beranda</a></li>
                        <li><a href="#" class="text-secondary text-decoration-none footer-link">Profil Desa</a></li>
                        <li><a href="#" class="text-secondary text-decoration-none footer-link">Berita</a></li>
                        <li><a href="#" class="text-secondary text-decoration-none footer-link">Layanan</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="text-secondary"><i class="fas fa-map-marker-alt me-2"></i> Jl. Raya Desa No. 123</li>
                        <li class="text-secondary"><i class="fas fa-phone me-2"></i> (021) 123456</li>
                        <li class="text-secondary"><i class="fas fa-envelope me-2"></i> info@desa.id</li>
                    </ul>
                </div>
                
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                    <div class="d-flex">
                        <a href="#" class="text-secondary me-3 fs-5 social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-secondary me-3 fs-5 social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-secondary me-3 fs-5 social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-secondary fs-5 social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 bg-secondary">
            
            <div class="text-center text-secondary">
                <p class="mb-0">&copy; 2026 Website Profil Desa. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <!-- Script untuk animasi global -->
    <script>
        // Animasi untuk elemen-elemen umum
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk link di footer
            anime({
                targets: '.footer-link',
                translateY: [-10, 0],
                opacity: [0, 1],
                delay: anime.stagger(100),
                duration: 800,
                easing: 'easeOutCubic'
            });
            
            // Animasi untuk ikon sosial media
            anime({
                targets: '.social-icon',
                scale: [{value: 0.8}, {value: 1.1}, {value: 1}],
                duration: 1000,
                easing: 'easeInOutQuad',
                delay: anime.stagger(200),
                loop: true,
                direction: 'alternate',
                endDelay: 1000
            });
        });
    </script>
</body>
</html>