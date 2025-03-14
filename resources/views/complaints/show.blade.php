<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Detail Pengaduan') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card narrow-card show-card">
            <p><strong>Kategori:</strong> {{ $complaint->kategoriPengaduan->nama_kategori }}</p>
            <p><strong>Deskripsi:</strong> <span>{{ $complaint->deskripsi }}</span></p>
            <p><strong>Status:</strong> {{ $complaint->status }}</p>
            <p><strong>Prioritas:</strong> {{ $complaint->prioritas }}</p>
            <p><strong>Tanggapan:</strong> {{ $complaint->tanggapan ?? 'Belum ada tanggapan' }}</p>
            <p><strong>Petugas:</strong> {{ $complaint->petugas->name ?? 'Belum ditangani' }}</p>

            @if ($complaint->status === 'selesai')
                <hr class="my-4">
                <h3 class="text-lg font-semibold mb-2">Feedback</h3>

                @if ($complaint->feedback)
                    <div class="bg-gray-100 p-4 rounded-md">
                        <p><strong>Komentar:</strong> {{ $complaint->feedback->komentar }}</p>
                        <p><strong>Rating:</strong> {{ $complaint->feedback->rating }}/5</p>
                    </div>
                @else
                    <form action="{{ route('feedback.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                        <div class="main-form">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" id="komentar" rows="3" required></textarea>
                        </div>
                        <div class="main-form">
                            <label for="rating">Rating (1-5)</label>
                            <input type="number" name="rating" id="rating" min="1" max="5" required>
                        </div>
                        <button type="submit" class="button-primary">Kirim Feedback</button>
                    </form>
                @endif
            @endif

            <a href="{{ route('complaints.index') }}" class="button-primary">Kembali ke Daftar Pengaduan</a>
        </div>
    </div>
</x-app-layout>