<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Edit Pengaduan') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card narrow-card">
            <form action="{{ route('complaints.update', $complaint) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="main-form">
                    <label for="kategori_pengaduan_id">Kategori Pengaduan</label>
                    <select name="kategori_pengaduan_id" id="kategori_pengaduan_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $complaint->kategori_pengaduan_id == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="main-form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4">{{ $complaint->deskripsi }}</textarea>
                </div>

                <button type="submit" class="button-primary">Update Pengaduan</button>
                <a href="{{ route('complaints.index') }}" class="button-danger ml-3">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>