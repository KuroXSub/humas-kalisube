# Website Pengaduan dan Saran Desa

<div align="center">

[![GitHub stars](https://img.shields.io/github/stars/KuroXSub/humas-desa-laravel?style=for-the-badge)](https://github.com/KuroXSub/humas-desa-laravel/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/KuroXSub/humas-desa-laravel?style=for-the-badge)](https://github.com/KuroXSub/humas-desa-laravel/network)
[![GitHub issues](https://img.shields.io/github/issues/KuroXSub/humas-desa-laravel?style=for-the-badge)](https://github.com/KuroXSub/humas-desa-laravel/issues)

</div>

Website ini adalah platform untuk masyarakat menyampaikan pengaduan dan saran terhadap pembangunan serta pelayanan desa. Dibangun dengan Laravel 12 dan Filament v3, sistem ini berjalan di atas Laragon menggunakan PHP 8.3.15 dan MySQL 8.0.30.

## Fitur Utama

### Manajemen Data

*   **Pengaduan:** CRUD, status, prioritas, SHA-256 untuk anonimisasi, notifikasi real-time
*   **Saran:** CRUD, proteksi identitas, notifikasi masuk
*   **Feedback:** Rating dan komentar dengan proteksi identitas

### Admin Panel Modern

*   **Dashboard Overview:** Widget responsif dalam 4 grup utama
*   **Palet Warna Profesional:** Warna utama biru tua (#1e3a8a), status dengan hijau, kuning, merah
*   **Sistem Notifikasi:** Real-time dan log aktivitas user

### Autentikasi Terbaru

*   **Redesain Auth (Livewire):**
    *   UI baru untuk Login, Register, Reset Password, dan Verifikasi Email
    *   Responsif, ringan, dan menggunakan Tailwind
*   **Social Login:** Login dengan Google melalui Laravel Socialite
*   **Verifikasi Otomatis:** Email verification untuk akun baru

### Settings Terbaru

*   **Halaman Profil:** Update nama, email, dan foto profil
*   **Pengaturan Password:** Ubah password dengan validasi real-time
*   **Tampilan (Appearance):** Pilih tema terang/gelap (dark mode)

### Dashboard Admin Panel
---

### Overview Widget

1.  **Informasi Umum:** Masyarakat terdaftar, Kategori pengaduan
2.  **Status Pengaduan:** Menunggu, Diproses, Selesai
3.  **Prioritas Pengaduan:** Rendah, Sedang, Tinggi
4.  **Partisipasi Masyarakat:** Total Feedback dan Saran

### Fitur Notifikasi

*   User baru terdaftar
*   Pengaduan baru
*   Update status pengaduan
*   CRUD aktivitas saran

## Tech Stack

*   **Framework:** Laravel 12
*   **Admin Panel:** Filament v3
*   **Database:** MySQL 8.0.30
*   **Frontend:** Tailwind CSS, Livewire
*   **Autentikasi:** Laravel Auth + Socialite
*   **Keamanan:** Hashing SHA-256, bcrypt, OAuth 2.0
*   **Notifikasi:** Laravel Notifications

## Instalasi

### Konfigurasi Awal

1.  Clone repository

    ``` bash
    git clone https://github.com/KuroXSub/humas-desa-laravel.git
    cd humas-desa-laravel
    ```

2.  Install dependencies

    ``` bash
    composer install
    npm install
    ```

3.  Setup environment

    ``` bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  Konfigurasi database di file `.env`

    ``` code
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_pengaduan
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### Konfigurasi Admin Panel

1.  Migrasi database

    ``` bash
    php artisan migrate
    ```

2.  Kompilasi assets

    ``` bash
    npm run build
    composer run dev
    ```

3.  Jalankan server lokal

    ``` bash
    php artisan serve
    ```

### Akses Admin Panel

- Buat user admin: `php artisan make:filament-user`
- Akses via: `http://127.0.0.1:8000/admin`

## Panduan Penggunaan

### Untuk Admin

1.  Pantau aktivitas dari dashboard
2.  Kelola pengaduan dan saran melalui menu admin
3.  Akses histori notifikasi dan log aktivitas

### Untuk Masyarakat

1.  Login menggunakan email atau Google
2.  Kirim pengaduan dan saran
3.  Lihat status pengaduan
4.  Beri feedback terhadap penanganan

## Fitur Baru: Sistem Enkripsi/Dekripsi File

### Manajemen File Terenkripsi

*   **Admin Panel:** Upload file, input kunci, hash otomatis, daftar metadata file
*   **Akses Publik:** Halaman dekripsi, input kunci, download otomatis, rate limiting

### Alur Kerja

1.  **Admin Upload:** Pilih file → masukkan kunci → enkripsi otomatis → simpan di storage
2.  **User Akses:** Buka link → input kunci → verifikasi → dekripsi → stream download

### Keamanan Sistem

*   **Enkripsi:** AES-256-CBC dengan IV unik
*   **Hashing:** bcrypt (cost 12)
*   **Storage:** Folder privat Laravel
*   **Proteksi:** Rate limiting, auto delete cache, validasi kunci

### Teknologi Tambahan

*   **Enkripsi:** OpenSSL
*   **Hashing:** bcrypt
*   **Streaming:** Laravel Response Stream

## Pengembang
Dikembangkan oleh Qurrota.

Website Pengembang: [kuroxsub.my.id](https://kuroxsub.my.id)

GitHub: [@KuroXSub](https://github.com/KuroXSub)