@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900">
            👤 Profil Saya
        </h1>
    </div>

    <!-- PROFILE CARD -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- HEADER PROFILE -->
        <div class="bg-gradient-to-r from-blue-50 to-slate-50 px-8 py-10 flex flex-col items-center border-b border-gray-100 relative">
            
            <!-- Avatar (Inisial Nama) -->
            <div class="w-24 h-24 bg-blue-600 text-white rounded-full flex items-center justify-center text-4xl font-bold shadow-md mb-4 ring-4 ring-white">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            
            <!-- Nama & Role -->
            <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
            
            <!-- Badge Role -->
            <span class="mt-2 px-4 py-1 {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-700 border-purple-200' : 'bg-blue-100 text-blue-700 border-blue-200' }} border rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
                {{ Auth::user()->role }}
            </span>
            
        </div>

        <!-- PROFILE DETAILS -->
        <div class="p-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b border-gray-100 pb-2">
                Informasi Akun
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Field: Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium">
                        {{ Auth::user()->name }}
                    </div>
                </div>

                <!-- Field: Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Username</label>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium flex items-center">
                        <span class="text-gray-400 mr-1">@</span>{{ Auth::user()->username }}
                    </div>
                </div>

                <!-- Field: Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Alamat Email</label>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium flex justify-between items-center">
                        <span>{{ Auth::user()->email }}</span>
                        
                        <!-- Status Verifikasi Email -->
                        @if(Auth::user()->email_verified_at)
                            <span class="flex items-center text-green-600 text-xs font-bold bg-green-100 px-2 py-1 rounded-md">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Verified
                            </span>
                        @else
                            <span class="flex items-center text-yellow-600 text-xs font-bold bg-yellow-100 px-2 py-1 rounded-md">
                                Unverified
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Field: Tanggal Bergabung -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Bergabung Sejak</label>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium">
                        {{ Auth::user()->created_at->format('d F Y') }}
                    </div>
                </div>

            </div>

            <!-- ACTIONS / BUTTONS -->
            <div class="mt-10 flex flex-col sm:flex-row gap-3">
                <button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-sm transition-colors flex justify-center items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Profil
                </button>
                <button class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 px-6 py-3 rounded-xl font-semibold shadow-sm transition-colors flex justify-center items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Ubah Password
                </button>
            </div>

        </div>
    </div>

</div>

@endsection