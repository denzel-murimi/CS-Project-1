@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    {{-- Hero Section --}}
    <section class="w-full relative py-16 shadow-xl overflow-hidden">
        <img src="{{ asset('images/lost.jpg') }}" alt="Lost and Found" class="absolute inset-0 w-full h-full object-cover object-center z-0" style="min-height:100%; min-width:100%;">
        <div class="absolute inset-0 bg-blue-800 bg-opacity-70 z-10"></div>
        <div class="relative w-full px-4 sm:px-6 text-center z-20">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 drop-shadow-lg tracking-tight leading-tight">
                Welcome to Strathmore University's Lost & Found
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-10 font-medium">
                Easily report, search, and reclaim lost or found items on campus.<br class="hidden md:inline">
                Your community, your belongings, your safety.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('items.lost.create') }}"
                   class="bg-blue-500 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-blue-600 hover:scale-105 transition-all duration-200">
                    Report Lost Item
                </a>
                <a href="{{ route('items.found.create') }}"
                   class="bg-green-500 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-green-600 hover:scale-105 transition-all duration-200">
                    Add Found Item
                </a>
                <a href="#itemsContainer"
                   class="bg-yellow-500 text-white font-semibold px-8 py-3 rounded-full shadow-lg hover:bg-yellow-600 hover:scale-105 transition-all duration-200">
                    Browse Items
                </a>
            </div>
        </div>
    </section>

    {{-- Search Section --}}
    <div class="w-full mt-10 px-4 md:px-10">
        <input type="text"
               id="searchInput"
               placeholder="🔍 Search for lost or found items..."
               class="w-full border-2 border-blue-400 focus:border-blue-600 p-4 rounded-xl mb-10 shadow transition duration-200 text-lg" />
    </div>

    <div class="w-full flex flex-col lg:flex-row gap-8 px-4 md:px-10">
        {{-- Sidebar Filters --}}
        <div class="w-full lg:w-1/4 mb-8 lg:mb-0">
            {{-- Type Filter --}}
            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Type</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-lost" class="type-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="lost" />
                        <label for="filter-lost" class="ml-3 text-sm font-medium text-gray-700">Lost Items</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-found" class="type-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="found" />
                        <label for="filter-found" class="ml-3 text-sm font-medium text-gray-700">Found Items</label>
                    </div>
                </div>
            </div>

            {{-- Category Filter --}}
            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Category</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-electronics" class="category-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="electronics" />
                        <label for="filter-electronics" class="ml-3 text-sm font-medium text-gray-700">Electronics</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-personal" class="category-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="personal_items" />
                        <label for="filter-personal" class="ml-3 text-sm font-medium text-gray-700">Personal Items</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-documents" class="category-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="documents" />
                        <label for="filter-documents" class="ml-3 text-sm font-medium text-gray-700">Documents</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-clothing" class="category-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="clothing" />
                        <label for="filter-clothing" class="ml-3 text-sm font-medium text-gray-700">Clothing</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-books" class="category-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="books" />
                        <label for="filter-books" class="ml-3 text-sm font-medium text-gray-700">Books</label>
                    </div>
                </div>
            </div>

            {{-- Location Filter --}}
            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-bold text-lg mb-4 text-gray-800">Location</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-library" class="location-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="library" />
                        <label for="filter-library" class="ml-3 text-sm font-medium text-gray-700">Library</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-cafeteria" class="location-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="cafeteria" />
                        <label for="filter-cafeteria" class="ml-3 text-sm font-medium text-gray-700">Cafeteria</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-classrooms" class="location-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="classrooms" />
                        <label for="filter-classrooms" class="ml-3 text-sm font-medium text-gray-700">Classrooms</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="filter-sports" class="location-filter h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" value="sports_center" />
                        <label for="filter-sports" class="ml-3 text-sm font-medium text-gray-700">Sports Center</label>
                    </div>
                </div>
            </div>

            {{-- Clear Filters Button --}}
            <button id="clearFilters"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg w-full transition duration-200 font-medium">
                Clear All Filters
            </button>
        </div>

        {{-- Main Content --}}
        <div class="w-full lg:w-3/4">
            {{-- Header --}}
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Recent Items</h2>
                <div id="itemCount" class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-full">
                    Showing <span id="visibleCount">{{ count($recentItems) }}</span> of <span id="totalCount">{{ count($recentItems) }}</span> items
                </div>
            </div>

            {{-- Items Container --}}
            <div id="itemsContainer" class="space-y-6">
                @foreach ($recentItems as $item)
                    <div class="item-card flex flex-col md:flex-row bg-white rounded-xl p-6 shadow-md hover:shadow-lg hover:-translate-y-1 border border-gray-200 hover:border-blue-300 transition-all duration-200 group"
                         data-type="{{ $item->type }}"
                         data-category="{{ $item->category }}"
                         data-location="{{ $item->location }}"
                         data-name="{{ strtolower($item->name) }}"
                         data-description="{{ strtolower($item->description ?? '') }}">

                        {{-- Image --}}
                        <div class="w-full md:w-32 h-48 md:h-32 bg-gray-100 flex items-center justify-center mb-4 md:mb-0 md:mr-6 rounded-lg overflow-hidden group-hover:ring-2 group-hover:ring-blue-300 transition-all duration-200">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}"
                                     alt="{{ $item->name }}"
                                     class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-200">
                            @else
                                <div class="text-center">
                                    <div class="text-3xl mb-2">📦</div>
                                    <span class="text-xs text-gray-500">{{ ucfirst(str_replace('_', ' ', $item->category)) }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="font-bold text-xl text-gray-900 group-hover:text-blue-700 transition-colors duration-200">
                                    {{ $item->name }}
                                </h3>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full text-white shadow-sm {{ $item->type === 'lost' ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ strtoupper($item->type) }}
                                </span>
                            </div>

                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ ucfirst(str_replace('_', ' ', $item->location)) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0h6m-6 0v3a1 1 0 001 1h4a1 1 0 001-1V7m-6 0V4"/>
                                    </svg>
                                    {{ $item->date_lost_found->format('F j, Y') }}
                                </span>
                            </div>

                            @if($item->description)
                                <p class="text-gray-700 mb-3 leading-relaxed">
                                    {{ Str::limit($item->description, 120) }}
                                </p>
                            @endif

                            <a href="{{ route('items.show', $item->id) }}"
                               class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-200">
                                View Details
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- No Results Message --}}
            <div id="noResults" class="hidden text-center py-12">
                <div class="text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h3 class="text-xl font-semibold mb-2 text-gray-600">No items found</h3>
                    <p class="text-gray-500">Try adjusting your filters or search terms</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const typeFilters = document.querySelectorAll('.type-filter');
    const categoryFilters = document.querySelectorAll('.category-filter');
    const locationFilters = document.querySelectorAll('.location-filter');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const itemCards = document.querySelectorAll('.item-card');
    const noResults = document.getElementById('noResults');
    const visibleCount = document.getElementById('visibleCount');
    const totalCount = document.getElementById('totalCount');

    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedTypes = Array.from(typeFilters).filter(cb => cb.checked).map(cb => cb.value);
        const selectedCategories = Array.from(categoryFilters).filter(cb => cb.checked).map(cb => cb.value);
        const selectedLocations = Array.from(locationFilters).filter(cb => cb.checked).map(cb => cb.value);

        let visibleItems = 0;

        itemCards.forEach(card => {
            const itemType = card.dataset.type;
            const itemCategory = card.dataset.category;
            const itemLocation = card.dataset.location;
            const itemName = card.dataset.name;
            const itemDescription = card.dataset.description;

            // Check search term
            const matchesSearch = !searchTerm ||
                itemName.includes(searchTerm) ||
                itemDescription.includes(searchTerm) ||
                itemCategory.includes(searchTerm) ||
                itemLocation.replace('_', ' ').includes(searchTerm);

            // Check type filter
            const matchesType = selectedTypes.length === 0 || selectedTypes.includes(itemType);

            // Check category filter
            const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(itemCategory);

            // Check location filter
            const matchesLocation = selectedLocations.length === 0 || selectedLocations.includes(itemLocation);

            // Show/hide item based on all filters
            if (matchesSearch && matchesType && matchesCategory && matchesLocation) {
                card.style.display = 'flex';
                visibleItems++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update count and show/hide no results message
        visibleCount.textContent = visibleItems;

        if (visibleItems === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    // Add event listeners
    searchInput.addEventListener('input', applyFilters);

    [...typeFilters, ...categoryFilters, ...locationFilters].forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });

    clearFiltersBtn.addEventListener('click', function() {
        // Clear search
        searchInput.value = '';

        // Uncheck all filters
        [...typeFilters, ...categoryFilters, ...locationFilters].forEach(filter => {
            filter.checked = false;
        });

        // Reapply filters (which will show all items)
        applyFilters();
    });

    // Set initial total count
    totalCount.textContent = itemCards.length;
});
</script>
@endsection
