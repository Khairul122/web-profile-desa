        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('collapsed');

            // For mobile view
            if (window.innerWidth <= 768) {
                overlay.classList.toggle('active');
            }
        });

        // Close sidebar when clicking on overlay (mobile)
        document.getElementById('overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });

        // For mobile view, toggle sidebar open/close
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('open');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
                document.getElementById('overlay').classList.remove('active');
            } else {
                sidebar.classList.add('collapsed');
            }
        });
    </script>
</body>
</html>