<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Edit Saran') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card narrow-card">
            <form action="{{ route('suggestions.update', $suggestion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="main-form">
                    <label for="judul">Judul</label>
                    <textarea name="judul" id="judul" rows="1">{{ $suggestion->judul }}</textarea>
                </div>

                <div class="main-form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4">{{ $suggestion->deskripsi }}</textarea>
                </div>

                <button type="submit" class="button-primary">Update Saran</button>
                <a href="{{ route('suggestions.index') }}" class="button-danger ml-3">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>