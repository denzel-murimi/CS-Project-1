@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Browse All Items</h1>

    <!-- Search and Filter Form -->
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-8">
        <form action="{{ route('items.search') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:gap-4 md:items-end">
            <!-- Search Input -->
            <div class="flex-grow">
                <label for="query" class="block text-sm font-medium text-gray-700 mb-1">Search Keyword</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="query" id="query" placeholder="Search by name, description, or location..."
                           value="{{ request('query') }}"
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-base transition-all duration-200">
                </div>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Item Type</label>
                <select name="type" id="type" class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 py-2.5 px-3 text-base transition-all duration-200">
                    <option value="">All Types</option>
                    <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost Items</option>
                    <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found Items</option>
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" id="category" class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 py-2.5 px-3 text-base transition-all duration-200">
                    <option value="">All Categories</option>
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Location Filter -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <select name="location" id="location" class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 py-2.5 px-3 text-base transition-all duration-200">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                <select name="sort" id="sort" class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 py-2.5 px-3 text-base transition-all duration-200">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Posted</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="date_lost_found" {{ request('sort') == 'date_lost_found' ? 'selected' : '' }}>Date Lost/Found</option>
                </select>
            </div>

            <!-- Sort Direction -->
            <div>
                <label for="direction" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                <select name="direction" id="direction" class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 py-2.5 px-3 text-base transition-all duration-200">
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="md:self-end">
                <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Items List -->
    @if($items->isEmpty())
        <div class="text-center py-12 bg-white rounded-xl shadow-lg border border-gray-100">
            <i class="fas fa-box-open text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No items match your criteria.</h3>
            <p class="text-gray-500">Try adjusting your search or filters.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-{{ $item->type == 'lost' ? 'question-circle' : 'hand-holding' }} text-gray-400 text-5xl"></i>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $item->name }}</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $item->type == 'lost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($item->type) }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $item->description ?? 'No description available.' }}</p>
                        <div class="text-sm text-gray-500 space-y-2">
                            <p class="flex items-center"><i class="fas fa-tag mr-2 text-blue-500"></i> {{ ucfirst($item->category) }}</p>
                            <p class="flex items-center"><i class="fas fa-map-marker-alt mr-2 text-red-500"></i> {{ $item->location }}</p>
                            <p class="flex items-center"><i class="fas fa-calendar-alt mr-2 text-green-500"></i> {{ $item->date_lost_found->format('M j, Y') }}</p>
                        </div>
                        <div class="mt-6 text-right">
                            <a href="{{ route('items.show', $item->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                                View Details <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $items->links() }}
        </div>
    @endif
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection