@extends('layouts.auth')

@section('title', 'Register')

@section('content')

<div class="w-full max-w-md">

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
    <div class="bg-white p-8 rounded-xl shadow-lg">

        <h2 class="text-xl font-bold mb-4 text-center">
            Daftar Akun
        </h2>

        <form method="POST" action="/register" class="space-y-4">

            @csrf

            <input type="text"
                   name="name"
                   placeholder="Nama Lengkap"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">
                   
            <input type="text"
                   name="username"
                   placeholder="Username"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">

            <input type="email"
                   name="email"
                   placeholder="Email"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">

            <input type="password"
                   name="password"
                   placeholder="Password"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-blue-200">

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold">
                Register
            </button>

        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
            Sudah punya akun?
            <a href="/login" class="text-blue-500 hover:underline">
                Login
            </a>
        </p>

    </div>

    <!-- FOOTER -->
    <p class="text-center text-xs text-gray-400 mt-6">
        © 2026 MyPhoneStore
    </p>

</div>

@endsection