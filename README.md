# FoundIT

FoundIT adalah sebuah aplikasi berbasis web (*Lost and Found*) yang dirancang untuk mempermudah pengguna dalam melaporkan barang yang hilang maupun barang yang ditemukan. 

Aplikasi ini menjadi jembatan antara penemu barang dan pemilik barang yang kehilangan dengan menyediakan fitur verifikasi yang aman dan terstruktur yang dikelola oleh Admin.

## 📌 Fitur Utama
1. **Lapor Kehilangan**: Pengguna dapat memposting informasi barang yang hilang (foto, deskripsi, lokasi).
2. **Lapor Penemuan**: Pengguna dapat memposting barang yang ditemukan.
3. **Sistem Verifikasi (Admin)**: Admin bertugas memverifikasi klaim barang sebelum mempertemukan penemu dan pemilik.
4. **Notifikasi Interaktif**: Pemilik barang akan mendapatkan notifikasi jika barangnya diduga ditemukan dan bisa mengonfirmasi apakah itu benar barangnya atau bukan.
5. **Riwayat Postingan**: Pengguna dapat melihat, mengedit, dan menghapus riwayat barang yang telah mereka laporkan.
6. **Manajemen Profil**: Pengguna dan Admin dapat mengubah data profil secara dinamis, termasuk mengunggah foto profil baru.

---

## 💻 Persyaratan Sistem (System Requirements)
Sebelum menjalankan aplikasi ini, pastikan komputer Anda telah menginstal perangkat lunak berikut:
- **PHP** (minimal versi 8.1 atau lebih baru)
- **Composer** (Dependency manager untuk PHP)
- **MySQL** / MariaDB (Bisa menggunakan XAMPP, Laragon, dll.)
- **Git**

---

## 🚀 Cara Instalasi dan Menjalankan Aplikasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi FoundIT secara lokal di komputer Anda:

### 1. Clone Repository
Pertama, *clone* repository ini ke komputer Anda dan masuk ke dalam folder proyek melalui terminal.
```bash
git clone https://github.com/mraihanhadi/FoundIT.git
cd FoundIT
```

### 2. Install Dependensi PHP (Composer)
Instal semua package dan dependensi Laravel yang dibutuhkan.
```bash
composer install
```

### 3. Konfigurasi Environment (.env)
Salin file konfigurasi bawaan Laravel (`.env.example`) menjadi `.env`.
```bash
cp .env.example .env
```
Buka file `.env` yang baru saja dibuat di *text editor* Anda, lalu atur bagian koneksi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foundit_db  # Ubah sesuai dengan nama database yang Anda buat di MySQL
DB_USERNAME=root        # Username database Anda
DB_PASSWORD=            # Password database Anda (kosongkan jika default XAMPP)
```

### 4. Generate Application Key
Generate kunci enkripsi keamanan untuk aplikasi Laravel Anda.
```bash
php artisan key:generate
```

### 5. Buat Database dan Jalankan Migrasi
Pastikan Anda sudah membuat database kosong di aplikasi database manager Anda (misal bernama `foundit_db`). Setelah itu, jalankan perintah migrasi beserta seedernya (untuk membuat kerangka tabel dan mengisi data dummy admin/user).
```bash
php artisan migrate --seed
```

### 6. Link Storage (Sangat Penting untuk Foto/Gambar)
Agar foto profil pengguna dan foto barang yang diunggah bisa ditampilkan di browser, Anda wajib menjalankan perintah storage link.
```bash
php artisan storage:link
```
> **Catatan Troubleshoot**: Jika Anda menarik (pull) pembaruan dari GitHub atau meng-clone ulang dan gambar tidak muncul (pesan error "link already exists"), silakan **hapus folder shortcut `storage` di dalam folder `public/` secara manual terlebih dahulu**, lalu jalankan kembali perintah `php artisan storage:link`.

### 7. Jalankan Server Lokal
Nyalakan local development server bawaan Laravel.
```bash
php artisan serve
```

Aplikasi sekarang sudah berjalan dengan sukses! Silakan buka web browser Anda dan akses:  
**http://localhost:8000**

---

## 🔑 Akun Login Default
Karena Anda telah menjalankan command `--seed` pada langkah ke-5, Anda dapat menggunakan akun berikut untuk masuk ke dalam aplikasi:

**Akun Admin:**
- **Email:** admin@foundit.com
- **Password:** password

**Akun Pengguna (User):**
- **Email:** user@foundit.com
- **Password:** password
