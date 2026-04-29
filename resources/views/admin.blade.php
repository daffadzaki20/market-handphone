@extends('layouts.app_admin')

@section('title', 'Admin')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white p-8 rounded-xl shadow text-center">

        <h1 class="text-2xl font-bold text-red-600">
            Halo ADMIN 👑 {{ Auth::user()->name }}
        </h1>

        <p class="text-gray-500 mt-2">
            Ini halaman admin panel
        </p>

        <a href="/logout" class="text-red-500 mt-4 inline-block">
            Logout
        </a>

    </div>

</div>

@endsection