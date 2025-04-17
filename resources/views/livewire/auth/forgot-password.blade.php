<div class="min-h-screen w-full flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-200 dark:from-zinc-950 dark:to-zinc-900 px-4 py-12">
    <div class="w-full max-w-2xl bg-white dark:bg-zinc-900 rounded-2xl shadow-xl p-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-indigo-700 dark:text-indigo-400">Lupa Password</h2>
            <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Masukkan email Anda untuk mendapatkan tautan reset password.</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-center text-green-600 font-medium text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="sendPasswordResetLink" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input wire:model="email" type="email" id="email" required
                       placeholder="email@example.com"
                       class="mt-2 block w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white text-base focus:border-indigo-500 focus:ring-indigo-500" />
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg text-base font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Kirim Tautan Reset
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
            Atau kembali ke
            <a href="{{ route('login') }}" wire:navigate
               class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline transition-all duration-200 dark:text-indigo-400 dark:hover:text-indigo-300">
                halaman login
            </a>
        </p>
    </div>
</div>
