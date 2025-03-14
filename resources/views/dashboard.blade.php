<x-app-layout>
    <x-slot name="header">
        <h2 class="header">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card: Total Complaints -->
            <div class="card-dash">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Pengaduan</h3>
                    <p class="text-2xl font-bold">{{ $totalComplaints }}</p>
                    <div class="mt-4">
                        <a href="{{ route('complaints.index') }}" class="button-info">Lihat Pengaduan</a>
                        <a href="{{ route('complaints.create') }}" class="button-primary">Buat Pengaduan Baru</a>
                    </div>
                </div>
            </div>

            <!-- Card: Total Feedback Given -->
            <div class="card-dash">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Feedback Diberikan</h3>
                    <p class="text-2xl font-bold">{{ $totalFeedbackGiven }}</p>
                    <div class="mt-4">
                        <a href="{{ route('complaints.index') }}" class="button-info">Lihat Pengaduan</a>
                    </div>
                </div>
            </div>

            <!-- Card: Complaints Without Feedback -->
            <div class="card-dash">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Pengaduan Tanpa Feedback</h3>
                    <p class="text-2xl font-bold">{{ $complaintsWithoutFeedback }}</p>
                    <div class="mt-4">
                        <a href="{{ route('complaints.index') }}" class="button-info">Lihat Pengaduan</a>
                    </div>
                </div>
            </div>

            <!-- Card: Total Suggestions -->
            <div class="card-dash">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Saran</h3>
                    <p class="text-2xl font-bold">{{ $totalSuggestions }}</p>
                    <div class="mt-4">
                        <a href="{{ route('suggestions.index') }}" class="button-info">Lihat Saran</a>
                        <a href="{{ route('suggestions.create') }}" class="button-primary">Buat Saran Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>