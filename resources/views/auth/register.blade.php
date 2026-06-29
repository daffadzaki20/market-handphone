<!-- Gunakan guest-layout untuk halaman auth agar tidak muncul navbar utama -->
<x-guest-layout>
<div class="w-full max-w-md mx-auto flex flex-col items-center justify-center min-h-screen">

    <!-- BRAND -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600">
            📱 MyPhoneStore
        </h1>
        <p class="text-gray-500 text-sm">
            Buat akun untuk mulai belanja HP & aksesoris
        </p>
    </div>

    <!-- CARD REGISTER -->
    <div class="bg-white p-8 rounded-xl shadow-lg w-full">

        <h2 class="text-xl font-bold mb-6 text-center text-gray-800">
            Daftar Akun
        </h2>

        <!-- Action diarahkan ke route register -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- NAMA LENGKAP -->
            <div>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus
                    class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none @error('name') border-red-500 @enderror">
                @error('name') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
            </div>
                    
            <!-- USERNAME -->
            <div>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required
                    class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none @error('username') border-red-500 @enderror">
                @error('username') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <!-- EMAIL -->
            <div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                    class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none @error('email') border-red-500 @enderror">
                @error('email') <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p> @enderror
            </div>

            <!-- PASSWORD FIELD -->
            <div class="space-y-1">
                <div class="relative w-full">
                    <input type="password" id="password" name="password" placeholder="Password (Min. 8 karakter)" required
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none transition-all pr-12 @error('password') border-red-500 @enderror">
                    
                    <button type="button" onclick="togglePassword()" 
                        class="absolute right-0 top-0 h-full px-4 flex items-center text-gray-400 hover:text-blue-500 focus:outline-none">
                        <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-1 mt-4">
                <div class="relative w-full">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required
                        class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none transition-all pr-12">
                </div>
            </div>
                @error('password') 
                    <p class="text-xs text-red-500 mt-1 font-medium">
                        {{ $message == 'validation.confirmed' ? 'Konfirmasi password tidak cocok.' : $message }}
                    </p> 
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition-colors mt-2 shadow-md active:scale-95">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6 font-medium">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-500 font-bold hover:underline">Masuk di sini</a>
        </p>

    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            passwordField.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
    </script>

    <!-- FOOTER INFO -->
    <p class="text-center text-xs text-gray-400 mt-6 pb-10">
        © 2026 MyPhoneStore - All rights reserved
    </p>

</div>
</x-guest-layout>
