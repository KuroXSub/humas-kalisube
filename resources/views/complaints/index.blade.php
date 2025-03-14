<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Pengaduan Anda') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card">
            <a href="{{ route('complaints.create') }}" class="button-primary">Buat Pengaduan Baru</a>

            @if (session('success'))
                <div class="card-success">
                    {{ session('success') }}
                    <button onclick="closeSuccessMessage()" class="close-button">×</button>
                </div>
            @endif

            <!-- Form Pencarian dan Filter -->
            <div class="search-filter-container">
                <form action="{{ route('complaints.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Cari kategori/deskripsi..." value="{{ request('search') }}">
                    <select name="status">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <select name="sort">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama (ASC)</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru (DESC)</option>
                    </select>
                    <button type="submit" class="button-search">Cari</button>
                    <a href="{{ route('complaints.index') }}" class="button-refresh">Refresh</a>
                </form>
            </div>

            <!-- Tabel Pengaduan -->
            <table class="main-table">
                <thead>
                    <tr>
                        <th data-label="Kategori">Kategori</th>
                        <th data-label="Deskripsi">Deskripsi</th>
                        <th data-label="Status">Status</th>
                        <th data-label="Prioritas">Prioritas</th>
                        <th data-label="Aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td data-label="Kategori">{{ $complaint->kategoriPengaduan->nama_kategori }}</td>
                            <td data-label="Deskripsi" class="truncate-text">{{ $complaint->deskripsi }}</td>
                            <td data-label="Status">{{ $complaint->status }}</td>
                            <td data-label="Prioritas">{{ $complaint->prioritas }}</td>
                            <td data-label="Aksi">
                                <a href="{{ route('complaints.show', $complaint) }}" class="button-info">Lihat</a>

                                @if ($complaint->status !== 'selesai')
                                    <a href="{{ route('complaints.edit', $complaint) }}" class="button-warning">Edit</a>
                                    <button onclick="showDeleteModal({{ $complaint->id }})" class="button-danger">Hapus</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                {{ $complaints->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Apakah Anda yakin ingin menghapus pengaduan ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button-danger">Ya, Hapus</button>
                <button type="button" onclick="closeDeleteModal()" class="button-info">Batal</button>
            </form>
        </div>
    </div>
</x-app-layout>