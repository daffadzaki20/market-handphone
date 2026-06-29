@extends('layouts.auth')

@section('title', 'Login - MyPhoneStore')

@section('content')

<div class="w-full max-w-md">

    <!-- BRANDING -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-blue-600">
            📱 MyPhoneStore
        </h1>
        <p class="text-gray-500 text-sm">
            Marketplace HP & Aksesoris Terpercaya
        </p>
    </div>

    <!-- CARD LOGIN -->
    <div class="bg-white p-8 rounded-xl shadow-lg">

        <h2 class="text-xl font-bold mb-4 text-center">
            Login Akun
        </h2>

        <!-- Alert Sukses Registrasi -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- INPUT EMAIL / USERNAME -->
            <div>
                <!-- 
                    PENTING: Atribut 'name' diganti menjadi 'login' 
                    agar sesuai dengan validasi di AuthController 
                -->
                <input type="text"
                       name="login" 
                       value="{{ old('login') }}"
                       placeholder="Email atau Username"
                       required autofocus
                       class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none @error('login') border-red-500 @enderror">
                
                @error('login')
                    <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- INPUT PASSWORD -->
            <div class="space-y-1">
                <div class="relative w-full">
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="Password"
                           required
                           class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 outline-none transition-all pr-12 @error('password') border-red-500 @enderror">
                    
                    <!-- Tombol Show/Hide -->
                    <button type="button" 
                            onclick="togglePassword()" 
                            class="absolute right-0 top-0 h-full px-4 flex items-center text-gray-400 hover:text-blue-500 transition-colors focus:outline-none">
                        
                        <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>

                        <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- FOOTER INPUT -->
            <div class="flex justify-between items-center px-1">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer">
                    <label for="remember_me" class="ms-2 text-sm text-gray-600 cursor-pointer">Ingat saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-blue-500 hover:underline font-medium">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition-all active:scale-95 shadow-md">
                Login
            </button>

        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-500 font-bold hover:underline">
                Register
            </a>
        </p>

    </div>

    <!-- FOOTER INFO -->
    <p class="text-center text-xs text-gray-400 mt-6">
        © 2026 MyPhoneStore - All rights reserved
    </p>

</div>

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

@endsection
