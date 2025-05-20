@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Daftar Dokumen Desa</h1>
                    <a href="{{ route('welcome') }}" class="btn btn-primary">
                        ← Kembali ke Beranda
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left uppercase">Judul</th>
                                    <th class="text-left uppercase hidden md:table-cell">Deskripsi</th>
                                    <th class="text-left uppercase">Tipe File</th>
                                    <th class="text-left uppercase hidden md:table-cell">Tanggal Upload</th>
                                    <th class="text-left uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($files as $file)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('file.show', $file) }}" class="title-download-link">
                                                {{ $file->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 hidden md:table-cell">{{ Str::limit($file->description, 40) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="file-type-badge">{{ strtoupper($file->file_type) }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">{{ $file->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('file.show', $file) }}" class="btn btn-sm btn-info">
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada dokumen tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($files->hasPages())
                        <div class="mt-4 pagination">
                            {{ $files->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection