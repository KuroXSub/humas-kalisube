<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Detail Saran') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card narrow-card show-card">
            <p><strong>Judul:</strong> {{ $suggestion->judul }}</p>
            <p><strong>Deskripsi:</strong><span>{{ $suggestion->deskripsi }}</span></p>

            <a href="{{ route('suggestions.index') }}" class="button-primary">Kembali ke Daftar Saran</a>
        </div>
    </div>
</x-app-layout>