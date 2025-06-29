<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            @hasSection('header')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <main class="flex-grow">
                @yield('content')
            </main>

            <footer class="bg-gray-800 text-white mt-auto">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p>&copy; {{ date('Y') }} Strathmore University. All rights reserved.</p>
                        <p class="text-sm text-gray-400 mt-1">Lost & Found System - Connecting the campus community</p>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            // Mobile menu toggle for Alpine.js compatibility
            document.addEventListener('alpine:init', () => {
                // Alpine.js will handle the navigation state
            });

            // Auto-hide flash messages
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 300);
                }, 5000);

                const closeButton = alert.querySelector('.close-alert-button');
                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.remove();
                        }, 300);
                    });
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>