<!DOCTYPE html>
<html>
<head>
    <title>HandphoneKu</title>
    @vite('resources/css/app.css')
</head>
<div class="absolute top-5 right-5 flex gap-3">

    @guest
        <a href="/login" class="bg-gray-700 px-4 py-2 rounded-lg hover:bg-gray-600">
            Login
        </a>

        <a href="/register" class="bg-green-500 px-4 py-2 rounded-lg hover:bg-green-600">
            Register
        </a>
    @endguest

    @auth
        <a href="/home" class="bg-green-500 px-4 py-2 rounded-lg">
            Masuk 🚀
        </a>
    @endauth

</div>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="text-center max-w-xl">

        <h1 class="text-4xl font-bold mb-4">
            Selamat Datang di HandphoneKu 📱
        </h1>

        <p class="text-gray-400 mb-6">
            Marketplace handphone terbaik untuk kamu 🔥
        </p>

        <a href="/home"
            class="bg-green-500 px-6 py-3 rounded-lg hover:bg-green-600">
            Mulai 🚀
        </a>

    </div>

</body>
</html>