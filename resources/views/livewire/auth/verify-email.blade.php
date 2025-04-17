<div class="min-h-screen w-full flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-200 dark:from-zinc-950 dark:to-zinc-900 px-4 py-12">
    <div class="w-full max-w-2xl bg-white dark:bg-zinc-900 rounded-2xl shadow-xl p-10 text-center">
        <h2 class="text-3xl font-extrabold text-indigo-700 dark:text-indigo-400 mb-4">Verifikasi Email</h2>
        <p class="text-base text-gray-600 dark:text-gray-300 mb-6">
            Silakan klik tautan verifikasi yang telah kami kirim ke email Anda.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 text-green-600 dark:text-green-400 font-medium text-sm">
                Tautan verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <div class="flex flex-col gap-4">
            <button wire:click="sendVerification"
                    class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg text-base font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Kirim Ulang Email Verifikasi
            </button>

            <button wire:click="logout"
                    class="text-sm text-gray-600 hover:text-red-600 hover:underline dark:text-gray-400 dark:hover:text-red-400 transition-all duration-200">
                Keluar
            </button>
        </div>
    </div>
</div>
