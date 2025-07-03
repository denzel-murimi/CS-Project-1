<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center pr-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Lost & Found</span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-6 sm:ml-16 sm:flex">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out">
                        Home
                    </a>
                    <a href="{{ route('items.lost.create') }}" class="{{ request()->routeIs('items.lost.create') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out">
                        Report Lost
                    </a>
                    <a href="{{ route('items.found.create') }}" class="{{ request()->routeIs('items.found.create') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out">
                        Report Found
                    </a>
                    <a href="{{ route('items.index') }}" class="{{ request()->routeIs('items.index') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300' }} px-3 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out">
                        Browse Items
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown / Auth Links (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @auth
                    <!-- Removed x-data and @click.outside from this div -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Dashboard Link -->
                                <x-dropdown-link :href="route('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                <!-- Profile Link -->
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Login and Register Links for Guests -->
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-200">
                            Register
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger Button (for mobile responsiveness) -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="text-gray-400 hover:text-gray-500 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu (Responsive Navigation Menu) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Home</a>
            <a href="{{ route('items.lost.create') }}" class="{{ request()->routeIs('items.lost.create') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Report Lost</a>
            <a href="{{ route('items.found.create') }}" class="{{ request()->routeIs('items.found.create') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Report Found</a>
            <a href="{{ route('items.index') }}" class="{{ request()->routeIs('items.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Browse Items</a>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-500 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Log Out</a>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-2 space-y-1">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-700 block px-3 py-2 rounded-md text-base font-medium transition duration-150 ease-in-out">Register</a>
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>