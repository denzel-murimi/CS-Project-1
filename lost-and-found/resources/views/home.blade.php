@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-6">
    {{-- Search --}}
    <div class="max-w-6xl mx-auto mt-6 px-6">
        <input type="text" id="searchInput" placeholder="🔍 Search for lost or found items..."
            class="w-full border-2 border-gray-400 p-3 rounded mb-6" />
    </div>

    <div class="max-w-6xl mx-auto px-6 flex">
        {{-- Sidebar --}}
        <div class="w-1/4">
            <div class="mb-4 bg-white p-4 border rounded">
                <h3 class="font-bold mb-2">Type</h3>
                <div class="space-y-2">
                    <div>
                        <input type="checkbox" id="filter-lost" class="type-filter" value="lost" />
                        <label for="filter-lost" class="ml-2">Lost Items</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-found" class="type-filter" value="found" />
                        <label for="filter-found" class="ml-2">Found Items</label>
                    </div>
                </div>
            </div>

            <div class="mb-4 bg-white p-4 border rounded">
                <h3 class="font-bold mb-2">Category</h3>
                <div class="space-y-2">
                    <div>
                        <input type="checkbox" id="filter-electronics" class="category-filter" value="electronics" />
                        <label for="filter-electronics" class="ml-2">Electronics</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-personal" class="category-filter" value="personal_items" />
                        <label for="filter-personal" class="ml-2">Personal Items</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-documents" class="category-filter" value="documents" />
                        <label for="filter-documents" class="ml-2">Documents</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-clothing" class="category-filter" value="clothing" />
                        <label for="filter-clothing" class="ml-2">Clothing</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-books" class="category-filter" value="books" />
                        <label for="filter-books" class="ml-2">Books</label>
                    </div>
                </div>
            </div>

            <div class="mb-4 bg-white p-4 border rounded">
                <h3 class="font-bold mb-2">Location</h3>
                <div class="space-y-2">
                    <div>
                        <input type="checkbox" id="filter-library" class="location-filter" value="library" />
                        <label for="filter-library" class="ml-2">Library</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-cafeteria" class="location-filter" value="cafeteria" />
                        <label for="filter-cafeteria" class="ml-2">Cafeteria</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-classrooms" class="location-filter" value="classrooms" />
                        <label for="filter-classrooms" class="ml-2">Classrooms</label>
                    </div>
                    <div>
                        <input type="checkbox" id="filter-sports" class="location-filter" value="sports_center" />
                        <label for="filter-sports" class="ml-2">Sports Center</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <button id="clearFilters" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded w-full transition duration-200">
                    Clear All Filters
                </button>
            </div>
        </div>

        {{-- Main content --}}
        <div class="w-3/4 pl-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Recent Items</h2>
                <div id="itemCount" class="text-sm text-gray-600">
                    Showing <span id="visibleCount">{{ count($recentItems) }}</span> of <span id="totalCount">{{ count($recentItems) }}</span> items
                </div>
            </div>

            <div id="itemsContainer">
                @foreach ($recentItems as $item)
                    <div class="item-card flex bg-white border border-gray-200 rounded p-4 mb-4 shadow-md hover:shadow-lg transition-shadow duration-200"
                         data-type="{{ strtolower($item->type) }}"
                         data-category="{{ strtolower($item->category) }}"
                         data-location="{{ strtolower(str_replace(' ', '_', $item->location)) }}"
                         data-name="{{ strtolower($item->name) }}"
                         data-description="{{ strtolower($item->description ?? '') }}">
                        <div class="w-24 h-24 bg-gray-300 flex items-center justify-center mr-4 rounded">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="object-cover w-full h-full rounded">
                            @else
                                <span class="text-xs text-center">{{ ucfirst($item->category) }}</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg">
                                {{ $item->name }}
                                <span class="uppercase text-sm px-2 py-1 rounded text-white {{ $item->type === 'lost' ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ strtoupper($item->type) }}
                                </span>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">📍 {{ $item->location }}</p>
                            <p class="text-xs text-gray-500 mt-1">📅 {{ $item->date_lost_found->format('F j, Y') }}</p>
                            @if($item->description)
                                <p class="text-sm text-gray-700 mt-2">{{ Str::limit($item->description, 100) }}</p>
                            @endif
                            <a href="{{ route('items.show', $item->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="noResults" class="hidden text-center py-8">
                <div class="text-gray-500">
                    <i class="fas fa-search text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">No items found</h3>
                    <p>Try adjusting your filters or search terms</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center py-6 text-gray-500 mt-10 border-t">
        © 2025 Strathmore University Lost & Found System
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
