<h1>Website Pengaduan dan Saran Desa Kalisube</h1>
<p>Website Pengaduan dan Saran Desa Kalisube adalah sebuah platform yang dirancang untuk memudahkan masyarakat dalam menyampaikan pengaduan dan saran terkait pembangunan dan pelayanan di Desa Kalisube. Website ini dikembangkan menggunakan Laravel 12 dengan dukungan Filament v3 untuk manajemen admin. Web server dan database dijalankan menggunakan Laragon dengan PHP 8.3.15 dan MySQL 8.0.30.</p>

<h2>Fitur</h2>
<ul>
  <li><strong>CRUD Pengaduan:</strong>
    <ul>
      <li>Masyarakat dapat membuat, membaca, mengupdate, dan menghapus pengaduan.</li>
      <li>Setiap pengaduan memiliki kategori, deskripsi, status, dan prioritas.</li>
    </ul>
  </li>
  <li><strong>CRUD Saran:</strong>
    <ul>
      <li>Masyarakat dapat menyampaikan saran, membaca, mengupdate, dan menghapus saran yang telah diajukan.</li>
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

<h2>Teknologi yang Digunakan</h2>
<ul>
  <li><strong>Framework:</strong> Laravel 12</li>
  <li><strong>Admin Panel:</strong> Filament v3</li>
  <li><strong>Web Server:</strong> Laragon</li>
  <li><strong>PHP:</strong> 8.3.15</li>
  <li><strong>Database:</strong> MySQL 8.0.30</li>
  <li><strong>Frontend:</strong> Tailwind CSS, Livewire</li>
  <li><strong>Authentication:</strong> Laravel</li>
</ul>

<h2>Petunjuk Instalasi</h2>
<p>Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lokal:</p>

<h3>1. Persyaratan Sistem</h3>
<ul>
  <li>PHP 8.3.15</li>
  <li>Composer</li>
  <li>MySQL 8.0.30</li>
  <li>Laragon (opsional, untuk web server dan database)</li>
  <li>Node.js (untuk kompilasi asset)</li>
</ul>

<h3>2. Clone Repository</h3>
<pre><code>git clone https://github.com/KuroXSub/humas-kalisube.git
cd repository-name</code></pre>

<h3>3. Install Dependencies</h3>
<pre><code>composer install
npm install</code></pre>

<h3>4. Konfigurasi Environment</h3>
<pre><code>cp .env.example .env</code></pre>
<p>Buka file <code>.env</code> dan sesuaikan konfigurasi database:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pengaduan_kalisube
DB_USERNAME=root
DB_PASSWORD=</code></pre>

<h3>5. Generate Key</h3>
<pre><code>php artisan key:generate</code></pre>

<h3>6. Migrasi Database</h3>
<pre><code>php artisan migrate</code></pre>

<h3>7. Kompilasi Asset</h3>
<pre><code>npm run build
composer run dev</code></pre>

<h3>8. Jalankan Aplikasi</h3>
<pre><code>php artisan serve</code></pre>
<p>Buka browser dan akses <a href="http://127.0.01:8000">http://127.0.01:8000</a>.</p>

<h2>Cara Menggunakan</h2>
<h3>Masyarakat:</h3>
<ul>
  <li>Daftar atau login untuk mengajukan pengaduan dan saran.</li>
  <li>Pantau status pengaduan dan saran yang telah diajukan.</li>
</ul>

<h3>Admin:</h3>
<ul>
  <li>Login ke panel admin di <code>/admin</code>.</li>
  <li>Kelola data pengaduan, saran, kategori, dan petugas.</li>
</ul>
