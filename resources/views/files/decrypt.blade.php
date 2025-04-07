@extends('layouts.app')

@section('content')

    <div class="document-wrapper">
        <div class="document-info">
            <h1 class="document-title">{{ $file->title }}</h1>
            <p class="document-description">{{ $file->description }}</p>
            <div class="document-meta">
                <span>Tipe File: {{ strtoupper($file->file_type) }}</span>
            </div>
        </div>

        <form action="{{ route('file.decrypt', ['file' => $file]) }}" method="POST"
              id="downloadForm" class="decrypt-form">
            @csrf

            <div class="form-group">
                <label for="decryption_key" class="form-label">
                    Masukkan Kunci Dekripsi
                </label>
                <input type="password" name="decryption_key" id="decryption_key" required
                       class="form-input"
                       placeholder="Masukkan kunci yang diberikan admin">
            </div>

            <button type="submit" id="downloadBtn" class="button-primary download-button">
                Dekripsi dan Download File
            </button>

            <div class="button-navigation">
                <a href="{{ route('files.index') }}" class="button-primary">
                    ← Kembali ke Daftar Dokumen
                </a>
                <a href="{{ route('welcome') }}" class="button-primary">
                    ← Kembali ke Beranda
                </a>
            </div>
        </form>

        @push('scripts')
        <script>
            document.getElementById('downloadForm').addEventListener('submit', function(e) {
                const btn = document.getElementById('downloadBtn');
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
            });
        </script>
        @endpush

        @if(session('error'))
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>
@endsection