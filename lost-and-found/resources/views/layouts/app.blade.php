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
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 flex flex-col min-h-screen m-0 p-0">
    <!-- Navigation -->
    <!-- Navigation -->
<nav class="bg-blue-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Left: Logo & Title --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group focus:outline-none">
                <img class="h-10 w-auto transition-transform duration-500 group-hover:rotate-12 group-hover:scale-110" src="{{ asset('images/strathmore-logo.png') }}" alt="Strathmore University">
                <h1 class="text-xl font-extrabold text-white tracking-wide transition-colors duration-300 group-hover:text-yellow-300 animate-pulse-slow">
                    Lost & Found
                </h1>
            </a>
<style>
@keyframes pulse-slow {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.7; }
}
.animate-pulse-slow { animation: pulse-slow 2.5s infinite; }
</style>

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
                        <div class="relative" id="admin-dropdown-container">
                            <button type="button" class="text-gray-300 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium flex items-center gap-1 focus:outline-none focus:bg-blue-700 transition-colors duration-200" id="admin-dropdown-btn">
                                Admin Functions
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="admin-dropdown" class="hidden absolute right-0 mt-2 min-w-[10rem] rounded-md shadow bg-blue-800 z-50 transition-all duration-150 border border-blue-700">
                                <a href="{{ route('admin.station.scan') }}" class="block px-4 py-2 text-sm text-white hover:bg-blue-700 hover:text-yellow-300 rounded-t-md transition">Station Scanner</a>
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-white hover:bg-blue-700 hover:text-yellow-300 rounded-b-md transition">Admin Panel</a>
                            </div>
                        </div>
</style>
<script>
// Improved admin dropdown: stays open for 1.5s minimum, stays open on hover/focus, closes on click outside
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('admin-dropdown-btn');
    const menu = document.getElementById('admin-dropdown');
    const container = document.getElementById('admin-dropdown-container');
    let dropdownTimeout;
    let isMenuOpen = false;
    let lastOpenTime = 0;
    const MINIMUM_OPEN_TIME = 1500; // 1.5 seconds

    if (btn && menu && container) {
        function showMenu() {
            clearTimeout(dropdownTimeout);
            if (!isMenuOpen) {
                menu.classList.remove('hidden');
                isMenuOpen = true;
                lastOpenTime = Date.now();
            }
        }

        function hideMenu() {
            if (isMenuOpen) {
                const timeOpen = Date.now() - lastOpenTime;
                const remainingTime = Math.max(0, MINIMUM_OPEN_TIME - timeOpen);

                dropdownTimeout = setTimeout(() => {
                    menu.classList.add('hidden');
                    isMenuOpen = false;
                }, remainingTime);
            }
        }

        function cancelHide() {
            clearTimeout(dropdownTimeout);
        }

        // Show menu on button hover/focus
        btn.addEventListener('mouseenter', showMenu);
        btn.addEventListener('focus', showMenu);

        // Cancel hide when hovering over button
        btn.addEventListener('mouseenter', cancelHide);

        // Hide menu when leaving button (with delay)
        btn.addEventListener('mouseleave', hideMenu);
        btn.addEventListener('blur', hideMenu);

        // Keep menu open when hovering over it
        menu.addEventListener('mouseenter', cancelHide);

        // Hide menu when leaving the menu
        menu.addEventListener('mouseleave', hideMenu);

        // Keep menu open when hovering anywhere in the container
        container.addEventListener('mouseenter', cancelHide);

        // Hide menu when leaving the entire container
        container.addEventListener('mouseleave', hideMenu);

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                clearTimeout(dropdownTimeout);
                menu.classList.add('hidden');
                isMenuOpen = false;
            }
        });

        // Close menu when clicking on a menu item
        const menuItems = menu.querySelectorAll('a');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                clearTimeout(dropdownTimeout);
                menu.classList.add('hidden');
                isMenuOpen = false;
            });
        });

        // Optional: Close menu on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMenuOpen) {
                clearTimeout(dropdownTimeout);
                menu.classList.add('hidden');
                isMenuOpen = false;
            }
        });
    }
});
</script>
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
