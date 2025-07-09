<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Strathmore Lost & Found')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script defer type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script defer nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigation -->
    <!-- Navigation -->
<nav class="bg-blue-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Left: Logo & Title --}}
            <div class="flex items-center space-x-3">
                <img class="h-10 w-auto" src="{{ asset('images/strathmore-logo.png') }}" alt="Strathmore University">
                <h1 class="text-xl font-semibold text-white">Lost & Found</h1>
            </div>

            {{-- Center: Navigation Links --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Dashboard
                </a>
                <a href="{{ route('items.lost.create') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Report Lost
                </a>
                <a href="{{ route('items.found.create') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Report Found
                </a>
                <a href="{{ route('items.search') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Browse Items
                </a>
                <a href="{{ route('claims.my') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    My Claims
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.station.scan') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                            Station Scanner
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                            Admin Panel
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Right: Auth Buttons --}}
            <div class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                @endguest

                @auth
                    <a href="{{ route('notifications.index') }}" class="relative text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                        Notifications
                        @php
                            $unread = \App\Models\Notification::where('user_id', auth()->id())->where('read', false)->count();
                        @endphp
                        @if($unread > 0)
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ $unread }}</span>
                        @endif
                    </a>
                    <div class="relative">
                        <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-white" id="user-menu-button">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center">
                                <span class="text-white font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                        </button>
                        <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50" id="user-menu">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</nav>


    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 w-full">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Strathmore University. All rights reserved.</p>
                <p class="text-sm text-gray-400 mt-1">Lost & Found System - Connecting the campus community</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.getElementById('user-menu-button')?.addEventListener('click', function() {
            document.getElementById('user-menu').classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            const userMenuButton = document.getElementById('user-menu-button');

            if (userMenu && userMenuButton && !userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
