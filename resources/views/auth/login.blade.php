@extends('layouts.auth')

@section('title', 'Login')

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

        @if($errors->has('login'))
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-4">

            @csrf

            <input type="text"
                   name="login"
                   value="{{ old('login') }}"
                   placeholder="Username/Email"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('login') border-red-300 @enderror">

            @error('login')
                <p class="text-xs text-red-500 -mt-2">{{ $message }}</p>
            @enderror

            <input type="password"
                   name="password"
                   placeholder="Password"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200 @error('password') border-red-300 @enderror">

            @error('password')
                <p class="text-xs text-red-500 -mt-2">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold">
                Login
            </button>

        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
            Belum punya akun?
            <a href="/register" class="text-blue-500 hover:underline">
                Register
            </a>
        </p>

    </div>

    <!-- FOOTER INFO -->
    <p class="text-center text-xs text-gray-400 mt-6">
        © 2026 MyPhoneStore - All rights reserved
    </p>

</div>

@endsection