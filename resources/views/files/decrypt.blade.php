@extends('layouts.app')

@section('content')
    <div class="document-wrapper">
        @if($errors->has('decryption_key'))
            <div class="alert alert-error mb-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">Error!</span>
                </div>
                <p class="mt-2">{{ $errors->first('decryption_key') }}</p>
                @auth
                    <p class="mt-2 text-sm">Jika Anda lupa kunci, hubungi admin yang mengupload file ini.</p>
                @endauth
            </div>
        @endif

        <div class="document-info">
            <h1 class="document-title">{{ $file->title }}</h1>
            <div class="document-description-container">
                <p class="document-description">{{ $file->description }}</p>
            </div>
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
                <a href="{{ route('files.index') }}" class="button-secondary">
                    ← Kembali ke Daftar Dokumen
                </a>
                <a href="{{ route('welcome') }}" class="button-secondary">
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