Bertindaklah sebagai Senior Fullstack Developer. Saya ingin membangun website "Profil Desa" yang dinamis, responsif, dan clean code menggunakan **PHP Native** dengan arsitektur **MVC (Model-View-Controller)** kustom.

### 1. Spesifikasi Proyek
- **Bahasa:** PHP 8+ (Native, tanpa framework).
- **Frontend:** HTML5, CSS (Gunakan Tailwind CSS via CDN agar responsif mobile).
- **Database:** MySQL/MariaDB.
- **Arsitektur:** Custom MVC (Folder `public` sebagai web root, `app` untuk logika).
- **Keamanan:** Wajib menggunakan PDO Prepared Statements (anti SQL Injection) dan sanitasi input XSS.

### 2. Fitur Khusus & Role Pengguna
Sistem harus memiliki autentikasi login dengan **3 Role** berbeda:
1.  **Kepala Desa:** Bisa melihat laporan statistik dan memvalidasi surat (akses read-only/approval).
2.  **Admin:** Full akses (CRUD berita, CRUD data penduduk, manajemen user).
3.  **Sekretaris:** Akses kelola surat-menyurat dan data arsip desa.

**Mekanisme Notifikasi:**
- Jangan gunakan Flash Message Session yang rumit.
- Gunakan **JavaScript `window.alert()`** sederhana untuk notifikasi berhasil atau gagal.
- Logikanya: Controller mengirim data pesan ke View, lalu View merender `<script>alert('Pesan')</script>` jika ada pesan.

### 3. Struktur Direktori Wajib
Tolong implementasikan struktur folder berikut secara ketat:
/web-desa/
│
├── public/                 <-- Satu-satunya folder yang bisa diakses publik (Web Root)
│   ├── css/                <-- File Stylesheet
│   ├── js/                 <-- File JavaScript
│   ├── img/                <-- Gambar/Aset
│   ├── index.php           <-- ENTRY POINT (Gerbang utama aplikasi)
│   └── .htaccess           <-- Pengaturan server (Rewrite URL)
│
├── app/                    <-- Logika utama aplikasi (MVC ada di sini)
│   ├── config/             <-- Konfigurasi database & konstan
│   │   └── config.php
│   │
│   ├── controllers/        <-- Mengatur logika antar Model dan View
│   │   └── Home.php
│   │
│   ├── core/               <-- Jantung framework buatan sendiri
│   │   ├── App.php         <-- Class Routing (memecah URL)
│   │   ├── Controller.php  <-- Class utama Controller
│   │   ├── Database.php    <-- Class Wrapper Database (PDO)
│   │   └── Flasher.php     <-- (Opsional) Untuk pesan notifikasi/flash message
│   │
│   ├── models/             <-- Berhubungan dengan Database
│   │   └── User_model.php
│   │
│   └── views/              <-- Tampilan (HTML)
│       ├── templates/      <-- Header/Footer yang berulang
│       │   ├── header.php
│       │   └── footer.php
│       └── home/           <-- View spesifik halaman home
│           └── index.php
│
├── vendor/                 <-- (Opsional) Jika menggunakan Composer/Autoloading
└── composer.json           <-- (Opsional) Definisi dependency

### 3. Fitur Utama yang Harus Dibuat
1.  **Routing Dinamis:** Class `App.php` harus bisa menangani URL seperti `domain.com/berita/detail/1`.
2.  **Tampilan Responsif:** Header/Navbar harus memiliki fitur "Hamburger Menu" yang bekerja dengan baik di tampilan Mobile (HP).
3.  **Halaman Beranda (Home):** Harus ada bagian Hero Section (Foto Desa), Sambutan Kepala Desa, Berita Terkini (ambil 3 terbaru), dan Statistik Penduduk (Card sederhana).
4.  **Database Wrapper:** Buat class `Database.php` yang robust dengan method: `query`, `bind`, `execute`, `resultSet`, dan `single`.

### 4. Permintaan Kode
Tolong generate kode inti untuk membangun sistem ini, dengan fokus pada:
1.  **Core MVC:** File `App.php` (Routing) dan `Database.php` (Wrapper).
3.  **Controller Login:** Logika login yang mengecek role user dan melempar alert jika gagal/berhasil.
4.  **View Login & Dashboard:** Tampilan login sederhana dengan Tailwind dan contoh dashboard yang menampilkan menu berbeda berdasarkan role yang login.

**Catatan Penting:**
- Jangan gunakan `echo` di dalam Controller, kirim data ke View.
- Pastikan kode responsif (mobile-first approach).
- Berikan komentar singkat pada bagian kode yang kompleks.