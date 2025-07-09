@extends('layouts.app')

@section('title', 'Dashboard - Strathmore Lost & Found')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <div class="flex items-center mb-8">
            <svg class="w-14 h-14 text-blue-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <div>
                <h1 class="text-3xl font-extrabold text-blue-800 mb-1">Welcome to Lost & Found</h1>
                <p class="text-gray-600">Help reunite lost items with their owners across Strathmore University campus</p>
            </div>
        </div>
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Total Lost Items -->
            <div class="bg-white shadow-2xl rounded-3xl p-6 flex items-center">
                <i class="fas fa-exclamation-triangle text-3xl text-red-500 mr-4"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-700">Lost Items</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['lost_items'] ?? 0 }}</div>
                    <div class="text-sm text-red-600 font-semibold">Active</div>
                </div>
            </div>
            <!-- Total Found Items -->
            <div class="bg-white shadow-2xl rounded-3xl p-6 flex items-center">
                <i class="fas fa-check-circle text-3xl text-green-500 mr-4"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-700">Found Items</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['found_items'] ?? 0 }}</div>
                    <div class="text-sm text-green-600 font-semibold">Available</div>
                </div>
            </div>
            <!-- Successful Returns -->
            <div class="bg-white shadow-2xl rounded-3xl p-6 flex items-center">
                <i class="fas fa-handshake text-3xl text-blue-500 mr-4"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-700">Returned</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['returned_items'] ?? 0 }}</div>
                    <div class="text-sm text-blue-600 font-semibold">Success</div>
                </div>
            </div>
            <!-- My Reports -->
            <div class="bg-white shadow-2xl rounded-3xl p-6 flex items-center">
                <i class="fas fa-user text-3xl text-purple-500 mr-4"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-700">My Reports</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['my_reports'] ?? 0 }}</div>
                    <div class="text-sm text-purple-600 font-semibold">Total</div>
                </div>
            </div>
        </div>
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-8">
            <a href="{{ route('items.lost.create') }}" class="bg-white shadow-2xl rounded-3xl p-6 flex items-center space-x-4 hover:bg-blue-50 transition">
                <i class="fas fa-plus-circle text-2xl text-red-500"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-900">Report Lost Item</div>
                    <div class="text-sm text-gray-500">Lost something on campus?</div>
                </div>
            </a>
            <a href="{{ route('items.found.create') }}" class="bg-white shadow-2xl rounded-3xl p-6 flex items-center space-x-4 hover:bg-green-50 transition">
                <i class="fas fa-search text-2xl text-green-500"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-900">Report Found Item</div>
                    <div class="text-sm text-gray-500">Found something? Help return it</div>
                </div>
            </a>
            <a href="{{ route('items.search') }}" class="bg-white shadow-2xl rounded-3xl p-6 flex items-center space-x-4 hover:bg-blue-50 transition">
                <i class="fas fa-list text-2xl text-blue-500"></i>
                <div>
                    <div class="text-lg font-semibold text-gray-900">Browse Items</div>
                    <div class="text-sm text-gray-500">Search through all items</div>
                </div>
            </a>
        </div>
        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Lost Items -->
            <div class="bg-white shadow-2xl rounded-3xl p-6">
                <h3 class="text-xl font-bold text-red-600 mb-4">Recent Lost Items</h3>
                @if(isset($recentLostItems) && $recentLostItems->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentLostItems as $item)
                            <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                <i class="fas fa-{{ $item->category_icon ?? 'question' }} text-red-500 text-xl mr-3"></i>
                                <div class="flex-1">
                                    <p class="text-base font-medium text-gray-900">{{ $item->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->location }} • {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 ml-3">
                                    Lost
                                </span>
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
            <!-- Recent Found Items -->
            <div class="bg-white shadow-2xl rounded-3xl p-6">
                <h3 class="text-xl font-bold text-green-600 mb-4">Recent Found Items</h3>
                @if(isset($recentFoundItems) && $recentFoundItems->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentFoundItems as $item)
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-{{ $item->category_icon ?? 'check' }} text-green-500 text-xl mr-3"></i>
                                <div class="flex-1">
                                    <p class="text-base font-medium text-gray-900">{{ $item->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->location }} • {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-3">
                                    Found
                                </span>
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
