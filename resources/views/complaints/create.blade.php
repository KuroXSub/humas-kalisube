<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Buat Pengaduan Baru') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card narrow-card">
            <form action="{{ route('complaints.store') }}" method="POST">
                @csrf

                <div class="main-form">
                    <label for="kategori_pengaduan_id">Kategori Pengaduan</label>
                    <select name="kategori_pengaduan_id" id="kategori_pengaduan_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="main-form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"></textarea>
                </div>

                <button type="submit" class="button-primary">Buat Pengaduan</button>
                <a href="{{ route('complaints.index') }}" class="button-danger ml-3">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>