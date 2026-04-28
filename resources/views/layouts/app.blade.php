<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">

            <!-- BRAND -->
            <div class="text-xl font-bold text-blue-600">
                📱 MyPhoneStore
            </div>

            <!-- MENU (DESKTOP) -->
            <div class="hidden md:flex space-x-6 text-sm">

                <a href="/dashboard" class="hover:text-blue-500">Home</a>

                <a href="/products/handphone" class="hover:text-blue-500">Handphone</a>

                <a href="/products/aksesoris" class="hover:text-blue-500">Aksesoris</a>

            </div>

            <!-- LOGOUT -->
            <a href="/logout" class="text-red-500 text-sm hover:underline">
                Logout
            </a>

        </div>
    </nav>

    <!-- CONTENT WRAPPER -->
    <div class="max-w-6xl mx-auto px-4 py-6">

        @yield('content')

    </div>

</body>
</html>