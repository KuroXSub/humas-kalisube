<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Saran Anda') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card">
            <a href="{{ route('suggestions.create') }}" class="button-primary">Buat Saran Baru</a>

            @if (session('success'))
                <div class="card-success">
                    {{ session('success') }}
                    <button onclick="closeSuccessMessage()" class="close-button">×</button>
                </div>
            @endif

            <!-- Form Pencarian dan Filter -->
            <div class="search-filter-container">
                <form action="{{ route('suggestions.index') }}" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Cari judul/deskripsi..." value="{{ request('search') }}">
                    <select name="sort">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama (ASC)</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru (DESC)</option>
                    </select>
                    <button type="submit" class="button-search">Cari</button>
                    <a href="{{ route('suggestions.index') }}" class="button-refresh">Refresh</a>
                </form>
            </div>

            <table class="main-table">
                <thead>
                    <tr>
                        <th data-label="Judul">Judul</th>
                        <th data-label="Deskripsi">Deskripsi</th>
                        <th data-label="Aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suggestions as $suggestion)
                        <tr>
                            <td data-label="Judul">{{ $suggestion->judul }}</td>
                            <td data-label="Deskripsi" class="truncate-text">{{ $suggestion->deskripsi }}</td>
                            <td data-label="Aksi">
                                <a href="{{ route('suggestions.show', $suggestion) }}" class="button-info">Lihat</a>
                                <a href="{{ route('suggestions.edit', $suggestion) }}" class="button-warning">Edit</a>
                                <button onclick="showDeleteModalS({{ $suggestion->id }})" class="button-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                {{ $suggestions->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Apakah Anda yakin ingin menghapus Saran ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button-danger">Ya, Hapus</button>
                <button type="button" onclick="closeDeleteModal()" class="button-info">Batal</button>
            </form>
        </div>
    </div>
</x-app-layout>