<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="theme-blue bg-[var(--mh-bg)] text-[var(--mh-text)] overflow-x-hidden">

    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="hidden md:flex md:w-72 flex-col bg-white border-r border-[var(--mh-border)] shadow-sm">
            <div class="p-6 border-b border-[var(--mh-border)]">
                <div class="flex items-center gap-2 font-extrabold text-xl text-[var(--mh-primary)]">
                    <span>MarketHandphone</span>
                </div>
                <p class="text-xs text-[var(--mh-muted)] mt-1">Admin Panel</p>
            </div>

            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                <a href="/admin" class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('admin') ? 'mh-nav-link-active' : 'mh-nav-link hover:bg-[var(--mh-surface-hover)]' }}">
                    <span class="font-medium">Dashboard Admin</span>
                </a>

                <a href="/admin/handphones" class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('admin/handphones*') ? 'mh-nav-link-active' : 'mh-nav-link hover:bg-[var(--mh-surface-hover)]' }}">
                    <span class="font-medium">Data Handphone</span>
                </a>

                <a href="/admin/aksesoris" class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('admin/aksesoris*') ? 'mh-nav-link-active' : 'mh-nav-link hover:bg-[var(--mh-surface-hover)]' }}">
                    <span class="font-medium">Data Aksesoris</span>
                </a>

                <a href="/admin/users" class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->is('admin/users*') ? 'mh-nav-link-active' : 'mh-nav-link hover:bg-[var(--mh-surface-hover)]' }}">
                    <span class="font-medium">Data User</span>
                </a>

                <!-- `Dashboard User` removed from admin sidebar (admin has separate dashboard) -->
            </nav>

            <div class="p-4 border-t border-[var(--mh-border)] bg-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-[var(--mh-primary)] flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-[var(--mh-muted)]">Administrator</p>
                        </div>
                    </div>
                    <a href="/logout" class="text-sm mh-logout hover:text-red-600 font-semibold">Logout</a>
                </div>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="flex flex-col flex-1">
            <header class="h-16 bg-white shadow-sm border-b border-[var(--mh-border)] flex items-center justify-between px-6">
                <div>
                    <p class="text-xs uppercase tracking-wider text-[var(--mh-muted)]">Admin Workspace</p>
                    <h1 class="font-semibold text-slate-800">Dashboard</h1>
                </div>
                <p class="text-sm text-[var(--mh-muted)]">{{ date('l, d M Y') }}</p>
            </header>

            <main class="flex-1 overflow-y-auto p-6 bg-[var(--mh-bg)]">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>

    </div>

</body>
</html>