<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Buat Saran Baru') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card narrow-card">
            <form action="{{ route('suggestions.store') }}" method="POST">
                @csrf

                <div class="main-form">
                    <label for="judul">Judul</label>
                    <textarea name="judul" id="judul" rows="1"></textarea>
                </div>

                <div class="main-form">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"></textarea>
                </div>

                <button type="submit" class="button-primary">Buat Saran</button>
                <a href="{{ route('suggestions.index') }}" class="button-danger ml-3">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>