<div class="min-h-screen w-full flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-indigo-200 dark:from-zinc-950 dark:to-zinc-900 px-4 py-12">
    <div class="w-full max-w-2xl bg-white dark:bg-zinc-900 rounded-2xl shadow-xl p-10">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-indigo-700 dark:text-indigo-400">Masuk ke Akun Anda</h2>
            <p class="mt-2 text-base text-gray-600 dark:text-gray-300">Silakan isi email dan password Anda</p>
        </div>

        <form wire:submit="login" class="space-y-6">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                <input wire:model="email" type="email" id="email" required autocomplete="email"
                    placeholder="you@example.com"
                    class="mt-2 block w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white text-base focus:border-indigo-500 focus:ring-indigo-500" />
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        wire:navigate
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:underline transition-all duration-200 dark:text-indigo-400 dark:hover:text-indigo-300">
                        Lupa password?
                    </a>
                    @endif
                </div>
                <input wire:model="password" type="password" id="password" required autocomplete="current-password"
                    placeholder="••••••••"
                    class="mt-1 block w-full h-12 px-4 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white text-base focus:border-indigo-500 focus:ring-indigo-500" />
                @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember" type="checkbox" wire:model="remember"
                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Ingat saya</label>
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg text-base font-semibold shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Masuk
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-300 dark:border-zinc-700"></div>
            <span class="mx-4 text-gray-500 dark:text-gray-400 text-sm">atau</span>
            <div class="flex-grow border-t border-gray-300 dark:border-zinc-700"></div>
        </div>

        <!-- Google Button -->
        <a href="{{ route('google.redirect') }}"
           class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 dark:border-zinc-700 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-800 hover:bg-gray-100 dark:hover:bg-zinc-700">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.545 10.239v3.821h5.445c-0.712 2.315-2.647 3.972-5.445 3.972-3.332 0-6.033-2.701-6.033-6.032s2.701-6.032 6.033-6.032c1.498 0 2.866 0.549 3.921 1.453l2.814-2.814c-1.784-1.664-4.152-2.675-6.735-2.675-5.522 0-10 4.479-10 10s4.478 10 10 10c8.396 0 10-7.524 10-10 0-0.61-0.056-1.201-0.158-1.768h-9.842z"/>
            </svg>
            Lanjutkan dengan Google
        </a>

        <!-- Register Link -->
        @if (Route::has('register'))
            <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                Belum punya akun?
                <a href="{{ route('register') }}"
                wire:navigate
                class="font-medium text-indigo-600 hover:text-indigo-700 hover:underline transition-all duration-200 dark:text-indigo-400 dark:hover:text-indigo-300">
                    Daftar
                </a>
            </p>
        @endif
    </div>
</div>
