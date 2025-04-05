<h1>Website Pengaduan dan Saran Desa Kalisube</h1>
<p>Website Pengaduan dan Saran Desa Kalisube adalah sebuah platform yang dirancang untuk memudahkan masyarakat dalam menyampaikan pengaduan dan saran terkait pembangunan dan pelayanan di Desa Kalisube. Website ini dikembangkan menggunakan Laravel 12 dengan dukungan Filament v3 untuk manajemen admin. Web server dan database dijalankan menggunakan Laragon dengan PHP 8.3.15 dan MySQL 8.0.30.</p>

<h2>Fitur Utama</h2>

<h3>Manajemen Data</h3>
<ul>
  <li><strong>Pengaduan:</strong>
    <ul>
      <li>CRUD pengaduan dengan kategori, deskripsi, status, dan prioritas</li>
      <li>Sistem anonimisasi dengan hashing SHA-256 di admin panel</li>
      <li>Notifikasi real-time untuk admin saat ada pengaduan baru</li>
    </ul>
  </li>
  <li><strong>Saran:</strong>
    <ul>
      <li>CRUD saran dari masyarakat</li>
      <li>Proteksi identitas dengan sistem hashing</li>
      <li>Notifikasi untuk admin saat saran baru masuk</li>
    </ul>
  </li>
  <li><strong>Feedback:</strong>
    <ul>
      <li>Sistem rating dan komentar</li>
      <li>Identitas terproteksi dengan hashing</li>
    </ul>
  </li>
</ul>

<h3>Admin Panel Modern</h3>
<ul>
  <li><strong>Dashboard Overview:</strong>
    <ul>
      <li>Ringkasan data dalam 4 kelompok widget</li>
      <li>Tampilan responsive dengan kolom dinamis</li>
    </ul>
  </li>
  <li><strong>Warna Profesional:</strong>
    <ul>
      <li>Palet warna biru (#1e3a8a) sebagai primary color</li>
      <li>Kombinasi warna untuk status (hijau, kuning, merah)</li>
    </ul>
  </li>
  <li><strong>Sistem Notifikasi:</strong>
    <ul>
      <li>Notifikasi real-time untuk aktivitas user</li>
      <li>History aktivitas terpusat</li>
    </ul>
  </li>
</ul>

<h3>Autentikasi</h3>
<ul>
  <li>Login dengan email/password</li>
  <li>Login dengan Google menggunakan Socialite</li>
  <li>Auto-registrasi dan verifikasi untuk user baru</li>
</ul>

<h2>Dashboard Admin Panel</h2>

<h3>Overview Widget</h3>
<p>Dashboard admin menampilkan ringkasan data dalam 4 kelompok:</p>

<ol>
  <li><strong>Informasi Umum (2 kolom):</strong>
    <ul>
      <li>Total Masyarakat terdaftar</li>
      <li>Jumlah Kategori pengaduan</li>
    </ul>
  </li>
  <li><strong>Status Pengaduan (3 kolom):</strong>
    <ul>
      <li>Pengaduan Menunggu</li>
      <li>Pengaduan Diproses</li>
      <li>Pengaduan Selesai</li>
    </ul>
  </li>
  <li><strong>Prioritas Pengaduan (3 kolom):</strong>
    <ul>
      <li>Prioritas Rendah</li>
      <li>Prioritas Sedang</li>
      <li>Prioritas Tinggi</li>
    </ul>
  </li>
  <li><strong>Partisipasi Masyarakat (2 kolom):</strong>
    <ul>
      <li>Total Feedback</li>
      <li>Total Saran</li>
    </ul>
  </li>
</ol>

<h3>Fitur Notifikasi</h3>
<ul>
  <li>Notifikasi saat user baru mendaftar</li>
  <li>Peringatan ketika ada pengaduan baru</li>
  <li>Update status pengaduan</li>
  <li>Notifikasi aktivitas CRUD saran</li>
</ul>

<h2>Teknologi yang Digunakan</h2>
<ul>
  <li><strong>Framework:</strong> Laravel 12</li>
  <li><strong>Admin Panel:</strong> Filament v3</li>
  <li><strong>Database:</strong> MySQL 8.0.30</li>
  <li><strong>Frontend:</strong> Tailwind CSS, Livewire</li>
  <li><strong>Autentikasi:</strong> Laravel + Socialite</li>
  <li><strong>Keamanan:</strong> Hashing SHA-256, OAuth 2.0</li>
  <li><strong>Notifikasi:</strong> Laravel Notifications</li>
</ul>

<h2>Petunjuk Instalasi</h2>

<h3>Konfigurasi Awal</h3>
<ol>
  <li>Clone repository</li>
  <pre><code>git clone https://github.com/KuroXSub/organization-spala.git
cd organization-spala</code></pre>
  <li>Install dependencies:
    <pre><code>composer install
npm install</code></pre>
  </li>
  <li>Setup environment:
    <pre><code>cp .env.example .env
php artisan key:generate</code></pre>
  </li>
  <p>Buka file <code>.env</code> dan sesuaikan konfigurasi database:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pengaduan_kalisube
DB_USERNAME=root
DB_PASSWORD=</code></pre>
</ol>

<h3>Konfigurasi Admin Panel</h3>
<ol>
  <li>Migrasi database:
    <pre><code>php artisan migrate</code></pre>
  </li>
  <li>Kompilasi assets:
    <pre><code>npm run build
composer run dev</code></pre>
  </li>
  <li>Jalankan sistem:
    <pre><code>php artisan serve</code></pre>
  </li>
</ol>

<h3>Akses Admin Panel</h3>
<ul>
  <li>Buat User <code>php artisan make:filament-user</code></li>
  <li>Buka <code>http://127.0.0.1:8000/admin</code></li>
  <li>Login dengan akun admin</li>
  <li>Dashboard overview akan menampilkan ringkasan sistem</li>
</ul>

<h2>Panduan Penggunaan</h2>

<h3>Untuk Admin</h3>
<ol>
  <li>Pantau semua aktivitas melalui dashboard</li>
  <li>Kelola pengaduan melalui menu khusus</li>
  <li>Lihat notifikasi di pojok kanan atas</li>
</ol>

<h3>Untuk Masyarakat</h3>
<ol>
  <li>Login menggunakan email atau Google</li>
  <li>Ajukan pengaduan/saran melalui form</li>
  <li>Pantau status pengaduan Anda</li>
  <li>Berikan feedback untuk pengaduan</li>
</ol>