<h1>Website Pengaduan dan Saran Desa Kalisube</h1>
<p>Website ini adalah platform untuk masyarakat menyampaikan pengaduan dan saran terhadap pembangunan serta pelayanan desa. Dibangun dengan Laravel 12 dan Filament v3, sistem ini berjalan di atas Laragon menggunakan PHP 8.3.15 dan MySQL 8.0.30.</p>

<h2>Fitur Utama</h2>

<h3>Manajemen Data</h3>
<ul>
  <li><strong>Pengaduan:</strong> CRUD, status, prioritas, SHA-256 untuk anonimisasi, notifikasi real-time</li>
  <li><strong>Saran:</strong> CRUD, proteksi identitas, notifikasi masuk</li>
  <li><strong>Feedback:</strong> Rating dan komentar dengan proteksi identitas</li>
</ul>

<h3>Admin Panel Modern</h3>
<ul>
  <li><strong>Dashboard Overview:</strong> Widget responsif dalam 4 grup utama</li>
  <li><strong>Palet Warna Profesional:</strong> Warna utama biru tua (#1e3a8a), status dengan hijau, kuning, merah</li>
  <li><strong>Sistem Notifikasi:</strong> Real-time dan log aktivitas user</li>
</ul>

<h3>Autentikasi Terbaru</h3>
<ul>
  <li><strong>Redesain Auth (Livewire):</strong>
    <ul>
      <li>UI baru untuk Login, Register, Reset Password, dan Verifikasi Email</li>
      <li>Responsif, ringan, dan menggunakan Tailwind</li>
    </ul>
  </li>
  <li><strong>Social Login:</strong> Login dengan Google melalui Laravel Socialite</li>
  <li><strong>Verifikasi Otomatis:</strong> Email verification untuk akun baru</li>
</ul>

<h3>Settings Terbaru</h3>
<ul>
  <li><strong>Halaman Profil:</strong> Update nama, email, dan foto profil</li>
  <li><strong>Pengaturan Password:</strong> Ubah password dengan validasi real-time</li>
  <li><strong>Tampilan (Appearance):</strong> Pilih tema terang/gelap (dark mode)</li>
</ul>

<h2>Dashboard Admin Panel</h2>

<h3>Overview Widget</h3>
<ol>
  <li><strong>Informasi Umum:</strong> Masyarakat terdaftar, Kategori pengaduan</li>
  <li><strong>Status Pengaduan:</strong> Menunggu, Diproses, Selesai</li>
  <li><strong>Prioritas Pengaduan:</strong> Rendah, Sedang, Tinggi</li>
  <li><strong>Partisipasi Masyarakat:</strong> Total Feedback dan Saran</li>
</ol>

<h3>Fitur Notifikasi</h3>
<ul>
  <li>User baru terdaftar</li>
  <li>Pengaduan baru</li>
  <li>Update status pengaduan</li>
  <li>CRUD aktivitas saran</li>
</ul>

<h2>Teknologi yang Digunakan</h2>
<ul>
  <li><strong>Framework:</strong> Laravel 12</li>
  <li><strong>Admin Panel:</strong> Filament v3</li>
  <li><strong>Database:</strong> MySQL 8.0.30</li>
  <li><strong>Frontend:</strong> Tailwind CSS, Livewire</li>
  <li><strong>Autentikasi:</strong> Laravel Auth + Socialite</li>
  <li><strong>Keamanan:</strong> Hashing SHA-256, bcrypt, OAuth 2.0</li>
  <li><strong>Notifikasi:</strong> Laravel Notifications</li>
</ul>

<h2>Petunjuk Instalasi</h2>

<h3>Konfigurasi Awal</h3>
<ol>
  <li>Clone repository</li>
  <pre><code>git clone https://github.com/KuroXSub/humas-kalisube.git
cd organization-spala</code></pre>
  <li>Install dependencies</li>
  <pre><code>composer install
npm install</code></pre>
  <li>Setup environment</li>
  <pre><code>cp .env.example .env
php artisan key:generate</code></pre>
  <li>Konfigurasi database di file <code>.env</code></li>
  <pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pengaduan_kalisube
DB_USERNAME=root
DB_PASSWORD=</code></pre>
</ol>

<h3>Konfigurasi Admin Panel</h3>
<ol>
  <li>Migrasi database</li>
  <pre><code>php artisan migrate</code></pre>
  <li>Kompilasi assets</li>
  <pre><code>npm run build
composer run dev</code></pre>
  <li>Jalankan server lokal</li>
  <pre><code>php artisan serve</code></pre>
</ol>

<h3>Akses Admin Panel</h3>
<ul>
  <li>Buat user admin: <code>php artisan make:filament-user</code></li>
  <li>Akses via: <code>http://127.0.0.1:8000/admin</code></li>
</ul>

<h2>Panduan Penggunaan</h2>

<h3>Untuk Admin</h3>
<ol>
  <li>Pantau aktivitas dari dashboard</li>
  <li>Kelola pengaduan dan saran melalui menu admin</li>
  <li>Akses histori notifikasi dan log aktivitas</li>
</ol>

<h3>Untuk Masyarakat</h3>
<ol>
  <li>Login menggunakan email atau Google</li>
  <li>Kirim pengaduan dan saran</li>
  <li>Lihat status pengaduan</li>
  <li>Beri feedback terhadap penanganan</li>
</ol>

<h2>Fitur Baru: Sistem Enkripsi/Dekripsi File</h2>

<h3>Manajemen File Terenkripsi</h3>
<ul>
  <li><strong>Admin Panel:</strong> Upload file, input kunci, hash otomatis, daftar metadata file</li>
  <li><strong>Akses Publik:</strong> Halaman dekripsi, input kunci, download otomatis, rate limiting</li>
</ul>

<h3>Alur Kerja</h3>
<ol>
  <li><strong>Admin Upload:</strong> Pilih file → masukkan kunci → enkripsi otomatis → simpan di storage</li>
  <li><strong>User Akses:</strong> Buka link → input kunci → verifikasi → dekripsi → stream download</li>
</ol>

<h3>Keamanan Sistem</h3>
<ul>
  <li><strong>Enkripsi:</strong> AES-256-CBC dengan IV unik</li>
  <li><strong>Hashing:</strong> bcrypt (cost 12)</li>
  <li><strong>Storage:</strong> Folder privat Laravel</li>
  <li><strong>Proteksi:</strong> Rate limiting, auto delete cache, validasi kunci</li>
</ul>

<h3>Teknologi Tambahan</h3>
<ul>
  <li><strong>Enkripsi:</strong> OpenSSL</li>
  <li><strong>Hashing:</strong> bcrypt</li>
  <li><strong>Streaming:</strong> Laravel Response Stream</li>
</ul>
