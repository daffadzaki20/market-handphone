<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 p-5">

<h1 class="text-2xl font-bold mb-6">Checkout</h1>

<form action="/checkout" method="POST" class="bg-white p-5 rounded-xl shadow">
    @csrf

    <input type="text" name="name" placeholder="Nama"
        class="w-full border p-2 mb-3 rounded">

    <input type="text" name="phone" placeholder="No HP"
        class="w-full border p-2 mb-3 rounded">

    <textarea name="address" placeholder="Alamat"
        class="w-full border p-2 mb-3 rounded"></textarea>

    <button class="bg-green-500 text-white px-5 py-2 rounded-lg">
        Pesan Sekarang
    </button>
</form>

</body>
</html>