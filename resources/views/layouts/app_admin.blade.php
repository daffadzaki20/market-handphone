<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'Admin Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-sky-50 via-white to-cyan-50 text-gray-700">

<div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden relative">

    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/50 z-40 md:hidden" style="display: none;"></div>

    {{-- SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-blue-100 shadow-2xl flex flex-col transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        {{-- LOGO --}}
        <div class="p-6 border-b border-blue-100 bg-gradient-to-r from-blue-500 to-cyan-400 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-3xl bg-white/20 backdrop-blur flex items-center justify-center text-white text-2xl shadow-lg">
                    📱
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold tracking-wide text-white">MarketPhone</h1>
                    <p class="text-sm text-blue-100 mt-1">Admin Dashboard</p>
                </div>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-white/70 hover:text-white p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- NAVIGATION --}}
        <nav class="flex-1 p-5 space-y-3 bg-white overflow-y-auto">
            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->is('admin') ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md' }}">
                <div class="flex items-center gap-4">
                    <span class="text-xl">📊</span><span class="font-semibold">Dashboard</span>
                </div>
            </a>

            {{-- HANDPHONE --}}
            <a href="{{ route('admin.handphones.index') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->is('admin/handphones*') ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md' }}">
                <div class="flex items-center gap-4">
                    <span class="text-xl">📱</span><span class="font-semibold">Handphone</span>
                </div>
                @if(isset($lowStockHandphone) && $lowStockHandphone > 0)
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full animate-pulse">{{ $lowStockHandphone }}</span>
                @endif
            </a>

            {{-- AKSESORIS --}}
            <a href="{{ route('admin.aksesoris.index') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->is('admin/aksesoris*') ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md' }}">
                <div class="flex items-center gap-4">
                    <span class="text-xl">🎧</span><span class="font-semibold">Aksesoris</span>
                </div>
                @if(isset($lowStockAksesoris) && $lowStockAksesoris > 0)
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-red-500 text-white rounded-full animate-pulse">{{ $lowStockAksesoris }}</span>
                @endif
            </a>

            {{-- USERS --}}
            <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->is('admin/users*') ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md' }}">
                <div class="flex items-center gap-4">
                    <span class="text-xl">👥</span><span class="font-semibold">Users</span>
                </div>
                @if(isset($newUsersCount) && $newUsersCount > 0)
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-blue-600 text-white rounded-full">{{ $newUsersCount }}</span>
                @endif
            </a>

            {{-- PESANAN MASUK --}}
            <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->is('admin/orders*') ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md' }}">
                <div class="flex items-center gap-4">
                    <span class="text-xl">📦</span><span class="font-semibold">Pesanan Masuk</span>
                </div>
                @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-orange-500 text-white rounded-full animate-bounce">{{ $pendingOrdersCount }}</span>
                @endif
            </a>

            {{-- KELOLA VOUCHER --}}
            <a href="{{ route('admin.vouchers.index') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 {{ request()->is('admin/vouchers*') ? 'bg-gradient-to-r from-blue-500 to-cyan-400 text-white shadow-lg scale-[1.02]' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:shadow-md' }}">
                <div class="flex items-center gap-4">
                    <span class="text-xl">🎟️</span><span class="font-semibold">Kelola Voucher</span>
                </div>
                @if(isset($emptyVouchersCount) && $emptyVouchersCount > 0)
                    <span class="px-2.5 py-0.5 text-xs font-bold bg-red-600 text-white rounded-full">{{ $emptyVouchersCount }}</span>
                @endif
            </a>
        </nav>

        {{-- USER PROFILE --}}
        <div class="p-5 border-t border-blue-100 bg-blue-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="w-24 md:w-auto overflow-hidden">
                        <p class="text-sm font-bold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-500">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded-xl bg-red-100 text-red-500 hover:bg-red-200 transition-all duration-300 text-sm font-semibold shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- TOPBAR --}}
        <header class="h-16 md:h-20 bg-white border-b border-blue-100 shadow-sm flex items-center justify-between px-4 md:px-8">
            
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden p-2 -ml-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 focus:outline-none transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <div>
                    <h2 class="text-lg md:text-3xl font-extrabold text-gray-700 truncate">
                        @yield('title')
                    </h2>
                    <p class="text-xs md:text-sm text-gray-400 hidden sm:block mt-1">
                        Welcome back, Admin 👋
                    </p>
                </div>
            </div>

            <div class="px-3 py-2 md:px-5 md:py-3 rounded-xl md:rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-400 text-white text-[10px] md:text-sm font-semibold shadow-md whitespace-nowrap">
                {{ date('d M Y') }}
            </div>

        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-8 bg-gradient-to-br from-blue-50/50 to-cyan-50/30">
            <div class="max-w-7xl mx-auto">
                {{-- MAIN WRAPPER --}}
                <div class="bg-white rounded-2xl md:rounded-[32px] shadow-xl border border-blue-100 p-4 md:p-8 min-h-[300px] overflow-x-auto">
                    @yield('content')
                </div>
            </div>
        </main>

    </div>

</div>

</body>
</html>