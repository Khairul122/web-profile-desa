Tabel users
Nama Kolom,Tipe Data,Keterangan
id_user,"INT (PK, AI)","Primary Key, ID unik yang bertambah otomatis."
username,VARCHAR(50),Username unik untuk login.
password,CHAR(64),Hash SHA-256 selalu menghasilkan 64 karakter.
email,VARCHAR(100),Alamat email (Unique).
no_hp,VARCHAR(15),Nomor telepon/WhatsApp.
nama_lengkap,VARCHAR(100),Nama asli pengguna.
role,ENUM,"Pilihan peran: 'kepdes', 'admin', 'sekdes'."
is_active,BOOLEAN,"Status akun (1 untuk aktif, 0 untuk nonaktif)."


Note:
1. Struktur database yang tercantum dalam dokumen ini telah diimplementasikan. Skema ini wajib digunakan sebagai referensi utama dan pedoman dalam pengembangan sistem.
2. Demi keamanan data, setiap password wajib dienkripsi menggunakan algoritma SHA-256 sebelum disimpan ke dalam database.
3. Kolom peran hanya mendukung tiga nilai standar: kepdes (Kepala Desa), admin, atau sekdes (Sekretaris Desa). Pastikan input data sesuai dengan kategori tersebut.
4. Kolom is_active berfungsi sebagai penanda status akun, di mana nilai 1 merepresentasikan akun Aktif dan nilai 0 merepresentasikan akun Nonaktif.
