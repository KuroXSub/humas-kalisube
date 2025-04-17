<div class="min-h-screen w-full flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-200 dark:from-zinc-950 dark:to-zinc-900 px-4 py-12">
    <div class="w-full max-w-2xl bg-white dark:bg-zinc-900 rounded-2xl shadow-xl p-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-indigo-700 dark:text-indigo-400">Konfirmasi Password</h2>
            <p class="mt-2 text-base text-gray-600 dark:text-gray-300">
                Area ini aman. Silakan masukkan password Anda sebelum melanjutkan.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-center text-green-600 font-medium text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="confirmPassword" class="space-y-6">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                <input wire:model="password" type="password" id="password" required
                       placeholder="••••••••"
                       class="mt-2 block w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white text-base focus:border-indigo-500 focus:ring-indigo-500" />
                @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg text-base font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Konfirmasi
            </button>
        </form>
    </div>
</div>
