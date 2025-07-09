<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 flex flex-col min-h-screen m-0 p-0">
    <nav class="bg-blue-800 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="hover:underline mr-4">Dashboard</a>
                <a href="{{ route('admin.station.scan') }}" class="hover:underline">Station Scanner</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>
</html>
