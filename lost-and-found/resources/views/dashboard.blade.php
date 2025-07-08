@extends('layouts.app')

@section('title', 'Dashboard - Strathmore Lost & Found')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <!-- Welcome Section -->
    <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-home text-3xl text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900">Welcome to Lost & Found</h1>
                    <p class="text-gray-600">Help reunite lost items with their owners across Strathmore University campus</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
        <!-- Total Lost Items -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Lost Items</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $stats['lost_items'] ?? 0 }}</div>
                                <div class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="ml-1">Active</span>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Found Items -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-2xl text-green-500"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Found Items</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $stats['found_items'] ?? 0 }}</div>
                                <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="ml-1">Available</span>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Successful Returns -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-handshake text-2xl text-blue-500"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Returned</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $stats['returned_items'] ?? 0 }}</div>
                                <div class="ml-2 flex items-baseline text-sm font-semibold text-blue-600">
                                    <i class="fas fa-heart text-xs"></i>
                                    <span class="ml-1">Success</span>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Reports -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user text-2xl text-purple-500"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">My Reports</dt>
                            <dd class="flex items-baseline">
                                <div class="text-2xl font-semibold text-gray-900">{{ $stats['my_reports'] ?? 0 }}</div>
                                <div class="ml-2 flex items-baseline text-sm font-semibold text-purple-600">
                                    <i class="fas fa-list text-xs"></i>
                                    <span class="ml-1">Total</span>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('items.lost.create') }}" class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <div class="flex-shrink-0">
                        <i class="fas fa-plus-circle text-2xl text-red-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">Report Lost Item</p>
                        <p class="text-sm text-gray-500">Lost something on campus?</p>
                    </div>
                </a>

                <a href="{{ route('items.found.create') }}" class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <div class="flex-shrink-0">
                        <i class="fas fa-search text-2xl text-green-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">Report Found Item</p>
                        <p class="text-sm text-gray-500">Found something? Help return it</p>
                    </div>
                </a>

                <a href="{{ route('items.search') }}" class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <div class="flex-shrink-0">
                        <i class="fas fa-list text-2xl text-blue-500"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">Browse Items</p>
                        <p class="text-sm text-gray-500">Search through all items</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Lost Items -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Lost Items</h3>
                @if(isset($recentLostItems) && $recentLostItems->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentLostItems as $item)
                            <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-{{ $item->category_icon ?? 'question' }} text-red-500"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $item->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->location }} • {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="ml-3 flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Lost
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('my.items.index', 'lost') }}" class="text-sm text-blue-600 hover:text-blue-500">
                            View all my lost items <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-search text-gray-400 text-3xl mb-2"></i>
                        <p class="text-gray-500">No recent lost items</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Found Items -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Found Items</h3>
                @if(isset($recentFoundItems) && $recentFoundItems->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentFoundItems as $item)
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-{{ $item->category_icon ?? 'check' }} text-green-500"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $item->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->location }} • {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="ml-3 flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Found
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('my.items.index', 'found') }}" class="text-sm text-blue-600 hover:text-blue-500">
                            View all my found items <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle text-gray-400 text-3xl mb-2"></i>
                        <p class="text-gray-500">No recent found items</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
