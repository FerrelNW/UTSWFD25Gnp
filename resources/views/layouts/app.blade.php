<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pemesanan Lapangan')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">
    <x-header></x-header>
    
    <div class="max-w-4xl mx-auto bg-white p-6 shadow-lg rounded-lg">
        @yield('content')
    </div>

    <x-footer></x-footer>
</body>
</html>