<h1>Website Pengaduan dan Saran Desa Kalisube</h1>
<p>Website Pengaduan dan Saran Desa Kalisube adalah sebuah platform yang dirancang untuk memudahkan masyarakat dalam menyampaikan pengaduan dan saran terkait pembangunan dan pelayanan di Desa Kalisube. Website ini dikembangkan menggunakan Laravel 12 dengan dukungan Filament v3 untuk manajemen admin. Web server dan database dijalankan menggunakan Laragon dengan PHP 8.3.15 dan MySQL 8.0.30.</p>

<h2>Fitur</h2>
<ul>
  <li><strong>CRUD Pengaduan:</strong>
    <ul>
      <li>Masyarakat dapat membuat, membaca, mengupdate, dan menghapus pengaduan.</li>
      <li>Setiap pengaduan memiliki kategori, deskripsi, status, dan prioritas.</li>
      <li><strong>Fitur Baru:</strong> Anonimisasi data pengadu dengan sistem hashing untuk perlindungan privasi di Admin Panel</li>
    </ul>
  </li>
  <li><strong>CRUD Saran:</strong>
    <ul>
      <li>Masyarakat dapat menyampaikan saran, membaca, mengupdate, dan menghapus saran yang telah diajukan.</li>
      <li><strong>Fitur Baru:</strong> Sistem hashing untuk menyamarkan identitas pengirim saran di Admin Panel</li>
    </ul>
  </li>
  <li><strong>Feedback:</strong>
    <ul>
      <li>Memberikan rating dan komentar terhadap pengaduan</li>
      <li><strong>Fitur Baru:</strong> Proteksi identitas dengan hashing user ID di Admin Panel</li>
    </ul>
  </li>
  <li><strong>Autentikasi:</strong>
    <ul>
      <li><strong>Fitur Baru:</strong> Login dengan Google menggunakan Laravel Socialite</li>
      <li>Registrasi dan login tradisional</li>
    </ul>
  </li>
  <li><strong>Beranda (Overview):</strong> Menampilkan ringkasan pengaduan dan saran.</li>
  <li><strong>Pencarian dan Filter:</strong>
    <ul>
      <li>Pencarian berdasarkan kategori, deskripsi, atau status.</li>
      <li>Filter berdasarkan status (menunggu, diproses, selesai) dan prioritas.</li>
    </ul>
  </li>
  <li><strong>Pagination:</strong> Data pengaduan dan saran ditampilkan dengan paginasi untuk memudahkan navigasi.</li>
  <li><strong>Manajemen Admin:</strong> Admin dapat mengelola data pengaduan, saran, kategori, dan petugas menggunakan Filament v3.</li>
</ul>

<h2>Fitur Baru</h2>

<h3>1. Sistem Hashing untuk Perlindungan Identitas di Admin Panel</h3>
<p>Kami menerapkan sistem hashing untuk melindungi identitas pengguna dalam fitur pengaduan, saran, dan feedback:</p>
<ul>
  <li>Identitas pengguna ditampilkan dalam bentuk hash (contoh: User-a1b2c3d4e5f6)</li>
  <li>Data asli tetap tersimpan di database namun tidak terlihat di antarmuka</li>
  <li>Konsisten - user yang sama akan memiliki hash yang sama di seluruh sistem</li>
  <li>Menggunakan algoritma SHA-256 dengan salt dari app key</li>
</ul>

<h3>2. Login dengan Google</h3>
<p>Sistem sekarang mendukung autentikasi menggunakan akun Google:</p>
<ul>
  <li>Menggunakan Laravel Socialite untuk integrasi OAuth</li>
  <li>Auto-registrasi untuk user baru</li>
  <li>Auto-verifikasi email untuk user Google</li>
  <li>Tombol login Google tersedia di halaman login/register</li>
</ul>

<h2>Teknologi yang Digunakan</h2>
<ul>
  <li><strong>Framework:</strong> Laravel 12</li>
  <li><strong>Admin Panel:</strong> Filament v3</li>
  <li><strong>Web Server:</strong> Laragon</li>
  <li><strong>PHP:</strong> 8.3.15</li>
  <li><strong>Database:</strong> MySQL 8.0.30</li>
  <li><strong>Frontend:</strong> Tailwind CSS, Livewire</li>
  <li><strong>Authentication:</strong> Laravel + Socialite</li>
  <li><strong>Security:</strong> Hashing SHA-256, OAuth 2.0</li>
</ul>

<h2>Petunjuk Instalasi</h2>

<h3>Persyaratan Tambahan</h3>
<ul>
  <li>Akun Google Developer untuk OAuth</li>
  <li>Client ID dan Secret dari Google Cloud Console</li>
</ul>

<h3>Konfigurasi Google OAuth</h3>
<ol>
  <li>Buka <a href="https://console.cloud.google.com/">Google Cloud Console</a></li>
  <li>Buat project baru atau pilih yang sudah ada</li>
  <li>Navigasi ke "APIs & Services" > "Credentials"</li>
  <li>Buat OAuth Client ID (tipe Web Application)</li>
  <li>Tambahkan authorized redirect URI: <code>http://127.0.0.1:8000/auth/google/callback</code></li>
  <li>Tambahkan ke .env:
    <pre><code>GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback</code></pre>
  </li>
</ol>

<h3>Langkah Instalasi</h3>
<ol>
  <li>Clone repository</li>
  <li>Install dependencies:
    <pre><code>composer install
npm install</code></pre>
  </li>
  <li>Konfigurasi environment:
    <pre><code>cp .env.example .env
php artisan key:generate</code></pre>
  </li>
  <li>Migrasi database:
    <pre><code>php artisan migrate</code></pre>
  </li>
  <li>Kompilasi asset:
    <pre><code>npm run build</code></pre>
  </li>
  <li>Jalankan aplikasi:
    <pre><code>php artisan serve</code></pre>
  </li>
</ol>

<h2>Cara Menggunakan Fitur Baru</h2>

<h3>Login dengan Google</h3>
<ol>
  <li>Kunjungi halaman login</li>
  <li>Klik tombol "Login with Google"</li>
  <li>Pilih akun Google yang ingin digunakan</li>
  <li>Setelah persetujuan, Anda akan otomatis login</li>
</ol>

<h3>Sistem Hashing Identitas</h3>
<ul>
  <li>Di admin panel, identitas user akan ditampilkan sebagai hash</li>
  <li>Data asli tetap tersimpan di database</li>
  <li>Hash yang sama akan selalu mewakili user yang sama</li>
</ul>