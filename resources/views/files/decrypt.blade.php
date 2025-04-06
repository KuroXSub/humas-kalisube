@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold mb-2">{{ $file->title }}</h1>
            <p class="text-gray-600 mb-4">{{ $file->description }}</p>
            <div class="flex items-center text-sm text-gray-500">
                <span class="mr-4">Tipe File: {{ strtoupper($file->file_type) }}</span>
            </div>
        </div>

        <form action="{{ route('file.decrypt', ['file' => $file]) }}" method="POST" 
            id="downloadForm" class="space-y-4">
            @csrf
            
            <div>
                <label for="decryption_key" class="block text-sm font-medium text-gray-700 mb-1">
                    Masukkan Kunci Dekripsi
                </label>
                <input type="password" name="decryption_key" id="decryption_key" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Masukkan kunci yang diberikan admin">
            </div>
        
            <button type="submit" id="downloadBtn"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Dekripsi dan Download File
            </button>
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
        <div class="mt-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700">
            <p>{{ session('error') }}</p>
        </div>
        @endif
    </div>
</div>
@endsection